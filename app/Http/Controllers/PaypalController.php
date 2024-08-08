<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
use App\Models\Students;
use App\Models\Payment;
use App\Models\StudentOrganization;;
use Omnipay\Omnipay;


class PaypalController extends Controller
{
    private $gateway;

    public function __construct(){
        
         $this->gateway = Omnipay::create('PayPal_Rest');
         $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
         $this->gateway->setSecret(env( 'PAYAPAL_CLIENT_SECRET'));
         $this->gateway->setTestMode(true);
    }

    public function pay(Request $request){
        try{
            $response = $this->gateway->purchase(array(
                'amount' => 200,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();
            if($response->isRedirect()){
                $response->redirect();

            }
            else{
                return $response->getMessage();
            }
        }
        catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function success(Request $request){
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'=>$request->input('PayerID'),
                'transactionReference' =>$request->input('paymentId')
            ));

            $response = $transaction->send();

            if($response->isSuccessful())
            {   $user = Auth::user();
                $userId = $user->name;
                $userStudno = $user->id;

                $orgid = Session::get('orgid');
                $orgname = Session::get('orgname');
                
                $arr = $response->getData();
                $payment = new Payment();
                $payment->payment_id = $arr['id'];
                $payment->name = $userId;
                $payment->studno = $userStudno;
                $payment->organization = $orgname;
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email= $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->save();

                $studentOrganizations = DB::table('student_organizations')->where('studentId', $userStudno)->update(['org2_memberstatus' => 'Paid']);
                $students = DB::table('students')->where('student_id', $userStudno)->update(['org2_member_status'=> 'Paid']);

                return redirect('student/org2_page/');
            }
            else{
                return $response->getMessage();
            }


        }
        else{
            return 'Payment declined!';
        }
    }

    public function error(){
        return 'User declined';
    }
}

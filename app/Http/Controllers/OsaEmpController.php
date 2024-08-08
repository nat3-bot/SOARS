<?php
namespace App\Http\Controllers;

use App\Rules\AdamsonEmailValidation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Models\Osa;
use App\Models\User;
use App\Models\Verification;
use App\Mail\VerifyEmail;
use Datatables;

class OsaEmpController extends Controller
{
    public function osalist()
    {
        $osaEmployeesCount = Osa::count();

        if(request()->ajax()) {
            return datatables()->of(Osa::select('*'))
            ->addColumn('action', 'Admin.osa_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view ('Admin.osa_list', compact('osaEmployeesCount'));
    }

    public function stores(Request $request)
    {
        $datetime = now();
        $employeeId = $request->employee_id;

        if (strpos($request->email, '@adamson.edu.ph') === false) {
            return response()->json(['message' =>'Only email addresses from "@adamson.edu.ph" domain are allowed.'], 400);
        }

        $employeeData = [
            'last_name' => $request->last_name,
            'middle_initial' => $request->middle_initial,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
        
        // Check if password is provided in the request
        if (!empty($request->password)) {
            $employeeData['password'] = Hash::make($request->password); // Hash Password
        }

        
        DB::table('osa')->updateOrInsert(
            ['employee_id' => $employeeId],
            $employeeData
        );
        
        $fname= $request->first_name;
        $mname= $request->middle_initial;
        $lname= $request->last_name;
        $name = $fname.' '.$mname.' '.$lname;
        $randomString = Str::random(10);

        $userExists = User::find($employeeId);
        if(!$userExists){
            
        DB::table('users')->insert([
            'id' => $employeeId,
            'role' => '2',
            'name' => $name,
            'email' => $request->email,
            'email_verified_at' => null,
            'password' => Hash::make($request->password),
            'remember_token'=> $randomString,
            'created_at'=>$datetime,
            'updated_at' =>$datetime,
        ]);

        
        
        $user = User::where('id', $employeeId)->first();
        event(new Registered($user));
        }

        else {
            DB::table('users')->where('id', $employeeId)->update([
                'name' => $name,
                'password' => Hash::make($request->password),
                'remember_token' => $randomString,
                'updated_at' => now()]
            );
            return response()->json(['message' =>'Employee information saved successfully']);
            }

        return response()->json(['message' =>'Employee information saved successfully']);
    }

    public function edits(Request $request)
    {
        $employee = DB::table('osa')->where('employee_id', $request->employee_id)->first();

        return response()->json($employee);
    }

    public function updates(Request $request)
    {
        $employeeId = $request->employee_id;

        $employeeData = [
            'last_name' => $request->last_name,
            'middle_initial' => $request->middle_initial,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];

        // Check if password is provided in the request
        if (!empty($request->password)) {
            $employeeData['password'] = Hash::make($request->password); // Hash Password
        }

        DB::table('osa')->where('employee_id', $employeeId)->update($employeeData);

        return response()->json(['message' => 'OSA Employee information updated successfully']);
    }

    public function deletes(Request $request)
    {
        
        $employeeId = $request->employee_id;
        DB::table('users')->where('id', $employeeId)->delete();
        // Delete record from 'osa' table
        DB::table('osa')->where('employee_id', $employeeId)->delete();

        session()->flash('User has been deleted');
    

    }

    public function reset_password(Request $request){
        $employee = DB::table('osa')->where('employee_id', $request->employee_id)->first();
    
        if ($employee) {
            // Generate a new password (you can use any method to generate a password)
            $newPassword = $request->employee_id;

            // Update the employee's password in the database
            DB::table('osa')->where('employee_id', $request->employee_id)->update([
                'password' => Hash::make($newPassword)
            ]);

            DB::table('users')->where('id', $request->employee_id)->update([
                'password' => Hash::make($newPassword)
            ]);

            Mail::raw("Your password has been reset. DON'T SHARE IT TO ANYONE!!! 
            Your new password is: $newPassword", function ($message) use ($employee) {
                $message->to($employee->email)
                        ->subject('Password Reset');
            });

            // Return a response indicating success
            return redirect()->back()->with('success', 'The account password has been sent to the email.');
        } 

        return redirect()->back()->with('success', 'The account password has been sent to the email.');
    }

}

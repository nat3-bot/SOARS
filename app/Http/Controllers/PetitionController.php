<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Organization;
use App\Models\Osa;
use App\Models\Students;
use App\Models\StudentOrganization;
use App\Models\Petition;



class PetitionController extends Controller
{

    

    public function new(){
        $activeUser = Session::get('userId');
        $verification1 = Students::where('student_id', $activeUser)->first();
        $verification2 = StudentOrganization::where('studentId', $activeUser)->first();
        
        if(($verification1->org1_member_status && $verification2->org1_memberstatus) == "Member"){
            return redirect()->back()->with('error', "You're a Student Leader in your Organization");
        }
        
        return view('Student.petition_new');
    }

    public function petition_new(Request $request){
        $student = DB::table('students')->where('student_id', $request->input('president'))->first();
        $studentUser = DB::table('users')->where('id', $request->input('president'))->first();
        $studentOrg = DB::table('student_organizations')->where('studentId', $request->input('president'))->first();
        
        if($student == null && $studentUser == null && $studentOrg == null){

            return redirect()->back()->with('error', 'The Student ID you inserted is incorrect');
        }

        $ln = $student->last_name;
        $fn = $student->first_name;
        $mi = $student->middle_initial;
        $course= $student->course_id;

        $name= $ln . ', '. $fn . ' ' . $mi;
        
        $petition = new Petition();
        $petition->name = $request->input('name');
        $petition->requirement_status = 'New';
        $petition->nickname = $request->input('nickname');
        $petition->type_of_organization = $request->input('type_of_organization');
        $petition->academic_course_based = $request->input('academic_course_based');
        $petition->adviser_name = $request->input('advisername');
        $petition->adviser_email = $request->input('adviseremail');
        $petition->president_studno = $request->input('president');
        $petition->president_name = $name;
        
        // Check if uploaded files exist and save their original names to the database
        if ($request->hasFile('consti_and_byLaws')) {
            $filename = 'consti_byLaws_' . uniqid() . '.' . $request->file('consti_and_byLaws')->getClientOriginalExtension();
            $request->file('consti_and_byLaws')->move(public_path('storage/consti_byLaws'), $filename);
            $petition->consti_and_byLaws = 'storage/consti_by_Laws/' . $filename;
        }
        
        if ($request->hasFile('letter_of_intent')) {
            $filename = 'letter_of_intent_' . uniqid() . '.' . $request->file('letter_of_intent')->getClientOriginalExtension();
            $request->file('letter_of_intent')->move(public_path('storage/letter_of_intent'), $filename);
            $petition->letter_of_intent = 'storage/letter_of_intent/' . $filename;
        }
        
        if ($request->hasFile('admin_endorsement')) {
            $filename = 'admin_endorsement_' . uniqid() . '.' . $request->file('admin_endorsement')->getClientOriginalExtension();
            $request->file('admin_endorsement')->move(public_path('storage/admin_endorsement'), $filename);
            $petition->admin_endorsement = 'storage/admin_endorsement/' . $filename;
        }
        
        if ($request->hasFile('signees')) {
            $filename = 'signees_' . uniqid() . '.' . $request->file('signees')->getClientOriginalExtension();
            $request->file('signees')->move(public_path('storage/signees'), $filename);
            $petition->signees = 'storage/signees/' . $filename;
        }
        
        
        // Save the petition to the database
        $petition->save();


        $osaEmp = DB::table('osa')->get();

            foreach ($osaEmp as $member) {
                Mail::raw("A New Organization has been Created by: $name from the course: $course", function ($message) use ($member) {
                    $message->to($member->email)
                        ->subject('Petition for new Org');
                });
            }

        // Redirect back with success message or do other operations
        return redirect()->back()->with('success', 'Petition created successfully.');


    } 

    public function getPetitionDetails($id) {
        $petition = DB::table('petitions')->where('president_studno',$id)->first();
        $org = DB::table('organizations')->where('filedBy', $id)->first();

        if(isset($petition)){
            if(isset($petition->comments)){
                return view('Student.petition_page', [
                    'petition' => $petition,
                ]);
            }

            else{
                $petition->comments = "This Petition hasn't been read by the Office for Students Affairs";
                return view('Student.petition_page', [
                    'petition' => $petition,
                ]);
            }
        }
        if(empty($org)){
            return redirect()->back()->with('error', 'You have not Sent a Petition to the Office for Students Affairs');

        }
        if($org->requirement_status =! "complete" ){
            $org->comments = null;
            $org->signees = null;
            return view('Student.petition_page',['petition' => $org,]);
        }
        else{
            return redirect()->back()->with('error', 'You have not Sent a Petition to the Office for Students Affairs');
        }
    }

    public function getPetitionOsa($id) {
        $petition = Petition::select('*')->first();
        if(isset($petition)){
        return view('OSA.petition_page')->with('petition', $petition);
        }
        if($petition = null){
            return redirect()->back()->with('error', 'No Petition Has been sent');
        }
    }

    public function oldOfficers(){

        
            $pres = 1;
            $officers = 0;
            return view('Student.petition_existing_officers')
            ->with('pres', $pres)
            ->with('officers', $officers);
    }

    public function oldOfficers2(){

        $pres = 0;
        $officers = 1;
        return view('Student.petition_existing_officers')
        ->with('pres', $pres)
        ->with('officers', $officers);

    }

    public function existing($id){
        $part1 = DB::table('organizations')->where('filedBy',  $id)->first();
        $part2 = DB::table('organizations')->where('requirement_status', '100')->where('filedBy', $id)->first();
        if(isset($part1)){
            if(isset($part2)){
                return redirect()->back()->with('error', "You've already Filed a Petition for an Existing Organization, please wait for the approval");
            }
            if(isset($part1->president_email)){
                return $this->oldOfficers2();

            }
            else{
                
                return redirect('/petition/officers');
            }
        }
        

        else{
        return view('Student.petition_existing')->with('error', "You've already Filed a Petition for an Existing Organization, please wait for the approval");;
        }
    }

    public function old(Request $request){
        $org = new Organization();
        $org->name = $request->input('name');
        $org->nickname = $request->input('nickname');
        $org->type_of_organization = $request->input('type_of_organization');
        $org->academic_course_based = $request->input('academic_course_based');
        $org->mission = $request->input('mission');
        $org->vision = $request->input('vision');
        $org->org_email = $request->input('org_email');
        $org->org_fb = $request->input('org_fb');
        if ($request->hasFile('logo')) {
            $filename = 'logo_' . uniqid() . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(public_path('storage/logo'), $filename);
            $org->logo = $filename;
        }
        if ($request->hasFile('consti_and_byLaws')) {
            $filename = 'consti_byLaws_' . uniqid() . '.' . $request->file('consti_and_byLaws')->getClientOriginalExtension();
            $request->file('consti_and_byLaws')->move(public_path('storage/consti_and_byLaws'), $filename);
            $org->consti_and_byLaws = $filename;
        }
        if ($request->hasFile('letter_of_intent')) {
            $filename = 'letter_of_intent_' . uniqid() . '.' . $request->file('letter_of_intent')->getClientOriginalExtension();
            $request->file('letter_of_intent')->move(public_path('storage/letter_of_intent'), $filename);
            $org->letter_of_intent = $filename;
        }
        if ($request->hasFile('admin_endorsement')) {
            $filename = 'admin_endorsement_' . uniqid() . '.' . $request->file('admin_endorsement')->getClientOriginalExtension();
            $request->file('admin_endorsement')->move(public_path('storage/admin_endorsement'), $filename);
            $org->admin_endorsement = $filename;
        }

        $Filed = Session::get('userId');

        $org->filedBy = $Filed;

        $org->save();
        $organization = Organization::where('filedBy', $Filed)->get();

        $totalColumns = 0;
        $filledColumns = 0;

        foreach ($organization as $org) {
            foreach ($org->getAttributes() as $column => $value) {
                // Exclude fields like 'id', 'filedBy', etc.
                if (!in_array($column, ['id', 'filedBy', 'created_at', 'updated_at'])) {
                    $totalColumns++;
                    if ($value !== null) {
                        $filledColumns++;
                    }
                }
            }
        }

        $percentageCompletion = ($filledColumns / $totalColumns) * 100;

        // Round the percentage to two decimal places
        $percentageCompletion = round($percentageCompletion, 2);
        Organization::where('filedBy', $Filed)->update(['requirement_status' => $percentageCompletion]);

        $orgName = $request->input('name');

        Session::put('orgName', $orgName);

        return redirect('/petition/officers');


    }


}

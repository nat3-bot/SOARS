<?php

namespace App\Http\Controllers;

use App\Events\ChatifyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Students;
use App\Models\Payment;
use App\Models\StudentOrganization;
use Omnipay\Omnipay;
use Datatables;
use Auth;

class OrganizationController extends Controller
{  
    private $gateway;
    
    public function organization(){
        $organizationAcademic = DB::table('organizations')->where('type_of_organization','=','Academic')->where('requirement_status','=','complete')->get();
        $organizationCoAcademic = DB::table('organizations')->where('type_of_organization','=','Co-Academic')->where('requirement_status','=','complete')->get();
        $organizationSocioCivic = DB::table('organizations')->where('type_of_organization','=','Socio Civic')->where('requirement_status','=','complete')->get();
        $organizationReligious = DB::table('organizations')->where('type_of_organization','=','Religious')->where('requirement_status','=','complete')->get();
        $petitions = DB::table('petitions')->get();
        $pendings = DB::table('organizations')->where('requirement_status','!=','Complete')->get();
        
        return view('OSA.organization_list')
        ->with('organizationAcademic', $organizationAcademic)
        ->with('organizationCoAcademic', $organizationCoAcademic)
        ->with('organizationSocioCivic', $organizationSocioCivic)
        ->with('organizationReligious', $organizationReligious)
        ->with('petitions', $petitions)
        ->with('pendings', $pendings);
        

    }

    public function student_organization(){
        $organizationAcademic = DB::table('organizations')->where('type_of_organization','=','Academic')->where('requirement_status','=','complete')->get();
        $organizationCoAcademic = DB::table('organizations')->where('type_of_organization','=','Co-Academic')->where('requirement_status','=','complete')->get();
        $organizationSocioCivic = DB::table('organizations')->where('type_of_organization','=','Socio Civic')->where('requirement_status','=','complete')->get();
        $organizationReligious = DB::table('organizations')->where('type_of_organization','=','Religious')->where('requirement_status','=','complete')->get();

        
        return view('OSA.organization_list')
        ->with('organizationAcademic', $organizationAcademic)
        ->with('organizationCoAcademic', $organizationCoAcademic)
        ->with('organizationSocioCivic', $organizationSocioCivic)
        ->with('organizationReligious', $organizationReligious);
        
    }

    public function new_org(){
        $organizationAcademic = DB::table('organizations')->where('type_of_organization','=','Academic')->where('requirement_status','=','complete')->get();
        $organizationCoAcademic = DB::table('organizations')->where('type_of_organization','=','Co-Academic')->where('requirement_status','=','complete')->get();
        $organizationSocioCivic = DB::table('organizations')->where('type_of_organization','=','Socio Civic')->where('requirement_status','=','complete')->get();
        $organizationReligious = DB::table('organizations')->where('type_of_organization','=','Religious')->where('requirement_status','=','complete')->get();
        $pendings = DB::table('organizations')->where('requirement_status','!=','Complete')->get();
        
        return view('student_orgs.rso_list')
        ->with('organizationAcademic', $organizationAcademic)
        ->with('organizationCoAcademic', $organizationCoAcademic)
        ->with('organizationSocioCivic', $organizationSocioCivic)
        ->with('organizationReligious', $organizationReligious)
        ->with('pendings', $pendings);
        
    }

    public function organization_page(Request $request){
    
        $id = $request->route('id');
        $org = Organization::find($id);
	    return view('OSA.organization_page')->with('org',$org);

    }

    public function rso_page(Request $request, $id)
    {
        $id = $request->route('id');
        $org = Organization::find($id);
        return view('Admin.rso_page')->with('org', $org);
    }

    public function student_organization_page(Request $request){
        
        $user = Auth::user();
        $userId = $user->id;
        // Student No

        // Retrieve the student record
        $student = DB::table('students')->where('student_id','=' ,$userId)->first();
        $studentId = $student->student_id;
        
        $student_org = DB::table('student_organizations')->where('studentId', '=', $studentId)->first(); // Use first() to get a single object
        $student_pos = $student_org->org1_memberstatus;
        $courseId = $student_org->course;
        
        
        $orgsByCourse = DB::table('organizations')->where('academic_course_based','=',$courseId)->first();
        $org = $orgsByCourse->name;

        if($student_pos == "Member"){
            $announcement1 = DB::table('announcements')->where('recipient','=', $org)->get();
            return view ('Student.org1_page_member')->with('orgsByCourse', $orgsByCourse)
            ->with('announcement1', $announcement1);

            

            
        }
        elseif($student_pos !="Member" && $student_pos != "President" && $student_pos != null){
            $totalEvent = DB::table('events')->get();
            $totalMember = DB::table('students')->get();
            $totalOrg= DB::table('organizations')->get();
            $activities = DB::table('events')->select('activity_title', 'activity_start_date', 'activity_end_date', 'activity_start_time', 'activity_end_time')->get();
            $announcement1 = DB::table('announcements')->where('recipient','=', $org)->get();
            return view ('Student.org1_page_sl')
            ->with('totalEvent', $totalEvent)
            ->with('totalMember',$totalMember)
            ->with('totalOrg', $totalOrg)
            ->with('activities', $activities)
            ->with('announcement1', $announcement1)
            ->with('orgsByCourse', $orgsByCourse);

        }
        elseif ($student_pos == "President"){
            $totalEvent = DB::table('events')->get();
            $totalMember = DB::table('students')->get();
            $totalOrg= DB::table('organizations')->get();
            $activities = DB::table('events')->select('activity_title', 'activity_start_date', 'activity_end_date', 'activity_start_time', 'activity_end_time')->get();
            $announcement1 = DB::table('announcements')->where('recipient','=', $org)->get();
            return view ('Student.org1_page_president')
            ->with('totalEvent', $totalEvent)
            ->with('totalMember',$totalMember)
            ->with('totalOrg', $totalOrg)
            ->with('activities', $activities)
            ->with('announcement1', $announcement1)
            ->with('orgsByCourse', $orgsByCourse);

        }
        
    
    }

    public function student_organization_page2(Request $request){
        
        $user = Auth::user();
        $userId = $user->id;
        // Student No

        // Retrieve the student record
        $student = DB::table('students')->where('student_id','=' ,$userId)->where('organization2', '!=', null)->first();
        $studentId = $student->student_id;
        
        $student_org = DB::table('student_organizations')->where('studentId', '=', $studentId)->first(); // Use first() to get a single object
        $student_pos = $student_org->org2_memberstatus;
        $orgName = $student_org->org2;

        $org = $orgName;
        $organization = DB::table('organizations')->where('name', '=', $orgName)->first();

        if($student_pos == "Applying Member" || $student_pos == "Paid"){            
            $org2status = DB::table('student_organizations')->where('studentId',$userId)->first();
            if (isset($org2status))
            {
                $org = DB::table('organizations')->where('name', '=', $orgName)->first();
                return view('Student.organization_page')->with('org',$org)->with('org2status', $org2status);    
            }

        }

        if($student_pos == "Member"){
            $announcement1 = DB::table('announcements')->where('recipient','=', $org)->get();
            return view ('Student.org2_page_member')->with('organization', $organization)
            ->with('announcement1', $announcement1);

            

            
        }
        if($student_pos !="Member" && $student_pos != "President" && $student_pos != null && $student_pos != "Applying Member"){
            $totalEvent = DB::table('events')->get();
            $totalMember = DB::table('students')->get();
            $totalOrg= DB::table('organizations')->get();
            $activities = DB::table('events')
            //->where('organization_name', '=', $org) 
            ->select('activity_title', 'activity_start_date', 'activity_end_date', 'activity_start_time', 'activity_end_time')
            ->where('organization_name', $org)->get();
            $announcement1 = DB::table('announcements')->where('recipient','=', $org)->get();
            return view ('Student.org2_page_sl')
            ->with('totalEvent', $totalEvent)
            ->with('totalMember',$totalMember)
            ->with('totalOrg', $totalOrg)
            ->with('activities', $activities)
            ->with('announcement1', $announcement1)
            ->with('organization', $organization);

        }
        if ($student_pos == "President"){
            $totalEvent = DB::table('events')->get();
            $totalMember = DB::table('students')->get();
            $totalOrg= DB::table('organizations')->get();
            $activities = DB::table('events')
            //->where('organization_name', '=', $org)
            ->select('activity_title', 'activity_start_date', 'activity_end_date', 'activity_start_time', 'activity_end_time')
            ->where('organization_name', $org)->get();
            $announcement1 = DB::table('announcements')->where('recipient','=', $org)->get();
            return view ('Student.org2_page_president')
            ->with('totalEvent', $totalEvent)
            ->with('totalMember',$totalMember)
            ->with('totalOrg', $totalOrg)
            ->with('activities', $activities)
            ->with('announcement1', $announcement1)
            ->with('organization', $organization);

        }
        
    
    }


    public function newOrganization(Request $request){

        $fieldsToCheckForNull = [
            'name',
            'nickname',
            'type_of_organization',
            'academic_course_based',
            'mission',
            'vision',
            'org_email',
            'org_fb',
            'adviser_name',
            'adviser_email',
            
        ];
    
        $nullCount = 41;
    
        foreach ($fieldsToCheckForNull as $fieldName) {
            if (request($fieldName) === null) {
                $nullCount--;
            }
        }
    
        $total = ($nullCount / 41) * 100;

         // Determine which fields should be nullable based on the selected organization type
        $nullableFields = [
            'president_studno',
            'vp_internal_studno',
            'vp_external_studno',
            'secretary_studno',
            'treasurer_studno',
            'auditor_studno',
            'pro_studno',
            'ausg_rep_studno'
        ];

        foreach ($nullableFields as $field) {
            // If the organization type is "Academic", set nullable fields to null
            if (request('type_of_organization') === 'Academic') {
                $request[$field] = null;
            }
        }
    
        $logoPath = $this->handleFileUpload($request, 'logo', 'storage/logo/');
        $constiPath = $this->handleFileUpload($request, 'consti_and_byLaws', 'storage/consti_and_byLaws/');
        $letterPath = $this->handleFileUpload($request, 'letter_of_intent', 'storage/letter_of_intent/');
        $adminEndorsementPath = $this->handleFileUpload($request, 'admin_endorsement', 'storage/admin_endorsement/');
        
    
        $organizationData = [
            'requirement_status' => $total,
            'name' => request('name'),
            'nickname' => request('nickname'),
            'type_of_organization' => request('type_of_organization'),
            'academic_course_based' => request('academic_course_based'),
            'mission' => request('mission'),
            'vision' => request('vision'),
            'org_email' => request('org_email'),
            'org_fb' => request('org_fb'),
            'logo' => $logoPath,
            'consti_and_byLaws' => $constiPath,
            'letter_of_intent' => $letterPath,
            'admin_endorsement' => $adminEndorsementPath,
            'adviser_name' => request('adviser_name'),
            'adviser_email' => request('adviser_email'),
        ];
    
        Organization::create($organizationData);
    
        return redirect('/osaemp/organization_list')
            ->with('success', 'You have started to create a New Organization');
    }

    public function orgNew(Request $request){

        $fieldsToCheckForNull = [
            'name',
            'nickname',
            'type_of_organization',
            'academic_course_based',
            'mission',
            'vision',
            'org_email',
            'org_fb',
            'adviser_name',
            'adviser_email',
            'ausg_rep_studno',
            'ausg_rep_name',
            'ausg_rep_email',
            'president_studno',
            'president_name',
            'president_email',
            'vp_internal_studno',
            'vp_internal_name',
            'vp_internal_email',
            'vp_external_studno',
            'vp_external_name',
            'vp_external_email',
            'secretary_studno',
            'secretary_name',
            'secretary_email',
            'treasurer_studno',
            'treasurer_name',
            'treasurer_email',
            'auditor_studno',
            'auditor_name',
            'auditor_email',
            'pro_studno',
            'pro_name',
            'pro_email'
        ];
    
        $nullCount = 41;
    
        foreach ($fieldsToCheckForNull as $fieldName) {
            if (request($fieldName) === null) {
                $nullCount--;
            }
        }
    
        $total = ($nullCount / 41) * 100;
    
        $logoPath = $this->handleFileUpload($request, 'logo', 'storage/logo/');
        $constiPath = $this->handleFileUpload($request, 'consti_and_byLaws', 'storage/consti_and_byLaws/');
        $letterPath = $this->handleFileUpload($request, 'letter_of_intent', 'storage/letter_of_intent/');
        $adminEndorsementPath = $this->handleFileUpload($request, 'admin_endorsement', 'storage/admin_endorsement/');
        
    
        $organizationData = [
            'requirement_status' => $total,
            'name' => request('name'),
            'nickname' => request('nickname'),
            'type_of_organization' => request('type_of_organization'),
            'academic_course_based' => request('academic_course_based'),
            'mission' => request('mission'),
            'vision' => request('vision'),
            'org_email' => request('org_email'),
            'org_fb' => request('org_fb'),
            'logo' => $logoPath,
            'consti_and_byLaws' => $constiPath,
            'letter_of_intent' => $letterPath,
            'admin_endorsement' => $adminEndorsementPath,
            'adviser_name' => request('adviser_name'),
            'adviser_email' => request('adviser_email'),
            'ausg_rep_studno' => request('ausg_rep_studno'),

            'ausg_rep_name' => request('ausg_rep_name'),
            'ausg_rep_email' => request('ausg_rep_email'),
            'president_studno' => request('president_studno'),

            'president_name' => request('president_name'),
            'president_email' => request('president_email'),
            'vp_internal_studno' => request('vp_internal_studno'),

            'vp_internal_name' => request('vp_internal_name'),
            'vp_internal_email' => request('vp_internal_email'),
            'vp_external_studno' => request('vp_external_studno'),
            
            'vp_external_name' => request('vp_external_name'),
            'vp_external_email' => request('vp_external_email'),
            'secretary_studno' => request('secretary_studno'),
            
            'secretary_name' => request('secretary_name'),
            'secretary_email' => request('secretary_email'),
            'treasurer_studno' => request('treasurer_studno'),
            
            'treasurer_name' => request('treasurer_name'),
            'treasurer_email' => request('treasurer_email'),
            'auditor_studno' => request('auditor_studno'),
            
            'auditor_name' => request('auditor_name'),
            'auditor_email' => request('auditor_email'),
            'pro_studno' => request('pro_studno'),
            
            'pro_name' => request('pro_name'),
            'pro_email' => request('pro_email'),
        ];
    
        Organization::create($organizationData);
    
        return redirect('/rso_list')
            ->with('success', 'You have started to create a New Organization');
    }

    // Method to update org1_member_status for a specific position
    private function updateStudentRoles(Request $request)
    {
        $orgId = Session::get('orgId');
        $org = Organization::where('id',$orgId)->first();
        $officerPositions = [
            'President' => 'president_studno',
            'AUSG_Rep' => 'ausg_rep_studno', 
            'VP-I' => 'vp_internal_studno', 
            'VP-E' => 'vp_external_studno', 
            'Secretary' =>'secretary_studno', 
            'Treasurer'=> 'treasurer_studno', 
            'Auditor'=> 'auditor_studno', 
            'Pro'=>'pro_studno',
        ];

        

        if($org->type_of_organization == "Academic"){
        // Loop through each officer position and update the student role
            foreach ($officerPositions as $position => $fields) {
                // Check if the field is an array (for Student Leader) or a string (for President)
                $field = is_array($fields) ? $fields : [$fields];
                
                foreach ($field as $inputField) {
                    $studentNo = $request->input($inputField);
                    if ($studentNo) {
                        // Validate student number format
                        if (!preg_match('/^\d{9}$/', $studentNo)) {
                            // Invalid student number format
                            return redirect()->back()->with('error', 'Invalid student number format.');
                        }
                        
                        // Find the student by their student number
                        $student = Students::where('student_id', $studentNo)->first();
                        
                        if (!$student) {
                            // Student not found
                            return redirect()->back()->with('error', 'Student with student number ' . $studentNo . ' not found.');
                        }
                        
                        // Check if the student is a member of organization1
                        if ($student->org1_member_status === 'Member') {
                            // Update the student's role
                            $student->organization1 = $org->nickname;
                            $student->org1_member_status = $position;
                            $student->save();

                            DB::table('student_organizations')
                                ->where('studentId', $studentNo)
                                ->update([
                                    'org1' => $org->nickname,
                                    'org1_memberstatus' => $position]);
                            
                                // If the student is a "Student Leader" and being promoted to "President", update their role
                                if ($position === 'President' && $student->org1_member_status === 'AUSG_Rep') {
                                    $student->organization1 = $org->nickname;
                                    $student->org1_member_status = $position;
                                    $student->save();
                                }
                                
                                // Update the student's organization role in student_organizations table
                                DB::table('student_organizations')
                                    ->where('studentId', $studentNo)
                                    ->update([
                                        'org1' => $org->nickname,
                                        'org1_memberstatus' => $position]);
                        } 
                        elseif($student->org1_member_status == null && $student->org1 == null ) {
                            $student->organization1 = $org->nickname;
                            $student->org1_member_status = $position;
                            $student->save();

                            DB::table('student_organizations')
                                ->where('studentId', $studentNo)
                                ->update([
                                    'org1' => $org->nickname,
                                    'org1_memberstatus' => $position]);
                            

                            // If not a member of organization1, skip updating roles
                            return redirect()->back()->with('error', 'Student with student number ' . $studentNo . ' is not a member of Organization1.');
                        }
                    }
                }
            }
        }
        else{
            // Loop through each officer position and update the student role
            foreach ($officerPositions as $position => $fields) {
                // Check if the field is an array (for Student Leader) or a string (for President)
                $field = is_array($fields) ? $fields : [$fields];
                
                foreach ($field as $inputField) {
                    $studentNo = $request->input($inputField);
                    
                    if ($studentNo) {
                        // Validate student number format
                        if (!preg_match('/^\d{9}$/', $studentNo)) {
                            // Invalid student number format
                            return redirect()->back()->with('error', 'Invalid student number format.');
                        }
                        
                        // Find the student by their student number
                        $student = Students::where('student_id', $studentNo)->first();
                        
                        if (!$student) {
                            // Student not found
                            return redirect()->back()->with('error', 'Student with student number ' . $studentNo . ' not found.');
                        }
                        
                        // Check if the student is a member of organization1
                        if ($student->org2_member_status === 'Member') {
                            // Update the student's role
                            $student->organization2 = $org->nickname;
                            $student->org2_member_status = $position;
                            $student->save();

                            DB::table('student_organizations')
                                ->where('studentId', $studentNo)
                                ->update([
                                    'org2' => $org->nickname,
                                    'org2_memberstatus' => $position]);
                            
                                // If the student is a "Student Leader" and being promoted to "President", update their role
                                if ($position === 'President' && $student->org2_member_status === 'AUSG_Rep') {
                                    $student->organization2 = $org->nickname;
                                    $student->org2_member_status = $position;
                                    $student->save();
                                }
                                
                                // Update the student's organization role in student_organizations table
                                DB::table('student_organizations')
                                    ->where('studentId', $studentNo)
                                    ->update([
                                        'org2' => $org->nickname,
                                        'org2_memberstatus' => $position]);
                        } 
                        elseif($student->org2_member_status == null && $student->org2 == null ) {
                            $student->organization2 = $org->nickname;
                            $student->org2_member_status = $position;
                            $student->save();

                            DB::table('student_organizations')
                                ->where('studentId', $studentNo)
                                ->update([
                                    'org2' => $org->nickname,
                                    'org2_memberstatus' => $position]);
                            

                            // If not a member of organization1, skip updating roles
                            return redirect()->back()->with('error', 'Student with student number ' . $studentNo . ' is not a member of Organization1.');
                        }
                    }
                }
            }

        }
        
        return redirect()->back()->with('success', 'Student roles updated successfully.');
    }

    
    private function handleFileUpload($request, $fileField, $directory)
    {
        $filePath = null;
    
        if ($request->hasFile($fileField)) {
            $file = $request->file($fileField);
            $fileName = $fileField . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($directory), $fileName);
            $filePath = $fileName;
        }
    
        return $filePath;
    }
    

    public function org_pending_edit_view(Request $request, $id){
        
        $id = $request->route('id');
        $org = Organization::find($id);
        
	    return view('OSA.organization_pending_edit')->with('org',$org);
        
    }

    public function org_pending_edit_student_view(Request $request, $id){
        
        $id = $request->route('id');
        $org = Organization::find($id);
        $user = Auth::user();
        $org2status = DB::table('student_organizations')->where('studentId', $user->id)->first();
        $registration_status = DB::table('registrations')->latest()->first();
        $regstatus = $registration_status->registration;
        return view('Student.organization_page')
        ->with('org', $org)
        ->with('org2status', $org2status)
        ->with('regstatus', $regstatus);
}


    public function org_pending(Request $request, $id){
        
        $id = $request->route('id');
        $org = Organization::find($id);
        Session::put('orgId', $id);
        $this->updateStudentRoles($request);
	    return view('Admin.org_pending')->with('org',$org);
        
    }
    
    public function org_delete(Request $request, $id){
        $id = $request->route('id');
        $org = Organization::find($id);
        if ($org == null) {
            return redirect()->back()->with('error', 'Organization not found');
        }
        $org->delete();
        return view('Admin.org_list')->with('success', 'Organization page deleted successfully');
        
    }
    
    public function org_pending_edit_save(Request $request, $id)
    {
        Session::put('orgId', $id);
        $this->updateStudentRoles($request);
        if ($request->has('edited') ) {
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            if($org->requirement_status != 'complete'){
                $fieldsToCheckForNull = [
                    'name', 'nickname', 'type_of_organization','academic_course_based', 'mission', 'vision', 'org_email', 'org_fb',
                    'adviser_name', 'adviser_email', 'ausg_rep_studno', 'ausg_rep_name', 'ausg_rep_email',
                    'president_studno', 'president_name', 'president_email', 'vp_internal_studno', 'vp_internal_name',
                    'vp_internal_email', 'vp_external_studno', 'vp_external_name', 'vp_external_email', 'secretary_studno',
                    'secretary_name', 'secretary_email', 'treasurer_studno', 'treasurer_name', 'treasurer_email',
                    'auditor_studno', 'auditor_name', 'auditor_email', 'pro_studno', 'pro_name', 'pro_email'
                ];

                // Count the total number of fields to be checked
                $totalFields = count($fieldsToCheckForNull);

                // Initialize the null count
                $nullCount = 0;

                foreach ($fieldsToCheckForNull as $fieldName) {
                    // Check if the field exists in the request
                    if ($request->has($fieldName)) {
                        // Increment the null count if the field is null
                        if (is_null(request($fieldName))) {
                            $nullCount++;
                        }
                    } else {
                        // If the field doesn't exist in the request, consider it null
                        $nullCount++;
                    }
                }

                // Calculate the percentage completion
                $percentage = (($totalFields - $nullCount) / $totalFields) * 100;


                // Handle file uploads
                $imageFields = [
                    'logo' => 'storage/logo/',
                    'consti_and_byLaws' => 'storage/consti_and_byLaws/',
                    'letter_of_intent' => 'storage/letter_of_intent/',
                    'admin_endorsement' => 'storage/admin_endorsement/',
                    
                ];

                foreach ($imageFields as $field => $directory) {
                    if ($request->hasFile($field)) {
                        if ($org->$field) {
                            $oldFilePath = public_path($directory . $org->$field);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        $file = $request->file($field);
                        $fileName = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path($directory), $fileName);
                        $org->$field = $fileName;
                    } elseif (is_null($org->$field)) {
                        $org->$field = null;
                        $percentage -= 1;
                    }
                }

                $org->name = $request->input('name');
                $org->nickname = $request->input('nickname');
                $org->type_of_organization = $request->input('type_of_organization');
                $org->requirement_status = $percentage;
                $org->academic_course_based = $request->input('academic_course_based');
                $org->mission = $request->input('mission');
                $org->vision = $request->input('vision');
                $org->org_email = $request->input('org_email');
                $org->org_fb = $request->input('org_fb');
                $org->adviser_name = $request->input('adviser_name');
                $org->adviser_email = $request->input('adviser_email');
                $org->ausg_rep_studno = $request->input('ausg_rep_studno');
                $org->ausg_rep_name = $request->input('ausg_rep_name');
                $org->ausg_rep_email = $request->input('ausg_rep_email');
                //President
                $org->president_studno = $request->input('president_studno');
                $org->president_name = $request->input('president_name');
                $org->president_email = $request->input('president_email');
                //VPI
                $org->vp_internal_studno = $request->input('vp_internal_studno');
                $org->vp_internal_name = $request->input('vp_internal_name');
                $org->vp_internal_email = $request->input('vp_internal_email');
                //VPE
                $org->vp_external_studno = $request->input('vp_external_studno');
                $org->vp_external_name = $request->input('vp_external_name');
                $org->vp_external_email = $request->input('vp_external_email');
                //Sec
                $org->secretary_studno = $request->input('secretary_studno');
                $org->secretary_name = $request->input('secretary_name');
                $org->secretary_email = $request->input('secretary_email');
                //Tres
                $org->treasurer_studno = $request->input('treasurer_studno');
                $org->treasurer_name = $request->input('treasurer_name');
                $org->treasurer_email = $request->input('treasurer_email');
                //Audit
                $org->auditor_studno = $request->input('auditor_studno');
                $org->auditor_name = $request->input('auditor_name');
                $org->auditor_email = $request->input('auditor_email');
                //PRO
                $org->pro_studno = $request->input('pro_studno');
                $org->pro_name = $request->input('pro_name');
                $org->pro_email = $request->input('pro_email');
                $org->filedBy = null;
                // Save the changes to the organization
                $org->save();

                return redirect('/osaemp/organization_list')->with('success', 'You have updated ' . $org->name);
            }


            if($org->requirement_status == 'complete'){

                // Handle file uploads
                $imageFields = [
                    'logo' => 'storage/logo/',
                    'consti_and_byLaws' => 'storage/consti_and_byLaws/',
                    'letter_of_intent' => 'storage/letter_of_intent/',
                    'admin_endorsement' => 'storage/admin_endorsement/',
                    
                ];

                foreach ($imageFields as $field => $directory) {
                    if ($request->hasFile($field)) {
                        if ($org->$field) {
                            $oldFilePath = public_path($directory . $org->$field);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        $file = $request->file($field);
                        $fileName = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path($directory), $fileName);
                        $org->$field = $fileName;
                    } elseif (is_null($org->$field)) {
                        $org->$field = null;
                        $percentage -= 1;
                    }
                }

                $org->name = $request->input('name');
                $org->nickname = $request->input('nickname');
                $org->type_of_organization = $request->input('type_of_organization');
                $org->requirement_status = $request->input('requirement_status');
                $org->academic_course_based = $request->input('academic_course_based');
                $org->mission = $request->input('mission');
                $org->vision = $request->input('vision');
                $org->org_email = $request->input('org_email');
                $org->org_fb = $request->input('org_fb');
                $org->adviser_name = $request->input('adviser_name');
                $org->adviser_email = $request->input('adviser_email');
                $org->ausg_rep_studno = $request->input('ausg_rep_studno');
                $org->ausg_rep_name = $request->input('ausg_rep_name');
                $org->ausg_rep_email = $request->input('ausg_rep_email');
                //President
                $org->president_studno = $request->input('president_studno');
                $org->president_name = $request->input('president_name');
                $org->president_email = $request->input('president_email');
                //VPI
                $org->vp_internal_studno = $request->input('vp_internal_studno');
                $org->vp_internal_name = $request->input('vp_internal_name');
                $org->vp_internal_email = $request->input('vp_internal_email');
                //VPE
                $org->vp_external_studno = $request->input('vp_external_studno');
                $org->vp_external_name = $request->input('vp_external_name');
                $org->vp_external_email = $request->input('vp_external_email');
                //Sec
                $org->secretary_studno = $request->input('secretary_studno');
                $org->secretary_name = $request->input('secretary_name');
                $org->secretary_email = $request->input('secretary_email');
                //Tres
                $org->treasurer_studno = $request->input('treasurer_studno');
                $org->treasurer_name = $request->input('treasurer_name');
                $org->treasurer_email = $request->input('treasurer_email');
                //Audit
                $org->auditor_studno = $request->input('auditor_studno');
                $org->auditor_name = $request->input('auditor_name');
                $org->auditor_email = $request->input('auditor_email');
                //PRO
                $org->pro_studno = $request->input('pro_studno');
                $org->pro_name = $request->input('pro_name');
                $org->pro_email = $request->input('pro_email');
                $org->filedBy = null;
                // Save the changes to the organization
                $org->save();

                return redirect('/osaemp/organization_list/organization_page/'.$org->id)->with('success', 'You have updated ' . $org->name);

            }
        }

        if ($request->has('cancel')){
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            return redirect('/osaemp/organization_list');

        }

        if ($request->has('org_page')){
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            return redirect('/osaemp/organization_list/organization_page/'.$orgId);

        }

        if ($request->has('complete')) {
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            $org->update([
                'requirement_status' => 'complete'
            ]);
            return redirect('/osaemp/organization_list')->with('success', 'You have completed the requirements for ' . $org->name);
        }
    }

    public function org_pending_save(Request $request, $id)
    {
        Session::put('orgId', $id);
        $this->updateStudentRoles($request);
        if ($request->has('edited')) {
            $orgId = $id;
            $org = Organization::findOrFail($orgId);

            $fieldsToCheckForNull = [
                'name', 'nickname', 'type_of_organization', 'mission', 'vision', 'org_email', 'org_fb',
                'adviser_name', 'adviser_email', 'ausg_rep_studno', 'ausg_rep_name', 'ausg_rep_email',
                'president_studno', 'president_name', 'president_email', 'vp_internal_studno', 'vp_internal_name',
                'vp_internal_email', 'vp_external_studno', 'vp_external_name', 'vp_external_email', 'secretary_studno',
                'secretary_name', 'secretary_email', 'treasurer_studno', 'treasurer_name', 'treasurer_email',
                'auditor_studno', 'auditor_name', 'auditor_email', 'pro_studno', 'pro_name', 'pro_email'
            ];

            // Count the total number of fields to be checked
            $totalFields = count($fieldsToCheckForNull);

            // Initialize the null count
            $nullCount = 0;

            foreach ($fieldsToCheckForNull as $fieldName) {
                // Check if the field exists in the request
                if ($request->has($fieldName)) {
                    // Increment the null count if the field is null
                    if (is_null(request($fieldName))) {
                        $nullCount++;
                    }
                } else {
                    // If the field doesn't exist in the request, consider it null
                    $nullCount++;
                }
            }

            // Calculate the percentage completion
            $percentage = (($totalFields - $nullCount) / $totalFields) * 100;


            // Handle file uploads
            $imageFields = [
                'logo' => 'storage/logo/',
                'consti_and_byLaws' => 'storage/consti_and_byLaws/',
                'letter_of_intent' => 'storage/letter_of_intent/',
                'admin_endorsement' => 'storage/admin_endorsement/',
                
            ];

            foreach ($imageFields as $field => $directory) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path($directory), $fileName);
                    $org->$field = $fileName;
                } elseif (is_null($org->$field)) {
                    $org->$field = null;
                    $percentage -= 1;
                }
            }

            $org->requirement_status = $percentage;
            $org->name = $request->input('name');
                $org->nickname = $request->input('nickname');
                $org->type_of_organization = $request->input('type_of_organization');
                $org->requirement_status = $percentage;
                $org->academic_course_based = $request->input('academic_course_based');
                $org->mission = $request->input('mission');
                $org->vision = $request->input('vision');
                $org->org_email = $request->input('org_email');
                $org->org_fb = $request->input('org_fb');
                $org->adviser_name = $request->input('adviser_name');
                $org->adviser_email = $request->input('adviser_email');
                $org->ausg_rep_studno = $request->input('ausg_rep_studno');
                $org->ausg_rep_name = $request->input('ausg_rep_name');
                $org->ausg_rep_email = $request->input('ausg_rep_email');
                //President
                $org->president_studno = $request->input('president_studno');
                $org->president_name = $request->input('president_name');
                $org->president_email = $request->input('president_email');
                //VPI
                $org->vp_internal_studno = $request->input('vp_internal_studno');
                $org->vp_internal_name = $request->input('vp_internal_name');
                $org->vp_internal_email = $request->input('vp_internal_email');
                //VPE
                $org->vp_external_studno = $request->input('vp_external_studno');
                $org->vp_external_name = $request->input('vp_external_name');
                $org->vp_external_email = $request->input('vp_external_email');
                //Sec
                $org->secretary_studno = $request->input('secretary_studno');
                $org->secretary_name = $request->input('secretary_name');
                $org->secretary_email = $request->input('secretary_email');
                //Tres
                $org->treasurer_studno = $request->input('treasurer_studno');
                $org->treasurer_name = $request->input('treasurer_name');
                $org->treasurer_email = $request->input('treasurer_email');
                //Audit
                $org->auditor_studno = $request->input('auditor_studno');
                $org->auditor_name = $request->input('auditor_name');
                $org->auditor_email = $request->input('auditor_email');
                //PRO
                $org->pro_studno = $request->input('pro_studno');
                $org->pro_name = $request->input('pro_name');
                $org->pro_email = $request->input('pro_email');

            // Save the changes to the organization
            $org->save();

            return redirect('/rso_list')->with('success', 'You have updated ' . $org->name);
        }

        if ($request->has('type_of_organization_change')) {
            $selectedType = $request->input('type_of_organization');
    
            // Logic to determine which fields are required based on the selected organization type
            if ($selectedType === 'Academic') {
                $nullableFields = [
                    'president_studno',
                    'vp_internal_studno',
                    'vp_external_studno',
                    'secretary_studno',
                    'treasurer_studno',
                    'auditor_studno',
                    'pro_studno',
                    'ausg_rep_studno'
                ];
    
                // Remove the required attribute from nullable fields
                foreach ($nullableFields as $fieldName) {
                    $org->$fieldName = null; 
                     
                }
            } else {
                // Add the required attribute to all fields
                
            }
            
            $org->save();
            // Redirect back to the organization page
            return redirect('/rso_list/rso_page/'.$orgId);
        }
            
        if ($request->has('cancel')){
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            return redirect('/rso_list');

        }

        if ($request->has('org_page')){
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            return redirect('/rso_list/rso_page/'.$orgId);

        }

        if ($request->has('complete')) {
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            $org->update([
                'requirement_status' => 'complete'
            ]);

            return redirect('/rso_list')->with('success', 'You have completed the requirements for ' . $org->name);
        }
    }


    public function org_pending_delete($id)
    {
        $organization = Organization::find($id);

        if (!$organization) {
            // If organization not found, return an error response
            return response()->json(['error' => 'Organization not found'], 404);
        }
        // Delete the organization
        $organization->delete();

        // Redirect back with a success message
        return redirect('/osaemp/organization_activation')->with('success', 'Organization deleted successfully');
    }


    public function student_org_edit_view(Request $request, $id){
        
        $id = $request->route('id');
        $org = Organization::find($id);
	    return view('Student.organization_edit_sl')->with('org',$org);
        
    }

    public function student_org_edit_save(Request $request, $id){
        if ($request->has('edited') ) {
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
             if($org->requirement_status == 'complete'){

                // Handle file uploads
                $imageFields = [
                    'logo' => 'storage/logo/',
                    'consti_and_byLaws' => 'storage/consti_and_byLaws/',
                    'letter_of_intent' => 'storage/letter_of_intent/',
                    'admin_endorsement' => 'storage/admin_endorsement/',
                    
                ];

                foreach ($imageFields as $field => $directory) {
                    if ($request->hasFile($field)) {
                        if ($org->$field) {
                            $oldFilePath = public_path($directory . $org->$field);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        $file = $request->file($field);
                        $fileName = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path($directory), $fileName);
                        $org->$field = $fileName;
                    } elseif (is_null($org->$field)) {
                        $org->$field = null;
                        
                    }
                }

                $org->name = $request->input('name');
                $org->nickname = $request->input('nickname');
                $org->type_of_organization = $request->input('type_of_organization');
                $org->requirement_status = $request->input('requirement_status');
                $org->academic_course_based = $request->input('academic_course_based');
                $org->mission = $request->input('mission');
                $org->vision = $request->input('vision');
                $org->org_email = $request->input('org_email');
                $org->org_fb = $request->input('org_fb');
                
                
                $org->save();

                return redirect('/student/org1_page')->with('success', 'You have updated ' . $org->name);
            }
        }

        if ($request->has('org_page')){
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            return redirect('/student/org1_page');

        }
    }

    public function president_org_edit_view(Request $request, $id){
        $id = $request->route('id');
        $org = Organization::find($id);
	    return view('Student.organization_edit_president')->with('org',$org);
        
    }

    public function president_org_edit_save(Request $request, $id){
        Session::put('orgId', $id);
        $org = Organization::find($id);
        $this->updateStudentRoles($request);
        if ($request->has('edited') ) {
            if($org->requirement_status == 'complete'){

                // Handle file uploads
                $imageFields = [
                    'logo' => 'storage/logo/',
                    'consti_and_byLaws' => 'storage/consti_and_byLaws/',
                    'letter_of_intent' => 'storage/letter_of_intent/',
                    'admin_endorsement' => 'storage/admin_endorsement/',
                    
                ];

                foreach ($imageFields as $field => $directory) {
                    if ($request->hasFile($field)) {
                        if ($org->$field) {
                            $oldFilePath = public_path($directory . $org->$field);
                            if (file_exists($oldFilePath)) {
                                unlink($oldFilePath);
                            }
                        }
                        $file = $request->file($field);
                        $fileName = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path($directory), $fileName);
                        $org->$field = $fileName;
                    } elseif (is_null($org->$field)) {
                        $org->$field = null;
                        
                    }
                }

                $org->name = $request->input('name');
                $org->nickname = $request->input('nickname');
                $org->type_of_organization = $request->input('type_of_organization');
                $org->requirement_status = 'complete';
                $org->academic_course_based = $request->input('academic_course_based');
                $org->mission = $request->input('mission');
                $org->vision = $request->input('vision');
                $org->org_email = $request->input('org_email');
                $org->org_fb = $request->input('org_fb');
                $org->adviser_name = $request->input('adviser_name');
                $org->adviser_email = $request->input('adviser_email');
                $org->ausg_rep_studno = $request->input('ausg_rep_studno');
                $org->ausg_rep_name = $request->input('ausg_rep_name');
                $org->ausg_rep_email = $request->input('ausg_rep_email');
                //President
                $org->president_studno = $request->input('president_studno');
                $org->president_name = $request->input('president_name');
                $org->president_email = $request->input('president_email');
                //VPI
                $org->vp_internal_studno = $request->input('vp_internal_studno');
                $org->vp_internal_name = $request->input('vp_internal_name');
                $org->vp_internal_email = $request->input('vp_internal_email');
                //VPE
                $org->vp_external_studno = $request->input('vp_external_studno');
                $org->vp_external_name = $request->input('vp_external_name');
                $org->vp_external_email = $request->input('vp_external_email');
                //Sec
                $org->secretary_studno = $request->input('secretary_studno');
                $org->secretary_name = $request->input('secretary_name');
                $org->secretary_email = $request->input('secretary_email');
                //Tres
                $org->treasurer_studno = $request->input('treasurer_studno');
                $org->treasurer_name = $request->input('treasurer_name');
                $org->treasurer_email = $request->input('treasurer_email');
                //Audit
                $org->auditor_studno = $request->input('auditor_studno');
                $org->auditor_name = $request->input('auditor_name');
                $org->auditor_email = $request->input('auditor_email');
                //PRO
                $org->pro_studno = $request->input('pro_studno');
                $org->pro_name = $request->input('pro_name');
                $org->pro_email = $request->input('pro_email');
                // Save the changes to the organization
                $org->save();
                
                if($request->input('type_of_organization') == "Academic"){
                return Redirect('/student/org1_page')->with('success', 'You have updated ' . $org->name);
                }
                else{
                    return Redirect('/student/org2_page')->with('success', 'You have updated ' . $org->name);

                }

            }
        }

        if ($request->has('org_page')){
            $orgId = $id;
            $org = Organization::findOrFail($orgId);
            return redirect('Student.org1_page_president');

        }
    }


    public function register($id, Request $request){


        $user = Auth::user();
        $userId = $user->id;
        // Student No

        // Retrieve the student record
        $student = DB::table('students')->where('student_id','=' ,$userId)->first();
        $studentId = $student->student_id;
        
        $student_org = DB::table('student_organizations')->where('studentid', '=', $studentId)->first(); // Use first() to get a single object
        $student_pos = $student_org->org1_memberstatus;
        $courseId = $student_org->course;
        
        $id = $request->route('id');
        $org = Organization::find($id);
        $orgid = $org->id;
        $orgname = $org->name;

        

        if(($student_org->org2 == null && $student_org->org2_memberstatus == null) && ($student->organization2 ==null && $student->org2_member_status==null)){
            DB::table('student_organizations')->where('studentId',$userId)->update(['org2' => $orgname, 'org2_memberstatus' => 'Applying Member']);
            DB::table('students')->where('student_id',$userId)->update(['organization2'=> $orgname, 'org2_member_status'=>'Applying Member']);
            return redirect()->back()->with('success', 'You are now a Member, please pay a sum of 200 Pesos');
        }
        elseif(($student_org->org2 != null && ($student_org->org2_memberstatus == 'Member' || $student_org->org2_memberstatus == 'Applying Member' ||
        $student_org->org2_memberstatus == 'President' || $student_org->org2_memberstatus == 'SL'))
         && ($student->organization2 != null && ($student->org2_member_status == 'Member' || $student->org2_member_status == 'Applying Member' ||
         $student->org2_member_status == 'President' || $student->org2_member_status == 'SL'))){

            Session::put('orgid', $orgid);
            Session::put('orgname', $orgname);
            return redirect('paypal-payment');

        }
        
    }

    public function cancel_register($id, Request $request){


        $user = Auth::user();
        $userId = $user->id;
        // Student No

        // Retrieve the student record
        $student = DB::table('students')->where('student_id','=' ,$userId)->first();
        $studentId = $student->student_id;
        
        $student_org = DB::table('student_organizations')->where('studentid', '=', $studentId)->first(); // Use first() to get a single object
        $student_pos = $student_org->org1_memberstatus;
        $courseId = $student_org->course;
        
        $id = $request->route('id');
        $org = Organization::find($id);
        $orgid = $org->id;
        $orgname = $org->name;

        

        if(($student_org->org2 != null && $student_org->org2_memberstatus != null) && ($student->organization2 != null && $student->org2_member_status!=null)){
            DB::table('student_organizations')->where('studentId',$userId)->update(['org2' => null, 'org2_memberstatus' => null]);
            DB::table('students')->where('student_id',$userId)->update(['organization2'=> null, 'org2_member_status'=> null]);
            return redirect()->back()->with('success', "You had canceled your membership");
        }
        
    }




    public function __construct(){
        
         $this->gateway = Omnipay::create('PayPal_Rest');
         $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
         $this->gateway->setSecret(env( 'PAYAPAL_CLIENT_SECRET'));
         $this->gateway->setTestMode(true);
    }

    public function showMembersRequest()
{
    $user = Auth::user();
    $userId = $user->id;

    // Retrieve the student record to get the organization
    $student = DB::table('students')->where('student_id', $userId)->first();
    $orgName = $student->organization2; 

    // Fetch payments for the active user's organization 
    $payments = DB::table('payments')
                    ->where('organization', $orgName)
                    ->where('amount', 200.00)
                    ->where('approved', false)
                    ->get();

    // Pass the payments data to the view
    return view('Student.members_request', ['payments' => $payments]);
}

public function approvePayment($paymentId)
{
    DB::table('payments')->where('id', $paymentId)->update(['approved' => true]);
    
    $payment = DB::table('payments')->where('id', $paymentId)->first();

    // Update member status in student_organizations table
    DB::table('student_organizations')
        ->where('studentid', $payment->studno)
        ->update(['org2_memberstatus' => 'Member']);

    // Update member status in students table
    DB::table('students')
        ->where('student_id', $payment->studno)
        ->update(['org2_member_status' => 'Member']);

    
    return redirect()->back()->with('success', 'Payment approved successfully.');
}
    
public function promoteStudent(Request $request)
{
    $studentId = $request->input('studentId');

    // Find the student by their ID
    $student = Students::where('student_id', $studentId)->first();

    if ($student) {
        // Promote the student to Student Leader
        $student->org1_member_status = 'Student Leader';
        $student->save();

        return response()->json(['message' => 'Student promoted successfully.']);
    } else {
        return response()->json(['error' => 'Student not found.'], 404);
    }
}

public function searchStudent(Request $request)
{
    $query = $request->input('query');
    $students = Students::where('student_id', 'LIKE', "%".$query->searchInput."%")->get();
    return response($students);
}

public function showOrgOfficers($id)
{
    $org = Organization::find($id);

    $officers = Students::where(function ($query) use ($org) {
        $query->where('organization1', $org->name)
              ->where('org1_member_status', '!=', 'Member')
              ->orWhere(function ($query) use ($org) {
                  $query->where('organization2', $org->name)
                        ->where('org2_member_status', '!=', 'Member');
              });
     })
     ->get();
    
    return view('Admin.org_officers')->with('officers', $officers);
}

public function getOrgMembers($id)
{
    $id = $request->query('id');
    $org = Organization::find($id);

    $members = Students::where(function ($query) use ($org) {
        $query->where('organization1', $org->name)
              ->where('org1_member_status', '=', 'Member')
              ->orWhere(function ($query) use ($org) {
                  $query->where('organization2', $org->name)
                        ->where('org2_member_status', '=', 'Member');
              });
    })->get();
    
    return response()->json($members);
}
    
}
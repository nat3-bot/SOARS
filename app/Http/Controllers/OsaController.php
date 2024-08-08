<?php

namespace App\Http\Controllers;


use App\Events\ChatifyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Students;
use App\Models\StudentOrganization;
use App\Models\Announcement;
use App\Models\Registrations;

use setasign\Fpdi\Fpdi;


class OsaController extends Controller
{
    public function index(){


        return view('osaemp', ['users'=>$user, 'unseenCounter'=> $unseenCounter]);
    }

    public function openRegistration(Request $request){
        if ($request->filled('regopen') && $request->regopen == '1') {
            $openReg = new Registrations();
            $openReg->registration = 1;
            $openReg->save();
            $regstatus = "Registration is Open";
            return redirect()->back()
            ->with('success', 'Registration is now Open')
            ->with('regstatus', $regstatus);;
        } 

        elseif ($request->filled('regclose') && $request->regclose == '0') {
            $openReg = new Registrations();
            $openReg->registration = 0;
            $openReg->save();
            $regstatus = "Registration is Close";
            return redirect()->back()
            ->with('error', 'Registration is now Close')
            ->with('regstatus', $regstatus);
        } 

        else{
            return redirect()->back()->with('error', 'Authorization Invalid');
        }

    }
    

    public function activity_pending_retrieve(){
        $activity = DB::table('events')->whereNotIn('status', ['Approved', 'On Hold', 'Done'])->get();
        $approved = DB::table('events')->whereIn('status', ['Approved', 'On Hold', 'Done'])->get();
        $org = DB::table('organizations')->where('requirement_status','=','complete')->get();

        
        return view('OSA.approval', ['activity'=> $activity])
        ->with('approved',$approved)
        ->with('org', $org);
    }

    

    public function store()
    {
        $event = new Event();

        // Assign values to the properties of the model instance
        $event->status = request('status');
        $event->organization_name = request('organization_name');
        $event->activity_title = request('activity_title');
        $event->type_of_activity = request('type_of_activity');
        $event->activity_start_date = request('activity_start_date');
        $event->activity_end_date = request('activity_end_date');
        $event->activity_start_time = request('activity_start_time');
        $event->activity_end_time = request('activity_end_time');
        $event->venue = request('venue');
        $event->participants = request('participants');
        $event->partner_organization = request('partner_organization');
        $event->organization_fund = request('organization_fund');
        $event->solidarity_share = request('solidarity_share');
        $event->registration_fee = request('registration_fee');
        $event->AUSG_subsidy = request('AUSG_subsidy');
        $event->sponsored_by = request('sponsored_by');
        $event->ticket_selling = request('ticket_selling');
        $event->ticket_control_number = request('ticket_control_number');
        $event->other_source_of_fund = request('other_source_of_fund');
        $event->comments = request('comments');
        // Save the model instance to the database
        $event->save();

        return redirect('/osaemp/activity_approval')->with('success', 'You have created an Event');
    }


    public function event_Approve_or_edit(Request $request)
    {
        try {
            if ($request->has('approve')) {
                $approve = $request->input('approve');
                $eventId = substr($approve, strpos($approve, '_') + 1);
                $eventData = ['status' => 'Approved'];
                DB::table('events')->where('id', $eventId)->update($eventData);
            } elseif ($request->has('edit')) {
                $edit = $request->input('edit');
                $eventId = substr($edit, strpos($edit, '_') + 1);
                return redirect()->route('edit_pending_activity', ['id' => $eventId]);
            } elseif ($request->has('action')) {
                $reject = $request->input('action');
                $eventId = substr($reject, strpos($reject, '_') + 1);
                $eventData = ['status' => 'Rejected'];
                // Update Status to 'Rejected'
                DB::table('events')->where('id', $eventId)->update($eventData);
            } elseif ($request->has('delete')) {
                $delete = $request->input('delete'); // Fix variable name
                $eventId = substr($delete, strpos($delete, '_') + 1);
                // Delete the event with the given ID
                DB::table('events')->where('id', $eventId)->delete();
            }
    
            return redirect()->back()->with('success', 'Event action performed successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }

    

    public function edit_pending_activity($id) {
        // Retrieve the event data based on the ID and pass it to the edit view
        $event = Event::findOrFail($id);
        $activity = DB::table('events')->where('id','!=','Approved')->get();
        $partner_org = DB::table('organizations')
        ->where('requirement_status','=','complete')->get();
        $pending_event = DB::table('events')->where('id','=',$id)->get();
        return view('OSA.edit_pending_activity')
        ->with('pending_event', $pending_event)
        ->with('partner_org', $partner_org);
    }

    public function edit_save_pending_activity(Request $request, $id) {
        // Find the event by ID
        $event = Event::findOrFail($id);
    
        // Update the fields with the new values from the request
        $event->update([
            'status' => $request->input('status'),
            'organization_name' => $request->input('organization_name'),
            'activity_title' => $request->input('activity_title'),
            'type_of_activity' => $request->input('type_of_activity'),
            'activity_start_date' => $request->input('activity_start_date'),
            'activity_end_date' => $request->input('activity_end_date'),
            'activity_start_time' => $request->input('activity_start_time'),
            'activity_end_time' => $request->input('activity_end_time'),
            'venue' => $request->input('venue'),
            'participants' => $request->input('participants'),
            'partner_organization' => $request->input('partner_organization'),
            'organization_fund' => $request->input('organization_fund'),
            'solidarity_share' => $request->input('solidarity_share'),
            'registration_fee' => $request->input('registration_fee'),
            'AUSG_subsidy' => $request->input('AUSG_subsidy'),
            'sponsored_by' => $request->input('sponsored_by'),
            'ticket_selling' => $request->input('ticket_selling'),
            'ticket_control_number' => $request->input('ticket_control_number'),
            'other_source_of_fund' => $request->input('other_source_of_fund'),
            'comments' => $request->input('comments')
        ]);
        
        return redirect('/osaemp/activity_approval')->with('success', 'You have updated the Event: '. $request->input('activity_title'));
    }
    

    public function eventAndpaypalreports(){
        $activity = DB::table('events')
            ->orWhere('status','=','Done')
            ->get();
        $paypal = DB::table('payments')->get();
        $registration_status = DB::table('registrations')->latest()->first();
        
        $regstatus = "Registration status not found"; // Default status
    
        if ($registration_status) {
            // Check the value of the registration column
            if ($registration_status->registration == 1) {
                $regstatus = "Registration is Open";
            } elseif ($registration_status->registration == 0) {
                $regstatus = "Registration is Close";
            }
        } else {
            // If no registration status is found, set the default status
            $regstatus = "Registration status not found";
        }
    
        return view('OSA.reports', [
            'activity' => $activity,
            'paypal' => $paypal,
            'regstatus' => $regstatus
        ]);
    }

    public function totalDashboard(){

        $totalEvent = DB::table('events')->get();
        $totalMember = DB::table('students')->get();
        $totalOrg= DB::table('organizations')->get();
        $totalPendingOrg = DB::table('organizations')->where('requirement_status','!=','complete')->get();
        $activities = DB::table('events')->select('activity_title', 'activity_start_date', 'activity_end_date', 'activity_start_time', 'activity_end_time')->get();
        $announcement = DB::table('announcements')->get();
        return view('osaemp')
        ->with('totalEvent', $totalEvent)
        ->with('totalMember',$totalMember)
        ->with('totalOrg', $totalOrg)
        ->with('totalPendingOrg', $totalPendingOrg)
        ->with('activities', $activities)
        ->with('announcement', $announcement);
        
    }

    public function dashboard_Activities(){
        $approved = DB::table('events')->whereIn('status', ['Approved', 'On Hold', 'Done'])->get();

        return view('OSA.activity')->with('approved',$approved);
    }

    

    public function user(){
        $info=DB::table('users')->where('role','=','2')->
        orwhere('role','=','3')->
        orwhere('role','=','4')->get();
        return view('OSA.userlist')
        ->with('info', $info);

    }

    public function org_act_list(Request $request){

        $org_activation = DB::table('organizations')->get();
        $organizationAcademic = DB::table('organizations')->where('type_of_organization','=','Academic')->where('requirement_status','=','complete')->get();
        $organizationCoAcademic = DB::table('organizations')->where('type_of_organization','=','Co-Academic')->where('requirement_status','=','complete')->get();
        $organizationSocioCivic = DB::table('organizations')->where('type_of_organization','=','Socio Civic')->where('requirement_status','=','complete')->get();
        $organizationReligious = DB::table('organizations')->where('type_of_organization','=','Religious')->where('requirement_status','=','complete')->get();
        return view('OSA.organization_activation')
        ->with('org_activation', $org_activation)
        ->with('organizationAcademic', $organizationAcademic)
        ->with('organizationCoAcademic', $organizationCoAcademic)
        ->with('organizationSocioCivic', $organizationSocioCivic)
        ->with('organizationReligious', $organizationReligious);
    }

    


    public function getEvents(){
        // Fetch events from the database
    $events = Event::all();

    // Format events as required by FullCalendar
    $formattedEvents = $events->map(function ($event) {
        $startDateTime = $event->activity_start_date . 'T' . $event->activity_start_time;
        $endDateTime = $event->activity_end_date . 'T' . $event->activity_end_time;

        return [
            'title' => $event->activity_title,
            'start' => $startDateTime,
            'end' => $endDateTime,
        ];
    });

    

    // Return the formatted events data
    return response()->json($formattedEvents);
    }

    public function getEventsOrg($id)
{
    $org = Organization::findOrFail($id);
    $events = Event::where('organization_name', $org->name)->get(); // Add get() to execute the query
    
    // Format events as required by FullCalendar
    $formattedEvents = $events->map(function ($event) {
        $startDateTime = $event->activity_start_date . 'T' . $event->activity_start_time;
        $endDateTime = $event->activity_end_date . 'T' . $event->activity_end_time;

        return [
            'title' => $event->activity_title,
            'start' => $startDateTime,
            'end' => $endDateTime,
        ];
    });

    return response()->json($formattedEvents); // Return the formatted events as JSON response
}

    

    public function calendarAjax(Request $request)
    {
        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'activity_title' => $request->activity_title,
                    'activity_start_date' => $request->activity_start_date,
                    'activity_end_date' => $request->activity_end_date,
                ]);
                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id);
                if ($event) {
                    $event->update([
                        'activity_title' => $request->activity_title,
                        'activity_start_date' => $request->activity_start_date,
                        'activity_end_date' => $request->activity_end_date,
                    ]);
                    return response()->json($event);
                }
                break;

            case 'delete':
                $event = Event::find($request->id);
                if ($event) {
                    $event->delete();
                    return response()->json(['success' => true]);
                }
                break;

            default:
                return response()->json(['error' => 'Invalid request']);
                break;
        }
    }


    
    public function pending_edit_view(Request $request){
        
        $id = $request->route('id');
        $org = Organization::find($id);
	    return view('OSA.organization_pending_edit')->with('org',$org);
        
    }

    public function viewMembers(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $members = Students::where('organization1', $event->organization_name)
                        ->orWhere('organization2', $event->organization_name)
                        ->get();

        return view('members_modal', compact('event', 'members'));
    }


    public function generate (Request $request, $eventId, $studentId)
    {
        $event = Event::findOrFail($eventId);
        $student = Students::findOrFail($studentId);

        $pdf = new Fpdi();

        $pdf->AddPage('L');

        $pdf->SetFont('Helvetica', 'B', 16);

        $templatePath = public_path('photos/testcert.png');
        $pdf->Image($templatePath, 0, 0, 297, 210);
        $pdf->SetXY(63, 106.5); 
        $pdf->Cell(0, 10, $event->activity_title, 0, 1, 'C'); 

        $pdf->SetXY(50, 117.5); 
        $pdf->Cell(0, 10, $event->activity_start_date, 0, 1, 'C'); 

        
        $pdf->Output('certificate.pdf', 'D');
    }

    public function edit_officers($id){
        $org = Organization::where('id', $id)->first();
        $orgID = $org->id;
        $sesh = Session::put('orgID',$orgID);
        return view('OSA.organization_officers')
        ->with('org', $org);
    }

    public function checkOfficer(Request $request){// Get User ID
            $activeUser = Session::get('orgID');
            $field = $request->input('clickedButton');
            $studentNumber = $request->input($field);
            // Retrieve the user data from the User table
            $student = User::where('id', $studentNumber)->where('email_verified_at', '!=', null)->first();
            $verify1 = Students::where('student_id',$studentNumber)->first();
            $verify2 = StudentOrganization::where('studentId', $studentNumber)->first();
            $orgCheck = Organization::where('id', $activeUser)->first();
            
            //Check Student Table
            if($verify1->organization1 == $orgCheck->nickname){

                $orgUpdated = Organization::where('id', $activeUser)->update([$field => $studentNumber]);

                // Check if the update was successful
                if ($orgUpdated !== false) {
                    // Retrieve the updated organization record
                    $updatedOrg = Organization::where('id', $activeUser)->first();
                    // Get the next two columns to update
                    $nextField1 = $this->getNextField($field);
                    $nextField2 = $this->getNextField($nextField1);
                    // Update the organization record with user data in the next two columns
                    $orgData = [
                        $nextField1 => $student->name,
                        $nextField2 => $student->email,
                    ];

                    // Update the organization record with user data
                    $org = Organization::where('id', $activeUser)->update($orgData);

                    if ($org !== false) {
                        $organization = Organization::where('id', $activeUser)->get();
                        
                        
                        return redirect('/edit_officers/'.$activeUser)->with(['success' => 'Student number exists and email is verified.', 'field' => $field]);
                    } 
                    else {
                        return redirect()->back()->with('error', 'Failed to update organization record with user data.');
                    }

                } 

                else {
                    return redirect()->back()->with('error', 'Failed to update organization record.');
                }

            }
            elseif($verify1->organization2 == $orgCheck->nickname){

                $orgUpdated = Organization::where('id', $activeUser)->update([$field => $studentNumber]);

                // Check if the update was successful
                if ($orgUpdated !== false) {
                    // Retrieve the updated organization record
                    $updatedOrg = Organization::where('id', $activeUser)->first();
                    // Get the next two columns to update
                    $nextField1 = $this->getNextField($field);
                    $nextField2 = $this->getNextField($nextField1);
                    // Update the organization record with user data in the next two columns
                    $orgData = [
                        $nextField1 => $student->name,
                        $nextField2 => $student->email,
                    ];

                    // Update the organization record with user data
                    $org = Organization::where('id', $activeUser)->update($orgData);

                    if ($org !== false) {
                        $organization = Organization::where('id', $activeUser)->get();
                        

                        return redirect()->back()->with(['success' => 'Student number exists and email is verified.', 'field' => $field]);
                    } 
                    else {
                        return redirect()->back()->with('error', 'Failed to update organization record with user data.');
                    }

                } 

                else {
                    return redirect()->back()->with('error', 'Failed to update organization record.');
                }

            }

            $checkStudentTable = Students::where('student_id', $studentNumber)
            ->where(function ($query) {
                $query->where('org1_member_status', 'President')
                    ->orWhere('org1_member_status', 'AUSG_Rep')
                    ->orWhere('org1_member_status', 'VP-I')
                    ->orWhere('org1_member_status', 'VP-E')
                    ->orWhere('org1_member_status', 'Secretary')
                    ->orWhere('org1_member_status', 'Treasurer')
                    ->orWhere('org1_member_status', 'Auditor')
                    ->orWhere('org1_member_status', 'Pro');
            })
            ->orWhere(function ($query) {
                $query->where('org2_member_status', 'President')
                    ->orWhere('org2_member_status', 'AUSG_Rep')
                    ->orWhere('org2_member_status', 'VP-I')
                    ->orWhere('org2_member_status', 'VP-E')
                    ->orWhere('org2_member_status', 'Secretary')
                    ->orWhere('org2_member_status', 'Treasurer')
                    ->orWhere('org2_member_status', 'Auditor')
                    ->orWhere('org2_member_status', 'Pro');
            })->first();
            

            
            $checkStudent_OrgTable = StudentOrganization::where('studentId', $studentNumber)
            ->where(function ($query) {
                $query->where('org1_memberstatus', 'President')
                    ->orWhere('org1_memberstatus', 'AUSG_Rep')
                    ->orWhere('org1_memberstatus', 'VP-I')
                    ->orWhere('org1_memberstatus', 'VP-E')
                    ->orWhere('org1_memberstatus', 'Secretary')
                    ->orWhere('org1_memberstatus', 'Treasurer')
                    ->orWhere('org1_memberstatus', 'Auditor')
                    ->orWhere('org1_memberstatus', 'Pro');
            })
            ->orWhere(function ($query) {
                $query->where('org2_memberstatus', 'President')
                    ->orWhere('org2_memberstatus', 'AUSG_Rep')
                    ->orWhere('org2_memberstatus', 'VP-I')
                    ->orWhere('org2_memberstatus', 'VP-E')
                    ->orWhere('org2_memberstatus', 'Secretary')
                    ->orWhere('org2_memberstatus', 'Treasurer')
                    ->orWhere('org2_memberstatus', 'Auditor')
                    ->orWhere('org2_memberstatus', 'Pro');
            })->first();
            

            if(isset($checkStudent) || isset($checkStudent_OrgTable)){
                return redirect()->back()->with(['error' => 'Student is already a Student Leader in another Organization', 'field' => $field]);
            }

            
        

            if ($student != null && $checkStudentTable == null && $checkStudent_OrgTable == null && ($verify1 != null && $verify2 != null)) {
                // Update the organization record with the student number
                $orgUpdated = Organization::where('id', $activeUser)->update([$field => $studentNumber]);

                // Check if the update was successful
                if ($orgUpdated !== false) {
                    // Retrieve the updated organization record
                    $updatedOrg = Organization::where('id', $activeUser)->first();
                    // Get the next two columns to update
                    $nextField1 = $this->getNextField($field);
                    $nextField2 = $this->getNextField($nextField1);
                    // Update the organization record with user data in the next two columns
                    $orgData = [
                        $nextField1 => $student->name,
                        $nextField2 => $student->email,
                    ];

                    // Update the organization record with user data
                    $org = Organization::where('id', $activeUser)->update($orgData);

                    if ($org !== false) {
                        $organization = Organization::where('id', $activeUser)->get();
                        

                        return redirect()->back()->with(['success' => 'Student number exists and email is verified.', 'field' => $field]);
                    } 
                    else {
                        return redirect()->back()->with('error', 'Failed to update organization record with user data.');
                    }

                } 

                else {
                    return redirect()->back()->with('error', 'Failed to update organization record.');
                }


            } else {
                return redirect()->back()->with(['error' => 'Student number does not exist or email is not verified.', 'field' => $field]);
            }
        }
        
        // Helper function to get the next field name
    private function getNextField($currentField)
    {
        // Extract the position (e.g., "vp_internal_studno" becomes "vp_internal")
        
        // Determine the next column name based on the current position
        switch ($currentField) {
            case 'president_studno':
                return 'president_name';
            case 'president_name':
                return 'president_email';

            case 'ausg_rep_studno':
                return 'ausg_rep_name';
            case 'ausg_rep_name':
                return 'ausg_rep_email';

            case 'vp_internal_studno':
                return 'vp_internal_name';
            case 'vp_internal_name':
                return 'vp_internal_email';

            case 'vp_external_studno':
                return 'vp_external_name';
            case 'vp_external_name':
                return 'vp_external_email';

            case 'secretary_studno':
                return 'secretary_name';
            case 'secretary_name':
                return 'secretary_email';

            case 'treasurer_studno':
                return 'treasurer_name';
            case 'treasurer_name':
                return 'treasurer_email';

            case 'auditor_studno':
                return 'auditor_name';
            case 'auditor_name':
                return 'auditor_email';

            case 'pro_studno':
                return 'pro_name';
            case 'pro_name':
                return 'pro_email';

            default:
                return ''; // Handle other cases if necessary
        }
    }

    

    public function save_officers(Request $request, $id){
        Session::put('orgId', $id);
        $org = Organization::find($id);
        $this->updateStudentRoles($request);
        return redirect('/osaemp/organization_list/organization_page/'.$id);

    }

    private function updateStudentRoles(Request $request)
    {
        $orgId = Session::get('orgID');
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
                        
                        
                        // Find the student by their student number
                        
                        $student = Students::where('student_id', $studentNo)->first();
                        
                        
                        // Check if the student is a member of organization1
                        
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
                        if($student->org1_member_status == null && $student->org1 == null ) {
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
}

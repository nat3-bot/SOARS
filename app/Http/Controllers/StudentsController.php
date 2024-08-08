<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Announcement;
use App\Events\ChatifyEvent;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Osa;
use App\Models\User;
use App\Models\Students;
use App\Models\StudentOrganization;
use App\Mail\VerifyEmail;
use Datatables;
use setasign\Fpdi\Fpdi;
use App\Mail\CertificateEmail;

class StudentsController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();
        $userId = $user->id;
        Session::put('userId', $userId);

        $student = DB::table('students')->where('student_id', $userId)->first();

        if ($student->course_id != null) {
            $studentId = $student->student_id;

            $student_org = DB::table('student_organizations')
                ->where('studentId', '=', $studentId)->first();

            $student_pos = $student_org->org1_memberstatus;
            $courseId = $student_org->course;

            $orgsByCourse = DB::table('organizations')
                ->where('requirement_status', 'complete')
                ->where('academic_course_based', '=', $courseId)->first();

            if (empty($orgsByCourse)) {
                $petition = 1;
                $announcement1 = null;
                $course = $student->course_id;

                return view('Student.dashboard')
                    ->with('announcement1', $announcement1)
                    ->with('petition', $petition)
                    ->with('course', $course);
            } else {
                $petition = null;
                $course = $courseId;

                $org = $orgsByCourse->name;

                $announcement1 = DB::table('announcements')
                    ->where('recipient', $org)->get();

                $orgForStudent = DB::table('organizations')
                    ->where('type_of_organization', 'Academic')
                    ->where('academic_course_based', $course)->first();

                $checkStudent = DB::table('students')
                    ->where('student_id', $studentId)->get();
                    

                if (isset($checkStudent->organization1) && isset($checkStudent->org1_member_status)) {
                    
                    return view('Student.dashboard')
                        ->with('announcement1', $announcement1)
                        ->with('petition', $petition)
                        ->with('course', $course)
                        ->with('success', 'You are now member of the '. $orgForStudent->name);
                } if($checkStudent->org1_member_status =! null) {
                    return view('Student.dashboard')
                        ->with('announcement1', $announcement1)
                        ->with('petition', $petition)
                        ->with('course', $course)
                        ->with('success', 'You are now member of the '. $orgForStudent->name);
                   
                }

                elseif($checkStudent->org1_member_status = null){
                    DB::table('students')->where('student_id', $studentId)->update([
                        'organization1' => $orgForStudent->nickname,
                        'org1_member_status' => "Member"
                    ]);

                    DB::table('student_organizations')->where('studentId', $studentId)->update([
                        'org1' => $orgForStudent->nickname,
                        'org1_memberstatus' => "Member"
                    ]);
                    return redirect()->back()
                        ->with('announcement1', $announcement1)
                        ->with('petition', $petition)
                        ->with('course', $course);
                }
            }
        } elseif ($student->course_id == null) {
            $announcement1 = null;
            $studID = $student->student_id;
            $course = null;
            $petition = null;
            Session::put('student_id', $studID);

            return view('Student.Dashboard')->with('announcement1', $announcement1)
                ->with('petition', $petition)
                ->with('course', $course);
        }
    }

    public function stud_course(Request $request)
    {
        $studentID = Session::get('student_id');

        $course_id = $request->course;

        DB::table('students')->where('student_id', $studentID)
            ->update([
                'course_id' => $course_id
            ]);

        DB::table('student_organizations')->where('studentId', $studentID)
            ->update([
                'course' => $course_id
            ]);

        $org = DB::table('organizations')
            ->where('academic_course_based', $course_id)
            ->where('type_of_organization', 'Academic')->first();

        if (isset($org)) {
            DB::table('students')->where('student_id', $studentID)->update([
                'organization1' => $org->nickname,
                'org1_member_status' => "Member"
            ]);

            DB::table('student_organizations')->where('studentId', $studentID)->update([
                'org1' => $org->nickname,
                'org1_memberstatus' => "Member"
            ]);

            $orgsByCourse = DB::table('organizations')
                ->where('academic_course_based', '=', $course_id)->first();

            $announcement1 = DB::table('announcements')->where('recipient', $org->name)->get();

            $petition = null;
            $course = $course_id;

            return redirect('/student')
                ->with('announcement1', $announcement1)
                ->with('petition', $petition)
                ->with('course', $course)
                ->with('success', 'You are now member of the '. $org->name);
        } elseif ($org == null) {
            $petition = "On";
            $announcement1 = null;
            $course = $course_id;
            return redirect('/student')->with('petition', $petition)
                ->with('announcement1', $announcement1)
                ->with('course', $course);
        }
    }


    public function getEvents(){
        $user = Auth::user();
        $userId = $user->id; //Student No
        $student = DB::table('students')->where('student_id','=' ,$userId)->first(); //Select Row from Student
        $studentId = $student->student_id; //Student Id from Students Table
        $student_org = DB::table('student_organizations')
        ->where('studentid', '=', $studentId)->first(); //Select Row from student_organization if student_id match
        $student_pos = $student_org->org1_memberstatus; //Select org Status 1
        $courseId = $student_org->course; //Select student Course from Student_organization
        $orgsByCourse = DB::table('organizations')
        ->where('academic_course_based','=',$courseId)->first(); //Select Row from organization if academic_course match with student course
        $org = $orgsByCourse->name;
        // Fetch events from the database
        $events = Event::where('organization_name','=',$org)->get();

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

    public function announcement(){

        $user = Auth::user();
        $userId = $user->id; //Student No
        $student = DB::table('students')->where('student_id','=' ,$userId)->first(); //Select Row from Student
        $studentId = $student->student_id; //Student Id from Students Table
        $student_org = DB::table('student_organizations')->where('studentid', '=', $studentId)->first(); //Select Row from student_organization if student_id match
        $student_pos = $student_org->org1_memberstatus; //Select org Status 1
        $student_org2 = $student_org->org2;
        $courseId = $student_org->course; //Select student Course from Student_organization
        $orgsByCourse = DB::table('organizations')
        ->where('academic_course_based','=',$courseId)->first(); //Select Row from organization if academic_course match with student course
        $org = $orgsByCourse->name;
        // Fetch events from the database
        $events = Event::where('organization_name','=',$org)->get();


        
        $announce = DB::table('announcements')
                    ->where(function ($query) use ($org, $student_org2) {
                        $query->where('author_org', '=', $org)
                              ->where('recipient', '=', $org)
                              ->orWhere('author_org', '=', $student_org2)
                              ->orWhere('recipient', '=', $student_org2);
                    })
                    ->get();

    return view('Student.announcements')->with('announce', $announce);
    }

    public function org_list(){
        $organizationAcademic = DB::table('organizations')->where('type_of_organization','=','Academic')->where('requirement_status','=','complete')->get();
        $organizationCoAcademic = DB::table('organizations')->where('type_of_organization','=','Co-Academic')->where('requirement_status','=','complete')->get();
        $organizationSocioCivic = DB::table('organizations')->where('type_of_organization','=','Socio Civic')->where('requirement_status','=','complete')->get();
        $organizationReligious = DB::table('organizations')->where('type_of_organization','=','Religious')->where('requirement_status','=','complete')->get();
        return view('Student.org_list')
        ->with('organizationAcademic', $organizationAcademic)
        ->with('organizationCoAcademic', $organizationCoAcademic)
        ->with('organizationSocioCivic', $organizationSocioCivic)
        ->with('organizationReligious', $organizationReligious);
    }



    public function studlist(){
        $org = DB::table('organizations')
            ->where('requirement_status', '=', 'complete')
            ->get();

        if (request()->ajax()) {
            return datatables()->of(Students::select('*'))
                ->addColumn('action', 'student-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('student-list', compact('org'));
    }

    public function getOrganizations(Request $request)
    {
        $courseId = $request->course_id;
        $organizations = Organization::where('academic_course_based', $courseId)->get();
        return response()->json($organizations);
    }

    public function importStudents(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        // Get the uploaded file
        $file = $request->file('csv_file');

        // Parse the CSV file
        $data = array_map('str_getcsv', file($file));

        // Iterate over each row and insert into database
        foreach ($data as $row) {
            $hashedPassword = Hash::make($row[0]); 
            Students::create([
                'student_id' => $row[0], // Adjust according to your CSV format
                'last_name' => $row[1],
                'middle_initial' => $row[2],
                'first_name' => $row[3],
                'email' => $row[4],
                'password' => $hashedPassword // Assuming student_id is the password for simplicity
                // Add more fields as needed
            ]);
        
            StudentOrganization::create([
                'studentId' => $row[0], // Adjust according to your CSV format
                // Add more fields as needed
            ]);
        
            // Extracting and concatenating the name
            $name = $row[3] . ' ' . $row[2] . ' ' . $row[1];
        
            User::insert([
                'id' => $row[0],
                'role' => 3,
                'name' => $name,
                'email' => $row[4],
                'password' => $hashedPassword,
                'created_at' => now(),
                'updated_at' => now()
                // Add more fields as needed
            ]);

            $user = User::where('id', $row[0])->first();
                
            event(new Registered($user));
        }
        

        // Provide feedback to the user
        return back()->with('success', 'Students imported successfully.');
    }



       public function store(Request $request)
        {
            $courseId = $request->course_id;
            $studentId = $request->student_id;
            
            /*
            $stuentTableVerify = DB::table('student')->where('student_id', $studentId)->get();
            $studentorgTableVerify = DB::table('student_organizations')->where('studentId', $studentId)->get();
            $userVerify = DB::table('users')->where('id', $studentId)->get();
            */

            if ($courseId) {
                // Fetch organization only if Course ID is provided
                $organization = Organization::where('academic_course_based', $courseId)->first();
        
                // Check if organization exists for the provided Course ID
                if (!$organization) {
                    return response()->json(['message' => 'No organization found for the provided academic course'], 400);
                }
            } else {
                // Set organization to null if Course ID is not provided
                $organization = null;
            }

            if($request->organization2 == "null")
            {
                $organization2 = null;
            }
            $organization2 = $request->organization2;
            $org1MemberStatus = ($request->org1_member_status === 'null') ? null : $request->org1_member_status;

            
            $datetime = now();
            $studentData = [
                'last_name' => $request->last_name,
                'middle_initial' => $request->middle_initial,
                'first_name' => $request->first_name,
                'course_id' => $request->course_id,
                'email' => $request->email,
                'email_verified_at' => null,
                'organization1' => $organization ? $organization->nickname : null,
                'organization2' => $organization2,
                'org1_member_status' => $org1MemberStatus,
                'org2_member_status' => $request->org2_member_status,
                'phone_number' => $request->phone_number,
            ];

        // Check if password is provided in the request
        if (!empty($request->password)) {
            $studentData['password'] = Hash::make($request->password); // Hash Password
        }

        DB::table('students')->updateOrInsert(
            ['student_id' => $studentId],
            $studentData
        );

        $fname= $request->first_name;
        $mname= $request->middle_initial;
        $lname= $request->last_name;
        $randomString = Str::random(10);

        $name = $fname.' '.$mname.' '.$lname;

            $verificationToken = Str::random(60);
            
            $studentData2 = [
                'course' => $request->course_id,
                'org1' =>$organization ? $organization->name : null,
                'org1_memberstatus' => $org1MemberStatus,
                'org2' => $organization2,
                'org2_memberstatus' => $request->org2_member_status,
            ];

            DB::table('student_organizations')->updateOrInsert([
                'studentId' => $studentId],
                $studentData2);

            $fname= $request->first_name;
            $mname= $request->middle_initial;
            $lname= $request->last_name;
            $randomString = Str::random(10);
            $userExists = User::find($studentId);

            if (!$userExists) {
                $name = $request->first_name . ' ' . $request->middle_initial . ' ' . $request->last_name;
        
                DB::table('users')->insert([
                    'id' => $studentId,
                    'role' => '3',
                    'name' => $name,
                    'email' => $request->email,
                    'email_verified_at' => null, // You may adjust this based on your requirements
                    'password' => Hash::make($request->password),
                    'remember_token' => $randomString,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            
                $user = User::where('id', $studentId)->first();
                
                event(new Registered($user));
            }
            
            else
            {
                $name = $request->first_name . ' ' . $request->middle_initial . ' ' . $request->last_name;
                DB::table('users')->where('id', $studentId)->update(
                    ['name' => $name],
                    ['email' => $request->email],
                    ['password' => Hash::make($request->password)],
                    ['remember_token' => $randomString],
                    ['updated_at' => now()]
                );
            }
            
        
            return response()->json(['message' => 'Student information saved successfully']);
    }
            


        public function edit(Request $request)
        {
            $studentId = $request->student_id;
            $student = DB::table('students')->where('student_id', $request->student_id)->first();
            $studentOrg = DB::table('student_organizations')->where('studentId', $request->student_id)->first();

        return response()->json($student);
    }

    public function update(Request $request)
    {
        $studentId = $request->student_id;
    
        // Retrieve the current organization information for the student
        $currentStudentOrg = DB::table('student_organizations')->where('studentId', $studentId)->first();
    
        // Retrieve the student record from the database
        $student = Student::where('student_id', $studentId)->first();
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
    
        // Prepare student data for updating
        $studentData = [
            'last_name' => $request->last_name,
            'middle_initial' => $request->middle_initial,
            'first_name' => $request->first_name,
            'course_id' => $request->course_id,
            'email' => $request->email,
            'organization1' => $request->organization1,
            'organization2' => $request->organization2,
            'org1_member_status' => $request->org1_member_status,
            'org2_member_status' => $request->org2_member_status,
            'phone_number' => $request->phone_number,
        ];
    
        // Check if password is provided in the request
        if ($request->filled('password')) {
            $studentData['password'] = Hash::make($request->password);
        }
    
        // Update student information in the students table
        $student->fill($studentData);
        $student->save();
    
        // Update or insert student organization information
        if ($currentStudentOrg) {
            // If student organization record exists, update it
            DB::table('student_organizations')->where('studentId', $studentId)->update([
                'course' => $request->course_id,
                'org1' => $request->organization1,
                'org1_memberstatus' => $request->org1_member_status,
                'org2' => $request->organization2,
                'org2_memberstatus' => $request->org2_member_status,
            ]);
        } else {
            // If student organization record doesn't exist, insert it
            DB::table('student_organizations')->insert([
                'studentId' => $studentId,
                'course' => $request->course_id,
                'org1' => $request->organization1,
                'org1_memberstatus' => $request->org1_member_status,
                'org2' => $request->organization2,
                'org2_memberstatus' => $request->org2_member_status,
            ]);
        }
    
        return response()->json(['message' => 'Student information updated successfully']);
    }


        public function delete(Request $request)
        {
            $student = DB::table('students')->where('student_id', $request->student_id)->delete();
            DB::table('users')->where('id', $request->student_id)->delete();
            DB::table('student_organizations')->where('studentId', $request->student_id)->delete();
            return response()->json(['message' => 'Student information deleted successfully']);

        }

        public function getStudentCount() {
            $studentCount = Students::count();
            return $studentCount;
        }

        public function getOsaEmpCount() {
            $osaEmpCount = Osa::count();
            return $osaEmpCount;
        }
        
        public function showDashboard() {
            $studentCount = $this->getStudentCount();
            $osaEmpCount = $this->getOsaEmpCount();
            $recentUsers = $this->recentUser();
            $RSOCount = $this->getRSOCount();
            return view('Admin.admin', [
                'studentCount' => $studentCount,
                'osaEmpCount' => $osaEmpCount,
                'recentUsers' =>$recentUsers,
                'RSOCount'    =>$RSOCount,
            ]);
        }
        
        public function showUsers(){
            $recentUsers = $this->recentUser();
            return view('Admin.audit_log', [
                'recentUsers' =>$recentUsers,
            ]);
        }

        public function recentUser($perPage = 10)
        {
            $recentUsers = User::orderBy('created_at', 'desc')
                            ->paginate($perPage);

            return $recentUsers;
        }

        public function getRSOCount() {
            $RSOCount = Organization::where('requirement_status', 'complete')->count();
            return $RSOCount;
        }

        public function sl_activity_proposal(){
            $user = Auth::user();
            $userId = $user->id; //Student No
            $student = DB::table('students')->where('student_id','=' ,$userId)->first(); //Select Row from Student
            $studentId = $student->student_id; //Student Id from Students Table
            $student_org = DB::table('student_organizations')
            ->where('studentId', '=', $studentId)->first(); //Select Row from student_organization if student_id match
            $student_pos = $student_org->org1_memberstatus; //Select org Status 1
            $courseId = $student_org->course; //Select student Course from Student_organization
            $orgsByCourse = DB::table('organizations')
            ->where('academic_course_based','=',$courseId)->first(); //Select Row from organization if academic_course match with student course
            $org = $orgsByCourse->name; //Select Org Name
            $orgId = $orgsByCourse->id;

            $pendingEvents = DB::table('events')->whereIn('status', ['Standby', 'Rejected'])->where('organization_name', '=', $org)->get();

            // Define or retrieve the $eventId 
            $eventId = DB::table('events')->where('status', ['Approved', 'Done'])->value('id');
            if($eventId != null){
            $event = Event::findOrFail($eventId);
            $members = $this->getMembers($org);
            }else {
                // If $eventId is null, set $event and $members to default values
                $event = "Null";
                $members = "Null";
            }
            $orgs = DB::table('organizations')->get();
            $approved = DB::table('events')->whereIn('status', ['Approved', 'On Hold', 'Done'])->where('organization_name', '=',$org)->get();
            $activity = DB::table('events')->where('organization_name','=', $org)->where('status','=','Stand By')->get();
            
            
            return view('Student.activity_proposal')
            ->with('pendingEvents', $pendingEvents)
            ->with('approved', $approved)
            ->with('orgsByCourse',$orgsByCourse)
            ->with('orgs', $orgs)
            ->with('activity', $activity)
            ->with('event', $event)
            ->with('members', $members)
            ->with('organization_id', $orgId);
        }

        public function store_events(Request $request){
            $event = new Event();
        
            // Handle file upload for Letter of Approval
            if ($request->hasFile('letter_of_approval')) {
                $file = $request->file('letter_of_approval');
                // Check if the file is valid
                if ($file->isValid()) {
                    $fileName = 'letter_of_approval_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('storage/letter_of_approval/'), $fileName);

                    $event->letter_of_approval = $fileName;
                } else {
                    return redirect()->back()->withInput()->withErrors(['file_error' => 'Invalid file upload.']);
                }
            }
            
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

            // Save the model instance to the database
            $event->save();

            return redirect('/student/propose_activity')->with('success', 'You have created an Event');

        }

        public function event_done(){
            try {
                if ($request->has('done')) {
                    $edit = $request->input('done');
                    $eventId = substr($edit, strpos($edit, '_') + 1);
                    $eventData = ['status' => 'Done'];
                    DB::table('events')->where('id', $eventId)->update($eventData);
                } 
                
        
                return redirect()->back()->with('success', 'Event action performed successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'An error occurred while processing the request.');
            }
        }

        public function members(){ 

            $user = Auth::user();
            $userId = $user->id; //Student No
            $student = DB::table('students')->where('student_id','=' ,$userId)->first(); //Select Row from Student
            $studentId = $student->student_id; //Student Id from Students Table
            $student_org = DB::table('student_organizations')
            ->where('studentid', '=', $studentId)->first(); //Select Row from student_organization if student_id match
            $student_pos = $student_org->org1_memberstatus; //Select org Status 1
            $courseId = $student_org->course; //Select student Course from Student_organization
            $orgsByCourse = DB::table('organizations')
            ->where('academic_course_based','=',$courseId)->first(); //Select Row from organization if academic_course match with student course
            $org = $orgsByCourse->name; //Select Org Name


            $info=DB::table('students')->where('course_id','=',$courseId)->get();
            return view('Student.org1_member_list')
            ->with('info', $info);
        }

        public function members2(){ 

            $user = Auth::user();
            $userId = $user->id; //Student No
            $student = DB::table('students')->where('student_id','=' ,$userId)->first(); //Select Row from Student
            $studentId = $student->student_id; //Student Id from Students Table
            $student_org = DB::table('student_organizations')
            ->where('studentId', '=', $studentId)->first(); //Select Row from student_organization if student_id match
            $student_pos = $student_org->org2_memberstatus; //Select org Status 2
            $orgName = $student_org->org2;
            $org = $orgName;
            $organization = DB::table('organizations')->where('name', '=', $orgName)->first();

            $info=DB::table('students')->where('organization2','=',$orgName)->get();
            return view('Student.org2_member_list')
            ->with('info', $info);
        }

        public function fetchOrganizations() {
            $organizations = Organization::where('type_of_organization', '!=', 'Academic')->get();
            return response()->json($organizations);
        }

        public function getMembers($organization_name) {
            
            
            $members = Students::where('organization1', $organization_name)
            ->orWhere('organization2', $organization_name)
            ->get();

            return $members;
        }
          

    public function generate (Request $request, $eventId, $studentId)
    {
        $event = Event::findOrFail($eventId);
        $students = Students::findOrFail($studentId);

        $pdf = new Fpdi();

        $pdf->AddPage('L');

        $pdf->SetFont('Helvetica', 'B', 16);

        $templatePath = public_path('photos/testcert.png');
        $pdf->Image($templatePath, 0, 0, 297, 210);

        
        $pdf->SetXY(67, 106.5); 
        $pdf->Cell(0, 10, $event->activity_title, 0, 1, 'C');
        
        $pdf->SetXY(50, 117.5); 
        $pdf->Cell(0, 10, $event->activity_start_date, 0, 1, 'C'); 
        
        $pdf->SetFont('Helvetica', '', 18);
        $pdf->SetXY(47, 20);
        $pdf->Cell(0, 10, $event->organization_name, 0, 1, 'L');

        $pdf->SetFont('Helvetica', '', 28);
        
        $pdf->SetXY(28, 80); 
        $pdf->Cell(0, 10, $students->first_name . ' ' . $students->last_name, 0, 1, 'C');

        $fileName = 'certificate_' . time() . '_' . $students->student_id . '.pdf';
        $filePath = public_path('storage/certificates/' . $fileName);
        
        $pdf->Output($filePath, 'F');

        // Sending email with attachment
        $email = new CertificateEmail($students, $event, $filePath);
        Mail::to($students->email)->send($email);
        // Delete the temporary PDF file
        unlink($filePath);

        return redirect()->back()->with('success', 'Certificate sent successfully!');
    }

    public function checkStudent(Request $request)
    {
        // Get User ID
        $activeUser = Session::get('userId');
    
        $field = $request->input('clickedButton');
        $studentNumber = $request->input($field);
    
        // Retrieve the user data from the User table

        $student = User::where('id', $studentNumber)->where('email_verified_at', '!=', null)->first();
        $verify1 = Students::where('student_id',$studentNumber)->first();
        $verify2 = StudentOrganization::where('studentId', $studentNumber)->first();
        
        
        //Check Student Table
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
            $orgUpdated = Organization::where('filedBy', $activeUser)->update([$field => $studentNumber]);

            // Check if the update was successful
            if ($orgUpdated !== false) {
                // Retrieve the updated organization record
                $updatedOrg = Organization::where('filedBy', $activeUser)->first();
                // Get the next two columns to update
                $nextField1 = $this->getNextField($field);
                $nextField2 = $this->getNextField($nextField1);
                // Update the organization record with user data in the next two columns
                $orgData = [
                    $nextField1 => $student->name,
                    $nextField2 => $student->email,
                ];

                // Update the organization record with user data
                $org = Organization::where('filedBy', $activeUser)->update($orgData);

                if ($org !== false) {
                    $organization = Organization::where('filedBy', $activeUser)->get();

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

                    Organization::where('filedBy', $activeUser)->update(['requirement_status' => $percentageCompletion]);


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



    public function edit_officers($id){
        $org = Organization::where('id', $id)->first();
        $orgID = $org->id;
        $sesh = Session::put('orgID',$orgID);
        return view('Student.organization_officers')
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
    
    public function save_officers(Request $request, $id){
        Session::put('orgId', $id);
        $org = Organization::find($id);
        $this->updateStudentRoles($request);
        if($org->type_of_organization == "Academic"){
            return redirect('/student/org1_page/');
        }
        else{
            return redirect('/student/org2_page/');
        }
        

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


    public function admin_edit_officers($id){
        $org = Organization::where('id', $id)->first();
        $orgID = $org->id;
        $sesh = Session::put('orgID',$orgID);
        return view('Admin.org_officers')
        ->with('org', $org);
    }

    public function admin_checkOfficer(Request $request){// Get User ID
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
    
    public function admin_save_officers(Request $request, $id){
        Session::put('orgId', $id);
        $org = Organization::find($id);
        $this->updateStudentRoles($request);

        
        return redirect('/rso_list/rso_page/'.$org->id);
        

    }


}
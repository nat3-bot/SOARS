<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentOrganizationController;
use App\Http\Controllers\OsaController;
use App\Http\Controllers\OsaEmpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PetitionController;
use App\Http\Middleware\VerifyEmailMiddleware;
use App\Models\Event;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//PAYPAL ROUTES


Route::get('paypal-payment',[PayPalController::class,"pay"])->name('paypal.payment');
Route::get('paypal-success',[PayPalController::class,"success"])->name('paypal.success');
Route::get('paypal-cancel',[PayPalController::class,'cancel'])->name('paypal.cancel');

//



Auth::routes(['verify' => true]);

Route::get('/verifying_email', function(){return view('home');})->middleware('verified');

//EmailVerification
Route::get('/email/verify', function () {
    return view('home');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = Auth::user();
 
    if ($user->email_verified_at != null){
        session(['login_attempts' => 0]);
        
        $user_role=Auth::user()->role;

        switch($user_role){
            case 1:
                return redirect('/admin');
                break;
            case 2:
                return redirect('/osaemp');
                break;
            case 3:
                return redirect('/student');
                break;
            default:
                Auth::logout();
                return redirect('/soars')->with('error', 'Something went wrong. Try again.');
        }

    }
})->middleware(['auth', 'signed'])->name('verification.verify');


//Static RSO Pages
Route::get('/terms_and_agreement', function () {return view('terms_and_agreement');})->name('terms_and_agreement');
Route::post('/update-data-privacy', [UserController::class, "updateDataPrivacy"])->name('update_dataPrivacy');
//For TERMS AND AGREEMENT
//CourseController

//Admin
Route::middleware(['admin'])->group(function () {
    
Route::get('/admin', [StudentsController::class, 'showDashboard'])->name('admin');


//Student Creation
Route::get('/student-list', [StudentsController::class, 'studlist'])->name('studlist');
Route::post('store', [StudentsController::class, 'store'])->name('store');
Route::post('/import/students', [StudentsController::class, 'importStudents'])->name('import.students');
Route::post('edit', [StudentsController::class, 'edit']);
Route::post('delete', [StudentsController::class, 'delete']);
Route::post('update', [StudentsController::class, 'update']);
Route::get('get-organizations', [StudentsController::class, 'getOrganizations'])->name('getOrganizations');
Route::get('fetchOrganizations', [StudentsController::class, 'fetchOrganizations'])->name('fetchOrganizations');

//OsaEmployee Creation
Route::get('osa_list', [OsaEmpController::class, 'osalist'])->name('osalist');
Route::post('stores', [OsaEmpController::class, 'stores']);
Route::post('edits', [OsaEmpController::class, 'edits']);
Route::post('deletes', [OsaEmpController::class, 'deletes']);
Route::get('reset_password', [OsaEmpController::class, 'reset_password']);
});
Route::get('/audit_log', [StudentsController::class, 'showUsers'], function () {return view('Admin.audit_log');})->name('auditlog');
//Route::get('/rso_list', [StudentOrganizationController::class, 'showRSOlist'])->name('rso_list');
Route::get('/rso_detail', [StudentOrganizationController::class, 'showRSODetail'])->name('rso_detail');
Route::get('/admin_profile', function(){return view('Admin.admin_profile');})->name('admin_profile');
Route::post('/admin_profile/update_pass', [UserController::class, 'admin_update_pass']);
Route::post('/admin/update_email', [UserController::class, 'admin_update_email'], function (){return view('Admin.admin_profile');})->name('admin.update');

//Org Creation
Route::get('/rso_list', [OrganizationController::class, 'new_org'], function(){return view('rso_list');})->name('rso_list');
Route::get('/rso_list/rso_page/{id}', [OrganizationController::class, 'rso_page']);
Route::get('/rso_list/rso_page/org_edit/{id}', [OrganizationController::class, 'org_pending']);
Route::delete('/rso_list/rso_page/delete/{id}', [OrganizationController::class, 'org_delete'])->name('org.delete');
Route::get('/rso_list/new_organization', function(){return view('Admin.org_list');})->name('org_list');
Route::get('/rso_list/pending_edit/{id}', [OrganizationController::class, 'org_pending'], function(){return view('Admin/org_pending');})->name('osaorg_pending_edit');
Route::post('/rso_list/pending_save/{id}', [OrganizationController::class, 'org_pending_save']);
//Send a New Org info to the DB
Route::post('/rso_list/new_organization', [OrganizationController::class, 'orgNew']);

//Manage Officers in organization
Route::get('/search/student', [OrganizationController::class, 'searchStudent']);
Route::post('/promote/student',  [OrganizationController::class, 'promoteStudent']);
Route::get('/organization/officers/{id}', [OrganizationController::class, 'showOrgOfficers'])->name('officers.list');
Route::get('/organization/getMembers', [OrganizationController::class, 'getOrgMembers']);


//End of Admin

//OrganizationController
Route::middleware(['osaemp'])->group(function () {
Route::get('/osaemp/organizations-list', [OrganizationController::class, 'orglist'])->name('orglist');
Route::get('/osaemp/organizaiton/{id}',function($id){$orgID = DB::table('organizations')->where('id','=',$id)->get();
});

//Routes for OSA
//Load the Dashboard Total Number 
Route::get('/osaemp', [OsaController::class, 'totalDashboard'], function(){return view('osaemp');})->name('osaemp')->middleware('osaemp');
Route::post('/osaemp/announcement', [AnnouncementController::class, 'osa_create'])->name('osa.announcement');
//Calendar of activities dashboard
Route::get('/osaemp/dash', [OsaController::class, 'getEvents'])->name('osa.fullcalendar');
//Org Page Event
Route::get('/org_page/event/{id}', [EventController::class, 'getEventsOrg']);
Route::get('/osaemp/organization_page/events', [EventController::class, 'getEvents']);
Route::post('/osaemp/fullcalendar/activity', [OsaController::class, 'calendarAjax']);
//Dashboard Routes
Route::get('/osaemp/dashboard', [OsaController::class, 'totalDashboard'])->name('osadashboard');

Route::get('/osaemp/activities', [OsaController::class, 'dashboard_Activities'], function(){return view('OSA/activity');})->name('osaactivity');
Route::get('/osaemp/organization_activation', [OsaController::class, 'org_act_list'], function(){return view('OSA/organization_activation');})->name('osaorgact');
//Organization
Route::get('/osaemp/user', function (){return view('OSA.user');})->name('osauser');
Route::post('/osaemp/update_pass', [UserController::class, 'osa_update_pass']);
Route::post('/osaemp/update_email', [UserController::class, 'osa_update_email'], function (){return view('OSA.user');})->name('user.update');
Route::get('/osaemp/userlist', [OsaController::class,'user'], function (){return view('OSA/userlist');})->name('osauserlist');
Route::get('/osaemp/message', function (){return view('OSA/message');})->name('osamessage');
Route::delete('/osaemp/organization_list/delete/{id}', [OrganizationController::class, 'org_pending_delete']);
//Send a New Org info to the DB
Route::post('/osaemp/organization_list/new_organization', [OrganizationController::class, 'newOrganization']);
//Load the List of Organization and Edit Organization Routes
Route::get('/osaemp/organization_list', [OrganizationController::class, 'organization'], function(){return view('OSA/organization_list');})->name('osaorganizationlist');
//OrganizationPages
Route::get('/osaemp/organization_list/organization_page/{id}', [OrganizationController::class, 'organization_page']);
Route::get('/osaemp/organization_list/organization_edit/{id}', [OrganizationController::class, 'org_pending_edit_view']);
Route::get('/osaemp/organization_list/new_organization',  function(){return view('OSA/organization_new');})->name('osaorganization_new');
Route::get('/osaemp/organization_list/pending_edit/{id}', [OrganizationController::class, 'org_pending_edit_view'], function(){return view('OSA/organization_pending_edit');})->name('osaorganization_pending_edit_view');
Route::post('/osaemp/organization_list/pending_edit_save/{id}', [OrganizationController::class, 'org_pending_edit_save']);
//Insert all the Info for Activity Approval
Route::post('/osaemp/activity_approval', [OsaController::class, 'store']);
Route::post('/osaemp/activity_approval/event_approve_or_edit', [OsaController::class, 'event_Approve_or_edit']);
Route::get('/osaemp/activity_approval/edit_pending_activity/{id}', [OsaController::class, 'edit_pending_activity'])->name('edit_pending_activity');
Route::post('/osaemp/activity_approval/edit_save/{id}', [OsaController::class, 'edit_save_pending_activity']);

Route::post('open_registration', [OsaController::class, 'openRegistration']);
//End of Routes for OSA

//Retrieve the list of Activity to be Approved
Route::get('/osaemp/activity_approval', [OsaController::class, 'activity_pending_retrieve'],function(){return view('OSA/approval');})->name('osaactivityapproval');
Route::get('/osaemp/reports', [OsaController::class, 'eventAndpaypalreports'], function(){ return view('OSA/reports');})->name('osareports');
Route::post('/osaemp/open_registration', [OsaController::class, 'openRegistration']);
Route::get('/generate-certificate/{eventId}', [OsaController::class, 'generate'])->name('generate-certificate');
});


//Routes for Student Leader
Route::get('/studentleader', [StudentsController::class, 'dashboard'], function(){return view('Student.dashboard');});
//Propose Event
//Create Announcement
//
Route::get('/studentleader/user/{id}', [StudentOrganizationController::class, ''], function(){return view('SL.user');});
Route::get('/member', function(){return view('member');})->name('member')->middleware('member');



//End of Student Leaders

//Paypal Experiment
Route::get('/osaemp/test', function(){return view('Student/paypal_experiment');});
Route::post('pay', [PaypalController::class, 'pay'])->name('payment');
Route::get('success', [PaypalController::class, 'success']);
Route::get('error', [PaypalController::class, 'error']);



//Routes for Students
Route::get('/student', [StudentsController::class, 'dashboard'], function(){return view('Student.dashboard');});
Route::post('/student_course', [StudentsController::class, 'stud_course']);
Route::get('/manage_officers', [StudentOrganizationController::class, 'view_officers']);
//Calendar for Student Organization
Route::get('/student/org_page/event/{id}', [EventController::class, 'getEventsOrgpage']);
//User Setting
Route::get('/student/user', function(){return view('Student.user_profile');});
Route::post('/student/update_pass', [UserController::class, 'student_update_pass']);
Route::post('/student/update_email', [UserController::class, 'student_update_email']);
//Calendar of Events for Students
Route::get('/student/dash', [StudentsController::class, 'getEvents']);
//Announcements for Students
Route::get('/student/announcements/recent', [StudentsController::class, 'announcement'], function(){return view('Student.announcements');});
Route::get('/student/org_list/', [StudentsController::class, 'org_list']);
Route::get('/student/org1_page/', [OrganizationController::class, 'student_organization_page'])->name('student_leader_page');
Route::get('/student/org2_page/', [OrganizationController::class, 'student_organization_page2']);

//Create Annoucements
Route::post('/student/announcement/create', [AnnouncementController::class, 'sl1_create']);
//Propose Activities
Route::get('/student/propose_activity', [StudentsController::class, 'sl_activity_proposal']);
Route::post('/student/activity_proposal', [StudentsController::class, 'store_events']);
Route::post('/student/activity_approval/done', [StudentsController::class, 'event_done']);;
//Org1 Member List
Route::get('/student/member_list', [StudentsController::class, 'members']);
//Org2 Member List
Route::get('/student/member_list2', [StudentsController::class, 'members2']);
//Organization Edit
Route::get('/student/organization_edit/{id}', [OrganizationController::class, 'student_org_edit_view']);
Route::post('/student/organization_save/{id}', [OrganizationController::class, 'student_org_edit_save']);
Route::get('/president/organization_edit/{id}', [OrganizationController::class, 'president_org_edit_view']);
Route::post('/president/organization_save/{id}', [OrganizationController::class, 'president_org_edit_save']);
//Register Button
Route::post('/register/organization/{id}', [OrganizationController::class, 'register']);
Route::post('/cancel_register/organization/{id}', [OrganizationController::class, 'cancel_register']);
//Student Leader Edit Organization Page
Route::get('/student/organization_list/organization_page/{id}', [OrganizationController::class, 'org_pending_edit_student_view']);
//SL Generate Certificate
Route::get('student/{organization_name}/members', [StudentsController::class, 'getMembers']);
Route::get('/generate-certificate/{eventId}/{studentId}', [StudentsController::class, 'generate'])->name('generate-certificate');

//See Members' Request for President user
Route::get('/student/members_request', [OrganizationController::class, 'showMembersRequest'])->name('members_request');
// Approve payment of applying members
Route::post('/approve-payment/{paymentId}', [OrganizationController::class,'approvePayment'])->name('approvePayment');

//data privacy in login
Route::get('/terms_and_agreement_modal', function () {
    return view('modals.data_privacy_modal');
})->name('terms_and_agreement_modal');

Route::get('/osaemp/petition_page/{id}', [PetitionController::class, 'getPetition']);

Route::get('/petition/existing/{id}', [PetitionController::class, 'existing']);
Route::get('/petition_organization', [PetitionController::class, 'org_info']);
Route::get('/petition/officers', [PetitionController::class, 'oldOfficers']);
Route::get('/petition/officers/2', [PetitionController::class, 'oldOfficers2']);
Route::get('/petition/new', [PetitionController::class, 'new']);
Route::post('/petition_new', [PetitionController::class, 'petition_new']);
Route::post('/petition_old', [PetitionController::class, 'old']);
Route::get('/petition_view/{id}', [PetitionController::class, 'getPetitionDetails']); //Students View

Route::get('petition', function(){return view('Student.file_petition');});

Route::get('/osaemp/petition_view/{id}', [PetitionController::class, 'getPetitionOsa']);

Route::post('/student/check', [StudentsController::class, 'checkStudent'])->name('student.check');

//Admin Manage Officers
Route::get('/edit_officers/admin/{id}', [StudentsController::class, 'admin_edit_officers']);
Route::post('/checkOfficers/admin', [StudentsController::class, 'admin_checkOfficer'])->name('officer.check');
Route::get('/save_officers/admin/{id}', [StudentsController::class, 'admin_save_officers']);

//OSA Manage Officers
Route::get('/edit_officers/{id}', [OsaController::class, 'edit_officers']);
Route::post('/checkOfficers', [OsaController::class, 'checkOfficer'])->name('officer.check');
Route::get('/save_officers/{id}', [OsaController::class, 'save_officers']);
//President Manage Officers
Route::get('/edit_officers/president/{id}', [StudentsController::class, 'edit_officers']);
Route::post('/checkOfficers/president', [StudentsController::class, 'checkOfficer']);
Route::get('/save_officers/president/{id}', [StudentsController::class, 'save_officers']);







//Login Timeout
Route::get('/', function () {return view('soars');});
Route::get('/soars', [LoginController::class, 'store'], [LoginController::class, 'create'],function () {return view('soars');});
Route::get('/soars/store', [LoginController::class], 'store');
Route::get('/', function () {return view('soars');});
//reCAPTCHA
Route::get('/soar/session_expired', function () {return view('session_expired');});

//Timeout
Route::get('/soars', function (Illuminate\Http\Request $request) {
    if ($request->query('timeout') === 'true') {
        // Handle timeout condition
        return view('soars', ['timeout' => 'true']);

    }

    return view('soars');
});

//Credential Errors
Route::get('error', function(){return view('error');});
//Forgot Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

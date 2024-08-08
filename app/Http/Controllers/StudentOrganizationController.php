<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Organization;
use App\Models\StudentOrganization;
use App\Events\ChatifyEvent;

class StudentOrganizationController extends Controller
{
    public function index()
    {
        
    }

    public function totalDashboard(){
        
        $totalEvent = DB::table('events')->get();
        $totalMember = DB::table('students')->get();
        $totalOrg= DB::table('organizations')->get();
        $totalPendingOrg = DB::table('organizations')->where('requirement_status','!=','complete')->get();
        $activities = DB::table('events')->select('activity_title', 'activity_start_date', 'activity_end_date', 'activity_start_time', 'activity_end_time')->get();

        return view('Student.dashboard')
        ->with('totalEvent', $totalEvent)
        ->with('totalMember',$totalMember)
        ->with('totalOrg', $totalOrg)
        ->with('totalPendingOrg', $totalPendingOrg)
        ->with('activities', $activities);
        
    }



    public function user(Request $request){
        $id = $request->route('id');
	    return view('SL.user')->with('org',$org);
    }


    public function showRSOList()
{
    // Assuming $categories is an array of categories with their respective organizations
    $categories = [
        [
            'title' => 'Academic',
            'organizations' => [
                ['id' => '1', 'name' => 'Organization 1'],
                ['id' => '2', 'name' => 'Organization 2'],
                // Other organizations
            ]
        ],
        [
            'title' => 'Co-Academic',
            'organizations' => [
                ['id' => '3', 'name' => 'Organization 3'],
                ['id' => '4', 'name' => 'Organization 4'],
                // Other organizations
            ]
        ],
        // Other categories
    ];

    return view('student_orgs.rso_list', compact('categories'));
}

public function view_officers(){
    
    
}

public function showRSODetail(Request $request)
    {
        $content = $request->query('content');

    
    $organizations = [];

    if ($content === 'academic') {
        $organizations = [
            ['id' => '1', 'name' => 'Organization A'],
            ['id' => '2', 'name' => 'Organization B'],
           
        ];
    } elseif ($content === 'co-academic') {
        $organizations = [
            ['id' => '3', 'name' => 'Organization C'],
            ['id' => '4', 'name' => 'Organization D'],
            
        ];
    }
    

    return view('student_orgs.rso_detail', compact('content', 'organizations'));
    }



}




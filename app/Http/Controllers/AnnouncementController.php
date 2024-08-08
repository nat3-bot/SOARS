<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ChatifyEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Students;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function osa_create(){
        $announcement = new Announcement();

        $user = Auth::user();
        $author = $user->name;

        $org_group = 'OSA';

        $announcement->title = request('title');
        $announcement->message= request('message');
        $announcement->author= $author;
        $announcement->recipient= request('recipient');
        $announcement->author_org= $org_group;
        $announcement->save();

        return redirect()->route('osaemp')->with('success', 'You have Created an Announcement named: '.$announcement->title);

    }

    public function sl1_create(){
    
        $announcement = new Announcement();

        $user = Auth::user();
        $userId = $user->id;
        // Student No

        // Retrieve the student record
        $student = DB::table('students')->where('student_id','=' ,$userId)->first();
        $studentId = $student->student_id;
        
        $student_org = DB::table('student_organizations')->where('studentid', '=', $studentId)->first(); // Use first() to get a single object
        $student_pos = $student_org->org1_memberstatus;
        $courseId = $student_org->course;
        $org_group = $student_org->org1;

        
        $author = $user->name;


        $announcement->title = request('title');
        $announcement->message= request('message');
        $announcement->author= $author;
        $announcement->recipient= request('recipient');
        $announcement->author_org= $org_group;
        $announcement->save();

        return redirect()->route('student_leader_page');

    }
}

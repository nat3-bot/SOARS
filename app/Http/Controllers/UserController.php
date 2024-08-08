<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    

    public function osa_update_pass(Request $request){
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return view('OSA.user')->with('success', 'Password Changed');
    }

    public function osa_update_email(Request $request)
    {
        
        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        return view('OSA.user')->with('success', 'Profile updated successfully.');
    }

    public function student_update_email(Request $request){
        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        return view('Student.user_profile')->with('success', 'Profile updated successfully.');
    }
    
    public function student_update_pass(Request $request){
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return view('Student.user_profile')->with('success', 'Password Changed');

    }

    public function info(Request $request){
        $user = Auth::user();
        $userInfo = DB::table('users')->where('id','=', $user)->get();
        return view('OSA.user')->with('userInfo', $userInfo);
    }

    public function admin_update_pass(Request $request){
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return view('Admin.admin_profile')->with('success', 'Password Changed');
    }

    public function admin_update_email(Request $request)
    {
        
        $user = Auth::user();
        $user->email = $request->input('email');
        $user->save();

        return view('Admin.admin_profile')->with('success', 'Profile updated successfully.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Member
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect('/login');
        }
            //Member
        $user=Auth::user();
        if($user->role==4){
        return $next($request);
        }
            //OsaEmp
        if($user->role==2){
            return redirect('/osaemp');
        }
            //StudentLeader
        if($user->role==3){
            return redirect('/studentleader');
        }
            //admin
        if($user->role==1){
            return redirect('/admin');
        } 
    }
}

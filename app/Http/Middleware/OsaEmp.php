<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class OsaEmp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect('/soars?timeout=true');
        }
            //OsaEmp
        $user=Auth::user();
        if($user->role==2){
        return $next($request);
        }
            //admin
        if($user->role==1){
            return redirect('/admin');
        }
            //StudentLeader
        if($user->role==3){
            return redirect('/studentleader');
        }
            //Member
        if($user->role==4){
            return redirect('/member');
        } 
        
    }
}

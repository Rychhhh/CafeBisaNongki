<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        //  jika akun yang login sesuai dengan role
        //  maka akses sesuai
        //  jika tidak maka akan diarahkan ke welcome

        $roles = array_slice(func_get_args(), 2);
        

        foreach ($roles as $role) { 
            $user = Auth::user()->role;
            
            if( $user == $role){
                return $next($request);
            } 

            return redirect('dashboard')->with('error ','Anda bukan seorang admin !!!');
        }

    }

    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if(!in_array($request->user()->role, $roles)){
    //         return back()->with('error', 'Anda tidak memiliki hak akses');
    //     }
    //     return $next($request);
    // }
}

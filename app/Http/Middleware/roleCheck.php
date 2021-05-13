<?php

namespace App\Http\Middleware;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class roleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  \string  $roleCheck
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role=User::find(Auth::id());
        if( $role->role == '3'){
            return redirect('/adminDashboard');
        }elseif($role->role == '2'){
            return redirect('/mySchool');
        }elseif($role->role == '1'){
            return redirect('/stuDashboard');
        }else{
            return redirect('/login');
        }
        
       
        return $next($request);
    }
}

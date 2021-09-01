<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {        
        $emp_type =  Auth::user()->idtype == 1;
        $pact = period::where('is_act','=',true)->first();
       
       
        // if(period::where('is_act','=',true)->first() || $emp_type === true ){
        if($emp_type == true && $pact !=null ){
            return $next($request);
        } else {
            return redirect('/Periodo');
        }
        if($emp_type == false && $pact !=null ){       
            return redirect('/home');
        }



    }
}

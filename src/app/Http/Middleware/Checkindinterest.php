<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\IndividualInterest;
use Illuminate\Support\Facades\Crypt;

class Checkindinterest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      
        $user = Auth::user();
        if (Auth::user()) {
            $selectInterest = false;
            if (Auth::user()->role_id == 9) {
                $checkIndividualInterest = IndividualInterest::where('user_id',$user->id)->first();
                    if ($checkIndividualInterest) {
                        $selectInterest = true;
                        //return redirect('ind-home');
                    }
                if($selectInterest == false) {
                    //die('DSS');
                    return redirect('add-interest');
                }
                
            }
            
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Doctor;
class BanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user = User::where('email',$request->email)->first();
        $doctor = Doctor::where('id', $user->typeable_id)->first();
 
        if (isset($doctor)) {//if exists
            if ($doctor && $doctor->banned_at) {
                auth()->logout();
                return redirect()->route('login')->with('error', 'This account is banned.');
            }
        }


        return $next($request);
       
    }
}
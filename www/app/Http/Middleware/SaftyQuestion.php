<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaftyQuestion
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
        $user =auth()->user();

        if($user->SaftyQuestion)
        {
            return $next($request);
        }
        else
        {
            return redirect('/create-saftyQuestion')->with('message', 
                ['type' => 'warning','text' => 'برجاء اجابه سؤال الامان']
            );
        }
    }
}

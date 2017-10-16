<?php

namespace App\Http\Middleware;

use Closure;


class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role='admin')
    {

        // 

        // die('check role');

        // echo $request->title;

        // echo $request->input('title');

        // // $_REQUEST  = $_GET + $_POST

        // dd($request->query());
        // die;

        // if()
        // return redirect('home');

        // $user_id = \Auth::user()->id;
        //get user info  
        // if($role == \Auth::user()->role) {
            
        // } else {
        //     die('sorry you are not allowed to perform this operation');
        // }
        return $next($request);
    }
}

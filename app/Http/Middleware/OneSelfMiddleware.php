<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OneSelfMiddleware
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
        if(Auth::check()) {
            $url = explode("/",$request->getUri());
            $lenght = count($url) - 1 ;
            switch (auth()->user()->rol){
                case "is_enterprise":

                    if(strpos($request->getUri(),"/admin") == true){
                        if ($url[$lenght] != auth()->user()->enterprise->id){
                            return response()->view("errors.403",[],403);
                        }
                    }
                break;

                case "is_student":

                    if(strpos($request->getUri(),"/admin") == true){
                        if ($url[$lenght] != auth()->user()->student->id){
                            return response()->view("errors.403",[],403);
                        }
                    }
                break;

                case "is_teacher":

                    if(strpos($request->getUri(),"/admin") == true){
                        if ($url[$lenght] != auth()->user()->teacher->id){
                            return response()->view("errors.403",[],403);
                        }
                    }
                break;

                case "is_admin":

                break;
            }
            return $next($request);

        }else{

            //No está logueado
            return redirect('login');
        }
    }
}

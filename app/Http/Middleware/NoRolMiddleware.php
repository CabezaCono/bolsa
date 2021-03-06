<?php

namespace App\Http\Middleware;

use Closure; 
use App\User; 
use Illuminate\Support\Facades\Auth; 

class NoRolMiddleware
{ 
    public function handle($request, Closure $next, $rol) { 
        $rols = explode('|', $rol); //Transforma los roles en arrays separados por '|'

        if(Auth::check()){  //Está logueado 
            foreach($rols as $rol){
                if(Auth::user()->rol == $rol) {
                    return response()->view("errors.403",[],403);  //Rol no ok
                }
            }  
            return $next($request); //Rol OK 
        }else{  //No está logueado 
            return redirect('login'); 
        }
    } 
} 
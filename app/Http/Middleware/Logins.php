<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Http\Requests;
use Closure;

class Logins {
   public function handle($request,Closure $next) {
      if($request->session()->has('role')){
          if($request->session()->get('role')=='1'){
            return redirect(route('admin'));
          }
          else if($request->session()->get('role')=='2'){
            return redirect(route('user'));
          }
      }
      return $next($request);
   }
}
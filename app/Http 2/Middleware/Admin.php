<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Http\Requests;
use Closure;

class Admin {
   public function handle($request,Closure $next) {
      if($request->session()->has('role')){
          if($request->session()->get('role')=='2'){
            return $next($request);
          }
          else if($request->session()->get('role')=='1'){
            return redirect(route('home'));
          }
      }
      return redirect(route('login'));
   }
}
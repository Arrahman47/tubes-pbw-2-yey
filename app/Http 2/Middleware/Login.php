<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Http\Requests;
use Closure;

class Login {
   public function redirectTo(Request $r,Closure $next) {
      if($r->session()->has('id')){
          return redirect(route('admin'));
      }
   }
}
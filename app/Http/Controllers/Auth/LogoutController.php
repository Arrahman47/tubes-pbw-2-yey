<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
class LogoutController extends Controller
{

    public function index(Request $request){
        $request->session()->forget('id');
        $request->session()->forget('role');
        $request->session()->forget('name');
        $request->session()->forget('email');
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }
    public function index(){
        return view('auth/login');
    }
    public function check(Request $request){
        $users = DB::select('select * from users ');
        foreach($users as $u){
          //print_r($u->password);
          if(password_verify($request->get('password'), $u->password)){
            $request->session()->put('id',$u->id);
            $request->session()->put('role',$u->role);
            $request->session()->put('name',$u->name);
            $request->session()->put('email',$u->email);
          } 
        }
        return redirect('login');
    }
}

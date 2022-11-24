<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Hash;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request){
        $users = DB::select('select * from users WHERE NOT role = 1');
        return view('admin/home', ['title' => 'USER','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    public function add_user(Request $request){
        DB::insert('INSERT INTO users (email,name,password,role) VALUES(?,?,?,2)',[$request->email,$request->name,Hash::make($request->password)]);
        return redirect(route('admin'));
    }
    public function delete_user(Request $request){
        DB::delete('DELETE FROM users WHERE id=?',[$request->del]);
        return redirect(route('admin'));
    }
    public function edit_user(Request $request){
        DB::update('UPDATE users SET email=?,name=?,password=? WHERE id=?' ,[$request->email,$request->name,Hash::make($request->password),$request->del]);
        return redirect(route('admin'));
    }
    
   
}

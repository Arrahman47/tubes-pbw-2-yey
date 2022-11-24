<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Hash;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function index(Request $request){
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);
        return view('user/home', ['title' => 'USER','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    public function edit_user(Request $request){
        DB::update('UPDATE users SET email=?,name=?,password=? WHERE id=?' ,[$request->email,$request->name,Hash::make($request->password),$request->del]);
        return redirect(route('user'));
    }
    
    public function transaksi(Request $request){
        $users = DB::select('select produk.id , produk.name as nama_produk, produk.id_jenis as id_jenis, produk.harga as harga, jenis.name as nama_jenis, produk.gambar from produk INNER JOIN jenis ON produk.id_jenis = jenis.id');
        $jenis = DB::select('select * FROM jenis');
        return view('user/transaksi', ['title' => 'BELANJA','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users,'jenis' => $jenis]);
    }
    public function add_transaksi(Request $request){
        DB::insert('INSERT INTO transaksi (id_produk,id_user,tanggal,banyak,total) VALUES(?,?,?,?,?)',[$request->del,$request->session()->get('id'),date("Y-m-d"),$request->banyak,$request->banyak*$request->harga]);
        return redirect(route('transaksi')); 
    }
}

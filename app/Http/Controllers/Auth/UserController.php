<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Hash;
use App\Services\Midtrans\CreateSnapTokenService; // => letakkan pada bagian atas class
 
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }
    public function index(Request $request){
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);
        $aktivitas = DB::select('select * from aktivitas join venue on aktivitas.id_venue = venue.id_venue join teater on aktivitas.id_teater = teater.id_teater');
        for($i=0;$i<count($aktivitas);$i++){
          $temp= DB::select('select * from section join aktivitas on aktivitas.id_aktivitas = section.id_aktivitas WHERE aktivitas.id_aktivitas=? ',[$aktivitas[$i]->id_aktivitas]);
          $aktivitas[$i]->show = $temp;
          
        }       
        return view('user/home', ['title' => 'HOME','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'aktivitas' => $aktivitas]);
    }
    public function tiket(Request $request){
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);
        $aktivitas = DB::select('select * from aktivitas join venue on aktivitas.id_venue = venue.id_venue join teater on aktivitas.id_teater = teater.id_teater');
        for($i=0;$i<count($aktivitas);$i++){
          $temp= DB::select('select * from section join aktivitas on aktivitas.id_aktivitas = section.id_aktivitas WHERE aktivitas.id_aktivitas=? ',[$aktivitas[$i]->id_aktivitas]);
          $aktivitas[$i]->show = $temp;
          
        }       
        return view('user/home', ['title' => 'TICKET','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'aktivitas' => $aktivitas]);
    }
    public function buy(Request $request){
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);
        $aktivitas = DB::select('select * from aktivitas join venue on aktivitas.id_venue = venue.id_venue join teater on aktivitas.id_teater = teater.id_teater where aktivitas.id_aktivitas=?',[$request->id_aktivitas]);
        for($i=0;$i<count($aktivitas);$i++){
          $temp= DB::select('select * from section join aktivitas on aktivitas.id_aktivitas = section.id_aktivitas WHERE aktivitas.id_aktivitas=? ',[$aktivitas[$i]->id_aktivitas]);
          $aktivitas[$i]->show = $temp;
          
        } 
        $layout  = DB::select('select * from layout join venue on venue.id_venue = layout.id_venue join aktivitas on venue.id_venue= aktivitas.id_venue where aktivitas.id_aktivitas=?',[$request->id_aktivitas]);
        $bangkus = DB::select('select * from transaksi_header join transaksi_detail on transaksi_header.id_transaksi = transaksi_detail.id_transaksi where transaksi_header.id_aktivitas=?',[$request->id_aktivitas]);
        $section = DB::select('select * from section where section.id_aktivitas=?',[$request->id_aktivitas]);
        $bangku= array();
        foreach($bangkus as $b){
          $ada=0;
          for($i=0;$i<count($bangku);$i++){
            
              array_push($bangku,[$b->no_bangku,$b->jam_tayang,$b->tanggal_tayang]);
          }
          
        }
        $snapToken = "";
		$transaksi = DB::select('select * from transaksi_detail join transaksi_header on transaksi_detail.id_transaksi = transaksi_header.id_transaksi');
        return view('user/home', ['title' => 'BUY','layout' => $layout,'name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'aktivitas' => $aktivitas,'snapToken' => $snapToken,'data_bangku' => $bangku,'section' => $section,'transaksi' => $transaksi]);
    }
    public function pay(Request $request){
        
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);  
        return view('user/home', ['title' => 'PAY','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'item' => $request->item,'total' => $request->total,'id_aktivitas' => $request->id_aktivitas]);
    }
    public function checkout(Request $request){
        $users = DB::select('SELECT id_transaksi FROM transaksi_header ORDER BY id_transaksi DESC LIMIT 1;');
        $str ="TR";
        if(!isset($users[0])){
          $str="TR001";
        }
        else{
        $temp = explode("TR",$users[0]->id_transaksi);
        $number = $temp[count($temp)-1];
        if(((int)$number)+1<10){
          $str.="00";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<100){
          $str.="0";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else {
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        }
        DB::insert('INSERT INTO transaksi_header (id_transaksi,id_user,total,tanggal,id_aktivitas) VALUES(?,?,?,?,?)',[$str,$request->session()->get('id'),$request->total,date("d-m-Y"),$request->id_aktivitas]);
        $arr = explode(",",$request->item);
        for($i=0;$i<count($arr);$i+=4){
          DB::insert('INSERT INTO transaksi_detail (id_transaksi,no_bangku,waktu_tayang,tanggal_tayang,harga) VALUES(?,?,?,?,?)',[$str,$arr[$i],$arr[$i+1],$arr[$i+2],$arr[$i+3]]);
          
        }
        
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);  
        $midtrans = new CreateSnapTokenService($request);
        $snapToken = $midtrans->getSnapToken($str,$arr,$users);
        return view('user/pay', ['snapToken' => $snapToken]);
    }
    public function profile(Request $request){
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);  
        return view('user/home', ['title' => 'PROFILE','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    public function my_ticket(Request $request){
        $users = DB::select('select * from users WHERE id = ?',[$request->session()->get('id')]);  
        $ticket = DB::select('select * , transaksi_detail.waktu_tayang as jam_tayang from transaksi_header join transaksi_detail on transaksi_header.id_transaksi = transaksi_detail.id_transaksi  join aktivitas on aktivitas.id_aktivitas = transaksi_header.id_aktivitas WHERE transaksi_header.id_user = ?',[$request->session()->get('id')]);  
        return view('user/home', ['title' => 'MY TICKET','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users,'data_history' => $ticket]);
    }
    public function edit_user(Request $request){
        DB::update('UPDATE users SET username=?,email=?,password=?,jenkel=?,tanggal_lahir=?,alamat=?,no_hp=? WHERE id=?' ,[$request->username,$request->email,Hash::make($request->password),$request->jenkel,$request->tanggal_lahir,$request->alamat,$request->no_hp,$request->session()->get('id')]);
        return redirect(route('profile'));
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

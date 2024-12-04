<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Hash;
use App\Providers\RouteServiceProvider;
use App\Models\User;
class PenyelenggaraController extends Controller
{
    public function __construct()
    {
    }
    
    
    public function index(Request $request){
        $users = DB::select('select * from venue join aktivitas on venue.id_venue = aktivitas.id_venue join teater on teater.id_teater = aktivitas.id_teater where teater.id_user = ? ',[$request->session()->get('id')]);
        $section = DB::select('select * from section');
        $transaksi = DB::select('select * from transaksi_detail join transaksi_header on transaksi_detail.id_transaksi = transaksi_header.id_transaksi');
        $layout  = DB::select('select * from layout join venue on venue.id_venue = layout.id_venue join aktivitas on venue.id_venue= aktivitas.id_venue ');
        
		//$tempp = DB::select('select transaksi_detail.waktu_tayang, transaksi_detail.tanggal_tayang,transaksi_detail.no_bangku from transaksi_header JOIN transaksi_detail on  transaksi_header.id_transaksi =  transaksi_detail.id_transaksi JOIN aktivitas on aktivitas.id_aktivitas = transaksi_header.id_aktivitas where aktivitas.id_aktivitas = ?',[$users[0]->id_aktivitas]);
        /*for($i=0;$i<count($users);$i++){
          $temp = DB::select('select * from layout_header where id_venue = ?',[$users[$i]->id_venue]);
          $temps = DB::select('select * from section where id_aktivitas = ?',[$users[$i]->id_aktivitas]);
          $temp1= explode(",",$users[$i]->tanggal_tayang);
          $z=0;
          foreach($temp1 as $t1){
            $users[$i]->data[$z]=[$t1,array()];
            $z++;
          }
          for($j=0;$j<count($users[$i]->data);$j++){
            $temp2= explode(",",$users[$i]->jam_tayang);
            $zz=0;
            foreach($temp2 as $t2){
              $users[$i]->data[$j][1][$zz]=[$t2,array()];
              $zz++;
            }
            for($k=0;$k<count($users[$i]->data[$j][1]);$k++){
              $zzz=0;
              foreach($temp as $t){
                $users[$i]->data[$j][1][$k][1][$zzz]=[$t->nama_layout,array(),array()];
                $zzz++;
              }
              $users[$i]->data[$j][1][$k][1][$zzz]=["Balcon",array(),array()];
              $zzz++;
              $users[$i]->data[$j][1][$k][1][$zzz]=["Stall",array(),array()];
              $zzz++;
              for($l=0;$l<count($users[$i]->data[$j][1][$k][1]);$l++){
                $zzzz=0;
                foreach($temps as $t){
                  $users[$i]->data[$j][1][$k][1][$l][1][$zzzz]=[$t->nama_section,0,0];
                  $zzzz++;
                }
                $users[$i]->data[$j][1][$k][1][$l][1][$zzzz]=["Default",0,0];
              }
            }
          }
        }
        
        
        foreach($tempp as $t){
          if($t->waktu_tayang!=""){
            for($i=0;$i<count($users);$i++){
              for($j=0;$j<count($users[$i]->data);$j++){
                if($users[$i]->data[$j][0]== $t->tanggal_tayang){
                  for($k=0;$k<count($users[$i]->data[$j][1]);$k++){
                    if($users[$i]->data[$j][1][$k][0]== $t->waktu_tayang){
                      for($l=0;$l<count($users[$i]->data[$j][1][$k][1]);$l++){
                        //print_r($users[$i]->data[$j][1][$k][1][$l][1]);
                        $nama_layout="Stall";
                        $harga =0 ;
                        $seatmap = DB::select('select * from layout_detail');
                        if(strlen($t->no_bangku)==3){
                          $nama_layout="Stall";
                        }
                        else if(substr($t->no_bangku,0,1)=="B"){
                          $nama_layout="Balcon";
                        }
                        else{
                          foreach($seatmap as $seat){
                            if(substr($t->no_bangku,0,1)==$seat->huruf){
                              $nama_layout=$seat->nama_layout;
                              $harga=$seat->harga;
                            }
                          }
                        }
                        if($nama_layout==$users[$i]->data[$j][1][$k][1][$l][0]){
                          array_push($users[$i]->data[$j][1][$k][1][$l][2],$t->no_bangku);
                          for($m=0;$m<count($users[$i]->data[$j][1][$k][1][$l][1]);$m++){
                            $section = DB::select('select * from section where id_aktivitas = ?',[$users[$i]->id_aktivitas]);
                            $arr_s=array();
                            $ada=0;
                            $seksi="Default";
                            $hargas = 0;
                            foreach($section as $sections){
                              $bangku = explode(",",$sections->no_bangku);
                              foreach($bangku as $bb){
                                if($bb == $t->no_bangku){
                                  $seksi=$sections->nama_section;
                                  $hargas=$sections->harga;
                                }
                              }
                            }
                            if($seksi  == $users[$i]->data[$j][1][$k][1][$l][1][$m][0]){
                              $users[$i]->data[$j][1][$k][1][$l][1][$m][1]++;
                              if($seksi == "Default"){
                                if($nama_layout=="Stall" || $nama_layout=="Balcon"){
                                  $users[$i]->data[$j][1][$k][1][$l][1][$m][2]+= 1000000;
                                }
                                else{
                                  $users[$i]->data[$j][1][$k][1][$l][1][$m][2]+= $harga;
                                }
                              }
                              else{
                                  $users[$i]->data[$j][1][$k][1][$l][1][$m][2]+= $hargas;
                                
                              }
                            }
                          }  
                        }
                      }
                    }
                  }
                }
              }
              }
            }
          }
              */
        //print_r($tempp);
        return view('penyelenggara/index', ['title' => 'TRANSAKSI','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users,'transaksi' => $transaksi,'section' => $section,'layout' => $layout]);
    }
    public function add_venue(Request $request){
        $users = DB::select('SELECT id_venue FROM venue ORDER BY id_venue DESC LIMIT 1;');
        $str ="V";
        if(!isset($users[0])){
          $str="V001";
        }
        $temp = explode("V",$users[0]->id_venue);
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
        DB::insert('INSERT INTO venue (id_venue,nama_venue,alamat_venue,jumlah_lantai) VALUES(?,?,?,?)',[$str,$request->nama_venue,$request->alamat_venue,$request->jumlah_lantai]);
        return redirect(route('admin'));
    }
    public function delete_venue(Request $request){
        DB::delete('DELETE FROM venue WHERE id_venue=?',[$request->del]);
        return redirect(route('admin'));
    }
    public function edit_venue(Request $request){
        DB::update('UPDATE venue SET nama_venue=? ,alamat_venue=? ,jumlah_lantai=?  WHERE id_venue=?' ,[$request->nama_venue,$request->alamat_venue,$request->jumlah_lantai,$request->del]);
        return redirect(route('admin'));
    }
    
    
    
    public function customer(Request $request){
        $users = DB::select('select * from users WHERE role = 2');
        return view('admin/customer', ['title' => 'CUSTOMER','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    public function add_customer(Request $request){
        $users = DB::select('SELECT id FROM users ORDER BY id DESC LIMIT 1;');
        $str ="U";
        if(!isset($users[0])){
          $str="U000001";
        }
        $temp = explode("U",$users[0]->id);
        $number = $temp[count($temp)-1];
        if(((int)$number)+1<10){
          $str.="00000";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<100){
          $str.="0000";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<1000){
          $str.="000";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<10000){
          $str.="00";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<100000){
          $str.="0";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else {
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        DB::insert('INSERT INTO users (id,username,email,password,jenkel,tanggal_lahir,alamat,no_hp,role) VALUES(?,?,?,?,?,?,?,?,?)',[$str,$request->username,$request->email,Hash::make($request->password),$request->jenkel,$request->tanggal_lahir,$request->alamat,$request->no_hp,2]);
        return redirect(route('customer'));
    }
    public function delete_customer(Request $request){
        DB::delete('DELETE FROM users WHERE id=?',[$request->del]);
        return redirect(route('customer'));
    }
    public function edit_customer(Request $request){
        DB::update('UPDATE users SET username=? ,email=? ,password=?,jenkel=?,tanggal_lahir=?,alamat=?,no_hp=?  WHERE id=?' ,[$request->username,$request->email,Hash::make($request->password),$request->jenkel,$request->tanggal_lahir,$request->alamat,$request->no_hp,$request->del]);
        return redirect(route('customer'));
    }
    
    
    
    public function penyelenggara(Request $request){
        $users = DB::select('select * from users JOIN teater on teater.id_user = users.id WHERE users.role = 3');
        return view('admin/penyelenggara', ['title' => 'PENYELENGGARA','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    public function add_penyelenggara(Request $request){
        $users = DB::select('SELECT id FROM users ORDER BY id DESC LIMIT 1;');
        $str ="U";
        if(!isset($users[0])){
          $str="U000001";
        }
        $temp = explode("U",$users[0]->id);
        $number = $temp[count($temp)-1];
        if(((int)$number)+1<10){
          $str.="00000";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<100){
          $str.="0000";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<1000){
          $str.="000";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<10000){
          $str.="00";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else if(((int)$number)+1<100000){
          $str.="0";
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        else {
          $temps = ((int)$number)+1;
          $str.=(string) $temps;
        }
        DB::insert('INSERT INTO users (id,username,email,password,jenkel,tanggal_lahir,alamat,no_hp,role) VALUES(?,?,?,?,?,?,?,?,?)',[$str,$request->username,$request->email,Hash::make($request->password),$request->jenkel,$request->tanggal_lahir,$request->alamat,$request->no_hp,3]);
        $ids = $str;
        $users = DB::select('SELECT id_teater FROM teater ORDER BY id_teater DESC LIMIT 1;');
        $str ="T";
        if(!isset($users[0])){
          $str="T0001";
        }
        $temp = explode("T",$users[0]->id_teater);
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
        DB::insert('INSERT INTO teater (id_teater,nama_teater,alamat_teater,nomor_telpon,id_user) VALUES(?,?,?,?,?)',[$str,$request->nama_teater,$request->alamat_teater,$request->nomor_telpon,$ids]);
        return redirect(route('penyelenggara'));
    }
    public function delete_penyelenggara(Request $request){
        DB::delete('DELETE FROM teater WHERE id_user=?',[$request->del]);
        return redirect(route('penyelenggara'));
    }
    public function edit_penyelenggara(Request $request){
        DB::update('UPDATE users SET username=? ,email=? ,password=?,jenkel=?,tanggal_lahir=?,alamat=?,no_hp=?  WHERE id=?' ,[$request->username,$request->email,Hash::make($request->password),$request->jenkel,$request->tanggal_lahir,$request->alamat,$request->no_hp,$request->del]);
        DB::update('UPDATE teater SET nama_teater=? ,alamat_teater=? ,nomor_telpon=?  WHERE id_user=?' ,[$request->nama_teater,$request->alamat_teater,$request->nomor_telpon,$request->del]);
        return redirect(route('penyelenggara'));
    }
    
    public function teater(Request $request){
        $users = DB::select('select * from teater ');
        return view('admin/teater', ['title' => 'TEATER','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    
    public function aktivitas(Request $request){
        $users = DB::select('select * from aktivitas join venue on aktivitas.id_venue = venue.id_venue join teater on aktivitas.id_teater = teater.id_teater');
        $venue = DB::select('select * from venue');
        $teater = DB::select('select * from teater');
        return view('admin/aktivitas', ['title' => 'AKTIVITAS','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users,'data_venue' => $venue,'data_teater' => $teater]);
    }
    public function add_aktivitas(Request $request){
        $users = DB::select('SELECT id_teater FROM aktivitas ORDER BY id_aktivitas DESC LIMIT 1;');
        $str ="A";
        if(!isset($users[0])){
          $str="A0001";
        }
        $temp = explode("A",$users[0]->id_teater);
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
        
        $destinationPath = 'uploads';
        $myimage = $request->file('poster')->getClientOriginalName();
        $request->file('poster')->move(public_path($destinationPath), $myimage);
        DB::insert('INSERT INTO aktivitas (id_aktivitas,id_venue,id_teater,tanggal_mulai,jam_mulai,jam_selesai,nama_aktivitas,poster) VALUES(?,?,?,?,?,?,?,?)',[$str,$request->id_venue,$request->id_teater,$request->tanggal_mulai,$request->jam_mulai,$request->jam_selesai,$request->nama_aktivitas,$myimage]);
        return redirect(route('aktivitas'));
    }
    public function delete_aktivitas(Request $request){
        DB::delete('DELETE FROM aktivitas WHERE id_aktivitas=?',[$request->del]);
        return redirect(route('aktivitas'));
    }
    public function edit_aktivitas(Request $request){
        
        $destinationPath = 'uploads';
        $myimage = $request->file('poster')->getClientOriginalName();
        $request->file('poster')->move(public_path($destinationPath), $myimage);
        DB::update('UPDATE aktivitas SET id_venue=? , id_teater=? , tanggal_mulai=? , jam_mulai=? , jam_selesai=? , nama_aktivitas=? , poster=? WHERE id_aktivitas=?' ,[$request->id_venue,$request->id_teater,$request->tanggal_mulai,$request->jam_mulai,$request->jam_selesai,$request->nama_aktivitas,$myimage,$request->del]);
        return redirect(route('aktivitas'));
    }
    
    
    public function section(Request $request){
        $users = DB::select('select * from section join aktivitas on aktivitas.id_aktivitas = section.id_aktivitas');
        $aktivitas = DB::select('select * from aktivitas');
        return view('admin/section', ['title' => 'SECTION','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users,'data_aktivitas' => $aktivitas]);
    }
    public function add_section(Request $request){
        $users = DB::select('SELECT id_section FROM section ORDER BY id_section DESC LIMIT 1;');
        $str ="S";
        if(!isset($users[0])){
          $str="S0001";
        }
        else{
          $temp = explode("S",$users[0]->id_section);
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
        DB::insert('INSERT INTO section (id_section,id_aktivitas,no_bangku,harga,nama_section) VALUES(?,?,?,?,?)',[$str,$request->id_aktivitas,$request->no_bangku,$request->harga,$request->nama_section]);
        return redirect(route('section'));
    }
    public function delete_section(Request $request){
        DB::delete('DELETE FROM section WHERE id_section=?',[$request->del]);
        return redirect(route('section'));
    }
    public function edit_section(Request $request){
        DB::update('UPDATE section SET id_aktivitas=? , no_bangku=? , harga=? , nama_section=? WHERE id_section=?' ,[$request->id_aktivitas,$request->no_bangku,$request->harga,$request->nama_section,$request->del]);
        return redirect(route('section'));
    }
    
    public function u(Request $request){
        $users = DB::select('select * from users ');
        return view('admin/user', ['title' => 'USER','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data_user' => $users]);
    }
    public function add_user(Request $request){
        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'jenkel' => $request['jenkel'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'alamat' => $request['alamat'],
            'no_hp' => $request['no_hp'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect(route('u'));
    }
    public function delete_user(Request $request){
        DB::delete('DELETE FROM users WHERE id=?',[$request->del]);
        return redirect(route('u'));
    }
    public function edit_user(Request $request){
        DB::update('UPDATE teater SET username=? , email=?, jenkel=?, tanggal_lahir=?, alamat=?, no_hp=?, password=? WHERE id=?' ,[$request->username,$request->email,$request->jenkel,$request->tanggal_lahir,$request->alamat,$request->no_hp,Hash::make($request->password),$request->del]);
        return redirect(route('u'));
    }
    
   
}

<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\Providers\RouteServiceProvider;
use App\Models\User;
class AdminController extends Controller
{
    
    
    public function index(Request $request){
        
        $layanan = DB::select("SELECT count(*)as layanan FROM layanan ");
        $promo = DB::select("SELECT count(*)as promo FROM promo ");
        $transaksi = DB::select("SELECT count(*)as transaksi FROM transaksi ");
        $data = DB::select("SELECT * FROM user where id_user = ? ",[$request->session()->get('id')]);
        $tahun="";
        $semester="";
        $str = explode('-',date("Y-m-d"));
        $arr=array(
          'layanan' => $anggota[0]->layanan,
          'promo' => $pengguna[0]->promo,
          'transaksi' => $artikel[0]->transaksi
        );
        return view('admin/dashboard', ['title' => 'DASHBOARD','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $arr,'data_diri' => $data]);
    }

    
    public function admin_user(Request $request){
      $users = DB::select('select * from user');
      return view('admin/user', ['title' => 'USER','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $users]);
  }


  public function add_user(Request $request){
      DB::insert('INSERT INTO user (fullname,username,password) VALUES(?,?,?)',[$request->fullname,$request->username,password_hash($request->password,PASSWORD_DEFAULT)]);
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <body>  
      <script>
            // Menampilkan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil ditambah',
                timer: 2000, // Durasi SweetAlert dalam milidetik
                showConfirmButton: false // Menghilangkan tombol konfirmasi
            }).then(() => {
                // Redirect setelah SweetAlert ditutup
                window.location.href = '/admin_user'; // Ganti dengan URL tujuan Anda
            });
      </script>
      </body>
      <?php
  }
  public function delete_user(Request $request){
      DB::delete('DELETE FROM user WHERE id_user=?',[$request->del]);
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <body>  
      <script>
            // Menampilkan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dihapus',
                timer: 2000, // Durasi SweetAlert dalam milidetik
                showConfirmButton: false // Menghilangkan tombol konfirmasi
            }).then(() => {
                // Redirect setelah SweetAlert ditutup
                window.location.href = '/admin_user'; // Ganti dengan URL tujuan Anda
            });
      </script>
      </body>
      <?php
  }
  public function edit_user(Request $request){
      DB::update('UPDATE user SET fullname=?,username=?,password=? WHERE id_user=?' ,[$request->fullname,$request->username,password_hash($request->password,PASSWORD_DEFAULT),$request->del]);
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <body>  
      <script>
            // Menampilkan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil diubah',
                timer: 2000, // Durasi SweetAlert dalam milidetik
                showConfirmButton: false // Menghilangkan tombol konfirmasi
            }).then(() => {
                // Redirect setelah SweetAlert ditutup
                window.location.href = '/admin_user'; // Ganti dengan URL tujuan Anda
            });
      </script>
      </body>
      <?php
  }


  
    
public function user_pemesanan(Request $request){
    $users = DB::select('select * from layanan');
    $today = date('Y-m-d');

    $userss = DB::select('select * from promo where start_date <= ? and end_date >= ?', [$today, $today]);
    return view('admin/pemesanan', ['title' => 'PEMESANAN','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $users,'data1' => $userss]);
}


public function add_pemesanan(Request $request){
    $fileName = time().'_'.$request->file('bukti_pembayaran')->getClientOriginalName();
    $filePath = $request->file('bukti_pembayaran')->storeAs('uploads', $fileName, 'public');
    DB::insert('INSERT INTO transaksi (id_user,id_layanan,id_promo,qty,bukti_pembayaran) VALUES(?,?,?,?,?)',[$request->session()->get('id'),$request->id_layanan,$request->id_promo,$request->qty,$filePath]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil ditambah',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/user_history'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}  

public function user_history(Request $request){
    $users = DB::select('
        SELECT transaksi.*, layanan.*, 
            CASE 
                WHEN promo.id_promo IS NULL THEN "Tidak Menggunakan Promo"
                ELSE promo.nama_promo 
            END AS nama_promo
        FROM transaksi 
        JOIN layanan ON transaksi.id_layanan = layanan.id_layanan 
        LEFT JOIN promo ON promo.id_promo = transaksi.id_promo
    ');
    return view('admin/history', ['title' => 'HISTORY','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $users]);
}  

public function admin_transaksi(Request $request){
    $users = DB::select('
        SELECT transaksi.*, layanan.*, user.*, 
            CASE 
                WHEN promo.id_promo IS NULL THEN "Tidak Menggunakan Promo"
                ELSE promo.nama_promo 
            END AS nama_promo
        FROM transaksi 
        JOIN user ON transaksi.id_user = user.id_user 
        JOIN layanan ON transaksi.id_layanan = layanan.id_layanan 
        LEFT JOIN promo ON promo.id_promo = transaksi.id_promo
    ');
    return view('admin/transaksi', ['title' => 'TRANSAKSI','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $users]);
}
public function delete_transaksi(Request $request){
    DB::delete('DELETE FROM transaksi WHERE id_transaksi=?',[$request->del]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil dihapus',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_transaksi'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
public function edit_transaksi(Request $request){
    DB::update('UPDATE transaksi SET status=? WHERE id_transaksi=?' ,[$request->status,$request->del]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil diubah',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_transaksi'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
  
    
public function admin_layanan(Request $request){
    $users = DB::select('select * from layanan');
    return view('admin/layanan', ['title' => 'LAYANAN','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $users]);
}


public function add_layanan(Request $request){
    DB::insert('INSERT INTO layanan (nama_layanan,harga,satuan,deskripsi) VALUES(?,?,?,?)',[$request->nama_layanan,$request->harga,$request->satuan,$request->deskripsi]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil ditambah',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_layanan'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
public function delete_layanan(Request $request){
    DB::delete('DELETE FROM layanan WHERE id_layanan=?',[$request->del]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil dihapus',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_layanan'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
public function edit_layanan(Request $request){
    DB::update('UPDATE layanan SET nama_layanan=?,harga=?,satuan=?,deskripsi=? WHERE id_layanan=?' ,[$request->nama_layanan,$request->harga,$request->satuan,$request->deskripsi,$request->del]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil diubah',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_layanan'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
    
public function admin_promo(Request $request){
    $users = DB::select('select * from promo join layanan on promo.id_layanan = layanan.id_layanan');
    $userss = DB::select('select * from layanan');
    return view('admin/promo', ['title' => 'PROMO','name' => $request->session()->get('name'),'role' => $request->session()->get('role'),'data' => $users,'data1' => $userss]);
}


public function add_promo(Request $request){
    DB::insert('INSERT INTO promo (nama_promo,discount,id_layanan,start_date,end_date) VALUES(?,?,?,?,?)',[$request->nama_promo,$request->discount,$request->id_layanan,$request->start_date,$request->end_date]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil ditambah',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_promo'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
public function delete_promo(Request $request){
    DB::delete('DELETE FROM promo WHERE id_promo=?',[$request->del]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil dihapus',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_promo'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}
public function edit_promo(Request $request){
    DB::update('UPDATE promo SET nama_promo=?,discount=?,id_layanan=?,start_date=?,end_date=? WHERE id_promo=?' ,[$request->nama_promo,$request->discount,$request->id_layanan,$request->start_date,$request->end_date,$request->del]);
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <body>  
    <script>
          // Menampilkan SweetAlert
          Swal.fire({
              icon: 'success',
              title: 'Berhasil',
              text: 'Data berhasil diubah',
              timer: 2000, // Durasi SweetAlert dalam milidetik
              showConfirmButton: false // Menghilangkan tombol konfirmasi
          }).then(() => {
              // Redirect setelah SweetAlert ditutup
              window.location.href = '/admin_promo'; // Ganti dengan URL tujuan Anda
          });
    </script>
    </body>
    <?php
}

    
   
}

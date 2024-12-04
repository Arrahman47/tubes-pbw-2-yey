<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
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
        $ada=0;
        $users = DB::select('select * from user ');
        foreach($users as $u){
          //print_r($u->password);
          if($request->get('username') == $u->username){
            $request->session()->put('id',$u->id_user);
            if($request->get('username')=="admin"){
              $request->session()->put('role',2);
              $ada=1;
            }
            else{
              $ada =1;
              $request->session()->put('role',1);
            }
            $request->session()->put('name',$u->fullname);
            if($request->get('username')=="admin"){
              ?>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              <body>  
              <script>
                    // Menampilkan SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Selamat Datang',
                        timer: 2000, // Durasi SweetAlert dalam milidetik
                        showConfirmButton: false // Menghilangkan tombol konfirmasi
                    }).then(() => {
                        // Redirect setelah SweetAlert ditutup
                        window.location.href = '/admin'; // Ganti dengan URL tujuan Anda
                    });
              </script>
              </body>
              <?php
            }
            else {
              ?>
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              <body>  
              <script>
                    // Menampilkan SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'selamat datang',
                        timer: 2000, // Durasi SweetAlert dalam milidetik
                        showConfirmButton: false // Menghilangkan tombol konfirmasi
                    }).then(() => {
                        // Redirect setelah SweetAlert ditutup
                        window.location.href = '/user'; // Ganti dengan URL tujuan Anda
                    });
              </script>
              </body>
              <?php
            }
          } 
        }
        if($ada==0){
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <body>  
        <script>
              // Menampilkan SweetAlert
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: 'Username atau password mungkin salah',
                  timer: 2000, // Durasi SweetAlert dalam milidetik
                  showConfirmButton: false // Menghilangkan tombol konfirmasi
              }).then(() => {
                  // Redirect setelah SweetAlert ditutup
                  window.location.href = '/login'; // Ganti dengan URL tujuan Anda
              });
        </script>
        </body>
        <?php
      }
    }
}

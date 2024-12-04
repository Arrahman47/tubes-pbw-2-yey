<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
class RegisterController extends Controller
{
    public function index(){
        return view('auth/register');
    }
    public function create(Request $request){
      DB::insert('INSERT INTO user (fullname,username,password) VALUES(?,?,?)',[$request->nama,$request->username,password_hash($request->password,PASSWORD_DEFAULT)]);
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <body>  
      <script>
            // Menampilkan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Registrasi berhasil',
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

<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Hash;
use App\Providers\RouteServiceProvider;
use App\Models\User;
class GuestController extends Controller
{
    
    
    public function index(Request $request){
        if($request->session()->get('role')!==null){
            return view('Guest/index',['role'=>1]);
        }
        return view('Guest/index',['role'=>0]);
    }
    
    public function team(Request $request){
        $users = DB::select('select * from anggota');
        if($request->session()->get('role')!==null){
            return view('Guest/team',['role'=>1,'data' => $users,'nama'=>$request->session()->get('nama')]);
        }
        return view('Guest/team',['role'=>0,'data' => $users]);
    }
    
    public function about(Request $request){
        $users = DB::select('select * from anggota');
        if($request->session()->get('role')!==null){
            return view('Guest/about',['role'=>1,'data' => $users]);
        }
        return view('Guest/about',['role'=>0,'data' => $users]);
    }
    
    public function service(Request $request){
        $users = DB::select('select * from jasa');
        $userss = DB::select('select * from perkara');
        for($i=0;$i<count($userss);$i++){
            $temp = DB::select('select * from perkara_detail where id_perkara=?',[$userss[$i]->id_perkara]);
            $userss[$i]->data = $temp;
            //print_r($users[$i]);
        }
        if($request->session()->get('role')!==null){
            return view('Guest/service',['role'=>1,'nama'=>$request->session()->get('name'),'data' => $users,'data1' => $userss]);
        }
        return view('Guest/service',['role'=>0,'data' => $users]);
    }
    
    public function history(Request $request){
        $users = DB::select('select * from jasa join transaksi on jasa.id_jasa = transaksi.id_jasa where transaksi.id_user=?',[$request->session()->get('id')]);
        for($i=0;$i<count($users);$i++){
            $data = DB::select('select * from perkara join perkara_detail on perkara_detail.id_perkara = perkara.id_perkara join hasil_perkara on hasil_perkara.id_perkara_detail = perkara_detail.id_perkara_detail where hasil_perkara.id_transaksi=?',[$users[$i]->id_transaksi]);
            $users[$i]->data=$data;
        }
        return view('Guest/history',['role'=>1,'nama'=>$request->session()->get('name'),'data' => $users]);
    }
    
    public function contact_us(Request $request){
        if($request->session()->get('role')!==null){
            return view('Guest/contact_us',['role'=>1,'nama'=>$request->session()->get('name')]);
        }
        return view('Guest/contact_us',['role'=>0]);
    }
    public function add_service(Request $request){
        $fileName = time().'_'.$request->file('dokumen_pendukung')->getClientOriginalName();
        $filePath = $request->file('dokumen_pendukung')->storeAs('uploads', $fileName, 'public');
        $fileName1 = time().'_'.$request->file('persetujuan')->getClientOriginalName();
        $filePath1 = $request->file('persetujuan')->storeAs('uploads', $fileName1, 'public');
        $id_perkara = $request->id_perkara;
        
        $data = DB::select('select * from perkara join perkara_detail on perkara_detail.id_perkara = perkara.id_perkara where perkara.id_perkara=?',[$id_perkara]);
        
        DB::insert('INSERT INTO transaksi (nama_lengkap,alamat,no_telp,dokumen_pendukung,persetujuan,id_jasa,id_user) VALUES(?,?,?,?,?,?,?)',[$request->nama_lengkap,$request->alamat,$request->no_telp,$fileName,$fileName1,$request->del,$request->session()->get('id')]);
        $id = DB::select('SELECT * FROM transaksi ORDER BY id_transaksi DESC LIMIT 1')[0]->id_transaksi;
        print_r($id);
        foreach($data as $d){
            $hasil = "";
            if($d->type =="file"){
                $fileName = time().'_'.$request->file($d->id_perkara_detail)->getClientOriginalName();
                $filePath = $request->file($d->id_perkara_detail)->storeAs('uploads', $fileName, 'public');
                $hasil = $fileName;
            }
            else{
                $hasil=$request[$d->id_perkara_detail];
            }
            DB::insert('INSERT INTO hasil_perkara (id_transaksi,id_perkara_detail,hasil) VALUES(?,?,?)',[$id,$d->id_perkara_detail,$hasil]);
        }
         
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <body>  
      <script>
            // Menampilkan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil ditambahkan',
                timer: 2000, // Durasi SweetAlert dalam milidetik
                showConfirmButton: false // Menghilangkan tombol konfirmasi
            }).then(() => {
                // Redirect setelah SweetAlert ditutup
                window.location.href = '/service'; // Ganti dengan URL tujuan Anda
            });
      </script>
      </body>
      <?php
    }
    
    public function artikel(Request $request){
        $users = DB::select('select * from artikel join kategori on artikel.id_kategori = kategori.id_kategori');
        $userss = DB::select('select * from kategori');
        if($request->session()->get('role')!==null){
            return view('Guest/artikel',['role'=>1,'data' => $users,'data1' => $userss]);
        }
        return view('Guest/artikel',['role'=>0,'data' => $users,'data1' => $userss]);
    }
    public function api_artikel(Request $request){
        if($_GET['id_kategori']=="semua"){
            $data = DB::select("SELECT * FROM artikel  join kategori on artikel.id_kategori = kategori.id_kategori ");
        }
        else{
            $data = DB::select("SELECT * FROM artikel  join kategori on artikel.id_kategori = kategori.id_kategori where artikel.id_kategori = '".$_GET['id_kategori']."'");
        }
        foreach($data as $d){
        ?>
            <article class="entry">
    
            <div class="entry-img">
                <img src="storage/uploads/<?=$d->gambar?>" alt="" class="img-fluid">
            </div>
    
            <h2 class="entry-title">
                <a href="blog-single.html"><?=$d->judul_artikel?></a>
            </h2>
    
            <div class="entry-meta">
                <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html"><?=$d->nama_kategori?></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01"><?=$d->tanggal?></time></a></li>
                </ul>
            </div>
    
            <div class="entry-content">
                <p><?=$d->isi?></p>
            </div>
    
            </article><!-- End blog entry -->

        <?php  }
        
    }
    
   
}

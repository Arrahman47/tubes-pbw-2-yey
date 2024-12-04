@include('../template/header');
@include('../template/sidebar');
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$title?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-users mr-1"></i>
                  Transaksi
              </h3>
            <div class="card-tools">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <?php if(isset($_SESSION['message'])){if($_SESSION['message']!=''){echo $_SESSION['message'];$_SESSION['message']='';}}
      ?>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Layanan</th>
                <th>Promo</th>
                <th>Jumlah Pemesanan</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Timestamp</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=1;
                foreach($data as $d){
                  ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $d->nama_layanan?></td>
                    <td><?= $d->nama_promo?></td>
                    <td><?= $d->qty?></td>
                    <td><?= $d->status?></td>
                    <td><img src='{{ asset("/storage/$d->bukti_pembayaran") }}' width="100px"></td>
                    <td><?= $d->timestamp?></td>
                    </tr>
                  <?php

                   $i++;}
                  ?>
                  </tbody>
                </table>
          </div>
              <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 

@include('../template/footer');
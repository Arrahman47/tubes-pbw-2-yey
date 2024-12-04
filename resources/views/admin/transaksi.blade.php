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
                <th>User</th>
                <th>Layanan</th>
                <th>Promo</th>
                <th>Jumlah Pemesanan</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Timestamp</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=1;
                foreach($data as $d){
                  ?>
                  <tr>
                    <td><?= $i;?></td>
                    <td><?= $d->fullname?></td>
                    <td><?= $d->nama_layanan?></td>
                    <td><?= $d->nama_promo?></td>
                    <td><?= $d->qty?></td>
                    <td><?= $d->status?></td>
                    <td><img src='{{ asset("/storage/$d->bukti_pembayaran") }}' width="100px"></td>
                    <td><?= $d->timestamp?></td>
                    <td align="center"><button type="button" class="btn btn-sm bg-warning" data-toggle="modal" data-target="#exampleModalss<?=$i;?>"><i class="fas fa-edit"></i></button></td>
                    <td align="center"><button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#exampleModals<?=$i;?>"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <div class="modal fade" id="exampleModals<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <form method="post" action="{{route('delete_transaksi')}}">@csrf
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data </h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            Apakah anda yakin ingin menghapus data ?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="text" value="<?= $d->id_transaksi; ?>" name="del"style="display:none">
                            <input  type="submit" class="btn btn-sm bg-danger" value="DELETE">
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
                    
                    <div class="modal fade" id="exampleModalss<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <form method="post" action="{{route('edit_transaksi')}}"  enctype="multipart/form-data">@csrf
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">EDIT Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
      
      
                          <div class="modal-body"> 
                            <div class="form-group row" style="margin-left:-120px;">
                            <label class="col-sm-2 col-form-label" style="margin-left: 150px;">Status</label>
                            <div class="col-sm-6">
                                <select  name="status" class="form-control" placeholder="" required>
                                  <option value="Pending">Pending</option>
                                  <option value="Diterima">Diterima</option>
                                  <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                            </div>    
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <input type="text" value="<?= $d->id_transaksi; ?>" name="del"style="display:none">
                          <input  type="submit" class="btn btn-sm bg-warning" value="EDIT">
                        </div>
                      </div>
                      </form>
                      </div>
                    </div>
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
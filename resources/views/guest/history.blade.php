
@include('../template/header_user');

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>History</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>History</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->


    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">


        <div class="row">
            <!-- ======= Blog Section ======= -->
            <section id="blog" class="blog">
                <div class="container" data-aos="fade-up">

                <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama Lengkap</th>
                <th>Jasa</th>
                <th>Alamat</th>
                <th>Nomor Telpon</th>
                <th>Dokumen Pendukung</th>
                <th>Persetujuan Pernyataan Klien</th>
                <th>Status</th>
                <th>Perkara</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $i=1;
                foreach($data as $d){?>
                  <tr>
                    <td><?= $d->nama_lengkap?></td>
                    <td><?= $d->nama_jasa?></td>
                    <td><?= $d->alamat?></td>
                    <td><?= $d->no_telp?></td>
                    <td><a href="{{ asset('/storage/uploads/'.$d->dokumen_pendukung) }}">Dokumen Pendukung</a></td>
                    <td><a href="{{ asset('/storage/uploads/'.$d->persetujuan) }}">Persetujuan Pernyataan Klien</a></td>
                    <td><?= $d->status?></td>
                    <td align="center"><button type="button" class="btn btn-sm bg-info" data-toggle="modal" data-target="#exampleModalss<?=$i;?>">Perkara</button></td>
                    <div class="modal fade" id="exampleModalss<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Data Perkara </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
      
      
                          <div class="modal-body" style="padding:50px"> 
                              <div class="row">
                                <div class="col" style="border:1px solid black"><b>Label</b></div>
                                <div class="col" style="border:1px solid black"><b>Hasil</b></div>
                              </div>
                              <?php foreach($d->data as $dd){?>
                              <div class="row">
                                <div class="col" style="border:1px solid black"><?=$dd->nama_perkara_detail?></div>
                                <?php if($dd->type == "file"){?>
                                <div class="col" style="border:1px solid black"><a href="{{ asset('/storage/uploads/'.$dd->hasil) }}">Dokumen Pendukung</a></div>
                                <?php }else{?>
                                <div class="col" style="border:1px solid black"><?=$dd->hasil?></div>
                                <?php }?>
                              </div>
                              <?php }?>
                          </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <input type="text" value="<?= $d->id_transaksi; ?>" name="del"style="display:none">
                        </div>
                      </div>
                      </div>
                    </div>
                    </tr>
                    
                  <?php

                   $i++;}
                  ?>
                  </tbody>
                </table>

                </div>
                </section><!-- End Blog Section -->

            </main><!-- End #main -->


        </div>

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->
  @include('../template/footer_user');
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  

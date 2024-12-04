@include('../template/header_user');

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Service</h2>
            <ol>
                <li><a href="index.php">Home</a></li>
                <li>Service</li>
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
                    <div class="row">
                        <?php $i = 0; foreach($data as $d) { ?>
                        <div class="col-lg-4 mt-5">
                            <div class="card" style="width: 28rem;">
                                <img class="card-img-top" src="storage/uploads/<?= $d->gambar ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $d->nama_jasa ?> <small>(Rp<?= $d->biaya ?>)</small></h5>
                                    <p class="card-text"><?= $d->deskripsi ?></p>
                                    <button type="button" class="btn btn-sm bg-info" data-toggle="modal" data-target="#exampleModalss<?= $i; ?>">Pesan</button>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModalss<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <form method="post" action="{{ route('add_service') }}" enctype="multipart/form-data">@csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pesan Jasa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="nama_lengkap" class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Alamat</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="alamat" class="form-control" placeholder="" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nomor Telpon</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="no_telp" class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Dokumen Pendukung</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="dokumen_pendukung" class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Persetujuan Pernyataan Klien</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="persetujuan" class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                                <input id="id_pekara<?= $i ?>" name="id_perkara">
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <?php foreach($data1 as $dd) { ?>
                                                <li><a data-toggle="tab" href="#<?= $dd->id_perkara ?>_<?= $i ?>"><?= $dd->nama_perkara ?></a></li>
                                                <?php } ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php foreach($data1 as $dd) { ?>
                                                <div id="<?= $dd->id_perkara ?>_<?= $i ?>" class="tab-pane fade" style="padding:10px">
                                                    <?php foreach($dd->data as $ddd) { ?>
                                                    <div class="form-group row">
                                                        <label class="col-sm-4 col-form-label"><?= $ddd->nama_perkara_detail ?></label>
                                                        <div class="col-sm-8">
                                                            <input type="<?= $ddd->type ?>" name="<?= $ddd->id_perkara_detail ?>" class="form-control" placeholder="" >
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input type="text" value="<?= $d->id_jasa; ?>" name="del" style="display:none">
                                                <input type="submit" class="btn btn-sm bg-warning" value="Pesan">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- End blog entries list -->
                        <?php $i++; } ?>
                    </div>
                </div>
            </section><!-- End Blog Section -->
        </div>
    </div>
</section><!-- End Team Section -->

</main><!-- End #main -->
@include('../template/footer_user');

<script>
$(document).ready(function() {
    
    $('a[data-toggle="tab"]').click(function(event) {
        event.preventDefault(); // Mencegah tindakan default tautan
        var target = $(this).attr('href'); // Ambil nilai href dari elemen yang diklik
        <?php for($x=0;$x<$i;$x++){
            foreach($data1 as $dd) { ?>
                if(target == "#<?= $dd->id_perkara ?>_<?= $x ?>"){
                    $("#id_pekara<?= $x ?>").val(<?=$dd->id_perkara ?>);
                }
            <?php } 
        }?>
    });

});
</script>

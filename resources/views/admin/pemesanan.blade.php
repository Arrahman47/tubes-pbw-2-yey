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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$title?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

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
            <form method="post" action="{{route('add_pemesanan')}}"   enctype="multipart/form-data" >@csrf
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label" >Layanan</label>
                    <div class="col-sm-6">
                        <select name="id_layanan" id="id_layanan" class="form-control" required>
                            <?php foreach($data as $d) { ?>
                            <option value="<?=$d->id_layanan?>" data-price="<?=$d->harga?>"><?= $d->nama_layanan ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>  
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label" >Promo</label>
                    <div class="col-sm-6">
                        <select name="id_promo" class="form-control" required>
                            <option value="0" data-discount="0">Tidak Menggunakan Promo</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label" >Jumlah Pemesanan</label>
                    <div class="col-sm-6">
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="" required>
                    </div>
                </div>
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label" >Total</label>
                    <div class="col-sm-6">
                        <input id="total" class="form-control" placeholder="" readonly required>
                    </div>
                </div>
                <div class="form-group row" >
                    <label class="col-sm-2 col-form-label" >Bukti Pembayaran</label>
                    <div class="col-sm-6">
                        <input name="bukti_pembayaran" type="file" class="form-control" placeholder=""  required>
                    </div>
                </div> 
                <input type="submit" class="btn btn-primary" value="Pesan">
            </form>
          </div>
        </div>
      </div>
    </section>
</div>

@include('../template/footer');

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Data promo untuk masing-masing layanan
    const promoData = {
      <?php foreach ($data1 as $d1) { ?>
        "<?= $d1->id_layanan ?>": [
          { "id_promo": "<?= $d1->id_promo ?>", "nama_promo": "<?= $d1->nama_promo ?>", "discount": <?= $d1->discount ?> },
        ],
      <?php } ?>
    };

    // Ketika layanan dipilih
    $('select[name="id_layanan"]').change(function() {
      const selectedLayanan = $(this).val();
      const price = parseFloat($('option:selected', this).data('price')) || 0;
      $('#total').data('price', price);

      const promoOptions = promoData[selectedLayanan] || [];
      const $promoSelect = $('select[name="id_promo"]');
      $promoSelect.empty();
      $promoSelect.append('<option value="0" data-discount="0">Tidak Menggunakan Promo</option>');

      promoOptions.forEach(function(promo) {
        $promoSelect.append('<option value="' + promo.id_promo + '" data-discount="' + promo.discount + '">' + promo.nama_promo + '</option>');
      });

      calculateTotal();
    });

    // Ketika promo atau qty berubah, update total
    $('select[name="id_promo"]').change(calculateTotal);
    $('#qty').on('input', calculateTotal);

    function calculateTotal() {
      const price = parseFloat($('#total').data('price')) || 0;
      const qty = parseInt($('#qty').val()) || 0;
      const discount = parseFloat($('select[name="id_promo"] option:selected').data('discount')) || 0;

      let total = price * qty;
      total -= total * (discount / 100);

      $('#total').val(total.toLocaleString());
    }

    // Trigger awal untuk load promo ketika halaman di-reload
    $('select[name="id_layanan"]').trigger('change');
  });
</script>


@include('../template/header_user');

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Article</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Article</li>
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

                    <div class="col-lg-12 entries">
                        
                        <div class="row">
                            <div class="col-3">
                                <h4>Kategori</h4>
                            </div>
                            <div class="col-9">
                                <select class="form-control" id="kategori">
                                    <option value="semua">Semua</option>
                                    
                                    <?php foreach($data1 as $d){?>
                                    <option value="<?=$d->id_kategori?>"><?=$d->nama_kategori?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div id="data" style="margin-top:100px"></div>
                        

                    </div><!-- End blog entries list -->

                    

                    </div>

                </div>
                </section><!-- End Blog Section -->

            </main><!-- End #main -->


        </div>

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->
  @include('../template/footer_user');
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
  $(document).ready(function() {

      $.get("{{route('api_artikel')}}",
      {
        id_kategori: $('#kategori').find(":selected").val(),
      },
      function(data, status){
        $('#data').html(data);
      });
      $("#kategori").change(function(){
        $.get("{{route('api_artikel')}}",
        {
            id_kategori: $('#kategori').find(":selected").val(),
        },
        function(data, status){
            $('#data').html(data);
        });

      });
        
  });
  </script>

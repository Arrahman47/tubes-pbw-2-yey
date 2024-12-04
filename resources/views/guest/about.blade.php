
@include('../template/header_user');

  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>About</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>About</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

   <!-- ======= About Section ======= -->
   <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6">
            <h2>LAUNDRYGO</h2>
            <h3>Menghadirkan layanan hukum terdepan dengan keunggulan dan integritas sebagai fondasi serta menjadi mitra hukum yang dipercayai, memberikan solusi inovatif dan personal untuk mencapai keberhasilan klien.</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
            Selamat datang di LAUNDRYGO, sebuah lembaga hukum yang berkomitmen untuk menyediakan layanan hukum berkualitas tinggi dengan fokus utama pada kepuasan klien. Didirikan dengan semangat untuk memberikan solusi hukum yang inovatif dan berkelanjutan, kami memadukan keahlian hukum yang mendalam dengan dedikasi penuh terhadap kepentingan klien.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Tim kami terdiri dari para profesional hukum yang berpengalaman dan memiliki pengetahuan mendalam di berbagai bidang hukum..</li>
              <li><i class="ri-check-double-line"></i> Kami memahami bahwa setiap klien memiliki kebutuhan dan tujuan yang unik.</li>
              <li><i class="ri-check-double-line"></i> Integritas adalah pondasi dari setiap langkah yang kami ambil.</li>
              <li><i class="ri-check-double-line"></i> Di era yang terus berkembang, kami tetap berkomitmen untuk tetap berada di garis depan perubahan hukum.</li>
            </ul>
            <p class="fst-italic">
            Kami percaya bahwa melalui pelayanan yang luar biasa, kami dapat membangun hubungan jangka panjang yang saling menguntungkan dengan klien kami. LAUNDRYGO hadir untuk mendukung Anda dalam setiap perjalanan hukum Anda. Terima kasih telah memilih kami sebagai mitra hukum Anda.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Team</h2>
          <p>Our Hardowrking Team</p>
        </div>

        <div class="row">
<?php foreach($data as $d){?>
          <div class="col-lg-6">
            <div class="member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4><?=$d->nama_anggota?></h4>
                <span><?=$d->jabatan?></span>
                <div class="social">
                  <a href=""><i class="ri-whatsapp-fill"></i></a>
                  <a href=""><i class="ri-facebook-fill"></i></a>
                  <a href=""><i class="ri-instagram-fill"></i></a>
                  <a href=""> <i class="ri-telegram-fill"></i> </a>
                </div>
              </div>
            </div>
          </div>
<?php }?>


        </div>

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->
  @include('../template/footer_user');

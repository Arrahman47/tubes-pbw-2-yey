
@include('../template/header_user');


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
              <div class="pic"><img src="asset/assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4><?=$d->nama_anggota?></h4>
                <span><?=$d->jabatan?></span>
                <div class="social">
                  <a href="https://wa.me/<?= $d->wa?>"><i class="ri-whatsapp-fill"></i></a>
                  <a href="https://www.facebook.com/profile.php?id=<?= $d->fb?>"><i class="ri-facebook-fill"></i></a>
                  <a href="https://www.instagram.com/<?= $d->ig?>"><i class="ri-instagram-fill"></i></a>
                  <a href="https://t.me/<?= $d->tele?>"> <i class="ri-telegram-fill"></i> </a>
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

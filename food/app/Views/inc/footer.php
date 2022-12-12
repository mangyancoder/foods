<footer class="footer footer-layout1 text-center bg-dark">
  <div class="footer-top">
    <div class="container">
      <div class="row align-items-center">
        <div class=" col-sm-12 col-md-12 col-lg-4">
          <div class="contact-box">
            <h6 class="contact__box-title">Our Address</h6>
            <ul class="contact__box-list list-unstyled">
              <li><?= $site['address'] ?></li>
            </ul>

          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
          <img src="/assets/images/backgrounds/logo.png" width="180" class="logo-light" alt="logo">
          <p class="mx-2 mb-20"><?= $site['name'] ?></p>

          <ul class="social__icons social__icons-white justify-content-center">
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-tripadvisor"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          </ul>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4">
          <div class="contact-box">

            <ul class="contact__box-list list-unstyled">
              <li><span>Main Email:</span><?= $site['email'] ?></li>
              <li><span>Phone:</span><?= $site['contact_no'] ?></li>
            </ul>
            <a href="/bookc" class="btn btn__primary btn__hover2 btn__link">Reservations</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <nav class="footer__links">
            <ul class="list-unstyled d-flex flex-wrap justify-content-center">
              <li><a href="#">About</a></li>
              <li><a href="#">Menu</a></li>
              <li><a href="#">Gallery</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Shop</a></li>
            </ul>
          </nav>
          
        </div>
      </div>
    </div>
  </div>
</footer>

<?=$this->include('inc/top')?>

<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
  <?=$this->include('inc/header')?>

  <section class="page-title page-title-layout7 text-center bg-overlay bg-parallax">
        <div class="bg-img"><img src="/assets/images/backgrounds/17.jpg" alt="background"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <span class="pagetitle__subheading">Book A Service</span>
              <h1 class="pagetitle__heading">Reservation</h1>
            </div>
          </div>
        </div>
      </section>

      <!-- ========================
        Reservation layout2
      =========================== -->
      <section class="reservation reservation-layout2 py-0">
        <div class="container">
          <div class="row">1
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="reservation-container">
                <div class="reservation__banner" data-aos="fade-right">
                  <img class="reservation__banner-img" src="/assets/images/backgrounds/pattern/3.jpg" alt="background">
                  <div class="reservation__banner-inner">
                    <span class="reservation__banner-inner-subtitle">Check Availability</span>
                    <h6 class="reservation__banner-inner-title">Status</h6>
                    <!-- <ul class="list-unstyled">
                      <li><span>Week days</span><span>09.00 – 24:00</span></li>
                      <li><span>Saturday</span><span>08:00 – 03.00</span></li>
                      <li><span>Saturday</span><span>Day off</span></li>
                    </ul> -->
                    <form method="post" action="/check">
                    <input type="date" name="st" class="form-control">
                    <br>
                    <input type="date" name="ed" class="form-control">
                    <br>
                    <div class="reservation__banner-contact">
                      <button type="submit" class="btn btn__primary btn__block">Check Availability</button>
                    </div>
                  </form>
                  </div>
                </div>
                <form class="reservation__form" data-aos="fade-left" method="post" action="<?=base_url()?>/checkb">
                  <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-info">
                          <?= session()->getFlashdata('msg') ?>
                        </div>
                      <?php endif;?>
                      <p>You can book your table online easily in just a couple of minutes. We take reservations for
                        lunch, just check the availability of your table.</p>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Event" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        Start:
                        <input type="datetime-local" name="start" class="form-control" placeholder="start" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        End:
                        <input type="datetime-local" name="end" class="form-control" placeholder="end" required>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        No. of Pax
                        <select class="form-control" name="pax">
                          <option value="30">30 people</option>
                          <option value="50">50 people</option>
                          <option value="100">100 people</option>
                          <option value="150">150 people</option>
                          <option value="200">200 people</option>
                          <option value="500">500 people</option>
                          <option value="600">600+ people</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        E-mail
                        <input type="email"  name="email" class="form-control" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="number" name="phones" class="form-control" placeholder="Phone Number" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <input type="text" name="location" class="form-control" placeholder="Event Location" required>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <?php
                        $isLoggedIn = session()->get('isLoggedIn');
                        $user =session()->get('type');
                        $uid =session()->get('uid');
                        if($isLoggedIn):
                      ?>
                      <button type="submit" class="btn btn__secondary btn__block">Book this Event</button>
                    <?php else: ?>
                      Please <a href="<?=base_url()?>/login" class="hamburger-menu-trigger">Sign in </a>to continue.
                    <?php endif; ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

<?= $this->include('inc/footer'); ?>
      <button id="scrollTopBtn"><i class="fa fa-angle-up"></i></button>

      <?= $this->include('inc/login') ?>
    </div>

</body>
<script>
$(document).ready(function(){
  $("#forgot").click(function(){
    $("#login-form").addClass("hidden");
    $("#register-form").addClass("hidden");
    $("#forgot-form").removeClass("hidden");
  });
  $("#register").click(function(){
    $("#login-form").addClass("hidden");
    $("#register-form").removeClass("hidden");
    $("#inreg").removeClass("hidden");
    $("#info-login").addClass("hidden");
    $("#forgot-form").addClass("hidden");
  });
  $("#login").click(function(){
    $("#login-form").removeClass("hidden");
    $("#register-form").addClass("hidden");
    $("#inreg").addClass("hidden");
    $("#info-login").removeClass("hidden");
    $("#forgot-form").addClass("hidden");
  });
  $("#forgot-form").submit(function(){
    $("#forgot-progress").removeClass("hidden");
    setTimeout(function(){
    var email = $("#femail").val();

    $.ajax({
      url: "<?=base_url()?>/reset",
      type:"POST",
      data:{
        email: email
      },
      success: function(rp){
        if(rp == 1){
          $("#forgot-message").removeClass("hidden");
          $("#login-form").removeClass("hidden");
          $("#forgot-form").addClass("hidden");
        }else{
          $("#forgot-message").addClass("hidden");
          $("#forgot-emessage").removeClass("hidden");
        }
      }
    });
  }, 1000);
  return false;
});

  $("#login-form").submit(function() {
    $("#login-progress").removeClass("hidden");
    setTimeout(function(){
      $("#login-progress").addClass("hidden");

      var username = $("#username").val();
      var password = $("#password").val();
      if( username != "" && password != "" ){
        // console.lsog(username);
        $.ajax({
          url: "<?=base_url()?>/auth",
          type: "POST",
          data: {
            username:username,
            password:password,
          },
          success:function(response){
            var msg = "";
            if(response == 1){
              $("#login-message").removeClass("hidden");
              window.location = "<?=base_url()?>/validates";
            }else{
              console.log(response);
              $("#login-emessage").removeClass("hidden");
            }

          }
        })
      }
    }, 1000);
    return false;
  });
});

</script>
<?=$this->include('inc/end')?>

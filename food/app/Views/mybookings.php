<?=$this->include('inc/top')?>

<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
  <?=$this->include('inc/header')?>

  <section class="page-title page-title-layout7 text-center bg-overlay bg-parallax">
        <div class="bg-img"><img src="/assets/images/backgrounds/17.jpg" alt="background"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <span class="pagetitle__subheading">Your Bookings</span>
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
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="reservation-container">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                      <th>Celebration</th>
                      <th>Date - Start</th>
                      <th>Date - End</th>
                      <th>No of Pax</th>
                      <th>Package</th>
                      <th>Event Location</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $pr = new \App\Models\ProductModel;
                    foreach ($booking as $bk): ?>
                      <tr>
                        <td><?= $bk['title'] ?></td>
                        <td><?= $bk['start'] ?></td>
                        <td><?= $bk['end'] ?></td>
                        <td><?= $bk['pax'] ?></td>
                        <td><?= $bk['package'] ?></td>
                        <td><?= $bk['location'] ?></td>
                        <td><?= $bk['bstatus'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Celebration</th>
                      <th>Date - Start</th>
                      <th>Date - End</th>
                      <th>No of Pax</th>
                      <th>Package</th>
                      <th>Event Location</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>

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

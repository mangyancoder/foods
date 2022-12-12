<?=$this->include('inc/top')?>

<body>
  <div class="wrapper">
    <?=$this->include('inc/header')?>
    <?=$this->include('inc/pslider')?>
    <?php foreach ($packages as $product): ?>


    <section class="menu-layout1 menu-layout6 py-0">
      <div class="container-fluid col-padding-0">
        <div class="row align-items-center">
          <div class="col-sm-12 col-md-12 col-lg-6">
            <img src="<?=$product['package_banner']?>" alt="banner" class="img-fluid w-100" >
          </div><!-- /.col-lg-6 -->
          <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="menu__card-inner">
              <div class="heading heading-layout1 text-center mb-40">
                <!-- <span class="heading__subtitle">Starts At 2:00 pm</span> -->
                <h2 class="heading__title"><?=$product['package_name']?></h2>

              </div><!-- /.heading -->
              <div class="menu-wrapper">
                <?=$product['package_description']?>
                <?php $var = new \App\Models\PackageList;
                ?>
                <?php $h = $var->where('packageID',$product['pcid'] )->findAll();?>

                <?php foreach ($h as $l): ?>
                <div class="menu-item">
                  <h4 class="menu__item-title"><?=$l['name']?></h4>
                  <p class="menu__item-desc"><?= $l['pl_type'] ?></p>
                </div>
              <?php endforeach; ?>
              <?php if ($h): ?>
<!-- <a href="#" class="btn btn__primary btn__hover2 addtocart" data-quantity="1" data-type="package" data-productid="<?=$product['pcid']?>" data-price="<?=$product['price']?>" >Select</a> -->
                <!-- <a href="/add/<?=$product['pcid']?>" class="btn btn__primary btn__hover2">Add To Cart</a> -->
              <?php endif; ?>
              <h4 class="menu__item-title">Price: ₱ <?=number_format($product['price'], 2)?></h4>

              </div><!-- /.menu-wrapper -->
            </div><!-- /.menu__card-inner -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row  -->
      </div><!-- /.container -->
    </section><!-- /.menu layout 6 -->
<?php endforeach; ?>

  <?= $this->include('inc/footer') ?>
    <button id="scrollTopBtn"><i class="fa fa-angle-up"></i></button>

    <?= $this->include('inc/login') ?>
  </div><!-- /.wrapper -->

</body>
<script>
$(document).ready(function(){
  $(".addtocart").click(function(){
    var productsID = $(this).attr("data-productid");
    var type = $(this).attr("data-type");
    var price = $(this).attr("data-price");
    var quantity = $(this).attr("data-quantity");
    $.ajax({
      data:{"productID": productsID, "type":type, "price":price, "quantity":quantity},
      method: 'POST',
      'url': '<?=base_url()?>/addtocart',
      success:function(data){
        alert(data);
      }
    })
  });
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
</html>

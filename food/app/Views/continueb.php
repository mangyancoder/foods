<?=$this->include('inc/top')?>

<body>

  <div class="wrapper">
    <?=$this->include('inc/header')?>
    <?php foreach ($packages as $product): ?>
    <section class="menu-layout1 menu-layout6 py-0">
      <div class="container-fluid col-padding-0">
        <div class="row align-items-center">
          <div class="col-sm-12 col-md-12 col-lg-6">
            <img src="<?=$product['package_banner']?>" alt="banner" class="img-fluid w-100" >
          </div>
          <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="menu__card-inner">
              <div class="heading heading-layout1 text-center mb-40">
                <span class="heading__subtitle">Starts At 2:00 pm</span>
                <h2 class="heading__title"><?=$product['package_name']?></h2>
                <?=$product['package_description']?>
              </div>
              <div class="menu-wrapper">
                <?php $var = new \App\Models\PackageList;
                ?>
                <?php $h = $var->select('cname as name, cid as cid, pl_quantity as pqty')->join('packages', 'package_list.packageID=packages.pcid')->join('category', 'package_list.pl_category=category.cid')->groupBy('cid')->findAll();?>
                <!-- $dg = $lk->select('name as name, cid as cid, pl_quantity as pqty')->join('packages', 'package_list.packageID=packages.pcid')->join('category', 'package_list.pl_category=category.cid')->groupBy('cid')->findAll(); -->

                <form  action="/cpayment" method="post">
                <?php foreach ($h as $l): ?>
                <div class="menu-item">
                  <h4 class="menu__item-title"><?=$l['name']?></h4>
                  <span class="menu__item-price"><?=$l['pqty']?></span>
                  <p class="menu__item-desc"><?= $l['pl_category'] ?></p>
                </div>


              <?php endforeach; ?>
              <?php if ($product['price']): ?>
              <h4 class="menu__item-title">Price: ₱ <?=number_format($product['price'], 2)?></h4>
              <?php endif; ?>

              <?php if ($h): ?>

                <button type="button" class="btn btn-info btn-lg selct" data-toggle="modal" data-target="#myModal" data-pcid="<?= $product['pcid'] ?>">Choose Foods</button>
              <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php endforeach; ?>
<br>
<center>
  <!-- <button type="submit" name="button" class="btn btn-primary xl">Proceed to payment</button> -->
  <br>
  <br>
</center>
</form>

    <?= $this->include('inc/footer') ?>

    <button id="scrollTopBtn"><i class="fa fa-angle-up"></i></button>

    <?= $this->include('inc/login') ?>
  </div>

  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <div class="panel-group">
          <div class="panel panel-default">
            <!-- <form action="<?= base_url('/kpayment') ?>" method="post"> -->
              <form action="<?= base_url('/testpayment') ?>" method="post">
              <input type="hidden" name="pcid" class="form-control pcid">
              <?php
              $lk = new \App\Models\PackageList;
              $dg = $lk->select('cname as name, cid as cid, pl_quantity as pqty')->join('packages', 'package_list.packageID=packages.pcid')->join('category', 'package_list.pl_category=category.cid')->groupBy('cid')->findAll();

              ?>
            <?php foreach ($dg as $cat): ?>
            <div class="panel-heading">

              <h4 class="panel-title">
                <a data-toggle="collapse" href="#<?=$cat['cid']?>"><?= $cat['name']?></a>
              </h4>

            </div>
            <div id="<?= $cat['cid'] ?>" class="panel-collapse collapse">
              <div class="panel-body">
                <?php
                $getp = new \App\Models\ProductModel;
                $pr = $getp->where('category', $cat['cid'])->findAll();
                ?>
                <?php foreach ($pr as $mn): ?>

                <input type="checkbox" name="products[]" class="ck" value="<?= $mn['pid'] ?>" data-cat="<?= $mn['category'] ?>" data-count="<?= $cat['pqty'] ?>"><?=$mn['name'] ?>
                <br>
                <?php endforeach; ?>
              </div>
              <div class="panel-footer"><?= $cat['name'] ?> Footer</div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >proceed</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>


</body>

<script>
$(document).ready(function(){
  var count = 0;
       $(".selct").click(function(){
           var pcid = $(this).attr("data-pcid");
           $(".pcid").val(pcid);
       });
       $('.ck').click(function() {
         var checkboxes = $('input:checkbox').length;

     })
   });
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

<?=$this->include('inc/top')?>

<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
  <?=$this->include('inc/header')?>
  <?=$this->include('inc/pslider')?>



    <section class="shop-grid">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <ul class="portfolio-filter justify-content-center">

              <li><a class="filter" href="#" data-filter="all">All</a></li>
              <?php foreach ($category as $category): ?>
                <li><a class="filter" href="#" data-filter=".filter-<?=$category['name']?>"><?=$category['name']?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="row filtered-items-wrap" id="MixItUpBDC2DF">

          <?php foreach ($product as $product): ?>
          <div class="col-sm-6 col-md-6 col-lg-4 mix filter-<?=$product['category']?>">
            <div class="product-item">
              <div class="product__img">
                <img src="<?=base_url()?>/<?=$product['picture']?>" alt="Product" width="250" height="250">
                <div class="product__action">
                  <a href="#" class="btn btn__primary btn__hover2 addtocart" data-quantity="1" data-type="single" data-productid="<?=$product['pid']?>" data-price="<?=$product['price']?>" >Add To Cart</a>
                </div>
              </div>
              <div class="product__content">
                <div class="product__cat">
                  <a href="/categories/<?= $product['cid'] ?>"><?= $product['cname'] ?></a>
                  <a href="#">Fresh</a>
                </div>
                <h4 class="product__title"><a href="#"><?=$product['name'];?></a></h4>
                <span class="product__price"><?=$$product['pricex`']?></span>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 text-center">
            <nav class="pagination-area">
              <ul class="pagination justify-content-center">
                <li><a class="current" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </div>
<?=$this->include('inc/login')?>
<?=$this->include('inc/footer')?>
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
})
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

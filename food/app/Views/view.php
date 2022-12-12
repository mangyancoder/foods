<?=$this->include('inc/top')?>

<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
  <?=$this->include('inc/header')?>
  <section class="page-title page-title-layout3 text-center bg-overlay bg-parallax bg-img" style="background-image: url('/assets/images/backgrounds/17.jpg'); background-size: cover; background-position: center center;">

        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1">
              <span class="pagetitle__subheading">Product</span>
              <h1 class="pagetitle__heading"><?= $pr['name'] ?></h1>
            </div>
          </div>
        </div>
      </section>
  <section id="page-title" class="page-title page-title-layout8">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <h1 class="pagetitle__heading color-dark"><?= $pr['name'] ?></h1>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-6 col-lg-6">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-end">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $pr['name'] ?></li>
                </ol>
              </nav>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </section>

      <section class="shop product-single pb-0">
            <div class="container">
              <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="product__single-img">
                    <img src="/<?= $pr['picture'] ?>" class="zoomin" alt="product" style="visibility: visible;">
                  </div><!-- /.product-img -->
                </div><!-- /.col-lg-6 -->
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <h4 class="product__title"><?= $pr['name'] ?></h4>
                  <span class="product__price">₱ <?= number_format($pr['price'],2)  ?></span>
                  <hr class="hr-dashed mt-30 mb-30">
                  <div class="product__desc">
                    <p><?= $pr['description'] ?></p>
                  </div><!-- /.product-desc -->
                  <form class="product__form-wrap mb-30">
                    <div class="product__quantity d-flex">
                      <a href="#" class="btn btn__primary addtocart" data-quantity="1" data-type="single" data-productid="<?=$pr['pid']?>" data-price="<?=$pr['price']?>" >Add To Cart</a>

                    </div><!-- /.product-quantity -->
                  </form>
                  <div class="product__meta">
                    <div class="product__meta-cat">
                      <span class="product__meta-title">Categories:</span>
                      <?php
                      $cat = new \App\Models\Category;
                      $pl = $cat->where('cid', $pr['category'])->first();

                      ?>

                      <a href="/categories/<?= $pl['cid'] ?>"><?= $pl['cname'] ?></a>

                    </div><!-- /.product__meta-cat -->
                    <div class="product__meta-tags">

                    </div><!-- /.product__meta-tags -->
                  </div><!-- /.product__meta -->
                  <hr class="hr-dashed mt-30 mb-30">

                </div><!-- /.col-lg-6 -->
              </div><!-- /.row -->

            </div><!-- /.container -->
          </section>


<br>
<?=$this->include('inc/footer')?>

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
  });
</script>

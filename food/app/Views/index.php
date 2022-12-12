<?=$this->include('inc/top')?>

<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
    <?=$this->include('inc/header')?>
    <?=$this->include('inc/slider')?>



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

                  </div>
                  <h4 class="product__title"><a href="/view/<?= $product['pid'] ?>"><?=$product['name'];?></a></h4>
                  <span class="product__price">₱ <?=number_format($product['price'], 2)?></span>
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


    <section class="testimonials testimonials-layout1 bg-overlay" style="background-image: url('/assets/images/backgrounds/17.jpg'); background-size: cover; background-position: center center;">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading heading-layout1 text-center mb-50">
                  <span class="heading__subtitle">Book Your Table</span>
                  <h2 class="heading__title color-white">Make A Reservation</h2>
                  <div class="heading__icon">
                    <img src="assets/images/shapes/shape2.png" alt="heading img">
                  </div>
                  <p class="heading__desc color-white">You can book with us online easily in just a couple of minutes. We take
                    reservations for any ocassion's, just check the availability of your preferred dates.</p>
                </div>
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
        </section>



        <section class="menu-layout2 pb-60 bg-overlay">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
                <div class="heading text-center mb-30">
                  <span class="heading__subtitle">Something to eat?</span>
                  <h2 class="heading__title color-white">Our Daily Specials</h2>
                  <div class="heading__icon">
                    <img src="assets/images/shapes/shape2.png" alt="heading img">
                  </div>
                </div>
              </div>
            </div>
            <div class="menu-container">
              <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="menu-wrapper mb-20">

                    <?php foreach ($rn1 as $ppr): ?>
                    <div class="menu-item">
                      <div class="menu__item-img"><img src="/<?= $ppr['picture'] ?>" alt="menu img"></div>
                      <div class="menu__item-content">
                        <h4 class="menu__item-title"><?= $ppr['name'] ?></h4>
                        <p class="menu__item-desc"><?= $ppr['description'] ?></p>
                        <span class="menu__item-price">₱<?= number_format($ppr['price'], 2) ?></span>
                      </div>
                    </div>

                  <?php endforeach; ?>
                  </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                  <div class="menu-wrapper mb-20">

                    <?php foreach ($rn2 as $ppr): ?>
                    <div class="menu-item">
                      <div class="menu__item-img"><img src="/<?= $ppr['picture'] ?>" alt="menu img"></div>
                      <div class="menu__item-content">
                        <h4 class="menu__item-title"><?= $ppr['name'] ?></h4>
                        <p class="menu__item-desc"><?= $ppr['description'] ?></p>
                        <span class="menu__item-price">₱<?= number_format($ppr['price'], 2) ?></span>
                      </div>
                    </div>

                  <?php endforeach; ?>


                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>

        <?= $this->include('inc/gb') ?>




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
          $("#review").rating({
              "value": 5,
              "click": function (e) {
                  console.log(e);
                  $("#starsInput").val(e.stars);
              }
          });
        </script>
        <?=$this->include('inc/end')?>

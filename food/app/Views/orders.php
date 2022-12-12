<?=$this->include('inc/top')?>

<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
  <?=$this->include('inc/header')?>

  <section class="page-title page-title-layout7 text-center bg-overlay bg-parallax">
        <div class="bg-img"><img src="/assets/images/backgrounds/17.jpg" alt="background"></div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
              <span class="pagetitle__subheading">Your Orders</span>
              <h1 class="pagetitle__heading">Orders</h1>
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
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Type</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sn = new \App\Models\ProductModel; ?>
                    <?php $pk = new \App\Models\PackagesModel; ?>
                    <?php
                    foreach ($product as $prs){

                      if($prs['type'] == 'package'):
                        $d = $pk->where('pcid', $prs['packageID'])->first();
                      ?>

                          <tr class="cart__product ">
                            <td class="cart__product-item">
                              <div class="cart__product-remove">

                              </div>
                              <div class="cart__product-img">
                                <!-- <img height="150" src="<?=base_url() . '/'. $d['package_banner']?>" alt="product"> -->
                              </div>
                              <div class="cart__product-title">
                                <h6><?= $d['package_name'] ?></h6>
                              </div>
                            </td>
                            <td class="cart__product-price">₱ <?=$d['price']?></td>
                            <td class="cart__product-quantity">
                              <div class="product-quantity">
                                <div class="quantity__input-wrap">

                                  <i class="fa fa-minus decrease-qty"></i>
                                  <input type="number" value="<?=$prs['o_quantity']?>" class="qty-input">
                                  <input type="number" value="<?=$d['price']?>" class="inp-price">
                                  <i class="fa fa-plus increase-qty" ></i>
                                </div>
                              </div>
                            </td>
                            <td><?=strtoupper($prs['type'])?> ORDER</td>
                            <?php $p1 += $prs['o_quantity'] * $prs['p_price']; ?>
                            <td class="cart__product-total"><?= $prs['ocreated_at'] ?></td>
                          </tr>
                        <?php elseif($prs['type'] =='single'): ?>

                          <?php $ds = $sn->where('pid', $prs['packageID'])->first(); ?>
                          <tr class="cart__product ">
                            <td class="cart__product-item">
                              <div class="cart__product-remove">

                              </div>
                              <div class="cart__product-img">
                                <img width="150"src="<?=base_url() . '/'. $ds['picture']?>" alt="product">
                              </div>
                              <div class="cart__product-title">
                                <h6><?= $ds['name'] ?></h6>
                              </div>
                            </td>
                            <td class="cart__product-price">₱ <?=$ds['price']?></td>
                            <td class="cart__product-quantity">
                              <div class="product-quantity">
                                <div class="quantity__input-wrap">
                                  <i class="fa fa-minus decrease-qty"></i>
                                  <input type="number" value="<?=$prs['o_quantity']?>" class="qty-input">
                                  <i class="fa fa-plus increase-qty"></i>
                                </div>
                              </div>
                            </td>
                            <td><?=strtoupper($prs['type'])?> ORDER</td>

                            <td class="cart__product-total"><?= $prs['ocreated_at'] ?></td>
                          </tr>
                        <?php endif; ?>
                    <?php } ?>


                    </tbody>
                  <tfoot>
                    <tr>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Type</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
                </table>

              </div>
            </div>
          </div>
        </div>
      </section>



    </div>
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

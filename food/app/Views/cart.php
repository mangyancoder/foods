<?= $this->include('inc/top') ?>
<body data-aos-easing="ease" data-aos-duration="800" data-aos-delay="0">
  <div class="wrapper">
    <?=$this->include('inc/header')?>
    <section id="page-title" class="page-title page-title-layout8">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6">
            <h1 class="pagetitle__heading color-dark">Cart</h1>
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <section class="shopping-cart pb-70">
      <div class="container">
        <div class="row">
          <?php if(!$product): ?>
            <h1>Your Cart is empty</h1>
          <?php endif; ?>
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="cart-table table-responsive bg-gray">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Type</th>
                    <th>Total</th>
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
                            x
                          </div>
                          <div class="cart__product-img">
                            <img src="<?=base_url() . '/'. $d['package_banner']?>" alt="product">
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
                        <td class="cart__product-total sprice"><?=$prs['o_quantity'] * $prs['p_price']?></td>
                      </tr>
                    <?php elseif($prs['type'] =='single'): ?>

                      <?php $ds = $sn->where('pid', $prs['packageID'])->first(); ?>
                      <tr class="cart__product ">
                        <td class="cart__product-item">
                          <div class="cart__product-remove">
                            x
                          </div>
                          <div class="cart__product-img">
                            <img src="<?=base_url() . '/'. $ds['picture']?>" alt="product">
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
                        <?php $p1 += $prs['o_quantity'] * $prs['p_price']; ?>
                        <td class="cart__product-total">₱ <?=$prs['o_quantity'] * $prs['p_price']?></td>
                      </tr>
                    <?php endif; ?>
                  <?php } ?>


                </tbody>
              </table>
            </div>
          </div>

          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="cart__total-amount">
              <h6>Cart Totals :</h6>
              <ul class="list-unstyled mb-0">
                <li><h4>Cart Subtotal :</h4><h4>₱  <?=number_format($p1, 2)?></h4></li>
                <li><h4>Shipping :</h4><h4>
                  <?php if($val['delivery_charge'] == 'on'):
                    $charge = $val['dcharge_amount'];
                    ?>
                    <?= number_format($val['dcharge_amount'], 2) ?>
                  <?php else: ?>
                    Free Shipping
                  <?php endif; ?>
                </h4></li>
                <li><h4>Order Total :</h4><h4><b> ₱ <?=number_format($p1 + $charge, 2)?></b></h4></li>


              </ul>

            </div>
            <?php if($product): ?>
            <div class="cart-table table-responsive bg-gray">
              <table class="table table-bordered">

                <tr class="cart__product-action">
                  <td colspan="5">
                    <h4>Downpayment options</h4>
                    <fieldset>


                      <div>
                        <input type="radio" class="mop" id="gcash" name="mop" value="gcash">
                        <label for="gcash">GCash</label>
                      </div>

                      <div>
                        <input type="radio" class="mop" id="cash" name="mop" value="cash" checked>
                        <label for="cash">Cash</label>
                      </div>
                      <img src="<?= base_url() . '/'. $gcash['g_qr']?>" alt="" width="400" class="hidden" id="gc">
                    </fieldset>
                    <br>
                    <div class="row">
                      <p id="gg" class="hidden">Upload your proof of payment here</p>
                      <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content">
                          <div>
                            <!-- <form  action="<?=base_url()?>/checkout" method="post"   enctype="multipart/form-data"> -->
                            <form id="frm_1"enctype="multipart/form-data">
                              <!-- <input type="hidden" name="mop" value="gcash"> -->
                              <label id="gg" class="hidden">Upload your proof of payment here</label>
                              <br>
                              <input type="text" class="form-control hidden" id="payment_p"  class="price" placeholder="paid amount" >
                              <br>
                              <input type="file" name="file" class="form-control hidden" id="file" placeholder="Upload">
                              <br>
                              <?php
                              foreach ($product as $prs){

                                if($prs['type'] == 'package'):
                                  $d = $pk->where('pcid', $prs['packageID'])->first();
                                  elseif($prs['type'] =='single'):
                                    $ds = $sn->where('pid', $prs['packageID'])->first();
                                  endif;
                                  ?>
                                  <input type="hidden" id="pr_<?=$prs['oid']?>" value="<?=$prs['oid']?>" name="id[]" class="pp">

                                <?php } ?>
                                <input type="hidden" id="tlid" value="<?= $tlid ?>">

                                <button class="btn btn__primary btnlk" id="<?=$prs['oid']?>" type="button">Checkout</button>

                              </form>
                            </div>
                          </div><!-- /.col-lg-2  -->
                        </div><!-- /.row  -->
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
      </div>
    </body>
    <?=$this->include('inc/footer')?>
    <?=$this->include('inc/end')?>
    <script>
    $(document).ready(function(){
      $(".btnlk").click(function(){
        var tlid = $("#tlid").val();
        var amount = $("#payment_p").val();
        var mop, id;
        var fd = new FormData();
        var file_data = $("#file").prop("files")[0];
        var form_data = new FormData();
        if( $('#gcash').is(':checked') ){
          mop = 'gcash';
          Swal.fire({
            title: 'Do you want to save the changes?',
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              $("#frm_1 input[class=pp]")
              .each(function () {
                id = this.value;
                form_data.append('file', file_data);
                form_data.append('id', id);
                form_data.append('tlid', tlid);
                form_data.append('amount', amount);
                $.ajax({
                  url: "<?=base_url()?>/checkc",
                  dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: form_data,
                  type: 'post',
                  success: function(da){
                    console.log(da); // <-- display response from the PHP script, if any
                    redirect();
                  },
                  error: function (error) {
                    console.log(eval(error));
                  }
                });
              });
              Swal.fire('Saved!', '', 'success')
            }
          });
        }else{
          mop = 'cash';
          Swal.fire({
            title: 'Do you want to save the changes?',
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              $("#frm_1 input[class=pp]")
              .each(function () {
                id = this.value;
                console.log(tlid);
                $.ajax({
                  url: "<?=base_url()?>/checkd",
                  type: "POST",
                  data: {
                    id: id,
                    tlid:tlid,

                  },
                  // contentType: false,
                  // processData: false,
                  success:function(data){
                    console.log(data);
                    redirect();
                  },
                  error: function (error) {
                    console.log(eval(error));
                  }
                });
              });
              Swal.fire('Saved!', '', 'success')
            }
          });

        }





      });
      $("#gcash").click(function(){
        $("#file").removeClass("hidden");
        $("#conf").addClass("hidden");
        $("#btn-file").removeClass("hidden");
        $("#gc").removeClass("hidden");
        $("#gg").removeClass("hidden");
        $("#confg").removeClass("hidden");
        $("#payment_p").removeClass("hidden");
        document.getElementById("payment_p").required = true;
        document.getElementById("file").required = true;
      });
      $("#cash").click(function(){
        $("#file").addClass("hidden");
        $("#gc").addClass("hidden");
        $("#gg").addClass("hidden");
        $("#confg").addClass("hidden");
        $("#conf").removeClass("hidden");
        $("#btn-file").addClass("hidden");
        $("#payment_p").addClass("hidden");
        document.getElementById("payment_p").required = false;
        document.getElementById("file").required = false;
      });
      function redirect() {
        setTimeout(myURL, 5000);
        var result = document.getElementById("result");
        result.innerHTML = "<b> The page will redirect after delay of 5 seconds";
     }
     function myURL() {
      document.location.href = '<?= base_url() ?>';
      }
    });

    </script>

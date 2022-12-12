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
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="cart-table table-responsive bg-gray">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>No of Pax</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $ass = session()->get('ds');?>
                  <?php if(!$ass): ?>
                    <?php return redirect()->to($_SERVER['HTTP_REFERER']); ?>
                  <?php endif; ?>
                  <?php $sn = new \App\Models\ProductModel; ?>
                  <?php $pk = new \App\Models\PackagesModel; ?>
                  <?php
                  foreach ($packages as $prs){
                    $pd = $pk->where('pcid', $prs)->first();

                    ?>

                        <tr class="cart__product ">
                          <td class="cart__product-item">
                            <div class="cart__product-remove">
                              x
                            </div>
                            <div class="cart__product-img">
                              <img src="<?=base_url() . '/' . $pd['package_banner']?>" alt="product">
                            </div>
                            <div class="cart__product-title">
                              <h6><?= $pd['package_name'] ?></h6>
                            </div>
                          </td>
                          <td class="cart__product-price">₱ <?php echo $pd['price']; ?></td>
                          <td class="cart__product-quantity">
                            <div class="product-quantity">
                              <div class="quantity__input-wrap">
                                <?= $ass['pax'] ?>
                              </div>
                            </div>
                          </td>


                          <td class="cart__product-total sprice"><?= $pd['price'] * $ass['pax']  ?></td>
                          <?php $tot +=  $pd['price'] * $ass['pax'] ?>
                        </tr>

                  <?php } ?>


                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="cart__total-amount">
                <h6>Reservation Information: </h6>
                <ul class="list-unstyled mb-0">
                  <?php //$a = session()->get('ds');?>
                  <li><h4>Event</h4><h4><?=$ass['title']?></h4> </li>
                  <li><h4>Start</h4><h4><?=$ass['start']?></h4> </li>
                  <li><h4>End</h4><h4><?=$ass['end']?></h4> </li>
                  <li><h4>No of Pax</h4><h4><?=$ass['pax']?></h4> </li>
                  <li><h4>Location </h4><h4><?=$ass['location']?></h4> </li>
                <li><h4>Order Total :</h4><h4><b> ₱ <?=number_format($tot, 2)?></b></h4></li>

                Terms and Conditions:
                <br>
                  <p><i>Please Pay the <?=$reservation['amount']?> % of your total bill to confirm this reservation amounting <b>₱ <?=number_format($tot * $reservation['amount'] / 100, 2) ?></b>, you can use Online Banking(Gcash) by scanning the QR provided and upload your proof. Or you can drop by in our headquarters located at lumangbayan calapan city oriental mindoro.</i></p>
                </ul>

              </div>
              <div class="cart-table table-responsive bg-gray">
              <table class="table table-bordered">

                <tr class="cart__product-action">
                  <td colspan="5">
                    <h4>Downpayment options</h4>
                    <fieldset>
                        <legend>Select a maintenance drone:</legend>

                        <div>
                          <input type="radio" id="gcash" name="mop" value="gcash">
                          <label for="gcash">GCash</label>
                        </div>

                        <div>
                          <input type="radio" id="cash" name="mop" value="cash" checked>
                          <label for="cash">Cash</label>
                        </div>
                        <img src="<?= base_url() . '/'. $gcash['g_qr']?>" alt="" width="400" class="hidden" id="gc">
                    </fieldset>
                    <br>
                    <div class="row">
                      <p id="gg" class="hidden">Upload your proof of payment here</p>
                      <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content">

                        <form class="d-flex flex-wrap" action="<?=base_url()?>/sbook" method="post"  enctype="multipart/form-data">
                          <input type="hidden" name="mop" value="gcash">
                          <input type="file" name="file" class="form-control hidden" id="file" placeholder="Upload">
                          <!-- <button type="submit" class="btn btn__primary mb-10 hidden" id="btn-file">upload</button> -->
                          <input type="hidden" class="ff hidden" name="package" value='<?= json_encode($packages) ?>'>
                          <input type="hidden" class="ff hidden" name="price" value='<?= $tot ?>'>
                          <div>
                            <button class="btn btn__primary hidden" type="submit" id="confg">Confirm</button>

                          </div>
                          </form>
                          <button class="btn btn__primary" type="button" id="conf" data-price="<?=$tot?>" data-id='<?= json_encode($packages) ?>'>Confirm</button>
                        </div><!-- /.col-lg-2  -->
                      </div><!-- /.row  -->
                    </td>
                  </tr>
              </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
  <?=$this->include('inc/end')?>
  <script>
    $(document).ready(function(){
      $("#conf").click(function(){
        var mop;
        var pk = $(this).attr("data-id");
        // var pk = $(this).attr("data-id").replace('[','');
        // pk = pk.replace(']', '');
        var price = $(this).attr("data-price");
        // var newValue = $mylabel.text().replace('-', '');
        // $mylabel.text( newValue );
        if($('#cash').is(':checked'))
        {
          mop = 'cash'
        }

        Swal.fire({
          title: 'Please Confirm',
          text: "Please confirm your action",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'confirm'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: "<?=base_url('/cbook')?>",
              data:{
                mop: mop,
                package: pk,
                price:price,
              },
              success:function(re){
                Swal.fire(
                  'Success!',
                  'Your reservation was submitted.',
                  'success'
                );


                // $(location).prop('href', '<?=base_url('/bookc')?>')
              },
              error:function(e){
                console.log(e);
              }
            });
          }
        })
      });
      $("#gcash").click(function(){
        $("#file").removeClass("hidden");
        $("#conf").addClass("hidden");
        $("#btn-file").removeClass("hidden");
        $("#gc").removeClass("hidden");
        $("#gg").removeClass("hidden");
        $("#confg").removeClass("hidden");
        document.getElementById("file").required = true;
      });
      $("#cash").click(function(){
        $("#file").addClass("hidden");
        $("#gc").addClass("hidden");
        $("#gg").addClass("hidden");
        $("#confg").addClass("hidden");
        $("#conf").removeClass("hidden");
        $("#btn-file").addClass("hidden");
        document.getElementById("file").required = false;
      });
    });
  </script>

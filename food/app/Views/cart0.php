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
              <div class="cart-table table-responsive bg-gray">
              <table class="table table-bordered">

                <tr class="cart__product-action">
                  <td colspan="5">
                    <h4>Delivery Details:</h4><h4>Guinobatan calapan city</h4>
                    <a href="<?=base_url()?>/delivery-address">change delivery information</a>
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 cart__product-action-content">
                        <form class="d-flex flex-wrap">
                          <input type="text" class="form-control mb-10 mr-10" placeholder="Coupon Code">
                          <button type="submit" class="btn btn__primary mb-10">Apply
                            Coupon</button>
                          </form>
                          <div>
                            <form  action="<?=base_url()?>/checkout" method="post">
                            <?php
                            foreach ($product as $prs){

                              if($prs['type'] == 'package'):
                                $d = $pk->where('pcid', $prs['packageID'])->first();
                              elseif($prs['type'] =='single'):
                                $ds = $sn->where('pid', $prs['packageID'])->first();
                              endif;
                              ?>
                              <input type="hidden" value="<?=$prs['oid']?>" name="id[]">;
                            <?php } ?>
                            <button class="btn btn__secondary mr-10">update cart</button>
                            <button class="btn btn__primary" type="submit">Checkout</button>
                            </form>
                          </div>
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

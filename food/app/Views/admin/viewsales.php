<?=$this->include('admin/inc/top')?>
<body class="  ">
  <div id="loading">
    <div class="loader simple-loader">
      <div class="loader-body"></div>
    </div>
  </div>
  <?=$this->include('admin/inc/sidebar')?>
  <main class="main-content">
    <div class="position-relative iq-banner">
      <?=$this->include('admin/inc/navbar')?>
    </div>
    <div class="conatiner-fluid content-inner mt-n5 py-0">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">

            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                <h4 class="card-title">Orders - <?=$tp?></h4>
                <?php
                $acct = new \App\Models\SalesModel;
                $ds = $acct->where('userID', $userID)->join('users', 'orders.userID=users.uid')->findAll();
                foreach ($ds as $gf) {
                  $total += $gf['p_price'];
                }
                echo 'Client Name: ' . $gf['uname'];
                echo '<br>Ordering Date: ' . $ordering_date;
                echo '<br>Date Processed: ' . $transacted_date;
                echo '<br>Phone : ' . $gf['phone'];
                echo '<br>Address : ' . $gf['address'];
                echo '<br>Order Type : ' . $gf['order_type'];
                echo '<br> Total: '. number_format($total, 2);
                ?>

                <br>


              </div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                Items:
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $u = new \App\Models\SalesModel;
                    $check = $u->where('o_tlid', $id)->findAll();
                    foreach ($check as $c){

                      $t = $c['type'];
                      if($t == 'single'){
                        $ds = $u->join('product', 'orders.packageID=product.pid')->where('o_tlid', $id)->where('type', 'single')->where('status', 'pending')->findAll();

                        foreach ($ds as $prod):
                          ?>
                        <tr>
                          <td><?=$prod['name']?></td>
                          <td><?=$prod['description']?></td>
                          <td><?= number_format($prod['p_price'], 2) ?></td>
                          <td>Single</td>
                          <td></td>
                        </tr>
                  <?php endforeach;

                }elseif($t =='package'){

                        $ds = $u->join('packages', 'orders.packageID=packages.pcid')->where('o_tlid', $id)->where('type', 'package')->groupBy('oid')->findAll();
                        $pk = new \App\Models\ProductModel;


                      }
                    }
                    foreach ($ds as $prod):


                      ?>
                    <tr>
                      <td><?=$prod['package_name']?></td>
                      <td><?=$prod['package_description']?></td>
                      <td><?= number_format($prod['p_price'], 2) ?></td>
                      <td>

                        <?php
                        if($t == 'package'){
                        $pc = $pk->join('package_list', 'product.pid=package_list.productID')->where('packageID', $prod['pcid'])->findAll();
                        echo '<ol type="1">';
                          foreach ($pc as $f) {
                            echo '<li>'.$f['name']. '</li>';
                          }
                          echo'</ol>';
                        }
                         ?>
                      </td>
                      <td></td>
                    </tr>
              <?php endforeach;

                    // var_dump($ds);
                    ?>

                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title h4" id="exampleModalFullscreenLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                      <h4 class="card-title">Confirm this Order?</h4>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="/admin/orderval" method="post">
              <input type="hidden" name="id" value="<?=$id?>">
              <button type="submit" name="yes" class="btn btn-primary">Yes</button>
              <button type="submit" name="declined" class="btn btn-danger">Declined</button>
            </form>


          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="confirm-processed" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title h4" id="exampleModalFullscreenLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                      <h4 class="card-title">Confirm this Order?</h4>
                    </div>
                  </div>
                  <div class="card-body">

                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="/admin/confirmprocessing" method="post">
              <input type="hidden" name="id" value="<?=$id?>">
              <button type="submit" name="yes" class="btn btn-primary">Yes</button>
              <!-- <button type="submit" name="declined" class="btn btn-danger">Declined</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>

  </main>

  <?=$this->include('admin/inc/footer')?>
  <?=$this->include('admin/inc/end')?>

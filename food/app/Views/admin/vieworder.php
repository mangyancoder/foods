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
      <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('msg') ?>
        </div>
      <?php endif;?>
      <?php foreach ($orders as $ord) {
        $ord = $ord['total'];

      } ?>
      <h4 style="color:white" id="total">Total: ₱ <?=number_format($ord, 2)?></h4>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">

            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                <h4 class="card-title"><?=$type?></h4>
              </div>
            </div>
            <div class="card-body">
              <?php// if($products): ?>
                <div class="row">
                  <div class="col-sm-6">

                  </div>

                </div>
                <br>
                <?php //endif; ?>

                <div class="table-responsive">
                  <table id="ordetable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $pr = new \App\Models\ProductModel;
                      $dd = $pr->join('orders', 'product.pid=orders.packageID')->where('o_tlid', $tlid)->findAll();
                        foreach ($dd as $s): ?>
                        <tr>
                          <td><?= $s['name'] ?></td>
                          <td><?= $s['description'] ?></td>
                          <td><?= $s['p_price'] ?></td>
                          <td><?= $s['o_quantity'] ?></td>
                          <td><?= $s['p_price'] * $s['o_quantity'] ?></td>
                          <td>
                            <button type="button"  class="btn btn-danger remove" data-oid="<?= $s['oid'] ?>">x</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
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
      <div class="modal fade" id="trk" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Transaction ID: <?=$transactID?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                        <h4 class="card-title">Details</h4>
                      </div>
                    </div>
                    <div class="card-body">
                      <form action="<?=base_url('admin/transact')?>" method="POST" enctype="multipart/form-data">
                        <label>Select Client Here</label>
                        <select class="form-control" style="width: 100%;" name="client">
                          <?php if($client): ?>
                            <?php foreach($client as $cl): ?>
                              <option value="<?=$cl['uid']?>"><?=$cl['uname']?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter Amount here" required>
                        <input type="hidden" name="transactID" value="<?=$transactID?>">
                        <input type="hidden" name="total" value="<?= $price ?>">
                        <br>
                        <button type="submit" name="create" class="btn btn-primary">Commit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


    </main>


    <?=$this->include('admin/inc/footer')?>
    <?=$this->include('admin/inc/end')?>

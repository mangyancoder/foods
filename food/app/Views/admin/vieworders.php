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
                $ds = $acct->where('userID', $userID)->join('users', 'orders.userID=users.uid')->where('o_tlid', $id)->findAll();
                foreach ($ds as $gf) {
                  $total += $gf['p_price'];
                }
                foreach ($payment as $pp) {
                  $pd += $pp['amount'];

                }
                $bal = $total - $pd;

                echo 'Client Name: ' . $gf['uname'];
                echo '<br>Phone : ' . $gf['phone'];
                echo '<br>Address : ' . $gf['address'];
                echo '<br>Order Type : ' . $gf['order_type'];
                echo '<br> Total: '. number_format($total, 2);
                echo '<br> Remaining: '. number_format($bal, 2);

                ?>

                <br>
                <?php if($tp == 'pending'){ ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm">
                  Action
                </button>
              <?php }elseif($tp== 'processing'){ ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm-processed">
                  Action
                </button>
              <?php }elseif($tp== 'processed'){ ?>
                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm">
                  Action
                </button> -->
              <?php } ?>

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

                        foreach ($ss as $prod):
                          ?>
                        <tr>
                          <td><?=$prod['name']?></td>
                          <td><?=$prod['description']?></td>
                          <td><?= number_format($prod['p_price'], 2) ?></td>
                          <td>Single</td>
                          <td></td>
                        </tr>
                  <?php endforeach;

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
                <h4>Payment History</h4>
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                    <th>Amount</th>
                    <th>type</th>
                    <th>Date Of Payment</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($payment as $py): ?>

                      <tr>
                        <td><?=$py['amount']?></td>
                        <td><?=$py['type']?></td>
                        <td><?=date('F d, Y h:m', strtotime($py['created_at']))?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
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
                    <form action="<?=base_url('admin/orderval')?>" method="POST" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?=$id?>">
                      <input type="hidden" name="userID" value="<?=$userID?>">
                      <?php if($bal > 0){ ?>
                    <label>Amount</label>
                    <br>
                    <input type="text" name="amount" class="form-control" required>
                    <input type="hidden" name="bal" value="<?=$bal ?>">
                    <label>Payment type</label>
                    <select class="form-control" name="ptype">
                      <option value="cash">cash</option>
                      <option value="gcash">gcash</option>
                    </select>
                    <br>
                    <button type="submit" name="create" class="btn btn-primary">Confirm</button>
                  <?php }else{
                   ?>
                     <input type="hidden" name="amount" class="form-control" value="0">
                   <button type="submit" name="create" class="btn btn-primary">Confirm</button>
                 <?php } ?>
                  </form>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="/admin/orderval" method="post">
              <input type="hidden" name="id" value="<?=$id?>">
              <!-- <button type="submit" name="yes" class="btn btn-primary">Yes</button> -->
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
                      <h4 class="card-title">viewprocessed</h4>
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
              <input type="hidden" name="userID" value="<?=$userID ?>">
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

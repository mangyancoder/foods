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
<div class="conatiner-fluid content-inner mt-n5 py-0">
  <div class="row">
    <?php $ah; ?>
    <?php foreach ($payment as $po): ?>
      <?php $ah += $po['amount']; ?>
    <?php endforeach; ?>
         <div class="col-lg-12">
            <div class="card   rounded">
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <h4 class="mb-2">Events Booking Information</h4>
                        <?php $g =$book['amount'] - $ah;  ?>
                        <h6>Date Requested: <?=$book['bcreated_at']?></h6>
                        <h6>Event : <?=$book['title']?></h6>
                        <h6>Event Dates: <?=$book['start'] .' - ' . $book['end']?></h6>
                        <h6>Location : <?=$book['location']?></h6>
                        <h6>No of Pax : <?=$book['pax']?></h6>
                        <h6>Status : <?=$book['bstatus']?></h6>
                        <h6>MOP : <?= $book['mop'] ?></h6>
                        <h6>total amount : <?= number_format($book['amount'], 2) ?></h6>
                        <h6>Packages : <?php
                        $ress = str_replace( array( '\'', '"', ';', '[', ']' ), ' ', $book['package']);
                        echo $ress;
                        $d = new \App\Models\PackagesModel;


                        // $data = $d->where('pcid', $res)->findAll();
                        //
                        // foreach ($data as $r) {
                        //   echo $r['package_name'];
                        // }
                        ?></h6>

                        <?php if($book['gproof']): ?>
                          <h6>Proof of payment</h6>
                        <img src="<?=base_url() .'/'.$book['gproof']?>" width="400" alt="">
                      <?php endif; ?>
                        <hr>
                        <h5>Client Name: <?= $book['uname']?></h5>
                        <h5>Contact NO: <?= $book['phones']?></h5>
                        <h5>Email : <?= $book['email']?></h5>

                        <?php if($book['bstatus'] == "pending"): ?>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirm">confirm</button>
                        <?php elseif($book['bstatus'] == "approved"): ?>
                          <?php if($g > 0): ?>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payment">Pay</button>
                        <?php else: ?>
                          <h3>PAID</h3>
                        <?php endif; ?>
                        <?php endif; ?>

                     </div>
                  </div>
                  <br>
                  <h4>Foods</h4>

                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                      <th>Food</th>
                      <th>Picture</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php $d = json_decode($book['product']); ?>
                      <?php
                      $model = new \App\Models\ProductModel;
                      foreach ($d as $vb):

                        $pr = $model->where('pid', $vb)->first();

                        ?>

                        <tr>
                          <td><?= $pr['name'] ?> </td>
                          <td><img src="<?= base_url() . '/'.$pr['picture'] ?>" alt="" width="50"> </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
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

</main>
<div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <hz5 class="modal-title h4" id="exampleModalFullscreenLabel">Payments</h5>
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
                <form action="<?=base_url('admin/confirmb')?>" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="bid" value="<?=$bid?>">
                  <input type="hidden" name="user" value="<?= $book['userID'] ?>">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Payer's name" class="form-control" required>
                <label>Type</label>
                <select class="form-select" name="type">
                  <option value="down payment">Down Payment</option>
                  <option value="partial payment">Partial Payment</option>
                  <option value="full payment">Full Payment</option>
                </select>
                <label>Amount</label>
                <input type="text" name="amount" class="form-control" required>
                <br>
                <button type="submit" name="create" class="btn btn-primary">Confirm</button>
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
<div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <hz5 class="modal-title h4" id="exampleModalFullscreenLabel">Payments</h5>
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
                <form action="<?=base_url('admin/confirmb')?>" method="POST" enctype="multipart/form-data">
                  <h4>REMAINING BALANCE: <?= $g ?></h4>
                  <input type="hidden" name="bid" value="<?=$bid?>">
                  <input type="hidden" name="user" value="<?= $book['userID'] ?>">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Payer's name" class="form-control" required>

                <!-- <input type="hidden" name="rembal" value="<?= $g  ?>"> -->
                <label>Type</label>
                <select class="form-select" name="type">
                  <option value="partial payment">Partial Payment</option>
                  <option value="full payment">Full Payment</option>
                </select>
                <label>Amount</label>
                <input type="text" name="amount" class="form-control" required>
                <br>
                <button type="submit" name="create" class="btn btn-primary">Confirm</button>
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

<?=$this->include('admin/inc/footer')?>

<?=$this->include('admin/inc/end')?>

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
          <div class="col-sm-12 col-lg-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title">Delivery Config</h4>
                </div>
              </div>
              <div class="card-body">
                <p>
                  Enter your itextmo api code and Password
                </p>
                <?php if(session()->getFlashdata('msg')):?>
                  <div class="alert alert-success">
                    <?= session()->getFlashdata('msg') ?>
                  </div>
                <?php endif;?>
                <form method="post" action="/admin/addgqr" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="form-label" for="email">Gcash No.</label>
                    <input type="text" class="form-control" name="no" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="email">Gcash QR Code</label>
                    <input type="file" class="form-control" name="file" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Add QR</button>
                  <!-- <button type="submit" class="btn btn-danger">cancel</button> -->
                </form>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-8">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title">Delivery Config</h4>
                </div>
              </div>
              <div class="card-body">
                <?php if(session()->getFlashdata('smsg')):?>
                    <div class="alert alert-success">
                       <?= session()->getFlashdata('smsg') ?>
                    </div>
                <?php endif;?>
                <div class="table-responsive">
                  <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                        <th>Gcash No</th>
                        <th>QR Code</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($gcash as $ap): ?>
                        <tr>
                          <td><?=$ap['g_no']?></td>
                          <td><img src="<?= base_url(). $ap['g_qr'] ?>" width="200"> </td>
                          <td><?=$ap['gcash']?></td>

                          <td>
                            <?php if ($ap['gcash'] == 'off'): ?>
                            <a href="/admin/gcashmod/<?=$ap['gid']?>" class="btn btn-success">Set Active</a>
                            <?php else: ?>
                            <a href="/admin/gcashmod/<?=$ap['gid']?>" class="btn btn-primary">Deactivate</a>
                            <?php endif; ?>

                            <a href="/admin/gcashremove/<?=$ap['gid']?>" class="btn btn-danger">Delete</a>
                            <!-- <a href="/admin/smsmod/<?=$ap['gid']?>" class="btn btn-primary">Edit</a> -->


                          </td>

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Gcash No</th>
                        <th>QR Code</th>
                        <th>Status</th>
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

    </main>


    <?=$this->include('admin/inc/footer')?>

    <?=$this->include('admin/inc/end')?>

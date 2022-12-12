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
                <form method="post" action="/admin/add_del">
                  <div class="form-group">
                    <label class="form-label" for="email">Delivery Fee/Charge</label>
                    <input type="text" class="form-control" name="del">
                  </div>
                  <div class="form-group">
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="dstatus">
                      <label class="form-check-label" for="flexSwitchCheckDefault">Turn On</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Add</button>
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
                        <th>Amount</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($delivery as $ap): ?>
                        <tr>
                          <td><?=$ap['del_amount']?></td>
                          <td><?=$ap['dstatus']?></td>
                          <td>
                            <?php if ($ap['dstatus'] == 'inactive'): ?>
                            <a href="/admin/delmod/<?=$ap['did']?>" class="btn btn-success">Set Active</a>
                            <?php else: ?>
                            <a href="/admin/delmod/<?=$ap['did']?>" class="btn btn-primary">Deactivate</a>
                            <?php endif; ?>

                            <a href="/admin/delremove/<?=$ap['did']?>" class="btn btn-danger">Delete</a>
                            <!-- <a href="/admin/smsmod/<?=$ap['sid']?>" class="btn btn-primary">Edit</a> -->


                          </td>

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Amount</th>
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

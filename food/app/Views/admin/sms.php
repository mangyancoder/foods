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
                  <h4 class="card-title">SMS Config</h4>
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
                <form method="post" action="/admin/addapi">
                  <div class="form-group">
                    <label class="form-label" for="email">API Code</label>
                    <input type="text" class="form-control" name="api">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="pwd">Password:</label>
                    <input type="text" class="form-control" name="pwd">
                  </div>
                  <div class="form-group">
                    <label>Validity</label>
                    <input type="date" name="validity" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Add API</button>
                  <!-- <button type="submit" class="btn btn-danger">cancel</button> -->
                </form>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-8">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title">SMS Config</h4>
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
                        <th>API CODE</th>
                        <th>Password</th>
                        <th>Validity</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($api as $ap): ?>
                        <tr>
                          <td><?=$ap['api']?></td>
                          <td><?=$ap['pwd']?></td>
                          <td><?=$ap['validity']?></td>
                          <td><?=$ap['status']?></td>
                          <td>
                            <?php if ($ap['status'] == 'inactive'): ?>
                            <a href="/admin/smsmod/<?=$ap['sid']?>" class="btn btn-success">Set Active</a>
                            <?php else: ?>
                            <a href="/admin/smsmod/<?=$ap['sid']?>" class="btn btn-primary">Deactivate</a>
                            <?php endif; ?>

                            <a href="/admin/smsremove/<?=$ap['sid']?>" class="btn btn-danger">Delete</a>
                            <!-- <a href="/admin/smsmod/<?=$ap['sid']?>" class="btn btn-primary">Edit</a> -->


                          </td>

                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>API CODE</th>
                        <th>Password</th>
                        <th>Validity</th>
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

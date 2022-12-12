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
                  <h4 class="card-title">Store Configuration</h4>
                </div>
              </div>
              <div class="card-body">
                <p>
                  Enter the required information for your business
                </p>
                <?php if(session()->getFlashdata('msg')):?>
                  <div class="alert alert-success">
                    <?= session()->getFlashdata('msg') ?>
                  </div>
                <?php endif;?>
                <form method="post" action="/admin/siteinfo" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="form-label" for="email">Name: </label>
                    <input type="text" class="form-control" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="email">Description</label>
                    <textarea name="description" rows="2" cols="80" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="email">Address: </label>
                    <input type="text" class="form-control" name="address" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="email">Contact No: </label>
                    <input type="text" class="form-control" name="contact" class="form-control">
                  </div>
                  <div class="form-group">
                    <label class="form-label" for="email">email: </label>
                    <input type="text" class="form-control" name="email" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  <!-- <button type="submit" class="btn btn-danger">cancel</button> -->
                </form>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title">Store Configuration</h4>
                </div>
              </div>
              <div class="card-body">
                <label>Name : <?= $site['name'] ?></label><br>
                <label>Description : <?= $site['description'] ?></label><br>
                <label>Address : <?= $site['address'] ?></label><br>
                <label>Contact No : <?= $site['contact_no'] ?></label><br>
                <label>Email : <?= $site['email'] ?></label>

              </div>
            </div>
            </div>

        </div>
      </div>

    </main>


    <?=$this->include('admin/inc/footer')?>

    <?=$this->include('admin/inc/end')?>

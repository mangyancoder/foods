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
                <h4 class="card-title">Products</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProducts">
                  Add
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>category</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>No. of Sales</th>
                    <th>Stocks</th>
                    <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($products as $prod): ?>
                      <tr>
                        <td><?=$prod['name']?></td>
                        <td><?=$prod['description']?></td>
                        <td><?=$prod['category']?></td>
                        <td><img src="<?=base_url(). '/'.$prod['picture']?>" alt="" width="200"> </td>
                        <td><?=$prod['price']?></td>
                        <td><?=$prod['count']?></td>
                        <td><?=$prod['stocks']?></td>
                        <td>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modify<?=$prod['pid']?>">
                            Modify
                          </button>
                        </td>
                      </tr>


                      <div class="modal fade" id="modify<?=$prod['pid']?>" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Add New Menu/Products</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                              <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                  <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                      <div class="header-title">
                                        <h4 class="card-title">Details</h4>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?=base_url('admin/updateproducts')?>" method="POST" enctype="multipart/form-data">
                                      <label>Name</label>
                                      <input type="text" name="name" placeholder="enter product name" class="form-control" value="<?=$prod['name']?>">
                                      <label>description</label>
                                      <input type="text" name="description" class="form-control" value="<?=$prod['description']?>">
                                      <label>Picture</label>
                                      <br>
                                      <img src="<?=base_url(). '/'.$prod['picture']?>" alt="" width="200">
                                      <input type="hidden" name="old_banner" value="<?=$prod['picture']?>">
                                      <input type="hidden" name="id" value="<?=$prod['pid']?>">
                                      <input type="file" name="file" class="form-control">
                                      <label>Price</label>
                                      <input type="number" name="price" value="<?=$prod['price']?>" class="form-control">

                                      <br>
                                      <button type="submit" name="updateproducts" class="btn btn-primary">Update</button>
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


                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>category</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>No. of Sales</th>
                    <th>Stocks</th>
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
    <?= $this->include('admin/addproducts')?>
  </main>

  <?=$this->include('admin/inc/footer')?>
  <?=$this->include('admin/inc/end')?>

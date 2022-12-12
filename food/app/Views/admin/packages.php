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
          <div class="alert alert-info">
             <?= session()->getFlashdata('msg') ?>
          </div>
      <?php endif;?>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                <h4 class="card-title">Packages</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddProducts">
                  Create New Package
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
                    <th>Banner</th>
                    <th>Price</th>
                    <th>promo</th>
                    <th>validity</th>
                    <th>Items</th>
                    <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $lst = new \App\Models\PackageList; ?>
                    <?php foreach ($packages as $list): ?>
                      <tr>
                        <td><?=$list['package_name']?></td>
                        <td><?=$list['package_description']?></td>
                        <td><img src="<?= base_url() .'/' .$list['package_banner']?>" alt="banner" width="200"></td>
                        <td><?=$list['price']?></td>
                        <td><?=$list['promo']?></td>
                        <td><?=$list['validity']?></td>
                        <td>

                        </td>
                        <td>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modify<?=$list['pcid']?>">
                            Modify
                          </button>
                          <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#additem<?=$list['pcid']?>">
                            Add Item
                          </button>
                        </td>
                      </tr>

                      <div class="modal fade" id="modify<?=$list['pcid']?>" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
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
                                        <form action="<?=base_url('admin/updatepackages')?>" method="POST" enctype="multipart/form-data">
                                      <label>Name</label>
                                      <input type="text" name="name" placeholder="enter product name" class="form-control" value="<?=$list['package_name']?>">
                                      <label>description</label>
                                      <textarea name="description" rows="8" cols="80" class="form-control"><?=$list['package_description']?></textarea>
                                      <label>Picture</label>
                                      <br>
                                      <img src="<?=base_url(). '/'.$list['package_banner']?>" alt="" width="200">
                                      <input type="hidden" name="old_banner" value="<?=$list['package_banner']?>">
                                      <input type="hidden" name="id" value="<?=$list['pcid']?>">
                                      <input type="file" name="file" class="form-control">
                                      <label>Price</label>
                                      <input type="number" name="price" value="<?=$list['price']?>" class="form-control">
                                      <label>Promo</label>
                                      <input type="number" name="promo" class="form-control" value="<?=$list['promo']?>">
                                      <label>Validity</label>
                                      <input type="date" name="validity" class="form-control" value="<?=$list['validity']?>">
                                      <br>
                                      <button type="submit" name="updatepackages" class="btn btn-primary">Update</button>
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

                      <!-- modify products -->
                      <div class="modal fade" id="additem<?=$list['pcid']?>" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
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
                                        <h4 class="card-title"><?= $list['package_name'] ?> Details</h4>
                                      </div>
                                    </div>

                                    <div class="card-body">
                                      <form  action="<?=base_url()?>/admin/additems" method="post">
                                        <?php $plist = new \App\Models\PackageList; ?>

                                            <?php foreach ($category as $prod):?>

                                              <input type="checkbox" name="category[]" value="<?=$prod['cid']?>">Category : <?=$prod['cname']?>
                                              <br>
                                              <input type="number" name="quantity[]" placeholder="quantity per category">

                                              <br>
                                              <?=$prod['price']?>
                                              <br>
                                            <?php endforeach; ?>
                                            <input type="hidden" name="lid" value="<?=$list['pcid']?>">
                                            <br>
                                      <button type="submit" name="additem" class="btn btn-primary">Save</button>
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


<!-- add products -->


                      <?=$this->include('admin/additem')?>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Name</th>
                    <th>description</th>
                    <th>Banner</th>
                    <th>Price</th>
                    <th>promo</th>
                    <th>validity</th>
                    <th>Items</th>
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
    <?= $this->include('admin/createpackage')?>
  </main>

  <?=$this->include('admin/inc/footer')?>
  <?=$this->include('admin/inc/end')?>

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
                <h4 class="card-title"><?=$type?></h4>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                      <th>Client</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Name</th>
                      <th>description</th>
                      <th>Picture</th>
                      <th>type</th>
                      <th>Price</th>
                      <th>Created at</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $sales= new \App\Models\SalesModel; ?>

                    <?php foreach ($trans as $tran): ?>
                      afdsvdbnjdmksl
                      <?php $type = $tran['type']; ?>
                      <?php endforeach; ?>

                      <?php if($type == 'single'): ?>
                        <?php $data = $sales->join('users', 'users.uid=orders.userID')->join('product', 'orders.packageID=product.pid')->where('status', 'pending')->findAll(); ?>
                      <?php foreach ($data as $ds): ?>
                        <tr>
                          <td><?=$ds['uname']?></td>
                          <td><?=$ds['phone']?></td>
                          <td><?=$ds['address']?></td>
                          <td><?=$ds['name']?></td>
                          <td><?=$ds['description']?></td>
                          <td><?=$ds['picture']?></td>
                          <td><?=$ds['type']?></td>
                          <td><?=$ds['price']?></td>
                          <td><?=$ds['ocreated_at']?></td>
                          <td>
                            <a href="<?=base_url()?>/admin/viewpending/<?=$ds['oid']?>"class="btn btn-primary">View</a>

                          </td>
                        </tr>
                        <?php endforeach; ?>
                      <?php elseif($type == 'package'):?>
                        <?php $data = $sales->join('users', 'users.uid=orders.userID')->join('packages', 'orders.packageID=packages.pcid')->findAll(); ?>
                        <?php foreach ($data as $ds): ?>
                          <tr>
                            <td><?=$ds['uname']?></td>
                            <td><?=$ds['phone']?></td>
                            <td><?=$ds['address']?></td>
                            <td><?=$ds['package_name']?></td>
                            <td><?=$ds['package_description']?></td>
                            <td><?=$ds['package_banner']?></td>
                            <td><?=$ds['price']?></td>
                            <td><?=$ds['ocreated_at']?></td>
                            <td>
                            </td>
                          </tr>



                      <?php endforeach; ?>
                      <?php endif; ?>

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Client</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Name</th>
                        <th>description</th>
                        <th>Picture</th>
                        <th>type</th>
                        <th>Price</th>
                        <th>Created at</th>
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

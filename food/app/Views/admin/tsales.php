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
                      <th>Transaction No</th>
                      <th>Client</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>type</th>
                      <th>Total</th>
                      <th>Created at</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $ds): ?>
                      <tr>
                        <td><a href="/admin/viewtrans/<?=$ds['o_tlid']?>"> <?=$ds['o_tlid']?></a></td>
                        <td><?=$ds['uname']?></td>
                        <td><?=$ds['phone']?></td>
                        <td><?=$ds['address']?></td>
                        <td><?=$ds['type']?></td>
                        <td>
                          <?php
                          $t = new \App\Models\SalesModel;
                          $total = $t->select('sum(p_price) as tots')->where('o_tlid', $ds['o_tlid'])->findAll();
                          // var_dump($total);
                          foreach ($total as $ts) {
                            $tp += $ts['tots'];
                          }
                          echo $tp;
                          ?>
                        </td>
                        <td><?=$ds['ocreated_at']?></td>
                        <td></td>
                      </tr>


                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Transaction No</th>
                      <th>Client</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>type</th>
                      <th>Total</th>
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

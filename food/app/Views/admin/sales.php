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
                <table id="example1" class="display nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>Client</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>type</th>
                      <th>Created at</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($trans as $ds ): ?>


                        <tr>
                          <td><?=$ds['uname']?></td>
                          <td><?=$ds['phone']?></td>
                          <td><?=$ds['address']?></td>
                          <!-- <td><?=$ds['name']?></td>
                          <td><?=$ds['description']?></td>
                          <td><?=$ds['picture']?></td> -->
                          <td><?=$ds['type']?></td>
                          <!-- <td><?=$ds['price']?></td> -->
                          <td><?=$ds['ocreated_at']?></td>
                          <td>

                            <?php if($type == 'processed'): ?>
                            <a href="<?=base_url()?>/admin/viewprocessed/<?=$ds['o_tlid']?>"class="btn btn-primary">View</a>
                          <?php elseif($type == 'pending'): ?>
                            <a href="<?=base_url()?>/admin/viewpending/<?=$ds['o_tlid']?>"class="btn btn-primary">View</a>
                          <?php elseif($type == 'processing'): ?>
                            <a href="<?=base_url()?>/admin/viewprocessing/<?=$ds['o_tlid']?>"class="btn btn-primary">View</a>
                          <?php endif; ?>

                          </td>
                        </tr>
<?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Client</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <!-- <th>Name</th>
                        <th>description</th>
                        <th>Picture</th> -->
                        <th>type</th>
                        <!-- <th>Price</th> -->
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

    <script>
    $(document).ready(function() {
      $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
          ]
        } );
      } );
    </script>

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
      <?php
      // $price = 0;
      foreach ($sum as $s) {
        $price+= $s['p_price'] * $s['o_quantity'];
        // $price += $s['p_price'];
        // echo $price;
      }

      ?>
      <h4 style="color:white" id="total">Total: ₱ <?=number_format($price, 2)?></h4>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">

            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                <h4 class="card-title"><?=$type?></h4>
              </div>
            </div>
            <div class="card-body">
              <?php// if($products): ?>
                <div class="row">
                  <div class="col-sm-6">
                    <select class="form-control select2 selectpicker" name="empname" id="prods" style="width: 100%;">
                      <option value="">Select here</option>
                      <?php foreach($products as $order): ?>
                        <option value="<?=$order['pid']?>" data-id="<?= $order['pid']?>" data-price="<?= $order['price'] ?>"><?= $order['name']?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-sm-4">
                    <div class="modal fade" id="AddProducts" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
                      <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Create new Food Packages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <div class="row">
                              <div class="col-sm-12 col-lg-2">

                              </div>
                              <div class="col-sm-12 col-lg-8">
                                <div class="card">
                                  <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                      <h4 class="card-title">Details</h4>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <form action="<?=base_url('admin/createpackage')?>" method="POST" enctype="multipart/form-data">

                                      <label>Name</label>
                                      <input type="text" name="name" placeholder="enter product name" class="form-control" required>
                                      <label>description</label>
                                      <input type="text" name="description" class="form-control" required>
                                      <label>Package Banner</label>
                                      <input type="file" name="file" class="form-control" required>
                                      <label>Price</label>
                                      <input type="number" name="price" class="form-control" required>
                                      <label>Promo</label>
                                      <input type="number" name="promo" class="form-control" required>
                                      <label>Validity</label>
                                      <input type="date" name="validity" class="form-control" required>
                                      <br>
                                      <button type="submit" name="create" class="btn btn-primary">Save</button>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#trk">
                      Transact
                    </button>
                  </div>
                </div>
                <br>
                <?php //endif; ?>

                <div class="table-responsive">
                  <table id="ordetable" class="table table-striped" data-toggle="data-table">
                    <thead>
                      <tr>
                        <th>NAME</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($orders as $s): ?>
                        <tr>
                          <td><?= $s['name'] ?></td>
                          <td><?= $s['description'] ?></td>
                          <td><?= $s['p_price'] ?></td>
                          <td><?= $s['o_quantity'] ?></td>
                          <td><?= $s['p_price'] * $s['o_quantity'] ?></td>
                          <td>
                            <button type="button"  class="btn btn-danger remove" data-oid="<?= $s['oid'] ?>">x</button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>NAME</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>SubTotal</th>
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
      <div class="modal fade" id="trk" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Transaction ID: <?=$transactID?></h5>
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
                      <form action="<?=base_url('admin/transact')?>" method="POST" enctype="multipart/form-data">
                        <label>Select Client Here</label>
                        <select class="form-control" style="width: 100%;" name="client">
                          <?php if($client): ?>
                            <?php foreach($client as $cl): ?>
                              <option value="<?=$cl['uid']?>"><?=$cl['uname']?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                        <label>Amount</label>
                        <input type="text" name="amount" class="form-control" placeholder="Enter Amount here" required>
                        <input type="hidden" name="transactID" value="<?=$transactID?>">
                        <input type="hidden" name="total" value="<?= $price ?>">
                        <br>
                        <button type="submit" name="create" class="btn btn-primary">Commit</button>
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


    </main>


    <?=$this->include('admin/inc/footer')?>
    <?=$this->include('admin/inc/end')?>


    <script>
    $(document).ready(function(){
      $(".remove").click(function(){
        var oid = $(this).attr("data-oid");
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            // alert(`hello , ${oid}`);
            $.ajax({
              url: `<?= base_url() ?>/admin/remove/${oid}`,
              method: 'post',
              success: function(data){
                location.reload();
              }
            });

          }
        })
      });
      $('.selectpicker').change(function () {
        var selected = $(this).find('option:selected');
        var selectedItem = $('.selectpicker').val();
        var price = selected.data('price');
        $(".psr").val(price);
        $(".id").val(selectedItem);
        var resp = window.prompt("Enter Quantity");
        var o_tlid = '<?=$transactID?>'
        if(isNaN(resp)){
          alert("Must input numbers");
          return false;

        }else{
          $.ajax({
            url: "<?= base_url("/admin/addorders") ?>",
            method: "POST",
            data:{
              otlid: o_tlid,
              packageID: selectedItem,
              quantity:resp,
              p_price: price
            },
            success:function(data){
              // $('#customersTable').DataTable().ajax.reload(null, false);
              window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
            }

          });
        }
      });

    });
    </script>

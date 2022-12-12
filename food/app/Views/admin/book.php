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
                <h4 class="card-title">
                  <?php if($type == 'booked'): ?>
                    All Booking's
                  <?php elseif($type == 'done'): ?>
                    Done Booking's
                  <?php elseif($type == 'pending'): ?>
                    Pending
                  <?php elseif($type == 'approved'): ?>
                    Confirmed
                  <?php endif;?>
                </h4>

              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable" class="table table-striped" data-toggle="data-table">
                  <thead>
                    <tr>
                      <th>Client Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Date Booked</th>
                      <th>Reservation Date</th>
                      <th>End Date</th>
                      <th>No. of Pax</th>
                      <th>Location</th>
                      <th>MOP</th>

                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($fd as $dt): ?>
                      <tr>
                        <td><?=$dt['uname']?></td>
                        <td><?=$dt['email']?></td>
                        <td><?=$dt['phone']?></td>
                        <td><?=$dt['address']?></td>
                        <td><?=$dt['bcreated_at']?></td>
                        <td><?=$dt['start']?></td>
                        <td><?=$dt['end']?></td>
                        <td><?=$dt['pax']?></td>
                        <td><?=$dt['location']?></td>
                        <td><?=$dt['mop']?></td>
                        <td><a href="/admin/events/<?=$dt['id']?>">view</a> </td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Client Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Date Booked</th>
                      <th>Reservation Date</th>
                      <th>End Date</th>
                      <th>No. of Pax</th>
                      <th>Location</th>
                      <th>MOP</th>
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

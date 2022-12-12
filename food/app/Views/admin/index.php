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
    <?= $this->include('admin/inc/card'); ?>
  </div>
  <div class="row">
      <div class="col-lg-12">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card  ">
                      <div class="card-body">
                          <div id='calendar1'></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>

</main>


<?=$this->include('admin/inc/footer')?>

<?=$this->include('admin/inc/end')?>

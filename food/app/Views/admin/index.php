<?=$this->include('admin/inc/top')?>
<script type="text/javascript">
  $(document).ready(function() {

    $.ajax({
      url : "<?=base_url()?>/admin/graph",
      dataType : "JSON",
      success : function(result) {
        google.charts.load('current', {
          'packages' : [ 'corechart' ]
        });
        google.charts.setOnLoadCallback(function() {
          drawChart(result);
        });
      }
    });
    function drawChart(result) {

      var data = new google.visualization.DataTable();

      data.addColumn('string', 'year');
      data.addColumn('number', 'total');
      var dataArray = [];
      $.each(result, function(i, obj) {
        dataArray.push([ obj.year, parseInt(obj.total) ]);
      });

      data.addRows(dataArray);

      var piechart_options = {
        title : 'Yearly Sales',
        width : 570,
        height : 300
      };
      // var piechart = new google.visualization.PieChart(document
      // 		.getElementById('piechart_div'));

      var piechart = new google.visualization.AreaChart(document
          .getElementById('piechart_div'));
      piechart.draw(data, piechart_options);

      var barchart_options = {
        title : 'Yearly Sales',
        width : 570,
        height : 300,
        legend : 'none'
      };

      var barchart = new google.visualization.BarChart(document
          .getElementById('barchart_div'));
      barchart.draw(data, barchart_options);
    }

  });
</script>
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
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Sales</h3>
            <a href="/owner/sales">View Report</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">

          </div>
          <!-- /.d-flex -->

          <div class="position-relative mb-4">
            <div id="piechart_div" style="border: 1px solid #ccc"></div>
          </div>

          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> Total Sales
            </span>

            <span>
              <i class="fas fa-square text-gray"></i> Yearly Sales
            </span>
          </div>
        </div>
      </div>
      <!-- /.card -->


      <!-- /.card -->
    </div>
    <!-- /.col-md-6 -->
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Sales</h3>
            <a href="javascript:void(0);">View Report</a>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex">


          </div>
          <!-- /.d-flex -->

          <div class="position-relative mb-4">
            <div id="barchart_div" style="border: 1px solid #ccc"></div>
          </div>

          <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
              <i class="fas fa-square text-primary"></i> This year
            </span>

            <span>
              <i class="fas fa-square text-gray"></i> Last year
            </span>
          </div>
        </div>
      </div>
      <!-- /.card -->

    </div>
    <!-- /.col-md-6 -->
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

<?php
require 'includes/header.php';
require '../functions/myfunctions.php';
require '../config/connectdb.php';

$query = mysqli_query($conn, "SELECT * FROM `corporation`");
$count1 = mysqli_num_rows($query);
$query = mysqli_query($conn, "SELECT * FROM `jobs`");
$count2 = mysqli_num_rows($query);
$query = mysqli_query($conn, "SELECT * FROM `users`");
$count3 = mysqli_num_rows($query);
$query = mysqli_query($conn, "SELECT * FROM application");
$count4 = mysqli_num_rows($query);
?>

<div class="card-header">
  <h1 style="text-align: center;height: 100px; margin-top: 25px;">
    DASH BOARD
  </h1>

</div>
<div class="container">
  <div class="row">
    <div class="col-md-12">

      <!-- content -->
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">business</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total Corporation</p>
                  <h4 class="mb-0"><?php echo $count1  ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">work</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total Jobs</p>
                  <h4 class="mb-0"><?php echo $count2  ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">person</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Total users</p>
                  <h4 class="mb-0"><?php echo $count3  ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6">
            <div class="card">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">weekend</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Application</p>
                  <h4 class="mb-0"><?= $count4 ?></h4>
                </div>
              </div>
              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="row">
    <div class="col-md-12 d-flex justify-content-center" id="piechart" style="height:300px ;">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['PHP', 11],
            ['CSS', 2],
            ['JavaScript', 2],
            ['Bootstrap', 2],
            ['HTML', 7]
          ]);
          var options = {
            title: 'The Technology Used'
          };
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
      </script>
    </div>
  </div> -->
</div>



<?php include 'includes/footer.php'; ?>
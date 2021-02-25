<?php
include("db_config.php");
session_start();
if (!isset($_SESSION['loged_user'])) {
    //echo "Access Denied";
    header('location: login.php');
}else {
$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
mysqli_select_db($con,DB_NAME);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    PANASONIC
   </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper ">
    
    <?php include('include/sidebar.php');  ?>

    <div class="main-panel">
      <!-- Navbar -->
      <?php include('include/nav.php');  ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">         
            <div class="card">
              <div class="row">
                <div class="card-header">
                  <h5 class="card-title pl-3">&nbsp;&nbsp;SALES REPORT</h5>                    
                </div>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-4 pl-1">
                        <div class="form-group"> 
                          <label>From Date</label>
                        <input type="date" class="form-control date_func" id="from_date" name="from_date" required>
                        </div>
                        </div>
                        <div class="col-md-4 pl-1">
                        <div class="form-group"> 
                          <label>To Date</label>
                        <input type="date" class="form-control date_func" id="to_date" name="to_date" required>
                        </div>
                        </div>
                      </div>
                      </div>

                      <div class="col-md-3">
                        <div class="col-md-12">
                          <div class="form-group" >
                            <h6 style="text-align:'right';">Today : <?php echo date('Y-m-d'); ?> </h6>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </form>
              
              <div class="table-responsive">
                <div id="show_report">

                </div>
              </div>
            </div>
          </div><!--card -->
        </div>
      </div>
    </div>  
  <!-- FOOTER -->
   <?php include('include/footer.php');  ?>
  <!-- FOOTER -->
  </div> <!-- end main panel -->
</div> <!-- end wrapper -->

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>

  <script>

    $('.date_func').on('change', function() {

        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        $.ajax({
              url:"view_report.php",
              method:"POST",
              data:{"from_date":from_date,"to_date":to_date},
              success:function(data){
                $('#show_report').html(data);
              }
        });
    });

  </script>

</body>

</html>
<?php
}
?>
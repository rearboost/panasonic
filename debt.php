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
                  <h5 class="card-title pl-3">&nbsp;&nbsp;DAILY SALES REPORT</h5>                    
                </div>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="col-md-5" style="margin-top: 12px">
                        <div class="form-group"> 
                        <SELECT class="form-control" id="option" name="option" required>
                          <option>Received</option>
                          <option>To be Received</option>
                          <option>Cheques To be Exchanged</option>
                        </SELECT>
                        </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                            <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Add New Cash Receipt..
                            </button> 
                      </div>
                  </div>
                </div>
              </form>

              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form id="receiptAdd">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Add New Cash Receipt</h5>
                        </div>
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>SHOP</label>
                              <SELECT class="form-control" id="shop" name="shop" required>
                                <option>----Select Shop----</option>
                                <?php
                                $shop = "SELECT DISTINCT(shop)
                                          FROM bill WHERE credit IS NOT NULL
                                          ";

                                $result1 = mysqli_query($con,$shop);
                                $numRows1 = mysqli_num_rows($result1); 
                 
                                  if($numRows1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($result1)) {
                                      echo "<option value = ".$row1['shop'].">" . $row1['shop'] . "</option>";
                                      
                                    }
                                  }
                            ?>
                              </SELECT>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>DATE</label>
                              <Input type="date" class="form-control" id="rdate" name="rdate" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>Debt Outstanding</label>
                              <input type="text" class="form-control" placeholder="LKR" name="outstanding" id="outstanding" required readonly>
                            </div>
                          </div>

                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>Amount</label>
                              <input type="text" class="form-control" placeholder="LKR" name="pay"  name="pay" required>
                            </div>
                          </div>
                        </div>

                              
                          <div class="row">
                          <div class="update ml-auto mr-auto">
                            <input type="hidden" name ="submit" value="Submit"/>
                            <button type="submit" class="btn btn-primary btn-round">Submit</button>
                            <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">

                            <?php
                                if(isset($_POST['submit'])){
                                  $category     = $_POST['category'];

                                $insert1 = "INSERT INTO category (category_name) VALUES ('$category')";
                                mysqli_query($con,$insert1);
                                }
                            ?>
                          </div>
                        </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- card body-->
              
              <div class="table-responsive">
                <div id="show">

                </div>
              </div>
            </div><!-- card body-->
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

$('#option').on('change', function() {

    var option = $('#option').val();

    $.ajax({
          url:"view.php",
          method:"POST",
          data:{"option":option},
          success:function(data){
            $('#show').html(data);
          }
    });
});

$('#shop').on('change', function() {
  var shop = $('#shop').val();

    $.ajax({
          url:"get_outstanding.php",
          method:"POST",
          data:{"shop":shop},
          success:function(response){

            var obj = JSON.parse(response);

            var outstand     =  obj.outstand
            $('#outstanding').val(outstand);
          }
    });
});

  </script>

</body>

</html>
<?php
}
?>
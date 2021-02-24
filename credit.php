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
                <div class="col-md-8"> 
                <div class="card-header">
                  <h5 class="card-title pl-3">&nbsp;&nbsp;CREDIT COLLECTION</h5>                    
                </div>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1" style="margin-right: 20px; margin-top: 20px;">+ Add New Invoice / Payment
                  </button> 
                </div>
              </div>
              <div class="card-body">
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                          <button class="btn btn-danger add-btn" style="margin-left: 30px;" id="dbtn2" name="dbtn2"> To be Paid</button>
                          <button class="btn btn-primary add-btn" id="dbtn1" name="dbtn1"> Paid</button> 
                          </div>
                        </div>
                  </div>
                </div>

              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form id="creditAdd">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Add New Invoice / Payment</h5>
                        </div>
                        <div class="col-md-12">
                        <div class="row" style="margin-top: 10px">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <Input type="radio" name="type" id="invoice" value="invoice">
                              <label>INVOICE</label>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <Input type="radio" name="type" id="payment" value="payment">
                              <label>PAYMENT</label>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                            <label>INVOICE #</label>
                            <Input type="text" class="form-control" id="ino" name="ino" disabled>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                            <label>INVOICE #</label>
                            <select class="form-control form-selectbox" id="inum" name="inum" disabled>
                              <option value="">Invoice #</option>
                              <?php
                                
                                $get_ino = mysqli_query($con,"SELECT * FROM credit WHERE type='invoice' AND  credit_status=1");

                                $numRows1 = mysqli_num_rows($get_ino); 
                 
                                  if($numRows1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($get_ino)) {
                                      echo '<option value = "'.$row1["invoice_no"].'"> '. $row1['invoice_no'] .' </option>';
                                      
                                    }
                                  }
                              ?>
                            </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                            <label>DATE</label>
                            <Input type="date" class="form-control" id="idate" name="idate" disabled>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                            <label>DATE</label>
                            <Input type="date" class="form-control" id="pdate" name="pdate" disabled>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>Amount</label>
                              <input type="text" class="form-control" placeholder="LKR" name="iamt"  id="iamt" disabled>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" placeholder="LKR" name="pamt"  id="pamt" disabled>
                          </div>
                            <div class="form-group">
                              <input type="hidden" class="form-control" placeholder="LKR" name="remain" id="remain" readonly>
                              <input type="hidden" class="form-control" placeholder="LKR" name="new_remain" id="new_remain" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                        <div class="update ml-auto mr-auto">
                          <input type="hidden" name ="submit" value="submit"/>
                          <button type="submit" class="btn btn-primary btn-round">Submit</button>
                          <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">
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

  $( document ).ready(function() {
    $.ajax({
      url:"tobe_paid.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });

  $('#dbtn1').on('click', function() {

    $.ajax({
      url:"paid.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });

  $('#dbtn2').on('click', function() {

    $.ajax({
      url:"tobe_paid.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });

    

  $('#invoice').on('change', function() {

    $('#ino').prop('disabled', false);
    $('#idate').prop('disabled', false);
    $('#iamt').prop('disabled', false);

    $('#inum').prop('disabled', true);
    $('#pdate').prop('disabled', true);
    $('#pamt').prop('disabled', true);

    $('#ino').prop('required', true);
    $('#idate').prop('required', true);
    $('#iamt').prop('required', true);

    $('#inum').val('');
    $('#pdate').val('');
    $('#pamt').val('');
    $('#new_remain').val('');

    // $.ajax({
    //     url:"get_remain.php",
    //     method:"POST",
    //     //data:{"shop":shop},
    //     success:function(response){

    //     var remain = Number(response)

    //     $('#remain').val(remain.toFixed(2));
    //   }
    // });
  });

  $('#payment').on('change', function() {
    
    $('#inum').prop('disabled', false);
    $('#pdate').prop('disabled', false);
    $('#pamt').prop('disabled', false);

    $('#ino').prop('disabled', true);
    $('#idate').prop('disabled', true);
    $('#iamt').prop('disabled', true);

    $('#inum').prop('required', true);
    $('#pdate').prop('required', true);
    $('#pamt').prop('required', true);

    $('#ino').val('');
    $('#idate').val('');
    $('#iamt').val('');
    $('#new_remain').val('');

  });

  // $('#iamt').on('keyup', function() {

  //   var value1 = $('#iamt').val();
  //   // var remain1 = $('#remain').val();

  //   // var new_remain1 = Number(remain1) + Number(value1)

  //   $('#new_remain').val(value1.toFixed(2));
 
  // });
$('#inum').on('change', function() {

  var invoice = $('#inum').val();
  $.ajax({
      url:"get_remain.php",
      method:"POST",
      data:{"invoice":invoice},
      success:function(response){

        var remain = Number(response)

        $('#remain').val(remain.toFixed(2));
      }
    });
});

  $('#pamt').on('keyup', function() {

    var value2 = $('#pamt').val();
    var remain2 = $('#remain').val();

    var new_remain2 = Number(remain2) - Number(value2)

    $('#new_remain').val(new_remain2.toFixed(2));
 
  });
  ///////////////////////////////////////////////////

  $(function () {

      $('#creditAdd').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
          type: 'post',
          url: 'credit_insert.php',
          data: $('#creditAdd').serialize(),
          success: function () {
            swal({
              title: "Good job !",
              text: "Successfully Submited",
              icon: "success",
              button: "Ok !",
              });
              setTimeout(function(){ location.reload(); }, 2500);
             }
        });

      });

    });

    ///////// Form values reset /////////
    function form_reset(){
    document.getElementById("creditAdd").reset();
    $('#ino').prop('disabled', true);
    $('#idate').prop('disabled', true);
    $('#iamt').prop('disabled', true);
    $('#inum').prop('disabled', true);
    $('#pdate').prop('disabled', true);
    $('#pamt').prop('disabled', true);
    }

//////////////////// 

  </script>

</body>

</html>
<?php
}
?>
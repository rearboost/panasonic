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

   <!-- include head code here -->
  <?php  include('./include/head.php');   ?>

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
                  <h5 class="card-title pl-3">&nbsp;&nbsp;DEBT COLLECTION</h5>                    
                </div>
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1" style="margin-right: 20px; margin-top: 20px;">+ Add New Cash Receipt..
                  </button> 
                </div>
              </div>
              <div class="card-body">
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                          <button class="btn btn-primary add-btn" style="margin-left: 30px;" id="btn1" name="btn1"> Received</button> 
                          <button class="btn btn-danger add-btn" id="btn2" name="btn2"> To be Received</button> 
                          <button class="btn btn-success add-btn" id="btn3" name="btn3"> Cheque to be Exchanged &nbsp;&nbsp;
                            <!-- <label class="btn-sm" style="background-color:red; border: 0px; color: #ffffff; padding-top: 2px; border-radius: 100px 100px 100px 0px;"> -->  
                              <font color="red"><b>
                                <?php
                                    include("notification_msg.php"); // show notification msg

                                    if($numRows>0){
                                    echo " " . $numRows . " new";
                                }
                                ?>
                            </b></font>
                          </button> 
                          </div>
                        </div>
                  </div>
                </div>

              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form id="debt_add">
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

                                    echo '<option value = "'.$row1["shop"].'"> '. $row1['shop'] .' </option>';
                                      
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
  <!-- DataTables JS -->
  <script src="assets/js/jquery.dataTables.js"></script>

  <script>


  $(document).ready(function() {
    $.ajax({
      url:"received.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });

// need to load php page to the #show when button click
  $('#btn1').on('click', function() {

    $.ajax({
      url:"received.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });

  $('#btn2').on('click', function() {

    $.ajax({
      url:"tobe_received.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });

    $('#btn3').on('click', function() {

    $.ajax({
      url:"tobe_exchanged.php",
      method:"POST",
      success:function(data){
        $('#show').html(data);
      }
    });
  });
// need to load php page to the #show when button click

  $('#shop').on('change', function() {
    var shop = $('#shop').val();

    $.ajax({
      url:"get_outstanding.php",
      method:"POST",
      data:{"shop":shop},
      success:function(response){

        var obj = JSON.parse(response);

        var outstand     =  obj.outstand
        var tot_amt     =  obj.tot_amt

        var out = Number(outstand)-Number(tot_amt)

        $('#outstanding').val(out.toFixed(2));
      }
    });
  });

  ///////////////////////////////////////////////////

    $(function () {

        $('#debt_add').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'debt_insert.php',
            data: $('#debt_add').serialize(),
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
    document.getElementById("debt_add").reset();
    }

//////////////////// 

  </script>

</body>

</html>
<?php
}
?>
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
              <div class="col-md-9">
              <div class="card-header">
                <h4 class="card-title"> Profit</h4>    
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                
              </div>
              </div>
              <div class="col-md-3">
                <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Add New Profit..
                    </button> 
                </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Profit</h5>
                      </div> 
                      <form id="profitAdd">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="form-group">
                            <label>DATE</label> 
                            <input type="date" class="form-control" id="cdate" name="cdate" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="form-group">
                              <label>SALES</label>
                              <input type="text" class="form-control" placeholder="LKR" name="sales" id="sale" required readonly>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="form-group">
                              <label>EXPENSES</label>
                              <input type="text" class="form-control cal_profit" placeholder="LKR" name = "expense" id="expense" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-8 pr-1">
                            <div class="form-group">
                              <label>DAILY PROFIT</label>
                              <input type="text" class="form-control" placeholder="LKR" name="profit"  id="profit" readonly required>
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
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                    DATE    </th>
                      <th class="text-right"> SALES   </th>
                      <th class="text-right"> EXPENSES</th>
                      <th class="text-right"> PROFIT  </th>
                      <th class="text-center">EDIT 		</th>
                      <th class="text-center">DELETE 	</th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM profit");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td>                    <?php echo $row['cdate'] ?>        </td>
                            <td class="text-right"> <?php echo $row['sales'] ?>        </td>
                            <td class="text-right"> <?php echo $row['expenses'] ?>     </td>
                            <td class="text-right"> <?php echo $row['daily_profit'] ?> </td>

                            <td class="text-center">  
                             <a href="#" onclick="editView('<?php echo $row['P_id']; ?>')" name="edit">
                              <h6 style='color:green;'>EDIT</h6></a>
                            </td>

                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['P_id']; ?>')" name="delete">
                              <h6 style='color:red;'>DELETE</h6></a>
                            </td>

                          </tr>
                    </tbody>
                           <?php
                        }
                      }
                    ?>                      
                    </table>
                  <?php
                  mysqli_close($con);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div>
  </div>

  <div id="show_view">

  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>

  <script>

  /////////////////////////////////////// Table Search 
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  }); 

  // Form edit 
  function editView(id){

    $.ajax({
      url:"edit_profit.php",
      method:"POST",
      data:{"id":id},
      success:function(data){
        $('#show_view').html(data);
        $('#Form3').modal('toggle');
      }
    });
  }

  ///////////////GET TOTAL SALES AMOUNT////////////////////// 

  $('#cdate').on('change', function() {
    
    var cdate = $('#cdate').val();

    $.ajax({
      url: 'get_sale.php',
      method:"POST",
      data:{cdate:cdate},
      success: function (response) {
        
        var obj = JSON.parse(response);
        var sale_amt1  =  obj.sale_amt
        //alert(sale_amt1)
 
        $('#sale').val(sale_amt1);
      }
    });  
  });

  ////////////////////////////////////////////

  ///////// Form values reset /////////
  function form_reset(){
    document.getElementById("profitAdd").reset();
  }

  ////////////////////  

  // Form delete 
  function delete_profit(id){

    $.ajax({
      url:"delete_profit",
      method:"POST",
      data:{"id":id},
      success:function(data){
          swal({
          title: "Good job !",
          text: data,
          icon: "success",
          button: "Ok !",
          });
          setTimeout(function(){ location.reload(); }, 2500);

      }
      });
  }

  // delete confirmation javascript
  function confirmation(e,id) {
      swal({
      title: "Are you sure?",
      text: "Want to Delete this recode !",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {
             delete_profit(id)
          } 
      });
  }
    
  //////////////CALCULATE THE PROFIT///////////////// 
  $('.cal_profit').on('keyup', function() {

     cal_profit();
      
  }); 

  function cal_profit(){
    var income = $('#sale').val();
    var expenses = $('#expense').val();
    var pro = Number(income)-Number(expenses);

    $('#profit').val(pro.toFixed(2));

  }
  ///////////////////////////////////////////////////

  $(function () {

    $('#profitAdd').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'profit_insert.php',
        data: $('#profitAdd').serialize(),
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
</script>
</body>

</html>
<?php
}
?>

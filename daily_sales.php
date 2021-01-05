<?php
error_reporting(0);
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
                  <h4 class="card-title"> Daily Sales </h4>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Add New Bill..
                    </button> 
                </div>
              </div>
              </div>
              <!--  -->

              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Bill</h5>
                      </div> 
                      <form id="BillAdd">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>SHOP</label>
                                <select class="form-control form-selectBox" name="shop" id="shop" required>
                                  <option value="default">--Select Shop--</option>
                                    <option value = "shop1">Shop 1</option>
                                    <option value = "shop2">Shop 2</option>
                                    <option value = "shop3">Shop 3</option>
                                    <option value = "shop4">Shop 4</option>
                                    <option value = "shop5">Shop 5</option>
                                    <option value = "shop6">Shop 6</option>
                                    <option value = "shop7">Shop 7</option>
                                    <option value = "shop8">Shop 8</option>
                                    <option value = "shop9">Shop 9</option>
                                    <option value = "shop10">Shop 10</option>
                                    <option value = "shop11">Shop 11</option>
                                    <option value = "shop12">Shop 12</option>
                                    <option value = "shop13">Shop 13</option>
                                    <option value = "shop14">Shop 14</option>
                                    <option value = "shop15">Shop 15</option>
                                    <option value = "shop16">Shop 16</option>
                                </select>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>BILL #</label>
                              <input type="text" class="form-control" placeholder="" name="bill_no" id="bill_no" required readonly>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>DATE</label>
                              <input type="date" class="form-control" id="b_date" name="b_date" required>
                            </div>
                          </div>

                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>NO. OF ITEMS</label>
                              <input type="text" class="form-control" placeholder="XXX" name="item_num" id="item_num" required disabled>
                            </div>
                          </div>
                        </div>

                         <!-- this area depends on the no of select items --> 
                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>ITEM</label>
                              <select class="form-control form-selectBox" id="item" name="item" required>
                                  <option value="default">--Select Item--</option>
                                  <?php
                                
                                      $get_item = mysqli_query($con,"SELECT * FROM item");

                                      $numRows1 = mysqli_num_rows($get_item); 
                       
                                        if($numRows1 > 0) {
                                          while($row1 = mysqli_fetch_assoc($get_item)) {
                                            echo "<option value = ".$row1['item_name'].">" . $row1['item_name'] . "</option>";
                                            
                                          }
                                        }
                                  ?>
                                  
                                </select>
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>TOTAL</label>
                              <input type="text" class="form-control" id="total" name="total" required>
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>SALE</label>
                              <input type="text" class="form-control" id="sale" name="sale" required>
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>FREE</label>
                              <input type="text" class="form-control" id="free" name="free" required>
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>AF BAL</label>
                              <input type="text" class="form-control" id="af_bal" name="af_bal" required readonly>
                            </div>
                          </div>
                        </div>
                        <!-- end -->

                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>CASH</label>
                              <input type="text" class="form-control" placeholder="LKR" name = "cash" required>
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>CREDIT</label>
                              <input type="text" class="form-control" placeholder="LKR" name = "credit" required>
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>CHEQUE</label>
                              <input type="text" class="form-control" placeholder="LKR" name = "cheque" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="update ml-auto mr-auto">
                            <input type="hidden" name ="submit" value="Submit"/>
                            <button type="submit" name="submit" class="btn btn-primary btn-round">Submit</button>
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
                      <th>                     BILL #     </th>
                      <th>                     SHOP NAME  </th>
                      <th>                     DATE       </th>
                      <th class="text-right">  CASH       </th>
                      <th class="text-right">  CREDIT     </th>
                      <th class="text-right">  CHEQUE     </th>
                      <!-- <th class="text-center"> EDIT       </th> -->
                      <th class="text-center"> DELETE     </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM bill");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {

                          ?>
                          <tr>
                            <td>                    <?php echo $row['bill_no'] ?> </td>
                            <td>                    <?php echo $row['shop'] ?>    </td>
                            <td>                    <?php echo $row['b_date'] ?>  </td>
                            <td class="text-right"> <?php echo $row['cash'] ?>    </td>
                            <td class="text-right"> <?php echo $row['credit'] ?>  </td>
                            <td class="text-right"> <?php echo $row['cheque'] ?>  </td>
 
                            <!--<td class="text-center">  
                             <a href="#" onclick="editView('<?php // echo $row['bill_no']; ?>')" name="edit">
                              <h6 style='color:green;'>EDIT</h6></a>
                            </td> -->

                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['bill_no']; ?>')" name="delete">
                              <h6 style='color:red;'>DELETE</h6></a>
                            </td>

                          </tr>
                    </tbody>
                           <?php
                        }
                      }
                    ?>                      
                    </table>
                  
                </div>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-md_12 -->
        </div><!-- row -->
      </div><!-- content -->
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div><!-- main panel -->
  </div><!-- wrapper -->

  <div id="show_view">

  </div>
  
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
    <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>
  
  <script>

//////////////////////////////GET NEW BILL NO //////////////////////////////////
$('#shop').on('change', function() {

  const zeroPad = (num, places) => String(num).padStart(places, '0');

    $.ajax({
      url: 'bill_no.php',
      method:"POST",
      data:{shop:this.value},
      success:function(response) {//response is value returned from php (for your example it's "bye bye"
        var lastNumber = Number(response.substr(1))+1;
        $('#bill_no').val(zeroPad(lastNumber, 4));
      }
    });
}); 

////////////////////Fetch Items according to the category//////////////////////
$('#b_date').on('change', function() {
      $('#item_num').prop('disabled', false);
});

////////////////////Fetch total when item changed/////////////////////////////
$('#item').on('change', function() {
      
});

////////Calculate free items & af bal according to sale amount///////////////
$('#sale').on('keyup', function() {

  var total_qty = $('#total').val();
  var sale_qty = $('#sale').val();
  var free = $('#free').val();
  var free_qty;

  free_qty = (Number(sale_qty)/12)*3;

  var after_qty = Number(total_qty) - (Number(sale_qty)+Number(free_qty));

  $('#free').val(free_qty);
  $('#af_bal').val(after_qty);

});

////////Calculate free items & af bal according to sale amount////////////
$('#free').on('keyup', function() {

  var total_qty = $('#total').val();
  var sale_qty = $('#sale').val();
  var free = $('#free').val();

  var after_qty = Number(total_qty) - (Number(sale_qty)+Number(free));

  $('#af_bal').val(after_qty);

});

///////////////////// Form values reset //////////////////////////
function form_reset(){
  document.getElementById("BillAdd").reset();
}

// function editView(id){

//   $.ajax({
//       url:"edit_bill.php",
//       method:"POST",
//       data:{"id":id},
//       success:function(data){
//         $('#show_view').html(data);
//         $('#Form2').modal('show');
//       }
//     });
// 

///////////////////////Delete bill///////////////////////////////

function delete_bill(id){

  $.ajax({
      url:"delete_bill",
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

////////////////////////////Delete bill///////////////////////////////
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
           delete_bill(id)
        } 
    });
}

///////////////////////////Insert bill///////////////////////////////////////

$(function () {

    $('#BillAdd').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'bill_insert.php',
        data: $('#BillAdd').serialize(),
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
///////////////////////////////////////////////////////////////////////

  </script>

</body>

</html>


<?php
mysqli_close($con);
}
?>
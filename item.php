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
                <h4 class="card-title"> ITEMS</h4>    
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                
              </div>
              </div>
              <div class="col-md-3">
                <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Add New Item..
                    </button> 
                </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Item</h5>
                      </div> 
                      <form id="itemAdd">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>ITEM CATEGORY</label>
                                <select class="form-control form-selectBox" name = "category" required>
                                  <option value="default">--Select Category--</option>
                                  <?php
                                
                                      $get_category = mysqli_query($con,"SELECT * FROM category");

                                      $numRows1 = mysqli_num_rows($get_category); 
                       
                                        if($numRows1 > 0) {
                                          while($row1 = mysqli_fetch_assoc($get_category)) {
                                            echo "<option value = ".$row1['category_name'].">" . $row1['category_name'] . "</option>";
                                            
                                          }
                                        }
                                  ?>
                                  
                                </select>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>ITEM</label>
                              <input type="text" class="form-control" placeholder="Item" name = "item" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>BATCH NO</label>
                              <input type="text" class="form-control" placeholder="Batch No" name = "batch_no" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>SIZE</label>
                              <input type="text" class="form-control" placeholder="Size" name = "size" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>PURCHASE PRICE</label>
                              <input type="text" class="form-control" placeholder="LKR" name = "purchase" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>SALE PRICE</label>
                              <input type="text" class="form-control" placeholder="LKR" name = "sale" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>STOCK IN [SALE]</label>
                              <input type="text" class="form-control" placeholder="Quantity" name = "stock_in" id="stock_in" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>WAREHOUSE SALE STOCK</label>
                              <input type="text" class="form-control" placeholder="Quantity" name = "warehouse_stock" id="warehouse_stock" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>STOCK IN [FREE]</label>
                              <input type="text" class="form-control" placeholder="Quantity" name = "stock_free" id="stock_free" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>WAREHOUSE FREE STOCK</label>
                              <input type="text" class="form-control" placeholder="Quantity" name = "free_stock" id="free_stock" required>
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
                                  $category         = $_POST['category'];
                                  $item             = $_POST['item'];
                                  $batch_no         = $_POST['batch_no'];
                                  $size             = $_POST['size'];
                                  $purchase         = $_POST['purchase'];
                                  $sale             = $_POST['sale'];
                                  $warehouse_stock  = $_POST['warehouse_stock'];
                                  $free_stock       = $_POST['free_stock'];

                                $insert1 = "INSERT INTO item (category,item_name,batch_no,size,purchase_cost,sales_cost,warehouse_stock,free_stock) VALUES ('$category','$item','$batch_no','$size',$purchase,$sale,$warehouse_stock,$free_stock )";
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
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                     CATEGORY        </th>
                      <th>                     ITEM            </th>
                      <th>                     BATCH NO        </th>
                      <th>                     SIZE            </th>
                      <th class="text-right">  PURCHASE PRICE  </th>
                      <th class="text-right">  SALE PRICE      </th>
                      <th class="text-right">  WAREHOUSE SALE STOCK  </th>
                      <th class="text-right">  WAREHOUSE FREE STOCK  </th>
                      <th class="text-right">  LORRY SALE  </th>
                      <th class="text-right">  LORRY FREE  </th>
                      <th class="text-center"> EDIT 				   </th>
                      <th class="text-center"> DELETE 			   </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM item");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td>                    <?php echo $row['category'] ?>        </td>
                            <td>                    <?php echo $row['item_name'] ?>       </td>
                            <td>                    <?php echo $row['batch_no'] ?>        </td>
                            <td>                    <?php echo $row['size'] ?>            </td>
                            <td class="text-right"> <?php echo $row['purchase_cost'] ?>   </td>
                            <td class="text-right"> <?php echo $row['sales_cost'] ?>      </td>
                            <td class="text-right"> <?php echo $row['warehouse_stock'] ?> </td>
                            <td class="text-right"> <?php echo $row['free_stock'] ?>      </td>
                            <td class="text-right"> <?php echo $row['lorry_stock'] ?>     </td>
                            <td class="text-right"> <?php echo $row['lorry_free_stock'] ?></td>

                            <td class="text-center">  
                             <a href="#" onclick="editView('<?php echo $row['item_id']; ?>')" name="edit">
                              <h6 style='color:green;'>EDIT</h6></a>
                            </td>

                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['item_id']; ?>')" name="delete">
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
  <!-- <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script> --><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
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

///////////////////////////////////////////////////

$('#stock_in').on('keyup',function(){

  var stock     = $('#stock_in').val();    
  $('#warehouse_stock').val(Number(stock));
  
})

stock_free
$('#stock_free').on('keyup',function(){

  var stock2     = $('#stock_free').val();    
  $('#free_stock').val(Number(stock2));
  
})
///////////////////////////////////////////////////

// Form edit 
function editView(id){

$.ajax({
  url:"edit_item.php",
  method:"POST",
  data:{"id":id},
  success:function(data){
    $('#show_view').html(data);
    $('#Form3').modal('toggle');
  }
});
}
////////////////////  


///////// Form values reset /////////
function form_reset(){
document.getElementById("itemAdd").reset();
}

////////////////////  

// Form delete 
function delete_item(id){

$.ajax({
  url:"delete_item",
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
         delete_item(id)
      } 
  });
}

$(function () {

  $('#itemAdd').on('submit', function (e) {

    e.preventDefault();

    $.ajax({
      type: 'post',
      url: 'item.php',
      data: $('#itemAdd').serialize(),
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

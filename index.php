<?php
include("db_config.php");
//include("card.php");
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
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          PANASONIC
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="index">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>STOCK SHEET</p>
            </a>
          </li>
          <li>
            <a href="category">
              <i class="nc-icon nc-bullet-list-67"></i>
              <p>ITEM CATEGORIES</p>
            </a>
          </li>
          <li>
            <a href="item">
              <i class="nc-icon nc-cart-simple"></i>
              <p>ITEMS</p>
            </a>
          </li>
          <li>
            <a href="report">
              <i class="nc-icon nc-single-copy-04"></i>
              <p>REPORTS</p>
            </a>
          </li>
          <li>
            <a href="user">
              <i class="nc-icon nc-single-02"></i>
              <p>USER PROFILE</p>
            </a>
          </li>         
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('include/nav.php');  ?>
      <!-- End Navbar -->
      <div class="content">
       <div class="row">
          <div class="col-md-12">         
            <div class="card">
              <div class="row">
              <div class="col-md-3">
              <div class="card-header">
                <h2 class="card-title"> Panasonic</h2>
                <!-- <input class="form-control myInput" id="myInput" type="text" placeholder="Search.."> -->                
              </div>
              </div>
              <div class="col-md-5">
                <div class="card-header">
                  <center><h4 class="card-title"> Loading & Daily Sales Report</h4></center>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card-header"> 
                  <input type="date" style="margin-top:11px;" class="form-control" name="create_date" required>
                </div>
              </div>
              <div class="col-md-1">
                <div class="card-header">
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">CREATE</button>
                </div> 
              </div> 
              </div> 

              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Loading & Daily Sales</h5>
                      </div> 
                      <form id="itemAdd">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>ITEM CATEGORY</label>
                                <select class="form-control form-selectBox" id="category" name = "category" required>
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
                              <select class="form-control form-selectBox" id="item" name = "item" required>
                                  <option value="default">--Select Item--</option>
                                  <?php
                                
                                      $get_item = mysqli_query($con,"SELECT item_name FROM item");

                                      $numRows2 = mysqli_num_rows($get_item); 
                       
                                        if($numRows2 > 0) {
                                          while($row2 = mysqli_fetch_assoc($get_item)) {
                                            echo "<option value = ".$row2['item_name'].">" . $row2['item_name'] . "</option>";
                                            
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
                              <label>SIZE</label>
                              <input type="text" class="form-control" placeholder="SIZE" id="size" name = "size" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>LOAD</label>
                              <input type="text" class="form-control" placeholder="Laod" name = "load" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>BF BAL</label>
                              <input type="text" class="form-control" placeholder="BF BAL" name = "bf_bal" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>TOT</label>
                              <input type="text" class="form-control" placeholder="TOT" name = "tot" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>1</label>
                              <input type="text" class="form-control" placeholder="" name = "1">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>2</label>
                              <input type="text" class="form-control" placeholder="" name = "2">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>3</label>
                              <input type="text" class="form-control" placeholder="" name = "3">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>4</label>
                              <input type="text" class="form-control" placeholder="" name = "4">
                            </div>
                          </div>
                          
                        </div>

                        <div class="row">
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>5</label>
                              <input type="text" class="form-control" placeholder="" name = "5">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>6</label>
                              <input type="text" class="form-control" placeholder="" name = "6">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>7</label>
                              <input type="text" class="form-control" placeholder="" name = "7">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>8</label>
                              <input type="text" class="form-control" placeholder="" name = "8">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>9</label>
                              <input type="text" class="form-control" placeholder="" name = "9">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>10</label>
                              <input type="text" class="form-control" placeholder="" name = "10">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>11</label>
                              <input type="text" class="form-control" placeholder="" name = "11">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>12</label>
                              <input type="text" class="form-control" placeholder="" name = "12">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>13</label>
                              <input type="text" class="form-control" placeholder="" name = "13">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>14</label>
                              <input type="text" class="form-control" placeholder="" name = "14">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>15</label>
                              <input type="text" class="form-control" placeholder="" name = "15">
                            </div>
                          </div>
                          <div class="col-md-3 pr-1">
                            <div class="form-group">
                              <label>16</label>
                              <input type="text" class="form-control" placeholder="" name = "16">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>SALE</label>
                              <input type="text" class="form-control" placeholder="Sale" name = "sale" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>FREE</label>
                              <input type="text" class="form-control" placeholder="Free" name = "free" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>BAL</label>
                              <input type="text" class="form-control" placeholder="Bal" name = "bal" required>
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
                                  $item             = $_POST['item'];
                                  $batch_no         = $_POST['batch_no'];
                                  $size             = $_POST['size'];
                                  $purchase         = $_POST['purchase'];
                                  $sale             = $_POST['sale'];
                                  $warehouse_stock  = $_POST['warehouse_stock'];
                                  $lorry_stock      = $_POST['lorry_stock'];

                                $insert1 = "INSERT INTO item (category,item_name,batch_no,size,purchase_cost,sales_cost,warehouse_stock,lorry_stock) VALUES ('$category','$item','$batch_no','$size',$purchase,$sale,$warehouse_stock,$lorry_stock)";
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
                      <th class="text-right">  WAREHOUSE QTY   </th>
                      <th class="text-right">  LORRY QTY       </th>
                      <th class="text-center"> EDIT            </th>
                      <th class="text-center"> DELETE          </th>
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
                            <td class="text-right"> <?php echo $row['lorry_stock'] ?>     </td>

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
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div>
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

    ////////////////////Fetch Items according to the category////////////////////////////
    $('#item').on('change', function() {

      $.ajax({
        url: 'get_size.php',
        method:"POST",
        data:{type:this.value},
        success: function (response) {
          var obj = JSON.parse(response);
          $('#size').val(obj.size);
        }
      });
    });
    ///////////////////////////////////////////////////////////////////////////////////////

  </script>

</body>

</html>


<?php
mysqli_close($con);
}
?>

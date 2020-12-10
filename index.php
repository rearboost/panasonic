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
                <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1" id="create" onclick="date_func()">CREATE</button>
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
                      <form id="trxnAdd">
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
                              <input type="text" class="form-control" placeholder="Size" id="size" name = "size" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>LOAD</label>
                              <input type="text" class="form-control" placeholder="Load" name = "load" required>
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
                                  $category  = $_POST['category'];
                                  $item      = $_POST['item'];
                                  $size      = $_POST['size'];
                                  $load      = $_POST['load'];
                                  $bf_bal    = $_POST['bf_bal'];
                                  $tot       = $_POST['tot'];
                                  $shop1     = $_POST['1'];
                                  $shop2     = $_POST['2'];
                                  $shop3     = $_POST['3'];
                                  $shop4     = $_POST['4'];
                                  $shop5     = $_POST['5'];
                                  $shop6     = $_POST['6'];
                                  $shop7     = $_POST['7'];
                                  $shop8     = $_POST['8'];
                                  $shop9     = $_POST['9'];
                                  $shop10    = $_POST['10'];
                                  $shop11    = $_POST['11'];
                                  $shop12    = $_POST['12'];
                                  $shop13    = $_POST['13'];
                                  $shop14    = $_POST['14'];
                                  $shop15    = $_POST['15'];
                                  $shop16    = $_POST['16'];
                                  $sale      = $_POST['sale'];
                                  $free      = $_POST['free'];
                                  $bal       = $_POST['bal'];
                                  $create_date  = $_POST['create_date'];

                                $insert1 = "INSERT INTO trxn (category,item,size,load_bal,bf_bal,total,S1,S2,S3,S4,S5,S6,S7,S8,S9,S10,S11,S12,S13,S14,S15,S16,sale,free,af_bal,create_date) VALUES ('$category','$item','$size',$load,$bf_bal,$tot,'$shop1','$shop2','$shop3','$shop4','$shop5','$shop6','$shop7','$shop8','$shop9','$shop10','$shop11','$shop12','$shop13','$shop14','$shop15','$shop16',$sale,$free,$bal,'create_date')";
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
                      <th>                     CATEGORY    </th>
                      <th>                     ITEM        </th>
                      <th>                     SIZE        </th>
                      <th>                     LOAD        </th>
                      <th>                     BF BAL      </th>
                      <th>                     TOT         </th>
                      <th>                     1           </th>
                      <th>                     2           </th>
                      <th>                     3           </th>
                      <th>                     4           </th>
                      <th>                     5           </th>
                      <th>                     6           </th>
                      <th>                     7           </th>
                      <th>                     8           </th>
                      <th>                     9           </th>
                      <th>                     10          </th>
                      <th>                     11          </th>
                      <th>                     12          </th>
                      <th>                     13          </th>
                      <th>                     14          </th>
                      <th>                     15          </th>
                      <th>                     16          </th>
                      <th>                     SALE        </th>
                      <th>                     FREE        </th>
                      <th>                     AF BAL      </th>
                      <th>                     CREATE DATE </th>
                      <th class="text-center"> EDIT        </th>
                      <th class="text-center"> DELETE      </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM trxn");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td> <?php echo $row['category'] ?>     </td>
                            <td> <?php echo $row['item'] ?>         </td>
                            <td> <?php echo $row['size'] ?>         </td>
                            <td> <?php echo $row['load_bal'] ?>     </td>
                            <td> <?php echo $row['bf_bal'] ?>       </td>
                            <td> <?php echo $row['total'] ?>        </td>
                            <td> <?php echo $row['S1'] ?>           </td>
                            <td> <?php echo $row['S2'] ?>           </td>
                            <td> <?php echo $row['S3'] ?>           </td>
                            <td> <?php echo $row['S4'] ?>           </td>
                            <td> <?php echo $row['S5'] ?>           </td>
                            <td> <?php echo $row['S6'] ?>           </td>
                            <td> <?php echo $row['S7'] ?>           </td>
                            <td> <?php echo $row['S8'] ?>           </td>
                            <td> <?php echo $row['S9'] ?>           </td>
                            <td> <?php echo $row['S10'] ?>          </td>
                            <td> <?php echo $row['S11'] ?>          </td>
                            <td> <?php echo $row['S12'] ?>          </td>
                            <td> <?php echo $row['S13'] ?>          </td>
                            <td> <?php echo $row['S14'] ?>          </td>
                            <td> <?php echo $row['S15'] ?>          </td>
                            <td> <?php echo $row['S16'] ?>          </td>
                            <td> <?php echo $row['sale'] ?>         </td>
                            <td> <?php echo $row['free'] ?>         </td>
                            <td> <?php echo $row['af_bal'] ?>       </td>
                            <td> <?php echo $row['create_date'] ?>  </td>

                            <td class="text-center">  
                             <a href="#" onclick="editView('<?php echo $row['trxn_id']; ?>')" name="edit">
                              <h6 style='color:green;'>EDIT</h6></a>
                            </td>

                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['trxn_id']; ?>')" name="delete">
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
        data:{id:this.value},
        success: function (response) {

          var obj = JSON.parse(response);
          $('#size').val(obj.size);

        }
      });
  });

  ///////////////////////////////////////////////////////////////////////////////////////

  function date_func(){
  }

  ///////////////////////////////////////////////////////////////////////////////////////


  $(function () {

    $('#trxnAdd').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'index.php',
        data: $('#trxnAdd').serialize(),
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

  function form_reset(){
      document.getElementById("trxnAdd").reset();
  }

  ///////////////////////////////////////////////////////////////////////

  function editView(id){

      $.ajax({
              url:"edit_trxn.php",
              method:"POST",
              data:{"id":id},
              success:function(data){
                $('#show_view').html(data);
                $('#Form2').modal('show');
              }
        });
  }
  ///////////////////////////////////////////////////////////////////////

  function delete_loan(id){

      $.ajax({
              url:"delete_trxn",
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

    /////////////////////////////
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
               delete_trxn(id)
            } 
        });
    }
    ///////////////////////////////////////////////////////////////////////

  </script>

</body>

</html>


<?php
}
?>
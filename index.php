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
              <div class="col-md-4">
              <div class="card-header">
                <h2 class="card-title"> Panasonic </h2>
                <!-- <input class="form-control myInput" id="myInput" type="text" placeholder="Search.."> -->                
              </div>
              </div>
              <div class="col-md-8">
                <div class="card-header">
                  <h4 class="card-title"> Loading Items</h4>
                </div>
              </div>
              </div>
              <!--  -->
 
              <div class="card-body">
                <form action="trxn_insert.php" method="post" id="trxn_add">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-3 pl-1">
                        <div class="form-group"> 
                        <input type="date" style="margin-top:11px;" class="form-control" id="create_date" name="create_date" required>
                        </div>
                      </div>

                      <div class="col-md-2">
                      <input type="hidden" name ="submit" value="create"/>
                      <button type="submit" class="btn btn-primary add-btn" name="submit" id="create" disabled>CREATE</button>
                      </div>
                      <div class="7"></div> 
                    </div> 
                  </div>
                </form> 

                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                     CATEGORY    </th>
                      <th>                     ITEM        </th>
                      <th>                     SIZE        </th>
                      <th>                     BF BAL      </th>
                      <th>                     LOAD      </th>
                      <th>                     TOTAL      </th>
                      <th>                     CREATE DATE </th>
                      <th class="text-center"> EDIT        </th>
                      <th class="text-center"> DELETE      </th>
                    </thead>
                    <tbody>
                      <?php
                      
                      $get_date=mysqli_query($con,"SELECT create_date FROM trxn ORDER BY create_date DESC LIMIT 1");
                      if(mysqli_num_rows($get_date)> 0){
                        $get = mysqli_fetch_assoc($get_date);
                        $cur_date      = $get['create_date'];
                      }

                      $sql=mysqli_query($con,"SELECT * FROM trxn WHERE create_date= '$cur_date'");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {

                          ?>
                          <tr>
                            <td> <?php echo $row['category'] ?>     </td>
                            <td> <?php echo $row['item'] ?>         </td>
                            <td> <?php echo $row['size'] ?>         </td>
                            <td> <?php echo $row['bf_bal'] ?>       </td>
                            <td> <?php echo $row['load_bal'] ?>       </td>
                            <td> <?php echo $row['total'] ?>       </td>
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

  ////////////////////Create button enabled////////////////////////////
  $('#create_date').on('change', function() {
        $('#create').prop('disabled', false);
  });

  //////////////////////////////////////////////////////////////////////////////////////

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

  function delete_trxn(id){

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

   ///////////////////////////////////////////////////

    $(function () {

        $('#trxn_add').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'trxn_insert.php',
            data: $('#trxn_add').serialize(),
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
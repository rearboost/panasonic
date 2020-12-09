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
          <li>
            <a href="index">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>STOCK SHEET</p>
            </a>
          </li>
          <li class="active">
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
              <div class="col-md-9">
              <div class="card-header">
                <h4 class="card-title"> ITEM CATEGORIES</h4>    
                <input class="form-control myInput" id="myInput" type="text" placeholder="Search..">                
              </div>
              </div>
              <div class="col-md-3">
                <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Add New Category..
                    </button> 
                </div>
              </div>
              </div>
              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Category</h5>
                      </div> 
                      <form id="categoryAdd">
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-7 pr-1">
                            <div class="form-group">
                              <label>CATEGORY NAME</label>
                              <input type="text" class="form-control" placeholder="Category" name = "category" required>
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
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                     CATEGORY ID    </th>
                      <th>                     CATEGORY NAME  </th>
                      <th class="text-center"> Edit 				  </th>
                      <th class="text-center"> Delete 			  </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM category");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {
                          ?>
                          <tr>
                            <td>                      <?php echo $row['category_id'] ?>        </td>
                            <td>                      <?php echo $row['category_name'] ?>      </td>
                            <td class="text-center">  
                             <a href="#" onclick="editView('<?php echo $row['category_id']; ?>')" name="edit">
                              <h6 style='color:green;'>EDIT</h6> </a>
                            </td>
                            
                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['category_id']; ?>')" name="delete">
                              <h6 style='color:red;'>DELETE</h6> </a>
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
              url:"edit_category.php",
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
      document.getElementById("categoryAdd").reset();
    }

    ////////////////////  

    // Form delete 
    function delete_category(id){

      $.ajax({
              url:"delete_category",
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
               delete_category(id)
            } 
        });
    }
    ////////////////////  


    ///////////////////////////////////////////////////

    $(function () {

        $('#categoryAdd').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'category.php',
            data: $('#categoryAdd').serialize(),
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

<?php

   include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM category WHERE category_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $category_id1   = $_POST['category_id1'];
        $category_name2 = $_POST['category_name1'];
      
        $edit = mysqli_query($con,"UPDATE category 
                                          SET category_name  ='$category_name2'
                                          WHERE category_id=$category_id1");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:category.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>

<div class="card-body">
  <div class="modal fade" id="Form3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE CATEGORY</h5>
        </div> 

        <form  id="categoryEdit" >
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <input type="hidden" class="form-control" name ="category_id1" value="<?php echo $data['category_id']?>" readonly>
                </div>
              </div>
            </div>
            <div class="row">      
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <label>CATEGORY</label>
                    <input type="text" class="form-control" name ="category_name1" value="<?php echo $data['category_name']?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="update ml-auto mr-auto">
                <input type="hidden" name ="update" value="update"/>
                <button type="submit" name="update" class="btn btn-primary btn-round">Update</button>
                <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>

   ///////////////////////////////////////////////////

    $(function () {

        $('#categoryEdit').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'edit_category.php',
            data: $('#categoryEdit').serialize(),
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
    ///////////////////////////////////////////////////


</script>
<?php

   include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    if(isset($_POST['update'])) // when click on Update button
    {
        $cid   = $_POST['cid'];
        $exDate = $_POST['exDate'];
      
        $edit = mysqli_query($con,"UPDATE cheques 
                                          SET ex_date  ='$exDate'
                                          WHERE id=$cid");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            //header("location:debt.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>
<div class="modal fade" id="DateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cheque Exchange</h5>
      </div> 
      <form id="ExDateAdd">
        <div class="col-md-12">
        <div class="row">
          <div class="col-md-7 pr-1">
            <div class="form-group">
              <label>Cheque Exchange Date</label>
              <input type="hidden" class="form-control" id="cid" name="cid" value="<?php echo $id;?>"required>
              <input type="Date" class="form-control" name="exDate" id="exDate" required>
            </div>
          </div>
          </div>
            
          <div class="row">
            <div class="update ml-auto mr-auto">
              <input type="hidden" name ="update" value="update"/>
              <button type="submit" name="update" class="btn btn-primary btn-round">OK</button>
              <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

   ///////////////////////////////////////////////////

    $(function () {

        $('#ExDateAdd').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'edit_date.php',
            data: $('#ExDateAdd').serialize(),
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
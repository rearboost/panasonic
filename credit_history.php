<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<div class="card-body">
  <div class="modal fade" id="get_data_credit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">CREDIT HISTORY</h5>
        </div> 

          <table class="table" style="padding-left: 25px; padding-right: 25px;">
            <thead class="text-primary">
              <th>                    DATE    </th>
              <th class="text-right"> BILL NO </th>
              <th class="text-right"> AMOUNT  </th>
            </thead>
            <tbody>

          <?php

            $shop = $_POST['shop'];

            $query = mysqli_query($con,"SELECT b_date,bill_no,credit FROM bill WHERE shop='$shop' ");
                
            $numRows = mysqli_num_rows($query);

              if($numRows > 0) {
                while($row1 = mysqli_fetch_assoc($query)) {
        ?>
              <tr>
                <td>                    <?php echo $row1['b_date'] ?>   </td>
                <td class="text-right"> <?php echo $row1['bill_no'] ?>  </td>
                <td class="text-right"> <?php echo $row1['credit'] ?>  </td>
              </tr>
            </tbody>
        <?php
                }
              }
        ?> 
          
          </table> 
          <form>
            <center>
            <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
            </center>
          </form>
      </div>
    </div>
  </div>
</div>
<?php
mysqli_close($con);


 ?>

<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<div class="card-body">
  <div class="modal fade" id="get_data2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">PAYMENT HISTORY</h5>
        </div> 

          <table class="table" style="padding-left: 25px; padding-right: 25px;">
            <thead class="text-primary">
              <th>                    DATE   </th>
              <th class="text-right"> PAID   </th>
              <th class="text-right"> REMAIN </th>
            </thead>
            <tbody>

          <?php

            $invoice_no = $_POST['id'];

            $query = mysqli_query($con,"SELECT cdate,amount,remain FROM credit WHERE type='payment' AND invoice_no ='$invoice_no' ");
                
            $numRows = mysqli_num_rows($query);

              if($numRows > 0) {
                while($row1 = mysqli_fetch_assoc($query)) {
        ?>
              <tr>
                <td>                    <?php echo $row1['cdate'] ?>   </td>
                <td class="text-right"> <?php echo $row1['amount'] ?>  </td>
                <td class="text-right"> <?php echo $row1['remain'] ?>  </td>
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

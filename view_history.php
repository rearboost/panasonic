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
          <h5 class="modal-title" id="staticBackdropLabel">CUSTOMER HISTORY</h5>
        </div> 

          <table class="table" id="" >
            <thead class="text-primary">
              <th>                    DATE             </th>
              <th class="text-right"> INSTALLEMENT AMT </th>
              <th class="text-right"> INTEREST AMT     </th>
              <th class="text-right"> REMAINING AMT    </th>
            </thead>
            <tbody>

          <?php

            $loan_no = $_POST['id'];

            $query = mysqli_query($con,"SELECT  I.li_date as li_date, I.installement_amt as installement, I.interest_amt as interest, I.remaining_amt as remaining
              FROM loan L
              INNER JOIN loan_installement I
                ON L.loan_no = I.loan_no
              WHERE L.loan_no = '$loan_no' ");
                
            $numRows = mysqli_num_rows($query);

              if($numRows > 0) {
                while($row1 = mysqli_fetch_assoc($query)) {
        ?>
              <tr>
                <td>                    <?php echo $row1['li_date'] ?>       </td>
                <td class="text-right"> <?php echo $row1['installement'] ?>  </td>
                <td class="text-right"> <?php echo $row1['interest'] ?>      </td>
                <td class="text-right"> <?php echo $row1['remaining'] ?>     </td>
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

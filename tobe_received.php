<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
  <table class="table" id="get_data1">
    <thead class="text-primary">
      <th>                    SHOP       </th>
      <th class="text-right"> CREDIT     </th>
      <th class="text-right"> RECEIVED   </th>
      <th class="text-right"> AMOUNT     </th>
    </thead>
    <tbody>

  <?php

  // need to get to be received (total credits+total cheques) from bill table - total received (total amount) from debt table according to each shop
  
    $query = mysqli_query($con,"SELECT bill.shop AS shop, SUM(bill.credit+bill.cheque)AS total_credit, A.total_amt FROM bill LEFT JOIN (SELECT SUM(debt.amt) AS total_amt, shop FROM debt GROUP BY debt.shop) A ON bill.shop=A.shop GROUP BY bill.shop HAVING total_credit>0");

    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {

          $credit = $row['total_credit'];
          $paid   = $row['total_amt'];
          $due    = $credit - $paid;
?>
     
      <tr>
        <td>                     <?php echo $row['shop'] ?>    </td>
        <td class="text-right">  <?php echo $row['total_credit'] ?>    </td>
        <td class="text-right">  <?php echo $row['total_amt'] ?>    </td>
        <td class="text-right">  <?php echo number_format($due,2); ?> </td> 
        <td class="text-center">      
         <a href="#" onclick="View('<?php echo $row['shop']; ?>')" name="view"> Credit History </a>
        </td>
      </tr>

      <div id = "show_view"></div>
      

    </tbody>

<?php
        }
      }
?> 
  
  </table>
  <?php
  mysqli_close($con);


 ?>
<script>
// VIEW HISTORY
function View(shop){

  $.ajax({
          url:"credit_history.php",
          method:"POST",
          data:{"shop":shop},

          success:function(data){
            $('#show_view').html(data);
            $('#get_data_credit').modal('show');
          }
    });
}
////////////////////  
</script>
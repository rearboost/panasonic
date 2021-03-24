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
      <th class="text-right"> DEBT     </th>
      <th class="text-right"> RECEIVED   </th>
      <th class="text-right"> REMAIN     </th>
    </thead>
    <tbody>

  <?php

  // need to get to be received (total credits from bill+total amount from cheques) - total received (total amount) according to each shop
  
    // $query = mysqli_query($con,"SELECT bill.shop AS shop, SUM(bill.credit+bill.cheque)AS total_credit, A.total_amt FROM bill LEFT JOIN (SELECT SUM(debt.amt) AS total_amt, shop FROM debt GROUP BY debt.shop) A ON bill.shop=A.shop GROUP BY bill.shop HAVING total_credit>0");

    $query = mysqli_query($con,"SELECT * FROM debt_summary GROUP BY shop HAVING debt>0 OR received>0");

    $numRows = mysqli_num_rows($query);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query)) {

          $credit = $row['debt'];
          $paid   = $row['received'];
          $due    = $credit - $paid;
?>
     
      <tr>
        <td>                     <?php echo $row['shop'] ?>           </td>
        <td class="text-right">  <?php echo $row['debt'] ?>   </td>
        <td class="text-right">  <?php echo $row['received'] ?>      </td>
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
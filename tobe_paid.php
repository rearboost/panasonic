<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>

  <?php

    $text1 = mysqli_query($con,"SELECT SUM(amount) AS tot_invoice FROM credit WHERE type='invoice'");
       
    $row1 = mysqli_fetch_assoc($text1);
    $value1 = $row1['tot_invoice'];

    $text2 = mysqli_query($con,"SELECT SUM(amount) AS tot_payment FROM credit WHERE type='payment'");
       
    $row2 = mysqli_fetch_assoc($text2);
    $value2 = $row2['tot_payment'];

    $value3 = $value1 - $value2;
?>
     <center><h4 style="margin-top: 0px;">You have to be paid <br> <font color="red">LKR. <?php echo number_format($value3,2);?></font></h4></center> <br>

<table class="table" id="tobe_paidTB">
  <thead class="text-primary">
    <th>                    INVOICE </th>
    <th>                    DATE    </th>
    <th class="text-right"> AMOUNT  </th>
    <th class="text-right"> </th>
  </thead>
  <tbody>

  <?php


    $query1 = mysqli_query($con,"SELECT invoice_no,cdate,amount FROM credit WHERE type='invoice' AND credit_status='1'");
       
    $numRows = mysqli_num_rows($query1);

      if($numRows > 0) {
        while($row = mysqli_fetch_assoc($query1)) {
?>
     
      <tr>
        <td>                    <?php echo $row['invoice_no']?>  </td>
        <td>                    <?php echo $row['cdate'] ?>      </td>
        <td class="text-right"> <?php echo $row['amount'] ?>     </td>
        <td class="text-center">      
         <a href="#" onclick="View('<?php echo $row['invoice_no']; ?>')" name="view"> History </a>
        </td>
      </tr>
      <div id = "show_view">
        
      </div>

    </tbody>

<?php
        }
      }
?> 
  
  </table>
<?php
mysqli_close($con);

//}

?>
<script>

 ////////////////////////////  DataTable ////////////////////////////
 $(document).ready( function () {
    $('#tobe_paidTB').DataTable();
 });

// VIEW HISTORY
function View(id){

  $.ajax({
          url:"view.php",
          method:"POST",
          data:{"id":id},
          success:function(data){
            $('#show_view').html(data);
            $('#get_data2').modal('show');
          }
    });
}
////////////////////  
</script>
<?php
error_reporting(0);
include("db_config.php");
$con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
  if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
  }

 $get_year = $_POST['year'];
 if(isset($get_year)){
?>
    <table class="table" id="paidTB">
    <thead class="text-primary">
      <th>                    MONTH, YEAR   </th>
      <th class="text-right"> AMOUNT  </th>
    </thead>

    <?php
    $query = mysqli_query($con,"SELECT month,year,SUM(amount) AS tot_amt FROM credit WHERE type='payment' AND year='$get_year' GROUP BY month,year");
      $numRows = mysqli_num_rows($query);

        if($numRows > 0) {
          while($row = mysqli_fetch_assoc($query)) {
    ?>

     <tbody>
      <tr>
      <td>                    <?php echo $row['month'] . ',' . $row['year'] ?></td>
      <td class="text-right"> <?php echo $row['tot_amt'] ?>      </td>
      <td class="text-center">      
         <a href="#" onclick="View('<?php echo $row['month'];?>' + ',' + '<?php echo $row['year'];?>')" name="view"> History </a>
      </td>
      </tr>

      <div id = "show_view">
        
      </div>

    </tbody>
    

<?php
        }
      }
      }
?> 
  
  </table>
<script>

// VIEW HISTORY
function View(id1){

  $.ajax({
          url:"view_paid.php",
          method:"POST",
          data:{id1:id1},
          success:function(data){
            $('#show_view').html(data);
            $('#get_data3').modal('show');
          }
    });
}
////////////////////  
</script>


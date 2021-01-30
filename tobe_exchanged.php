<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>
<table class="table" id="get_data1">
  <thead class="text-primary">
    <th>                    VALID DATE  </th>
    <th>                    CHEQUE NO   </th>
    <th class="text-right"> AMOUNT      </th>
  </thead>
  <tbody>

<?php

  $query = mysqli_query($con,"SELECT B_id,cheque, cheque_no, cheque_date FROM bill WHERE cheque_status=1");
     
  $numRows = mysqli_num_rows($query);

    if($numRows > 0) {
      while($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
      <td>                    <?php echo $row['cheque_date'] ?> </td>
      <td>                    <?php echo $row['cheque_no'] ?>   </td>
      <td class="text-right"> <?php echo $row['cheque'] ?>      </td>
      <td class="text-center">  
      <a href="#" onclick="doneFUN(<?php echo $row['B_id']; ?>)" name="done">
      <button class="btn btn-success btn-round">Done</button></a>
      </td>
    </tr>

  </tbody>
<?php
      }
    }
?> 
</table>
<?php

  if(isset($_POST['id'])){

      $id=$_POST['id']; 
      $qry = mysqli_query($con,"SELECT shop,cheque FROM bill WHERE B_id='$id' "); // select query

      $data = mysqli_fetch_array($qry); // fetch data
      $shop = $data['shop'];
      $amt = $data['cheque'];
      $ddate= date("Y-m-d");

      $date = explode('-', $ddate);

      $year  = $date[0];
      $month = $date[1];

      $add = mysqli_query($con,"INSERT INTO debt (shop,ddate,month,year,amt)VALUES('$shop','$ddate',$month,$year,$amt)");
      $state = mysqli_query($con,"UPDATE bill SET cheque_status=0 WHERE B_id =  '$id'");
  }

?>


<?php
  mysqli_close($con);
 ?>

<script>

function doneFUN(id){

  // alert(id)
  $.ajax({
    url:"tobe_exchanged.php",
    method:"POST",
    data:{"id":id},
    success:function(data){
      swal({
        title: "Good job !",
        text: "Successfully Updated the Status",
        icon: "success",
        button: "Ok !",
        });
        setTimeout(function(){ location.reload(); }, 2500);
    }
  });
}
////////////////////  
</script>
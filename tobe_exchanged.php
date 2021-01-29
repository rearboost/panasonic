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
    <th>                    VALID DATE  </th>
    <th>                    CHEQUE NO   </th>
    <th class="text-right"> AMOUNT      </th>
  </thead>
  <tbody>

<?php

// if(isset($_POST['btn3'])){

  $query = mysqli_query($con,"SELECT B_id, cheque, cheque_no, cheque_date FROM bill WHERE cheque_status=1 ");
     
  $numRows = mysqli_num_rows($query);

    if($numRows > 0) {
      while($row = mysqli_fetch_assoc($query)) {
?>
    <tr>
      <td>                    <?php echo $row['cheque_date'] ?> </td>
      <td>                    <?php echo $row['cheque_no'] ?>   </td>
      <td class="text-right"> <?php echo $row['cheque'] ?>      </td>
      <td class="text-center">  
      <a href="#" onclick="doneFUN('<?php echo $row['B_id']; ?>')" name="done">
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

$id=$_POST['id']; 

$qry = mysqli_query($con,"SELECT cheque FROM bill WHERE B_id='$id' "); // select query

  $data = mysqli_fetch_array($qry); // fetch data
    $amt = $data['cheque'];
    $ddate= cur_date('Y-m-d');

if(isset($_POST['done'])){

  $add = mysqli_query($con,"INSERT INTO debt (ddate,amt)VALUES('$ddate',$amt)");
  $state = mysqli_query($con,"UPDATE bill SET cheque_status=0 WHERE B_id =  '$id'");

}
?>


  <?php
  mysqli_close($con);

  // }

 ?>
<script>
function doneFUN(id){
alert(id)
  $.ajax({
    url:"tobe_exchanged.php",
    method:"POST",
    data:{"id":id},
    success:function(data){
      swal({
        title: "Good job !",
        text: data,
        icon: "success",
        button: "Ok !",
        });
        setTimeout(function(){ location.reload(); }, 2500);
    }
  });
}
////////////////////  
</script>
<?php
  error_reporting(0);
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
?>

  <?php
   //if(isset($_POST['dbtn2'])){

    $query = mysqli_query($con,"SELECT remain FROM credit ORDER BY c_id DESC LIMIT 1");
       
    $row = mysqli_fetch_assoc($query);
    $value = $row['remain'];
?>
     
    <center><h3>LKR. <?php echo number_format($value,2);?></h3></center>

<?php
mysqli_close($con);

//}

?>
<script>
 
</script>
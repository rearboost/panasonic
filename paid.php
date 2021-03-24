<?php
  include("db_config.php");
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

?>    

<form>
  <div class="row" style="margin-bottom: 20px;">
  <div class="col-md-3">
    <label>SELECT YEAR</label>
    <select class="form-control form-selectbox" id="year" name="year">
      <option value="">Year</option>
      <?php
                                  
      $get_year = mysqli_query($con,"SELECT DISTINCT(year) AS year FROM credit WHERE type='payment'");

      $numRows1 = mysqli_num_rows($get_year); 

        if($numRows1 > 0) {
          while($row1 = mysqli_fetch_assoc($get_year)) {
            echo '<option value = "'.$row1["year"].'"> '. $row1['year'] .' </option>';
            
          }
        }
      ?>
    </select>
  </div>
  </div>
</form>

<div id="get_data_table"></div>
  
  <?php
  mysqli_close($con);
 ?>

<script>

 $('#year').on('change', function() {

    var year = $('#year').val();

    $.ajax({
        url:"paid_table.php",
        method:"POST",
        data:{"year":year},
        success:function(data){
            $('#get_data_table').html(data);
      }
    });
  });
</script>
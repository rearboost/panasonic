<?php

   include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM item WHERE item_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $item_id1          = $_POST['item_id1'];
        $category1         = $_POST['category1'];
        $item1             = $_POST['item1'];
        $batch_no1         = $_POST['batch_no1'];
        $size1             = $_POST['size1'];
        $purchase1         = $_POST['purchase1'];
        $sale1             = $_POST['sale1'];
        $warehouse_stock1  = $_POST['warehouse_stock1'];
        $lorry_stock1      = $_POST['lorry_stock1'];
      
        $edit = mysqli_query($con,"UPDATE item 
                                          SET category        ='$category1',
                                              item_name       ='$item1',
                                              batch_no        ='$batch_no1',
                                              size            ='$size1',
                                              purchase_cost   ='$purchase1',
                                              sales_cost      ='$sale1',
                                              warehouse_stock ='$warehouse_stock1',
                                              lorry_stock     ='$lorry_stock1'
                                          WHERE item_id=$item_id1");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:item.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>

<div class="card-body">
 <style>
 input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type="number"] {
  -moz-appearance: textfield;
}

 
 </style>
  <div class="modal fade" id="Form3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE ITEM</h5>
        </div> 

        <form  id="itemEdit" >
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <input type="hidden" id="getId"  value="<?php echo $data['item_id'] ?>" required>

                  <label>ITEM CATEGORY</label>
                    <select class="form-control form-selectBox" name = "category1" required>
                      <option><?php echo $data['category']?></option>
                      <?php
                    
                          $get_category = mysqli_query($con,"SELECT * FROM category");

                          $numRows1 = mysqli_num_rows($get_category); 
           
                            if($numRows1 > 0) {
                              while($row1 = mysqli_fetch_assoc($get_category)) {
                                echo "<option value = ".$row1['category_name'].">" . $row1['category_name'] . "</option>";
                                
                              }
                            }
                      ?>
                      
                    </select>
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>ITEM</label>
                  <input type="text" class="form-control" placeholder="Item" name = "item1" value="<?php echo $data['item_name'] ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>BATCH NO</label>
                  <input type="text" class="form-control" placeholder="Batch No" name = "batch_no1" value="<?php echo $data['batch_no'] ?>" required>
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>SIZE</label>
                  <input type="text" class="form-control" placeholder="Size" name = "size1" value="<?php echo $data['size'] ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>PURCHASE COST</label>
                  <input type="text" class="form-control" placeholder="LKR" name = "purchase1" value="<?php echo $data['purchase_cost'] ?>" required>
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>SALE COST</label>
                  <input type="text" class="form-control" placeholder="LKR" name = "sale1" value="<?php echo $data['sales_cost'] ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>STOCK IN</label>
                  <input type="Number" class="form-control" placeholder="Quantity (Number)" name = "stock_in1" id="stock_in1" required>
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>WAREHOUSE STOCK</label>
                  <input type="text" class="form-control" value="<?php echo $data['warehouse_stock'] ?>" name = "warehouse_stock1" id="warehouse_stock1" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>LORRY STOCK</label>
                  <input type="text" class="form-control" placeholder="Quantity" name = "lorry_stock1" value="<?php echo $data['lorry_stock'] ?>" readonly required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="update ml-auto mr-auto">
                <input type="hidden" name ="update" value="update"/>
                <button type="submit" name="update" class="btn btn-primary btn-round">Update</button>
                <button type="reset" name="close" class="btn btn-danger btn-round" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
////////////////////New Warehouse stock////////////////////////////// 

$('#stock_in1').on('keyup',function(){

  var stock     = $('#stock_in1').val();

  var item_id1 = document.getElementById('getId').value;

  $.ajax({
    url: 'get_qty.php',
    method:"POST",
    data:{id:item_id1},
    success: function (response) {

      var obj = JSON.parse(response);

      var warehouse_stock      =  obj.warehouse_stock
      // new warehouse stock = previous warehouse stock + stock in
      var warehouse_stock  = Number(warehouse_stock ) + Number(stock);
        
       $('#warehouse_stock1').val(Number(warehouse_stock));

    }
  });

})
///////////////////////////////////////////////////

$(function () {

    $('#itemEdit').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'edit_item.php',
        data: $('#itemEdit').serialize(),
        success: function () {
          swal({
            title: "Good job !",
            text: "Successfully Submited",
            icon: "success",
            button: "Ok !",
            });
            setTimeout(function(){ location.reload(); }, 2500);
           }
      });

    });

  });
///////////////////////////////////////////////////


</script>
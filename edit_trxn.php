<?php
  error_reporting(0);
   include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM trxn T INNER JOIN item I ON I.item_name=T.item  WHERE T.trxn_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $trxn_id        = $_POST['trxn_id1'];
        $category       = $_POST['category1'];
        $item           = $_POST['item1'];
        $size           = $_POST['size1'];
        $load           = $_POST['load1'];
        $warehouse_now  = $_POST['warehouse_now'];
        $bf_bal         = $_POST['bf_bal1'];
        $tot            = $_POST['tot1'];
      
        $edit = mysqli_query($con,"UPDATE trxn 
                                      SET category  ='$category',
                                          item      ='$item',
                                          size      ='$size',
                                          load_bal  ='$load',
                                          bf_bal    ='$bf_bal',
                                          total     ='$tot'
                                          WHERE trxn_id =$trxn_id");

         $update_stock1 = mysqli_query($con,"UPDATE item SET lorry_stock = '$tot',warehouse_stock='$warehouse_now' WHERE item_name='$item'");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:index.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>

<div class="card-body">
  <div class="modal fade" id="Form2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE LOAD</h5>
        </div> 

        <form  id="trxnEdit">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group">
                  <input type="hidden" class="form-control" name ="trxn_id1" value="<?php echo $data['trxn_id']?>" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>ITEM CATEGORY</label>
                    <input class="form-control" id="category1" name="category1" value="<?php echo $data['category']?>" readonly>
                </div>
              </div>

              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>ITEM</label>
                  <input class="form-control" id="item1" name = "item1" value="<?php echo $data['item']?>" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>SIZE</label>
                  <input type="text" class="form-control" id="size1" name = "size1" value="<?php echo $data['size']?>" readonly>
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>LOAD</label>
                  <input type="text" class="form-control stock_out" id="load1" name = "load1" value="<?php echo $data['load_bal']?>" >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <input type="hidden" class="form-control stock_out" id="warehouse1" name = "warehouse1" value="<?php  echo $data['warehouse_stock']?>" >
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <input type="hidden" class="form-control stock_out" id="warehouse_now" name = "warehouse_now" >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>BF BAL</label>
                  <input type="text" class="form-control stock_out" id="bf_bal1" name = "bf_bal1" value="<?php echo $data['bf_bal']?>" >
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>TOT</label>
                  <input type="text" class="form-control stock_out" id="tot1" name = "tot1" value="<?php echo $data['total']?>" >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="update ml-auto mr-auto">
                <input type="hidden" name ="update" value="update"/>
                <button type="submit"  class="btn btn-primary btn-round">Update</button>
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



  ///////////////////////////////////////////////////////////////////////////////////////

  $('.stock_out').on('keyup',function(){
        stock()
    });

  ///////////////////////////////////////////

  function stock(){

    var load_amt1 = $('#load1').val();
    var bal_amt1  = $('#bf_bal1').val();
    var ware1     = $('#warehouse1').val();

    ////$('#load1').val(load_amt1);
    ////$('#bf_bal1').val(bal_amt1);

    if(load_amt1 == ''){
      $('#tot1').val(Number(bal_amt1));
      $('#warehouse_now').val(Number(ware1));
    }else{
      $('#tot1').val(Number(bal_amt1)+Number(load_amt1));
      $('#warehouse_now').val(Number(ware1)-Number(load_amt1));
    } 


    // array end
  } 
  ///////////////////////////////////////////////////////////////////////////////////////

  $(function () {

      $('#trxnEdit').on('submit', function (e) {

        e.preventDefault();

        $.ajax({
          type: 'post',
          url: 'edit_trxn.php',
          data: $('#trxnEdit').serialize(),
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
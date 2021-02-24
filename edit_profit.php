<?php

   include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM profit WHERE P_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $P_id1     = $_POST['P_id1'];
        $sales1    = $_POST['sales1'];
        $expense1  = $_POST['expense1'];
        $profit1   = $_POST['profit1'];
      
        $edit = mysqli_query($con,"UPDATE profit 
                                          SET expenses        ='$expense1',
                                              daily_profit    ='$profit1'
                                          WHERE P_id=$P_id1");
      
        if($edit)
        {
            mysqli_close($con); // Close connection
            header("location:profit.php"); // redirects to all records page
            exit;
        }
        else
        {
            echo mysqli_error();
        }     
    }              
?>

<div class="card-body">
  <div class="modal fade" id="Form3" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE ITEM</h5>
        </div> 

        <form  id="profitEdit" >
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-8 pr-1">
                <div class="form-group">
                <label>DATE</label> 
                <input type="hidden" class="form-control" name="P_id1" value="<?php echo $data['P_id']?>" readonly required>

                <input type="date" class="form-control" id="cdate1" name="cdate1" value="<?php echo $data['cdate']?>" readonly required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 pr-1">
                <div class="form-group">
                  <label>SALES</label>
                  <input type="text" class="form-control cal_profit1" placeholder="LKR" name="sales1" id="sales1" value="<?php echo $data['sales']?>" readonly required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 pr-1">
                <div class="form-group">
                  <label>PURCHASE COST</label>
                  <input type="text" class="form-control cal_profit1" placeholder="LKR" name="purchase1" id="purchase1" value="<?php echo $data['purchase_cost']?>" readonly required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 pr-1">
                <div class="form-group">
                  <label>EXPENSES</label>
                  <input type="text" class="form-control cal_profit1" placeholder="LKR" name = "expense1" id="expense1" value="<?php echo $data['expenses']?>"  required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8 pr-1">
                <div class="form-group">
                 <!--  <label>DAILY PROFIT</label> -->
                  <input type="hidden" class="form-control" placeholder="LKR" name="profit1"  id="profit1"  value="<?php echo $data['daily_profit']?>" readonly required>
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

  //////////////CALCULATE THE PROFIT///////////////// 
  $('.cal_profit1').on('keyup', function() {

     cal_profit1();
      
  }); 

  function cal_profit1(){
    var income1 = $('#sales1').val();
    var purch1 = $('#purchase1').val();
    var expenses1 = $('#expense1').val();
    var pro1 = Number(income1)-(Number(purch1)+Number(expenses1));

    $('#profit1').val(pro1.toFixed(2));

  }
  
  /////////////////////////////////////////////////

  $(function () {

    $('#profitEdit').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'edit_profit.php',
        data: $('#profitEdit').serialize(),
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
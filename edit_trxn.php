<?php

   include("db_config.php");
    $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }

    $id = $_POST['id']; // get id through query string

    $qry = mysqli_query($con,"SELECT * FROM trxn WHERE trxn_id='$id' "); // select query

    $data = mysqli_fetch_array($qry); // fetch data

    if(isset($_POST['update'])) // when click on Update button
    {
        $trxn_id1   = $_POST['trxn_id1'];
        $category1  = $_POST['category1'];
        $item1      = $_POST['item1'];
        $size1      = $_POST['size1'];
        $load1      = $_POST['load1'];
        $bf_bal1    = $_POST['bf_bal1'];
        $tot1       = $_POST['tot1'];
        $shop1_1    = $_POST['1_1'];
        $shop2_1    = $_POST['2_1'];
        $shop3_1    = $_POST['3_1'];
        $shop4_1    = $_POST['4_1'];
        $shop5_1    = $_POST['5_1'];
        $shop6_1    = $_POST['6_1'];
        $shop7_1    = $_POST['7_1'];
        $shop8_1    = $_POST['8_1'];
        $shop9_1    = $_POST['9_1'];
        $shop10_1   = $_POST['10_1'];
        $shop11_1   = $_POST['11_1'];
        $shop12_1   = $_POST['12_1'];
        $shop13_1   = $_POST['13_1'];
        $shop14_1   = $_POST['14_1'];
        $shop15_1   = $_POST['15_1'];
        $shop16_1   = $_POST['16_1'];
        $sale1      = $_POST['sale1'];
        $free1      = $_POST['free1'];
        $bal1       = $_POST['bal1'];
      
        $edit = mysqli_query($con,"UPDATE trxn 
                                      SET category  ='$category1',
                                          item      ='$item1',
                                          size      ='$size1',
                                          load_bal  ='$load1',
                                          bf_bal    ='$bf_bal1',
                                          total     ='$tot1',
                                          S1        ='$shop1_1',
                                          S2        ='$shop2_1',
                                          S3        ='$shop3_1',
                                          S4        ='$shop4_1',
                                          S5        ='$shop5_1',
                                          S6        ='$shop6_1',
                                          S7        ='$shop7_1',
                                          S8        ='$shop8_1',
                                          S9        ='$shop9_1',
                                          S10       ='$shop10_1',
                                          S11       ='$shop11_1',
                                          S12       ='$shop12_1',
                                          S13       ='$shop13_1',
                                          S14       ='$shop14_1',
                                          S15       ='$shop15_1',
                                          S16       ='$shop16_1',
                                          sale      ='$sale1',
                                          free      ='$free1',
                                          af_bal    ='$bal1'
                                          WHERE trxn_id =$trxn_id1");

         $update_stock1 = mysqli_query($con,"UPDATE item SET lorry_stock = '$bal1' WHERE item_name='$item1'");
      
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
          <h5 class="modal-title" id="staticBackdropLabel">UPDATE CATEGORY</h5>
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
                  <input type="text" class="form-control total1" id="load1" name = "load1" value="<?php echo $data['load_bal']?>" >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>BF BAL</label>
                  <input type="text" class="form-control total1" id="bf_bal1" name = "bf_bal1" value="<?php echo $data['bf_bal']?>" >
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>TOT</label>
                  <input type="text" class="form-control" id="tot1" name = "tot1" value="<?php echo $data['total']?>" >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>1</label>
                  <input type="text" class="form-control stock_out" id="1_1" name = "1_1" value="<?php echo $data['S1']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>2</label>
                  <input type="text" class="form-control stock_out" id="2_1" name = "2_1" value="<?php echo $data['S2']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>3</label>
                  <input type="text" class="form-control stock_out" id="3_1" name = "3_1" value="<?php echo $data['S3']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>4</label>
                  <input type="text" class="form-control stock_out" id="4_1" name = "4_1" value="<?php echo $data['S4']?>">
                </div>
              </div>
              
            </div>

            <div class="row">
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>5</label>
                  <input type="text" class="form-control stock_out" id="5_1" name = "5_1" value="<?php echo $data['S5']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>6</label>
                  <input type="text" class="form-control stock_out" id="6_1" name = "6_1" value="<?php echo $data['S6']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>7</label>
                  <input type="text" class="form-control stock_out" id="7_1" name = "7_1" value="<?php echo $data['S7']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>8</label>
                  <input type="text" class="form-control stock_out" id="8_1" name = "8_1" value="<?php echo $data['S8']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>9</label>
                  <input type="text" class="form-control stock_out" id="9_1" name = "9_1" value="<?php echo $data['S9']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>10</label>
                  <input type="text" class="form-control stock_out" id="10_1" name = "10_1" value="<?php echo $data['S10']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>11</label>
                  <input type="text" class="form-control stock_out" id="11_1" name = "11_1" value="<?php echo $data['S11']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>12</label>
                  <input type="text" class="form-control stock_out" id="12_1" name = "12_1" value="<?php echo $data['S12']?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>13</label>
                  <input type="text" class="form-control stock_out" id="13_1" name = "13_1" value="<?php echo $data['S13']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>14</label>
                  <input type="text" class="form-control stock_out" id="14_1" name = "14_1" value="<?php echo $data['S14']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>15</label>
                  <input type="text" class="form-control stock_out" id="15_1" name = "15_1" value="<?php echo $data['S15']?>">
                </div>
              </div>
              <div class="col-md-3 pr-1">
                <div class="form-group">
                  <label>16</label>
                  <input type="text" class="form-control stock_out" id="16_1" name = "16_1" value="<?php echo $data['S16']?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>SALE</label>
                  <input type="text" class="form-control" id="sale1" name = "sale1" value="<?php echo $data['sale']?>" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>FREE</label>
                  <input type="text" class="form-control" id="free1" name = "free1" value="<?php echo $data['free']?>" >
                </div>
              </div>
              <div class="col-md-6 pr-1">
                <div class="form-group">
                  <label>BAL</label>
                  <input type="text" class="form-control" id="bal1" name = "bal1" value="<?php echo $data['af_bal']?>" >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="update ml-auto mr-auto">
                <input type="hidden" name ="update" value="update"/>
                <button type="submit" name="update" class="btn btn-primary btn-round">Save</button>
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

  $('.total1').on('keyup',function(){
        total1()
    });

  ///////////////////////////////////////////

  function total1(){

    var load_amt1 = $('#load1').val();
    var bal_amt1  = $('#bf_bal1').val();
    
    var tot_amt1;

    tot_amt1 = Number(load_amt1) + Number(bal_amt1);
    
    $('#tot1').val(tot_amt1);
  
  } 
  ///////////////////////////////////////////////////////////////////////////////////////

  $('.stock_out').on('keyup',function(){
        stock()
    });

  ///////////////////////////////////////////

  function stock(){

      // array for calculate all shops values
      
      //Show Like this 
      
      var shop1 = $('#1_1').val();
      var shop2 = $('#2_1').val();
      var shop3 = $('#3_1').val();

      var shop4 = $('#4_1').val();
      var shop5 = $('#5_1').val();
      var shop6 = $('#6_1').val();

      if(shop1 !=''){
        shop1  = $('#1_1').val();
      }else{
        shop1 = '0/0';
      }

      if(shop2 !=''){
        shop2  = $('#2_1').val();
      }else{
        shop2 = '0/0';
      }

      if(shop3 !=''){
        shop3  = $('#3_1').val();
      }else{
        shop3 = '0/0';
      }

      if(shop4 !=''){
        shop4  = $('#4_1').val();
      }else{
        shop4 = '0/0';
      }

      if(shop5 !=''){
        shop5  = $('#5_1').val();
      }else{
        shop5 = '0/0';
      }

      if(shop6 !=''){
        shop6  = $('#6_1').val();
      }else{
        shop6 = '0/0';
      }

      var operator1 = shop1.split('/');
      var operator2 = shop2.split('/');
      var operator3 = shop3.split('/');
      var operator4 = shop4.split('/');
      var operator5 = shop5.split('/');
      var operator6 = shop6.split('/');

      var up1 = operator1[0];
      var core1 = operator1[1];

      var up2 = operator2[0];
      var core2 = operator2[1];

      var up3 = operator3[0];
      var core3 = operator3[1];

      var up4 = operator4[0];
      var core4 = operator4[1];

      var up5 = operator5[0];
      var core5 = operator5[1];

      var up6 = operator6[0];
      var core6 = operator6[1];

      $('#free1').val(Number(up1)+Number(up2)+Number(up3)+Number(up4)+Number(up5)+Number(up6));
      $('#sale1').val(Number(core1)+Number(core2)+Number(core3)+Number(core4)+Number(core5)+Number(core6));

      var sale  = $('#sale1').val();
      var free  = $('#free1').val();
      var total = $('#tot1').val();

      var bal = Number(total) - (Number(sale) + Number(free));

      $('#bal1').val(bal);

    // array end
  } 
  ///////////////////////////////////////////////////////////////////////////////////////

 ///////////////////////////////////////////////////

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
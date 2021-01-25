<?php
error_reporting(0);
include("db_config.php");
session_start();
if (!isset($_SESSION['loged_user'])) {
    //echo "Access Denied";
    header('location: login.php');
}else {
  $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }
  mysqli_select_db($con,DB_NAME);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    PANASONIC
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

</head>

<body class="">
  <div class="wrapper ">
    
    <?php include('include/sidebar.php');  ?>
    
    <div class="main-panel">
      <!-- Navbar -->
      <?php include('include/nav.php');  ?>
      <!-- End Navbar -->
      <div class="content">
       <div class="row">
          <div class="col-md-12">         
            <div class="card">
              <div class="row">
              <div class="col-md-8">
                <div class="card-header">
                  <h4 class="card-title"> Daily Sales </h4>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card-header">
                    <button type="button" class="btn btn-primary add-btn" data-toggle="modal" data-target="#Form1">+ Add New Bill..
                    </button> 
                </div>
              </div>
              </div>
              <!--  -->

              <div class="card-body">
                <div class="modal fade" id="Form1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add New Bill</h5>
                      </div> 
                      <form id="BillAdd">
                        <input type="hidden" id="myitemjson" name="myitemjson"/>
                        <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>SHOP</label>
                              <input type="text" class="form-control" id="shop" name="shop">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>DATE</label>
                              <input type="date" class="form-control" id="b_date" name="b_date" required>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>BILL #</label>
                              <input type="text" class="form-control" placeholder="" name="bill_no" id="bill_no" required readonly>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>ITEM</label>
                              <select class="form-control form-selectBox" id="item" name="item">
                                  <option value="default">--Select Item--</option>
                                  <?php
                                
                                      $get_item = mysqli_query($con,"SELECT * FROM item");

                                      $numRows1 = mysqli_num_rows($get_item); 
                       
                                        if($numRows1 > 0) {
                                          while($row1 = mysqli_fetch_assoc($get_item)) {
                                            echo "<option value = ".$row1['item_name'].">" . $row1['item_name'] . "</option>";
                                            
                                          }
                                        }
                                  ?>
                                  
                                </select>
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>TOTAL</label>
                              <input type="text" class="form-control" id="total" name="total" disabled>
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>SALE</label>
                              <input type="text" class="form-control" id="sale" name="sale">
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>FREE</label>
                              <input type="text" class="form-control" id="free" name="free">
                            </div>
                          </div>
                          <div class="col-md-2 pr-1">
                            <div class="form-group">
                              <label>AF BAL</label>
                              <input type="text" class="form-control" id="af_bal" name="af_bal" readonly>
                            </div>
                          </div>

                            <div class="col-md-1 pr-1">
                              <div class="form-group">
                                <label>tot sale</label>
                                <input type="text" class="form-control" id="tot_sale" name="tot_sale" readonly>
                              </div>
                            </div>
                            <div class="col-md-1 pr-1">
                              <div class="form-group">
                                <label>tot free</label>
                                <input type="text" class="form-control" id="tot_free" name="tot_free" readonly>
                              </div>
                            </div>
                            
                            <div class="col-md-1 pr-1">
                              <div class="form-group">
                                <label>purchase</label>
                                <input type="text" class="form-control" id="purchase" name="purchase" readonly>
                              </div>
                            </div>
                            <div class="col-md-1 pr-1">
                              <div class="form-group">
                                <label>sales</label>
                                <input type="text" class="form-control" id="sales" name="sales" readonly>
                              </div>
                            </div>
                            <div class="col-md-1 pr-1">
                              <div class="form-group">
                                <label>af sale</label>
                                <input type="text" class="form-control" id="af_sale" name="af_sale" readonly>
                              </div>
                            </div>
                            <div class="col-md-1 pr-1">
                              <div class="form-group">
                                <label>af free</label>
                                <input type="text" class="form-control" id="af_free" name="af_free" readonly>
                              </div>
                            </div>
                            <div class="col-md-2 pr-1">
                              <div class="form-group">
                                <label>PURCHASE</label>
                                <input type="text" class="form-control" id="tot_pur" name="tot_pur" readonly>
                              </div>
                            </div>
                            <div class="col-md-2 pr-1">
                              <div class="form-group">
                                <label>SALE</label>
                                <input type="text" class="form-control" id="tot_sales" name="tot_sales" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                           <div class="col-md-2 pr-1">
                            <div class="form-group">
                               <button type="button" id="addbtn" name="addbtn" class="btn btn-secondary btn-round">Add</button>
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table id="example" class="table table-bordered table-striped" style="width:100%">
                              <thead>
                                <tr>
                                  <th>ITEM</th>
                                  <th>TOTAL</th>
                                  <th>SALE</th>
                                  <th>FREE</th>
                                  <th>AF BAL</th>  
                                  <th>AF SALE</th>  
                                  <th>AF FREE</th>  
                                  <th>TOT PUR</th> 
                                  <th>TOT SALE</th>
                                  <th>TOT FREE</th>      
                                 
                                  <th>DELETE</th>  
                                </tr>
                              </thead>
                          </table>
                        </div>           
                        <!-- end -->

                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Bill Amount</label>
                              <input type="text" class="form-control" placeholder="LKR" name="bill_amt" id="bill_amt" required>
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Discount</label>
                              <input type="text" class="form-control" placeholder="LKR" name="discount" id="discount" required>
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>Discounted Amount</label>
                              <input type="text" class="form-control" placeholder="LKR" name="dis_amt" id="dis_amt" required readonly>
                            </div>
                          </div>
                        </div>

                         <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <input type="text" class="form-control" placeholder="Purchase Cost" name="pur_cost" id="pur_cost" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>CASH</label>
                              <input type="text" class="form-control" placeholder="LKR" name="cash" required>
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>CREDIT</label>
                              <input type="text" class="form-control" placeholder="LKR" name="credit" required>
                            </div>
                          </div>
                          <div class="col-md-4 pr-1">
                            <div class="form-group">
                              <label>CHEQUE</label>
                              <input type="text" class="form-control" placeholder="LKR" name="cheque" id="cheque" required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>CHEQUE NO:</label>
                              <input type="text" class="form-control" placeholder="LKR" name="cheque_no" id="cheque_no" disabled>
                            </div>
                          </div>
                          <div class="col-md-6 pr-1">
                            <div class="form-group">
                              <label>CHEQUE VALID DATE</label>
                              <input type="date" class="form-control" name="cheque_date" id="cheque_date" disabled>
                            </div>
                          </div>
                        </div>
                        

                        <div class="row">
                          <div class="update ml-auto mr-auto">
                            <input type="hidden" name ="submit" value="Submit"/>
                            <button type="submit" name="submit" class="btn btn-primary btn-round">Submit</button>
                            <Input type="button" onclick="form_reset()" class="btn btn-danger btn-round" data-dismiss="modal" value="Close">
                          </div>
                        </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div><!-- card body-->
 
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="myTable">
                    <thead class="text-primary">
                      <th>                     BILL #     </th>
                      <th>                     SHOP NAME  </th>
                      <th>                     DATE       </th>
                      <th class="text-right">  CASH       </th>
                      <th class="text-right">  CREDIT     </th>
                      <th class="text-right">  CHEQUE     </th>
                      <!-- <th class="text-center"> EDIT       </th> -->
                      <th class="text-center"> DELETE     </th>
                    </thead>
                    <tbody>
                      <?php
                      $sql=mysqli_query($con,"SELECT * FROM bill");

                      $numRows = mysqli_num_rows($sql); 
                 
                      if($numRows > 0) {
                        while($row = mysqli_fetch_assoc($sql)) {

                          ?>
                          <tr>
                            <td>                    <?php echo $row['bill_no'] ?> </td>
                            <td>                    <?php echo $row['shop'] ?>    </td>
                            <td>                    <?php echo $row['b_date'] ?>  </td>
                            <td class="text-right"> <?php echo $row['cash'] ?>    </td>
                            <td class="text-right"> <?php echo $row['credit'] ?>  </td>
                            <td class="text-right"> <?php echo $row['cheque'] ?>  </td>
 
                            <!--<td class="text-center">  
                             <a href="#" onclick="editView('<?php // echo $row['bill_no']; ?>')" name="edit">
                              <h6 style='color:green;'>EDIT</h6></a>
                            </td> -->

                            <td class="text-center">  
                              <a href="#" onclick="confirmation('event','<?php echo $row['bill_no']; ?>')" name="delete">
                              <h6 style='color:red;'>DELETE</h6></a>
                            </td>

                          </tr>
                    </tbody>
                           <?php
                        }
                      }
                    ?>                      
                    </table>
                  
                </div>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-md_12 -->
        </div><!-- row -->
      </div><!-- content -->
      <!-- FOOTER -->
       <?php include('include/footer.php');  ?>
      <!-- FOOTER -->
    </div><!-- main panel -->
  </div><!-- wrapper -->

  <div id="show_view">

  </div>
  
  <!--   Core JS Files   -->
  <!-- <script src="assets/js/core/jquery.min.js"></script> -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
    <!-- sweetalert message -->
  <script src="assets/js/sweetalert.min.js"></script>
  
  <script>

//////////////////////////////GET NEW BILL NO //////////////////////////////////
$('#cheque').on('keyup', function() {

  $('#cheque_no').prop('disabled', false);
  $('#cheque_date').prop('disabled', false);

}); 

////////////////////Generate bill no//////////////////////
$('#b_date').on('change', function() {
    const zeroPad = (num, places) => String(num).padStart(places, '0');

    $.ajax({
      url: 'bill_no.php',
      method:"POST",
      data:{shop:this.value},
      success:function(response) {//response is value returned from php (for your example it's "bye bye"
        var lastNumber = Number(response.substr(1))+1;
        $('#bill_no').val(zeroPad(lastNumber, 8));
      }
    });   
});

////////////////////Fetch total when item changed/////////////////////////////
$('#item').on('change', function() {

  var item  = $('#item').val();

  $.ajax({
    url: 'get_total.php',
    method:"POST",
    data:{item:item},
    success: function (response) {

      var obj = JSON.parse(response);

      var total_sale     =  obj.sale_items
      var total_free     =  obj.free_items
      var purch_price    =  obj.purch_price
      var sale_price     =  obj.sale_price

       $('#tot_sale').val(total_sale);
       $('#tot_free').val(total_free);
       $('#purchase').val(purch_price);
       $('#sales').val(sale_price);

       $('#total').val(Number(total_sale)+Number(total_free));
    }
  });
});

////////Calculate free items & af bal according to sale amount///////////////
$('#sale').on('keyup', function() {

  var total_qty  = $('#total').val();
  var total_sale = $('#tot_sale').val();
  var total_free = $('#tot_free').val();
  var sale_qty   = $('#sale').val();
  var free       = $('#free').val();
  var purchase   = $('#purchase').val();
  var sale       = $('#sales').val();
  var free_qty;

  free_qty = (Number(sale_qty)/12)*3;

  var after_qty = Number(total_qty) - (Number(sale_qty)+Number(free_qty));

  $('#free').val(free_qty);
  $('#af_sale').val(Number(total_sale)-Number(sale_qty));
  $('#af_free').val(Number(total_free)-Number(free_qty));
  $('#af_bal').val(after_qty);
  $('#tot_pur').val(Number(sale_qty)*Number(purchase));
  $('#tot_sales').val(Number(sale_qty)*Number(sale));

});

////////Calculate free items & af bal according to sale amount////////////
$('#free').on('keyup', function() {

  var total_qty = $('#total').val();
  var sale_qty = $('#sale').val();
  var total_free = $('#tot_free').val();
  var free = $('#free').val();

  var after_qty = Number(total_qty) - (Number(sale_qty)+Number(free));

  $('#af_free').val(Number(total_free)-Number(free));
  $('#af_bal').val(after_qty);

});

////////Calculate free discounted amoount when discount value enter////////////
$('#discount').on('keyup', function() {

  var bill_amt1 = $('#bill_amt').val();
  var discount1 = $('#discount').val();

  var discounted = Number(bill_amt1)-Number(discount1);

  $('#dis_amt').val(discounted);

});

///////////////////// Form values reset //////////////////////////
function form_reset(){
  document.getElementById("BillAdd").reset();
  $('#cheque_no').prop('disabled', true);
  $('#cheque_date').prop('disabled', true);
}

///////////////////////Delete bill///////////////////////////////

function delete_bill(id){

  $.ajax({
      url:"delete_bill",
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

////////////////////////////Delete bill///////////////////////////////
function confirmation(e,id) {
    swal({
    title: "Are you sure?",
    text: "Want to Delete this recode !",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
           delete_bill(id)
        } 
    });
}

///////////////////////////Insert bill///////////////////////////////////////

$(function () {

    $('#BillAdd').on('submit', function (e) {

      e.preventDefault();

      $.ajax({
        type: 'post',
        url: 'bill_insert.php',
        data: $('#BillAdd').serialize(),
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
///////////////////////////////////////////////////////////////////////

  ///////////////  Add Row
  $(document).ready(function() {
      $('#example').dataTable();
      $('#addbtn').click(addrow);
  });

 ///////////////  Add Row
  function addrow() {

    // var amountAMT = 0;

      $('#example').dataTable().fnAddData( [
          $('#item option:selected').text(),
          $('#total').val(),
          $('#sale').val(),
          $('#free').val(),
          $('#af_bal').val(),
          $('#af_sale').val(),
          $('#af_free').val(),
          $('#tot_pur').val(),
          $('#tot_sales').val(),
          $('#tot_free').val(),
          "<button class='btn-edit' id='DeleteButton'>Delete</button>" ] );

      $('#item').val("")
      $('#total').val("")
      $('#sale').val("")
      $('#free').val("")
      $('#af_bal').val("")
      $('#af_sale').val("")
      $('#af_free').val("")
      $('#tot_pur').val("")
      $('#tot_sales').val("")
      $('#tot_free').val("")
      
      reCalulate();
     
    }

   /////////// Calulate Row Count
   function reCalulate(){

      //need to add above af_sale, af_free, tot_pur, tot_sales text box values as hidden fields to the list view 
      //need to get sum of the tot_sales to bill_amt text box and sum of the tot_pur to pur_cost text box
      
      var array=[];
       var TotalAmt = 0  , PurchaseCost = 0;
      var table = $("#example");

      table.find('tr:gt(0)').each(function (i) {

      var $tds = $(this).find('td'),
      item = $tds.eq(0).text();
      total = $tds.eq(1).text();
      sale = $tds.eq(2).text();
      free = $tds.eq(3).text();
      af_bal = $tds.eq(4).text();
      af_sale = $tds.eq(5).text();
      af_free = $tds.eq(6).text();
      tot_pur = $tds.eq(7).text();
      tot_sales = $tds.eq(8).text();
      tot_free = $tds.eq(9).text();

      //alert(item_code);

      TotalAmt = Number(TotalAmt) + Number(tot_sales);
      PurchaseCost = Number(PurchaseCost) + Number(tot_pur);
      $('#bill_amt').val(TotalAmt);
      $('#pur_cost').val(PurchaseCost)

      var z={"item":item,"total":total,"sale":sale,"free":free,"af_bal":af_bal,"af_sale":af_sale,"af_free":af_free,"tot_pur":tot_pur,"tot_sales":tot_sales,"tot_free":tot_free};

      array.push({item:item,total:total,sale:sale,free:free,af_bal:af_bal,af_sale:af_sale,af_free:af_free,tot_pur:tot_pur,tot_sales:tot_sales,tot_free:tot_free});

      });

    
      //var table = $('#example').DataTable();
 
      // Hide two columns
      // table.columns( [5,6,7,8,9] ).visible( false );

      // var z={"item":item,"total":total,"sale":sale,"free":free,"af_bal":af_bal,"af_sale":af_sale,"af_free":af_free,"tot_pur":tot_pur,"tot_sales":tot_sales,"tot_free":tot_free};

      // array.push({item:item,total:total,sale:sale,free:free,af_bal:af_bal,af_sale:af_sale,af_free:af_free,tot_pur:tot_pur,tot_sales:tot_sales,tot_free:tot_free});

      // });

      console.log(JSON.stringify(array, null, 1));
      $('#myitemjson').val(JSON.stringify(array));

    }
 
    /////////// Remove the Row 
    $("#example").on("click", "#DeleteButton", function() {
      $(this).closest("tr").remove();
      reCalulate();
   });


  </script>
</body>
</html>
<?php
mysqli_close($con);
}
?>
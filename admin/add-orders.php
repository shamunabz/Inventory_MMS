<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $orderdate=$_POST['orderdate'];
    $rname=$_POST['rname'];
    $product=$_POST['product'];
    $qty=$_POST['qty'];
    $uprice=$_POST['uprice'];
    $total=$_POST['total'];
   
     $tax=$_POST['tax'];
    $discount=$_POST['discount'];
     $nettotal=$_POST['nettotal'];
    $paid=$_POST['paid'];
    $dues=$_POST['dues'];
    $paymentmode=$_POST['paymentmode'];
    $ordernum= mt_rand(100000000, 999999999);
    $query=mysqli_query($con, "insert into tblorders(OrderNumber,ProductID,OrderDate,RecepientName,Quantity,UnitPrice,Total,Tax,Discount,NetTotal,Paid,Dues,PaymentMethod) value('$ordernum','$product','$orderdate','$rname','$qty','$uprice','$total','$tax','$discount','$nettotal','$paid','$dues','$paymentmode')");
    if ($query) {
   
    echo '<script>alert("Order has been added.")</script>';
  }
  else
    {
     echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Inventory Management System|| Add Order</title>
<?php include_once('includes/js.php');?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script>
function getprice() {
  alert('erwr');
$("#loaderIcon").show();
jQuery.ajax({
url: "get-price.php",
data:'pid='+$("#product").val(),
type: "POST",
success:function(data){
$("#price").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}


</script> -->

<script>
function getprice(val) {
  alert(val);
  $.ajax({
type:"POST",
url:"get-price.php",
data:'product='+val,
success:function(data){
$("#price").html(data);
}

  });
}
</script>


</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-category.php" class="tip-bottom">Add Order</a></div>
  <h1>Add Order</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Order</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" id="add_name" name="add_name" class="form-horizontal">
           <div class="control-group">
              <label class="control-label">Order Date :</label>
              <div class="controls">
                <input type="text" class="span11" name="orderdate" id="orderdate" value="<?php echo date('Y-m-d');?>" required='true'/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Recipient Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="rname" id="rname" value="" required='true'/>
              </div>
            </div>
           <div class="control-group">
              <label class="control-label">Recipient Contact :</label>
              <div class="controls">
                <input type="text" class="span11" name="rname" id="rname" value="" required='true'/>
              </div>
            </div>

            <div class="control-group">
            
            
<table id="dynamic_field" border="1">
  <tr>
    <th>Product</th>
    <th>Price</th>
<th>Qty</th>
<th>Total price</th>
<th>Action</th>
  </tr> <?php
            $arrayNumber = 0;
            for($x = 1; $x < 4; $x++) { ?>
  <tr>
<td><select name="product[]" id="product"  class="span11" onChange="getprice(this.value)" >
  <option value="">Choose Products</option>
  <?php
$ret=mysqli_query($con,"select * from tblproducts");
while ($row=mysqli_fetch_array($ret)) {
?>
  <option value="<?php  echo $row['ID'];?>"><?php  echo $row['ProductName'];?></option><?php 
}?> 
</select></td>
<td width="200"><select name="price[]" id="price" class="span11" readonly>
</select> </td>
<td><input type="text" name="qty[]" id="qty" placeholder="Enter your Quantity" class="span11" /></td>
<td><input type="text" name="total[]" id="total" placeholder="Total" value="" class="span11" readonly /></td>
<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
  </tr>
<?php   $arrayNumber++;} ?>
</table>

</div>




            <div class="control-group">
              <label class="control-label">Subtotal :</label>
              <div class="controls">
                <input type="text" class="span11" name="subtotal" id="subtotal" value="" required='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tax: </label>
              <div class="controls">
                <?php
$ret=mysqli_query($con,"select * from tbltax");
while ($row=mysqli_fetch_array($ret)) {
?>
                <input type="text" class="span11" name="tax" id="tax" value="<?php  echo $row['Tax'];?>" />
                 <?php 
}?> 
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Discount: :</label>
              <div class="controls">
                <input type="text" class="span11" name="discount" id="discount" value="" required='true' />
                  
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Net Total :</label>
              <div class="controls">
                <input type="text" class="span11"  name="nettotal" id="nettotal" value="" required="true"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Paid :</label>
              <div class="controls">
                <input type="text" class="span11"  name="paid" id="paid" value="" required="true"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Dues :</label>
              <div class="controls">
                <input type="text" class="span11" name="dues" id="dues" value="" required="true"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Payment Method :</label>
              <div class="controls">
                <select name="paymentmode" class="span11" id="paymentmode" value="" required="true" />
                  <option value="">Choose Payment Method</option>
                  <option value="Cash">Cash</option>
                  <option value="Card">Card</option>
                  <option value="Cheque">Cheque</option>
                  <option value="Demand Draft">Demand Draft</option>
                </select>
              </div>
            </div>          
           
            <div class="form-actions">
              <button type="submit" class="btn btn-success" name="submit">Add</button>
            </div>
          </form>
        </div>
      </div>
    
    </div>
  </div>
 </div>
</div>
<?php include_once('includes/footer.php');?>
<?php //include_once('includes/cs.php');?>
<script>
$(document).ready(function(){
var i=1;
$('#add').click(function(){
i++;
$('#dynamic_field').append('<tr id="row'+i+'"><td><select name="product[]" id="product"  class="span11" onchange="getprice()"><option value="">Choose Products</option>  <?php
$ret=mysqli_query($con,"select * from tblproducts");
while ($row=mysqli_fetch_array($ret)) {
?>
  <option value="<?php  echo $row['ID'];?>"><?php  echo $row['ProductName'];?></option><?php 
}?></select> </td><td width="200"><select name="price[]" id="price" class="span11" readonly></select> </td><td><input type="text" name="qty[]" placeholder="Enter your Quantity" class="form-control name_list" id="qty" /></td><td><input type="text" name="total[]" id="total" placeholder="Total" class="form-control name_list" readonly /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
});
  
$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id"); 
$('#row'+button_id+'').remove();
});
});
</script>
<script>
  $(function () {
  $("#price, #qty").keyup(function () {
    $("#total").val(+$("#price").val() * +$("#qty").val());
  });
});

</script>
</body>
</html>
<?php } ?>
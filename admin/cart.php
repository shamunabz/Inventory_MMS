<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{

// Code for deleting product from cart
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblcart where ID='$rid'");
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'cart.php'</script>";     


}
if(isset($_POST['submit']))
  {
    $custname=$_POST['customername'];
    $custmobilenum=$_POST['mobilenumber'];
    $billiningnum= mt_rand(100000000, 999999999);
    $modepayment=$_POST['modepayment'];


$query="update tblcart set BillingId='$billiningnum',IsCheckOut=1 where IsCheckOut=0;";  
$query.="insert into  tblcustomer(BillingNumber,CustomerName,MobileNumber,ModeofPayment) value('$billiningnum','$custname','$custmobilenum','$modepayment');";
$result = mysqli_multi_query($con, $query);
if ($result) {
$_SESSION['invoiceid']=$billiningnum;
echo '<script>alert("Invoice created successfully. Billing number is "+"'.$billiningnum.'")</script>';
echo "<script>window.location.href='invoice.php'</script>";

}
  
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Inventory Management System|| Cart</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="cart.php" class="current">Products Cart</a> </div>
    <h1>Products Cart</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       <form method="post" class="form-horizontal" name="submit">
           
            <div class="control-group">
              <label class="control-label">Customer Name :</label>
              <div class="controls">
                <input type="text" class="span11" id="customername" name="customername" value="" required='true' />
              </div>
            </div>
          <div class="control-group">
              <label class="control-label">Customer Mobile Number :</label>
              <div class="controls">
                <input type="text" class="span11" id="mobilenumber" name="mobilenumber" value="" required='true' maxlength="10" pattern="[0-9]+"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Mode of payment :</label>
              <div class="controls">
                <input type="radio" class="span11" name="modepayment" value="cash" checked="true"> Cash
             <input type="radio" class="span11" name="modepayment" value="card"> Card
             
              </div>
            </div>


           <div class="text-center">
                  <button class="btn btn-primary my-4" type="submit" name="submit">Submit</button>
                </div>
          </form>
     
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products Cart</h5>
          </div>
        
          <div class="widget-content nopadding">
         <table class="table table-bordered" style="font-size: 15px">
              <thead>
                <tr>
                  <th style="font-size: 12px">S.NO</th>
                  <th style="font-size: 12px">Product Name</th>
                  <th style="font-size: 12px">Category Name</th>
                   <th style="font-size: 12px">SubCategory Name</th>
                  <th style="font-size: 12px">Brand Name</th>
                  <th style="font-size: 12px">Model Number</th>
                  <th style="font-size: 12px">Quantity</th>
                  <th style="font-size: 12px">Price(per unit)</th>
                  <th style="font-size: 12px">Total</th>
                  <th style="font-size: 12px">Action</th>
                </tr>
              </thead>
              <tbody>
              
                <?php
$ret=mysqli_query($con,"select tblcategory.CategoryName,tblsubcategory.SubCategoryname as subcat,tblproducts.ProductName,tblproducts.BrandName,tblproducts.ID as pid,tblproducts.Status,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock,tblproducts.Price,tblcart.ProductQty,tblcart.ID as cid from tblproducts join tblcategory on tblcategory.ID=tblproducts.CatID join tblsubcategory on tblsubcategory.ID=tblproducts.SubcatID left join tblcart  on tblproducts.ID=tblcart.ProductId where tblcart.IsCheckOut='0' group by tblproducts.ProductName");
$cnt=1;
$num=mysqli_num_rows($ret);
if($num>0){
while ($row=mysqli_fetch_array($ret)) {

?>

                <tr class="gradeX">
                    
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['CategoryName'];?></td>
                  <td><?php  echo $row['subcat'];?></td>
                  <td><?php  echo $row['BrandName'];?></td>
                  <td><?php  echo $row['ModelNumber'];?></td>
                  <td><?php  echo($pq= $row['ProductQty']);?></td>
                  <td><?php  echo ($ppu=$row['Price']);?></td>
                   <td><?php  echo($total=$pq*$ppu);?></td> 
 <td><a href="cart.php?delid=<?php echo $row['cid'];?>" onclick="return confirm('Do you really want to Delete ?');"><i class="icon-trash"></i></a></td>
                </tr>
                <?php 
$cnt=$cnt+1;
$gtotal+=$total;
}?>
 <tr>
                  <th colspan="7" style="text-align: center;color: red;font-weight: bold;font-size: 15px">  Grand Total</th>
                  <th colspan="4" style="text-align: center;color: red;font-weight: bold;font-size: 15px"><?php  echo $gtotal;?></th>
                </tr>
   
<?php } else {?>

  <tr>
<td colspan="6" style="color:red; text-align:center"> No item found in cart</td>
  </tr>
<?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<?php include_once('includes/footer.php');?>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
</body>
</html>
<?php } ?>
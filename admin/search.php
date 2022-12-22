<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
// Code for add to cart

if(isset($_POST['cart']))
{

$pid=$_POST['pid'];
$pqty=$_POST['pqty'];
$ischecout=0;
$remainqty=$_SESSION['rqty'];
if($pqty<=$remainqty)
{
$query=mysqli_query($con,"insert into tblcart(ProductId,ProductQty,IsCheckOut) value('$pid','$pqty','$ischecout')");
 echo "<script>alert('Product has been added in to the cart');</script>"; 
  echo "<script>window.location.href = 'search.php'</script>";     
} else{
$msg="You can't add quantity more than Remaining quantity";

}





}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Inventory Management System|| Add Products</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="search.php" class="current">Search Products</a> </div>
    <h1>Search Products</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
           
            <div class="control-group">
              <label class="control-label">Search Product :</label>
              <div class="controls">
                <input type="text" class="span11" name="pname" id="pname" value="" required='true' />
              </div>
            </div>
          
           <div class="text-center">
                  <button class="btn btn-primary my-4" type="submit" name="search">Search</button>
                </div>
          </form>
            <br>
        </div>
   <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['pname'];
  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4> 
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Search Products</h5>
          </div>
          <div class="widget-content nopadding">
             
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Product Name</th>
                  <th>Category Name</th>
                   <th>SubCategory Name</th>
                  <th>Brand Name</th>
                  <th>Model Number</th>
                  <th>Stock</th>
                  <th>Remaining Stock</th>
                  <th> Buying Qty</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              
                <?php
$ret=mysqli_query($con,"select tblcategory.CategoryName,tblsubcategory.SubCategoryname as subcat,tblproducts.ProductName,tblproducts.BrandName,tblproducts.ID as pid,tblproducts.Status,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock,sum(tblcart.ProductQty) as selledqty from tblproducts join tblcategory on tblcategory.ID=tblproducts.CatID join tblsubcategory on tblsubcategory.ID=tblproducts.SubcatID left join tblcart  on tblproducts.ID=tblcart.ProductId where tblproducts.ProductName like '%$sdata%' group by tblproducts.ProductName");
$qty=$result['selledqty'];
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
$qty=$row['selledqty'];
?>
 <form name="cart" method="post">
                <tr class="gradeX">
                    <input type="hidden" name="pid" value="<?php echo $row['pid'];?>">
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['CategoryName'];?></td>
                  <td><?php  echo $row['subcat'];?></td>
                  <td><?php  echo $row['BrandName'];?></td>
                  <td><?php  echo $row['ModelNumber'];?></td>
                  <td><?php  echo $row['Stock'];?></td>
                   <td><?php  echo ($_SESSION['rqty']=$row['Stock']-$qty);?></td>
 <td><input type="number" name="pqty" value="1" required="true" style="width:40px;"></td>
                  <?php if($row['Status']=="1"){ ?>

                     <td><?php echo "Active"; ?></td>
<?php } else { ?>                  <td><?php echo "Inactive"; ?>
                  </td>
                  <?php } ?>
                 <td><button type="submit" name="cart" class="btn btn-primary my-4">Add to Cart</button></td>               
                </tr>
              </form>
                <?php 
$cnt=$cnt+1;
} }  else { ?>
  <tr>
    <td colspan="8"> No record found .</td>

  </tr>
   
<?php }} ?>
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

<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
</body>
</html>
<?php } ?>
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{



  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Inventory Management System|| Manage Products</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage-product.php" class="current">Manage Products</a> </div>
    <h1>Manage Products</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
     
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Products</h5>
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
                  <th>Status</th>
                  <th>Creation Date</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php
$ret=mysqli_query($con,"select tblcategory.CategoryName,tblsubcategory.SubCategoryname as subcat,tblproducts.ProductName,tblproducts.BrandName,tblproducts.ID as pid,tblproducts.Status,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock from tblproducts inner join tblcategory on tblcategory.ID=tblproducts.CatID inner join tblsubcategory on tblsubcategory.ID=tblproducts.SubcatID");

$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                <tr class="gradeX">
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['CategoryName'];?></td>
                  <td><?php  echo $row['subcat'];?></td>
                  <td><?php  echo $row['BrandName'];?></td>
                  <td><?php  echo $row['ModelNumber'];?></td>
                  <td><?php  echo $row['Stock'];?></td>
                  <?php if($row['Status']=="1"){ ?>

                     <td><?php echo "Active"; ?></td>
<?php } else { ?>                  <td><?php echo "Inactive"; ?>
                  </td>
                  <?php } ?>
                  <td><?php  echo $row['CreationDate'];?></td>
                  <td class="center"><a href="editproducts.php?editid=<?php echo $row['pid'];?>"><i class=" icon-edit"></i></a></td>
                </tr>
                <?php 
$cnt=$cnt+1;
}?> 
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
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $pname=$_POST['pname'];
    $category=$_POST['category'];
    $subcategory=$_POST['subcategory'];
    $bname=$_POST['bname'];
    $modelno=$_POST['modelno'];
    $stock=$_POST['stock'];
     $price=$_POST['price'];
    $status=$_POST['status'];
     
    $query=mysqli_query($con, "insert into tblproducts(ProductName,CatID,SubcatID,BrandName,ModelNumber,Stock,Price,Status) value('$pname','$category','$subcategory','$bname','$modelno','$stock','$price','$status')");
    if ($query) {
   
    echo '<script>alert("Product has been created.")</script>';
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
<title>Inventory Management System|| Add Products</title>
<?php include_once('includes/cs.php');?>
<script>
function getSubCat(val) {
  $.ajax({
type:"POST",
url:"get-subcat.php",
data:'catid='+val,
success:function(data){
$("#subcategory").html(data);
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-product.php" class="tip-bottom">Add Product</a></div>
  <h1>Add Product</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Product</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
           <div class="control-group">
              <label class="control-label">Product Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="pname" id="pname" value="" required='true' placeholder="Enter Product Name" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Category :</label>
              <div class="controls">
                <select type="text" class="span11" name="category" id="category" onChange="getSubCat(this.value)" value="" required='true' />
                   <option value="">Select Category</option>
                    <?php $query=mysqli_query($con,"select * from tblcategory where Status='1'");
              while($row=mysqli_fetch_array($query))
              {
              ?>      
                  <option value="<?php echo $row['ID'];?>"><?php echo $row['CategoryName'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sub Category Name: :</label>
              <div class="controls">
                <select type="text" class="span11" name="subcategory" id="subcategory" value="" required='true' />
                  <option value="">Select Sub Category</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Brand Name: :</label>
              <div class="controls">
                <select type="text" class="span11" name="bname" id="bname" value="" required='true' />
                  <option value="">Select Brand</option>
                  <?php $query1=mysqli_query($con,"select * from tblbrand where Status='1'");
              while($row1=mysqli_fetch_array($query1))
              {
              ?>
                  <option value="<?php echo $row1['BrandName'];?>"><?php echo $row1['BrandName'];?></option><?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Model Number :</label>
              <div class="controls">
                <input type="text" class="span11"  name="modelno" id="modelno" value="" required="true" maxlength="5" placeholder="Enter Model Number" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Stock(units) :</label>
              <div class="controls">
                <input type="text" class="span11"  name="stock" id="stock" value="" required="true" placeholder="Enter Stock" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Price(perunits) :</label>
              <div class="controls">
                <input type="text" class="span11" name="price" id="price" value="" required="true" placeholder="Enter Price" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <input type="checkbox"  name="status" id="status" value="1" required="true" />
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
<?php include_once('includes/js.php');?>
</body>
</html>
<?php } ?>
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $eid=$_GET['editid'];
    $pname=$_POST['pname'];
    $category=$_POST['category'];
    $subcategory=$_POST['subcategory'];
    $bname=$_POST['bname'];
    $modelno=$_POST['modelno'];
    $stock=$_POST['stock'];
     $price=$_POST['price'];
    $status=$_POST['status'];
     
    $query=mysqli_query($con, "update tblproducts set ProductName='$pname',CatID='$category',SubcatID='$subcategory',BrandName='$bname',ModelNumber='$modelno',Stock='$stock',Price='$price',Status='$status' where ID='$eid'");
    if ($query) {
   
    echo '<script>alert("Product has been updated.")</script>';
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
<title>Inventory Management System|| Update Products</title>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <strong>Update Product</strong></div>
  <h1>Update Product</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Product</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
            <?php
            $eid=$_GET['editid'];
$ret=mysqli_query($con,"select tblcategory.CategoryName as catname,tblcategory.ID as catid,tblsubcategory.SubCategoryname as subcat,tblsubcategory.ID as scatid,tblproducts.ID as pid,tblproducts.ProductName,tblproducts.BrandName,tblproducts.Status,tblproducts.Price,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock from tblproducts inner join tblcategory on tblcategory.ID=tblproducts.CatID inner join tblsubcategory on tblsubcategory.ID=tblproducts.SubcatID where tblproducts.ID='$eid'");

$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
           <div class="control-group">
              <label class="control-label">Product Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="pname" id="pname" value="<?php echo $row['ProductName'];?>" required='true'/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Category :</label>
              <div class="controls">
                <select type="text" class="span11" name="category" id="category" onChange="getSubCat(this.value)" value="" required='true' />
                   <option value="<?php echo $row['catid'];?>"><?php echo $row['catname'];?></option>
                    <?php $query=mysqli_query($con,"select * from tblcategory where Status='1'");
              while($rw=mysqli_fetch_array($query))
              {
              ?>      
                  <option value="<?php echo $rw['ID'];?>"><?php echo $rw['CategoryName'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sub Category Name: :</label>
              <div class="controls">
                <select type="text" class="span11" name="subcategory" id="subcategory" value="" required='true' />
                  <option value="<?php echo $row['scatid'];?>"><?php echo $row['subcat'];?></option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Brand Name: :</label>
              <div class="controls">
                <select type="text" class="span11" name="bname" id="bname" value="" required='true' />
                  <option value="<?php echo $row['BrandName'];?>"><?php echo $row['BrandName'];?></option>
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
                <input type="text" class="span11"  name="modelno" id="modelno" value="<?php echo $row['ModelNumber'];?>" required="true" maxlength="5"  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Stock(units) :</label>
              <div class="controls">
                <input type="text" class="span11"  name="stock" id="stock" value="<?php echo $row['Stock'];?>" required="true"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Price(perunits) :</label>
              <div class="controls">
                <input type="text" class="span11" name="price" id="price" value="<?php echo $row['Price'];?>" required="true"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status :</label>
              <div class="controls">
                <?php  if($row['Status']=="1"){ ?>
                <input type="checkbox"  name="status" id="status" value="1"  checked="true"/>
                <?php } else { ?>
                  <input type="checkbox" value='1' name="status" id="status" />
                  <?php } ?>
              </div>
            </div>         
           <?php } ?>
            <div class="form-actions">
              <button type="submit" class="btn btn-success" name="submit">Update</button>
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
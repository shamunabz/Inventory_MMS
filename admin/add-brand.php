<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $brandname=$_POST['brandname'];
    $status=$_POST['status'];
     
    $query=mysqli_query($con, "insert into tblbrand(BrandName,Status) value('$brandname','$status')");
    if ($query) {
   
    echo '<script>alert("Brand has been created.")</script>';
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
<title>Inventory Management System|| Add Brand</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-brand.php" class="tip-bottom">Add Brand</a></div>
  <h1>Add Brand</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Brand</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
           
            <div class="control-group">
              <label class="control-label">Brand Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="brandname" id="brandname" value="" required='true' />
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
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    
    $tax=$_POST['tax'];
   
     
    $query=mysqli_query($con, "update tbltax set Tax='$tax'");
    if ($query) {
   
    echo '<script>alert("Tax has been updated.")</script>';
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
<title>Inventory Management System|| Update Tax</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-category.php" class="tip-bottom">Update Tax</a></div>
  <h1>Update Tax</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Update Tax</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
           <?php
 
$ret=mysqli_query($con,"select * from tbltax");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
            <div class="control-group">
              <label class="control-label">Tax :</label>
              <div class="controls">
                <input type="text" class="span11" name="tax" id="brandname" value="<?php  echo $row['Tax'];?>" required='true' />
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
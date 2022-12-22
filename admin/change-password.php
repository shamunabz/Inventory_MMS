<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
{
$adminid=$_SESSION['imsaid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$query=mysqli_query($con,"select ID from tbladmin where ID='$adminid' and   Password='$cpassword'");
$row=mysqli_fetch_array($query);
if($row>0){
$ret=mysqli_query($con,"update tbladmin set Password='$newpassword' where ID='$adminid'");

echo '<script>alert("Your password successully changed.")</script>';
} else {

echo '<script>alert("Your current password is wrong.")</script>';
}

}
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Inventory Management System|| Change Password</title>
<?php include_once('includes/cs.php');?>
<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
} 

</script>
</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="change-password.php" class="tip-bottom">Change Password</a></div>
  <h1>Change Password</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Change Password</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal" name="changepassword" onsubmit="return checkpass();">
            
            <div class="control-group">
              <label class="control-label">Current Password :</label>
              <div class="controls">
                <input type="password" class="span11" name="currentpassword" id="currentpassword" value="" required='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">New Password :</label>
              <div class="controls">
                <input type="password" class="span11" name="newpassword" id="newpassword" value="" required='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Confirm Password</label>
              <div class="controls">
                <input type="password"  class="span11" name="confirmpassword" id="confirmpassword" value=""/>
              </div>
            </div>
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
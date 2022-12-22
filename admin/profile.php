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
    $aname=$_POST['adminname'];
  $mobno=$_POST['contactnumber'];
  
     $query=mysqli_query($con, "update tbladmin set AdminName ='$aname', MobileNumber='$mobno' where ID='$adminid'");
    if ($query) {
    
    echo '<script>alert("Admin profile has been updated.")</script>';
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
<title>Inventory Management System|| Profile</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="profile.php" class="tip-bottom">Profile</a></div>
  <h1>Profile</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Profile</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
            <?php
$adminid=$_SESSION['imsaid'];
$ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
            <div class="control-group">
              <label class="control-label">Admin Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="adminname" id="adminname" value="<?php  echo $row['AdminName'];?>" required='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">User Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="username" id="username" value="<?php  echo $row['UserName'];?>" readonly="true" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Contact Number</label>
              <div class="controls">
                <input type="text"  class="span11"id="contactnumber" name="contactnumber" value="<?php  echo $row['MobileNumber'];?>" required='true' maxlength='10' patter='[0-9]+'  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email address :</label>
              <div class="controls">
                <input type="email" class="span11" id="email" name="email" class="form-control1 input-lg" value="<?php  echo $row['Email'];?>" readonly='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Registration Date:</label>
              <div class="controls">
                <input type="text" class="span11" value="<?php  echo $row['AdminRegdate'];?>" readonly="true" />
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
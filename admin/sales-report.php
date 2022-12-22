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
<title>Inventory Management System|| Sales Report</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<!--Header-part-->
<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="sales-report.php" class="tip-bottom">Sales Report</a></div>
  <h1>Sales Report</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Between Dates Sales Report</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal" action="sales-reports-details.php">
           
            <div class="control-group">
              <label class="control-label">From Date :</label>
              <div class="controls">
                <input type="date" class="span11" name="fromdate" id="fromdate" value="" required='true' />
              </div>
            </div>
         <div class="control-group">
              <label class="control-label">To Date :</label>
              <div class="controls">
                <input type="date" class="span11" name="todate" id="todate" value="" required='true' />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Request Type :</label>
              <div class="controls">
                <input type="radio" name="requesttype" value="mtwise" checked="true">Month wise
                  <input type="radio" name="requesttype" value="yrwise">Year wise
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success" name="submit">Submit</button>
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
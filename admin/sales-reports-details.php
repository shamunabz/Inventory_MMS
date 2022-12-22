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
<title>Inventory Management System|| Sales Report Details</title>
<?php include_once('includes/cs.php');?>
</head>
<body>

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="sales-report.php" class="current">Sales Report Details</a> </div>
    <h1>Sales Report Details</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
     
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<?php if($rtype=='mtwise'){
$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>
 <h5 style="color: blue;font-size: 15px">Sales Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h5>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Month / Year </th>
                  <th>Product Name</th>
                  <th>Model Number</th>
                  <th>Qty Sold</th>
                  <th>Per Unit Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
$ret=mysqli_query($con,"select month(tblcart.CartDate) as lmonth,year(tblcart.CartDate) as lyear,tblproducts.ProductName,tblproducts.Price,tblproducts.BrandName,tblproducts.ID as pid,tblproducts.Status,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock,sum(tblcart.ProductQty) as selledqty from tblproducts left join tblcart  on tblproducts.ID=tblcart.ProductId where date(tblcart.CartDate) between '$fdate' and '$tdate' group by lmonth,lyear, tblproducts.ProductName");
$qty=$result['selledqty'];
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
$qty=$row['selledqty'];
?>
                <tr class="gradeX">
                  <td><?php echo $cnt;?></td>
                   <td><?php  echo $row['lmonth']."/".$row['lyear'];?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['ModelNumber'];?></td>
                 <td><?php  echo $qty=$row['selledqty'];?></td>
                  <td><?php  echo $ppunit=$row['Price'];?></td>
                  <td><?php  echo ($total=$qty*$ppunit)?></td>
                                  
                </tr>
               <?php 
$gtotal+=$total;                
$cnt=$cnt+1;
}?>
 <tr>
<th colspan="6" style="text-align: center;color: red;font-size: 15px">Grand Total</th>  
<th style="text-align: center;color: red;font-size: 15px"><?php echo $gtotal;?></th>  
</tr>
</tbody></table>
<?php } } else {
$year1=strtotime($fdate);
$year2=strtotime($tdate);
$y1=date("Y",$year1);
$y2=date("Y",$year2);
 ?>
 <h5 style="color: blue;font-size: 15px">Sales Report  from year <?php echo $y1;?> to year <?php echo $y2;?></h5>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Year</th>
                  <th>Product Name</th>
                  <th>Model Number</th>
                  <th>Qty Sold</th>
                  <th>Per Unit Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
$ret=mysqli_query($con,"select year(tblcart.CartDate) as lyear,tblproducts.ProductName,tblproducts.Price,tblproducts.BrandName,tblproducts.ID as pid,tblproducts.Status,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock,sum(tblcart.ProductQty) as selledqty from tblproducts left join tblcart  on tblproducts.ID=tblcart.ProductId where date(tblcart.CartDate) between '$fdate' and '$tdate' group by lyear, tblproducts.ProductName");
$qty=$result['selledqty'];
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
$qty=$row['selledqty'];
?>
                <tr class="gradeX">
                  <td><?php echo $cnt;?></td>
                   <td><?php  echo $row['lyear'];?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['ModelNumber'];?></td>
                 <td><?php  echo $qty=$row['selledqty'];?></td>
                  <td><?php  echo $ppunit=$row['Price'];?></td>
                  <td><?php  echo ($total=$qty*$ppunit)?></td>
                                  
                </tr>
               <?php 
$gtotal+=$total;                
$cnt=$cnt+1;
}?>
 <tr>
<th colspan="6" style="text-align: center;color: red;font-size: 15px">Grand Total</th>  
<th style="text-align: center;color: red;font-size: 15px"><?php echo $gtotal;?></th>  
</tr>
</tbody></table>
<?php } }?>

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
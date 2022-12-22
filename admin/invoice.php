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
<title>Inventory Management System|| Invoice</title>
<?php include_once('includes/cs.php');?>
<script type="text/javascript">

function print1(strid)
{
if(confirm("Do you want to print?"))
{
var values = document.getElementById(strid);
var printing =
window.open('','','left=0,top=0,width=550,height=400,toolbar=0,scrollbars=0,sta­?tus=0');
printing.document.write(values.innerHTML);
printing.document.close();
printing.focus();
printing.print();

}
}
</script>
</head>
<body>

<?php include_once('includes/header.php');?>
<?php include_once('includes/sidebar.php');?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage-category.php" class="current">Invoice</a> </div>
    <h1>Invoice</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12" id="print2">
        
        <h3 class="mb-4">Invoice #<?php echo $_SESSION['invoiceid']?></h3>
<?php     

$billingid=$_SESSION['invoiceid'];
$ret=mysqli_query($con,"select distinct tblcustomer.CustomerName,tblcustomer.MobileNumber,tblcustomer.ModeofPayment,tblcustomer.BillingDate from tblcart join tblcustomer on tblcustomer.BillingNumber=tblcart.BillingId where tblcustomer.BillingNumber='$billingid'");

while ($row=mysqli_fetch_array($ret)) {
?>

  <div class="table-responsive">
    <table class="table align-items-center" width="100%" border="1">
            <tr>
<th>Customer Name:</th>
<td> <?php  echo $row['CustomerName'];?>  </td>
<th>Customer Number:</th>
<td> <?php  echo $row['MobileNumber'];?>  </td>
</tr>

<tr>
<th>Mode of Payment:</th>
<td colspan="3"> <?php  echo $row['ModeofPayment'];?>  </td>

</tr>
</table>

</div>
<?php } ?>
     
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products Inventory</h5>
          </div>
          <div class="widget-content nopadding" width="100%" border="1">
            <table class="table table-bordered data-table" style="font-size: 15px">
              <thead>
                <tr>
                  <th style="font-size: 12px">S.NO</th>
                  <th style="font-size: 12px">Product Name</th>
                  <th style="font-size: 12px">Model Number</th>
                  <th style="font-size: 12px">Quantity</th>
                  <th style="font-size: 12px">Price(per unit)</th>
                  <th style="font-size: 12px">Total</th>
                 
                </tr>
              </thead>
              <tbody>
              
                <?php
$ret=mysqli_query($con,"select tblcategory.CategoryName,tblsubcategory.SubCategoryname as subcat,tblproducts.ProductName,tblproducts.BrandName,tblproducts.ID as pid,tblproducts.Status,tblproducts.CreationDate,tblproducts.ModelNumber,tblproducts.Stock,tblproducts.Price,tblcart.ProductQty from tblproducts join tblcategory on tblcategory.ID=tblproducts.CatID join tblsubcategory on tblsubcategory.ID=tblproducts.SubcatID left join tblcart  on tblproducts.ID=tblcart.ProductId where tblcart.BillingId='$billingid'");
$cnt=1;

while ($row=mysqli_fetch_array($ret)) {

?>

                <tr>
                    
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['ProductName'];?></td>
                  <td><?php  echo $row['ModelNumber'];?></td>
                  <td><?php  echo($pq= $row['ProductQty']);?></td>
                  <td><?php  echo ($ppu=$row['Price']);?></td>
                   <td><?php  echo($total=$pq*$ppu);?></td>
                </tr>
                <?php 
$cnt=$cnt+1;
$gtotal+=$total;
}?>
 <tr>
                  <th colspan="5" style="text-align: center;color: red;font-weight: bold;font-size: 15px">  Grand Total</th>
                  <th colspan="4" style="text-align: center;color: red;font-weight: bold;font-size: 15px"><?php  echo $gtotal;?></th>
                </tr>
              </tbody>
            </table>
             <p style="text-align: center; padding-top: 30px"><input type="button"  name="printbutton" value="Print" onclick="return print1('print2')"/></p>

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
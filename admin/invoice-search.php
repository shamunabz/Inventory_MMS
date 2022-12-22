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
<title>Inventory Management System|| Search Invoice</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="invoice-search.php" class="current">Search Invoice</a> </div>
    <h1>Search Invoice</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      <div class="widget-content nopadding">
          <form method="post" class="form-horizontal">
           
            <div class="control-group">
              <label class="control-label">Search Invoice :</label>
              <div class="controls">
                <input type="text" class="span11" name="searchdata" id="searchdata" value="" required='true' placeholder="Search by Billing Number or Mobile Number"/>
              </div>
            </div>
          
           <div class="text-center">
                  <button class="btn btn-primary my-4" type="submit" name="search">Search</button>
                </div>
          </form>
            <br>
        </div>
      
        <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
             <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>
     <div id="print2">     
<?php     

$billingid=$_SESSION['invoiceid'];
$ret=mysqli_query($con,"select distinct tblcustomer.CustomerName,tblcustomer.MobileNumber,tblcustomer.ModeofPayment,tblcustomer.BillingDate,tblcustomer.BillingNumber from tblcart join tblcustomer on tblcustomer.BillingNumber=tblcart.BillingId where (tblcustomer.BillingNumber='$sdata' || tblcustomer.MobileNumber='$sdata')");

while ($row=mysqli_fetch_array($ret)) {
?>
<h3 class="mb-4">Invoice #<?php  echo $invoiceid=$row['BillingNumber'];?></h3>
  <div class="table-responsive">
    <table class="table align-items-center"  border="1" width="100%">
            <tr>
<th style="font-size: 12px">Customer Name:</th>
<td style="font-size: 12px"> <?php  echo $row['CustomerName'];?>  </td>
<th style="font-size: 12px">Customer Mobile Number:</th>
<td style="font-size: 12px"> <?php  echo $row['MobileNumber'];?>  </td>
</tr>

<tr>
<th style="font-size: 12px">Mode of Payment:</th>
<td colspan="3" style="font-size: 12px"> <?php  echo $row['ModeofPayment'];?>  </td>

</tr>
</table>

</div>
<?php } ?>
     
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products Details</h5>
          </div>
          <div class="widget-content nopadding"  border="1" width="100%">
            <table class="table table-bordered" style="font-size: 15px">
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
                ;
$ret=mysqli_query($con,"select tblproducts.ProductName,tblproducts.ID as pid,tblproducts.ModelNumber,tblproducts.Price,tblcart.ProductQty from tblcart join tblproducts on tblcart.ProductId=tblproducts.ID join tblcustomer on tblcustomer.BillingNumber=tblcart.BillingId where tblcart.BillingId='$invoiceid' && (tblcustomer.BillingNumber='$sdata' || tblcustomer.MobileNumber='$sdata')");
$num=mysqli_num_rows($ret);
if($num>0){
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
                  <th style="text-align: center;color: red;font-weight: bold;font-size: 15px"><?php  echo $gtotal;?></th>
                </tr>
                <?php } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
   
<?php } ?>
              </tbody>
            </table>
              <p style="text-align: center; padding-top: 30px"><input type="button"  name="printbutton" value="Print" onclick="return print1('print2')"/></p>
<?php } ?>          </div>
        </div>
</div>
        <!---print end --->
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
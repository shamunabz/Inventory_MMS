<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['product'])){
$pid=$_POST['product'];


  $query=mysqli_query($con,"select  Price from tblproducts where ID='$pid' && Status='1'");
    while($rw=mysqli_fetch_array($query))
    { ?>
      
<option value="<?php echo $rw['Price'];?>"> <?php echo $rw['Price'];?></option>

                  
<?php }}} ?>
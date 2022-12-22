<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['imsaid']==0)) {
  header('location:logout.php');
  } else{

 if(isset($_POST['catid'])){
 $cid=$_POST['catid'];

  $query=mysqli_query($con,"select * from tblsubcategory where CatID='$cid' && Status='1'");
    while($rw=mysqli_fetch_array($query))
    {
     ?>      
 <option value="<?php echo $rw['ID'];?>"><?php echo $rw['SubCategoryname'];?></option>
                  

<?php }}} ?>
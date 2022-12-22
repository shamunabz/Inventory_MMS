<!--Header-part-->
<div id="header">
  <h2 style="padding-top: 20px;padding-left: 10px"><a href="dashboard.php"><strong style="color: red">IMS Admin</strong></a></h2>
</div>
<!--close-Header-part-->
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <?php

$ret=mysqli_query($con,"select AdminName from tbladmin");
$row=mysqli_fetch_array($ret);
$name=$row['AdminName'];

?>
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $name; ?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="profile.php"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="change-password.php"><i class="icon-check"></i> Setting</a></li>
        <li class="divider"></li>
        <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <?php $ret=mysqli_query($con,"Select * from tblcart where IsCheckOut='0'");
$cartcountcount=mysqli_num_rows($ret);
?>

    <li id="menu-messages"><a href="cart.php" data-target="#menu-messages" ><i class="icon icon-shopping-cart" style="color: white;font-size: 15px"></i> <span class="text" style="font-size: 15px">Cart</span> <span class="label label-important"><?php echo htmlentities($cartcountcount);?></span><b class="caret"></b></a>
     
    </li>
    <li class=""><a title="" href="change-password.php"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

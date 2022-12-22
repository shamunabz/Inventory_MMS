<!--sidebar-menu-->
<div id="sidebar">
  <ul>
    <li class="active"><a href="dashboard.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Category</span></a>
      <ul>
       
        <li><a href="add-category.php">Add Category</a></li>
        <li><a href="manage-category.php">Manage Category</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-inbox"></i> <span>Sub Category</span></a>
      <ul>
       
        <li><a href="add-subcategory.php">Add Sub Category</a></li>
        <li><a href="manage-subcategory.php">Manage Sub Category</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Brand</span></a>
      <ul>
        <li><a href="add-brand.php">Add Brand</a></li>
        <li><a href="manage-brand.php">Manage Brand</a></li>
       
      </ul>
    </li>
    
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Product</span></a>
      <ul>
        <li><a href="add-product.php">Add Product</a></li>
        <li><a href="manage-product.php">Manage Product</a></li>
        
      </ul>
    </li>
    <li> <a href="inventory.php"><i class="icon icon-info-sign"></i> <span>Inventory</span></a>
      
    </li>


    <li> <a href="cart.php"><i class="icon-shopping-cart"></i> <span>Cart</span><span class="label label-important"><?php echo htmlentities($cartcountcount);?></span></a>
      
    </li>
    <li> <a href="search.php"><i class="icon-search"></i> <span>Search</span></a>
      
    </li>
    <li> <a href="invoice-search.php"><i class="icon-search"></i> <span>Search Invoice</span></a>
      
    </li>
    <li> <a href="customer-details.php"><i class="icon-group"></i> <span>Customer Detail</span></a>
      
    </li>
   <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Report</span></a>
      <ul>
       
        <li><a href="stock-report.php">Stock Report</a></li>
        <li><a href="sales-report.php">Sales Report</a></li>
      </ul>
    </li>
    
  </ul>
</div>
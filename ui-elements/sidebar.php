<div class="sidebar" data-color="azure" data-background-color="black" data-image="http://localhost/ims/assets/img/sidebar-4.jpg">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="index.php" class="simple-text logo-normal">
            IMS
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item <?php if($title === 'Supplier') echo 'active'; ?>">
                <a class="nav-link"  href="http://localhost/ims/supplier.php">
                    <i class="fa fa-users material-icons"></i>
                    <!-- <i class="material-icons">person</i> -->
                    <p>Suppliers</p>
                </a>
            </li>
            <li class="nav-item <?php if($title === 'Customer') echo 'active'; ?>">
                <a class="nav-link" href="http://localhost/ims/customer.php">
                    <i class="fa fa-user material-icons"></i>
                    <!-- <i class="material-icons">person</i> -->
                    <p>Customers</p>
                </a>
                <!-- <a class="nav-link" data-toggle="collapse" href="#test">
                    <i class="fa fa-user material-icons"></i>
                    <i class="material-icons">person</i> 
                    <p>Customers<b class="caret"></b></p>

                </a>

                <div class="collapse" id="test">
                    
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/pricing.html">
                              <span class="sidebar-mini"> P </span>
                              <span class="sidebar-normal"> Pricing </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="../examples/pages/rtl.html">
                              <span class="sidebar-mini"> RS </span>
                              <span class="sidebar-normal"> RTL Support </span>
                            </a>
                        </li>
                    </ul>
                </div> -->

            </li>
            <li class="nav-item <?php if($title === 'Product') echo 'active'; ?>">
                <a class="nav-link" href="http://localhost/ims/product.php">
                    <i class="fa fa-product-hunt material-icons"></i>
                    <!-- <i class="material-icons">person</i> -->
                    <p>Products</p>
                </a>
            </li>
            <li class="nav-item <?php if($title === 'Billing') echo 'active'; ?>">
                <a class="nav-link" href="http://localhost/ims/billing.php">
                    <!-- <i class="fa fa-file-text"></i> -->
                    <i class="material-icons">content_paste</i>
                    <p>Billing</p>
                </a>
            </li>
            <li class="nav-item <?php if($title === 'Invoice' || $title === 'View Invoice') echo 'active'; ?>">
                <a class="nav-link" href="http://localhost/ims/view-invoice.php">
                    <!-- <i class="fa fa-file-text"></i> -->
                    <i class="material-icons">insert_drive_file</i>
                    <p>Invoice</p>
                </a>
            </li>
        </ul>
    </div>
</div>
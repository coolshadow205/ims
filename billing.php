<!-- This the page that will be shown when you click on supplier in the sidebar -->
<!doctype html>
<html lang="en">
<?php
    $title = "Billing";
    require_once("ui-elements/header.php");
    require_once("classes/Customer.php");
    require_once("classes/Product.php");
?>
<body class="">
    <div class="wrapper">
        <!-- Start Sidebar -->
        <?php require_once("ui-elements/sidebar.php"); ?>
        <!-- End Sidebar -->
        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once("ui-elements/navigation.php"); ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <!-- row #view-product -->
                    <div class="row" id="view-product" >
                        <div class="col-md-6" id="adding-cart-div">
                            <!-- card -->
                            <div class="card">
                                <!-- card-header -->
                                <div class="card-header card-header-success">
                                    <h4 class="card-title mt-0"> Add Product to Cart</h4>
                                    <p class="card-category">Select Product</p>
                                </div>
                                <!-- /card-header -->
                                <div class="card-body">
                                    <form role="form" id="adding-cart-form" method="POST">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-success">
                                                    <label class="bmd-label-floating" for="prod_id" >Product Name</label>
                                                    <select class="custom-select" id="prod_id" name="prod_id" onchange="showPriceOfProduct();">
                                                        <option value="" disabled selected>Select Product Name</option>
                                                        <?php  
                                                            $product = new Product();
                                                            //Code to show product.
                                                            $result_set = $product->getAllProduct("prod_id ,prod_name");
                                                            while($row = mysqli_fetch_assoc($result_set)){
                                                        ?>
                                                        <option value="<?php echo $row['prod_id']; ?>"><?php echo $row['prod_name']; ?></option>
                                                    <?php }//END OF WHILE ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="bmd-label-floating">Quantity</label>
                                                    <input type="text" class="form-control" id="quantity" name="quantity">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <label class="bmd-label-floating">Price</label>
                                                    <input type="text" class="form-control" id="price" name="price" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right"><i class="material-icons">add_shopping_cart</i>&nbsp;Add Cart</button>
                                            <a class="btn btn-success pull-left" style="" onclick="checkingOut(event);"><i class="material-icons">shopping_cart</i>&nbsp;Check Out</a>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="cart-table-div">
                            <!-- card -->
                            <div class="card">
                                <!-- card-header -->
                                <div class="card-header card-header-success">
                                    <h4 class="card-title mt-0"> Your Cart</h4>
                                    <p class="card-category">Selected Products</p>
                                </div>
                                <!-- /card-header -->
                                <div class="card-body">
                                    <h6 style="text-align: center; font-size: 0.95rem;" id="no-product">No Products in cart currently!</h6>
                                    <div class="row">
                                        <div class="col-md-12 d-none" id="cart-table">
                                            <div class="row">
                                                <div class="col-md-6 d-none" id="customer-selector">
                                                    <div class="form-group has-success">
                                                        <label class="bmd-label-floating" for="cust_id" >Customer Name</label>
                                                        <select class="custom-select" id="cust_id" name="cust_id" onchange="removeDanger(this);">
                                                            <option value="" disabled selected>Select Customer Name</option>
                                                            <?php  
                                                                $customer = new Customer();
                                                                //Code to show product.
                                                                $selectedCustomer = $customer->getAllCustomer(" cust_id , cust_fname, cust_lname");
                                                                while($row = mysqli_fetch_assoc($selectedCustomer)){
                                                            ?>
                                                            <option value="<?php echo $row['cust_id']; ?>"><?php echo $row['cust_fname']." ".$row['cust_lname']; ?></option>
                                                        <?php }//END OF WHILE ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead class="text-success">
                                                                <tr id="cart-table-head">
                                                                    <th>Product Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="cart-table-body">
                                                                <!-- LOADING CONTENT THROUGH AJAX -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <a href="" class="btn btn-success pull-left">Generate Bill</a> -->
                                            <!-- <div class="clearfix"></div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                     
                    
            </div>
            <?php require_once("ui-elements/footer.php") ?>

        </div>
    </div>
    <?php require_once("ui-elements/script-footer.php"); ?>
</body>
</html>
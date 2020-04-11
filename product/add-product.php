<!doctype html>
<html lang="en">
<?php
    $title = "Product";
    require_once("../ui-elements/header.php");
    require_once("../classes/Supplier.php");
    $supplier = new Supplier();
?>
<body class="">
    <div class="wrapper ">
        <!-- Start Sidebar -->
        <?php require_once("../ui-elements/sidebar.php"); ?>
        <!-- End Sidebar -->
        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once("../ui-elements/navigation.php"); ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <!-- your content here -->
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Add Product</h4>
                                    <p class="card-category">Fill All The Details Of Product</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="product" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Product Name</label>
                                                    <input type="text" class="form-control" id="prod_name" name="prod_name" autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Product Compamy Name</label>
                                                    <input type="text" class="form-control" id="prod_company_name" name="prod_company_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Quantity</label>
                                                    <input type="text" class="form-control" id="quantity" name="quantity">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Price</label>
                                                    <input type="text" class="form-control" id="price" name="price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating" for="supp_id" >Supplier Name</label>
                                                    <select class="custom-select" id="supp_id" name="supp_id">
                                                        <option value="" disabled selected>Select Supplier Name</option>
                                                        <?php  
                                                            //Code to show supplier.
                                                            $result_set = $supplier->getAllSupplier("supp_id ,supp_fname , supp_lname");
                                                            while($row = mysqli_fetch_assoc($result_set)){
                                                        ?>
                                                        <option value="<?php echo $row['supp_id']; ?>"><?php echo $row['supp_fname']." ".$row['supp_lname']; ?></option>
                                                    <?php }//END OF WHILE ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-success pull-right" >Add Product</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <?php require_once("../ui-elements/footer.php") ?>
        </div>
    </div>
    <?php require_once("../ui-elements/script-footer.php"); ?>
</body>
</html>
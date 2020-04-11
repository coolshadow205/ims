<!-- This the page that will be shown when you click on supplier in the sidebar -->
<!doctype html>
<html lang="en">
<?php
    $title = "Product";
    require_once("ui-elements/header.php");
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
                        <div class="col-md-12">
                            <!-- The below a tag is used to call add-product.php which is product file -->
                            <a class="btn btn-info pull-right" href="product/add-product.php">
                                <i class="material-icons">add</i>
                                Add Product
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <!-- card card-plain -->
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header card-header-info">
                                <h4 class="card-title mt-0"> Manage Product</h4>
                                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                            </div>
                            <!-- /card-header -->

                        <!-- card-body -->
                            <div class="card-body col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-img">
                                        <thead>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Company Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Edit</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $product = new Product();
                                                $seletced_product = $product->getAllProduct("prod_id , prod_name , prod_company_name , quantity , price");
                                                $id = 1;
                                                while($row = mysqli_fetch_assoc($seletced_product)){
                                            ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $row['prod_name']; ?></td>
                                                <td><?php echo $row['prod_company_name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <!-- editProductClicked(); is in the scripts.js which is in 'assets/js/scripts.js' -->
                                                <td><a href="" class="btn btn-sm btn-primary" onclick="editProductClicked(event , <?php echo $row['prod_id']; ?> , 'view-product');"><i class="material-icons">edit</i>    </a></td>
                                            </tr>
                                            <?php
                                                    $id++;
                                                }//END OF WHILE LOOP
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- card-body -->
                    </div>
                    <!-- /row#view-product -->
                    <!-- When user clicks edit button, this edit-product is shown and the view-product-table is hidden -->
                    <!-- row #edit-product -->
                    <div class="row d-none" id="edit-product" >
                        <?php require_once("product/edit-product.php") ?>
                    </div>  
                    <!-- /row #edit-product -->

                </div>                     
                    
            </div>
            <?php require_once("ui-elements/footer.php") ?>

        </div>
    </div>
    <?php require_once("ui-elements/script-footer.php"); ?>
</body>
</html>
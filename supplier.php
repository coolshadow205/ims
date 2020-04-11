<!-- This the page that will be shown when you click on supplier in the sidebar -->
<!doctype html>
<html lang="en">
<?php
    $title = "Supplier";
    require_once("ui-elements/header.php");
    require_once("classes/Supplier.php");
?>
<body class="">
    <div class="wrapper ">
        <!-- Start Sidebar -->
        <?php require_once("ui-elements/sidebar.php"); ?>
        <!-- End Sidebar -->
        <div class="main-panel">
            <!-- Navbar -->
            <?php require_once("ui-elements/navigation.php"); ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <!-- row #view-supplier -->
                    <div class="row" id="view-supplier" >
                        <div class="col-md-12">
                            <!-- The below a tag is used to call add-supplier.php which is supplier file -->
                            <a class="btn btn-info pull-right" href="supplier/add-supplier.php">
                                <i class="material-icons">add</i>
                                Add Supplier
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <!-- card card-plain -->
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header card-header-info">
                                <h4 class="card-title mt-0"> Manage Supplier</h4>
                                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                            </div>
                            <!-- /card-header -->

                            <!-- card-body -->
                            <div class="card-body col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-img">
                                        <thead>
                                            <th>ID</th>
                                            <th>Supplier Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $supplier = new Supplier();
                                                $result_set = $supplier->getAllSupplier("supp_id , supp_fname , supp_lname , supp_phone , supp_email");
                                                $id = 1;
                                                while($row = mysqli_fetch_assoc($result_set)){
                                            ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $row['supp_fname']." ".$row['supp_lname']; ?></td>
                                                <td><?php echo $row['supp_phone']; ?></td>
                                                <td><?php echo $row['supp_email']; ?></td>
                                                <!-- editSupplierClicked(); is in the scripts.js which is in 'assets/js/scripts.js' -->
                                                <td><a href="" class="btn btn-sm btn-primary" onclick="editSupplierClicked(event , <?php echo $row['supp_id']; ?> , 'view-supplier');"><i class="material-icons">edit</i>    </a></td>
                                                <td><a href="" class="btn btn-sm btn-danger" onclick="deleteSupplierClicked(event, <?php echo $row['supp_id']; ?> );"><i class="material-icons">delete</i></a></td>
                                            </tr>
                                            <?php
                                                    $id++;
                                                }//END OF WHILE LOOP
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <!-- card-body -->
                        </div>
                    </div>
                    <!-- /row#view-supplier -->
                    <!-- When user clicks edit button, this edit-supplier is shown and the view-supplier-table is hidden -->
                    <!-- row #edit-supplier -->
                    <div class="row d-none" id="edit-supplier" >
                        <?php require_once("supplier/edit-supplier.php") ?>
                    </div>  
                    <!-- /row #edit-supplier -->

                </div>                     
                    
            </div>
            <?php require_once("ui-elements/footer.php") ?>

        </div>
    </div>
    <?php require_once("ui-elements/script-footer.php"); ?>
</body>
</html>
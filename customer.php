<!-- This the page that will be shown when you click on customer in the sidebar -->
<!doctype html>
<html lang="en">
<?php
    $title = "Customer";
    require_once("ui-elements/header.php");
    require_once("classes/Customer.php");
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
                    <!-- row #view-customer -->
                    <div class="row" id="view-customer" >
                        <div class="col-md-12">
                            <!-- The below a tag is used to call add-cutomer.php which is customer file -->
                            <a class="btn btn-info pull-right" href="customer/add-customer.php">
                                <i class="material-icons">add</i>
                                Add Customer
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <!-- card card-plain -->
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header card-header-info">
                                <h4 class="card-title mt-0"> Manage Customer</h4>
                                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                            </div>
                            <!-- /card-header -->

                            <!-- card-body -->
                            <div class="card-body col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-img">
                                        <thead>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $customer = new Customer();
                                                $result_set = $customer->getAllCustomer("cust_id , cust_fname , cust_lname , cust_phone , cust_email");
                                                $id = 1;
                                                while($row = mysqli_fetch_assoc($result_set)){
                                            ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $row['cust_fname']." ".$row['cust_lname']; ?></td>
                                                <td><?php echo $row['cust_phone']; ?></td>
                                                <td><?php echo $row['cust_email']; ?></td>
                                                <!-- editSupplierClicked(); is in the scripts.js which is in 'assets/js/scripts.js' -->
                                                <td><a href="" class="btn btn-sm btn-primary" onclick="editCustomerClicked(event , <?php echo $row['cust_id']; ?> , 'view-customer' , this);"><i class="material-icons">edit</i>    </a></td>
                                                <td><a href="" class="btn btn-sm btn-danger" onclick="deleteCustomerClicked(event, <?php echo $row['cust_id']; ?> );"><i class="material-icons">delete</i></a></td>
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
                    </div>
                        <!-- card-body -->
                    </div>
                    <!-- /row#view-customer -->
                    <!-- When user clicks edit button, this edit-customer is shown and the view-customer-table is hidden -->
                    <!-- row #edit-customer -->
                    <div class="row d-none" id="edit-customer" >
                        <?php require_once("customer/edit-customer.php") ?>
                    </div>  
                    <!-- /row #edit-customer -->

                </div>                     
                    
            </div>
            <?php require_once("ui-elements/footer.php") ?>

        </div>
    </div>
    <?php require_once("ui-elements/script-footer.php"); ?>
</body>
</html>
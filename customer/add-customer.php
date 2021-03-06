<!doctype html>
<html lang="en">
<?php
    $title = "Customer";
    require_once("../ui-elements/header.php");
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
                                    <h4 class="card-title">Add customer</h4>
                                    <p class="card-category">Fill All The Details</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="customer" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">First Name</label>
                                                    <input type="text" class="form-control" id="cust_fname" name="cust_fname" autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Last Name</label>
                                                    <input type="text" class="form-control" id="cust_lname" name="cust_lname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating" >Email address</label>
                                                    <input type="email" class="form-control" id="cust_email" name="cust_email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Phone Number</label>
                                                    <input type="number" class="form-control" id="cust_phone" name="cust_phone">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Alternate Phone Number</label>
                                                    <input type="number" class="form-control" id="cust_alt_phone" name="cust_alt_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">State</label>
                                                    <input type="text" class="form-control" name="cust_state" id="cust_state">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">City</label>
                                                    <input type="text" class="form-control" name="cust_city" id="cust_city">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Area Zip Code</label>
                                                    <input type="number" class="form-control" id="cust_code" name="cust_code">
                                                    <!-- <input type="text" class="form-control" id="bus_address" name="bus_address"> -->
                                                </div>
                                            </div>                                 
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Address</label>
                                                    <input type="text" class="form-control" id="cust_address" name="cust_address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating" for="cust_gender" >Customer Gender</label>
                                                    <select class="custom-select" id="cust_gender" name="cust_gender">
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-success pull-right" >Add Customer</button>
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
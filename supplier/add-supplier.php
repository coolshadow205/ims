<!doctype html>
<html lang="en">
<?php
    $title = "Supplier";
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
                                    <h4 class="card-title">Add Supplier</h4>
                                    <p class="card-category">Fill All The Details</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" id="supplier" method="POST">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">First Name</label>
                                                    <input type="text" class="form-control" id="supp_fname" name="supp_fname" autofocus>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Last Name</label>
                                                    <input type="text" class="form-control" id="supp_lname" name="supp_lname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating" >Email address</label>
                                                    <input type="email" class="form-control" id="supp_email" name="supp_email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Phone Number</label>
                                                    <input type="number" class="form-control" id="supp_phone" name="supp_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Business Name</label>
                                                    <input type="text" class="form-control" id="bus_name" name="bus_name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Business Email Address</label>
                                                    <input type="email" class="form-control" id="bus_email" name="bus_email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Business Phone Number</label>
                                                    <input type="number" class="form-control" id="bus_phone" name="bus_phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-primary">
                                                    <label class="bmd-label-floating">Business Address</label>
                                                    <textarea class="form-control" id="bus_address" name="bus_address"></textarea>
                                                    <!-- <input type="text" class="form-control" id="bus_address" name="bus_address"> -->
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-success pull-right" >Add Supplier</button>
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
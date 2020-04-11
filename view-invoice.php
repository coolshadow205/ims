<!-- This the page that will be shown when you click on supplier in the sidebar -->
<!doctype html>
<html lang="en">
<?php
    $title = "View Invoice";
    require_once("ui-elements/header.php");
    require_once("classes/Invoice.php");
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
                    <!-- row #view-supplier -->
                    <div class="row">
                        <!-- card card-plain -->
                        <div class="card">
                            <!-- card-header -->
                            <div class="card-header card-header-info">
                                <h4 class="card-title mt-0"> Invoice</h4>
                                <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                            </div>
                            <!-- /card-header -->

                        <!-- card-body -->
                            <div class="card-body col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="table-img">
                                        <thead>
                                            <th>Invoice Number</th>
                                            <th>Customer Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Grand Total</th>
                                            <th>Date</th>
                                            <th>View</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $invoice = new Invoice();
                                                $customer = new Customer();
                                                $invoice_detail = $invoice->getAllInvoice("*");
                                                while($invoice_row = mysqli_fetch_assoc($invoice_detail)){
                                                     $customer_detail = $customer->getCustomer($invoice_row['cust_id'] ,"cust_fname , cust_lname , cust_email , cust_phone");
                                                        extract(mysqli_fetch_assoc($customer_detail));
                                            ?>
                                            <tr>
                                                <td><?php echo $invoice_row['invoice_number']; ?></td>
                                                <td><?php echo $cust_fname." ".$cust_lname; ?></td>
                                                <td><?php echo $cust_phone; ?></td>
                                                <td><?php echo $cust_email; ?></td>
                                                <td><?php echo $invoice_row['grand_total']; ?></td>
                                                <td><?php echo $invoice_row['invoice_date']; ?></td>
                                                <!-- editSupplierClicked(); is in the scripts.js which is in 'assets/js/scripts.js' -->
                                                <td><a href="invoice.php?invoice=<?php echo $invoice_row['invoice_number']; ?>" class="btn btn-sm btn-primary"><i class="material-icons">remove_red_eye</i>    </a></td>
                                            </tr>
                                            <?php }//END OF WHILE LOOP ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <!-- card-body -->
                        </div>
                    </div>
                    <!-- /row#view-supplier -->
                </div>                     
                    
            </div>
            <?php require_once("ui-elements/footer.php") ?>

        </div>
    </div>
    <?php require_once("ui-elements/script-footer.php"); ?>
</body>
</html>
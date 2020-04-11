<?php 
    if(!isset($_GET['invoice'])) {
        header("Location: supplier.php");
    }
    $invoice_number = $_GET['invoice'];
?>
<!doctype html>
<html>
<?php
    $title = "Invoice";
    require_once("classes/Invoice.php");
    require_once("classes/Sale.php");
    require_once("classes/Product.php");
    require_once("classes/Customer.php");
    require_once("ui-elements/header.php");
?>
<body>
    <!-- wrapper -->
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
                    <div class="invoice-box effect8">
                        <table cellpadding="0" cellspacing="0">
                            <tr class="top">
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td class="title">
                                                IMS
                                                <!-- Inventory Management System -->
                                            </td>
                                            <td>
                                                <?php
                                                    $invoice = new Invoice();

                                                    $invoice_detail = $invoice->getInvoice($invoice_number , "cust_id , grand_total , invoice_date");
                                                    extract(mysqli_fetch_assoc($invoice_detail));
                                                ?>
                                                <span style="font-weight: 800; ">Invoice #: <?php echo $invoice_number; ?></span><br>
                                                <?php
                                                    $parts = explode("-",$invoice_date);
                                                    $month = $invoice->convertMonth($parts[1]);
                                                    $date = $parts[2];
                                                    $year = $parts[0];
                                                ?>
                                                <?php echo $month." ".$date.", ".$year; ?><br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr class="information">
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td>
                                                Sparksuite, Inc.<br>
                                                12345 Sunny Road<br>
                                                Sunnyville, CA 12345
                                            </td>                                            
                                            <td>
                                                <?php
                                                    $customer = new Customer();
                                                    $customer_detail = $customer->getCustomer($cust_id,"cust_fname , cust_lname , cust_email , cust_phone");
                                                    extract(mysqli_fetch_assoc($customer_detail));
                                                ?>
                                                <?php echo $cust_fname." ".$cust_lname; ?>.<br>
                                                <?php echo $cust_phone; ?><br>
                                                <?php echo $cust_email; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            
                            <tr class="heading">
                                <td>Item</td>
                                <td>Quantity</td>
                                <td>Price</td>
                            </tr>
                            <?php
                                $sale = new Sale();
                                $product = new Product();
                                $sale_detail = $sale->getSale($invoice_number);
                                while($sale_row = mysqli_fetch_assoc($sale_detail)) {//START OF WHILE
                                    $prod_detail = $product->getProduct($sale_row['prod_id'] , "prod_name");
                                    extract(mysqli_fetch_assoc($prod_detail));
                            ?>
                            <tr class="item">
                                <td><?php echo $prod_name; ?></td>
                                <td><?php echo $sale_row['quantity']; ?></td>
                                <td><i class="fa fa-inr"></i> <?php $price = $sale_row['amount']*$sale_row['quantity'];  echo $price; ?></td>
                            </tr>
                            <?php }// END OF WHILE ?>

                            <tr class="total">
                                <td>Grand Total: </td>
                                <td></td>
                                <td><i class="fa fa-inr"></i> <?php echo $grand_total; ?></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /invoice-box -->
                </div>
            </div>
            <?php require_once("ui-elements/footer.php") ?>
        </div>
    </div>
    <!-- /wrapper -->
    <?php require_once("ui-elements/script-footer.php"); ?>
</body>
</html>

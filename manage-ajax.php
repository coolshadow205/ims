<?php 
	require_once("classes/Database.php");
	require_once("classes/Supplier.php");
	require_once("classes/Customer.php");
	require_once("classes/Product.php");
	require_once("classes/Invoice.php");
	require_once("classes/Sale.php");
	if(isset($_POST['manage'])) {
		/*------------------------- Code for managing different POST ajax requests -------------------------*/
		if($_POST['manage'] === "supplier") {
			/* Code for managing the login requests */
			$supp_fname = $_POST['supp_fname'];
			$supp_lname = $_POST['supp_lname'];
			$supp_email = $_POST['supp_email'];
			$supp_phone = $_POST['supp_phone'];
			$bus_name = $_POST['bus_name'];
			$bus_email = $_POST['bus_email'];
			$bus_phone = $_POST['bus_phone'];
			$bus_address = $_POST['bus_address'];
			$task = $_POST['task'];
			
			$supplier = new Supplier();
			if($task === 'add')
				$validation = $supplier->addSupplier($supp_fname , $supp_lname , $supp_email, $supp_phone , $bus_name , $bus_email , $bus_phone , $bus_address);
			else if($task === 'edit'){
				$supp_id = $_POST['supp_id'];
				$validation = $supplier->updateSupplier($supp_id , $supp_fname , $supp_lname , $supp_email, $supp_phone , $bus_name , $bus_email , $bus_phone , $bus_address);
			}
			echo $validation;
		}
		else if($_POST['manage'] === "edit_supplier_clicked"){
			// Code to send supplier detailed specified by the supp_id
			$supp_id = $_POST['supp_id'];

			$supplier = new Supplier();
		    $supplier_details = $supplier->getSupplier($supp_id, "*");// '*' for all columns.
		    extract(mysqli_fetch_assoc($supplier_details));
		    echo $supp_fname."`&`".$supp_lname."`&`".$supp_email."`&`".$supp_phone."`&`".$business_name."`&`".$business_email."`&`".$business_phone."`&`".$business_address; // spliting by `&`
		}
		else if ($_POST['manage'] === "delete_supplier_clicked"){
			//Code to delete the supplier specified by the supp_id
			$supp_id = $_POST['supp_id'];
			$supplier = new Supplier();
		    $validation = $supplier->deleteSupplier($supp_id);
		    echo $validation;
		}
		else if($_POST['manage'] === "product"){
			$prod_name = $_POST['prod_name'];
			$prod_company_name = $_POST['prod_company_name'];
			$quantity = $_POST['quantity'];
			$price = $_POST['price'];
			$task = $_POST['task'];

			$product = new Product();
			if($task === "add"){
				$supp_id = $_POST['supp_id'];
				$validation = $product->addProduct($supp_id , $prod_name , $prod_company_name , $quantity , $price, date("Y/m/d"));
			}
			else{
				$prod_id = $_POST['prod_id'];
				$validation = $product->updateProduct($prod_id , $prod_name, $prod_company_name, $quantity, $price);
			}
			echo $validation;
		}
		else if($_POST['manage'] === "edit_product_clicked"){
			// Code to send product detailed specified by the prod_id
			$prod_id = $_POST['prod_id'];

			$product = new Product();
		    $product_details = $product->getProduct($prod_id, "prod_id , prod_name , prod_company_name , quantity , price");// '*' for all columns.
		    extract(mysqli_fetch_assoc($product_details));

		    echo $prod_name."`&`".$prod_company_name."`&`".$quantity."`&`".$price; // spliting by `&`
		}
		else if($_POST['manage'] === "customer") {
			/* Code for managing the login requests */
			$cust_fname = $_POST['cust_fname'];
			$cust_lname = $_POST['cust_lname'];
			$cust_email = $_POST['cust_email'];
			$cust_phone = $_POST['cust_phone'];
			$cust_gender= $_POST['cust_gender'];
			$cust_alt_phone = $_POST['cust_alt_phone'];
			$cust_state=$_POST['cust_state'];
			$cust_city=$_POST['cust_city'];
			$cust_code=$_POST['cust_code'];
			$cust_address=$_POST['cust_address'];
			$task = $_POST['task'];
			
			$customer = new Customer();
			if($task === 'add')
				$validation = $customer->addCustomer($cust_fname , $cust_lname , $cust_email, $cust_phone , $cust_gender, $cust_alt_phone, $cust_state, $cust_city, $cust_code, $cust_address);
			else if($task === 'edit'){
				$cust_id = $_POST['cust_id'];
				$validation = $customer->updateCustomer($cust_id , $cust_fname , $cust_lname , $cust_email, $cust_phone , $cust_gender , $cust_alt_phone, $cust_state, $cust_city, $cust_code, $cust_address);
			}

			if($validation)
				echo "true";
			else
				echo "false";
		}
		else if($_POST['manage'] === "edit_customer_clicked"){
			// Code to send customer detailed specified by the cust_id
			$cust_id = $_POST['cust_id'];

			$customer = new Customer();
		    $customer_details = $customer->getCustomer($cust_id, "*");// '*' for all columns.
		    extract(mysqli_fetch_assoc($customer_details));
		    echo $cust_fname."`&`".$cust_lname."`&`".$cust_email."`&`".$cust_phone."`&`".$cust_gender."`&`".$cust_alt_phone."`&`".$cust_state."`&`".$cust_city."`&`".$cust_code."`&`".$cust_address; // spliting by `&`
		}
		else if ($_POST['manage'] === "delete_customer_clicked"){
			//Code to delete the supplier specified by the supp_id
			$cust_id = $_POST['cust_id'];
			$customer = new Customer();
		    $validation = $customer->deleteCustomer($cust_id);
		    echo $validation;
		}
		else if($_POST['manage'] === "product_price"){
			$prod_id = $_POST['prod_id'];

			$product = new Product();
			$product_details = $product->getProduct($prod_id, "quantity , price");
		    extract(mysqli_fetch_assoc($product_details));

		    echo $quantity."`&`".$price; // spliting by `&`
		}
		else if($_POST['manage'] === "product_quantity"){
			$prod_id = $_POST['prod_id'];

			$product = new Product();
			$product_details = $product->getProduct($prod_id, "quantity");
		    extract(mysqli_fetch_assoc($product_details));
		    
		    echo $quantity;
		}
		else if($_POST['manage'] === "generate_invoice"){

			$cust_id = $_POST['cust_id'];
			$grand_total = $_POST['grand_total'];

			$invoice = new Invoice();
			$invoice_number = $invoice->addInvoice($cust_id , $grand_total, date("Y/m/d"));
			echo $invoice_number;
		}
		else if($_POST['manage'] === "invoice_product") {
			
			$invoice_number = $_POST['invoice_number'];
			$prod_id = $_POST['prod_id'];
			$quantity = $_POST['quantity'];
			$amount = $_POST['amount'];

			$product = new Product();
			$prod_detail = $product->getProduct($prod_id , "quantity");
			$row = mysqli_fetch_assoc($prod_detail);
			$old_quantity = $row['quantity'];

			$new_quantity = $old_quantity - $quantity;
			$validation = $product->updateQuantity($prod_id , $new_quantity);

			if($validation === "true"){
				$sale = new Sale();
				$sale_id = $sale->addSale($invoice_number , $prod_id , $quantity, $amount);
				echo $sale_id;
			}
			else
				echo $validation;
		}
	}
?>
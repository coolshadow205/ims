<?php 
	/********************************************************************************************************
	******************************************** COMMENTS CLASS *********************************************
	********************************************************************************************************/

	/*    SCHEMA OF Products TABLE:
		  prod_id , supp_id , prod_name , prod_company_name , quantity , price , prod_date
	*/
	require_once("Database.php");

	class Product{

		private $connection;
        function __construct(){
            global $database;//The 'global' is used to refer the variable that is defined outside the funtion.
            $this->connection = $database->getConnection();
        }
        function getAllProduct($columns){
        	$sql = "SELECT $columns FROM products";
        	$result_set = $this->connection->query($sql);

			if($this->connection->errno) {
				die("Error while getting product details : ".$this->connection->errno);
			}
			return $result_set;
        }
        function getProduct($prod_id,$columns){
            $sql = "SELECT $columns FROM products WHERE prod_id = $prod_id";
            $result_set = $this->connection->query($sql);

            if($this->connection->errno) {
                die("Error while getting PRODUCT details : ".$this->connection->errno);
            }
            return $result_set;
        }
        function addProduct($supp_id , $prod_name , $prod_company_name , $quantity , $price , $date){

        	$sql = "INSERT INTO products(supp_id , prod_name , prod_company_name , quantity , price , prod_date ) VALUES(?,?,?,?,?,?)";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("isssds", $supp_id , $prod_name , $prod_company_name , $quantity , $price , $date);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE INSERTING PRODUCT: ".$this->connection->error);
        }
        function updateProduct($prod_id ,$prod_name , $prod_company_name , $quantity , $price){

        	$sql = "UPDATE products SET prod_name=? , prod_company_name=? , quantity=? , price=? WHERE prod_id = ?";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("sssdi", $prod_name , $prod_company_name , $quantity , $price , $prod_id);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE UPDATING PRODUCTS: ".$this->connection->error);	

        }
        function updateQuantity($prod_id , $quantity){
        	$sql = "UPDATE products SET quantity=? WHERE prod_id = ?";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("ii", $quantity , $prod_id);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE UPDATING PRODUCT QUANTITY: ".$this->connection->error);
        }
/*        function deleteProduct($prod_id){

        	$sql = "DELETE FROM products WHERE prod_id = ?";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
                die($this->connection->error);

            $preparedStatement->bind_param("i",$prod_id);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE DELETING PRODUCT: ".$this->connection->error);
        }*/
	}
	/*$pro = new Product();
    $result_set = $pro->addProduct(1 , "Prodcut name", "Company" , 15 , 20 , date("Y/m/d"));
    echo $result_set;*/
	/*$result_set = $pro->updateProduct(2,2,'i7','Intel',10,68000.00,'2018-10-14');
	echo $result_set;
	$row = mysqli_fetch_assoc($result_set);
	extract($row);
	echo "".$row['prod_name'];*/
	
?>
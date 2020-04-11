<?php 
	/********************************************************************************************************
	******************************************** COMMENTS CLASS *********************************************
	********************************************************************************************************/

	/*    SCHEMA OF Invoice TABLE:
		  sale_id , invoice_number , prod_id , quantity , amount.
	*/
	require_once("Database.php");
	require_once("Invoice.php");
    class Sale{
     	private $connection;
        function __construct(){
            global $database;//The 'global' is used to refer the variable that is defined outside the funtion.
            $this->connection = $database->getConnection();
        }
        function getSale($invoice_number){
        	$sql = "SELECT * FROM sales WHERE invoice_number = $invoice_number";
        	$result_set = $this->connection->query($sql);

			if($this->connection->errno) {
				die("Error while getting sale details : ".$this->connection->errno);
			}
			return $result_set;
        }
        function addSale($invoice_number , $prod_id , $quantity , $amount ){

        	
        	$sql = "INSERT INTO sales(invoice_number , prod_id , quantity , amount) VALUES(?,?,?,?)";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("iiid", $invoice_number , $prod_id , $quantity ,$amount );

            if($preparedStatement->execute())
            	return $this->connection->insert_id;
            else
                die("ERROR WHILE INSERTING SALES: ".$this->connection->error);
        }	
    }
	/*$sale = new Sale();
	$result_set = $sale->getSale(4);
	while($row = mysqli_fetch_assoc($result_set)){
		extract($row);
		echo $row['amount'];
	}
	$id = $sale->addSale(2,2,1300.63,3,1300.63,'2018-10-15');
	echo $id;*/
 ?>
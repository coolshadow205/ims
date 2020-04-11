<?php 
	/********************************************************************************************************
	******************************************** COMMENTS CLASS *********************************************
	********************************************************************************************************/

	/*    SCHEMA OF Customers TABLE:
		  cust_id , cust_fname , cust_lname , cust_email , cust_phone , cust_gender , cust_alt_phone , cust_state , cust_city , cust_code , cust_address
	*/
	require_once("Database.php");
	class Customer{
		
		private $connection;
        function __construct(){
            global $database;//The 'global' is used to refer the variable that is defined outside the funtion.
            $this->connection = $database->getConnection();
        }
        function getCustomer($cust_id,$columns){
        	$sql = "SELECT $columns FROM customers WHERE cust_id = $cust_id";
        	$result_set = $this->connection->query($sql);

			if($this->connection->errno) {
				die("Error while getting specific customer details : ".$this->connection->errno);
			}
			return $result_set;
        }
        function getAllCustomer($columns){
            $sql = "SELECT $columns FROM customers";
            $result_set = $this->connection->query($sql);

            if($this->connection->errno) {
                die("Error while getting all customer details : ".$this->connection->errno);
            }
            return $result_set;   
        }
        function addCustomer($cust_fname , $cust_lname , $cust_email , $cust_phone , $cust_gender , $cust_alt_phone , $cust_state , $cust_city , $cust_code , $cust_address){

        	$sql = "INSERT INTO customers(cust_fname , cust_lname , cust_email , cust_phone , cust_gender , cust_alt_phone , cust_state , cust_city , cust_code , cust_address ) VALUES(?,?,?,?,?,?,?,?,?,?)";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("ssssssssss", $cust_fname , $cust_lname , $cust_email , $cust_phone , $cust_gender , $cust_alt_phone , $cust_state , $cust_city , $cust_code , $cust_address );

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE INSERTING CUSTOMER: ".$this->connection->error);
        }
        function updateCustomer($cust_id , $cust_fname , $cust_lname , $cust_email , $cust_phone , $cust_gender , $cust_alt_phone , $cust_state , $cust_city , $cust_code , $cust_address){

        	$sql = "UPDATE customers SET cust_fname = ? , cust_lname = ? , cust_email = ? , cust_phone = ? , cust_gender = ? , cust_alt_phone = ? , cust_state = ? , cust_city = ? , cust_code = ? , cust_address = ? WHERE cust_id = ?";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("ssssssssssi", $cust_fname , $cust_lname , $cust_email , $cust_phone , $cust_gender , $cust_alt_phone , $cust_state , $cust_city , $cust_code , $cust_address , $cust_id );

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE INSERTING CUSTOMER: ".$this->connection->error);	

        }
        function deleteCustomer($cust_id){

        	$sql = "DELETE FROM customers WHERE cust_id = ?";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
                die($this->connection->error);

            $preparedStatement->bind_param("i",$cust_id);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE UPDATING CUSTOMER: ".$this->connection->error);
        }
	}
	/*$cus = new Customer();
	$id = $cus->updateCustomer(2 , 'Rahul ', 'Bhanu', 'rm1@gmail.com', '123', 'male', '123', 'Maharashtra', 'CST', '40002', '702, (W)');
	$result_set = $cus->getCustomer(1,"cust_fname");
	$row = mysqli_fetch_assoc($result_set);
	extract($row);
	echo "".$row['cust_fname'];*/
?>
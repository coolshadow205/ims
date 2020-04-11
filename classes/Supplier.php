<?php
	/********************************************************************************************************
	******************************************** COMMENTS CLASS *********************************************
	********************************************************************************************************/

	/*    SCHEMA OF Suppliers TABLE:
		  supp_id , supp_fname , supp_lname , supp_email , supp_phone , business_name , business_address , business_email , business_phone
	*/
	require_once("Database.php");
	class Supplier{

		private $connection;
        function __construct(){
            global $database;//The 'global' is used to refer the variable that is defined outside the funtion.
            $this->connection = $database->getConnection();
        }
        function getAllSupplier($columns){
            $sql = "SELECT $columns FROM suppliers";
            $result_set = $this->connection->query($sql);

            if($this->connection->errno) {
                die("Error while getting SUPPLIER details : ".$this->connection->errno);
            }
            return $result_set;
        }
        function getSupplier($supp_id,$columns){
        	$sql = "SELECT $columns FROM suppliers WHERE supp_id = $supp_id";
        	$result_set = $this->connection->query($sql);

			if($this->connection->errno) {
				die("Error while getting SUPPLIER details : ".$this->connection->errno);
			}
			return $result_set;
        }
        function addSupplier($supp_fname , $supp_lname , $supp_email , $supp_phone , $business_name  , $business_email , $business_phone , $business_address) {

        	$sql = "INSERT INTO suppliers(supp_fname , supp_lname , supp_email , supp_phone , business_name , business_address , business_email , business_phone ) VALUES(?,?,?,?,?,?,?,?)";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
                die($this->connection->error);

            $preparedStatement->bind_param("ssssssss", $supp_fname , $supp_lname , $supp_email , $supp_phone ,$business_name , $business_address , $business_email , $business_phone);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE INSERTING SUPPLIER: ".$this->connection->error);
        }
        function updateSupplier($supp_id , $supp_fname , $supp_lname , $supp_email , $supp_phone , $business_name  , $business_email , $business_phone , $business_address ){

        	$sql = "UPDATE suppliers SET supp_fname=?, supp_lname=?, supp_email=? , supp_phone=? , business_name=? , business_address=? , business_email=?, business_phone=?   WHERE supp_id=?";

			if(!($preparedStatement = $this->connection->prepare($sql)))
                die($this->connection->error);

            $preparedStatement->bind_param("ssssssssi", $supp_fname , $supp_lname , $supp_email , $supp_phone ,  $business_name , $business_address , $business_email , $business_phone , $supp_id );

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE UPDATING SUPPLIER: ".$this->connection->error);      	

        }
        function deleteSupplier($supp_id){

        	$sql = "DELETE FROM suppliers WHERE supp_id = ?";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
                die($this->connection->error);

            $preparedStatement->bind_param("i",$supp_id);

            if($preparedStatement->execute())
            	return "true";
            else
                die("ERROR WHILE DELETING SUPPLIER: ".$this->connection->error);
        }
	}
    // $sup = new Supplier();
    // $id = $sup->addSupplier("Jay","Craft","alexcraft@gmail.com","1334","dont know","email","789","NYC");    
    // echo $id;
	// $result_set = $sup->getSupplier(3,"supp_fname");
	// $row = mysqli_fetch_assoc($result_set);
	// extract($row);
	// echo "".$row['supp_fname'];*/
?>
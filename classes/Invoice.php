<?php 
	/********************************************************************************************************
	******************************************** COMMENTS CLASS *********************************************
	********************************************************************************************************/

	/*    SCHEMA OF Invoice TABLE:
		  invoice_number , cust_id , grand_total , invoice_date.
	*/
	require_once("Database.php");
	class Invoice{

		private $connection;
        function __construct(){
            global $database;//The 'global' is used to refer the variable that is defined outside the funtion.
            $this->connection = $database->getConnection();
        }
        function getAllInvoice($columns){

        	$sql = "SELECT $columns FROM invoice ORDER BY invoice_number DESC";
        	$result_set = $this->connection->query($sql);

			if($this->connection->errno) {
				die("Error while getting invoice details : ".$this->connection->errno);
			}
			return $result_set;
        }
        function getInvoice($invoice_number,$columns){
        	$sql = "SELECT $columns FROM invoice WHERE invoice_number = $invoice_number";
        	$result_set = $this->connection->query($sql);

			if($this->connection->errno) {
				die("Error while getting invoice details : ".$this->connection->errno);
			}
			return $result_set;
        }
        function addInvoice($cust_id , $grand_total , $invoice_date){

        	$sql = "INSERT INTO invoice(cust_id , grand_total , invoice_date) VALUES(?,?,?)";

        	if(!($preparedStatement = $this->connection->prepare($sql)))
        		die($this->connection->error);

            $preparedStatement->bind_param("ids", $cust_id , $grand_total , $invoice_date);

            if($preparedStatement->execute())
            	return $this->connection->insert_id;
            else
                die("ERROR WHILE INSERTING INVOICE: ".$this->connection->error);
        }
        function convertMonth($month_number){
        	switch ($month_number) {
                case '01':
                    return "January";
                case '02':
                    return "February";
                case '03':
                    return "March";
                case '04':
                    return "April";
                case '05':
                    return "May";
                case '06':
                    return "June";
                case '07':
                    return "July";
                case '08':
                    return "August";
                case '09':
                    return "September";
                case '10':
                    return "October";
                case '11':
                    return "November";
                case '12':
                    return "December";
            }
        }
	}
	/*$in = new Invoice();
	$result_set = $in->getInvoice(1);
	$row = mysqli_fetch_assoc($result_set);
	extract($row);
	echo $row['grand_total'];
	$id = $in->addInvoice(1,1200.63,'2018-10-18');
	echo $id;*/
?>
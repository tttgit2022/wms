<?php
class DBController {
	private $host = "localhost";
	private $user = "tlpkcom";
	private $password = "yXI1zlLf2@2P2*";
	private $database = "tlpkcom_royal_inventory";
	private $conn;
	
        function __construct() {
        $this->conn = $this->connectDB();
	}	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
        function runQuery($query) {
                $result = mysqli_query($this->conn,$query);
                while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
                }		
                if(!empty($resultset))
                return $resultset;
	}
}
?>
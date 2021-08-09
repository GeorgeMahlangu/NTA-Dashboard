<?php

Class Database{
 

	// $db = getenv("MYSQL_ADDON_DB");
	// // Get the database user from the environment
	// $user = getenv("MYSQL_ADDON_USER");
	// // Get the database password from the environment
	// $pass = getenv("MYSQL_ADDON_PASSWORD");
	// // This variable is injected during the deployment
	// $socket = getenv("CC_MYSQL_PROXYSQL_SOCKET_PATH");
	// $dsn = "mysql:unix_socket=$socket;dbname=$db";
	// try {
	// 	$pdo = new PDO($dsn, $user, $pass);
	// } catch (PDOException $e) {
	// 	throw new PDOException($e->getMessage(), (int)$e->getCode());
	// }
	private $server = "mysql:host=b89ljytnguxjaax35cy5-mysql.services.clever-cloud.com;dbname=b89ljytnguxjaax35cy5";
	private $username = "uj3q7ayl3rmapts0";
	private $password = "3FP6PV01guJDgUlOEJCq";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
 
?>
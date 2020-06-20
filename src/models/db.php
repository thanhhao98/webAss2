<?php
class DbBase {
	private $host = "sqlService";
	private $user = "haophan";
	private $pass = "977463";
	private $db_name = "Ass2";
	public $conn;
	public function __construct(){
		$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
	}
	public function connectSuccess(){
		if($this->conn->connect_error) {
			return false;
		} else {
			return true;
		}
	}
	public function query($sql){
		return $this->conn->query($sql);
	}
}


class Users {
	const NAME_TABLE = "Users";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, email, phone, password, isAdmin) VALUES (%s, %s, %s, %s, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createUser($name, $email, $phone, $password, $isAdmin=false){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $email, $phone, $password, $isAdmin);	
		return $this->db.query($sql);
	}
}

class Reservations {
	const NAME_TABLE = "Reservations";
	private $db;
	private $insertFormat = "INSERT INTO %s (user, numPersons, status, createTime, lastUpdatedByAdmin) VALUES (%d, %d, %s, %s, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservation($user, $numPersons, $status, $createTime, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $user, $numPersons, $status, $createTime, $lastUpdatedByAdmin);	
		return $this->db.query($sql);
	}
}

class ReservationItem {
	const NAME_TABLE = "ReservationItem";
	private $db;
	private $insertFormat = "INSERT INTO %s (reservation, dish, quantity) VALUES (%d, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservation($reservation, $dish, $quantity){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $reservation, $dish, $quantity);	
		return $this->db.query($sql);
	}
}

class Dishes{
	const NAME_TABLE = "Dishes";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, price, descriptions, image, status, lastUpdatedByAdmin) VALUES (%s, %d, %s, %s, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservation($name, $price, $descriptions, $image, $status, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $price, $descriptions, $image, $status, $lastUpdatedByAdmin);	
		return $this->db.query($sql);
	}
}

class Comments{
	const NAME_TABLE = "Comments";
	private $db;
	private $insertFormat = "INSERT INTO %s (user, content, createTime, visibility, lastUpdatedByAdmin) VALUES (%d, %s, %s, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservation($user, $content, $createTime, $visibility, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $user, $content, $createTime, $visibility, $lastUpdatedByAdmin);	
		return $this->db.query($sql);
	}
}

class Comments{
	const NAME_TABLE = "Infos";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, content, status, lastUpdatedByAdmin) VALUES (%s, %s, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservation($name, $content, $status, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $content, $status, $lastUpdatedByAdmin);	
		return $this->db.query($sql);
	}
}
?>

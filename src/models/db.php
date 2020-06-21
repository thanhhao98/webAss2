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
		return $this->db->query($sql);
	}
        public function getTotalUserCount(){
            $query = "SELECT COUNT(*) as `total` FROM `Users`"; 
            $result = $this->db->query($query);
            $total = $result->fetch_assoc()["total"];
            return $total;
        }
        public function getUserById($id){
            $query = "SELECT * FROM `Users` WHERE `id` = '$id'";
            $result = $this->db->query($query);
            $user = $result->fetch_assoc();
            return $user;
        }
        public function updateUserById($id, $name, $email, $phone, $password){
            $query = "UPDATE `Users` SET `name`= '$name', `email`= '$email', `phone`= '$phone', `password`= '$password' WHERE `id` = '$id'";
            $result = $this->db->query($query);
            return $result;
        }
        public function deleteUserById($id){
            $query = "DELETE FROM `Users` WHERE id='$id'";
            $result = $this->db->query($query);
            return $result;
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
		return $this->db->query($sql);
	}
}

class ReservationItem {
	const NAME_TABLE = "ReservationItem";
	private $db;
	private $insertFormat = "INSERT INTO %s (reservation, dish, quantity) VALUES (%d, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservationItem($reservation, $dish, $quantity){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $reservation, $dish, $quantity);	
		return $this->db->query($sql);
	}
}

class Dishes{
	const NAME_TABLE = "Dishes";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, price, descriptions, image, status, lastUpdatedByAdmin) VALUES (%s, %d, %s, %s, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createDish($name, $price, $descriptions, $image, $status, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $price, $descriptions, $image, $status, $lastUpdatedByAdmin);	
		return $this->db->query($sql);
	}
        public function getTotalDishCount(){
            $query = "SELECT COUNT(*) as `total` FROM `Dishes`"; 
            $result = $this->db->query($query);
            $total = $result->fetch_assoc()["total"];
            return $total;
        }
}

class Comments{
	const NAME_TABLE = "Comments";
	private $db;
	private $insertFormat = "INSERT INTO %s (user, content, createTime, visibility, lastUpdatedByAdmin) VALUES (%d, %s, %s, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createComment($user, $content, $createTime, $visibility, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $user, $content, $createTime, $visibility, $lastUpdatedByAdmin);	
		return $this->db->query($sql);
	}
}

class Infos{
	const NAME_TABLE = "Infos";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, content, status, lastUpdatedByAdmin) VALUES (%s, %s, %d, %d)";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createInfo($name, $content, $status, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $content, $status, $lastUpdatedByAdmin);	
		return $this->db->query($sql);
	}
        public function getInfos(){
            $query = "SELECT * FROM `Infos` WHERE 1"; 
            $result = $this->db->query($query);
            return $result;
        }
        public function updateInfo($field, $content){
            $query = "UPDATE `Infos` SET `content`= '$content' WHERE `name` = '$field'";
            $result = $this->db->query($query);
            return $result;
        }
}
?>

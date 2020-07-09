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
	private $insertFormat = "INSERT INTO %s (name, email, phone, password, isAdmin) VALUES ('%s', '%s', '%s', '%s', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createUser($name, $email, $phone, $password, $isAdmin=0){
		$hash_password = password_hash($password, PASSWORD_DEFAULT);
	    $sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $email, $phone, $hash_password, $isAdmin);
		$result = $this->db->query($sql);
	    return $result;
	}
	public function login($email, $password){
		$query = "SELECT * FROM `Users` WHERE `email` = '$email'";
		$result = $this->db->query($query);
		if ($result->num_rows){
			$row = $result->fetch_assoc();
			$value = array($row)[0];
			$hash = $value['password'];
			if(password_verify($password ,$hash)){
				return $value;
			} 
		}
		return false;
	}
	public function getTotalUserCount(){
		$query = "SELECT COUNT(*) as `total` FROM `Users`"; 
		$result = $this->db->query($query);
		$total = $result->fetch_assoc()["total"];
		return $total;
	}
	public function emailIsExist($email){
		$query = "SELECT * FROM `Users` WHERE `email` = '$email'";
		$result = $this->db->query($query);
		return $result->num_rows != 0;
	}
	public function getUserById($id){
		$query = "SELECT * FROM `Users` WHERE `id` = '$id'";
		$result = $this->db->query($query);
		$user = $result->fetch_assoc();
		return $user;
	}
	public function getUsernameById($id){
		return $this->getUserById($id)['name'];
	}
	public function updateUserById($id, $name, $email, $phone, $password){
                if ($password == ''){
                    $query = "UPDATE `Users` SET `name`= '$name', `email`= '$email', `phone`= '$phone' WHERE `id` = '$id'";
                } else{
                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                    $query = "UPDATE `Users` SET `name`= '$name', `email`= '$email', `phone`= '$phone', `password`= '$hash_password' WHERE `id` = '$id'";
                }
		$result = $this->db->query($query);
		return $result;
	}
	public function deleteUserById($id){
		$querY = "DELETE FROM `Users` WHERE id='$id'";
		$result = $this->db->query($querY);
		return $result;
	}
}

class Reservations {
	const NAME_TABLE = "Reservations";
	private $db;
	private $insertFormat = "INSERT INTO %s (user, numPersons, status, createTime, lastUpdatedByAdmin) VALUES ('%d', '%d', '%s', '%s', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservation($user, $numPersons, $status, $createTime, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $user, $numPersons, $status, $createTime, $lastUpdatedByAdmin);	
		return $this->db->query($sql);
	}
	public function checkUserValidCreateReservation($user){
		$query = "SELECT * FROM `Reservations` WHERE `user` = '$user' AND `status` = 'created'";
		$result = $this->db->query($query);
		return $result->num_rows == 0;
	}
	public function getInitReservationByUserId($user){
		$query = "SELECT * FROM `Reservations` WHERE `user` = '$user' AND `status` IN ('created', 'accepted')";
		$result = $this->db->query($query);
		$reservation = $result->fetch_assoc();
		return $reservation;
	}
	public function getReservationById($id){
		$query = "SELECT * FROM `Reservations` WHERE `id` = '$id'";
		$result = $this->db->query($query);
		$reservation = $result->fetch_assoc();
		return $reservation;
	}
	public function createDefaultReservation($numPersons, $name, $email, $phone, $d){
		$startTime = date("Y-m-d h:i:s",strtotime($d));
		$sql = sprintf("INSERT INTO Reservations (numPersons, status, createTime, nameUser, phoneNumber, email, startReser, lastReser) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
			$numPersons, 
			'created', 
			date("Y-m-d h:i:s",strtotime('now')), 
			$name, 
			$phone, 
			$email, 
			$startTime 
		);
		$this->db->query($sql);
		$last_id = mysqli_insert_id($this->db->conn);
		return $last_id;
	}
	public function createDefaultReservationWithUser($user, $numPersons, $name, $email, $phone, $d){
		$startTime = date("Y-m-d h:i:s",strtotime($d));  
		$sql = sprintf("INSERT INTO Reservations (user, numPersons, status, createTime, nameUser, phoneNumber, email, startReser) VALUES ('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )",
			$user, 
			$numPersons, 
			'created', 
			date("Y-m-d h:i:s",strtotime('now')), 
			$name, 
			$phone, 
			$email, 
			$startTime 
		);
		$this->db->query($sql);
		$last_id = mysqli_insert_id($this->db->conn);
		return $last_id;
	}
	public function getTotalReservationCount($status, $time_range){
		$condition_status = 1;
		if ($status != ""){
			$condition_status = "(`status` = '$status')";
		}
		$condition_time = 1;
		if ($time_range > 0){
			if ($time_range == 1){
				$condition_time = "(`createTime` BETWEEN DATE(CURRENT_DATE() - INTERVAL 1 WEEK) AND DATE(CURRENT_DATE()))";
			} else if ($time_range == 2){
				$condition_time = "(`createTime` BETWEEN DATE(CURRENT_DATE() - INTERVAL 1 MONTH) AND DATE(CURRENT_DATE()))";
			} else if ($time_range == 3){
				$condition_time = "(`createTime` BETWEEN DATE(CURRENT_DATE() - INTERVAL 1 YEAR) AND DATE(CURRENT_DATE()))";
			}
		}
		$query = "SELECT COUNT(*) as `total` FROM `Reservations` WHERE " . $condition_status . " AND " . $condition_time;
		$result = $this->db->query($query);
		$total = $result->fetch_assoc()["total"];
		return $total;
	}
	public function updateReservationById($id, $numPersons, $status, $admin_id, $userName, $userPhone, $userEmail, $startReser, $lastReser){
                if ($startReser === NULL) {
                    $startReser = 'NULL';
                } else{
                    $startReser = "'$startReser'";
                }
                if ($lastReser === NULL) {
                    $lastReser = 'NULL';
                } else{
                    $lastReser = "'$lastReser'";
                }
		$query = "UPDATE `Reservations` SET `numPersons`= '$numPersons', `status`= '$status', `lastUpdatedByAdmin`= '$admin_id', `nameUser`= '$userName', `phoneNumber`= '$userPhone', `email`= '$userEmail', `startReser`= $startReser, `lastReser`= $lastReser WHERE `id` = '$id'";
		$result = $this->db->query($query);
		return $result;
	}
	public function updateReservationUser($id, $userName, $userPhone){
		$query = "UPDATE `Reservations` SET `nameUser`= '$userName', `phoneNumber`= '$userPhone' WHERE `id` = '$id'";
		$result = $this->db->query($query);
		return $result;
	}
	public function deleteReservationById($id){
		$query = "DELETE FROM `Reservations` WHERE id='$id'";
		$result = $this->db->query($query);
		return $result;
	}
}

class ReservationItem {
	const NAME_TABLE = "ReservationItem";
	private $db;
	private $insertFormat = "INSERT INTO %s (reservation, dish, price, quantity) VALUES ('%d', '%d', '%d', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createReservationItem($reservation, $dish, $price, $quantity){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $reservation, $dish, $price, $quantity);	
		return $this->db->query($sql);
	}
        public function getItemsByReservationId($id){
            $query = "SELECT * FROM `ReservationItem` WHERE `reservation` = '$id'";
            return $this->db->query($query);
        }
        public function updateItemById($id, $reservation, $dish, $price, $quantity){
            $query = "UPDATE `ReservationItem` SET `reservation`= '$reservation', `dish`= '$dish', `price`= '$price', `quantity`= '$quantity' WHERE `id` = '$id'";
            return $this->db->query($query);
        }
	public function deleteItemById($id){
		$query = "DELETE FROM `ReservationItem` WHERE id='$id'";
		return $this->db->query($query);
	}
}

class Tables {
        const NAME_TABLE = "Tables";
	private $db;
        private $insertFormat = "INSERT INTO %s (quantity, isAvailable, startReser, lastReser, reservation, lastUpdatedByAdmin) VALUES ('%d', '%d', '%s', '%s', '%d', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
        public function createTable($quantity, $isAvailable, $reservation, $lastUpdatedByAdmin){
                //$sql = sprintf($this->insertFormat, self::NAME_TABLE, $quantity, $isAvailable, $startReser, $lastReser, $reservation, $lastUpdatedByAdmin);	
                if ($reservation === NULL) {
                    $reservation = 'NULL';
                } else{
                    $reservation = "'$reservation'";
                }
                $sql = "INSERT INTO `Tables` (quantity, isAvailable, reservation, lastUpdatedByAdmin) VALUES ('$quantity', '$isAvailable', $reservation, '$lastUpdatedByAdmin')";
                $result = $this->db->query($sql);
                return $result;
        }
        public function getTableById($id){
            $query = "SELECT * FROM `Tables` WHERE `id` = '$id'";
            $result = $this->db->query($query);
            $table = NULL;
            if ($result->num_rows > 0) {
                $table = $result->fetch_assoc();
            }
            return $table;
        }
        public function getTableByReservationId($id){
            $query = "SELECT * FROM `Tables` WHERE (`reservation` = '$id') AND (`isAvailable` = 0)";
            $result = $this->db->query($query);
            $table = $result->fetch_assoc();
            return $table;
        }
        public function getAvailableTables($quantity){
            $query = "SELECT * FROM `Tables` WHERE (`isAvailable` > 0) AND (`quantity` >= '$quantity') ORDER BY `quantity` ASC";
            return $this->db->query($query);
        }
	public function updateTableById($id, $quantity, $isAvailable, $reservation, $lastUpdatedByAdmin){
                $query = "UPDATE `Tables` SET 
                    `quantity` = CASE WHEN '$quantity' <> '' THEN '$quantity' END,
                    `isAvailable` = CASE WHEN '$isAvailable' <> '' THEN '$isAvailable' END,
                    `reservation` = CASE WHEN '$reservation' <> '' THEN '$reservation' END,
                    `lastUpdatedByAdmin` = CASE WHEN '$lastUpdatedByAdmin' <> '' THEN '$lastUpdatedByAdmin' END
                    WHERE `id` = '$id'";
		$result = $this->db->query($query);
		return $result;
	}
	public function getTotalTableCount($status, $quantity_range){
		$condition_status = 1;
		if ($status > -1){
			$condition_status = "(`isAvailable` = '$status')";
		}
		$condition_quantity = 1;
		if ($quantity_range > 0){
			$low = $quantity_range;
			$high = $quantity_range + 2;
			if ($low == 10){
				$high = 9999;
			}
			$condition_quantity = "(`quantity` BETWEEN '$low' AND '$high')";
		}
		$query = "SELECT COUNT(*) as `total` FROM `Tables` WHERE " . $condition_status . " AND " .$condition_quantity; 
		$result = $this->db->query($query);
		$total = $result->fetch_assoc()["total"];
		return $total;
	}
	public function deleteTableById($id){
		$query = "DELETE FROM `Tables` WHERE id='$id'";
		$result = $this->db->query($query);
		return $result;
	}
}
class Dishes{
	const NAME_TABLE = "Dishes";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, price, descriptions, image, status, lastUpdatedByAdmin, onShow) VALUES ('%s', '%d', '%s', '%s', '%d', '%d', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createDish($name, $price, $descriptions, $status, $image, $lastUpdatedByAdmin, $display){
	    $sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $price, $descriptions, $image, $status, $lastUpdatedByAdmin, $display);
	    return $this->db->query($sql);
	}
	public function getTotalDishCount($status, $price_range){
		$condition_status = 1;
		if ($status > -1){
			$condition_status = "(`status` = '$status')";
		}
		$condition_price = 1;
		if ($price_range > 0){
			$low = $price_range;
			$high = $price_range + 2;
			if ($low == 4){
				$high += 1;
			}
			$condition_price = "(`price` BETWEEN '$low' AND '$high')";
		}
		$query = "SELECT COUNT(*) as `total` FROM `Dishes` WHERE " . $condition_status . " AND " .$condition_price; 
		$result = $this->db->query($query);
		$total = $result->fetch_assoc()["total"];
		return $total;
	}
	public function getDishById($id){
		$query = "SELECT * FROM `Dishes` WHERE `id` = '$id'";
		$result = $this->db->query($query);
		$dish = $result->fetch_assoc();
		return $dish;
	}
        public function getAllDishes(){
		$query = "SELECT * FROM `Dishes`";
		return $this->db->query($query);
        }
	public function getAllDishesIsShow($topK=10){
		$query = "SELECT * FROM `Dishes` WHERE `onShow`='1'";
		$result = $this->db->query($query);
		$dishes = array(); 
		$index = 0;
		if($result->num_rows >0){
			while($row= $result->fetch_assoc()){
				$index +=1;
				array_push($dishes,$row);
				if($index>$topK){
					break;
				}
			}
		}
		return $dishes;
	}
	public function updateDishById($id, $name, $price, $description, $status, $image, $admin_id, $display){
		$query = "UPDATE `Dishes` SET `name`= '$name', `price`= '$price', `descriptions`= '$description', `status`= '$status', `image`= '$image', `lastUpdatedByAdmin`= '$admin_id', `onShow`= '$display' WHERE `id` = '$id'";
		$result = $this->db->query($query);
		return $result;
	}
	public function deleteDishById($id){
		$query = "DELETE FROM `Dishes` WHERE id='$id'";
		$result = $this->db->query($query);
		return $result;
	}
}

class Comments{
	const NAME_TABLE = "Comments";
	private $db;
	private $insertFormat = "INSERT INTO %s (user, content, createTime, visibility, lastUpdatedByAdmin) VALUES ('%d', '%s', '%s', '%d', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function updateStatusById($id, $status){
		$query = "UPDATE `Comments` SET `visibility`= '$status' WHERE `id` = '$id'";
		$result = $this->db->query($query);
		return $result;
	}
	public function getCommentById($id){
		$query = "SELECT * FROM `Comments` WHERE `id` = '$id'";
		$result = $this->db->query($query);
		$comment = $result->fetch_assoc();
		return $comment;
	}
	public function createComment($user, $content, $createTime, $visibility, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $user, $content, $createTime, $visibility, $lastUpdatedByAdmin);	
		return $this->db->query($sql);
	}
	public function createDefaultComment($user, $content){
		$sql = sprintf("INSERT INTO Comments (user, content, createTime) VALUES ('%d', '%s', '%s')", $user, $content, date("Y-m-d h:i:s",strtotime("now")));
		return $this->db->query($sql);
	}
	public function getCommentVisibles($topK=10){
		$db = new DbBase();
		$Users = new Users($db); 
		$query = "SELECT * FROM `Comments` WHERE `visibility`='1'";
		$result = $this->db->query($query);
		$comments = array(); 
		$index = 0;
		if($result->num_rows >0){
			while($row= $result->fetch_assoc()){
				$index +=1;
				$idUser = $row['user'];
				$name = $Users->getUsernameById($idUser);
				$comment = $row['content'];
				$item = array('name' => $name, 'content' => $comment);
				array_push($comments,$item);
				if($index>$topK){
					break;
				}
			}
		}
		return $comments;
	}
	public function getTotalCommentCount($status){
		$condition_status = 1;
		if ($status > -1){
			$condition_status = "(`visibility` = '$status')";
		}
		$query = "SELECT COUNT(*) as `total` FROM `Comments` WHERE " . $condition_status; 
		$result = $this->db->query($query);
		$total = $result->fetch_assoc()["total"];
		return $total;
	}
}

class Infos{
	const NAME_TABLE = "Infos";
	private $db;
	private $insertFormat = "INSERT INTO %s (name, content, status, lastUpdatedByAdmin) VALUES ('%s', '%s', '%d', '%d')";
	public function __construct($dbBase){
		$this->db = $dbBase;
	}
	public function createInfo($name, $content, $status, $lastUpdatedByAdmin){
		$sql = sprintf($this->insertFormat, self::NAME_TABLE, $name, $content, $status, $lastUpdatedByAdmin);	
		return $this->db->query($sql);
	}
	public function getAbout(){
		$query = "SELECT * FROM `Infos` WHERE `status`='1' AND `name`='about'"; 
		$result = $this->db->query($query);
		return $result->fetch_assoc()['content'];
	}
	public function getContact(){
		$query = "SELECT * FROM `Infos` WHERE `status`='1' AND `name`='contact'"; 
		$result = $this->db->query($query);
		return $result->fetch_assoc()['content'];
	}
	public function getInfos(){
		$query = "SELECT * FROM `Infos` WHERE `status`='1'"; 
		$result = $this->db->query($query);
		return $result;
	}
	public function updateInfo($field, $content, $admin){
		$query = "UPDATE `Infos` SET `content`= '$content', `lastUpdatedByAdmin`='$admin' WHERE `name` = '$field'";
		$result = $this->db->query($query);
		return $result;
	}
}
?>

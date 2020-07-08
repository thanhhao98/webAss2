<?php
include('../auth/auth.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$role = getRole();
	include("../models/db.php");
	$db = New DbBase();
	$Reservations = new Reservations($db);
	$Users = new Users($db);
	$numPersons = trim($_POST["number"]);
	$now = strtotime('now');
	$d = strval(trim($_POST["date"])) . ' ' . strval(trim($_POST["time"]));
	$td = strtotime($d);
	if(($td-$now)<0 or ($td-$now) > 1200000) {
		echo sprintf("<script type='text/javascript'>alert('You just can reserve 14 days from now');</script>");
	} else if($role == 'unknown'){
		$name = trim($_POST["name"]);
		$email = trim($_POST["email"]);
		$phone = trim($_POST["phone"]);
		if($Users->emailIsExist($email)){
			echo sprintf("<script type='text/javascript'>alert('This email is already register! Please login to reserve');</script>");
		} else {
			if(isset($_SESSION['reservations'])){
				echo sprintf("<script type='text/javascript'>alert('You already create a reservation! Check your nav bar for detail or contact us');</script>");
			} else {
				$idReservation = $Reservations->createDefaultReservation(
					$numPersons, 
					$name,
					$email,
					$phone,
					$d
				);
				$_SESSION['reservations'] = [
					'name' => $name,
					'email' => $email,
					'phone' => $phone,
					'id' => $idReservation
				];
				echo sprintf("<script type='text/javascript'>alert('Create reservation successfully');</script>");
			}
		}
	} else {
		$userId = $_SESSION['userId'];
		if($Reservations->checkUserValidCreateReservation($userId)){
			$idReservation = $Reservations->createDefaultReservationWithUser(
				$userId, 
				$numPersons, 
				$_SESSION["userInfo"]['username'],
				$_SESSION["userInfo"]['email'],
				$_SESSION["userInfo"]['phone'],
				$d
			);
			$_SESSION['reservations'] = [
				'name' => $_SESSION["userInfo"]['username'],
				'email' => $_SESSION["userInfo"]['name'],
				'phone' => $_SESSION["userInfo"]['phone'],
				'id' => $idReservation

			];
			echo sprintf("<script type='text/javascript'>alert('Create reservation successfully');</script>");
		} else {
			echo sprintf("<script type='text/javascript'>alert('You already have an reservation with status: created or accepted');</script>");
		}
	}
	echo("<script>location.href = 'http://localhost:30001/';</script>");
	exit();
}
?>

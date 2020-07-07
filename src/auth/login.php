<?php
include('../auth/auth.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$role = getRole();
	if($role == 'admin'){
		header("location: /admin/dashboard.php");
		exit;
	} else if($rolle == 'user'){
		header("location: /");
		exit;
	}
	$email = $password = "";
	$email_err = $password_err = "";
	include("../models/db.php");
	$db = New DbBase();
	$Users = new Users($db);
	 
    // Check if email is empty
	if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
		if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			$email_err = "Invalid email format";
		} else {
			$email = trim($_POST["email"]);
		}
	}
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
	} elseif(strlen(trim($_POST["password"])) < 6){
		$password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
		$result = $Users->login($email, $password);
		if ($result){
			$_SESSION["loggedin"] = true;
			if ($result['isAdmin'] === '1'){
				$_SESSION["admin"] = true;
			} else {
				$_SESSION["admin"] = false;
			}
			$_SESSION["userInfo"] = ["email"=> $result["email"], "username"=> $result["name"], "phone"=> $resullt["phone"]];
			$_SESSION["userId"] = $result['id'];
			header("location: /admin/dashboard.php");
			exit;
		} else {
			echo "<script type='text/javascript'>alert('Email or password is incorrect.');</script>";
		}
	} else {
		echo sprintf("<script type='text/javascript'>alert('%s; %s');</script>", $email_err, $password_err);
	}
	echo("<script>location.href = 'http://localhost:30001/';</script>");
}
?>

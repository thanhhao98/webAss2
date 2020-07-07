<?php
include('../auth/auth.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$role = getRole();
	if($role == 'unknown'){
		header("location: /");
		exit;
	}
	$userId = $_SESSION['userId'];
	include("../models/db.php");
	$db = New DbBase();
	$Comments = new Comments($db);
	$content = $content_err = "";
    // Check if email is empty
	if(empty(trim($_POST["content"]))){
        $content_err = "Comment is empty";
    } else{
		$content = trim($_POST["content"]);
	}
    
    if(empty($content_err)){
		$Comments->createDefaultComment($userId, $content);
		echo sprintf("<script type='text/javascript'>alert('Submit successfully');</script>");
	} else {
		echo sprintf("<script type='text/javascript'>alert('%s');</script>", $content_err);
	}
	echo("<script>location.href = 'http://localhost:30001/';</script>");
}
?>

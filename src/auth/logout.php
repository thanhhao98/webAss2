<?php
if ( ! session_id() ) {
	session_start();
}
if (!isset($_SESSION['loggedin'])){
	header("location: /auth/login.php");
	exit;
}
$_SESSION['userId'] = "";
$_SESSION['userInfo'] = "";
$_SESSION['loggedin'] = "";
unset($_SESSION['userId']);
unset($_SESSION['userInfo']);
unset($_SESSION['loggedin']);
$_SESSION['admin'] = "";
unset($_SESSION['admin']);
session_destroy();
header("location: /");
exit;
?>

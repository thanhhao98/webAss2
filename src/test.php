<?php
if ( ! session_id() ) {
	session_start();
}
if(isset($_SESSION['loggedin'])){
	if($_SESSION['admin']){
		echo 'admin';
	} else {
		echo 'user';
	}
} else {
	echo 'not login';
}
?>

<?php
function getRole(){
	if ( ! session_id() ) {
		session_start();
	}
	if(isset($_SESSION['loggedin'])){
		if($_SESSION['admin']){
			return 'admin';
		} else {
			return 'user';
		}
	} else {
		return 'unknown';
	}
}
?>

<?php
	include('../models/db.php');
	if($_POST['action'] == 'toggleStatusComment') {
		$db = New DbBase();
		$Comments = new Comments($db);
		$commentId = $_POST['idComment'];
		$status = $_POST['nextStatus'];
		$comment = $Comments->updateStatusById($commentId, $status);
		echo 'successfully';
	}
?>

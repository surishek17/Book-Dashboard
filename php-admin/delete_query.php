<?php
	require_once 'includes/db-inc.php';
	
	if($_GET['BookId']){
		$BookId = $_GET['BookId'];
		
		$conn->query("DELETE FROM `books` WHERE `BookId` = $BookId") or die(mysqli_errno());
		header("location: bookstable.php");
	}	
?>
<?php 
	session_start();
	require('conn.php');
	
	$cquery = "UPDATE Billing SET Status = 'Paid' WHERE OrderID = ".$_GET['oid']."";
	
	if ($link->query($cquery) === TRUE) {
		echo "<script> window.alert('Paid');</script>";
	} else {
		echo "Error: " . $productquery . "<br>" . $link->error;
		echo "ID: ".$_GET['oid'];
	}
?>
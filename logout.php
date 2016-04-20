<?php
	session_start();
	require('conn.php');
		$_SESSION['logged user'] = 0;
		$_SESSION['logged admin'] = 0;
		$_SESSION['ID'] = 0;
		setcookie("submitted", $name,time()-3600);
		setcookie("cartON","keksu", time()-1800);
		header ("location: index.php");

?>
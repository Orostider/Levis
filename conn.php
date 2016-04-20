<?php
	require('dbconf.php');
	$link = mysqli_connect($dbConn['host'],$dbConn['user'],$dbConn['pass'],$dbConn['name']);
	if (!$link) {
		die("Yhteydenluonti ep&auml;onnistui: " . mysqli_connect_error());
	}
?>
<?php 
	session_start();
	require('conn.php');
	
	$phrasequery="SELECT IDNum FROM Phrases;";
	$phraseresult = mysqli_query($link, $phrasequery);
	$maxnum = mysqli_num_rows($phraseresult);
	
	$randum = mt_rand(1,$maxnum);
	$randomquery = "SELECT Message, Origin FROM Phrases WHERE IDNum = ".$randum.";";
	$randomresult = mysqli_query($link, $randomquery);
	$cols = $randomresult->fetch_assoc();
	$origin = $cols['Origin'];
	$message = $cols['Message'];
	
	echo '<div id="wisdomText">"'. utf8_encode($message) .'"<br> -'.$origin.'</div>';
?>
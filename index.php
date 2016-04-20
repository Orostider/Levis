<!DOCTYPE html>
<?php 
	session_start();
	require('conn.php');
?>

<html>
	<head>
		<title>Levis</title>
		<link rel="icon" href="images/ebin.jpg"/>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="font-awesome-4.5.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="all.js"></script>
	</head>
	
	<body>
		<!-- Login system -->
		<?php
			if ($_SESSION['logged user']==1 and isset($_COOKIE['submitted']))  { //User
				echo '<script> $("body").load("bodylogin.php");</script>';
			} elseif ($_SESSION['logged admin']==1 and isset($_COOKIE['submitted'])) { //Admin
				echo '<script> $("body").load("bodyadmin.php");</script>';
			} else { //Visitor
				$_SESSION['logged user'] = 0;
				$_SESSION['logged admin'] = 0;
				$_SESSION['ID'] = 0;
				echo '<script> $("body").load("bodyvisitor.php");</script>';
			}		
		?>
	</body>
</html>
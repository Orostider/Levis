<?php
	session_start();
	require('conn.php');
	if(isset($_POST["submitLogin"])){ 
		$name = $_POST["username"];
		$password = $_POST["password"];
		if ((strlen($name) <= 5) or (strlen($password) <= 5)) {
			echo "<script> window.alert('Täytä kaikki kentät!');</script>";
		} else{
			$namecheck = "SELECT UserID, Password FROM CustomerUser WHERE UserName='".$name."' AND Password='".$password."' ";
			$result = mysqli_query($link, $namecheck);
			$admincheck = "SELECT AdminID, Password FROM AdminUser WHERE UserName='".$name."' AND Password='".$password."' ";
			$adminresult = mysqli_query($link, $admincheck);
			
			if (mysqli_num_rows($result) == 1){
				$userrow = $result->fetch_assoc();
				$userID = ((int)$userrow['UserID']);
				setcookie("submitted", $name,time()+3600);
				$_SESSION['logged user'] = 1;
				$_SESSION['ID'] = $userID;
				header ("location: index.php");
			} elseif (mysqli_num_rows($adminresult) == 1){
				setcookie("submitted", $name, time()+3600);
				$_SESSION['logged admin'] = 1;
				header ("location: index.php");
			} else {
				echo "<script> window.alert('Virheelliset tiedot.');</script>";
			}
		}
	}
?>
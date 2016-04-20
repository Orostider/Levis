<?php
 require('conn.php');
	if(isset($_POST['submit'])){
		$name = $_POST["uname"];
		$pass = $_POST["pass"];
		$lastname = $_POST["lastname"];
		$firstname = $_POST["firstname"];
		$email = $_POST["email"];	
		$address = $_POST["address"];
		$postal = $_POST["postal"];
		$city = $_POST["city"];
		$country = $_POST["country"];
		
		$userid = "SELECT UserID FROM CustomerUser ORDER BY UserID DESC LIMIT 1";
		$result = mysqli_query($link, $userid);
		$row = $result->fetch_assoc();
		$intr = ((int)$row['UserID'] + 1);

		echo "<br>";
		
		if ((strlen($name) <= 5) or (strlen($pass) <= 5) or (strlen($lastname) <= 2) or (strlen($firstname) <= 2)
			or (strlen($email) <=4) or (strlen($address) <= 4) or (strlen($postal) <= 4)
			or (strlen($city) <= 0) or (strlen($country) <= 2)) {			
				echo "<script> window.alert('Täytä kaikki kentät!');</script>";
		} else {
			$namecheck = "SELECT UserName FROM CustomerUser WHERE UserName='".$name."' ";
			$admincheck= "SELECT UserName FROM AdminUser WHERE UserName='".$name."' ";
			$result = mysqli_query($link, $namecheck);
			$adminresult = mysqli_query($link, $admincheck);
			
			if (mysqli_num_rows($result) == 1 OR mysqli_num_rows($adminresult) == 1) {
				echo "K&auml;ytt&auml;j&auml;tunnus on varattu!";
			} else {
				$userquery = "INSERT INTO CustomerUser(UserID, Username, PassWord, LastName, FirstName, Email, Address, PostalCode, City, country)
								VALUES (".$intr.", '".$name."', '".$pass."',
								'".$lastname."', '".$firstname."', '".$email."', '".$address."', '".$postal."', '".$city."', '".$country."')";
				if ($link->query($userquery) === TRUE) {
					echo "Uusi k&auml;ytt&auml;j&auml; ".$name." luotu onnistuneesti.";
				} else {
					echo "Virhe: " . $userquery . "<br>" . $link->error;
				}
			}
		}
	}
?>
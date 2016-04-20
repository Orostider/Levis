<?php 
	session_start();
	require('conn.php');
	
	if ($_SESSION['ID'] == 0){
		echo '<script>window.alert("Kirjaudu sisään.");</script>';
	} elseif ((count($_SESSION['cart'])) == 0) {
		echo '<script>window.alert("Ostoskori on tyhjä.");</script>';
	} else {
		$postal = 0;
		$maxQuery = "SELECT MAX(OrderID) as maxID FROM Orders";
		$maxResult = mysqli_query($link, $maxQuery);
		$orderRow = $maxResult -> fetch_assoc();
		$oidnon = $orderRow['maxID'];
		$oid = ((int)$oidnon)+1;
		
		foreach($_SESSION['cart'] as $product_id => $quantity){
			
			$query = "SELECT * From Product WHERE ProductID = ".$product_id;
			$result = mysqli_query($link, $query);
			
			$row = $result -> fetch_assoc();
			$price = $row['Price'];
			$stock = $row['InStock'];
			$total = $quantity * $price;
			$productID = $row['ProductID'];
			
			$dQuery = 'INSERT INTO Details(OrderID, ProductID, Quantity)
								VALUES ('.$oid.','.$productID.','.$quantity.')';
			$dResult = mysqli_query($link, $dQuery);
			
			//$stockQuery = 'UPDATE Product SET InStock = InStock - '.$quantity.' WHERE ProductID = '.$productID;
			//$stockR = mysqli_query($link, $stockQuery);
			
			$pQuery = "SELECT P.CatID, PostalCharges FROM Product P INNER JOIN Category C ON P.CatID = C.CatID WHERE P.ProductID = ".$productID;
			$pResult = mysqli_query($link, $pQuery);
			$pRow = $pResult -> fetch_assoc();
			
			if ($postal < ((float)$pRow['PostalCharges'])){
				$postal = ((float)$pRow['PostalCharges']);
				}
			$totalsum = $totalsum + $total;
		}
		
		$endsum = $totalsum + $postal;
		
		$cQuery = "SELECT Country FROM CustomerUser WHERE UserID = ".$_SESSION['ID'];
		$cResult = mysqli_query($link, $cQuery);
		$cRow = $cResult -> fetch_assoc();
		$country = $cRow['Country'];
		
		if ($country == "Finland" OR $country == "finland") {
			$oQuery = "INSERT INTO Orders(OrderID, UserID, ShipperID, OrderDate, TotalPrice)
								VALUES (".$oid.",".$_SESSION['ID'].",1,CURDATE(),".$endsum.")";
			
			if ($link -> query($oQuery) === TRUE){
				$bquery = "INSERT INTO Billing(OrderID, Status)
									VALUES (".$oid.", 'Paid')";
				$bResult = mysqli_query($link, $bquery);
				setcookie("cartON","keksu", time()-1800);
				unset($_SESSION['cart']);
				echo '<script>window.alert("Kiitos tilauksestasi. Postikulut: '.$postal.' €");</script>';
			} else {
				echo '<script>window.alert("Tilauksen tekeminen ep&äonnistui!");</script>';
				//echo "Virhe: " . $oQuery . "<br>" . $link->error; //testi
			}
		} else {
			$oQuery = "INSERT INTO Orders(OrderID, UserID, ShipperID, OrderDate, TotalPrice)
								VALUES (".$oid.",".$_SESSION['ID'].",2,CURDATE(),".$endsum.")";
			
			if ($link -> query($oQuery) === TRUE){
				$bquery = "INSERT INTO Billing(OrderID, Status)
									VALUES (".$oid.", 'Paid')";
				$bResult = mysqli_query($link, $bquery);
				setcookie("cartON","keksu", time()-1800);
				unset($_SESSION['cart']);
				echo '<script>window.alert("Kiitos tilauksestasi. Postikulut: '.$postal.' €");</script>';
				
			} else {
				echo '<script>window.alert("Tilauksen tekeminen epäonnistui!");</script>';
				//echo "Virhe: " . $oQuery . "<br>" . $link->error; //testi
			}
			
		}
		echo "<script> $('#cartContent').empty().slideUp();</script>";
		echo "<script> $('#mid').load('cart.php?action=show');</script>";
	}
?>
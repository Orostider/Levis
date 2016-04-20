<?php 
	session_start();
	require('conn.php');
				
			if	(!empty($_SESSION['cart'])) {
				if (!isset($_COOKIE['cartON'])){
					foreach($_SESSION['cart'] as $product_id => $quantity){      
					$rquery = "UPDATE Product  SET InStock = InStock + $quantity WHERE ProductID = ".$product_id;
					$res = mysqli_query($link, $rquery);
					}
					unset($_SESSION['cart']);
				}	
			}
?>
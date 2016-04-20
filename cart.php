<?php
	session_start();
	require('conn.php');
	if(!$_SESSION['cart']) { //if the cart is empty
		$_SESSION['cart'] = array();
	}
	
	$product_id = $_GET['id']; //the product id from the URL
	$action = $_GET['action']; //the action from the URL
		
	switch($action){
		
		case 'add':	// ---------- 1 LISÄÄ KORIIN
			if (checkExistance($product_id) > 0){ // tsekkaa onko tällainen olemassa (funktio alhaalla)
				
				//Lisävarmistus, että stockissa on
				$stockCheckQuery = "SELECT InStock FROM Product WHERE ProductID ='" . $product_id . "'" ;	
				$stockResult = mysqli_query($link, $stockCheckQuery);
				while($row = $stockResult->fetch_assoc()){
					$isInStock = $row['InStock'];
				}
				if(!(int)$isInStock > 0) {
					//prevent
					echo "<script> window.alert('Valitettavasti tuotetta ei ole varastossa.');</script>";
				} else {
					//proceed
					$delquery = "UPDATE Product SET InStock = InStock - 1 WHERE ProductID = ".$product_id."";
					$res = mysqli_query($link, $delquery);
					
					$_SESSION['cart'][$product_id]++; //add one to the quantity of the product with id $product_id
					setcookie("cartON", "keksu",time()+1800); //ostoskorin elinaika
					echo '<br>Tuote lis&auml;tty koriin!<br>';
					
					// Takaisin tuotteisiin NAPPI
					echo "<button type='button' onclick='backToProducts()'>Takaisin tuotteisiin</button>";
					// korin sisaltö NAPPI
					echo "<button type='button' onclick='viewCart()'>Korin sis&auml;lt&ouml;</button>"; 
					echo ' <script> $("#cartContent").empty().load("cart.php?action=showMini");  </script>';// cart.php - showMini
				} // lisächeckin else
				
			} else {
				echo '<br>Ei l&ouml;ytynyt t&auml;llaista<br>';
			} // checkExistance else;
		break;
		
		
		
		case "remove": // ------------ 2 POISTA TUOTE
			$addquery = "UPDATE Product SET InStock = InStock + 1 WHERE ProductID = ".$product_id."";
			$res = mysqli_query($link, $addquery);
			echo 'Id: ' . $product_id . ' poistettu! ';
			$_SESSION['cart'][$product_id]--; //remove one from the quantity of the product with id $product_id
			
			if($_SESSION['cart'][$product_id] == 0) setcookie("cartON","keksu", time()-1800); //poistaa ostoskorin keksun
			
			if($_SESSION['cart'][$product_id] == 0) unset($_SESSION['cart'][$product_id]); //if the quantity is zero, remove it completely (using the 'unset' function) - otherwise it will show zero, then -1, -2 etc when the user keeps removing items. 
			echo ' <script> viewCart() </script>';
			echo ' <script> $("#cartContent").empty().load("cart.php?action=showMini");  </script>';// cart.php - showMini
			
		break;
		
		
		
		case 'empty': //--------- 3 TYHJENNÄ KORI
			foreach($_SESSION['cart'] as $product_id => $quantity){      
				$rquery = "UPDATE Product  SET InStock = InStock + $quantity WHERE ProductID = ".$product_id;
				$res = mysqli_query($link, $rquery);
			}
			unset($_SESSION['cart']);
			setcookie("cartON","keksu", time()-1800);
			echo '<script> $("#cartContent").empty().slideUp(); </script> ';// minikärryt tyhjäksi ja piiloon
			echo '<script> $("#mid").load("products.php"); </script>'; // Näytetään tuotelista
		break;



		case "show": // ------------ 4 NÄYTÄ KORI
			//Count quantity of products
			$numberOfProducts = 0; // tuotteiden kokonaismäärä korissa
			foreach($_SESSION['cart'] as $pid => $quantity) {
				$numberOfProducts = $numberOfProducts + $quantity;
			} //foreach
			echo 'Sinulla on ' . $numberOfProducts . ' tuotetta ostoskorissa. <br>';
			
			if($_SESSION['cart'] AND $numberOfProducts != 0) { // JOS ON KORI JA SE EI OLE TYHJÄ
				//Count sum
				$totalSum = 0;
				foreach($_SESSION['cart'] as $product_id => $quantity) { // Quantity per tuote lasketaan tällä
					
					//get the name, description and price from the database - this will depend on your database implementation.
					$query = "SELECT * FROM Product WHERE ProductID ='" . $product_id . "'" ;	
					$result = mysqli_query($link, $query);
					while($row = $result->fetch_assoc()){
						$author = $row['Author'];
						$title = $row['Title'];
						$price = $row['Price'];
						$total = $price * $quantity;
						$productID = $row['ProductID'];
						echo '<br>Artisti: ' . utf8_encode($author) . ' - Teos: ' . utf8_encode($title) . ' - Hinta: ' . $price . ' &euro; <br> Lukum&auml;&auml;r&auml;: ' . $quantity . ' - Kokonaishinta: ' . $total .' &euro;<br>';
						echo "<button type='button' onclick='removeFromCart(" . $productID  . ")'>Poista korista</button>"; // poista korista -nappi
						$totalSum = $totalSum + $total;
					}// while
					echo '<br>';
				} // foreach
				echo '<br>Loppusumma: ' . $totalSum . ' &euro;<br>'; // tilauksen kokonaishinta
				echo "<button type='button' onclick='backToProducts()'>Takaisin tuotteisiin</button>"; // takaisin tuotteisiin -nappi
				echo "<button type='button' onclick='emptyCart()'>Tyhjenn&auml; kori</button>"; // tyhjennä kori -nappi
				echo "<button type='button' class='buyBtn' onclick='buy()'>Kassalle</button>";
				echo "<button type='button' class='reserveBtn' onclick='reserve()'>Varaa</button>";
			} else { // Mitä tehdään jos kori on tyhjä
				echo "<button type='button' onclick='backToProducts()'>Takaisin tuotteisiin</button>"; // takaisin tuotteisiin -nappi
				//echo "<script> $('#mid').load('products.php'); </script> ";	// suoraan takaisin tuotelistaan
			} // else;
		break; // ---------------------------- case: SHOW
		
		
		
		
		case "showMini": // ------------------------------- 5 NÄYTÄ DROPDOWN (MINI)KORI
			//Count quantity of products
			$numberOfProducts = 0; // tuotteiden kokonaismäärä korissa
			foreach($_SESSION['cart'] as $pid => $quantity) {
				$numberOfProducts = $numberOfProducts + $quantity;
			} //foreach
			echo 'Sinulla on ' . $numberOfProducts . ' tuotetta ostoskorissa. <br>';
			
			if($_SESSION['cart'] AND $numberOfProducts != 0) { // JOS ON KORI JA SE EI OLE TYHJÄ
				//Count sum
				$totalSum = 0;
				foreach($_SESSION['cart'] as $product_id => $quantity) { // Quantity lasketaan tällä
				
					$query = "SELECT * FROM Product WHERE ProductID ='" . $product_id . "'" ;
					$result = mysqli_query($link, $query);
					while($row = $result->fetch_assoc()){
						$author = $row['Author'];
						$title = $row['Title'];
						$price = $row['Price'];
						$total = $price * $quantity;
						$productID = $row['ProductID'];
						echo '<br>Artisti: ' . utf8_encode($author) . ' - Teos: ' . utf8_encode($title) . ' - Hinta: ' . $price . ' &euro; <br> Lukum&auml;&auml;r&auml;: ' . $quantity . ' - Kokonaishinta: ' . $total .' &euro;<br>';
						$totalSum = $totalSum + $total;
						}// while
					echo '<br>';
				} // foreach
				echo 'Loppusumma: ' . $totalSum . ' &euro;<br>'; // tilauksen kokonaishinta
				echo "<button type='button' onclick='viewCartMini()'>N&auml;yt&auml; kori</button>"; // korin sisältö -nappi
				echo "<button type='button' onclick='emptyCart()'>Tyhjenn&auml; kori</button>"; // tyhjennä kori -nappi
				echo "<button type='button' class='buyBtn' onclick='buy()'>Kassalle</button>";
				echo "<button type='button' class='reserveBtn' onclick='reserve()'>Varaa</button>";
			} // if;
		break; // ---------------------------- case: SHOW
			
			
	} // SWITCH


	
	
	// PHP - Functions:
	function checkExistance($product_id){ // katsoo onko tällaisia olemassa
		require('conn.php');
		$checkQuery = "SELECT * FROM Product WHERE ProductID ='" . $product_id . "'" ;
		$result = mysqli_query($link, $checkQuery);
		//echo 'Existence: ' . $result -> num_rows;
		return ($result -> num_rows); // Palauttaa hakua vastaavien tuotteiden lukumäärän tietokannassa. ON OLTAVA !=0
	}// checkExistance()
?>
<script>

	function viewCart() { // näyttää korin sisällön
		$('#cartContent').empty().load('cart.php?action=showMini'); // cart.php - showMini
		$('#mid').load('cart.php?action=show'); // cart.php - show
	}
	
	function viewCartMini() { // näyttää korin sisällön + slideUp()
		$('#cartContent').empty().slideUp(); // minicart slideUp()
		$('#cartContent').empty().load('cart.php?action=showMini'); // cart.php - showMini
		$('#mid').load('cart.php?action=show'); // cart.php - show
	}
	
	
	function backToProducts() { // takaisin tuotelistaan
		$('#mid').load('products.php');
	}
	
	function removeFromCart(pid) { // poistaa korista + ohjaa takaisin ostoskoriin!
		var text = "./cart.php?action=remove&id=" + pid ; // huomaa tämä!
		$('#mid').load(text);
		$('#cartContent').empty().load('cart.php?action=showMini'); // cart.php - showMini (uudelleen lataus)
	}
	function emptyCart(){ // tyhjentää korin
		var emptyCart = window.confirm("Oletko varma?"); //varmistus
		if (emptyCart == true) {
			$('#cartContent').empty().slideUp(); // minicart slideUp()
			$('#mid').load('cart.php?action=empty'); // cart.php - empty
		}
	}
	function buy() {
		$('.buyBtn').load('order.php');
	}
	function reserve() {
		$('.reserveBtn').load('reserve.php');
	}
</script>
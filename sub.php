<?php
	session_start();
	require('conn.php');
	if(isset($_POST['submitProduct'])){ 
		$category = $_POST["category"];
		$artist = $_POST["artist"];
		$title = $_POST["title"];
		$genre = $_POST["genre"];
		$reldate = $_POST["reldate"];
		$price = $_POST["price"];
		$pricenum = (float)$price;		
		$amount = $_POST["amount"];
		$intamount = (int)$amount;
		$psize = $_POST["psize"];
		$artwork = $_POST["artwork"];
		$adder = $_COOKIE['submitted'];
		
	$productid = "CALL nProductID()";
	$result = mysqli_query($link, $productid);
	$row = $result->fetch_assoc();
	$intr = ((int)$row['ProductID'] + 1);
	echo "<br>";
	$result->close();
    $link->next_result();
	
	$productcheck = "SELECT * FROM Product WHERE CatID = ".$category." AND Author = '".$artist."' AND Title = '".$title."'";
	$checkresult = mysqli_query($link, $productcheck);
	
	if ((strlen($artist) <= 0) or (strlen($title) <= 0 or (strlen($genre) <= 0) or (strlen($reldate) <= 0)
		or ($pricenum == 0) or ($intamount == 0) or (strlen($artwork) <= 0))) {
			echo "<script> window.alert('T&auml;yt&auml; kaikki kent&auml;t!');</script>";
	} elseif (mysqli_num_rows($checkresult) == 1) {
		echo "<script> window.alert('Tuote on jo tietokannassa!');</script>";
	} elseif ((strlen($psize) <= 0)) {
			
			$productquery = "INSERT INTO Product(ProductID, CatID, Author, Title, Genre, ReleaseDate, Price, InStock, PSize, Artwork, Adder, AddDate)
							VALUES (".$intr.", ".$category.", '".$artist."',
							'".$title."', '".$genre."', '".$reldate."', ".$pricenum.", ".$intamount.", NULL, '".$artwork."', '".$adder."', curdate())";
			if ($link->query($productquery) === TRUE) {
				echo "<script> window.alert('Uusi tuote ".$artist." - ".$title." lisätty onnistuneesti!');</script>";
				
			} else {
				echo "Virhe: " . $productquery . "<br>" . $link->error;
			}
		} else {
			$productquerysize = "INSERT INTO Product(ProductID, CatID, Author, Title, Genre, ReleaseDate, Price, InStock, PSize, Artwork, Adder, AddDate)
							VALUES (".$intr.", ".$category.", '".$artist."',
							'".$title."', '".$genre."', '".$reldate."', ".$pricenum.", ".$intamount.", '".$psize."', '".$artwork."',  '".$adder."', curdate())";
			if ($link->query($productquerysize) === TRUE) {
				echo "Uusi tuote lis&auml;tty onnistuneesti";
			} else {
				echo "Virhe: " . $productquerysize . "<br>" . $link->error;
			}
		}

	}
?>
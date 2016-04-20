<?php
	session_start();
	
	$action = $_GET['action'];
	
	switch($action){
		
		case 'default': // kaikki
			$query = "SELECT * FROM Product ORDER BY Author, ReleaseDate DESC"; // ---- Query!
			getList($query);
		break;
		
		case 'orderByArtistCD': // CDt - artistin mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=1 ORDER BY Author, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByGenreCD': // CDt - Genren mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=1 ORDER BY Genre, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByArtistLP': // LPt - artistin mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=2 ORDER BY Author, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByGenreLP': // LPt - Genren mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=2 ORDER BY Genre, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByArtistCS': // Kassut - artistin mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=3 ORDER BY Author, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByGenreCS': // Kassut - Genren mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=3 ORDER BY Genre, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByArtistDVD': // DVDt - artistin mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=4 ORDER BY Author, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByGenreDVD': // DVDt - Genren mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=4 ORDER BY Genre, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByArtistSH': // Paidat - artistin mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=5 ORDER BY Author, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
		case 'orderByGenreSH': // Paidat - Genren mukaan
			$productQuery = "SELECT * FROM Product WHERE CatID=5 ORDER BY Genre, ReleaseDate DESC ";
			getList($productQuery);
		break;
		
	}// switch
	function getList($query){
		$productQuery = $query;
		require('conn.php');
		require('cart.php');
		$result = mysqli_query($link, $productQuery);
		
		if ($result-> num_rows > 0) {
			echo '<div id="mainProductlist">'; // Main DIV koko tuotelistalle
			
			while($row = $result->fetch_assoc()) {
				$image = $row['Artwork'];
				$author = $row['Author'];
				$title = $row['Title'];
				$category = $row['CatID'];
				$genre = $row['Genre'];
				$price = $row['Price'];
				$roundedPrice = number_format($price, 2, ',', '');
				$relDate = $row['ReleaseDate'];
				$formattedRelDate = date("d.m.Y", strtotime($relDate));
				$productID = $row['ProductID'];
				$size = $row['Size'];
				$inStock = $row['InStock'];
				
				// -------- mini DIV yksittäiselle tuotteelle!
				echo '<div id="productList">';
				// Picture
				echo "<img src='" . $image . "' alt='Kuva puuttuu' > ";
				// Paragraph, sisältää tuotteen tiedot
				echo '<p class="productInfo">';
				echo  utf8_encode($author) . ' - ' . utf8_encode($title) . '<br>';
				//1 = CD, 2 = LP, 3 = CASS, 4 = DVD, 5 = SHIRT
				$format;
				if ($category == 1) {
					$format = "CD";
				} else if($category == 2) {
					$format = "LP";
				} else if($category == 3) {
					$format = "CASS";
				} else if($category == 4) {
					$format = "DVD";
				} else if($category == 5) {
					$format = "Paita";
				}
				echo $format . ' - Genre: ' . $genre . '<br>';
				echo 'Julkaisupäivä: ' . $formattedRelDate .'<br>';
				
				if ($size != NULL) {	// EI listata kokoa, jos on NULL
					echo 'Koko: ' . $size; 
				}// if
				
				echo '<br>Hinta: ' . $roundedPrice . ' € <br>';
				echo 'Varastossa: ' . $inStock .'<br>';
				
				echo '</p>'; //tuotteen tiedot loppuu
				
				//------- "Lisää koriin" -NAPPI !!!!
				if ($inStock == '0') {
					echo "<button id='soldOut'  type='button' disabled >Loppuunmyyty </button>" ;
				} else {
					echo "<button id='addToCart' onclick='addToCart(" . $productID . ")' type='button'>Lisää koriin </button>" ;
				}// else 
				// ------------ mini div loppuu
				echo '</div>';  
			} // while
			//------------------------ main div loppuu
			echo '<div>'; 
		} else {
			echo '0 tuotetta tietokannassa!';
		} // else 
	} // getList()
?>

<script>
	function viewCart() { // listaa korin sisällön
		$('#cartContent').empty().load('cart.php?action=showMini'); // cart.php - showMini
		$('#mid').load('cart.php?action=show'); // cart.php - show	
	}
	
	function addToCart(pid) { // tuotteen lisäys koriin | (pid=productID parametrinä)
		var text = "./cart.php?action=add&id=" + pid ;	// cart.php - Add + ID
		$('#mid').empty().load(text); // <-- huomaa tämä!
		$('#cartContent').empty().load('cart.php?action=showMini'); // cart.php - showMini (päivitys)
	}
</script>
<?php 
	session_start();
	require('conn.php');
	
	$nreleaseq = "SELECT ProductID, CatID, Author, Title, Genre, ReleaseDate, Price, InStock, PSize, Artwork FROM `Product` ORDER BY AddDate DESC LIMIT 9";

	$result = mysqli_query($link, $nreleaseq);
		
		$x = 0;
		if ($result-> num_rows == 0){
			echo "<p>0 results</p>";
		} else {
			
		while ($row = $result->fetch_assoc()) {
			$productID = $row['ProductID'];
			$catid = $row['CatID'];
			$author = $row['Author'];
			$titlefull = $row['Title'];
			if (strlen($titlefull) > 10){
				$title = substr($titlefull,0,11).'...';
			} else {
				$title = $titlefull;
			}
			$genre = $row['Genre'];
			$reldate = $row['ReleaseDate'];
			$price = $row['Price'];
			$stock = $row['InStock'];
			$size = $row['Psize'];
			$art = $row['Artwork'];
			$inStock = $row['InStock'];
		?>	
		<div class="productCard">
			<?php 
			
			echo '<img src="'. $art .'" alt="Kuva puuttuu">';
			
			echo '<h4> '. utf8_encode($author) .' : '. utf8_encode($title) .' </h4>';
			if ($catid == '1'){
				echo '<p>CD</p>';
			} elseif ($catid == '2'){
				echo '<p>LP</p>';
			} elseif ($catid == '3'){
				echo '<p>CASS</p>';
			} elseif ($catid == '4'){
				echo '<p>DVD</p>';
			} else {	
				echo '<p>SHIRT</p>';
			}
			
			echo '<p>Hinta: '.$price.' €</p>';
			echo '<p>Varastossa: '.$stock.'</p>';
			
			//------- "Lisää koriin" -NAPPI !!!!
			if ($inStock == '0') {
				echo "<button class='soldOut'  type='button' disabled >Loppuunmyyty </button>" ;
			} else {
				echo "<button id='addToCart' onclick='addToCart(" . $productID . ")' type='button'>Lisää koriin </button>" ;
			}
			?>
		</div>
		<?} 
		}		?>

<script>
	function addToCart(pid) { // tuotteen lisäys koriin | (pid=productID parametrinä)
		var text = "./cart.php?action=add&id=" + pid ;	// cart.php - Add + ID
		$('#mid').empty().load(text); // <-- huomaa tämä!
		$('#cartContent').empty().load('cart.php?action=showMini'); // cart.php - showMini (päivitys)
	}
</script>
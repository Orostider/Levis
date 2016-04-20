<?php
	session_start();
	require('conn.php');
	require('cartcheck.php');

	$feedQuery = "SELECT * FROM Articles GROUP BY PublishDate DESC";
	$result = mysqli_query($link, $feedQuery);
	//echo "Rivejä: " . (int)$result->num_rows . "<br>"; //testi
	
	if ((int)$result->num_rows > 0) {
		echo '<div id="mainNewsfeed">'; // Main div koko listalle
		
		while($row = $result->fetch_assoc()) { //hakee rivin arrayna
			$articlePath = $row['FilePath'];
			$article = fopen($articlePath, "r") or die("Unable to read file");
			//Hae otsikko (eka rivi)
			$headline = fgets($article);
			//Hae loput artikkelista
			$text = "";
			while(!feof($article)) {
				$line = fgets($article);
				$text = $text . $line;
			}
			$date = $row['PublishDate'];
			$formattedDate = date("d.m.Y H:i", strtotime($date)); //DD.MM.YYYY HH:MM
			$author = $row['Author'];
			
			// -------- div yksittäiselle uutiselle
			echo '<div id="article">';
			// Sisältö
			echo '<p class="articleContent">';
			echo '<h4>' . $headline . '</h4>';
			echo $text;
			echo "<br>" . $formattedDate . ' - ' . $author . '<br></p>';
			
			// ------------ mini div loppuu
			echo '</div>';
		}
		//------------------------ main div loppuu
		echo '<div>';
	} else {
		echo 'Ei uutisia';
	}
?>
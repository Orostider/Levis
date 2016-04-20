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
		<div id="container">
			<!-- top -->
			<div class="row" id="topRow">
				<div class="col-md-2" id="logo">
					<img src="images/ebin.jpg" alt="">
				</div>
				<div class="col-md-4" id="companyTitle">
					<a href="index.php">Levis</a>
					<h3>Music, for the sake of humanity.</h3>
				</div>
				<div class="col-md-6" id="top">
					<div class="col-md-3" id="login">
						<div class="circle">
							<i class="fa fa-user fa-2x"></i>
						</div>
						
						<?php
							if ($_SESSION['logged user']==1 and isset($_COOKIE['submitted']))  {
								echo "<a href='logout.php' id='logoutBtn' name='logoutBtn'>Kirjaudu ulos<br>(".$_COOKIE['submitted'].")</a>";
							} elseif ($_SESSION['logged admin']==1 and isset($_COOKIE['submitted'])) { 
								echo "<a href='logout.php' id='logoutBtn' name='logoutBtn'>Kirjaudu ulos<br>(".$_COOKIE['submitted'].")</a>";
							} else {			
								$_SESSION['logged user'] = 0;
								$_SESSION['logged admin'] = 0;
								$_SESSION['ID'] = 0;
						?>
								<a href="#" id='loginBtn' >Kirjaudu</a>
								<div id="loginContent">
									<a href='loginkok.php'> Kirjaudu </a>
									<a href='registerkok.php'> Rekisteröidy </a>
								</div>
						<?php
							}
						?>
					</div>
					<div class="col-md-3" id="cart">
						<div class="circle">
							<i class="fa fa-shopping-cart fa-2x"></i>
						</div>
						<a href="#" id="cartBtn">Ostoskori</a>
						<div id="cartContent"></div>
					</div>
					<div class="col-md-6" id="wisdom">
						<div class="circle">
							<i class="fa fa-hand-o-right fa-2x"></i>
						</div>
						<?php require('wisdom.php'); ?>
					</div>
				</div>
			</div>
			<!-- menu -->
			<div class="row" id="menu">
				<div class="col-md-6" id="nav">
					<a href="#" id="productsBtn">Tuotteet</a>
					<a href="#" id="contactBtn">Yhteystiedot</a>
				</div>
				<div class="col-md-6" id="search">
					<!-- search -->
					<form action='searchPage.php' method='POST'>
						<input type="text" id="searchBar" placeholder="Haku" name='keyWord'>
						<select id='searchCat' name='category'>
							<option value='Author'> Artisti </option>
							<option value='Title'> Albumi/Title </option>
							<option value='Genre'> Genre </option>
						</select>	
						<input type='submit' id='submitSearch' name='submitSearch' value='Search' >
					</form>
				</div>
			</div>
			<!-- mid -->
			<div class="row" id="mid">
				<div class="col-md-8" id="content">
					<?php
						$keyWord = $_POST['keyWord'];
						$searchCategory = $_POST['category'];

						echo "Tulokset haulle \"" . $searchCategory . ' - ' . $keyWord . "\":<br>";
						if ($searchCategory == 'Author') {
							$searchQuery = 'SELECT * FROM Product WHERE Author="' . $keyWord .'"';
							getList2($searchQuery);
						}
						else if ($searchCategory == 'Title') {
							$searchQuery = 'Select * FROM Product WHERE Title="' . $keyWord .'"';
							getList2($searchQuery);
						}
						else if ($searchCategory == 'Genre') {
							$searchQuery = 'Select * FROM Product WHERE Genre="' . $keyWord .'"';
							getList2($searchQuery);
						}
						
						function getList2($query) {
							require('dbconf.php');
							$link = mysqli_connect($dbConn['host'],$dbConn['user'],$dbConn['pass'],$dbConn['name']);
							if (!$link) {
								die("Connection failed: " . mysqli_connect_error());
							} // if
							$result = mysqli_query($link, $query);
							if ($result-> num_rows > 0) {
								echo '<div id="mainProductlistDiv">'; // -- Main DIV  koko tuotelistalle

								while($row = $result->fetch_assoc()){
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
									echo '<div class="productList">';
									// Picture
									echo "<img class='searchPicture' src='" . $image . "' alt='Kuva puuttuu'> "; 
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
									} //else
									
									// ------------ mini div loppuu
									echo '</div>';  
								}// while
								//------------------------ main div loppuu
								echo '<div>'; 
							} else {
								echo 'Ei tuloksia hakusanalla';
							} // else
						} // function getList2(query);	
					?>
						</div>
					</div>
				</div>
			</div>
			<!-- footer -->
			<div class="row" id="bottom">
				<div class="col-md-12" id="footer">
					<p id='koklo'>&copy; <?php echo date("Y") ?> - Levykauppa Levis - Kaikkiin tuotteisiin lisätty alv.</p>
				</div>
			</div>
	</body>
	
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
	
</html>
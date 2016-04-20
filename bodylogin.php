<?php 
	session_start();
	require('conn.php');
	require('cartcheck.php');
?>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="all.js"></script>

<div id="container">
			<!-- top -->
			<div class="row" id="topRow">
				<div class="col-md-2" id="logo">
					<img src="images/ebin.jpg" alt=""></img>
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
						<?php echo "<a href='logout.php' id='logoutBtn' name='logoutBtn'>Kirjaudu ulos<br>(".$_COOKIE['submitted'].")</a>";
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
						<input type='submit' name='submitSearch' value='Search' >
					</form>
				</div>
			</div>
			<!-- mid -->
			<div class="row" id="mid">
				<div class="col-md-8" id="content">
					<h2>Uutuudet</h2>
					<hr>
					<div id="newest"></div>
				</div>
				<div class="col-md-4" id="news">
					<h2>Ajankohtaista</h2>
					<hr>
					<div class="newsfeed"></div>
				</div>
			</div>
			<!-- footer -->
			<div class="row" id="bottom">
				<div class="col-md-12" id="footer">
					<p id='koklo'>&copy; <?php echo date("Y") ?> - Levykauppa Levis - Kaikkiin tuotteisiin lisätty alv.</p>
				</div>
			</div>
		</div>
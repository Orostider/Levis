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
		<?php
			if ($_SESSION['logged user']==1 and isset($_COOKIE['submitted']))  {
					echo '<script> $("body").load("bodylogin.php");</script>';
			} elseif ($_SESSION['logged admin']==1 and isset($_COOKIE['submitted'])) { 
				echo '<script> $("body").load("bodyadmin.php");</script>';
			} else {			
			$_SESSION['logged user'] = 0;
			$_SESSION['logged admin'] = 0;
			$_SESSION['ID'] = 0;
			?>
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
						<a href="#" id="loginBtn">Kirjaudu</a>
						<div id="loginContent">
							<a href='loginkok.php'> Kirjaudu </a>
							<a href='registerkok.php'> Rekisteröidy </a>
						</div>
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
						<div id="loginFields">
							<form method="POST" id="loginForm">
									<label for="username">Käyttäjätunnus: </label>
									<input type="text" name="username" id="username">
									<p></p>
									<label for="password">Salasana: </label>
									<input type="password" name="password" id="password">
									<p></p>
									<p></p>
									<input type="submit" id="submitLogin" name="submitLogin" value="Kirjaudu">
							</form>
							<?php require('login.php'); ?>
						</div>
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
			<?php
		}
		?>
	</body>
</html>
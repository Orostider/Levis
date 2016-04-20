<script>
	$(document).ready(function(){
				
		// uutta ja kivaa:
		$('#orderByArtistCD').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByArtistCD'); // - Order CDs by Artist
		})
		
		$('#orderByGenreCD').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByGenreCD'); // - Order CDs by Genre
		})
		
		$('#orderByArtistLP').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByArtistLP'); // - Order LPs by Artist
		})
		
		$('#orderByGenreLP').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByGenreLP'); // - Order LPs by Genre
		})
		
		$('#orderByArtistCS').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByArtistCS'); // - Order Kasetit(CS) by Artist
		})
		
		$('#orderByGenreCS').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByGenreCS'); // - Order Kasetit(CS) by Genre
		})
		
		$('#orderByArtistDVD').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByArtistDVD'); // - Order DVDt(DVD) by Artist
		})
		
		$('#orderByGenreDVD').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByGenreDVD'); // - Order DVDt(DVD) by Genre
		})
		
		$('#orderByArtistSH').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByArtistSH'); // - Order Paidat(SH) by Artist
		})
		
		$('#orderByGenreSH').click(function(){
			$('#loadProductList').empty().load('orderedProductList.php?action=orderByGenreSH'); // - Order Paidat(SH) by Genre
		})
				
		// Vanhat:
		$('.more').hide();
				
		$('#cdBtn').click(function(){
			$('#cd').slideToggle("slow");
		}) // loginBtn.click
				
		$('#lpBtn').click(function(){
			$('#lp').slideToggle("slow");
		}) // cartBtn.click
				
		$('#cassBtn').click(function(){
			$('#cass').slideToggle("slow");
		}) // cartBtn.click
		
		$('#dvdBtn').click(function(){
			$('#dvd').slideToggle("slow");
		}) // cartBtn.click
		
		$('#shirtBtn').click(function(){
			$('#shirt').slideToggle("slow");
		}) // cartBtn.click
				
	}); //  document.ready
		</script>

<div class="col-md-4">
	<div id="categories">
		<a href="#" id="cdBtn"><h4>CD</h4></a>
		<div class="more" id="cd">
			<a id='orderByArtistCD' href="#">Artisti</a>
			<br><a id='orderByGenreCD' href="#">Genre</a>
		</div>
		
		<a href="#" id="lpBtn"><h4>LP</h4></a>
		<div class="more" id="lp">
			<a id='orderByArtistLP' href="#">Artisti</a>
			<br><a id='orderByGenreLP' href="#">Genre</a>
		</div>
		
		<a href="#" id="cassBtn"><h4>Cass</h4></a>
		<div class="more" id="cass">
			<a id='orderByArtistCS' href="#">Artisti</a>
			<br><a id='orderByGenreCS' href="#">Genre</a>
		</div>
		
		<a href="#" id="dvdBtn"><h4>DVD</h4></a>
		<div class="more" id="dvd">
			<a id='orderByArtistDVD' href="#">Artisti</a>
			<br><a id='orderByGenreDVD' href="#">Genre</a>
		</div>
		
		<a href="#" id="shirtBtn"><h4>Paidat</h4></a>
		<div class="more" id="shirt">
			<a id='orderByArtistSH' href="#">Artisti</a>
			<br><a id='orderByGenreSH' href="#">Genre</a>
		</div>
	</div>
</div>
<div class="col-md-8">
	<div id="loadProductList">
		<!-- Listaus -->
		<?php
			session_start();
			require('productList.php'); // tuotelista
			require('conn.php');
			require('cartcheck.php');
		?>
	</div>
</div>
<?php 
	session_start();
	require('conn.php');
	require('cartcheck.php');
?>

<div id="contact">
	<h4>Contact us</h4>
	<p>Email: levis&commat;eioikee.com<br>Phone: 040123456</p>
	<div id="map">
	</div>
	<script>
		var map;
		var coordinates = {lat: 60.221103, lng: 24.804930};
		var marker;
		
		function initMap() {
			map = new google.maps.Map(document.getElementById("map"), {zoom: 15, center: coordinates});
			marker = new google.maps.Marker({position: coordinates, map: map});
		}
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBShvpZyITHlKzbilKNGLSCkgf41vwGfA&callback=initMap">
	</script>
</div>
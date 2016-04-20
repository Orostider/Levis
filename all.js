$(document).ready(function(){
				
	$('#loginContent').hide();
	
	$('#loginBtn').click(function(){
		$('#loginContent').slideToggle("slow");
	}) // loginBtn.click
	
	$('#cartBtn').click(function(){
		$('#cartContent').slideToggle("slow");
		$('#cartContent').load('cart.php?action=showMini'); // <-- scriptin linkki
	}) // cartBtn.click
	
	$('#productsBtn').click(function(){
		$('#mid').load('products.php');
	})
	$('#registerBtn').click(function(){
		$('#mid').load('register.php');
	})
	$('#adminBtn').click(function(){
		$('#mid').load('productAdd.php');
	})
	$('#logoutBtn').click(function(){
		$('#mid').load('logout.php');
	})
	$('#contactBtn').click(function(){
		$('#mid').load('contact.php');
	})
	
	$('#newest').load('productCard.php');
	
	$('.newsfeed').load('newsfeed.php');
	
	$('#addproduct').click(function(){
		//$('#adminfun').slideToggle("slow");
		$('#adminfun').load('productentry.php');
	})
	
	$('#addarticle').click(function(){
		//$('#adminfun').slideToggle("slow");
		$('#adminfun').load('addArticle.php');
	})
	
	$('#porders').click(function(){
		//$('#adminfun').slideToggle("slow");
		$('#adminfun').load('paidorders.php');
	})
	
	$('#rorders').click(function(){
		//$('#adminfun').slideToggle("slow");
		$('#adminfun').load('reserveorder.php');
	})
	
	$('#sales').click(function(){
		//$('#adminfun').slideToggle("slow");
		$('#adminfun').load('sales.php');
	})
	
	$('#productses').click(function(){
		//$('#adminfun').slideToggle("slow");
		$('#adminfun').load('allProducts.php');
	})
	
}); //  document.ready
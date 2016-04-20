<div>
<p> Please insert product info:</p>
	<form action="adminpage.php" method="POST" id="submitForm">
		<label for "category"> Category: (default is CD) </label>
		<input type="radio" id="category" name="category" value="1" checked> CD 
		<input type="radio" id="category" name="category" value="2"> LP 
		<input type="radio" id="category" name="category" value="3"> CASS 
		<input type="radio" id="category" name="category" value="4"> DVD 
		<input type="radio" id="category" name="category" value="5"> SHIRT 
		<p></p>
	
		<label for "artist"> Artist: </label>
		<input type="text" id="artist" name="artist">
		<p></p>	
	
		<label for "title"> Title: </label>
		<input type="text" id="title" name="title">
		<p></p>
	
		<label for "genre"> Genre: </label>
		<input type="text" id="genre" name="genre">
		<p></p>
		
		<label for "reldate"> Date of release: (YYYY-MM-DD) </label>
		<input type="text" id="reldate" name="reldate">
		<p></p>
	
		<label for "price"> Price: </label>
		<input type="text" id="price" name="price">
		<p></p>
	
		<label for "amount"> Amount: </label>
		<input type="text" id="amount" name="amount">
		<p></p>
	
		<label for "psize"> Size: </label>
		<input type="text" id="psize" name="psize">
		<p></p>
	
		<label for "artwork"> Artwork path: (./pictures/imagename.file) </label>
		<input type="text" id="artwork" name="artwork">
		<p></p>
		
		<input type="submit" name="submitProduct">
	</form>
</div>
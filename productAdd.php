<div>
	<h4>Lisää tuote:</h4>
	<form action="index.php" method="POST" id="submitForm">
		<label for "category"> Kategoria: (oletuksena on CD) </label>
		<input type="radio" id="category" name="category" value="1" checked> CD 
		<input type="radio" id="category" name="category" value="2"> LP 
		<input type="radio" id="category" name="category" value="3"> CASS 
		<input type="radio" id="category" name="category" value="4"> DVD 
		<input type="radio" id="category" name="category" value="5"> SHIRT 
		<p></p>
	
		<label for="artist"> Artisti: </label>
		<input type="text" id="artist" name="artist">
		<p></p>	
	
		<label for="title"> Teos: </label>
		<input type="text" id="title" name="title">
		<p></p>
	
		<label for="genre"> Genre: </label>
		<input type="text" id="genre" name="genre">
		<p></p>
		
		<label for="reldate"> Julkaisup&auml;iv&auml;: (YYYY-MM-DD) </label>
		<input type="text" id="reldate" name="reldate">
		<p></p>
	
		<label for="price"> Hinta: </label>
		<input type="text" id="price" name="price">
		<p></p>
	
		<label for="amount"> Lukum&auml;&auml;r&auml;: </label>
		<input type="text" id="amount" name="amount">
		<p></p>
	
		<label for="psize"> Koko: </label>
		<input type="text" id="psize" name="psize">
		<p></p>
	
		<label for="artwork"> Kuvan polku: (../pictures/imagename.file) </label>
		<input type="text" id="artwork" name="artwork">
		<p></p>
		
		<input type="submit" name="submit" value="Lisää">
	</form>
</div>
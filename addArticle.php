<div>
	<h4>Tee uusi päivitys:</h4>
	<form action="adminpage.php" method="POST" id="articleForm">
		<label for="articleTitle"> Otsikko: </label>
		<input type="text" id="articleTitle" name="articleTitle">
		<p></p>
	
		<label for="articleText"> Teksti: </label>
		<textarea rows="5" cols="50" name="articleText" form="articleForm"></textarea>
		<p></p>
		
		<input type="submit" name="submitArticle" value="Valmis">
	</form>
</div>
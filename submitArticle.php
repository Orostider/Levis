<?php
	session_start();
	require('conn.php');
	
	if(isset($_POST['submitArticle'])){
		$articleTitle = $_POST['articleTitle'];
		$articleText = $_POST['articleText'];
		//Get ArticleID safely
		$maxQuery = "SELECT MAX(ArticleID) as maxID FROM Articles";
		$maxResult = mysqli_query($link, $maxQuery);
		$orderRow = $maxResult -> fetch_assoc();
		$oidnon = $orderRow['maxID'];
		$articleID = ((int)$oidnon)+1;
		//Details
		$author = $_COOKIE['submitted']; //username
		$articlePath = "articles/" . $articleID . ".txt";
		//Generate txt and write
		$newArticle = fopen($articlePath, "w") or die("Unable to open file");
		fwrite($newArticle, $articleTitle . "\n" . $articleText);
		fclose($newArticle);
		//Add to database
		$addArticleQuery = "INSERT INTO Articles(ArticleID, FilePath, PublishDate, Author)
							VALUES (" . $articleID . ", '". $articlePath . "', now(), '". $author ."')";
		if ($link->query($addArticleQuery) === TRUE) {
				echo "<script> window.alert('Uusi päivitys lisätty onnistuneesti!');</script>";
		} else {
			echo "<script> window.alert('Virhe!');</script>";
			//echo "Virhe: " . $addArticleQuery . "<br>" . $link->error;
		}
	}
?>
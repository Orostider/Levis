<?php 
	session_start();
	require('conn.php');
	
	$prod = "SELECT ProductID, Author, Title, CType, Price, InStock
					FROM Product INNER JOIN Category
					ON Product.CatID = Category.CatID";

	$result = mysqli_query($link, $prod);
		
	$x = 0;
	if ($result-> num_rows == 0){
		echo "<p>0 results</p>";
	} else {
?>
	<table class="porder" style="width:100%">	  
					
<?php	
		while ($row = $result->fetch_assoc()) {
			$proid = $row['ProductID'];
			$aut = $row['Author'];
			$titfull = $row['Title'];
			if (strlen($titfull) > 35){
			$tit = substr($titfull,0,35).'...';
			} else {
				$tit = $titfull;
			}
			
			$type = $row['CType'];
			$price = $row['Price'];
			$stock = $row['InStock'];	
			
?>	
	<div class="orderlist">
<?php
	echo '
	
	<tr>
		<th>ProductID</th>
		<th>Author</th>
		<th>Title</th>
		<th>Type</th>
		<th>Price</th>
		<th>Stock</th>
	</tr>	
	
	<tr>
		<td>'.$proid.'</td>
		<td>'.utf8_encode($aut).'</td>
		<td>'.utf8_encode($tit).'</td>
		<td>'.$type.'</td>
		<td>'.$price.' &euro;</td>
		<td>'.$stock.'</td>	
	</tr>

	';
?>
	</div>
<?php
	}
?>
	</table>
<?php
	}
?>
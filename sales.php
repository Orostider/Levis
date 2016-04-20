<?php 
	session_start();
	require('conn.php');
	
	$saleslist = "SELECT Details.ProductID as ProductID, SUM(Quantity) as Sold, SUM(Quantity*Price) as Net
		FROM Details INNER JOIN Product
		ON Details.ProductID = Product.ProductID
		GROUP BY Details.ProductID";

	$result = mysqli_query($link, $saleslist);
		
	$x = 0;
	if ($result-> num_rows == 0){
		echo "<p>0 results 2</p>";
	} else {
?>
	<table class="porder" style="width:100%">	  
					
<?php	
	while ($row = $result->fetch_assoc()) {
		$proid = $row['ProductID'];
		$sold = $row['Sold'];
		$net = $row['Net'];					
?>	
	<div class="orderlist">

<?php 
	echo '
		<tr>
			<th>ProductID</th>
			<th>Sold</th>
			<th>Net</th>
		</tr>

		<tr>
			<td>'.$proid.'</td>
			<td>'.$sold.' kpl</td>
			<td>'.$net.' &euro;</td>				
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
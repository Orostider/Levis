<?php 
	session_start();
	require('conn.php');
	
	$paidlist = "SELECT O.OrderID as OrderID, UserID, ShipperID, OrderDate, TotalPrice, Status 
		FROM Orders O INNER JOIN Billing B 
		ON O.OrderID = B.OrderID 
		WHERE Status = 'Reserved'";

	$result = mysqli_query($link, $paidlist);
		
	$x = 0;
	if ($result-> num_rows == 0){
		echo "<p>0 results</p>";
	} else {
?>
		
<script> 
	function pay(oid){
		var x = "./respayment.php?oid="+oid;
		$('#adminfun').load(x);
	}
</script>	  

<?php	
	while ($row = $result->fetch_assoc()) {
		$oid = $row['OrderID'];
		$uid = $row['UserID'];
		$ship = $row['ShipperID'];
		$date = $row['OrderDate'];
		$totp = $row['TotalPrice'];
		$stat = $row['Status'];
?>
	<div class="orderlist">

<?php 
	echo '
		<table class="porder" style="width:100%">
			<tr>
				<th>OrderID</th>
				<th>UserID</th>
				<th>ShipperID</th>
				<th>OrderDate</th>
				<th>Total</th>
				<th>Status</th>
			</tr>

			<tr>
				<td>'.$oid.'</td>
				<td>'.$uid.'</td>
				<td>'.$ship.'</td>
				<td>'.$date.'</td>
				<td>'.$totp.'</td>
				<td>'.$stat.' <button type="button" class="resbtn" onclick="pay('.$oid.')">Pay</button></td>					
			</tr>
				  
			<tr>
				<td>&nbsp;</td>	
				<th>ProductID</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>&nbsp;</th>
				<td>&nbsp;</td>
			</tr>
		';
		
		$innerquery = 'SELECT OrderID, D.ProductID as ProductID, Quantity, Price FROM Details D INNER JOIN Product P ON D.ProductID = P.ProductID WHERE OrderID = '.$oid.'';
		$result2 = mysqli_query($link, $innerquery);

		while ($row2 = $result2->fetch_assoc()) {
			$poid = $row2['ProductID'];
			$q = $row2['Quantity'];
			$price = $row2['Price'];

		echo '				
			<tr>
				<td>&nbsp;</td>	
				<td>'.$poid.'</td>
				<td>'.$q.'</td>
				<td>'.$price.'</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>									
			 </tr>
		';
		}
				
		echo '
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
				
		</table>';
?>
	</div>
<?php
	} 
}
?>
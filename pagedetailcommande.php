<?php
session_start();
if (isset($_SESSION['val'])) {
	$_SESSION['value']=$_SESSION['val'];
	unset($_SESSION['val']);
}
?>
<!DOCTYPE HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Page Detail Commande</title>
</head>
<body>
<?php
if (isset($_SESSION['value'])) {
	displayCommande($_SESSION['value']);
}
?>
<a href="pagecommande.php">Acceuil</a></br>
<?php
function displayCommande($val){
	$db = pg_connect("dbname=cyclesISEN host=localhost user=guillaumecourmont");
	$res=pg_query("SELECT  *  FROM commande WHERE reference_commande = $val");
	$row=pg_fetch_row($res);
?>
<form>
	<table border="1">
		<tr>
			<th>Reference</th>
			<th>Fournisseur</th>
			<th>Livraison Souhaitée</th>
			<th>Date Livraison</th>
		</tr>
		<tr>
			<td> <?php echo $row[0]; ?> </td>
			<td> <?php echo $row[1]; ?> </td>
			<td> <?php echo $row[2]; ?> </td>
			<td> <?php echo $row[3]; ?> </td>
		</tr>
	</table>
</form>
<?php } 
unset($_SESSION['value']);
?>
</body>
</html>

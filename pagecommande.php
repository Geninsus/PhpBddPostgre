<?php
session_start();

?>
<!DOCTYPE HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Page Commande</title>
</head>
<body>
<form action="pagecommande.php" method = "post">

<table BORDER="1">
	<tr>
		<th> Choix du tri</th>
	</tr>
	<tr>

      	<td>
      		<input type="checkbox"  name="select" value="reference_commande">Reference Commande</input></br>
      		<input type="checkbox"  name="select" value="raison_sociale">Fournisseur</input></br>
      		<input type="checkbox"  name="select" value="date_commande">Date Commande</input></br>
      		<input type="checkbox"  name="select" value="date_livraison_souhaitee">Date Livraison Souhaitée</input></br>
      	</td>
    </tr>
</table>

Entrez le nombre de résultat souhaité : <input type="text" name="Nbr"/>
<button type="submit">Valide</button>
</br>

  <?php
    $db = pg_connect("dbname=cyclesISEN host=localhost user=guillaumecourmont");
    if(!$db){
	   echo "Probléme" . "</br>";
    }
    if (isset($_GET['stop'])) {
            if (isset($stop)) {
                $stop = $stop + $stop;
            }else{
            $stop = $Nbr;
            }
        }else{
            $stop = 0;
        }
    if (isset($_POST['Nbr'])) {
   	  $Nbr = $_POST['Nbr'];
    }
    if (isset($_POST['select']) and isset($Nbr)) {
	   $tri = $_POST['select'];
  ?>

<form> 

<table border="1">
	<tr>
		<th>Ref Commande</th>
		<th>Fournisseur</th>
		<th>Date Commande</th>
		<th>Date Livraison</th>
	</tr>
	<tr>
		<td>
		<?php
		$res = pg_query("SELECT reference_commande FROM commande ORDER BY $tri LIMIT $Nbr OFFSET $stop");
        $row = pg_num_rows($res);

         	if ($Nbr>$row) {$Nbr=$row;}

         	for($i=0;$i<$Nbr;$i++){
            	$val=pg_fetch_result($res, $i, 0);
            	 ?><a href='pagedetailcommande.php?value='$i''><?php echo $val."</br>";?></a>
            <?php } ?>
		
        </td>		
		<td>
		<?php 
		 $res = pg_query("SELECT raison_sociale FROM commande ORDER BY $tri LIMIT $Nbr OFFSET $stop");
         $row = pg_num_rows($res);

         	if ($Nbr>$row) {$Nbr=$row;}

         	for($i=1;$i<=$Nbr;$i++){
            	$val=pg_fetch_result($res, $i-1, 0);
            	echo $val."</br>";
            }     	
		?>
		</td>	
		<td>
		<?php 
         $res = pg_query("SELECT date_commande FROM commande ORDER BY $tri LIMIT $Nbr OFFSET $stop");
         $row = pg_num_rows($res);

         	if ($Nbr>$row) {$Nbr=$row;}

         	for($i=1;$i<=$Nbr;$i++){
            	$val=pg_fetch_result($res, $i-1, 0);
            	echo $val."</br>";
            }
		?>
		</td>
		<td>
		<?php
         $res = pg_query("SELECT date_livraison_souhaitee FROM commande ORDER BY $tri LIMIT $Nbr OFFSET $stop");
         $row = pg_num_rows($res);

         	if ($Nbr>$row) {$Nbr=$row;}

         	for($i=1;$i<=$Nbr;$i++){
            	$val=pg_fetch_result($res, $i-1, 0);
            	echo $val."</br>";
            }
		?>
		</td>
	</tr>
</table>

<button type="submit" name="stop">Suivante</button>

<?php		
}
?>

</form>
</body>
</html>

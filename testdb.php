<!DOCTYPE HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Relier Php Et PostgreSql</title>
</head>
<body>
<form action="testdb.php" method = "post">
<TABLE BORDER="1"> 
      <TR> 
         <TH> Table </TH> 
         <TH> Colonne </TH>
      </TR> 
      <TR> 
         <TD>
            
            <input type="checkbox"  name="from[]" value="fournisseur">Fournisseur</input></br>
         </TD> 
         <TD> 
			<input type="checkbox"  name="select[]" value="raison_sociale">Raison Sociale</input></br>
            <input type="checkbox"  name="select[]" value="nom_directeur">Nom du Directeur</input></br>    
         </TD> 
      </TR>
      <tr>
      	<td>
      		<input type="checkbox"  name="from[]" value="piece">Piece</input></br> 
      	</td>
      	<td>
      		<input type="checkbox"  name="select[]" value="reference_piece">Reference Piece</input></br>
      		<input type="checkbox"  name="select[]" value="reference_commande">Reference Commande</input></br>
      		<input type="checkbox"  name="select[]" value="numero_ligne_commande">Numero Ligne De COmmande</input></br>
      		<input type="checkbox"  name="select[]" value="reference_type_piece">Reference Type Piece</input></br> 
      	</td>
      </tr>
      <tr>
      	<td>
      		<input type="checkbox"  name="from[]" value="ligne_commande">Ligne Commande</input></br> 
      	</td>
      	<td>
      		<input type="checkbox"  name="select[]" value="reference_commande">Reference Commande</input></br>
      		<input type="checkbox"  name="select[]" value="numero_ligne_commande">Numero Ligne De COmmande</input></br>
      		<input type="checkbox"  name="select[]" value="reference_type_piece">Reference Type Piece</input></br> 
      		<input type="checkbox"  name="select[]" value="quantite_pieces_commandees">Quantité Pièces Commandées</input></br>
      		<input type="checkbox"  name="select[]" value="prix_piece">Prix Pièce</input></br> 
      	</td>
      </tr>
      <tr>
      	<td>
      		<input type="checkbox"  name="from[]" value="commande">Commande</input></br>
      	</td>
      	<td>
      		<input type="checkbox"  name="select[]" value="reference_commande">Reference Commande</input></br>
      		<input type="checkbox"  name="select[]" value="raison_sociale">Raison Sociale</input></br>
      		<input type="checkbox"  name="select[]" value="date_commande">Date Commande</input></br>
      		<input type="checkbox"  name="select[]" value="date_livraison_souhaitee">Date Livraison Souhaitée</input></br>
      	</td>
      </tr>
      <tr>
      	<td>
      		<input type="checkbox"  name="from[]" value="type_piece">Type Piece</input></br>
      	</td>
      	<td>
      		<input type="checkbox"  name="select[]" value="reference_type_piece">Reference Type Piece</input></br>
      		<input type="checkbox"  name="select[]" value="libelle_type_piece">Libelle Type Piece</input></br>
      	</td>
      </tr>
      <tr>
      	<td>
      		<input type="checkbox"  name="from[]" value="commercialiser">Commercialiser</input></br>
      	</td>
      	<td>
      		<input type="checkbox"  name="select[]" value="raison_sociale">Raison Sociale</input></br>
      		<input type="checkbox"  name="select[]" value="reference_type_piece">Reference Type Piece</input></br> 
      	</td>
      </tr>
</TABLE>
<input type="value" name="Nbr"></input>
<button type="submit" target="Nbr">Valider</button>
</br>
</form>
<form>

<table border="1">
<tr><th>RESULTAT</th></tr>
<td>
<?php
   $db = pg_connect("dbname=cyclesISEN host=localhost user=guillaumecourmont");
   if(!$db){
      echo "Probléme" . "</br>";
   }

   if (isset($_POST['Nbr'])) {
   	$Nbr = $_POST['Nbr'];
   }

   if (isset($_POST['from']) and isset($_POST['select']) and isset($Nbr)) {
 	

   foreach($_POST['from'] as $from){
      foreach ($_POST['select'] as $select) {
         $res = pg_query("SELECT $select FROM $from");
         $row = pg_num_rows($res);
         if ($Nbr>$row) {
         	$Nbr=$row;
         }
         for($i=1;$i<=$Nbr;$i++){
            $val=pg_fetch_result($res, $i-1, 0);
            echo $i . " : " .$val."</br>";
         }
      }
   }
   pg_free_result($res);
   echo pg_last_error($db);
   }

?>
</td>
</table>
</form>
</body>
</html>

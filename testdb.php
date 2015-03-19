<!DOCTYPE HTML>
<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <title>Mon premier calculateur</title>
</head>
<body>
<p><h2>Choisissez UNE colonne et UNE table en rapport</h2></p>
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
      		<input type="checkbox"  name="select[]" value="quantites_pieces_commandees">Quantité Pièces Commandées</input></br>
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


<button type="submit" value="envoyer">envoyer</button>
</form>


<?php
   $db = pg_connect("dbname=cyclesISEN host=localhost user=guillaumecourmont");
   if(!$db){
      echo "Probléme" . "</br>";
   }else{
      echo "Entrée" . "</br>";
   }
   if (isset($_POST['from']) and isset($_POST['select'])) {
 
   foreach($_POST['from'] as $from){
      foreach ($_POST['select'] as $select) {
         $res = pg_query("SELECT $select FROM $from");
         while($row =pg_fetch_row($res)){
            echo "$select : $row[0]" . "</br>";
         }
      }
   }
   }
   echo pg_last_error($db);

?>

</body>
</html>

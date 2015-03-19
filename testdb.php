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
               <input type="checkbox"  name="select[]" value="reference_piece">Ref Piece</input></br>
               <input type="checkbox"  name="select[]" value="raison_sociale">Raison sociale</input></br>
         </TD> 
         <TD> 
               <input type="checkbox"  name="from[]" value="fournisseur">Fournisseur</input></br>
               <input type="checkbox"  name="from[]" value="piece">Piece</input></br> 
         </TD> 
      </TR> 
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

?>

</body>
</html>

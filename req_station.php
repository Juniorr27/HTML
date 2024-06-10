<?php
	// XXX : TP2 PHP Exo1 et Exo2
	// préparation SAE 2.456 : programme principal
	// connexion_oracle_etu.php 29/05/2021
	
	include_once "pdo_agile.php";
	include_once "param_connexion_etu.php";
	echo '<meta charset="utf-8"> ';
	// décommenter en fonction du serveur de BDD utilisé
	//define ("MOD_BDD","MYSQL");
	define ("MOD_BDD","ORACLE");

	if (MOD_BDD == "MYSQL")
	{
		$db_username = $db_usernameMySQL;		
		$db_password = $db_passwordMySQL;
		$db = $dbMySQL;
	}
	else
	{
		$db_username = $db_usernameOracle;		
		$db_password = $db_passwordOracle;	
		$db = $dbOracle;
	}
	
	$conn = OuvrirConnexionPDO($db,$db_username,$db_password);
    //$estPremiereConnexion = true;

	afficherObj($conn);

	if ($conn)
	{
		//echo ("<hr/> Connexion réussie à la base de données <br/>");
		//insererDonnee($conn);
		//corrigerDonnees($conn);
		$table = lireDonnees($conn);
		afficherObj($table);
	}
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");

	function lireDonnees($c)
	{
        if(!empty($_POST['elt_recherche'])){
            $elt_recherche = $_POST['elt_recherche'];
            $sql = "select * from alp_station join alp_region using(reg_num) where upper(reg_nom) LIKE upper('%".$elt_recherche."%')
            or sta_code LIKE ('%".$elt_recherche."%') 
            or sta_nom LIKE upper('%".$elt_recherche."%')
            or sta_longitude LIKE ('%".$elt_recherche."%')
            or sta_latitude LIKE ('%".$elt_recherche."%')
            or sta_altitude LIKE ('%".$elt_recherche."%')";

        }else if(!empty($_POST['sta_altitude_min']) && !empty($_POST['sta_altitude_max'])){
            $sql = "select * from alp_station join alp_region using(reg_num) where sta_altitude >=".$_POST['sta_altitude_min']." and sta_altitude <=".$_POST['sta_altitude_max'];
         
        }else{
            $sql = "select * from alp_station join alp_region using(reg_num)";
        }
		LireDonneesPDO2($c, $sql, $donnee);
		return $donnee;
	}
	
	function afficherObj($obj)
	{
		echo "<PRE>";
		
		echo "</PRE>";
	}
	
 ?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Liste des randonnées</title>
  <style> 
    table {
        border-collapse: collapse;
        border: 2px solid rgb(140 140 140);
        font-family: sans-serif;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    caption {
        caption-side: bottom;
        padding: 10px;
        font-weight: bold;
    }

    thead,
    tfoot {
        background-color: rgb(228 240 245);
    }

    th,
    td {
        border: 1px solid rgb(160 160 160);
        padding: 8px 10px;
    }

    td:last-of-type {
        text-align: center;
    }
</style>
</head>
<body>
	<h1> LISTE DES STATIONS</h1>
    <form action="req_station.php" method="post" enctype="application/x-www-form-urlencoded">

        <label for="elt_recherche">|O </label>
        <input type="text" name="elt_recherche" id="elt_recherche" placeholder="recherche" size="40" />

    </form>
    <h2> CRITERE FILTRE</h2>
    
    <form action="req_station.php" method="post" enctype="application/x-www-form-urlencoded">
        <p>
            <label for="sta_altitude_min">Altitude minimum : </label>
            <input type="number" name="sta_altitude_min" id="sta_altitude_min" placeholder="" min="1" max="3000" />
        </p>
        <p>
            <label for="sta_altitude_max">Altitude maximum : </label>
            <input type="number" name="sta_altitude_max" id="sta_altitude_max" placeholder="" min="1" max="3000" />
        </p>

        <p>
            <input type="button" name="Réinitialiser" id="Rénitialiser" value="Rénitialiser" />
            <input type="submit" name="Filtrer" id="Filtrer" value="Filtrer" />
          </p>
    </form>
    
    <?php
    echo "<table>";
    echo "<thead><tr><th>Numéro station</th><th>Nom Région</th><th>Nom de station</th><th>Longitude</th><th>Latitude</th><th>Altitude</th></tr></thead>";
    echo "<tbody>";
    if($table != null ){
            if(!empty($_POST['elt_recherche'])){
            echo "Recherche pour ".$_POST['elt_recherche'];
            }
        foreach($table as $i => $value){
            echo "<tr>";
            echo "<td>";
            print_r($table[$i]['STA_CODE']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['REG_NOM']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['STA_NOM']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['STA_LONGITUDE']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['STA_LATITUDE']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['STA_ALTITUDE']);
            echo "</td>";
            echo "</tr>";
        }
    }else{
        echo "</br>Aucun résultat";
    }
    echo "</tbody>";
    echo "</table>";
    ?>
    
    
</body>
</html>
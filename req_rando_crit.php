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
		$sql = "select * from alp_randonnee where niv_code > $difficulteMin
         and niv_code < $difficulteMax 
         and RAN_DATE_D > to_date('.$dateDeb.','dd/mm/yy')
         ";
        }else{
            $sql = "select * from alp_randonnee";
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

        <label for="difficulteMin">Difficulté minimum : </label>
        <input type="text" name="difficulteMin" id="difficulteMin" placeholder="nombre" size="10" />
		<label for="difficulteMax">Difficulté maximum : </label>
        <input type="text" name="difficulteMax" id="difficulteMax" placeholder="nombre" size="10" />
		<label for="dateDeb">Date début : </label>
        <input type="text" name="dateDeb" id="dateDeb" placeholder="date (dd/mm/yyyy)" size="20" />
		<label for="dateFin">Date fin : </label>
        <input type="text" name="dateFin" id="dateFin" placeholder="date (dd/mm/yyyy)" size="20" />
		<label for="prixMin">Prix minimum : </label>
        <input type="text" name="prixMin" id="prixMin" placeholder="nombre" size="10" />
		<label for="prixMax">Prix maximum : </label>
        <input type="text" name="prixMax" id="prixMax" placeholder="nombre" size="10" />

    </form>
    
    <?php
    echo "<table>";
    echo "<thead><tr><th>Num</th><th>Nom</th><th>Difficulté</th><th>Date début</th><th>Date fin</th><th>Prix</th></tr></thead>";
    echo "<tbody>";
    if($table != null ){
            if(!empty($_POST['elt_recherche'])){
            echo "Recherche pour ".$_POST['elt_recherche'];
            }
        foreach($table as $i => $value){
            echo "<tr>";
            echo "<td>";
            print_r($table[$i]['RAN_NUM']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['RAN_NOM']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['NIV_CODE']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['RAN_DATE_D']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['RAN_DATE_FIN']);
            echo "</td>";
            echo "<td>";
            print_r($table[$i]['RES_PRIX_PERS']);
            echo "</td>";
            echo "</tr>";
        }
    }else{
        echo "</br>Aucun résultat";
    }
    echo "</tbody>";
    echo "</table>";
    ?>
    <h2> CRITERE FILTRE</h2>
    
    <form action="req_station.php" method="post" enctype="application/x-www-form-urlencoded">
        <div id="doubleRange" class="doubleRange">
            <div class="barre">
                <div class="barreMilieu" style="width:50%; left:25%;"></div>
                <div class="t1 thumb" style="left:25%"></div>
                <div class="t2 thumb" style="left:75%;"></div>
            </div>
            <div class="label">de <span class="labelMin"></span> à <span class="labelMax"></span></div>
            <input type="hidden" name="pmin" value="" class="inputMin"/>
            <input type="hidden" name="pmax" value="" class="inputMax"/>
        </div>
    </form>
 
    <script type="text/javascript" src="doubleRange.js"></script>
    <script type="text/javascript">
        setDoubleRange({
            element: '#doubleRange',
            minValue: 0,
            maxValue: 50000,
            maxInfinite: true,
            stepValue: 1000,
        defaultMinValue: 500,
        defaultMaxValue: 10000,
            unite: '€'
        });
    </script>
    
</body>
</html>
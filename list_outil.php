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
	
	function insererDonnee($c)
	{
		$sql = "INSERT INTO bidon VALUES (25,'Valise','jaune')";
		afficherObj($sql);
		//$res = // compléter
		echo "Résultats de la requête " ,$res . "<br/>";
		$sql = "INSERT INTO bidon VALUES (28,'Valise','rouge')";
		afficherObj($sql);
		//$res = // compléter
		echo "Résultats de la requête ",$res . "<br/>";
	}
	
	function corrigerDonnees($c)
	{
		$sql = "update bidon set b='trousse' where b='Valise'";
		afficherObj($sql);
		//$res = // compléter
		echo "Résultats de la requête " . $res . "<br/>";
	}

	function lireDonnees($c)
	{
		$sql = "select alp_randonnee.*, (select count(*) as nb from alp_randonnee) as NOMBRE_DE_RANDONNEE_TOTAL  from alp_randonnee";
		LireDonneesPDO2($c, $sql, $donnee);
		return $donnee;
	}
	
	function afficherObj($obj)
	{
		echo "<PRE>";
		
		echo "</PRE>";
	}
	
 ?>
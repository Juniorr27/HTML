<?php
session_start(); 
	// E.Porcq : TP2 PHP Exo2
	// préparation SAE 2.456 : Traitement d'un formualaire
	// traitement_form.php 29/05/2021

	function afficherObj($obj)
	{
		echo "<PRE>";
		print_r($obj);
		echo "</PRE>";
	}

	include_once "pdo_agile.php";
	include_once "param_connexion_etu.php";
	echo '<meta charset="utf-8"> ';
	
	//connexion BD
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
	$donnee = array(); 

	if ($conn)
	{
		echo ("<hr/> Connexion réussie à la base de données <br/>");
		//insererDonnee($conn);
		//corrigerDonnees($conn);
		//$table = lireDonnees($conn);
		//afficherObj($table);
	}
	else
		echo ("<hr/> Connexion impossible à la base de données <br/>");

	// affichage brut des éléments du formulaire (à enlever); 
	afficherObj($_POST);
	$erreur=false; // true => formulaire défaut
	
	// il faut vérifier que ces données ont été saisies
	if (!empty($_POST["per_nom"]) )
		$per_nom = $_POST["per_nom"];
	else
		$erreur= true;

	if (!empty($_POST["per_prenom"]) )
		$per_prenom = $_POST["per_prenom"];
	else
		$erreur= true;

	if (!empty($_POST["per_mdp"]) )
		$per_mdp = $_POST["per_mdp"];
	else
		$erreur= true;

	if (!empty($_POST["per_mdp_conf"]) )
		$per_mdp_conf = $_POST["per_mdp_conf"];
	else
		$erreur= true;

	if (!empty($_POST["per_ville"]) )
		$per_ville = $_POST["per_ville"];
	else
		$erreur= true;

	if (isset($_POST["per_telephone"]) )
		$per_telephone = $_POST["per_telephone"];

	if (isset($_POST["per_courriel"]) )
		$per_courriel = $_POST["per_courriel"];
	else
		$erreur= true;	
	

	
	//vérifier si toutes les données obligatoires ont été saisies
	if($erreur == false){


		//Vérifier si ce courriel est déjà associé à un compte
		$sql = ("select count(*) as num from alp_personne where per_courriel = '".$per_courriel."' and per_mdp is not null");
		afficherObj($sql); 
		
		$num = LireDonneesPDO2($conn,$sql,$donnee);
		afficherObj($donnee); 
		
		//si le courriel est déjà associé à un compte
		if($donnee[0]["NUM"] != 0){
			
			echo "ce courriel est déjà associé à un compte <br/>"; 
		}

		//sinon
		else{

			//Vérifier si le mot de passe de confirmation est bon
			if($per_mdp != $per_mdp_conf){
				echo "les deux mots de passe doivent être les mêmes <br/>"; 
				exit; 
			}

			//on récupère le numéro de personne à ajouter
			$sql = "select nvl(max(per_num),0) as maxi from alp_personne";
			afficherObj($sql); 

			LireDonneesPDO2($conn,$sql,$donnee);  
			$per_num = $donnee[0]['MAXI'] + 1;	

			//on ajoute la personne à la BD
			if($per_telephone){

				$sql = "INSERT INTO alp_personne (per_num, per_nom, per_prenom, per_ville, per_telephone, 
					per_courriel, per_mdp) VALUES
			 		($per_num,'$per_nom','".$per_prenom."','".$per_ville."'
					,".$per_telephone.",'".$per_courriel."','".$per_mdp."')";

			}
			else{
				$sql = "INSERT INTO alp_personne (per_num, per_nom, per_prenom, per_ville, 
					per_courriel, per_mdp) VALUES
			 		($per_num,'$per_nom','".$per_prenom."','".$per_ville."','".$per_courriel."','".$per_mdp."')";
			}

			
			afficherObj($sql);
			$res = majDonneesPDO($conn,$sql); 
			
			echo "Résultats de la requête ",$res . "<br/>";
			afficherObj($res);


			//on ajoute le client à la BD
			$sql = "INSERT INTO alp_client (per_num, cli_nb_points_ec, cli_nb_points_tot, cli_date_connex) VALUES
			($per_num, 0, 0, sysdate)";

   			afficherObj($sql);
  			 $res = majDonneesPDO($conn,$sql); 

   			echo "Résultats de la requête ",$res . "<br/>";
  			 afficherObj($res);
			
			//on se connecte au compte crée
			$_SESSION['per_courriel'] = $per_courriel;
			
			echo "le compte est crée, vous êtes connectés avec $per_courriel <br/>"; 
		}
		
	}



	?>
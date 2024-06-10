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

	if (isset($_POST["res_nb_pers"]) )
		$res_nb_pers = $_POST["res_nb_pers"];
	else
		$erreur= true;

	if(isset($_SESSION['ran_num']))	
		$ran_num = $_SESSION['ran_num']; 
	else
		$erreur = true; 

	
	//vérifier si toutes les données obligatoires ont été saisies
	if($erreur == false){

		// vérifier si la personne existe déjà dans la base de donnée 


		//vérifier si le numéro de téléphone a été saisie
		$sql = ("select count(*) as num from alp_personne where per_nom = '".$per_nom."' and per_prenom = '".$per_prenom."' and per_ville = '".$per_ville."' and per_courriel = '".$per_courriel."'");
		afficherObj($sql); 
		
		$num = LireDonneesPDO2($conn,$sql,$donnee);
		afficherObj($donnee); 
	

		//si la personne n'existe pas déjà dans la base de donnée
		if($donnee[0]["NUM"] != 1){

			//on récupère le numéro de personne à ajouter
			$sql = "select nvl(max(per_num),0) as maxi from alp_personne";
			afficherObj($sql); 

			LireDonneesPDO2($conn,$sql,$donnee);  
			$per_num = $donnee[0]['MAXI'] + 1;	

			//on ajoute la personne à la BD
			if($per_telephone){

				$sql = "INSERT INTO alp_personne (per_num, per_nom, per_prenom, per_ville, per_telephone, 
					per_courriel) VALUES
			 		($per_num,'$per_nom','".$per_prenom."','".$per_ville."'
					,".$per_telephone.",'".$per_courriel."')";

			}
			else{
				$sql = "INSERT INTO alp_personne (per_num, per_nom, per_prenom, per_ville, 
					per_courriel) VALUES
			 		($per_num,'$per_nom','".$per_prenom."','".$per_ville."','".$per_courriel."')";
			}
		
			afficherObj($sql);
			$res = majDonneesPDO($conn,$sql); 
			
			echo "Résultats de la requête ",$res . "<br/>";
			afficherObj($res);
		}

		//sinon, on récupère son numéro
		else{

			$sql = "select per_num from alp_personne where per_nom = '".$per_nom."' and per_prenom = '".$per_prenom."' and per_ville = '".$per_ville."' and per_courriel = '".$per_courriel."'";
			afficherObj($sql);

			LireDonneesPDO2($conn,$sql,$donnee);  
			afficherObj($donnee); 
			$per_num = $donnee[0]['PER_NUM'];	

			//si un numéro de téléphone a été entré, on le met à jour
			if($per_telephone){
					$sql = "update alp_personne set per_telephone = $per_telephone where per_num = $per_num";
					afficherObj($sql);

				LireDonneesPDO2($conn,$sql,$donnee);  
				afficherObj($donnee); 
			}
			
		}

		//on vérifie si c'est déjà un client
		$sql = "select count(*) as num from alp_client where per_num = ".$per_num;
		afficherObj($sql); 

		$num = LireDonneesPDO2($conn,$sql,$donnee);
		afficherObj($donnee); 

		//s'il n'est pas déjà client
		if($donnee[0]["NUM"] != 1){

			//on récupère le numéro de personne à ajouter
		
			//on ajoute le client à la BD
				$sql = "INSERT INTO alp_client (per_num) VALUES
			 			($per_num)";
		
				afficherObj($sql);
				$res = majDonneesPDO($conn,$sql); 
			
				echo "Résultats de la requête ",$res . "<br/>";
				afficherObj($res);
		}

		//numéro de randonnée (à modifier)
		$sql = "select res_prix_pers from alp_randonnee where ran_num = $ran_num ";
		afficherObj($sql); 

		LireDonneesPDO2($conn,$sql,$donnee);  
		afficherObj($donnee);

		$res_prix_pers = $donnee[0]['RES_PRIX_PERS']; 

		$res_prix_tot = ($res_prix_pers * $res_nb_pers); 

		//Vérifier si il'y a déjà une réservation avec ce per_num
		$sql = "select count(*) as num from alp_reserver where per_num = ".$per_num." and ran_num = ".$ran_num;
		afficherObj($sql); 

		$num = LireDonneesPDO2($conn,$sql,$donnee);
		afficherObj($donnee);

		//s'il y a déjà une réservation 
		if($donnee[0]["NUM"] != 0){
			echo "Une réservation avec ce nom existe déjà.</br>"; 
		}

		//on ajoute une nouvelle réservation en utilisant son numéro
		else{
		$sql = "INSERT INTO alp_reserver (ran_num, per_num, res_nb_pers, res_prix_tot) VALUES 
		($ran_num, $per_num,".$res_nb_pers.",".$res_prix_tot.")";
		afficherObj($sql);

		$res = majDonneesPDO($conn,$sql);
		echo "Résultats de la requête ",$res . "<br/>";
		afficherObj($res);
		}
		

	}
	



	?>

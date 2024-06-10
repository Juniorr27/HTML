<?php
session_start();
  if (!empty($_GET["ran_num"]) )
		  $ran_num = $_GET["ran_num"];
	else{
    $erreur= true; 
  }

  $_SESSION['ran_num'] = $ran_num;

  echo "<h1> s'inscrire à la randonnée n° $ran_num"

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Randonnée</title>
</head>
<body>

    <form action="traitement_form_inscrire.php" method="post" enctype="application/x-www-form-urlencoded" >
        <fieldset>
          
          <legend>Formulaire d'inscription</legend>

			<p>* : Champs obligatoires</p>

          <p>
            <label for="per_nom">Nom : </label>
            <input type="text" name="per_nom" id="per_nom" placeholder="saisir votre nom" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="per_prenom">Prenom : </label>
            <input type="text" name="per_prenom" id="per_prenom" placeholder="saisir votre prénom" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="per_ville">Ville : </label>
            <input type="text" name="per_ville" id="per_ville" placeholder="saisir votre ville" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="per_telephone">Téléphone : </label>
            <input type="text" name="per_telephone" id="per_telephone" placeholder="saisir votre numéro de téléphone" size="25" />
          </p>

          <p>
            <label for="per_courriel">Courriel : </label>
            <input type="text" name="per_courriel" id="per_courriel" placeholder="saisir votre courriel" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="res_nb_pers">Nombre de personnes : </label>
            <input type="number" name="res_nb_pers" id="res_nb_pers" placeholder="" min="1" max="100" value="1" />
          </p>

          <p>
            <input type="button" name="annuler" id="annuler" value="Annuler" />
            <input type="submit" name="envoyer" id="envoyer" value="Envoyer" />
          </p>

        </fieldset>
      </form>
</body>
</html>
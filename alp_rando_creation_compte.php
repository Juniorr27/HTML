<?php
session_start(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Randonnée</title>
</head>
<body>

    <form action="traitement_form_creation.php" method="post" enctype="application/x-www-form-urlencoded" >
        <fieldset>
          
          <legend>Formulaire d'inscription</legend>

			<p>* : Champs obligatoires</p>

          <p>
            <label for="per_nom">Nom : </label>
            <input type="text" name="per_nom" id="per_nom" placeholder="saisir votre nom" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="per_prenom">Prénom : </label>
            <input type="text" name="per_prenom" id="per_prenom" placeholder="saisir votre prénom" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="per_mdp">Mot de passe : </label>
            <input type="password" name="per_mdp" id="per_mdp" placeholder="saisir votre mot de passe" size="25" required="Veuillez compléter ce champ!" />*
          </p>

          <p>
            <label for="per_mdp_conf">Confirmation mot de passe : </label>
            <input type="password" name="per_mdp_conf" id="per_mdp_conf" placeholder="confirmez votre mot de passe" size="25" required="Veuillez compléter ce champ!" />*
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
            <input type="button" name="annuler" id="annuler" value="Annuler" />
            <input type="submit" name="envoyer" id="envoyer" value="Envoyer" />
          </p>

        </fieldset>
      </form>
</body>
</html>
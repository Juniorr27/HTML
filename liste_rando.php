<?php
session_start();
include_once "list_outil.php";
?>

<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Liste des randonnées</title>
	<link rel="stylesheet" href="liste_randos.css">

	<link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
</head>

<body>
	<h1> LISTE DES RANDOS</h1>
	<?php
	echo '<main >';
	echo '<article class="article-randos">';

	echo "<h2>";
	print_r($table[count($table) - 1]['NOMBRE_DE_RANDONNEE_TOTAL']);
	echo " séjours disponibles</h2>";

	//echo "<thead><tr>	<th>Num</th>	<th>Nom</th>	<th>Date début</th>		<th>Date fin</th>	<th>Prix</th>	</tr></thead>";
	echo '<div class="liste-randos">';
		foreach ($table as $i => $value) {
			echo '<p class="container text-center">';
				echo '<div class = "row">'; /* Ouverture de la ligne */
					echo'<div class="relief">';
						echo '<div class = "col "> ';
							echo '<img src="montagne_blanche_dessin.png" alt="Montagne dessin blanc" srcset="" class="taille-photos">';
						echo "</div>";

						echo '<div class = "col">';

							echo '<div class="nom-randos">';
								echo '<a href="page_details.php?var1='.$table[$i]['RAN_NUM'].'"?>';
								print_r($table[$i]['RAN_NOM']);
							echo "</div>";

							//echo '<div class="element-liste-randos">';
							print_r($table[$i]['RES_DESCRIPTIF']);
						echo "</div>";


						echo '<div class="col">';
							echo "Du ";
							print_r($table[$i]['RAN_DATE_D']);

							echo " au ";
							print_r($table[$i]['RAN_DATE_FIN']);
							echo"</br>";

							echo "À partir de : ";
							print_r($table[$i]['RES_PRIX_PERS'] . "€");
							echo"</br>";

							
								echo '<a href="alp_rando_inscription.php?ran_num='.$table[$i]['RAN_NUM'].'"?>s inscrire</a>';
							

						echo "</div>";
					echo "</div>";
				echo "</div>";	/* Fermeture de la ligne */
			echo "</p>";
		}
	echo "</div>";
	echo '</aticle>';
	echo "</main>";
	?>
</body>

</html>
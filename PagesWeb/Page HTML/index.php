<?php
session_start(); 
?>


<!DOCTYPE html>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


    <title>Accueil</title>
    
</head>
<body>

    <header>
        <!---->
        <!--<h1>Alpes-Randos</h1>-->

        <nav >
            <ul >
                <li class="nav_link">
                    <a  href="index.php">Accueil</a>
                </li>
                <li class="nav_link">
                    <a  href="../../liste_rando.php">Les Randos</a>
                </li>
                <li class="nav_link">
                    <a  href="../../req_station.php">Les Stations </a>
                </li>
                <li class="nav_link">
                    <a href="../../alp_rando_authentification.html">Mon compte</a>
                </li>        
                <li>  
                    <form>
                        <input  type="search" placeholder="Rechercher" aria-label="Search">   
                    </form>
                </li>
            </ul>                       
        </nav>
    </header>

    
    
    

   <div id="bienvenue">
    <div class="centrer-contenu">
        <div class="align-middle textePageAccueil">
            <h1 class="aligner bienvenueText"> Bienvenue sur Alpes-Rando </h1>
            <p class="aligner">Découvrez les plus belles randonnées</p>
        </div>
        <br><br><br><br><br>
        <button class="bouton_reserver" type="submit"><a href="../../liste_rando.php" >Réserver une randonnée</a></button>
    </div>
</div>
    
   <section id="home">
    <h2>Explorez les plus belles randonnées</h2>
    <div id="map"></div>
</section>

    
    <footer>
        <p>&copy; 2024 Alpes-Rando. Tous droits réservés.</p>
        <div class="logos">
           
            <img class="tiktok" src="../Image/logo_tiktok.png" alt="Logo TikTok">
            <img class="x" src="../Image/logo_x.png" alt="Logo X">
            <img class="youtube" src="../Image/logo_youtube.png" alt="Logo YouTube">
            <img class="instagram" src="../Image/logo_instagram.png" alt="Logo Instagram">
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="scripts.js"></script>

</body>
</html>
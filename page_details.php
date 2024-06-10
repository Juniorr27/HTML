<?php
session_start();
    include "list_outil.php";
    include_once "pdo_agile.php"; 
    include_once "param_connexion_etu.php"; 

    if(isset($_GET['var1'])){
        $c = OuvrirConnexionPDO($db, $db_username, $db_password); 
        $param = $_GET['var1'];
        $sql = "select * from alp_randonnee
        join alp_passer using(ran_num)
        join alp_station using(sta_code)
        join alp_niveau using(niv_code)
        where ran_num = $param";
        $sql2 = "select per_nom, per_prenom from alp_personne
        join alp_guide using(per_num) where per_num = 
        (select per_num_guide from alp_randonnee
        where ran_num = $param)";
        $sql3 = "select per_nom, per_prenom from alp_personne
        join alp_organisateur using(per_num) where per_num = 
        (select per_num_orga from alp_randonnee
        where ran_num = $param)";
        $sql4 = "select count(*) as nbpassage from alp_randonnee
        join alp_passer using(ran_num)
        join alp_station using(sta_code)
        join alp_niveau using(niv_code)
        where ran_num = $param
        group by ran_nom";
		LireDonneesPDO2($c, $sql, $donnee1);
		$table1 = $donnee1;
        LireDonneesPDO2($c, $sql2, $donnee2);
		$table2 = $donnee2;
        LireDonneesPDO2($c, $sql3, $donnee3);
		$table3 = $donnee2;
        LireDonneesPDO2($c, $sql4, $donnee4);
		$table4 = $donnee4;  
        echo 'randonnee numéro : ';
        print_r($table1[0]['RAN_NUM']);
        echo "</br>";
        echo 'niveau de la randonnee : ';
        print_r($table1[0]['NIV_CODE']);
        echo "</br>";
        echo 'type de la randonnee : ';
        print_r($table1[0]['NIV_LIBELLE']);
        echo "</br>";
        echo 'nom de la randonnee : ';
        print_r($table1[0]['RAN_NOM']);
        echo "</br>";
        echo 'date de début de la randonnee : ';
        print_r($table1[0]['RAN_DATE_D']);
        echo "</br>";
        echo 'date de fin de la randonnee : ';
        print_r($table1[0]['RAN_DATE_FIN']);
        echo "</br>";
        echo 'prénom de la personne guide : ';
        if ($table2 == null){
            print_r("aucun");
        }
        else {
            print_r($table2[0]['PER_PRENOM']);
        }
        echo "</br>";
        echo 'nom de la personne guide : ';
        print_r($table2[0]['PER_NOM']);
        echo "</br>";
        echo 'nom de la personne organisatrice : ';
        print_r($table3[0]['PER_NOM']);
        echo "</br>";
        echo 'nom de la personne organisatrice : ';
        print_r($table3[0]['PER_PRENOM']);
        echo "</br>";
        echo 'prix de la réservation : ';
        print_r($table1[0]['RES_PRIX_PERS']);
        echo "</br>";
        echo 'prix de sup_solo : ';
        print_r($table1[0]['RES_SUP_SOLO']);
        echo "</br>";
        echo 'le descriptif de la rando : ';
        print_r($table1[0]['RES_DESCRIPTIF']);
        echo "</br>";
        print_r($table4[0]['NBPASSAGE']);
        foreach($table as $i => $value){
            echo 'passe par : ';
            print_r($table1[$i]['STA_NOM']);
            echo "</br>";;
        }
        if(isset($_SESSION['per_courriel'])){
			echo '<a href="alp_rando_inscription.php?ran_num='.$table[$i]['RAN_NUM'].'"?>s inscrire</a>';
		}
		else{
			echo '<a href="alp_connexion.php?ran_num='.$table[$i]['RAN_NUM'].'"?>s inscrire</a>';
		}
    }
?>
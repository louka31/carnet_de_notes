<?php
session_start();


$mytab=json_decode($_POST['mytab'], true);


include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

$mois=date("m");
$an=date("Y");
$ann=(int)$an;
if($mois>=01 && $mois<=06)
{
    $annees=$ann-1;
}
else{
    $annees=$ann;
} 

foreach($mytab as $row){

    if($row['Prenom'] != "" and $row['Nom'] != ""){
        if($row['id_eleve'] == "null"){
         $requete = $db->prepare('INSERT into eleve (id_ecole , id_classe , prenom , nom , anneescolaire) values (:id_ecole , :id_classe , :prenom , :nom , :anneescolaire) ') ;
         $requete->execute(array( 'id_ecole'=>  $_SESSION['id_ecole'] , 'id_classe'=> $row['id_classe'] , 'prenom'=>  $row['Prenom'] , 'nom'=>  $row['Nom'] , 'anneescolaire'=> $annees));
        }
         else{
            $requete = $db->prepare('UPDATE eleve set nom=:nn , prenom=:pp where id_eleve=:id' ) ;
            $requete->execute(array( 'nn'=>  $row['Nom'] , 'pp'=>  $row['Prenom'] , 'id'=>  $row['id_eleve'] ));
         }
    }
}

?>
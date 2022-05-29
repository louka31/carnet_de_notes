<?php

session_start();

include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}


$requete1 = $db->prepare('DELETE FROM note WHERE id_eleve=:id' ) ;
$requete1->execute(array( 'id'=> $_POST['ideleve']));

$requete2 = $db->prepare('DELETE FROM eleve WHERE id_eleve=:id' ) ;
$requete2->execute(array( 'id'=> $_POST['ideleve']));





?>
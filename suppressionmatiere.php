<?php
include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}



$requete5 = $db->prepare('DELETE FROM matiere WHERE id_matiere=:id5' ) ;
$requete5->execute(array( 'id5'=> $_POST['idadmin']));




?>



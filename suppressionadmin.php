<?php
include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

$requete = $db->prepare('DELETE FROM administration WHERE id_admin=:id' ) ;
$requete->execute(array( 'id'=> $_POST['idadmin']));

?>
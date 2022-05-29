<?php
session_start();
    include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

$requete = $db->prepare('UPDATE enseignant set active=0  where id_enseignant= :x ' ) ;
$requete->execute(array( 'x' => $_POST['idadmin'] ));

header("Location: gestionenseignant.php");
                        


?>
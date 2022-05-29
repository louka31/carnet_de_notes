<?php
session_start();
    include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

$requete = $db->prepare('UPDATE matiere set libelle=:n , coefficient=:p where id_matiere= :e ' ) ;
$requete->execute(array( 'n'=> $_POST['libelle'] , 'p'=> $_POST['coefficient'], 'e'=> $_POST['id_matiere']   ));

header("Location: gestionmatieres.php");
                        


?>
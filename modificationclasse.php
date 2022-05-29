<?php
session_start();
    include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

$requete = $db->prepare('UPDATE classe set nom=:n , nombre=:p where id_classe= :e ' ) ;
$requete->execute(array( 'n'=> $_POST['nom'] , 'p'=> $_POST['nombre'], 'e'=> $_POST['id_classe']   ));

header("Location: gestionclases.php");
                        


?>
<?php
session_start();
    include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}
$requete = $db->prepare('UPDATE administration set nom=:n , prenom=:p , email=:e , mdp=:m where email=:em' ) ;
$requete->execute(array( 'n'=> $_POST['nom'] , 'p'=> $_POST['prenom'] ,
                        'e'=> $_POST['email'] ,'m'=> $_POST['mdp'] , 'em' => $_SESSION['email'] ));

$_SESSION['mdp']= $_POST['mdp']  ; 
$_SESSION['email']= $_POST['email']  ; 
$_SESSION['nom']= $_POST['nom']  ; 
$_SESSION['prenom']= $_POST['prenom']  ;   

header("Location: modifierprofile.php");
                        


?>
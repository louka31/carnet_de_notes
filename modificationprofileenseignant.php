<?php
session_start();
    include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}
$requete = $db->prepare('UPDATE enseignant set nom=:n , prenom=:p , login=:e , mdp=:m where login=:em' ) ;
$requete->execute(array( 'n'=> $_POST['nom'] , 'p'=> $_POST['prenom'] ,
                        'e'=> $_POST['login'] ,'m'=> $_POST['mdp'] , 'em' => $_SESSION['login'] ));

$_SESSION['mdp']= $_POST['mdp']  ; 
$_SESSION['login']= $_POST['login']  ; 
$_SESSION['nom']= $_POST['nom']  ; 
$_SESSION['prenom']= $_POST['prenom']  ;   

header("Location: modifierprofileenseignant.php?niveau=".$_POST['niveau']);
                        


?>
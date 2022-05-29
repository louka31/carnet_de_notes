<?php
include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

function motdepasse ($longueur = 15)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*-+/_';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++)
    {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
}

$mdp=motdepasse(15) ;

$requete = $db->prepare('UPDATE administration set valide= 1 , mdp=:m where id_admin=:id' ) ;
$requete->execute(array( 'id'=>  $_POST['idadmin'] , 'm'=>$mdp ));

$requete1 = $db->prepare('SELECT * from administration where id_admin=:id ' ) ;
$requete1->execute(array( 'id'=>   $_POST['idadmin']));
$entree=$requete1->fetch();
$mail=$entree["email"] ;
$objet="validation du compte" ;
$msg = "votre compte a été bien validé . Votre login est ".$entree["email"]." , votre mot de passe est : " . $mdp ;
$headers = "From: bensaidimen98@gmail.com";
mail($mail,$objet,$msg,$headers);


?>
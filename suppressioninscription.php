<?php
include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

$requete1 = $db->prepare('SELECT * from administration where id_admin=:id1 ' ) ;
$requete1->execute(array( 'id1'=> $_POST['idadmin']));
$entree=$requete1->fetch();
$idecole=$entree['id_ecole'] ;

$requete2 = $db->prepare('SELECT * FROM administration where id_ecole=:id2 ' ) ;
$requete2->execute(array( 'id2'=> $idecole));

$nbecoles=$requete2->rowCount();

$requete4 = $db->prepare('SELECT * from administration where id_admin=:id4 ' ) ;
$requete4->execute(array( 'id4'=> $_POST['idadmin']));
$entree=$requete4->fetch();
$mail=$entree["email"] ;
$objet="suppression du compte";
$msg="votre compte a été supprimé " ;
mail($mail,$objet,$msg);


$requete5 = $db->prepare('DELETE FROM administration WHERE id_admin=:id5' ) ;
$requete5->execute(array( 'id5'=> $_POST['idadmin']));


if ($nbecoles == 1)
{
    $requete3 = $db->prepare('DELETE FROM ecole WHERE id_ecole=:id3' ) ;
    $requete3->execute(array( 'id3'=> $idecole));

}



?>



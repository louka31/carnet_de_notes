<?php
include("config.php");
if (isset($_POST['email'])&&isset($_POST['nom'])&&isset($_POST['prenom'])&&isset($_POST['genre'])&&isset($_POST['gouvernorat'])&&isset($_POST['delegation'])&&isset($_POST['ecole']))
{
	try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");}
	catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());}
	$requete = $db->prepare('SELECT id_ecole FROM ecole WHERE libelle=:nom and gouvernorat=:gouv' ) ;
    $requete->execute(array( 'nom'=> $_POST["ecole"], 'gouv'=> $_POST["gouvernorat"] ));
	if ($c=$requete->fetch())
	{
	$requete = $db->prepare(' INSERT INTO administration (genre,prenom,nom,email,mdp,type,id_ecole)
    VALUES(:genre,:prenom,:nom,:email,:mdp,:type,:id_ecole)' ) ;
		if ($requete->execute(array( 
			'genre'=> $_POST['genre'], 
			'nom'=> $_POST['nom'], 
			'prenom' => $_POST['prenom'],
			'email'=> $_POST['email'], 
			'mdp' => "null",
			'type'=> 1,
			'id_ecole' => $c['id_ecole']
		)))
				header("Location: login.php");
		else{
			echo"inscription échouee";
		}
	}
	else{
		
		$requete = $db->prepare(' INSERT INTO ecole (gouvernorat,delegation,libelle)
       VALUES(:gouv,:del,:lib)' ) ;
		$requete->execute(array( 
	'gouv'=> $_POST['gouvernorat'], 
	'del'=> $_POST['delegation'], 
	'lib' => $_POST['ecole']));
		$req = $db->prepare('SELECT id_ecole FROM ecole WHERE libelle=:nom' ) ;
		$req->execute(array( 'nom'=> $_POST["ecole"]));
	if ($cc=$req->fetch())
	{
		$req = $db->prepare(' INSERT INTO administration (genre,prenom,nom,email,mdp,type,id_ecole)
		VALUES(:genre,:prenom,:nom,:email,:mdp,:type,:id_ecole)' ) ;
		if ($req->execute(array( 
			'genre'=> $_POST['genre'], 
			'nom'=> $_POST['nom'], 
			'prenom' => $_POST['prenom'],
			'email'=> $_POST['email'], 
			'mdp' => "null",
			'type'=> 1,
			'id_ecole' => $cc['id_ecole'])))
			header("Location: login.php");

		else{
			  echo"inscription échouee";
			}
	}

	}
}else{

	echo"Vérifier les données saisies";
}
?>
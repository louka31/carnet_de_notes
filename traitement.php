<?php
include("config.php");
		

			  try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");}
	catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());}
$reponse = $db->prepare("DELETE FROM enseignant WHERE id_enseignant = :e ");
$reponse->execute(array('e'=>$_GET['id']));
		header("Location: gestionenseignant.php");




?>
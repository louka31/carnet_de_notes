<?php
session_start();


$mytab=json_decode($_POST['mytab'], true);


include("config.php");
try {
	$db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
}
catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());
}

foreach($mytab as $row){

    if( $row['id_note']== "null")
    {
       $requete = $db->prepare('insert into note(note,id_eleve,id_matiere) values (:note,:id_eleve,:id_matiere)' ) ;
       $requete->execute(array( 'note'=>  $row['Note'], 'id_eleve'=>$row['id_eleve'] ,'id_matiere'=>$row['id_matiere']));
    }else{
        $requete = $db->prepare('UPDATE note set note=:note where id_note=:id_note' ) ;
        $requete->execute(array( 'note'=>  $row['Note'] , 'id_note'=>  $row['id_note'] ));
    }

}

?>
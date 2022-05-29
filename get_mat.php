<?php
include('config.php');
if(!empty($_POST["id"]))
{
 $id=$_POST['id'];
 try {
	$DB_con = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");}
	catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());}
 $stmt = $DB_con->prepare("SELECT * FROM matiere WHERE id_niveau=:id");
 $stmt->execute(array(':id' => $id));
 ?><option value="">Sélectionner la matiere convenable  :</option><?php
 while($row=$stmt->fetch())
 {
  ?>
  <option value="<?php echo $row['id_matiere']; ?>"><?php echo $row['libelle']; ?></option>
  <?php
 }
}
?>
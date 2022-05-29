
<?php 


include('config.php');
if(!empty($_POST["id"]))
{
 $id=$_POST['id'];
   try {
	$DB_con = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");}
	catch (Exception $e) {
	     die('Erreur : ' . $e->getMessage());}
 $stmt = $DB_con->prepare("SELECT * FROM classe WHERE id_niveau=:id");
 $stmt->execute(array(':id' => $id));
 ?><option value="">Séléctionner la classe convenable  :</option><?php
 while($row=$stmt->fetch())
 {
  ?>
        <option value="<?php echo $row['id_classe']; ?>"><?php echo $row['nom']; ?></option>
        <?php
 }
}
?>


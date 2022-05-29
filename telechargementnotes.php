
<!DOCTYPE html>
<html>
  <head>
  <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

  <style>

table{
    margin-left: 25%;
   width:50%;
}
 td, th {
  border: 1px solid #ddd;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}
tr:hover {background-color: #ddd;}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
h4{

    margin-left: 30%;

}
  </style>

  <script>
    $(document).ready(function() {

        var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#content')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('Test.pdf');
            }, margins
        );
    });
</script>

   
    
  </head>
  <body>
  
<div id="content">


  
<?php

echo '<div>
<h4>Niveau :'.$_POST['niveau'].'</h4>
<h4>Classe : '.$_POST['nom_classe'].'</h4>
  <h4>Matière : '.$_POST['nom_matiere'].'</h4>
</div>';

    
$mois=date("m");
$an=date("Y");
$ann=(int)$an;
if($mois>=01 && $mois<=06)
{
    $annees=$ann-1;
}
else{
    $annees=$ann;
} 

include("config.php");
try {
    $db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$reponse = $db->query('select eleve.nom , eleve.prenom , eleve.id_eleve from eleve join classe on eleve.id_classe=classe.id_classe where classe.id_classe='.$_POST['id_classe'].' and anneescolaire='.$annees);
    if (!$reponse) {
        echo "<h3>La liste d'éléves n'est pas encore remplie pour cette classe</h3>";
    } else {

        echo'<table class="table">
                            <thead>
                              <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Note</th>
                              </tr>
                            </thead>
                            <tbody>';
                              


        while ($entree = $reponse->fetch()) {
    
            $requete2 = $db->prepare("select note.id_note,note.note from note where id_eleve=:id_ele and id_matiere=:id_mat");
            $requete2->execute(array(
                'id_ele' =>$entree['id_eleve'],
                'id_mat' =>$_POST['id_matiere'],
            ));  
            if ($requete2->rowCount() == 0) {
                echo'<tr><td>'.$entree['nom'].'</td><td>'.$entree['prenom'].'</td><td contenteditable=\'true\'>Note pas encore attribuée</td></tr>';
             } else{                
                   while ($u = $requete2->fetch()) {

                       echo'<tr><td>'.$entree['nom'].'</td><td>'.$entree['prenom'].'</td><td contenteditable=\'true\'>'.$u['note'].'</td></tr>';
                   
                   }
                                   
             }

       }

       echo'</tbody>
       </table>';
       
      
       $reponse->closeCursor();
     
      
   }


                                

?>
  
</div>
  </body>
</html>
<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en" class="loading">
<!-- BEGIN : Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Apex admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Apex admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>Monecole</title>
  <link rel="apple-touch-icon" sizes="60x60" href="app-assets/img/ico/apple-icon-60.png">
  <link rel="apple-touch-icon" sizes="76x76" href="app-assets/img/ico/apple-icon-76.png">
  <link rel="apple-touch-icon" sizes="120x120" href="app-assets/img/ico/apple-icon-120.png">
  <link rel="apple-touch-icon" sizes="152x152" href="app-assets/img/ico/apple-icon-152.png">
  <link rel="shortcut icon" type="image/x-icon" href="app-assets/img/ico/favicon.ico">
  <link rel="shortcut icon" type="image/png" href="app-assets/img/ico/favicon-32.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <!-- font icons-->
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/feather/style.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/perfect-scrollbar.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/prism.min.css">
  <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN APEX CSS-->
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <!-- END APEX CSS-->
  <!-- BEGIN Page Level CSS-->
  <!-- END Page Level CSS-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.1/sweetalert.min.js"></script>
  <style>
    td,th{
      text-align: center;
    }
    
  </style>  

<script>
      $(document).ready(function() {


$("#add").click(function() {
  


  <?php 
   
   include("config.php");
    try {
      $db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
    }
    catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
    }

    
    $requete2 = $db->query('select nombre from classe where id_classe='.$_GET['id_classe']);

    $entree = $requete2->fetch();
    $nbrmax= $entree['nombre'];
    
  
  ?>

   rowCount = ($('#tb tr').length)-1;
   if(rowCount < <?php echo $nbrmax ?>){
     var ligne = "<tr><td contenteditable='true'></td><td contenteditable='true'></td><td><i class=\"ft-trash-2 font-medium-3 mr-2\" onclick=\"supprimer(0,this)\" ></i></td><td style='display:none;'>null</td><td style='display:none;'><?php echo $_GET['id_classe'] ?></td></tr>";
        $("#tb").append(ligne);
    }else{

       swal({
              icon: 'error',
             
              text: 'Vous ne pouvez pas ajouter un autre élève car vous avez atteint le nombre maximal d\'élèves dans cette classe '        
          });
          
    }     

  

});

});

   </script> 

<script>

function enregistrer(niveau){

swal({
  title: "Etes-vous sûre de sauvegarder les modifications?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {

    var myRows = [];
    var headersText = [];
    var $headers = $("th");

    // Loop through grabbing everything
    var $rows = $("tbody tr").each(function(index) {
      $cells = $(this).find("td");
      myRows[index] = {};

      $cells.each(function(cellIndex) {
        // Set the header text
        if(headersText[cellIndex] === undefined) {
          headersText[cellIndex] = $($headers[cellIndex]).text();
        }
        // Update the row object with the header/cell combo
        myRows[index][headersText[cellIndex]] = $(this).text();
      });    
    });

// Let's put this in the object like you want and convert to JSON (Note: jQuery will also do this for you on the Ajax request)

  
    
    $.ajax({  
         url:        'http://localhost/carnetdenotes/modificationeleves.php' ,  
         type:       'POST',
         data:{mytab: JSON.stringify(myRows) },   
         cache : false,  
         success: function(status) {  
           
              swal("Les modifications sont enregistrés", {
                icon: "success",
               }).then((value) => {
                var ch= "http://localhost/carnetdenotes/classematiere.php?niveau=" + niveau;
                   window.location.replace(ch);
                });     
               

         },  
         error : function(xhr, textStatus, errorThrown) {  
            alert('Ajax request failed.');  
         }  
      }); 

      
       
    
    
  } else {
    var ch= "http://localhost/carnetdenotes/classematiere.php?niveau=" + niveau;
                   window.location.replace(ch);
  }
});


} 

function annuler(niveau){
   var ch= "http://localhost/carnetdenotes/classematiere.php?niveau=" + niveau;
    window.location.replace(ch);
}

function supprimer(id_eleve,btn){
 

   if(id_eleve != 0) 
   {
      $.ajax({  
          url:        'http://localhost/carnetdenotes/suppressioneleve.php' ,  
          type:       'POST',
          data: {ideleve: id_eleve},                 
          async:      true,  
          success: function(status) {  
            
                
                   var row = btn.parentNode.parentNode;
                    row.parentNode.removeChild(row);
             
                

          },  
          error : function(xhr, textStatus, errorThrown) {  
              alert('Ajax request failed.');  
          }  
        }); 
      
    }else{
       var row = btn.parentNode.parentNode;
       row.parentNode.removeChild(row);


    }  
           


}

</script> 

</head>
<!-- END : Head-->

<!-- BEGIN : Body-->

<body data-col="2-columns" class=" 2-columns ">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="wrapper">


    <!-- main menu-->
    <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
    <div data-active-color="white" data-background-color="man-of-steel" data-image="app-assets/img/sidebar-bg/01.jpg" class="app-sidebar">
      <!-- main menu header-->
      <!-- Sidebar Header starts-->
      <div class="sidebar-header">
        <div class="logo clearfix"><a href="index.html" class="logo-text float-left">
            <div class="logo-img"><img src="app-assets/img/logo.png" /></div><span class="text align-middle">Monecole</span>
          </a>
          <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"></a></div>
      </div>
      <!-- Sidebar Header Ends-->
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="sidebar-content">
        <div class="nav-container">
          <ul id="main-menu-navigation5" data-menu="menu-navigation"  class="navigation navigation-main">
            <?php
            if($_GET['niveau']=="premier")
            echo '<li class=" nav-item active"><a href="classematiere.php?niveau=premier"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Première année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=deuxieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Deuxième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=troisieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Troisième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=quatrieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Quatrième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=cinquieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cinquième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=sixieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Sixième année</span></a>
            </li>';

            else if($_GET['niveau']=="deuxieme")

            echo '<li class=" nav-item "><a href="classematiere.php?niveau=premier"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Première année</span></a>
            </li>
            <li class=" nav-item active"><a href="classematiere.php?niveau=deuxieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Deuxième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=troisieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Troisième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=quatrieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Quatrième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=cinquieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cinquième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=sixieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Sixième année</span></a>
            </li>';
            else if($_GET['niveau']=="troisieme")

            echo '<li class=" nav-item "><a href="classematiere.php?niveau=premier"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Première année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=deuxieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Deuxième année</span></a>
            </li>
            <li class=" nav-item active"><a href="classematiere.php?niveau=troisieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Troisième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=quatrieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Quatrième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=cinquieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cinquième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=sixieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Sixième année</span></a>
            </li>';
            else if($_GET['niveau']=="quatrieme")

            echo '<li class=" nav-item "><a href="classematiere.php?niveau=premier"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Première année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=deuxieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Deuxième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=troisieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Troisième année</span></a>
            </li>
            <li class=" nav-item active"><a href="classematiere.php?niveau=quatrieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Quatrième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=cinquieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cinquième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=sixieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Sixième année</span></a>
            </li>';
            else if($_GET['niveau']=="cinquieme")

            echo '<li class=" nav-item "><a href="classematiere.php?niveau=premier"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Première année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=deuxieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Deuxième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=troisieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Troisième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=quatrieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Quatrième année</span></a>
            </li>
            <li class=" nav-item active"><a href="classematiere.php?niveau=cinquieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cinquième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=sixieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Sixième année</span></a>
            </li>';
            else if($_GET['niveau']=="sixieme")

            echo '<li class=" nav-item "><a href="classematiere.php?niveau=premier"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Première année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=deuxieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Deuxième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=troisieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Troisième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=quatrieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Quatrième année</span></a>
            </li>
            <li class=" nav-item "><a href="classematiere.php?niveau=cinquieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Cinquième année</span></a>
            </li>
            <li class=" nav-item active"><a href="classematiere.php?niveau=sixieme"><i class="ft-layers"></i><span data-i18n="" class="menu-title">Sixième année</span></a>
            </li>';


            ?>
            
          </ul>
        </div>
      </div>
      <!-- main menu content-->
      <div class="sidebar-background"></div>
      <!-- main menu footer-->
      <!-- include includes/menu-footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->


    <!-- Navbar (Header) Starts-->
         <!-- Navbar (Header) Starts-->
         <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
          <div class="navbar-header">
            
          </div>
          <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">fullscreen</p></a></li>
                <li >
                 
                </li>
                <li >
                    
                </li>
                <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                  <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                    <a href="modifierprofileenseignant.php?niveau=<?php echo $_GET['niveau'] ?>" class="dropdown-item py-1"><i class="ft-edit mr-2"></i><span>Modifier Profile</span></a>
                  
                    <div class="dropdown-divider"></div>
                    
                    <a href="deconnexion.php"  class="dropdown-item"><i class="ft-log-out mr-2"></i><span>Déconnexion</span></a>
                  
                  </div>
                </li>
               
              </ul>
            </div>
          </div>
        </div>
      </nav>
    <!-- Navbar (Header) Ends-->


    <div class="main-panel">
      <!-- BEGIN : Main Content-->
      <div class="main-content">
        <div class="content-wrapper">
          <!-- Zero configuration table -->
          <section id="configuration">
            <div class="row">
              <div class="col-12">
                <div class="card">
                 <div class="alert bg-primary alert-dismissible mb-2" role="alert">
                    <!--<strong>Good Morning!</strong> Start <a href="#" class="alert-link">your day</a> with some alerts.-->
                    <strong>En cliquant sur les noms et les prénoms des élèves, vous pouvez les modifier puis appuyez sur le bouton "Enregistrer".</strong> 
                  </div>
                <?php 
                 
                    if($_GET['niveau']=="premier")   
                    {
                        $niveau="premier";
                        echo '<div class="card-header">
                            <h4 class="card-title">Première année</h4><br>
                            <h5 class="card-title">classe '.$_GET['nom_classe'].'</h5>
                        </div>';
                    }    
                    else if ($_GET['niveau']=="deuxieme"){
                        $niveau="deuxieme"; 
                      echo '<div class="card-header">
                        <h4 class="card-title">Deuxième année</h4><br>
                        <h5 class="card-title">classe '.$_GET['nom_classe'].'</h5>
                       </div>';
                    }   
                   else if ($_GET['niveau']=="troisieme"){
                      $niveau="troisieme";
                       echo '<div class="card-header">
                         <h4 class="card-title">Troisième année</h4><br>
                         <h5 class="card-title">classe '.$_GET['nom_classe'].'</h5>
                        </div>';
                    }    
                    else if ($_GET['niveau']=="quatrieme"){
                        $niveau="quatrieme";
                        echo '<div class="card-header">
                          <h4 class="card-title">Quatrième année</h4><br>
                          <h5 class="card-title">classe '.$_GET['nom_classe'].'</h5>
                         </div>';
                    }     
                   else if ($_GET['niveau']=="cinquieme"){
                         $niveau="cinquieme";
                         echo '<div class="card-header">
                           <h4 class="card-title">Cinquième année</h4><br>
                           <h5 class="card-title">classe '.$_GET['nom_classe'].'</h5>
                          </div>';
                    }      
                    else if ($_GET['niveau']=="sixieme"){
                         $niveau="sixieme";
                          echo '<div class="card-header">
                            <h4 class="card-title">Sixième année</h4><br>
                            <h5 class="card-title">classe '.$_GET['nom_classe'].'</h5>
                           </div>';  
                    } 
                    
                    echo' <div class="card-content">
                    <div class="card-body">
                      <table class="table" style="border-style: inset; border-color:#009DA0;" id="tb" >
                        <thead>
                          <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Suppression</th>
                            <th style="display:none;">id_eleve</th>
                            <th style="display:none;">id_classe</th>
                          </tr>
                        </thead>
                        <tbody>';


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
                        
                        $reponse = $db->query('select eleve.nom , eleve.prenom , eleve.id_eleve from eleve join classe on eleve.id_classe=classe.id_classe where classe.id_classe='.$_GET['id_classe'].' and anneescolaire='.$annees);
                        if ($reponse->rowCount() == 0) {

                          echo "<script type='text/javascript'>
                          document.addEventListener('DOMContentLoaded', function(event) {
                              swal({
                                icon: 'info',
                               
                                text: 'La liste des élèves n\'est pas encore attribuée pour cette classe.'        
                              })
                          });
                          </script>";
                           
                              
                            echo'</tbody>
                            </table>
                          </div>
                        </div>';    
                        } else {   
                           
                                  

                                  while ($entree = $reponse->fetch()) {
                                      echo'<tr><td contenteditable=\'true\'>'.$entree['nom'].'</td><td contenteditable=\'true\'>'.$entree['prenom'].'</td><td><i class="ft-trash-2 font-medium-3 mr-2" onclick="supprimer('.$entree['id_eleve'].',this)" ></i></td><td style="display:none;">'.$entree['id_eleve'].'</td><td style="display:none;">'.$_GET['id_classe'].'</td></tr>';
                                  }
                                 
                                echo'</tbody>
                              </table>
                            </div>
                          </div>';               
                          

                        }    

                ?>  

                      <div class="col-md-4 col-sm-6 col-12 fonticon-container">
                                <div class="fonticon-wrap">
                                    <i id='add' class="ft-user-plus"></i>
                                </div>
                       </div>
                
                      <center><div class="form-actions right">
                        <button onclick='enregistrer("<?php echo $niveau ?>")' class="btn btn-raised btn-warning">Enregistrer Modifications</button>
                        <button onclick='annuler("<?php echo $niveau ?>")' class="btn btn-raised btn-primary mr-1">Annuler Modifications</button>
                      </div></center>
          
                </div>
              </div>
            </div>
          </section>
          <!--/ Zero configuration table -->
          <!-- Default ordering table -->









        </div>
      </div>
      <!-- END : End Main Content-->

      
    </div>
  </div>

  <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block">
   <a id="customizer-toggle-icon" class="customizer-toggle bg-danger"><i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i></a>
    <div data-ps-id="df6a5ce4-a175-9172-4402-dabd98fc9c0a" class="customizer-content p-3 ps-container ps-theme-dark">
      <h4 class="text-uppercase mb-0 text-bold-400">Theme Customizer</h4>
      <p>Customize & Preview in Real Time</p>
      <hr>
      <!-- Layout Options-->
      <h6 class="text-center text-bold-500 mb-3 text-uppercase">Layout Options</h6>
      <div class="layout-switch ml-4">
        <div class="custom-control custom-radio d-inline-block custom-control-inline light-layout">
          <input id="ll-switch" type="radio" name="layout-switch" checked class="custom-control-input">
          <label for="ll-switch" class="custom-control-label">Light</label>
        </div>
        <div class="custom-control custom-radio d-inline-block custom-control-inline dark-layout">
          <input id="dl-switch" type="radio" name="layout-switch" class="custom-control-input">
          <label for="dl-switch" class="custom-control-label">Dark</label>
        </div>
        <div class="custom-control custom-radio d-inline-block custom-control-inline transparent-layout">
          <input id="tl-switch" type="radio" name="layout-switch" class="custom-control-input">
          <label for="tl-switch" class="custom-control-label">Transparent</label>
        </div>
      </div>
      <hr>
      <!-- Sidebar Options Starts-->
      <h6 class="text-center text-bold-500 mb-3 text-uppercase sb-options">Sidebar Color Options</h6>
      <div class="cz-bg-color sb-color-options">
        <div class="row p-1">
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="pomegranate" class="gradient-pomegranate d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="king-yna" class="gradient-king-yna d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="ibiza-sunset" class="gradient-ibiza-sunset d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="flickr" class="gradient-flickr d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="purple-bliss" class="gradient-purple-bliss d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="man-of-steel" class="gradient-man-of-steel d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="purple-love" class="gradient-purple-love d-block rounded-circle"></span></div>
        </div>
        <div class="row p-1">
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="black" class="bg-black d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="white" class="bg-grey d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="primary" class="bg-primary d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="success" class="bg-success d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="warning" class="bg-warning d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="info" class="bg-info d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="danger" class="bg-danger d-block rounded-circle"></span></div>
        </div>
      </div>
      <!-- Sidebar Options Ends-->
      <!-- Transparent Layout Bg color Options-->
      <h6 class="text-center text-bold-500 mb-3 text-uppercase tl-color-options d-none">Background Colors</h6>
      <div class="cz-tl-bg-color d-none">
        <div class="row p-1">
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="hibiscus" class="bg-hibiscus d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-purple-pizzazz" class="bg-purple-pizzazz d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-blue-lagoon" class="bg-blue-lagoon d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-electric-viloet" class="bg-electric-violet d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-protage" class="bg-portage d-block rounded-circle"></span></div>
          <div class="col"><span style="width:20px; height:20px;" data-bg-color="bg-tundora" class="bg-tundora d-block rounded-circle"></span></div>
        </div>
      </div>
      <!-- Transparent Layout Bg color Ends-->
      <hr>
      <!-- Sidebar BG Image Starts-->
      <h6 class="text-center text-bold-500 mb-3 text-uppercase sb-bg-img">Sidebar Bg Image</h6>
      <div class="cz-bg-image row sb-bg-img">
        <div class="col-sm-2 mb-3"><img src="app-assets/img/sidebar-bg/01.jpg" width="90" class="rounded sb-bg-01"></div>
        <div class="col-sm-2 mb-3"><img src="app-assets/img/sidebar-bg/02.jpg" width="90" class="rounded sb-bg-02"></div>
        <div class="col-sm-2 mb-3"><img src="app-assets/img/sidebar-bg/03.jpg" width="90" class="rounded sb-bg-03"></div>
        <div class="col-sm-2 mb-3"><img src="app-assets/img/sidebar-bg/04.jpg" width="90" class="rounded sb-bg-04"></div>
        <div class="col-sm-2 mb-3"><img src="app-assets/img/sidebar-bg/05.jpg" width="90" class="rounded sb-bg-05"></div>
        <div class="col-sm-2 mb-3"><img src="app-assets/img/sidebar-bg/06.jpg" width="90" class="rounded sb-bg-06"></div>
      </div>
      <!-- Transparent BG Image Ends-->
      <div class="tl-bg-img d-none">
        <h6 class="text-center text-bold-500 text-uppercase">Background Images</h6>
        <div class="cz-tl-bg-image row">
          <div class="col-sm-3"><img src="app-assets/img/gallery/bg-glass-1.jpg" width="90" class="rounded bg-glass-1 selected"></div>
          <div class="col-sm-3"><img src="app-assets/img/gallery/bg-glass-2.jpg" width="90" class="rounded bg-glass-2"></div>
          <div class="col-sm-3"><img src="app-assets/img/gallery/bg-glass-3.jpg" width="90" class="rounded bg-glass-3"></div>
          <div class="col-sm-3"><img src="app-assets/img/gallery/bg-glass-4.jpg" width="90" class="rounded bg-glass-4"></div>
        </div>
      </div>
      <!-- Transparent BG Image Ends    -->
      <hr>
      <!-- Sidebar BG Image Toggle Starts-->
      <div class="togglebutton toggle-sb-bg-img">
        <div class="switch"><span>Sidebar Bg Image</span>
          <div class="float-right">
            <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
              <input id="sidebar-bg-img" type="checkbox" checked class="custom-control-input cz-bg-image-display">
              <label for="sidebar-bg-img" class="custom-control-label"></label>
            </div>
          </div>
        </div>
        <hr>
      </div>
      <!-- Sidebar BG Image Toggle Ends-->
      <!-- Compact Menu Starts-->
      <div class="togglebutton">
        <div class="switch"><span>Compact Menu</span>
          <div class="float-right">
            <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
              <input id="cz-compact-menu" type="checkbox" class="custom-control-input cz-compact-menu">
              <label for="cz-compact-menu" class="custom-control-label"></label>
            </div>
          </div>
        </div>
      </div>
      <!-- Compact Menu Ends-->
      <hr>
      <!-- Sidebar Width Starts-->
      <div>
        <label for="cz-sidebar-width">Sidebar Width</label>
        <select id="cz-sidebar-width" class="custom-select cz-sidebar-width float-right">
          <option value="small">Small</option>
          <option value="medium" selected="">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <!-- Sidebar Width Ends-->
    </div>
  </div>
  <!-- Theme customizer Ends-->
  <!-- BEGIN VENDOR JS-->
  <script src="app-assets/vendors/js/core/jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/core/popper.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/prism.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/jquery.matchHeight-min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/screenfull.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/pace/pace.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="app-assets/vendors/js/datatable/datatables.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN APEX JS-->
  <script src="app-assets/js/app-sidebar.js" type="text/javascript"></script>
  <script src="app-assets/js/notification-sidebar.js" type="text/javascript"></script>
  <script src="app-assets/js/customizer.js" type="text/javascript"></script>
  <!-- END APEX JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="app-assets/js/data-tables/datatable-basic.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
<!-- END : Body-->

</html>
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
 
  <script>


   function supprimer(id_administration){

swal({
  title: "Etes-vous s??re de supprimer cet administrateur?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    
    $.ajax({  
         url:        'http://localhost/carnetdenotes/suppressionadmin.php' ,  
         type:       'POST',
         data: {idadmin: id_administration},                 
         async:      true,  
         success: function(status) {  
           
              swal("L'administrateur est supprim??", {
                icon: "success",
               }).then((value) => {
                var ch= window.location.href;
                   window.location.replace(ch);
                });     
               
               

         },  
         error : function(xhr, textStatus, errorThrown) {  
            alert('Ajax request failed.');  
         }  
      });  
    
    
    
    
    
    
  } else {
    swal("L'administrateur n'est pas supprim??e");
  }
});


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
          <ul id="main-menu-navigation" data-menu="menu-navigation"  class="navigation navigation-main">
            
            <li class=" nav-item "><a href="demandesinscriptions.php"><i class="ft-edit"></i><span data-i18n="" class="menu-title">Demandes d'inscription</span></a>
            </li>
            <li class=" nav-item active"><a href="administrateurs.php"><i class="ft-users"></i><span data-i18n="" class="menu-title">Administrateurs</span></a>
            </li>
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
                    <a href="modifierprofile.php" class="dropdown-item py-1"><i class="ft-edit mr-2"></i><span>Modifier Profile</span></a>
                  
                    <div class="dropdown-divider"></div>
                    
                    <a href="deconnexion.php"  class="dropdown-item"><i class="ft-log-out mr-2"></i><span>D??connexion</span></a>
                  
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
                  <div class="card-header">
                    <h4 class="card-title">Administrateurs</h4>

                  </div>
                  <div class="card-content">
                    <div class="card-body card-dashboard table-responsive">
                      <?php
                      include("config.php");
                      try {
                        $db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
                      } catch (Exception $e) {
                        die('Erreur : ' . $e->getMessage());
                      }
                      $reponse = $db->query('Select * from administration join ecole on administration.id_ecole=ecole.id_ecole where valide=1');
                      if (!$reponse) {
                        echo "Lecture impossible!";
                      } else {
                        echo "<table class=\"table table-striped table-bordered zero-configuration\"><thead><tr><th>Nom</th><th>Prenom</th><th>Genre</th><th>Email</th><th>Ecole</th><th>Gouvernorat</th><th>D??l??gation</th><th>Suppression</th></tr></thead><tbody>";
                        while ($entree = $reponse->fetch()) {
                          echo "<tr><td>" . $entree['nom'] . "</td><td>" . $entree['prenom'] . "</td><td>" . $entree['genre'] . "</td><td>" . $entree['email'] . "</td><td>". $entree['libelle'] . "</td><td>" . $entree['gouvernorat'] . "</td><td>" . $entree['delegation']."</td>" ."<td>
                    
                    
                    <center><a href=\"#\" onclick=\"supprimer(". $entree['id_admin'] .");return false;\" class=\"danger p-0\" data-original-title=\"\" title=\"\">
                      <i class=\"ft-trash-2 font-medium-3 mr-2\"></i></center>
                    </a>
                  " . "</td></tr>";
                        }
                        echo "</tbody></table>";
                        $reponse->closeCursor();
                      }
                      ?>
                    </div>
                  </div>
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
    <a class="customizer-close"><i class="ft-x font-medium-3"></i></a><a id="customizer-toggle-icon" class="customizer-toggle bg-danger"><i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i></a>
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
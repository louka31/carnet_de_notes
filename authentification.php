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
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
    <!-- END APEX CSS-->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.1/sweetalert.min.js"></script>

    <?php
  include("config.php");

    if (isset($_POST['login']) && isset($_POST['motdepasse'])) {
      try {
        $db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
      } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
      }

      $requete = $db->prepare('SELECT * FROM enseignant WHERE login=:e and mdp=:m');
      $requete->execute(array(
        'e' => $_POST['login'],'m' => $_POST['motdepasse']
      ));

      if ($c = $requete->fetch()) {
   
              $_SESSION["id_enseignant"] = $c["id_enseignant"];
              $_SESSION["id_ecole"] = $c["id_ecole"];
              $_SESSION["login"] = $c["login"];
              $_SESSION["nom"] = $c["nom"];
              $_SESSION["prenom"] = $c["prenom"];
              $_SESSION["mdp"] = $c["mdp"];
              header("Location: classematiere.php?niveau=premier");
            } else {
		  
              echo "<script type='text/javascript'>
                  document.addEventListener('DOMContentLoaded', function(event) {
                      swal({
                        icon: 'error',
                        title: 'Echec de connexion',
                        text: 'Mot de passe ou login incorrect'        
                      })
                  });
                  </script>";
            }
          
          } 
       
    
	  ?>
  </head>
  <!-- END : Head-->

  <!-- BEGIN : Body-->
  <body data-col="1-column" class=" 1-column  blank-page">
    <div class="wrapper">
      <div class="main-panel">
				                          <form class="form" method="post" action="authentification.php" name="f">
        <div class="main-content">
          <div class="content-wrapper"><!--Lock Screen Starts-->
<section id="lock-screen">
  <div class="container-fluid forgot-password-bg">
    <div class="row full-height-vh m-0">
      <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="card">
          <div class="card-content">
            <div class="card-body lock-screen-img">
              <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center">
                  <img src="1.png" alt="" class="img-fluid" height="230" width="400">
                </div>

                <div class="col-lg-6 col-md-12 pt-3 px-4 bg-white">
                  <h4 class="card-title mb-3">
                    Bienvenue
                  </h4>
                  <input type="text" class="form-control mb-3" placeholder="Login" name="login" required />
                  <input type="password" class="form-control mb-3" placeholder="Mot de passe" name="motdepasse" required/>
                  <div class="fg-actions d-flex justify-content-between">
                    <div class="login-btn">
                      
                    </div>
                    <div class="recover-pass">
                      <input type="submit" class="btn btn-outline-primary" value="Se connecter">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Lock Screen Ends-->

          </div>
        </div>
				  </form>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

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
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="app-assets/js/app-sidebar.js" type="text/javascript"></script>
    <script src="app-assets/js/notification-sidebar.js" type="text/javascript"></script>
    <script src="app-assets/js/customizer.js" type="text/javascript"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
  <!-- END : Body-->
</html>
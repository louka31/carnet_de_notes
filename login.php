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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="app-assets/vendors/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.1/sweetalert.min.js"></script>


  <!-- END APEX CSS-->
  <!-- BEGIN Page Level CSS-->
  <!-- END Page Level CSS-->

  <script>
    $(document).ready(function() {


      $("#gouvernorat").on("change", function() {

        $("#delegation").empty();

        var vall = $(this).val();

        if (vall.localeCompare("sousse") == 0) {
          var myOptions = {
            "sousse1": "sousse1",
            "sousse2": "sousse2"
          };

          $.each(myOptions, function(val, text) {
            $("#delegation").append(
              $('<option></option>').val(val).html(text)
            );
          });
        }


        if (vall.localeCompare("monastir") == 0) {
          var myOptions = {
            "monastir1": "monastir1",
            "monastir2": "monastir2"
          };

          $.each(myOptions, function(val, text) {
            $("#delegation").append(
              $('<option></option>').val(val).html(text)
            );
          });
        }



      });


    });
  </script>



  <?php
  include("config.php");
  $msg = "";

  if (isset($_POST['motdepasse'])) {
    if (isset($_POST['email']) && isset($_POST['motdepasse'])) {
      try {
        $db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
      } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
      }

      $requete = $db->prepare('SELECT * FROM Administration WHERE email=:e');
      $requete->execute(array(
        'e' => $_POST['email']
      ));

      if ($c = $requete->fetch()) {
        if ($c['valide'] == 1) {

          if ($c['type'] == 1) {

            if ($_POST['motdepasse'] == $c['mdp']) {
              $_SESSION['id_ecole'] = $c['id_ecole'];

              $_SESSION['email'] = $c['email'];
              $_SESSION['nom'] = $c['nom'];
              $_SESSION['prenom'] = $c['prenom'];
              $_SESSION['mdp'] = $c['mdp'];
              header("Location: accueiladmin.php");
            } else {
              echo "<script type='text/javascript'>
                  document.addEventListener('DOMContentLoaded', function(event) {
                      swal({
                        icon: 'error',
                        title: 'Echec de connexion',
                        text: 'Mot de passe incorrect'        
                      })
                  });
                  </script>";
            }
          } else {
            if ($_POST['motdepasse'] == $c['mdp']) {

              $_SESSION['id_ecole'] = $c['id_ecole'];
              $_SESSION['nom'] = $c['nom'];
              $_SESSION['prenom'] = $c["prenom"];
              $_SESSION['mdp'] = $c['mdp'];
              $_SESSION['email'] = $c['email'];
              header("Location: demandesinscriptions.php");

            } else {
              echo "<script type='text/javascript'>
                  document.addEventListener('DOMContentLoaded', function(event) {
                      swal({
                        icon: 'error',
                        title: 'Echec de connexion',
                        text: 'Mot de passe incorrect'        
                      })
                  });
                  </script>";
            }
          }
        } else {
          echo "<script type='text/javascript'>
                  document.addEventListener('DOMContentLoaded', function(event) {
                      swal({
                        icon: 'info',
                        title: 'Echec de connexion',
                        text: 'Votre compte n\'est pas encore validé'        
                      })
                  });
                  </script>";
        }
      } else {
        // echo"Vérifier votre adresse et mot de passe svp";
        echo "<script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', function(event) {
                  swal({
                    icon: 'error',
                    title: 'Echec de connexion',
                    text: 'Vérifier votre email et mot de passe'        
                  })
              });
              </script>";
      }
    }
  } else {
    if (isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['genre']) && isset($_POST['gouvernorat']) && isset($_POST['delegation']) && isset($_POST['ecole'])) {
      try {
        $db = new PDO("mysql:host=$host;dbname=$data", "$user", "$pass");
      } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
      }
      $requete = $db->prepare('SELECT id_ecole FROM ecole WHERE libelle=:nom and gouvernorat=:gouv');
      $requete->execute(array('nom' => $_POST["ecole"], 'gouv' => $_POST["gouvernorat"]));
      if ($c = $requete->fetch()) {
        $requete = $db->prepare(' INSERT INTO administration (genre,prenom,nom,email,mdp,type,id_ecole)
          VALUES(:genre,:prenom,:nom,:email,:mdp,:type,:id_ecole)');
        if ($requete->execute(array(
          'genre' => $_POST['genre'],
          'nom' => $_POST['nom'],
          'prenom' => $_POST['prenom'],
          'email' => $_POST['email'],
          'mdp' => "null",
          'type' => 1,
          'id_ecole' => $c['id_ecole']
        ))) {

          $mail = $_POST['email'];
          $objet = "Inscription réussite";
          $msg = "votre inscription a été bien enregistrée , vous receverez un email dés que votre compte sera validé. ";
          $headers = "From: bensaidimen98@gmail.com";
          mail($mail, $objet, $msg, $headers);

          echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
                swal({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Votre inscription a été bien enregistrée', 
                })
            });
            </script>";
        } else {
          echo "<script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', function(event) {
                  swal({
                    icon: 'error',
                    title: 'Echec d'inscription',
                    text: 'Inscription echouée'        
                  })
              });
              </script>";
        }
      } else {

        $requete = $db->prepare(' INSERT INTO ecole (gouvernorat,delegation,libelle)
            VALUES(:gouv,:del,:lib)');
        $requete->execute(array(
          'gouv' => $_POST['gouvernorat'],
          'del' => $_POST['delegation'],
          'lib' => $_POST['ecole']
        ));
        $req = $db->prepare('SELECT id_ecole FROM ecole WHERE libelle=:nom');
        $req->execute(array('nom' => $_POST["ecole"]));
        if ($cc = $req->fetch()) {
          $req = $db->prepare(' INSERT INTO administration (genre,prenom,nom,email,mdp,type,id_ecole)
          VALUES(:genre,:prenom,:nom,:email,:mdp,:type,:id_ecole)');
          if ($req->execute(array(
            'genre' => $_POST['genre'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => "null",
            'type' => 1,
            'id_ecole' => $cc['id_ecole']
          )))

            echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
                swal({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Votre inscription a été bien enregistrée', 
                })
            });
            </script>";

          else {
            echo "<script type='text/javascript'>
              document.addEventListener('DOMContentLoaded', function(event) {
                  swal({
                    icon: 'error',
                    title: 'Echec d'inscription',
                    text: 'Inscription echouée'         
                  })
              });
              </script>";
          }
        }
      }
    } else {

      echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
                swal({
                  icon: 'error',
                  title: 'Echec d'inscription',
                  text: 'Veuillez vérifier les données saisies'         
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


  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="wrapper">
    <div class="main-panel">
      <!-- BEGIN : Main Content-->
      <div class="main-content">
        <div class="content-wrapper">
          <!--Login Page Starts-->
          <section id="login">
            <div class="container-fluid">
              <div class="row match-height">
                <div class="col-xl-4 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title mb-0"></h4>
                    </div>
                    <div class="card-content">
                      <div class="card-body">


                        <h4 class="mb-2 card-title">Authentification</h4>
                        <p class="card-text mb-3">
                          Bienvenue , veuillez entrer votre email et mot de passe pour vous connecter
                        </p>

                        <form class="form" method="post" action="login.php" name="f">

                          <input required type="email" class="form-control mb-3" placeholder="Email" name="email" />
                          <input required type="password" class="form-control mb-1" placeholder="Mot de passe" pattern="[a-zA-Z0-9]{3,20}" name="motdepasse" />
                          <div class="d-flex justify-content-between mt-2">
                            <div class="remember-me">

                           

                            </div>
                            <div class="forgot-password-option">

                            </div>
                          </div>
                          <div class="fg-actions d-flex justify-content-between">
                            <div class="login-btn">

                            </div>
                            <div class="login-btn">
                              <input type="submit" class="btn btn-outline-primary" value="Se connecter">

                            </div>

                          </div>
                        </form>

                        <br><br><br> <br>
                        <center>
                          <img src="ecole.jpg" width="400" height="400" />
                        </center>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-8 col-lg-12">
                  <div class="card">
                    <br>
                    <div class="card-header">
                      <h4 class="card-title" id="basic-layout-colored-form-control">Inscription</h4>
                      <br>
                    </div>
                    <div class="card-content">
                      <div class="px-3">

                        <form class="form" method="post" action="login.php" name="f1">
                          <div class="form-body">
                            <h4 class="form-section"><i class="ft-info"></i>Informations personnelles</h4>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="userinput1">Nom</label>
                                  <input required pattern="[a-zA-Z ]{3,20}" type="text" id="userinput1" class="form-control border-primary" name="nom">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="userinput2">Prénom</label>
                                  <input pattern="[a-zA-Z ]{3,20}" required type="text" id="userinput2" class="form-control border-primary" name="prenom">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="userinput3">email</label>
                                  <input required type="email" id="userinput3" class="form-control border-primary" name="email">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Genre</label>
                                  <br>
                                  <div class="custom-radio custom-control-inline ml-3">
                                    <input type="radio" id="customRadioInline1" checked name="genre" class="custom-control-input" value="masculin">
                                    <label class="custom-control-label" for="customRadioInline1">Masculin</label>

                                  </div>
                                  <div class="custom-radio custom-control-inline ml-3">
                                    <input type="radio" id="customRadioInline2" name="genre" class="custom-control-input" value="feminin">
                                    <label class="custom-control-label" for="customRadioInline2">Féminin</label>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <h4 class="form-section"><i class="icon-pencil"></i> Ecole</h4>

                            <div class="form-group">
                              <label for="userinput5">Nom de l'école</label>
                              <input pattern="[a-z A-Z]{3,20}" required class="form-control border-primary" type="text" id="userinput5" name="ecole">
                            </div>

                            <div class="form-group">
                              <label for="userinput6">Gouvernorat</label>
                              <div>

                                <select required id="gouvernorat" name="gouvernorat" class="custom-select cz-sidebar-width float-right ">
                                  <option value="--">----</option>

                                  <option value="beja">BEJA</option>
                                  <option value="benarous">BENAROUS</option>
                                  <option value="Mednin">BENGUERDANE</option>
                                  <option value="bizerte">BIZERTE</option>
                                  <option value="Mednin">DJERBA</option>
                                  <option value="gabes">GABES</option>
                                  <option value="gafsa">GAFSA</option>
                                  <option value="jendouba">JENDOUBA</option>
                                  <option value="kairouan">KAIROUAN</option>
                                  <option value="kaserine">KASSERINE</option>
                                  <option value="kebili">KEBILI</option>
                                  <option value="kef">LE KEF</option>
                                  <option value="mahdia">MAHDIA</option>
                                  <option value="manouba">MANOUBA</option>
                                  <option value="mednin">MEDENINE</option>
                                  <option value="monastir">MONASTIR</option>
                                  <option value="nabeul">NABEUL</option>
                                  <option value="sfax">SFAX</option>
                                  <option value="siliana">SILIANA</option>
                                  <option value="sousse">sousse</option>
                                  <option value="tataouine">TATAOUINE</option>
                                  <option value="tozeur">TOZEUR</option>
                                  <option value="tunis">TUNIS</option>
                                  <option value="zaghouen">ZAGHOUAN</option>
                                  <option value="sidi bouzid">SIDI BOUZID</option>
                                  <option value="ariana">ARIANA</option>

                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label>Délégation</label>
                              <select required id="delegation" name="delegation" class="custom-select cz-sidebar-width float-right ">

                              </select>
                            </div>


                          </div>

                          <div class="form-actions right">
                            <input type="reset" class="btn btn-raised btn-warning mr-1" value="Annuler">

                            <input type="submit" class="btn btn-raised btn-primary" value="S'inscrire">


                          </div>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!--Login Page Ends-->

        </div>
      </div>
      <!-- END : End Main Content-->
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
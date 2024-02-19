<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
     foreach ($query as $key => $value) {
      if(!is_numeric($key))
        $_SESSION['setting_'.$key] = $value;
    }
    ob_end_flush();
    include('header.php');

    
    ?>

    <style>
        header.masthead {
          background: url(admin/assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
          background-repeat: no-repeat;
          background-size: cover;
        }
    /* Adjust the margin and size of the logos as needed */
    .navbar-brand-logo-left {
        margin-right: 50px; /* Adjust the margin as needed */
        width: 50px; /* Adjust the width as needed */
    }

    .navbar-brand-logo-right {
        margin-left:50px; /* Adjust the margin as needed */
        width: 50px; /* Adjust the width as needed */
    }
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                 <!-- Logo on the left -->
                <img src="insd.png" alt="Left Logo" class="navbar-brand-logo-left">

                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['setting_name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Accueil</a></li>
                         <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=view_communique">Avis en cours...</a></li>
                          <!-- Insérez ce code à l'emplacement approprié dans votre fichier HTML -->
                        
                            <?php
                            if (isset($_SESSION['login_username'])) {
                                // Si un utilisateur est connecté, affichez son nom et une icône
                                $name = $_SESSION['login_name'];
                                    echo '                               
                                    <li class="nav-item">
                                        <a class="nav-link" href="admin/index.php">
                                            <i class="fa fa-user-circle"></i> ' . $name . '
                                        </a>
                                    </li>';

                            } else {
                                // Si aucun utilisateur n'est connecté, affichez le lien de connexion
                                  echo '
                                    <li class="nav-item">
                                        <a class="nav-link js-scroll-trigger" href="index.php?page=connexion">Se Connecter</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link js-scroll-trigger" href="index.php?page=add_inscrit">S\'inscrire</a>
                                    </li>';

                            }
                            ?>
                

                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">A Propos</a></li>
                    </ul>
                </div>
                 <!-- Logo on the right -->
                <img src="drapeau.png" alt="Right Logo" class="navbar-brand-logo-right">
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continuer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Sauver</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class="bg-light py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0">Contactez Nous</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div><?php echo $_SESSION['setting_contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['setting_email'] ?>"><?php echo $_SESSION['setting_email'] ?></a>
                    </div>
                </div>
            </div>
            <br>
            <div class="container"><div class="small text-center text-muted">Bienvenu sur la - <?php echo $_SESSION['setting_name'] ?> | <a href="https://www.insd.bf" target="_blank">Site Officiel de l'INSD</a></div></div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>

</html>

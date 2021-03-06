<?php

include("config/config.php");
include("config/bd.php"); // commentaire
include("divers/balises.php");
include("divers/helpers.php");
include("config/actions.php");
session_start();
ob_start(); // Je démarre le buffer de sortie : les données à afficher sont stockées

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FoxBook</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10.css" rel="stylesheet">


    <!-- Ma feuille de style à moi -->
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/404.css" rel="stylesheet">



    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    <script src="js/resp-nav.js"></script>
</head>

<body>

<?php
if (isset($_SESSION['info'])) {
    echo "<div class='alert alert-info alert-dismissible' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span></button>
        <strong>Information : </strong> " . $_SESSION['info'] . "</div>";
    unset($_SESSION['info']);
}
?>


<header id="main-header">
    <!-- <h3>FoxBook</h3> -->
    <?php
    if (isset($_SESSION['id'])) {
        // echo "<li>Bonjour " . $_SESSION['login'] . "<br/><a href='index.php?action=deconnexion'>Deconnexion</a></li>";
        include('vues/nav.php');
    }
    ?>
</header>



<!-- <nav>
    <ul>
        <li><a href="index.php?action=page2">Va voir la page 2</a></li>



        <li> <a href="index.php?action=enregistrement">Créer un compte</a> </li>
    </ul>
</nav> -->

<div class="container-fluid" style="left: 0px;">
    <div class="row">
        <!--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->
        <div class="col-md-12 main">
            <?php
            // Quelle est l'action à faire ?
            if (isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                $action = "login";
            }

            // Est ce que cette action existe dans la liste des actions
            if (array_key_exists($action, $listeDesActions) == false) {
                include("vues/404.php"); // NON : page 404
            }
            else {
                include($listeDesActions[$action]); // Oui, on la charge
            }

            ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
            ?>


        </div>
    </div>
</div>

<?php
  include('vues/suggest_friends.php');
 ?>

<footer>FOXBOOK<br/><a target="_blank" href="https://gotchit.fr/">GAUTIER Théo</a> | <a target="_blank" href="https://antoinevanderbrecht.fr/">VANDERBRECHT Antoine</a> | TRACCOEN Léa <br/><a target="_blank" href="https://github.com/MrAntoine/Mini_Projet_Facebook_MMI2/">Lien du dépôt GitHub</a></footer>

<script type="text/javascript">
      window.sr = ScrollReveal();
      sr.reveal('.anim');
</script>
<script type="text/javascript">

// Menu-toggle button

$(document).ready(function() {
      $(".menu-icon").on("click", function() {
            $("nav ul").toggleClass("showing");
      });
});

// Scrolling Effect

$(window).on("scroll", function() {
      if($(window).scrollTop()) {
            $('nav').addClass('black');
      }

      else {
            $('nav').removeClass('black');
      }
})


</script>
<script type="text/javascript">
  $(window).scroll(function() {
    var wintop = $(window).scrollTop(), docheight =
    $(document).height(), winheight = $(window).height();
    var scrolled = (wintop/(docheight-winheight))*100;
    $('.scroll-line').css('width', (scrolled + '%'));
  });
</script>

</body>
</html>

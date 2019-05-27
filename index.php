<!DOCTYPE html>
<html lang="fr">
    <head>
    <!-- 
    ETML
    Auteur : Larry Lam
    Date : 09.05.19
    Description : Page principale qui va appeler le controlleur et inclure toutes les vues
    -->
        <meta charset="UTF-8">
        <meta name="author" content="Larry Lam">
        <meta name="description" content="Marche ETML homepage">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php 
            //header avec les scripts et css
            require_once 'view/header.php'; 
            //Permet d'inclure le fichier du controller appelé
            spl_autoload_register(function ($controller) {
                include 'controller/' . $controller . '.php';
            });
            // le serveur doit conserver les données de session AU MOINS 10 heures
            ini_set('session.gc_maxlifetime', 36000);
            // chaque client devrait se souvenir de son identifiant de session EXACTEMENT 10 heures
            session_set_cookie_params(36000);
            //Démarrer une session
            session_start(); 
            //Création du contrôleur principal
            $mainController = new Controller();

        ?>
        <title>Marche ETML</title>
    </head>
    <?php
    //S'il y a un utilisateur connecté le menu afficher "se déconnecter" sinon il affichera "Login"
    $navLoginLink = (isset($_SESSION['user']) ? '<a class="nav-link" href="index.php?page=disconnect">Se déconnecter</a>':'<a class="nav-link" href="index.php?page=login">Login</a>');
    //Navigation
    require_once 'view/nav.php'; 
    ?>
    <body>
        <div class="container">
        <?php
            //Demande au contrôleur d'afficher la vue en fonction de la page appelée (GET)
            $mainController->handleViews();
        ?>
        
        </div>
    </body>
</html>

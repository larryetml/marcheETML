<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php 
            require_once 'view/header.php'; 
            spl_autoload_register(function ($controller) {
                include 'controller/' . $controller . '.php';
            });
            $mainController = new Controller();

            //If param page isset -> assign to var else = false
            $url = ((isset($_GET['page'])) ? $_GET['page'] : 'home');
            session_start();
            // $_SESSION['user'] = 'larry';

        ?>
        <title>Marche ETML</title>
    </head>
    <?php
    require_once 'view/nav.php'; 
    ?>
    <body>
        <div class="container">

        <?php
            // session_destroy();
            // var_dump($_SESSION['user']);

            //Si la variable de session de l'utilisateur est vide
            if(!isset($_SESSION['user']))
            {
                // si le paramètre url = 'log' et que le post des variables email et password sont remplies
                if($url == 'log' && isset($_POST['email']) && isset($_POST['password']))
                {
                    //Création d'une instance du LoginController
                    $controller = new LoginController();
                    try
                    {
                        //effectue une connexion sécurisée
                        $controller->authenticate($_POST['email'], $_POST['password']);

                    }catch(Exception $e)
                    {
                        echo 'Impossible de se connecter...';
                    }
                }else
                {
                    include('view/loginView.php');
                }
            }else
            {
                if(isset($n))
                {
                    $mainController->displayDetails($n);
                }else
                {
                    switch($url)
                    {

                        case 'home':
                            $mainController->displayHome();
                            break;
                        case 'students':
                            $mainController->displayListStudents();
                            break;
                        case 'list':
                            $mainController->displayList();
                            break;
                        case 'details':
                            $mainController->displayDetails($mainController->getId());
                            break;
                        case 'poste':
                            $posteController = $mainController->initPoste();

                            // $step = ((isset($_GET['step'])) ? $_GET['step'] : '1');

                            // switch($step)
                            // {
                            //     case '1':
                                    
                            //         break;
                            //     case '2':
                            //         break;
                            //     case '3':
                            //         break;
                            //     default:
                            //         break;
                            // }

                            var_dump($_POST);
                            if(isset($_POST['action']) || isset($_POST['posteName']))
                            {
                                $mainController->displayPosteCollaborator($posteController);
                            }elseif(!isset($_POST['posteName']))
                            {
                                $mainController->displayPoste();
                            }
                            

                            break;
                        case 'register';
                            $mainController->displayRegister();
                            break;
                        case 'disconnect';
                            $mainController->disconnectUser();
                            break;
                        default:
                            header("Location: index.php");
                            break;
                    }
                }
            }
        ?>
        
        </div>
    </body>
</html>

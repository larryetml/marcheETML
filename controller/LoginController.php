<?php
/**
 * ETML
 * Auteur : Larry Lam
 * Date : 13.05.19
 * Description : Contrôleur qui gère l'authentification des utilisateurs
 */
require_once('Controller.php');
class LoginController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    /*
    
    */
    public function authenticate($email,$password)
    {
        //Récupère l'utilisateur grâce à son email
        $user = $this->model->getUserByEmail(strtolower($email));
        //Si l'utilisateur existe
        if($user)
        {
            //Effectue la vérification du mot de passe (crypté en Bcrypt)
            if((password_verify($password, $user['usePassword'])))
            {
                //Si les identifiants sont corrects définir la variable user
                $_SESSION['user']['idUser'] = $user['idUser'];
                $_SESSION['user']['idCollaborator'] = $user['fkCollaborator'];
                $_SESSION['user']['colName'] = $user['colName'];
                $_SESSION['user']['useIsAdmin'] = $user['useIsAdmin'];
                $_SESSION['user']['fkPoste'] = $user['fkPoste'];

                //Rediriger sur la page principale
                header("Location: index.php");
                return;
            }
        }
        //Sinon retourner sur la page login avec un message d'erreur
        header("Location: index.php?page=login&error=1");
    }
}

?>
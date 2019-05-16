<?php
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
        //S'il y en a un
        if($user)
        {
            //Effectue la vérification du mot de passe (crypté en Bcrypt)
            if((password_verify($password, $user['usePassword'])))
            {
                //Si les identifiants sont corrects définir la variable user
                $_SESSION['user'] = $user;
                //redigier sur la page principale
                header("Location: index.php");
            }
        }
        //Sinon retourner sur la page login avec un message d'erreur
        header("Location: index.php?page=login&error=1");
    }
}

?>
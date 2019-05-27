<?php
/**
 * ETML
 * Auteur : Larry Lam
 * Date : 09.05.19
 * Description : Contrôleur principal qui traite les données générales (get, post, session) et gère l'affichage des vues
 */
require_once 'model/Model.php';
class Controller
{
    //Modèle
    protected $model;
    //Tableau avec les constantes tel que les adresses url et la taille du code QR
    protected $CONSTS;

    /**
     * Description : Constructeur de la classe, crée l'instance de la classe Model et récupère les constantes
     */
    function __construct() {
        $this->model = new Model();
        $this->setConfig();
    }
    
    /**
     * Description : Récupère les constantes et les stockent une variable
     */
    private function setConfig()
    {
        include('config/config.php');
        $this->CONSTS = $CONSTS;
    }
    
    /**
     * Description : Récupérer les données puis afficher les vues en fonction de l'url
     */
    public function handleViews()
    {

        //Si il n'y a pas d'utilisateur logué
        if(!isset($_SESSION['user']))
        {
            //Aficher le formulaire de connexion
            $this->displayLogin();            
        }else //S'il y a un utilisateur logué
        {
            $n = ((isset($_GET['n'])) ? $_GET['n'] : false);
            
            //Pour la page students.php qui contient dans la variable $n l'id de l'élève
            if($n)
            {
                //Afficher la vue détails de l'élève
                $this->displayDetails($n);
            }else
            {
            //Si le paramètre page est définit le stocker dans la variable sinon stocker "home"
            $url = ((isset($_GET['page'])) ? $_GET['page'] : 'home');

            //En fonction du paramètre, afficher la page correspondante
            switch($url)
            {
                case 'home':
                    $this->displayHome();
                    break;
                case 'students':
                    $this->displayListStudents();
                    break;
                case 'list':
                    $this->displayList();
                    break;
                case 'details':
                        $idStudent = (isset($_GET['id']) ? $_GET['id'] : false);
                        $this->displayDetails($idStudent);
                    break;
                case 'poste':
                    $controller = new PosteController();
                    $action = ((isset($_GET['action'])) ? $_GET['action'] : false);
                    $idPoste = ((isset($_GET['id'])) ? $_GET['id'] : false);
                    //Vérifier que le param est bien un chiffre et pas une injection sql par exemple
                    if(is_numeric($idPoste) || !$idPoste)
                    {
                        $this->displayPoste($action, $idPoste);
                    }
                    break;
                case 'validate';
                    $controller = new PosteController();
                    $idPoste = ((isset($_GET['poste'])) ? $_GET['poste'] : false);
                    $idStudent = ((isset($_GET['id'])) ? $_GET['id'] : false);
                    $action = ((isset($_GET['action'])) ? $_GET['action'] : false);

                    if($idPoste && $idStudent)
                    {
                        switch($action)
                        {
                            case 'validate':
                                $controller->validatePostePassageFromIdStudent($idStudent,$idPoste);
                                break;
                            case 'remove':
                                $controller->removePostePassageFromIdStudent($idStudent,$idPoste);
                                break;
                            default:
                                break;
                        }
                    }
                    header('Location: index.php?page=details&id='.$idStudent.'');
                    break;
                case 'send';
                    if($_SESSION['user']['useIsAdmin']==1)
                    {
                        $this->sendEmails();                        
                    }else
                    {
                    header("Location: index.php");
                    }
                    break;
                case 'disconnect';
                    $this->disconnectUser();
                    break;
                default:
                    header("Location: index.php");
                    break;
                }
            }
        }
    }
    
    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function displayLogin()
    {
        $url = ((isset($_GET['page'])) ? $_GET['page'] : 'home');
        // si le paramètre url = 'log' et que le post des variables email et password sont remplies
        if($url == 'log' && isset($_POST['email']) && isset($_POST['password']))
        {
            //Création d'une instance du LoginController
            $controller = new LoginController();
            try
            {
                //Connexion au site
                $controller->authenticate($_POST['email'], $_POST['password']);

            }catch(Exception $e)
            {
                echo 'Impossible de se connecter...';
            }
        }else
        {
            include('view/loginView.php');
        }
    }    


    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function displayHome()
    {
        $controller = new PosteController();
        $userName = $_SESSION['user']['colName'];
        if($_SESSION['user']['useIsAdmin'] == 1)
        {
            //Récupère tous les postes
            $postes =  $controller->getAllPostes();
            //Récupère tous les collaborateurs qui sont assigné à un poste ainsi que les infos du poste en question
            $collaborators =  $controller->getAllPostesWithCollaborators();

            //Tableau final avec tous les postes et leurs collaborateurs assignés respectifs
            $listPostes = [];
            //Parcourt la liste de tous les poste
            foreach($postes as $index => $poste)
            {
                //On ajoute chaque poste dans le tableau $listPostes
                array_push($listPostes, $poste);
                //Dans chacun de ces poste un rajoute un tableau vide au nom de "collaborators"
                $listPostes[$index]['collaborators'] = array();
                //Initialise un tableau vide qui comportera les collaborateurs assigné au poste actuel
                $tempArrayCollaborators = [];

                //Pour chaque collaborateur
                foreach($collaborators as $collaborator)
                {
                    //On regarde si son poste assigné est le même que le poste actuel
                    if($collaborator['idPoste']==$poste['idPoste'])
                    {
                        //oui -> on l'ajoute dans le tableau $tempArrayCollaborators
                        array_push($tempArrayCollaborators,$collaborator);
                    }
                }
                //Une fois tous les collaborateurs vérifiés, on ajoute le tableau de collaborateur au champ "collaborators" précédemment crée
                array_push($listPostes[$index]['collaborators'],$tempArrayCollaborators);
            }

            //Afficher la vue
            include('view/homeAdminView.php');
        }else
        {
            $poste =  $controller->getPosteById($_SESSION['user']['fkPoste']);
            $posteName = $poste['posName'];
            $collaborators = $controller->getAllAssignedCollaboratorsByPosteId($_SESSION['user']['fkPoste']);
            include('view/homeView.php');
        }
    }

    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function displayPoste($action,$idPoste)
    {
        $controller = new PosteController();

        //Si l'action est définie et que l'id du poste est bien un chiffre
        if($action)
        {
            switch($action)
            {
                case 'create':
                    $this->startPosteCreation();
                    $this->updateAccounts();
                    break;
                case 'edit':
                    $controller->editPoste($idPoste);
                    $this->updateAccounts();
                    break;
                case 'delete':
                    $controller->deletePosteFromId($idPoste);
                    $this->updateAccounts();
                    break;
                default:
                    $this->displayHome();
                    break;
            }
        }else
        {
            $this->displayHome();
        }
    }
    
    
    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function updateAccounts()
    {
        
    }
    
    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function startPosteCreation()
    {
        $controller = new PosteController();

        $step = ((isset($_POST['step'])) ? $_POST['step'] : null);
        switch($step)
        {
            case 2:
                if($controller->checkIfPosteAlreadyExists($_POST['posteName']))
                {
                    $_SESSION['step'] = 1;
                    unset($_SESSION['posteName']);
                    header("Location: index.php?page=poste&action=create&error=1");
                }else
                {
                    $_SESSION['posteName'] = (isset($_POST['posteName']) ? $_POST['posteName'] : '');
                    $collaborators = $controller->getAllUnassignedCollaborators();
                    include('view/posteCollaboratorView.php');
                }
                break;
            case 3:
                $assignedCollaborators = (isset($_POST['assignedCollaborators']) ? $_POST['assignedCollaborators'] : false);
                $controller->createPoste($assignedCollaborators);
                header("Location: index.php?page=home");
                $controller->displayHome();
                break;
            default:
                include('view/posteView.php');
            break;
        }
    }

    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function displayListStudents()
    {
        $CONSTS = $this->CONSTS;
        $controller = new StudentsController();
        $students = $controller->getAllStudents();
        include('view/listStudentsView.php');
    }

    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function displayDetails($idStudent)
    {
        $CONSTS = $this->CONSTS;
        $controller = new StudentsController();
        $passedPostes = $controller->getPassedPostesIdFromStudentId($idStudent);
        $postes = $controller->getAllPostes($idStudent);
        $student = $controller->getStudentById($idStudent);

        $isAdmin = true;  
        $isAlreadyValidated = false;  

        if($_SESSION['user']['useIsAdmin']!=1)
        {
            $collaboratorPoste = $controller->getPosteById($_SESSION['user']['fkPoste']);
            $isAdmin = false;  
            foreach($passedPostes as $passedPoste)
            {
                if($collaboratorPoste['idPoste'] == $passedPoste['idPoste'])
                {
                    $isAlreadyValidated = true;
                }
            }
        }
        include('view/detailsView.php');
    }

    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function displayRegister()
    {
        $controller = new RegisterController();
        include('view/registerView.php');
    }

    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function disconnectUser()
    {
        // unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php");
    }

    
    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    //Méthode utilisée dans HomeController et StudentController
    public function getAllPostes()
    {
        return $this->model->getAllPostes();
    }

    /**
     * Description :
     * @Param
     * @Return
     * @Exception
     */
    public function sendEmails()
    {
        $this->model->deleteAllUnassigedAccounts();
        $collaborators = $this->model->getAllAssignedCollaborators();
        $CONSTS = $this->CONSTS;
        $from = 'contact@etml.ch';

        
        foreach($collaborators as $collaborator)
        {
            $headers = "From : " . $from;
            $subject = "Vos identifiants pour la marche ETML";
            $to = $collaborator['colEmail'];
            $password = strtolower(substr($collaborator['colLastname'], 0, 8).substr($collaborator['colName'], 0, 2));


            $message = '
            Bonjour '.$collaborator['colName'].',
            <br>
            <br>
            Vous êtes assigné au poste : '.$collaborator['posName'].'.  
            <br>
            Voici vos identifiants :
            <br>
            <strong>Email : </strong>'.$collaborator['colEmail'].'
            <br>
            <strong>Mot de passe : </strong>'.$password.'
            <br>
            <br>
            Meilleures salutations, ETML
            ';
            
            echo "<div style=\"margin-bottom:20px;padding:15px;background-color:#c4f7b7\"> $headers<br> To : $to <br>Subject : $subject <br><br>$message </div>";
        }


        $controller = new StudentsController();
        $students = $controller->getAllStudents();

        foreach($students as $student)
        {
            $headers = "From : " . $from;
            $subject = "Votre identifiant pour la marche ETML";
            $to = $student['stuEmail'];
            $message = '
            Bonjour '.$student['stuName'].',
            <br>
            <br>
            Voici votre code QR, veuillez le présenter lors de votre arrivée à un poste.<br>
            <img style="margin: 20px 0"src=\''.$CONSTS['qrUrl'].$CONSTS['qrSize'].'&data='.$CONSTS['webUrl'].'?n='.$student['idStudent'].'\' alt="Code QR">
            <br>
            <br>
            Meilleures salutations, ETML
            ';
            
            echo "<div style=\"margin-bottom:20px;padding:15px;background-color:#dddddd\"> $headers<br> To : $to <br>Subject : $subject <br><br>$message </div>";
        }

        // echo "Veuillez patienter l'envoi peut prendre quelques minutes...";
        // $students;
        // $users;
        // ini_set( 'display_errors', 1 );
        // error_reporting( E_ALL );
        // $from = "test@hostinger-tutorials.com";
        // $to = "test@gmail.com";
        // $subject = "Checking PHP mail";
        // $message = "PHP mail works just fine";
        // $headers = "From:" . $from;
        // try{
        //     mail($to,$subject,$message, $headers);
        // }catch(Exception $e)
        // {
        //     echo "The email message could not be sent.";
        //     error_log($e->getMessage());
        // }

    }
    /**
     * Méthode héritée par PosteController et StudentsController
     */
    public function getPosteById($id)
    {
        return $this->model->getPosteById($id);
    }
}

?>
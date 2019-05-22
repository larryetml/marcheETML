<?php
require_once 'model/Model.php';

/**
 *  Description :
 * @Parameter
 * @Return
 * @Exception
 *  
 */
class Controller
{
    protected $model;
    protected $consts;

    function __construct() {
        $this->model = new Model();
        spl_autoload_register(function ($controller) {
            include 'controller/' . $controller . '.php';
        });
        $this->setConfig();
    }

    private function setConfig()
    {
        include('config/config.php');
        $this->consts = $consts;
    }

    public function getId()
    {
        if(isset($_GET['id']))
        {
            return $_GET['id'];
        }
        return null;
    }    

    public function removeStudentById($idStudent)
    {
        $idStudent = $this->getId();
        if(is_numeric($idStudent))
        {
            $this->model->removeProductById($idStudent);
            header("Location: index.php?page=students");
        } 
        return false;
    }

    public function displayHome()
    {
        $controller = new HomeController();

        $adminName = $_SESSION['user']['colName'];

        if($_SESSION['user']['useIsAdmin'] == 1)
        {
            //Version avec le if dans la vue
            $postes =  $controller->getAllPostes();
            $collaborators =  $controller->getAllPostesWithCollaborators();


            // /*
            //Version avec le tableau final des données
            $listPostes = [];
            foreach($postes as $key => $poste)
            {
                array_push($listPostes, $poste);
                // $listPostes['collaborators']= ;

                $listPostes[$key]['collaborators'] = array();
                $tempArrayCollaborators = [];

                foreach($collaborators as $collaborator)
                {
                    if($collaborator['idPoste']==$poste['idPoste'])
                    {
                        array_push($tempArrayCollaborators,$collaborator);
                    }
                }
                array_push($listPostes[$key]['collaborators'],$tempArrayCollaborators);
            }
            // */


            include('view/homeAdminView.php');
        }else
        {
            $poste =  $controller->getPosteById($_SESSION['user']['fkPoste']);
            $posteName = $poste['posName'];
            $collaborators = $controller->getAllAssignedCollaboratorsByPosteId($_SESSION['user']['fkPoste']);
            include('view/homeView.php');
        }
    }

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
                    break;
                case 'edit':
                    $controller->editPoste($idPoste);
                    break;
                case 'delete':
                    $controller->deletePosteFromId($idPoste);
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
                $controller->createPoste();
                header("Location: index.php?page=home");
                $controller->displayHome();
                break;
            default:
            include('view/posteView.php');
            break;
        }
    }

    public function displayListStudents()
    {
        $consts = $this->consts;
        $controller = new StudentsController();
        $students = $controller->getAllStudents();
        include('view/listStudentsView.php');
    }

    public function displayDetails()
    {
        $idStudent = $this->getId();
        $consts = $this->consts;
        $controller = new StudentsController();
        $student = $controller->getStudentById($idStudent);
        include('view/detailsView.php');
    }
    public function displayRegister()
    {
        $controller = new RegisterController();
        include('view/registerView.php');
    }

    public function disconnectUser()
    {
        // unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php");
    }


    // public function insertStudents($name, $lastname)
    // {
    //     //if duplicate
    //     Model::getStudentsByAttribute(['name'=>$name,'lastname'=>$lastname]);

    //     $model = new Model();
    //     $model.name = $name;
    //     $model.lastname = $lastname;
    //     $model->insertStudent();
    // }

    // public static getStudentsByAttribute($attributes)
    // {
    //     "SELECT * FROM t_students WHERE id = $attribute"
    // }

}

?>
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
            include('view/homeAdminView.php');
        }else
        {
            $poste =  $controller->getPosteById($_SESSION['user']['fkPoste']);
            $posteName = $poste['posName'];
            $collaborators = $controller->getAllAssignedCollaboratorsByPosteId($_SESSION['user']['fkPoste']);
            include('view/homeView.php');
        }
    }

    public function initPosteController()
    {
        $controller = new PosteController();
        return $controller;
    }

    public function displayPoste()
    {
        include('view/posteView.php');
    }
    public function displayPosteCollaborator()
    {
        $controller = $this->initPosteController();
        $_SESSION['posteName'] = (isset($_POST['posteName']) ? $_POST['posteName'] : '');

        $collaborators = $controller->getAllCollaborators();
        include('view/posteCollaboratorView.php');
    }

    public function checkIfPosteAlreadyExists($posteName)
    {
        // return $this->initPosteController()->checkIfPosteAlreadyExists($posteName);
        return false;
    }

    public function createPoste()
    {
        $controller = $this->initPosteController();
        $controller->createPoste();
    }

    public function displayListStudents()
    {
        $consts = $this->consts;
        $controller = new StudentsController();
        $students = $controller->getAllStudents();
        include('view/listStudentsView.php');
    }

    public function displayDetails($idStudent)
    {
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
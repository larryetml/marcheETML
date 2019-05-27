<?php
/**
 * ETML
 * Auteur : Larry Lam
 * Date : 09.05.19
 * Description : Contrôleur qui gère l'affichage des élèves ainsi que leurs postes associés
 */
require_once('Controller.php');
class StudentsController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function getAllStudents()
    {
        return $this->model->getAllStudents();
    }

    public function getStudentById($idStudent)
    {
        return $this->model->getStudentById($idStudent);
    }
    public function getPassedPostesIdFromStudentId($idStudent)
    {
        return $this->model->getPassedPostesIdFromStudentId($idStudent);
    }
    
    public function getPosteById($idPoste)
    {
        return parent::getPosteById($idPoste);
    }
}

?>
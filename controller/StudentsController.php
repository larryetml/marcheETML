<?php
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
}

?>
<?php
require_once('Controller.php');
class HomeController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function getPosteById($id)
    {
        return $this->model->getPosteById($id);
    }

    public function getAllAssignedCollaboratorsByPosteId($id)
    {
        return $this->model->getAllAssignedCollaboratorsByPosteId($id);
    }

}

?>
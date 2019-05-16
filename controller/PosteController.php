<?php
require_once('Controller.php');
class PosteController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    
    public function getAllCollaborators()
    {
        return $this->model->getAllCollaborators();
    }
}

?>
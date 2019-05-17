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
    
    public function createPoste()
    {
        $assignedCollaborators = (isset($_POST['assignedCollaborators']) ? $_POST['assignedCollaborators'] : false);
        $posteName = $_SESSION['posteName'];
        $this->model->createPoste($posteName);
        $this->assignUsers($assignedCollaborators, $posteName);
    }
    
    public function assignUsers($assignedCollaborators, $posteName)
    {
        //sachant que posteName est unique
        if($assignedCollaborators)
        {
            foreach($assignedCollaborators as $collaborator)
            {
                $this->model->assignUserToPoste($collaborator, $posteName);
            }
        }
    }
}

?>
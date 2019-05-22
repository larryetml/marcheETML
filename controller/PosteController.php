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

    public function getAllUnassignedCollaborators()
    {
        // return $this->model->getAllUnassignedCollaborators();
        $collaborators = $this->model->getAllCollaborators();
        $assignedCollaboratorsArray = $this->model->getAllAssignedCollaboratorsId();

        $assignedCollaborators = [];
        foreach($assignedCollaboratorsArray as $assignedCollaborator)
        {
            array_push($assignedCollaborators, $assignedCollaborator['fkCollaborator']);
        }

        $allUnassignedCollaborators = [];
        foreach($collaborators as $collaborator)
        {
            if(!in_array($collaborator['idCollaborator'], $assignedCollaborators)) {
                array_push($allUnassignedCollaborators, $collaborator);
            }
        }
        return $allUnassignedCollaborators;
    }
    
    public function createPoste()
    {
        $assignedCollaborators = (isset($_POST['assignedCollaborators']) ? $_POST['assignedCollaborators'] : false);
        $posteName = $_SESSION['posteName'];
        $this->model->createPoste($posteName);

        $idPoste = $this->model->getPosteFromName($posteName)['idPoste']; 

        $this->assignUsers($assignedCollaborators, $idPoste);
        unset($_SESSION['posteName']);
    }
    
    public function assignUsers($assignedCollaborators, $idPoste)
    {
        if($assignedCollaborators)
        {
            //sachant que posteName est unique
            foreach($assignedCollaborators as $collaboratorId)
            {

                $collaborator = $this->model->getUserFromCollaboratorId($collaboratorId);
                if($collaborator)
                {
                    $this->model->assignUserToPoste($collaborator['idUser'], $idPoste);
                }else
                {
                    $this->model->createUser($collaboratorId, $idPoste);
                }

            }
        }
    }

    public function checkIfPosteAlreadyExists($posteName)
    {
            $result = $this->model->checkIfPosteAlreadyExists($posteName);
            if($result)
            {
                return true;
            }else
            {
                return false;
            }

    }
    public function editPoste($idPoste)
    {
        $poste = $this->model->getPosteById($idPoste);
        
        if($poste)
        {
            $step = ((isset($_POST['step'])) ? $_POST['step'] : '');

            switch($step)
            {
                case 2:
                $posteName = ((isset($_POST['posteName'])) ? $_POST['posteName'] : '');
                $assignedCollaborators = ((isset($_POST['assignedCollaborators'])) ? $_POST['assignedCollaborators'] : '');
                $idPoste = $this->model->getPosteFromName($posteName)[0];
                $this->model->updatePosteNameFromId($idPoste,$posteName);
                $this->assignUsers($assignedCollaborators, $posteName);
                    break;
                    
                default:
                $collaborators = $this->model->getAllCollaborators();
                $assignedCollaborators = $this->model->getAllAssignedCollaboratorsByPosteId($idPoste);
                foreach($collaborators as $index=>$collaborator)
                {
                    $collaborators[$index]['isAssigned']=false;
                    foreach($assignedCollaborators as $assignedCollaborator)
                    {
                        if($collaborator['idCollaborator'] == $assignedCollaborator['idCollaborator'])
                        {
                            $collaborators[$index]['isAssigned']=true;
                        }
                    }
    
                }
                include('view/editPosteView.php');
                    break;
            }
        }else
        {
            echo 'Le poste demandé n\'existe pas';
        }
    }



    public function deletePosteFromId($idPoste)
    {

        if(is_numeric($idPoste))
        {
            $this->model->unassignPosteFromAllUsers($idPoste);
            $this->model->deletePosteFromId($idPoste);
        }
        header("Location: index.php?page=home");
    }
}

?>
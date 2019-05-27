<?php
/**
 * ETML
 * Auteur : Larry Lam
 * Date : 16.05.19
 * Description : Contrôleur qui gère tout ce qui est en lien avec les postes.
 * La création, modification, supression et l'affichage.
 * Les collaborateurs
 */
require_once('Controller.php');
class PosteController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function getPosteById($idPoste)
    {
        return parent::getPosteById($idPoste);
    }

    public function getAllAssignedCollaboratorsByPosteId($id)
    {
        return $this->model->getAllAssignedCollaboratorsByPosteId($id);
    }
    public function getAllPostesWithCollaborators()
    {
        return $this->model->getAllPostesWithCollaborators();
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
    
    public function createPoste($assignedCollaborators)
    {
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
                $user = $this->model->getUserFromCollaboratorId($collaboratorId);
                if($user)
                {
                    $this->model->assignUserToPoste($user['idUser'], $idPoste);
                }else
                {
                    $collaborator =  $this->model->getCollaboratorById($collaboratorId)[0];
                    $clearPasword = strtolower(substr($collaborator['colLastname'], 0, 8).substr($collaborator['colName'], 0, 2));
                    $cryptedPassword = password_hash($clearPasword, PASSWORD_BCRYPT);
                    $this->model->createUser($collaboratorId, $idPoste, $cryptedPassword);
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
        $poste = $this->getPosteById($idPoste);
        
        if($poste)
        {
            $step = ((isset($_POST['step'])) ? $_POST['step'] : '');

            switch($step)
            {
                case 2:
                    $posteName = ((isset($_POST['posteName'])) ? $_POST['posteName'] : '');
                    $assignedCollaborators = ((isset($_POST['assignedCollaborators'])) ? $_POST['assignedCollaborators'] : '');

                    //Retirer tous les collaborateurs assignés à ce poste
                    $this->model->unassignPosteFromAllUsers($idPoste);
                    //Puis assigner les collaborateurs cochés au poste
                    $this->assignUsers($assignedCollaborators, $idPoste);   
                    //Supprimer les utilisateurs qui ont été retirés
                    $this->model->deleteAllUnassigedAccounts();

                    //Si le nom a été modifié
                    if($poste['posName'] != $posteName)
                    {
                        //Vérifie si le nom est déjà pris
                        if($this->checkIfPosteAlreadyExists($posteName))
                        {
                            header('Location: index.php?page=poste&action=edit&id='.$idPoste.'&error=1');
                            return;
                        }else //Modifie le nom
                        {   
                            $this->model->updatePosteNameFromId($idPoste,$posteName);                 
                        }
                    }
                    header("Location: index.php?page=home");
                    break;                    
                default:
                    $collaborators = $this->getAllUnassignedCollaborators();
                    $assignedCollaborators = $this->getAllAssignedCollaboratorsByPosteId($idPoste);
                    foreach($assignedCollaborators as $assignedCollaborator)
                    {   
                        array_push($collaborators, $assignedCollaborator);
                    }
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

    public function validatePostePassageFromIdStudent($idStudent,$idPoste)
    {
        $this->model->validatePostePassageFromIdStudent($idStudent,$idPoste);
    }
    public function removePostePassageFromIdStudent($idStudent,$idPoste)
    {
        $this->model->removePostePassageFromIdStudent($idStudent,$idPoste);
    }
    public function deletePosteFromId($idPoste)
    {
        if(is_numeric($idPoste))
        {
            $this->model->unassignPosteFromAllUsers($idPoste);
            $this->model->deletePassedPosteFromId($idPoste);
            $this->model->deletePosteFromId($idPoste);
            $this->model->deleteAllUnassigedAccounts();
        }
        header("Location: index.php?page=home");
    }
}

?>
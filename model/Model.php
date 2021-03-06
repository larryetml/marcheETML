<?php
/**
 * ETML
 * Auteur : Larry Lam
 * Date : 09.05.19
 * Description : Contrôleur principal qui traite les données générales (get, post, session) et gère l'affichage des vues
 * 
 */
require_once('Database.php');

/* DATABASE MODEL */
class Model extends Database{

    function __construct() {
        parent::__construct();
    }

     public function getAllStudents()
    {

        return $this->fetchAllAssoc('SELECT * FROM `t_student`, `t_class`, `t_section` WHERE `t_student`.`fkClass` = `t_class`.`idClass` AND `t_class`.`fkSection` = `t_section`.`idSection`');
    }
    public function getAllCollaborators()
    {
        return $this->fetchAllAssoc('SELECT * FROM `t_collaborator`, `t_section` WHERE `t_collaborator`.`fkSection` = `t_section`.`idSection`');
    }
    public function getCollaboratorById($idCollaborator)
    {
        return $this->fetchAllAssoc('SELECT * FROM `t_collaborator` WHERE `t_collaborator`.`idCollaborator` = '.$idCollaborator.'');
    }
    public function getUserFromCollaboratorId($idCollaborator)
    {
        return $this->fetchSingle('SELECT * FROM `t_user` WHERE `t_user`.`fkCollaborator` = '.$idCollaborator.'');
    }
    public function getAllAssignedCollaboratorsId()
    {
        return $this->fetchAllAssoc('SELECT `fkCollaborator` FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_section` ON `t_collaborator`.`fkSection` = `t_section`.`idSection`
        WHERE `t_user`.`fkPoste` IS NOT NULL');      
    }
    public function getAllUnassignedCollaborators()
    {
        return $this->fetchAllAssoc('SELECT * FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_section` ON `t_collaborator`.`fkSection` = `t_section`.`idSection`
        WHERE `t_user`.`fkPoste` IS NULL');        
    }
    public function getAllAssignedCollaborators()
    {
        return $this->fetchAllAssoc('SELECT `colName`, `colLastname`, `colEmail`, `posName`   FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_poste` ON `t_user`.`fkPoste` = `t_poste`.`idPoste` 
        WHERE `t_user`.`fkPoste` IS NOT NULL');        
    }

    public function createPoste($posteName)
    {
        return $this->executeOnly('INSERT INTO `t_poste` (`idPoste`, `posName`) VALUES (NULL, \''.$posteName.'\')');
    }
    public function assignUserToPoste($idUser, $posteId)
    {
        return $this->executeOnly('UPDATE `t_user` SET `fkPoste` = \''.$posteId.'\' WHERE `t_user`.`idUser` = '.$idUser.'');
    }
    public function createUser($idUser, $idPoste, $usePassword)
    {
        return $this->executeOnly('INSERT INTO `t_user` (`idUser`, `usePassword`, `useIsAdmin`, `fkPoste`, `fkCollaborator`) VALUES (NULL, \''.$usePassword.'\', \'0\', \''.$idPoste.'\', \''.$idUser.'\')');
    }

    public function getStudentById($idStudent)
    {
        return $this->fetchSingle('SELECT * FROM `t_student`, `t_class`, `t_section` WHERE `t_student`.`fkClass` = `t_class`.`idClass` AND `t_class`.`fkSection` = `t_section`.`idSection` AND `t_student`.`idStudent` = '.$idStudent.'');
    }

    public function getUserByEmail($email)
    {
        return $this->fetchSingle('SELECT * FROM `t_user` INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator`  WHERE `t_collaborator`.`colEmail` = \''.$email.'\'');
    }

    public function getPosteById($idPoste)
    {
        return $this->fetchSingle('SELECT * FROM `t_poste`  WHERE `t_poste`.`idPoste` = \''.$idPoste.'\'');
    }

    public function getPosteFromName($posteName)
    {
        return $this->fetchSingle('SELECT * FROM `t_poste`  WHERE `t_poste`.`posName` = \''.$posteName.'\'');
    }

    public function getPassedPostesIdFromStudentId($idStudent)
    {
        return $this->fetchAllAssoc('SELECT `idPoste` FROM `checkposte` 
        INNER JOIN `t_poste` ON `checkposte`.`fkPoste` = `t_poste`.`idPoste` 
        INNER JOIN `t_student` ON `checkposte`.`fkStudent` = `t_student`.`idStudent` 
        WHERE `t_student`.`idStudent` = '.$idStudent.'');
    }

    public function getAllAssignedCollaboratorsByPosteId($idPoste)
    {
        return $this->fetchAllAssoc('SELECT * FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_section` ON `t_collaborator`.`fkSection` = `t_section`.`idSection` 
        WHERE `t_user`.`fkPoste` = \''.$idPoste.'\'');
    }

    public function updatePosteNameFromId($idPoste,$posteName)
    {
        return $this->executeOnly('UPDATE `t_poste` SET `posName` = \''.$posteName.'\' WHERE `t_poste`.`idPoste` = '.$idPoste.'');
    }
    public function validatePostePassageFromIdStudent($idStudent,$idPoste)
    {
        return $this->executeOnly('INSERT INTO `checkposte` (`fkPoste`, `fkStudent`) VALUES ('.$idPoste.', '.$idStudent.')');
    }
    public function removePostePassageFromIdStudent($idStudent,$idPoste)
    {
        return $this->executeOnly('DELETE FROM `checkposte` 
        WHERE `checkposte`.`fkPoste` = '.$idPoste.' AND `checkposte`.`fkStudent` = '.$idStudent.'');
    }

    public function checkIfPosteAlreadyExists($posteName)
    {
        return $this->fetchSingle('SELECT * FROM `t_poste` WHERE `t_poste`.`posName` = \''.$posteName.'\'');
    }

    public function getAllPostes()
    {
        return $this->fetchAllAssoc('SELECT `idPoste`, `posName` FROM `t_poste`');
    }
    public function getAllPostesWithCollaborators()
    {
        return $this->fetchAllAssoc('SELECT `idPoste`,`posName`,`colName`,`colLastname`,`secName` 
        FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_section` ON `t_collaborator`.`fkSection` = `t_section`.`idSection`
        INNER JOIN `t_poste` ON `t_user`.`fkPoste` = `t_poste`.`idPoste`');
    }

    public function unassignPosteFromAllUsers($idPoste)
    {
        return $this->executeOnly('UPDATE `t_user` SET `fkPoste` = NULL WHERE `t_user`.`fkposte` = '.$idPoste.'');
    }
    public function deletePosteFromId($idPoste)
    {
        return $this->executeOnly('DELETE FROM `t_poste` WHERE `t_poste`.`idPoste` = '.$idPoste.'');
    }
    public function deletePassedPosteFromId($idPoste)
    {
        return $this->executeOnly('DELETE FROM `checkposte` WHERE `checkposte`.`fkPoste` = '.$idPoste.'');
    }
    public function deleteAllUnassigedAccounts()
    {
        return $this->executeOnly('DELETE FROM `t_user` WHERE `t_user`.`fkPoste` IS NULL AND `t_user`.`useIsAdmin` = 0');
    }
}

?>
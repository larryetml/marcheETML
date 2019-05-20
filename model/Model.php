<?php
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
    public function getAllUnassignedCollaborators()
    {
        return $this->fetchAllAssoc('SELECT * FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_section` ON`t_collaborator`.`fkSection` = `t_section`.`idSection`
        WHERE `t_user`.`fkPoste` IS NULL');
    }

    public function createPoste($posteName)
    {
        return $this->executeOnly('INSERT INTO `t_poste` (`idPoste`, `posName`) VALUES (NULL, \''.$posteName.'\')');
    }
    public function assignUserToPoste($idUser, $posteId)
    {
        echo ('UPDATE `t_user` SET `fkPoste` = \''.$posteId.'\' WHERE `t_user`.`idUser` = '.$idUser.'');
        return $this->executeOnly('UPDATE `t_user` SET `fkPoste` = \''.$posteId.'\' WHERE `t_user`.`idUser` = '.$idUser.'');
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

    public function getAllAssignedCollaboratorsByPosteId($idPoste)
    {
        return $this->fetchAllAssoc('SELECT * FROM `t_user` 
        INNER JOIN `t_collaborator` ON `t_user`.`fkCollaborator` = `t_collaborator`.`idCollaborator` 
        INNER JOIN `t_section` ON `t_collaborator`.`fkSection` = `t_section`.`idSection` 
        WHERE `t_user`.`fkPoste` = \''.$idPoste.'\'');
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
}

?>
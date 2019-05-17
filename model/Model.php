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

    public function removeProductById($idProduct)
    {
        return $this->executeOnly('DELETE * FROM `t_product` WHERE `t_product`.`idProduct` = '.$idProduct.'');
    }

    public function createPoste($posteName)
    {
        return $this->executeOnly('INSERT INTO `t_poste` (`idPoste`, `posName`) VALUES (NULL, \''.$posteName.'\')');
    }
    public function assignUserToPoste($collaborators, $posteId)
    {
        return $this->executeOnly('');
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

    public function getConsts()
    {
        return $this->fetchSingle('SELECT * FROM `t_const`');
    }




}

?>
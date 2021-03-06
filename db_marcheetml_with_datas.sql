-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 24 mai 2019 à 12:16
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_marcheetml`
--

CREATE DATABASE `db_marcheetml`;
USE `db_marcheetml`;

-- --------------------------------------------------------

--
-- Structure de la table `checkposte`
--

DROP TABLE IF EXISTS `checkposte`;
CREATE TABLE IF NOT EXISTS `checkposte` (
  `fkPoste` int(11) NOT NULL,
  `fkStudent` int(11) NOT NULL,
  PRIMARY KEY (`fkPoste`,`fkStudent`),
  KEY `checkPoste_t_student0_FK` (`fkStudent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `checkposte`
--

INSERT INTO `checkposte` (`fkPoste`, `fkStudent`) VALUES
(160, 6);

-- --------------------------------------------------------

--
-- Structure de la table `t_class`
--

DROP TABLE IF EXISTS `t_class`;
CREATE TABLE IF NOT EXISTS `t_class` (
  `idClass` int(11) NOT NULL AUTO_INCREMENT,
  `claName` varchar(50) NOT NULL,
  `fkSection` int(11) NOT NULL,
  PRIMARY KEY (`idClass`),
  UNIQUE KEY `unique_claName` (`claName`),
  KEY `t_class_t_section_FK` (`fkSection`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_class`
--

INSERT INTO `t_class` (`idClass`, `claName`, `fkSection`) VALUES
(1, 'MIN4', 1),
(2, 'CIN4', 1),
(3, 'CID4', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_collaborator`
--

DROP TABLE IF EXISTS `t_collaborator`;
CREATE TABLE IF NOT EXISTS `t_collaborator` (
  `idCollaborator` int(11) NOT NULL AUTO_INCREMENT,
  `colName` varchar(255) NOT NULL,
  `colLastname` varchar(255) NOT NULL,
  `colEmail` varchar(255) NOT NULL,
  `fkSection` int(11) NOT NULL,
  PRIMARY KEY (`idCollaborator`),
  UNIQUE KEY `unique_colEmail` (`colEmail`),
  KEY `t_collaborator_t_section_FK` (`fkSection`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_collaborator`
--

INSERT INTO `t_collaborator` (`idCollaborator`, `colName`, `colLastname`, `colEmail`, `fkSection`) VALUES
(1, 'Bertrand', 'Sahli', 'bertrand.sahli@vd.ch', 1),
(2, 'Antoine', 'Mveng', 'antoine.mveng@vd.ch', 1),
(3, 'Nicolas', 'Falconnier', 'nicolas.falconnier@vd.ch', 4),
(5, 'Michel', 'Delgado', 'michel.delgado@vd.ch', 1),
(6, 'Raymond', 'Jobin', 'raymond.jobin@vd.ch', 2);

-- --------------------------------------------------------

--
-- Structure de la table `t_poste`
--

DROP TABLE IF EXISTS `t_poste`;
CREATE TABLE IF NOT EXISTS `t_poste` (
  `idPoste` int(11) NOT NULL AUTO_INCREMENT,
  `posName` varchar(255) NOT NULL,
  PRIMARY KEY (`idPoste`),
  UNIQUE KEY `unique_posName` (`posName`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_poste`
--

INSERT INTO `t_poste` (`idPoste`, `posName`) VALUES
(162, 'Poste 1'),
(160, 'Poste 2');

-- --------------------------------------------------------

--
-- Structure de la table `t_section`
--

DROP TABLE IF EXISTS `t_section`;
CREATE TABLE IF NOT EXISTS `t_section` (
  `idSection` int(11) NOT NULL AUTO_INCREMENT,
  `secName` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idSection`),
  UNIQUE KEY `unique_secName` (`secName`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_icelandic_ci;

--
-- Déchargement des données de la table `t_section`
--

INSERT INTO `t_section` (`idSection`, `secName`) VALUES
(2, 'Bois'),
(1, 'Informatique'),
(3, 'Mécanique'),
(4, 'Théorie');

-- --------------------------------------------------------

--
-- Structure de la table `t_student`
--

DROP TABLE IF EXISTS `t_student`;
CREATE TABLE IF NOT EXISTS `t_student` (
  `idStudent` int(11) NOT NULL AUTO_INCREMENT,
  `stuName` varchar(255) NOT NULL,
  `stuLastname` varchar(255) NOT NULL,
  `stuImageUrl` varchar(255) NOT NULL,
  `stuEmail` varchar(255) NOT NULL,
  `fkClass` int(11) NOT NULL,
  PRIMARY KEY (`idStudent`),
  KEY `t_student_t_class_FK` (`fkClass`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_student`
--

INSERT INTO `t_student` (`idStudent`, `stuName`, `stuLastname`, `stuImageUrl`, `stuEmail`, `fkClass`) VALUES
(1, 'Larry', 'Lam', 'lamho.jpg', 'lamho@etml.educanet2.ch', 1),
(2, 'Victor', 'Callewaert', 'callewaevi.jpg', 'callewaevi@etml.educanet2.ch', 2),
(3, 'Loic', 'Herzig', 'herziglo.jpg', 'herziglo@etml.educanet2.ch', 1),
(5, 'Sam', 'Pache', 'pachesa.jpg', 'pache@etml.educanet2.ch', 1),
(6, 'Jonathan', 'Stocchetti', 'stocchetjo.jpg', 'stocchetjo@etml.educanet2.ch', 1),
(7, 'Yassine', 'Camba', 'cambaya.jpg', 'cambaya@etml.educanet2.ch', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE IF NOT EXISTS `t_user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `usePassword` varchar(255) NOT NULL,
  `useIsAdmin` tinyint(1) NOT NULL,
  `fkPoste` int(11) DEFAULT NULL,
  `fkCollaborator` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `t_user_t_collaborator_AK` (`fkCollaborator`),
  KEY `t_user_t_poste_FK` (`fkPoste`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `usePassword`, `useIsAdmin`, `fkPoste`, `fkCollaborator`) VALUES
(21, '$2y$10$g5Gq0CHsJg3OmBBlr4rDXOl1lYpK3CPjqDPlR75OaR10L5XNdCGtW', 1, 162, 3),
(22, '$2y$10$g5Gq0CHsJg3OmBBlr4rDXOl1lYpK3CPjqDPlR75OaR10L5XNdCGtW', 0, 162, 6),
(25, '$2y$10$g5Gq0CHsJg3OmBBlr4rDXOl1lYpK3CPjqDPlR75OaR10L5XNdCGtW', 0, 160, 2),
(26, '$2y$10$g5Gq0CHsJg3OmBBlr4rDXOl1lYpK3CPjqDPlR75OaR10L5XNdCGtW', 0, 162, 1),
(28, '$2y$10$g5Gq0CHsJg3OmBBlr4rDXOl1lYpK3CPjqDPlR75OaR10L5XNdCGtW', 0, 160, 5);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `checkposte`
--
ALTER TABLE `checkposte`
  ADD CONSTRAINT `checkPoste_t_poste_FK` FOREIGN KEY (`fkPoste`) REFERENCES `t_poste` (`idPoste`),
  ADD CONSTRAINT `checkPoste_t_student0_FK` FOREIGN KEY (`fkStudent`) REFERENCES `t_student` (`idStudent`);

--
-- Contraintes pour la table `t_class`
--
ALTER TABLE `t_class`
  ADD CONSTRAINT `t_class_t_section_FK` FOREIGN KEY (`fkSection`) REFERENCES `t_section` (`idSection`);

--
-- Contraintes pour la table `t_collaborator`
--
ALTER TABLE `t_collaborator`
  ADD CONSTRAINT `t_collaborator_t_section_FK` FOREIGN KEY (`fkSection`) REFERENCES `t_section` (`idSection`);

--
-- Contraintes pour la table `t_student`
--
ALTER TABLE `t_student`
  ADD CONSTRAINT `t_student_t_class_FK` FOREIGN KEY (`fkClass`) REFERENCES `t_class` (`idClass`);

--
-- Contraintes pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD CONSTRAINT `t_user_t_collaborator0_FK` FOREIGN KEY (`fkCollaborator`) REFERENCES `t_collaborator` (`idCollaborator`),
  ADD CONSTRAINT `t_user_t_poste_FK` FOREIGN KEY (`fkPoste`) REFERENCES `t_poste` (`idPoste`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

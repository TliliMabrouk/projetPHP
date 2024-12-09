-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 nov. 2024 à 22:16
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sysgestionabs`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_classe`
--

CREATE TABLE `t_classe` (
  `CodeClasse` int(11) NOT NULL,
  `NomClasse` varchar(30) NOT NULL,
  `CodeGroupe` int(11) NOT NULL,
  `CodeDepartement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_departement`
--

CREATE TABLE `t_departement` (
  `CodeDepartement` int(11) NOT NULL,
  `NomDepartement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_enseignant`
--

CREATE TABLE `t_enseignant` (
  `CodeEnseignant` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `DateRecrutement` date NOT NULL,
  `Adresse` varchar(30) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Tel` varchar(20) NOT NULL,
  `CodeDepartement` int(11) NOT NULL,
  `CodeGrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_etudiant`
--

CREATE TABLE `t_etudiant` (
  `CodeEtudiant` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Prenom` varchar(30) NOT NULL,
  `Datenaissance` date NOT NULL,
  `CodeClasse` int(11) NOT NULL,
  `NumInscription` int(11) NOT NULL,
  `Adresse` varchar(40) NOT NULL,
  `Mail` varchar(30) NOT NULL,
  `Tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_ficheabsence`
--

CREATE TABLE `t_ficheabsence` (
  `CodeFichierAbsence` int(11) NOT NULL,
  `Datejour` date NOT NULL,
  `CodeMatiere` int(11) NOT NULL,
  `CodeEnseignant` int(11) NOT NULL,
  `CodeClasse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_ficheabsenceseance`
--

CREATE TABLE `t_ficheabsenceseance` (
  `CodeFicheabsence` int(11) NOT NULL,
  `Codeseance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_grade`
--

CREATE TABLE `t_grade` (
  `CodeGrade` int(11) NOT NULL,
  `NomGrade` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_groupe`
--

CREATE TABLE `t_groupe` (
  `CodeGroupe` int(11) NOT NULL,
  `NomGroupe` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_ligneficheabsence`
--

CREATE TABLE `t_ligneficheabsence` (
  `CodeFicheabsence` int(11) NOT NULL,
  `CodeEtudiant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_matiere`
--

CREATE TABLE `t_matiere` (
  `CodeMatiere` int(11) NOT NULL,
  `NomMatiere` varchar(30) NOT NULL,
  `NbreHeureCoursParSemaine` int(11) NOT NULL,
  `NbreHeureTDParSemaine` int(11) NOT NULL,
  `NbreHeureTPParSemaine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_seance`
--

CREATE TABLE `t_seance` (
  `CodeSeance` int(11) NOT NULL,
  `NomSeance` int(11) NOT NULL,
  `HeureDebut` time NOT NULL,
  `HeureFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_classe`
--
ALTER TABLE `t_classe`
  ADD PRIMARY KEY (`CodeClasse`),
  ADD KEY `CodeGroupe` (`CodeGroupe`),
  ADD KEY `Codedepartment` (`CodeDepartement`);

--
-- Index pour la table `t_departement`
--
ALTER TABLE `t_departement`
  ADD PRIMARY KEY (`CodeDepartement`);

--
-- Index pour la table `t_enseignant`
--
ALTER TABLE `t_enseignant`
  ADD PRIMARY KEY (`CodeEnseignant`),
  ADD KEY `Codedepartment` (`CodeDepartement`),
  ADD KEY `CodeGrade` (`CodeGrade`);

--
-- Index pour la table `t_etudiant`
--
ALTER TABLE `t_etudiant`
  ADD PRIMARY KEY (`CodeEtudiant`);

--
-- Index pour la table `t_ficheabsence`
--
ALTER TABLE `t_ficheabsence`
  ADD PRIMARY KEY (`CodeFichierAbsence`),
  ADD KEY `CodeClasse` (`CodeClasse`),
  ADD KEY `CodeMatiere` (`CodeMatiere`);

--
-- Index pour la table `t_ficheabsenceseance`
--
ALTER TABLE `t_ficheabsenceseance`
  ADD PRIMARY KEY (`CodeFicheabsence`,`Codeseance`),
  ADD KEY `CodeSeance` (`Codeseance`),
  ADD KEY `CodeFicheAbsence` (`CodeFicheabsence`);

--
-- Index pour la table `t_grade`
--
ALTER TABLE `t_grade`
  ADD PRIMARY KEY (`CodeGrade`);

--
-- Index pour la table `t_groupe`
--
ALTER TABLE `t_groupe`
  ADD PRIMARY KEY (`CodeGroupe`);

--
-- Index pour la table `t_ligneficheabsence`
--
ALTER TABLE `t_ligneficheabsence`
  ADD PRIMARY KEY (`CodeFicheabsence`,`CodeEtudiant`),
  ADD UNIQUE KEY `CodeEtudiant` (`CodeEtudiant`),
  ADD KEY `CodeFicheAbsence` (`CodeFicheabsence`);

--
-- Index pour la table `t_matiere`
--
ALTER TABLE `t_matiere`
  ADD PRIMARY KEY (`CodeMatiere`);

--
-- Index pour la table `t_seance`
--
ALTER TABLE `t_seance`
  ADD PRIMARY KEY (`CodeSeance`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_classe`
--
ALTER TABLE `t_classe`
  ADD CONSTRAINT `t_classe_ibfk_1` FOREIGN KEY (`CodeGroupe`) REFERENCES `t_groupe` (`CodeGroupe`),
  ADD CONSTRAINT `t_classe_ibfk_2` FOREIGN KEY (`CodeDepartement`) REFERENCES `t_departement` (`CodeDepartement`);

--
-- Contraintes pour la table `t_enseignant`
--
ALTER TABLE `t_enseignant`
  ADD CONSTRAINT `t_enseignant_ibfk_1` FOREIGN KEY (`CodeDepartement`) REFERENCES `t_departement` (`CodeDepartement`),
  ADD CONSTRAINT `t_enseignant_ibfk_2` FOREIGN KEY (`CodeGrade`) REFERENCES `t_grade` (`CodeGrade`);

--
-- Contraintes pour la table `t_ficheabsence`
--
ALTER TABLE `t_ficheabsence`
  ADD CONSTRAINT `t_ficheabsence_ibfk_1` FOREIGN KEY (`CodeClasse`) REFERENCES `t_classe` (`CodeClasse`),
  ADD CONSTRAINT `t_ficheabsence_ibfk_2` FOREIGN KEY (`CodeMatiere`) REFERENCES `t_matiere` (`CodeMatiere`);

--
-- Contraintes pour la table `t_ficheabsenceseance`
--
ALTER TABLE `t_ficheabsenceseance`
  ADD CONSTRAINT `t_ficheabsenceseance_ibfk_1` FOREIGN KEY (`Codeseance`) REFERENCES `t_seance` (`CodeSeance`),
  ADD CONSTRAINT `t_ficheabsenceseance_ibfk_2` FOREIGN KEY (`CodeFicheabsence`) REFERENCES `t_ficheabsence` (`CodeFichierAbsence`);

--
-- Contraintes pour la table `t_ligneficheabsence`
--
ALTER TABLE `t_ligneficheabsence`
  ADD CONSTRAINT `t_ligneficheabsence_ibfk_1` FOREIGN KEY (`CodeFicheabsence`) REFERENCES `t_ficheabsence` (`CodeFichierAbsence`),
  ADD CONSTRAINT `t_ligneficheabsence_ibfk_2` FOREIGN KEY (`CodeEtudiant`) REFERENCES `t_etudiant` (`CodeEtudiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

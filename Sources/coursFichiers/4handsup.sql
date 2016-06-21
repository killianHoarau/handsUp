-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 20 Juin 2016 à 10:23
-- Version du serveur :  5.6.30
-- Version de PHP :  5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `handsup`
--

-- --------------------------------------------------------

--
-- Structure de la table `code_statut`
--

CREATE TABLE IF NOT EXISTS `code_statut` (
  `code` varchar(5) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `utilise` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `code_statut`
--

INSERT INTO `code_statut` (`code`, `statut`, `utilise`) VALUES
('00000', 0, 1),
('11111', 1, 1),
('15487', 1, 0),
('75HY1', 1, 0),
('A456P', 0, 0),
('EP411', 0, 0),
('PG959', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(5) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `nomFichier` varchar(20) DEFAULT NULL,
  `idEnseignant` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `libelle`, `description`, `nomFichier`, `idEnseignant`) VALUES
(1, 'Géographie', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis est vitae sem luctus imperdiet. Phasellus lacus augue, elementum non tristique nec, porttitor eget mi. Morbi purus quam, tristique at felis eu, tempor venenatis tellus. Ut at nisl ut libero scelerisque bibendum. Nulla ultricies enim cursus pulvinar maximus. Proin ut placerat quam. Maecenas eget est sed sapien maximus dignissim. Morbi sit amet turpis egestas, viverra tortor et, aliquet est. Fusce pellentesque dapibus sem, id cursus sem rhoncus a. Etiam et nulla risus. Vestibulum non dignissim metus. Maecenas vitae lacus id nisl rhoncus ornare a non ex. Curabitur laoreet tincidunt erat, et mollis arcu lacinia eu. Maecenas nec ante non massa tempus imperdiet sit amet vitae erat. In tincidunt dignissim vestibulum. Etiam faucibus nisl turpis, nec vestibulum ante elementum eu.\r\n\r\nVestibulum posuere libero sem, sit amet egestas arcu vehicula vitae. Donec tincidunt ligula vehicula nisl molestie pulvinar.', '505ft.jpg', 2),
(2, 'Mathématique', 'Cours de mathématique', 'mon', 2),
(3, 'Français', 'Cours de français', NULL, 2),
(4, '', '', '4', 2);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(4) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `idEmetteur` int(3) NOT NULL,
  `idDestinataire` int(3) NOT NULL,
  `reponse` tinyint(1) NOT NULL DEFAULT '0',
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(10) NOT NULL,
  `libelle` varchar(500) NOT NULL,
  `verrouille` tinyint(1) NOT NULL DEFAULT '0',
  `idCours` int(5) NOT NULL,
  `numero` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `libelle`, `verrouille`, `idCours`, `numero`) VALUES
(11, 'Quelle est ta couleur préférée ?', 1, 1, 1),
(12, 'Quelle est la capitale de la France ?', 0, 1, 2),
(13, 'De quelle couleur est le ciel ?', 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `repondre`
--

CREATE TABLE IF NOT EXISTS `repondre` (
  `idUtilisateur` int(3) NOT NULL DEFAULT '0',
  `idReponse` int(10) NOT NULL,
  `date` date NOT NULL,
  `temps` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `repondre`
--

INSERT INTO `repondre` (`idUtilisateur`, `idReponse`, `date`, `temps`) VALUES
(1, 2, '2016-06-20', 10),
(2, 2, '2016-06-20', 6),
(3, 2, '2016-06-20', 5),
(4, 3, '2016-06-20', 5),
(14, 2, '2016-06-20', 48),
(14, 3, '2016-06-20', 9);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int(10) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `bonne` tinyint(1) NOT NULL,
  `nomImage` varchar(50) DEFAULT NULL,
  `idQuestion` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `libelle`, `bonne`, `nomImage`, `idQuestion`) VALUES
(2, 'Bleu', 1, NULL, 11),
(3, 'Rouge', 0, NULL, 11),
(4, 'Petite reponse', 1, NULL, 12),
(5, 'Mauvaise reponse', 0, NULL, 12),
(6, 'Mauvaise reponse 2', 0, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `suivre_cours`
--

CREATE TABLE IF NOT EXISTS `suivre_cours` (
  `idUtilisateur` int(3) NOT NULL,
  `idCours` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `suivre_cours`
--

INSERT INTO `suivre_cours` (`idUtilisateur`, `idCours`) VALUES
(1, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(4) NOT NULL,
  `login` varchar(20) NOT NULL,
  `motDePasse` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `motDePasse`, `email`, `statut`, `valide`) VALUES
(2, 'MrProf', 'prof', 'prof@test.fr', 1, 1),
(13, 'admin', 'admin', 'admin@test.fr', 2, 1),
(14, 'jp', 'm', 'jp@m.fr', 0, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `code_statut`
--
ALTER TABLE `code_statut`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `repondre`
--
ALTER TABLE `repondre`
  ADD PRIMARY KEY (`idUtilisateur`,`idReponse`,`date`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivre_cours`
--
ALTER TABLE `suivre_cours`
  ADD PRIMARY KEY (`idUtilisateur`,`idCours`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

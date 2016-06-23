-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 23 Juin 2016 à 09:58
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
('15487', 1, 1),
('75HY1', 1, 0),
('A456P', 0, 0),
('EP411', 0, 0),
('PG959', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(3) NOT NULL,
  `utilisateur0` int(3) NOT NULL,
  `utilisateur1` int(3) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `utilisateur0`, `utilisateur1`, `date`) VALUES
(1, 2, 14, '2016-06-23'),
(2, 2, 17, '2016-06-23');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(5) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `nomFichier` varchar(20) DEFAULT NULL,
  `idEnseignant` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`id`, `libelle`, `description`, `nomFichier`, `idEnseignant`) VALUES
(1, 'Histoire', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis est vitae sem luctus imperdiet. Phasellus lacus augue, elementum non tristique nec, porttitor eget mi. Morbi purus quam, tristique at felis eu, tempor venenatis tellus. Ut at nisl ut libero scelerisque bibendum. Nulla ultricies enim cursus pulvinar maximus. Proin ut placerat quam. Maecenas eget est sed sapien maximus dignissim. Morbi sit amet turpis egestas, viverra tortor et, aliquet est. Fusce pellentesque dapibus sem, id cursus sem rhoncus a. Etiam et nulla risus. Vestibulum non dignissim metus. Maecenas vitae lacus id nisl rhoncus ornare a non ex. Curabitur laoreet tincidunt erat, et mollis arcu lacinia eu. Maecenas nec ante non massa tempus imperdiet sit amet vitae erat. In tincidunt dignissim vestibulum. Etiam faucibus nisl turpis, nec vestibulum ante elementum eu.\n\nVestibulum posuere libero sem, sit amet egestas arcu vehicula vitae. Donec tincidunt ligula vehicula nisl molestie pulvinar.', 'courshist.pdf', 2),
(2, 'Géographie', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis est vitae sem luctus imperdiet. Phasellus lacus augue, elementum non tristique nec, porttitor eget mi. Morbi purus quam, tristique at felis eu, tempor venenatis tellus. Ut at nisl ut libero scelerisque bibendum. Nulla ultricies enim cursus pulvinar maximus. Proin ut placerat quam. Maecenas eget est sed sapien maximus dignissim. Morbi sit amet turpis egestas, viverra tortor et, aliquet est. Fusce pellentesque dapibus sem, id cursus sem rhoncus a. Etiam et nulla risus. Vestibulum non dignissim metus. Maecenas vitae lacus id nisl rhoncus ornare a non ex. Curabitur laoreet tincidunt erat, et mollis arcu lacinia eu. Maecenas nec ante non massa tempus imperdiet sit amet vitae erat. In tincidunt dignissim vestibulum. Etiam faucibus nisl turpis, nec vestibulum ante elementum eu.\n\nVestibulum posuere libero sem, sit amet egestas arcu vehicula vitae. Donec tincidunt ligula vehicula nisl molestie pulvinar.', NULL, 2),
(3, 'Français', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent venenatis est vitae sem luctus imperdiet. Phasellus lacus augue, elementum non tristique nec, porttitor eget mi. Morbi purus quam, tristique at felis eu, tempor venenatis tellus. Ut at nisl ut libero scelerisque bibendum. Nulla ultricies enim cursus pulvinar maximus. Proin ut placerat quam. Maecenas eget est sed sapien maximus dignissim. Morbi sit amet turpis egestas, viverra tortor et, aliquet est. Fusce pellentesque dapibus sem, id cursus sem rhoncus a. Etiam et nulla risus. Vestibulum non dignissim metus. Maecenas vitae lacus id nisl rhoncus ornare a non ex. Curabitur laoreet tincidunt erat, et mollis arcu lacinia eu. Maecenas nec ante non massa tempus imperdiet sit amet vitae erat. In tincidunt dignissim vestibulum. Etiam faucibus nisl turpis, nec vestibulum ante elementum eu.\n\nVestibulum posuere libero sem, sit amet egestas arcu vehicula vitae. Donec tincidunt ligula vehicula nisl molestie pulvinar.', NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `message_prive`
--

CREATE TABLE IF NOT EXISTS `message_prive` (
  `id` int(10) NOT NULL,
  `idEmetteur` int(3) NOT NULL,
  `idDestinataire` int(3) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `lu` tinyint(1) NOT NULL,
  `idConversation` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `message_prive`
--

INSERT INTO `message_prive` (`id`, `idEmetteur`, `idDestinataire`, `titre`, `contenu`, `date`, `lu`, `idConversation`) VALUES
(1, 2, 14, 'Comment tu vas', 'slut mon petit', '2016-06-22', 1, 1),
(2, 2, 14, 'mqzl,m', 'LMSCZC?DMAC?L', '2016-06-22', 1, 1),
(3, 2, 14, 'Veux tu une bonne note ...????', '<p>si oui apporte a graille <img alt="laugh" src="http://localhost/handsup/Sources/js/ckeditor/plugins/smiley/images/teeth_smile.png" style="height:23px; width:23px" title="laugh" /></p>\n', '2016-06-22', 1, 1),
(4, 2, 17, 'zerklgh', '<p><br />\nslknerlberblerznb</p>\n', '2016-06-21', 0, 2),
(5, 14, 2, 'note', 'Oui je veux une bonne note mais tu te dermerde pour ta bouf', '2016-06-23', 1, 1),
(6, 2, 14, 'RE : note', '<p>Yoyoyo</p>\n', '2016-06-23', 1, 1),
(7, 2, 14, 'RE : note', '<p>Yoyoyo</p>\n', '2016-06-23', 1, 1),
(8, 2, 17, 'RE : zerklgh', '<p>Yo</p>\n', '2016-06-23', 0, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `libelle`, `verrouille`, `idCours`, `numero`) VALUES
(1, 'De quelle couleur est le cheval blanc d''Henri IV?', 0, 1, 1),
(2, 'Durant quelle période se déroula la bataille de Stalingrad ?', 1, 1, 2),
(3, 'À quelle date la France et l''Angleterre déclarent-elles la guerre à l''Allemagne ?', 0, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `repondre`
--

CREATE TABLE IF NOT EXISTS `repondre` (
  `adresseIP` varchar(15) NOT NULL,
  `idUtilisateur` int(3) DEFAULT NULL,
  `idReponse` int(10) NOT NULL,
  `date` date NOT NULL,
  `temps` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `repondre`
--

INSERT INTO `repondre` (`adresseIP`, `idUtilisateur`, `idReponse`, `date`, `temps`) VALUES
('127.0.0.1', 14, 8, '2016-06-21', 5),
('127.0.0.1', 14, 10, '2016-06-21', 39),
('127.0.0.19', NULL, 12, '2016-06-21', 25),
('127.0.325.1', NULL, 12, '2016-06-21', 19),
('127.0.325.19', NULL, 12, '2016-06-21', 9),
('127.2.325.0', NULL, 12, '2016-06-21', 34),
('127.215.0.1', 16, 11, '2016-06-21', 6),
('127.215.325.1', 15, 11, '2016-06-21', 15),
('127.246.284.1', 16, 8, '2016-06-21', 21),
('127.32.325.79', NULL, 11, '2016-06-21', 26),
('127.78.79.1', NULL, 11, '2016-06-21', 45),
('127.980.23.1', NULL, 10, '2016-06-21', 22),
('157.165.654.2', 15, 9, '2016-06-21', 13);

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id`, `libelle`, `bonne`, `nomImage`, `idQuestion`) VALUES
(7, 'Noir', 0, NULL, 1),
(8, 'Gris', 0, NULL, 1),
(9, 'Blanc', 1, NULL, 1),
(10, 'En août 1939', 0, NULL, 2),
(11, 'En septembre 1939', 1, NULL, 2),
(12, 'En septembre 1940', 0, NULL, 2),
(13, 'Octobre 1942 à janvier 1943', 0, NULL, 3),
(14, 'Juillet 1942 à février 1943', 1, NULL, 3),
(15, 'Décembre 1942 à mars 1943', 0, NULL, 3);

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
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(16, 2),
(16, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(4) NOT NULL,
  `login` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `motDePasse` varchar(300) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `motDePasse`, `email`, `statut`, `valide`) VALUES
(2, 'mrprof', '51d1e6a398acbda7e15b687de747e7dfe95fa13154dcb40aa8ab37f1e2b393a0', 'prof@test.fr', 1, 1),
(13, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@test.fr', 2, 1),
(14, 'elisepoirier', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'elisepoirier@test.fr', 0, 1),
(15, 'killianhoarau', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'killianhoarau@test.fr', 0, 1),
(16, 'jeanpierre', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'jeanpierre@test.fr', 0, 1),
(17, 'jeanphilippe', '51d1e6a398acbda7e15b687de747e7dfe95fa13154dcb40aa8ab37f1e2b393a0', 'jeanphilippe@test.fr', 1, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `code_statut`
--
ALTER TABLE `code_statut`
  ADD PRIMARY KEY (`code`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message_prive`
--
ALTER TABLE `message_prive`
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
  ADD PRIMARY KEY (`adresseIP`,`idReponse`,`date`);

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
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `message_prive`
--
ALTER TABLE `message_prive`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

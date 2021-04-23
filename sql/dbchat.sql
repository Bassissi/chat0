-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 29 Juillet 2018 à 19:49
-- Version du serveur :  5.7.20-0ubuntu0.17.04.1
-- Version de PHP :  7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbchat`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `entreprise` varchar(45) NOT NULL,
  `derniereC` datetime DEFAULT CURRENT_TIMESTAMP,
  `test` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `entreprise`, `derniereC`, `test`) VALUES
(1, '*Admin***0782440117', '$2y$10$NJxVzvs9t/2p7yiK3k5gjee2NIHvldQfjtnMA/9t2QnH90Vh0z6W.', 'ou mon chat marseillais', '2018-07-29 19:36:51', '123456');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `url` varchar(45) NOT NULL,
  `race` varchar(45) NOT NULL,
  `couleurs` varchar(45) NOT NULL,
  `poils` varchar(45) NOT NULL,
  `pelage` varchar(45) NOT NULL,
  `castre` varchar(45) NOT NULL,
  `dateAnnonce` datetime DEFAULT NULL,
  `datePT` varchar(45) NOT NULL,
  `rue` varchar(64) NOT NULL,
  `arrondissement` varchar(45) NOT NULL,
  `description` tinytext,
  `phone` varchar(45) NOT NULL,
  `dateNaissance` varchar(45) NOT NULL,
  `dateModifier` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`idchat`, `type`, `name`, `sex`, `url`, `race`, `couleurs`, `poils`, `pelage`, `castre`, `dateAnnonce`, `datePT`, `rue`, `arrondissement`, `description`, `phone`, `dateNaissance`, `dateModifier`) VALUES
(59, 'perdu', 'Oscar', 'male', 'img/000000000208.jpg', 'Bombay', 'noir marron gris blans beige roux Ã©caille ', 'court', 'uni', 'oui', '2018-07-01 14:06:02', '11/06/2018', '25 Rue de l\'Abadie', '13002', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000002', '01/01/1980', NULL),
(60, 'perdu', 'Diana', 'femelle', 'img/0000000004', 'EuropÃ©en', 'marron blans roux ', 'long', 'tachÃ©', 'oui', '2018-07-25 23:00:56', '11/06/2018', '33 Rue Borde', '13008', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000004', '01/01/1980', NULL),
(61, 'perdu', 'Sophie', 'femelle', 'img/0000000003', 'Chat des bois NorvÃ©giens', 'noir marron gris blans beige Ã©caille ', 'court', 'tigrÃ©', 'oui', '2018-07-25 23:01:24', '11/06/2018', '3 Boulevard Battala', '13003', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000003', '01/01/1980', NULL),
(62, 'perdu', 'LÃ©a ', 'femelle', 'img/0000000001', 'NorvÃ©gien', 'blans ', 'long', 'uni', 'oui', '2018-07-25 23:01:52', '11/06/2018', '32 Belle de mai ', '13003', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000001', '01/01/1980', NULL),
(63, 'trouve', 'Chat36', 'male', 'img/0000000009', 'Aucune', 'noir gris blans ', 'long', 'uni', 'non', '2018-07-25 23:02:25', '07/03/2018', '77 Lodi', '13006', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000009', '01/01/1980', NULL),
(64, 'trouve', 'Chat30', 'femelle', 'img/0000000010', 'Aucune', 'noir blans ', 'court', 'uni', 'oui', '2018-07-25 23:02:50', '11/01/2016', '55 Chateau Regis', '13011', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000010', '01/01/1980', NULL),
(65, 'trouve', 'Chat31', 'male', 'img/parDefaut.jpg', 'Aucune', 'marron blans ', 'long', 'uni', 'oui', '2018-07-25 23:03:19', '11/06/2018', 'Impasse de Zamora', '13012', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000012', '01/01/1980', NULL),
(66, 'trouve', 'Chat27', 'femelle', 'img/0000000007', 'Cornish rex', 'noir marron gris beige ', 'court', 'tigrÃ©', 'non', '2018-07-25 23:03:51', '11/06/2018', '33 Rue la Bastide', '13011', 'Il s\'agit d\'une annonce-test qui ne correspond pas Ã  une situation rÃ©elle.', '0000000007', '01/01/1980', NULL),
(79, 'retrouve', 'Yara', 'femelle', 'img/0000000900', 'Aucune', 'noir marron blans ', 'court', 'uni', 'oui', '2018-07-29 19:35:29', '29/07/2018', '25 Boulvard Prado', '13008', '', '0000000900', '01/01/1980', '2018-07-29 19:35:54');

-- --------------------------------------------------------

--
-- Structure de la table `publicite`
--

CREATE TABLE `publicite` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `lien` varchar(150) NOT NULL,
  `url` varchar(45) NOT NULL,
  `modification` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publicite`
--

INSERT INTO `publicite` (`id`, `name`, `lien`, `url`, `modification`) VALUES
(1, 'publicite1', 'https://www.sheba.fr', 'publicite/2018-07-18 20:32:28.mp4', '2018-07-29 00:26:05'),
(2, 'publicite2', 'http://hermes-plage.fr/', 'publicite/2018-07-18 20:35:57', '2018-07-25 15:40:30'),
(3, 'publicite3', 'https://www.whiskas.ca/fr/nos-produits', 'publicite/2018-07-18 13:22:03', '2018-07-22 11:51:14'),
(4, 'publicite4', 'https://www.sheba.fr', 'publicite/2018-07-18 13:22:15', '2018-07-29 00:51:27');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD UNIQUE KEY `idchat_UNIQUE` (`idchat`);

--
-- Index pour la table `publicite`
--
ALTER TABLE `publicite`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT pour la table `publicite`
--
ALTER TABLE `publicite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

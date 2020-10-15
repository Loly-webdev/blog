-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 12 oct. 2020 à 09:31
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(30) NOT NULL,
  `hat` text NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `author`, `hat`, `content`, `createdAt`, `updatedAt`) VALUES
(1, 'Bienvenue sur mon blog !', 'LolyWD', 'Bienvenue sur mon blog !', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2010-03-25 16:28:41', '2020-03-18 11:06:28'),
(2, 'Le PHP à la conquête du monde !', 'Nowhere', 'L\'éléphant l\'a annoncé, il a l\'intention de conquérir le monde !', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"éléPHPant\". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11', '2020-03-18 11:06:28'),
(3, 'test', 'Loly', 'test hat', 'test content', '2020-07-24 21:27:04', '2020-08-27 15:10:18');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `approved` varchar(3) NOT NULL,
  `articleId` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `articleId` (`articleId`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `approved`, `articleId`, `author`, `content`, `createdAt`, `updatedAt`) VALUES
(1, 'oui', 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53', '2020-03-18 11:05:41'),
(2, 'oui', 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16', '2020-03-18 11:05:41'),
(3, 'oui', 1, 'MultiKiller', '+1 !', '2010-03-25 17:12:52', '2020-03-18 11:05:41'),
(4, 'oui', 2, 'John', 'Preum\'s !', '2010-03-27 18:59:49', '2020-03-18 11:05:41'),
(5, 'oui', 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13', '2020-08-31 16:06:14'),
(6, 'non', 3, 'plop', 'test comment', '2020-07-24 21:27:20', '2020-09-04 15:16:49');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(250) CHARACTER SET utf8 NOT NULL,
  `role` varchar(30) CHARACTER SET utf8 NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'Loly', '$argon2id$v=19$m=65536,t=4,p=1$d0cwdVRER0FvS3dEbU94UA$UjL5NYDe2Od6m10VlfoGFT2E70i38THCZc3Ph/w5Zvk', 'eloise.ruiz.rodriguez@gmail.com', 'admin', '2020-10-01 10:44:47', '2020-10-01 08:44:47'),
(2, 'Plop', '$argon2id$v=19$m=65536,t=4,p=1$aTVwdTIvOE5ScDNUZTNlcg$xO19hcH6hYnUn6FUzDXfjvBADA5zmN4dDTmnDOnFW00', 'loly909@hotmail.fr', '', '2020-09-19 10:57:45', '2020-09-19 08:57:45');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

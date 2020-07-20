-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 01 juil. 2020 à 10:07
-- Version du serveur :  5.7.30-0ubuntu0.18.04.1
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `author`, `content`, `createdAt`, `updatedAt`) VALUES
(1, 'Bienvenue sur mon blog !', '', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2010-03-25 16:28:41', '2020-03-18 11:06:28'),
(2, 'Le PHP à la conquête du monde !', '', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"éléPHPant\". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11', '2020-03-18 11:06:28'),
(4, 'test', 'Loly', 'test', '2020-06-03 11:51:04', '2020-06-03 11:51:04');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `articleId`, `author`, `content`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53', '2020-03-18 11:05:41'),
(2, 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16', '2020-03-18 11:05:41'),
(3, 1, 'MultiKiller', '+1 !', '2010-03-25 17:12:52', '2020-03-18 11:05:41'),
(4, 2, 'John', 'Preum\'s !', '2010-03-27 18:59:49', '2020-03-18 11:05:41'),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13', '2020-03-18 11:05:41'),
(6, 4, 'loly', 'test', '2020-06-03 11:51:17', '2020-06-03 11:51:17');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(250) CHARACTER SET utf8 NOT NULL,
  `role` varchar(30) CHARACTER SET utf8 NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `role`, `createdAt`, `updatedAt`) VALUES
(6, 'Loly', '$argon2id$v=19$m=65536,t=4,p=1$b1c3Mkw1QVIvc1Q0ay5lNw$Va9azRXMlL1sQ0zZgEsOEPUCTRuJz2rDx8xrOOrxbTg', 'loly909@hotmail.fr', 'admin', '2020-05-27 12:19:04', '2020-05-27 12:19:04'),
(7, 'Plop', '$argon2id$v=19$m=65536,t=4,p=1$TEpkZFJULlBMcU9TOXplYw$K7PeeQQOwSpIpGO4OyZkU7xhwaoZqlmdcQyL0A4q8ps', 'plop@hotmail.fr', 'user', '2020-06-03 10:51:25', '2020-06-03 10:51:25');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articleId` (`articleId`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

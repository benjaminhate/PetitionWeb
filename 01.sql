-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 20 Mai 2017 à 17:42
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bhate001`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Politique'),
(2, 'Nourriture'),
(3, 'Animaux'),
(4, 'SantÃ©'),
(5, 'Environnement'),
(6, 'SociÃ©tÃ©'),
(7, 'ENSEIRB');

-- --------------------------------------------------------

--
-- Structure de la table `petitions`
--

CREATE TABLE `petitions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `nbSign` int(11) NOT NULL,
  `expSign` int(11) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `dateBegin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateEnd` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `petitions`
--

INSERT INTO `petitions` (`id`, `title`, `categoryId`, `nbSign`, `expSign`, `userId`, `description`, `dateBegin`, `dateEnd`) VALUES
(1, 'PLUS DE COURS Ã  8h', 7, 0, 500, 2, 'Madame, Monsieur,\\r\\nLâ€™heure est grave, cette annÃ©e nous avons comptabilisÃ© plus de 100h de cours Ã  8h pour la filiÃ¨re Telecom, outre le fait que nous mettre des cours en plein milieux de ma nuit me semble pas correct, il est difficile de suivre une fois les dits cours loupÃ©s  le reste des cours. Jâ€™aimerais par cette pÃ©tition mettre en Ã©vidence la haute cruautÃ© des cours Ã  8h, ils nous forcent pour la plupart Ã  nous lever Ã  7h06 soit 6h66 ( vous voyez bien...), quand bien mÃªme nous rÃ©ussirions Ã  sortir des bras de MorphÃ©e, il est souvent trop tard pour quâ€™il nous reste du temps pour manger!\\r\\nVoilÃ  câ€™est plus possible ', '2017-05-20 19:41:34', '2017-06-01 02:00:00'),
(2, 'POUR L\'OUVERTURE D\'UN RESTAURANT POLONAIS', 2, 0, 2, 2, 'ArrivÃ©e en septembre a Bordeaux, j\'ai eu le malheur de contaster qu\'il n\'y avait AUCUN restaurant servant de la cuisine polonaise dans cette merveilleuse ville de Bordeaux.\\r\\nOn va pas se mentir, on veut des PIEROGHI !', '2017-05-20 19:41:34', '2017-05-20 02:00:00'),
(3, 'POUR QUE NOÃ‰MIE COHEN ARRETE DE VENIR EN PYJAMA', 7, 0, 63, 2, 'Noemie Cohen, Ã©lÃ¨ve de T1, oublie couramment de s\'habiller le matin, souvent parce que l\'on commence Ã  8h (cf petition contre les cours Ã  8h).\\r\\nBien que nous comprenions celle-ci, il n\'est plus possible de venir habillÃ©e en pyjama Ã  l\'ENSEIRB.\\r\\n\\r\\nPour le bien de tous, NoÃ©mie Cohen doit arrÃªter!', '2017-05-20 19:41:34', '2017-05-25 02:00:00'),
(4, 'POUR QUE MES COLOCS FASSENT MA VAISSELLE', 6, 0, 10, 2, 'Dur dur de vivre Ã  plusieurs, dur dur de partager une salle de bain et une cuisne.\\r\\nMes colocataires ne font aucun effort et ne font pas MA vaisselle pour me remercier de vivre avec eux.\\r\\nCe serait la moindre des choses!', '2017-05-20 19:41:34', '2017-05-30 02:00:00'),
(5, 'Pour que PrincessePingouin arrÃªte de rÃ¢ler', 1, 0, NULL, 1, 'PrincessePingouin fait des pÃ©titions pour n\'importe quoi ces temps-ci.\\r\\nIl serait temps qu\'elle arrÃªte.\\r\\nVotez mes amis, votez pour qu\'elle arrÃªte de se plaindre de tout dans sa vie !', '2017-05-20 19:41:34', NULL),
(6, 'Pour qu\'on ait une bonne note Ã  notre projet Web', 7, 0, 1, 1, 'Monsieur le professeur,\\r\\nNous avons beaucoup appris avec ce projet, nous avons essayÃ© de respecter au mieux vos consignes et vos suggestions de bonus, nous avons crÃ©Ã© une fonction de recherche, utilisÃ© du javascript et mÃªme gÃ©nÃ©rÃ© des pÃ©titions alÃ©atoires. Nous aimerions beaucoup avoir une bonne note.\\r\\nMerci <3', '2017-05-20 19:41:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `signatures`
--

CREATE TABLE `signatures` (
  `petitionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `dateSign` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numberth` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT 'img/generic.jpg'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `pseudo`, `mail`, `password`, `img`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 'ff656d51513be094a691bf73b1209665c9b80657', 'img/generic.jpg'),
(2, 'Princesse', 'Pingouin', 'PrincessePingouin', 'princessepingouin@gmail.com', 'fb6b43f33c98164534a490048ce8c6185e943aed', 'img/princessepingouin.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `petitions`
--
ALTER TABLE `petitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`petitionId`,`userId`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `petitions`
--
ALTER TABLE `petitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

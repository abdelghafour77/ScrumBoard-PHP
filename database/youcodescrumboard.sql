-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 30 oct. 2022 à 20:45
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `youcodescrumboard`
--
CREATE DATABASE IF NOT EXISTS `youcodescrumboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `youcodescrumboard`;

-- --------------------------------------------------------

--
-- Structure de la table `priorities`
--

DROP TABLE IF EXISTS `priorities`;
CREATE TABLE IF NOT EXISTS `priorities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `priorities`
--

INSERT INTO `priorities` (`id`, `name`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High'),
(4, 'Critical');

-- --------------------------------------------------------

--
-- Structure de la table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'To Do'),
(2, 'In Progress'),
(3, 'Done');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type_id` int NOT NULL,
  `priority_id` int NOT NULL,
  `status_id` int NOT NULL,
  `task_datetime` timestamp NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `priority_id` (`priority_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `type_id`, `priority_id`, `status_id`, `task_datetime`, `description`) VALUES
(1, 'Keep all the updated requirements in one place', 1, 3, 1, '2022-10-07 23:00:00', 'There is hardly anything more frustrating than having to look for current requirements in tens of comments under the actual description or having to decide which commenter is actually authorized to change the requirements. The goal here is to keep all the up-to-date requirements and details in the main/primary description of a task. Even though the information in comments may affect initial criteria, just update this primary description accordingly.'),
(2, 'Provide mockups', 1, 1, 1, '2022-10-26 23:00:00', 'A textual requirements description is essential in most cases, but an image is often worth more than a thousand words. Even a simple mockup can limit misunderstandings by a great factor. There are many apps out there that might be helpful here, like Balsamiq, InVision or Mockingbird, but manipulating screenshots of an existing app also works.'),
(3, 'Provide examples, credentials, etc ...', 2, 3, 2, '2022-10-28 23:00:00', 'If the expectation is to process or generate some file — attach an example of such a file. If the goal is to integrate what is being developed with some service, ensure your devs have access to this service and its documentation. This list could go on and on — the bottom line is — if there is something that our developer might make use of, try to foresee it and provide them with (access to) it.'),
(4, 'Annotate', 2, 1, 1, '2022-10-31 20:22:00', 'The mockup provided can sometimes be confusing for developers. Especially if it contains much more content than the scope of the task described. Drop a couple of arrows, outlines and annotations here and there to emphasize what are the important parts of the mockup from the task requirements perspective.'),
(5, 'Use charts and diagrams', 2, 3, 3, '2022-11-02 20:23:00', 'While it is not always necessary, sometimes it might be beneficial to prepare a flowchart, a block diagram or some other kind of concept visualization that will render it easy for the developer to comprehend the task and its scope.'),
(6, 'Describe steps to reproduce an issue', 1, 3, 2, '2022-10-30 20:23:00', 'including as many details as possible.'),
(7, 'Make a screencast', 1, 3, 3, '2022-11-01 20:24:00', 'It is not always necessary, but many times a short screencast (or at least a screenshot) says more than a thousand words. While working on MacOS you can use QuickTime Player for the purpose but there are plenty of tools available for other operating systems as well.'),
(8, 'Describe edge cases and provide constraints', 2, 3, 2, '2022-10-30 20:25:00', 'Hardly any developer likes constraints, but if there are some, let them be communicated early. Do we need to support some specific browsers? Does this script need to run below a specific amount of time? Is it crucial for this endpoint to respond in no more than n milliseconds? If there are some such concerns, make sure they are included in your descriptions. Also describing any edge cases might be beneficial. Maybe we have some query limit on a given service? If you have such knowledge it is always beneficial for your devs to know about it upfront. '),
(9, 'Use charts and diagrams', 2, 3, 1, '2022-11-02 20:26:00', 'While it is not always necessary, sometimes it might be beneficial to prepare a flowchart, a block diagram or some other kind of concept visualization that will render it easy for the developer to comprehend the task and its scope.');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Bug'),
(2, 'Feature');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

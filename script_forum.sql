-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour lucie_forum
CREATE DATABASE IF NOT EXISTS `lucie_forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lucie_forum`;

-- Listage de la structure de la table lucie_forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'General'),
	(2, 'Reviews'),
	(3, 'Rules'),
	(4, 'Crowdfunding');

-- Listage de la structure de la table lucie_forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` date NOT NULL,
  `topic_id` int NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.post : ~5 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationDate`, `topic_id`, `user_id`) VALUES
	(1, 'It\'s great for me, what do you think  ? Any bug detected ?', '2024-03-27', 1, 1),
	(2, 'I\'m not that into it i have to say...', '2024-03-31', 1, 2),
	(3, 'LOVE IT§§ So great', '2024-04-03', 2, 3),
	(4, 'Does someone understand how this card works', '2024-04-01', 3, 2),
	(5, 'Vindication is the worst game i\'ve played', '2024-04-14', 4, 1);

-- Listage de la structure de la table lucie_forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `creationDate` date NOT NULL,
  `isLocked` tinyint NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `isLocked`, `category_id`, `user_id`) VALUES
	(1, 'App has been updated', '2024-04-06', 0, 1, 1),
	(2, 'My thoughts on Pagan', '2024-02-13', 1, 2, 2),
	(3, 'Card #10 choice ?', '2024-03-26', 0, 3, 3),
	(4, 'Never again !!!', '2024-03-31', 0, 2, 1);

-- Listage de la structure de la table lucie_forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`) VALUES
	(1, 'user 1', 'user1@exemple.com', 'user1pass'),
	(2, 'user 2', 'user2@exemple.com', 'user2pass'),
	(3, 'user 3', 'user3@exemple.com', 'user3pass');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.category : ~3 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(6, 'General'),
	(7, 'Reviews'),
	(8, 'Crowdfounding');

-- Listage de la structure de la table lucie_forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` date NOT NULL,
  `topic_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.post : ~8 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationDate`, `topic_id`, `user_id`) VALUES
	(13, 'Tell us what you think and if you experience any bug.', '2024-04-18', 11, 1),
	(14, 'works fine for me!', '2024-04-18', 11, 8),
	(15, 'I&#039;ve tried this game and here&#039;s why you should too: ', '2024-04-18', 12, 8),
	(16, 'love it as well', '2024-04-18', 12, 9),
	(17, 'I hate it', '2024-04-18', 13, 9),
	(18, 'i thought it was ok', '2024-04-18', 13, 8),
	(19, 'nah it&#039;s not worth it imo', '2024-04-18', 13, 10),
	(20, 'topic test anonyme', '2024-04-18', 14, 13);

-- Listage de la structure de la table lucie_forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `creationDate` date NOT NULL,
  `isLocked` tinyint NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.topic : ~4 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `isLocked`, `category_id`, `user_id`) VALUES
	(11, 'App has been updated', '2024-04-18', 0, 6, 1),
	(12, 'Pagan is the best !!', '2024-04-18', 0, 7, 8),
	(13, 'Vindication is the worst !!', '2024-04-18', 0, 7, 9),
	(14, 'topic test anonyme', '2024-04-18', 0, 7, 13);

-- Listage de la structure de la table lucie_forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '["ROLE_USER"]',
  `registerDate` date NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table lucie_forum.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `nickname`, `email`, `password`, `role`, `registerDate`) VALUES
	(1, 'lulu', 'lucie@exemple.com', '$2y$10$zIs2ZA.BuKpKwEreqC63Wu7xt2tuFDkQ6vrskk6QZhpPJXepxWW2K', '["ROLE_USER", "ROLE_ADMIN"]', '2024-04-17'),
	(8, 'user 1', 'user1@exemple.com', '$2y$10$/FV62WEv1KUY.XJlTX3s2OudpFguwThIcUrD/vcn4cATtS0cRU7t.', '["ROLE_USER"]', '2024-04-18'),
	(9, 'user2', 'user2@example.com', '$2y$10$tNMhzxtQkUt9RvZRGIeRq.nuQMM.CUYG8R/BFsIRBW/YsDlJLRhHa', '["ROLE_USER"]', '2024-04-18');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

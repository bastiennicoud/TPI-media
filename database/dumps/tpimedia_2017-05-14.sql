# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.7.18)
# Base de données: tpimedia
# Temps de génération: 2017-05-14 17:28:59 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_index` (`user_id`),
  KEY `comments_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Affichage de la table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2014_10_12_000000_create_users_table',1),
	(2,'2014_10_12_100000_create_password_resets_table',1),
	(3,'2017_05_11_164028_update_users_table',1),
	(4,'2017_05_11_164437_create_posts_table',1),
	(5,'2017_05_11_164537_create_comments_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Affichage de la table posters
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posters`;

CREATE TABLE `posters` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posters` WRITE;
/*!40000 ALTER TABLE `posters` DISABLE KEYS */;

INSERT INTO `posters` (`id`, `url`, `created_at`, `updated_at`)
VALUES
	(1,'ressources/posters/VANVAN.jpg','2017-05-14 16:59:00','2017-05-14 16:59:00'),
	(2,'ressources/posters/VANVAN.jpg','2017-05-14 17:00:53','2017-05-14 17:00:53'),
	(3,'ressources/posters/$2y$10$.wIs40QnjFWaRPIEcn/o2e691FUwCR9QOE6UEhbryCoHOibfipZGa.jpg','2017-05-14 17:09:03','2017-05-14 17:09:03'),
	(4,'ressources/posters/IF95LGmvQAta5j6PMX129FTA6fSNrOOVUIFWLIqsvy8aQCLMSaXRhzhXUdBQ.jpg','2017-05-14 17:13:18','2017-05-14 17:13:18');

/*!40000 ALTER TABLE `posters` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8_unicode_ci DEFAULT '',
  `slug` varchar(80) COLLATE utf8_unicode_ci DEFAULT '',
  `date` datetime DEFAULT NULL,
  `hat` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `online` int(10) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `poster_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_title_unique` (`title`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_index` (`user_id`),
  KEY `posts_poster_id_index` (`poster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `image`, `role`)
VALUES
	(1,'jeanedouard','jd@gmail.com','$2y$10$Elt3mrsCqVplnCptVSvqnOczlUPTFbCEhJAT0sTijamdUXgbm234u',NULL,'2017-05-11 20:46:39','2017-05-11 20:46:39','/ressources/profilephotos/default.png',3),
	(2,'YvanDuReve','yvan@tutu.ch','$2y$10$mNWIU0AOgLBuk7imkwNJIub5orjw/Wy3uiF2HgkOKoVnHRGfD.Ami','1lkNspj5t3vDOAGA5aMyQB4UhtFcvqR7vtRjYEBRRAUPK7epPXi777k8FAgN','2017-05-11 20:51:08','2017-05-12 15:32:11','/ressources/profilephotos/YvanDuReve.jpg',3),
	(3,'legoman','man@lego.com','$2y$10$T48uv2PHlap0dVCItLj3luAb7lxbPvJwwltGh0rDPMbRRAeXHja.m',NULL,'2017-05-11 20:53:34','2017-05-11 20:53:34','/ressources/profilephotos/lego.jpg',3),
	(4,'SpaceViolonist','space@violon.universe','$2y$10$9dVDsuvLXeZq2Da71aTD7O6TXX1M5Emt5VLUfOgX7j1.XeOs2ff1G',NULL,'2017-05-11 21:00:41','2017-05-11 21:00:41','/ressources/profilephotos/default.png',2),
	(5,'QuentinLandlol','quentin@gmail.com','$2y$10$Axg6qUrcAA3JKV9Hlo1EtudqckyoadN825p8zFRuMRb9oo43/skx6',NULL,'2017-05-11 21:34:53','2017-05-11 21:34:53','/ressources/profilephotos/default.png',3),
	(6,'PizzaHawai','pizza@hawai.sun','$2y$10$dJo525z81g2LKjH5OUBLv.do73l276q1/bln9gKMNEQsERAlqwV3W','t5YcVaCRoqNxZzNrkJGNnmp2gSEBV2cRy0TW01BCp3tQi2shiTCY8rEQYgHE','2017-05-12 11:52:54','2017-05-12 11:52:54','/ressources/profilephotos/default.png',3),
	(7,'AnneOnime','bidon@meida.io','$2y$10$unXFVCIiQkgQUxrS6u59Guhmke5kksSGNYKHnc1UA5FQn6zUS7Laq',NULL,'2017-05-12 13:33:09','2017-05-12 14:12:04','/ressources/profilephotos/default.png',3),
	(8,'VANVAN','van@van.van','$2y$10$lD.TkdtttJxiYXr1QSWObe2GpR2ExcaV7eYof7WDaoUK1UOjmTl2a','Nli1sOlkR9iWDiN1xTMg6IrgJS9DnwVHbSm1sSYTHpK3OvefkuEfNgMCoBDK','2017-05-12 14:43:46','2017-05-14 10:47:21','/ressources/profilephotos/VANVAN.jpg',2),
	(9,'Monsieur X','x@x.com','$2y$10$OZSn8NZ1RjbaoBaknkpFNe9wKoC/dVOn1wOCYEoe4LxNzeoyKMjoe','e69H1IMuZpl7hmnW9QbDudZ2OEG0LxnQmpkynrlzpQPyt0d7WTAWpJofV4jF','2017-05-14 12:49:36','2017-05-14 12:49:36','/ressources/profilephotos/default.png',3),
	(10,'John Doe','johndoe@tutu.com','$2y$10$fVoy9ffpxoLKbdZ35xLPI.hqlrXZ8JrAI01G13T2x/mNipIDV3ee2','qVRssMi4dyQXZLVSg7hNs8hRUSugNiIA59maBYMqnoofjsVZ9pxYMdK77pWs','2017-05-14 12:50:48','2017-05-14 12:50:48','/ressources/profilephotos/default.png',2),
	(11,'Tartempion','tartempion@tutu.ch','$2y$10$5K6t8uqfERF9C7fc30jELuAzLe6igAi.r7sB3/ZinFaa8rNGFN01W',NULL,'2017-05-14 13:02:36','2017-05-14 13:02:36','/ressources/profilephotos/default.png',3),
	(12,'M.Dupont','dupont@dupont.ch','$2y$10$SAbD0xrgH1.a/l2x9EYPHuFKP8E3P5NhhUdsiG4OlQ/M.Vz8OjWyi',NULL,'2017-05-14 13:05:55','2017-05-14 13:05:55','/ressources/profilephotos/default.png',3);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

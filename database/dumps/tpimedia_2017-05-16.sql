# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.7.18)
# Base de données: tpimedia
# Temps de génération: 2017-05-16 12:05:06 +0000
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
  `image_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_index` (`user_id`),
  KEY `comments_post_id_index` (`post_id`),
  KEY `comments_image_id_index` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `content`, `created_at`, `updated_at`, `user_id`, `post_id`, `image_id`)
VALUES
	(1,'Ca risque d\'être une soirée rythmée !','2017-05-15 09:14:49','2017-05-15 09:14:49',8,1,NULL),
	(2,'Je serais la !','2017-05-15 10:08:43','2017-05-15 10:08:43',8,1,NULL),
	(3,'Ces commentaires fonctionnent a merveille !','2017-05-15 10:10:02','2017-05-15 10:10:02',8,1,NULL),
	(4,'Les commentaires se rechargent correctement !','2017-05-15 11:08:19','2017-05-15 11:08:19',8,1,NULL),
	(5,'Les commentaires se rechargent correctement !','2017-05-15 11:09:39','2017-05-15 11:09:39',8,1,NULL),
	(6,'Les commentaires se rechargent correctement !','2017-05-15 11:10:25','2017-05-15 11:10:25',8,1,NULL),
	(7,'Un dernier petit test','2017-05-15 11:11:09','2017-05-15 11:11:09',8,1,NULL),
	(8,'Le rechargement fonctionne-il ?','2017-05-15 11:13:21','2017-05-15 11:13:21',8,1,NULL),
	(9,'Je suis la !','2017-05-15 11:21:45','2017-05-15 11:21:45',12,1,NULL),
	(10,'Je suis la !','2017-05-15 11:23:58','2017-05-15 11:23:58',12,1,NULL),
	(11,'Je suis la !','2017-05-15 11:34:37','2017-05-15 11:34:37',12,1,NULL),
	(12,'Je suis la !','2017-05-15 11:35:30','2017-05-15 11:35:30',12,1,NULL),
	(13,'Aie, il y a un bug lors de la soumission de commentaire !','2017-05-15 11:38:23','2017-05-15 11:38:23',12,1,NULL),
	(14,'Aie, il y a un bug lors de la soumission de commentaire !','2017-05-15 11:40:41','2017-05-15 11:40:41',12,1,NULL),
	(15,'Salut !','2017-05-15 11:41:13','2017-05-15 11:41:13',12,1,NULL),
	(16,'Salut !','2017-05-15 11:45:45','2017-05-15 11:45:45',12,1,NULL),
	(17,'Salut !','2017-05-15 11:45:59','2017-05-15 11:45:59',12,1,NULL),
	(18,'Salut !','2017-05-15 11:46:39','2017-05-15 11:46:39',12,1,NULL),
	(19,'Quel super style de danse !','2017-05-15 11:47:47','2017-05-15 11:47:47',12,12,NULL),
	(20,'Tutu','2017-05-15 12:31:57','2017-05-15 12:31:57',10,12,NULL),
	(21,'Yeahh je danse comme une bombe !','2017-05-15 12:33:46','2017-05-15 12:33:46',13,12,1),
	(22,'Un test','2017-05-16 11:52:41','2017-05-16 11:52:41',8,15,NULL),
	(23,'2 test','2017-05-16 11:54:46','2017-05-16 11:54:46',8,15,NULL),
	(24,'hjvjhvb','2017-05-16 11:56:00','2017-05-16 11:56:00',8,15,NULL),
	(25,'sndksnd','2017-05-16 11:58:55','2017-05-16 11:58:55',8,15,NULL),
	(26,'lkdnsfld','2017-05-16 12:01:08','2017-05-16 12:01:08',8,15,NULL),
	(27,'jknfskf','2017-05-16 12:02:13','2017-05-16 12:02:13',8,15,NULL),
	(28,'sdfdsf','2017-05-16 12:03:06','2017-05-16 12:03:06',8,15,NULL);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;

INSERT INTO `images` (`id`, `url`, `created_at`, `updated_at`)
VALUES
	(1,'/ressources/images/tesp.jpg','2017-05-14 17:13:18','2017-05-15 17:13:18');

/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,'/ressources/posters/affiche.jpg','2017-05-14 16:59:00','2017-05-14 16:59:00'),
	(2,'/ressources/posters/djembe.jpg','2017-05-14 17:00:53','2017-05-14 17:00:53'),
	(3,'/ressources/posters/polka.jpg','2017-05-14 17:09:03','2017-05-14 17:09:03'),
	(4,'/ressources/posters/trio.jpg','2017-05-14 17:13:18','2017-05-14 17:13:18');

/*!40000 ALTER TABLE `posters` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) COLLATE utf8_unicode_ci DEFAULT '',
  `slug` varchar(80) COLLATE utf8_unicode_ci DEFAULT '',
  `date` datetime DEFAULT NULL,
  `hat` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `online` int(10) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `poster_id` int(10) unsigned NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_title_unique` (`title`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_index` (`user_id`),
  KEY `posts_poster_id_index` (`poster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `title`, `slug`, `date`, `hat`, `content`, `online`, `created_at`, `updated_at`, `user_id`, `poster_id`, `video`)
VALUES
	(1,'Soirée Djembé','soiree-djembe','2017-05-24 00:00:00','Rejoignez-nous le mercredi 24 mai pour une soirée exclusive de Djembé. En compagnie d\'un invité special.','Un Djembé est un instrument de percussion africain composé d\'un fût de bois en forme de calice sur lequel est montée une peau de chèvre ou d\'antilope. Il offre un son rond est puissant.\nVenez découvrir tous ces états lors de notre soirée exclusive. Nous serons accompagnés de plusieurs musiciens de talents, qui nous interpréterons plusieurs titres revisités au Djembé.',1,'2017-05-14 18:55:26','2017-05-14 18:55:26',8,2,NULL),
	(2,'FROM BRODWAY TO YVERDON','from-brodway-to-yverdon','2016-01-24 00:00:00','Venez découvrir notre nouveau concert/comédie musicale a la Grande Salle du Conservatoire d\'Yverdon.','Les concerts des cygnes présentent un nouveau concert sur le theme de brodway, venez nombreux nous rejoindre pour cette soirée.',1,'2017-05-14 19:02:19','2017-05-15 12:34:52',8,1,NULL),
	(12,'Soirée Polka','soiree-polka','2017-06-10 00:00:00','Venez découvrir ce style de danse rythmé, et entrainant lors de notre soirée Polka, a la Marive.','Danse de couple effectuant un mouvement circulaire, la composante principale en est le pas de polka. De nombreux manuels, articles et publications des maîtres de danse ont circulé, et la polka a rapidement gagné toutes les couches de la population, des milieux bourgeois aux plus populaires.',1,'2017-05-15 10:00:00','2017-05-15 10:00:00',8,3,NULL),
	(13,'Helge Lien Trio','helge-lien-trio','2017-05-31 00:00:00','Helge Lien Trio sera en concert au Conservatoire de Musique du Nord Vaudois à Yverdon-les-Bains le 3 février dans le cadre du Nova Jazz Festival 2017.','Un piano trio incontournable de la scène jazz scandinave dont les ressources semblent sans limite. Le groupe du pianiste Helge Lien développe un style fait de contrastes où une impressionnante virtuosité est contrebalancée pas une accessibilité inhérente, où expressionnisme flamboyant côtoient lyrisme introspectif.',1,'2017-05-15 11:55:33','2017-05-15 12:30:33',10,4,NULL),
	(15,'test','test','2017-05-18 00:00:00','test','test',1,'2017-05-16 10:03:57','2017-05-16 10:05:17',8,2,'https://www.youtube.com/embed/3lXZRGlKl_8');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


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
	(8,'VANVAN','van@van.van','$2y$10$lD.TkdtttJxiYXr1QSWObe2GpR2ExcaV7eYof7WDaoUK1UOjmTl2a','A7BQSLsq0MnGEbQGfmuZ25TDKQKzsIxRvQ06lD9VuCd2t4gzzIjM827XYtQj','2017-05-12 14:43:46','2017-05-14 10:47:21','/ressources/profilephotos/VANVAN.jpg',2),
	(9,'Monsieur X','x@x.com','$2y$10$OZSn8NZ1RjbaoBaknkpFNe9wKoC/dVOn1wOCYEoe4LxNzeoyKMjoe','e69H1IMuZpl7hmnW9QbDudZ2OEG0LxnQmpkynrlzpQPyt0d7WTAWpJofV4jF','2017-05-14 12:49:36','2017-05-14 12:49:36','/ressources/profilephotos/default.png',3),
	(10,'John Doe','johndoe@tutu.com','$2y$10$fVoy9ffpxoLKbdZ35xLPI.hqlrXZ8JrAI01G13T2x/mNipIDV3ee2','WWcfkGd5WQnKDN7DDFdlYcdrNLKXxrgyTUnFn9zNs8zXQCyDj2P0sgeHmUd1','2017-05-14 12:50:48','2017-05-14 12:50:48','/ressources/profilephotos/default.png',2),
	(11,'Tartempion','tartempion@tutu.ch','$2y$10$5K6t8uqfERF9C7fc30jELuAzLe6igAi.r7sB3/ZinFaa8rNGFN01W',NULL,'2017-05-14 13:02:36','2017-05-14 13:02:36','/ressources/profilephotos/default.png',3),
	(12,'M.Dupont','dupont@dupont.com','$2y$10$SAbD0xrgH1.a/l2x9EYPHuFKP8E3P5NhhUdsiG4OlQ/M.Vz8OjWyi','lonJrvTtvkObEVUmE8m0RyLHDgfXzk7kUZH84XLGm2d5U93ow4FdywUEpB3s','2017-05-14 13:05:55','2017-05-15 11:47:21','/ressources/profilephotos/default.png',3),
	(13,'Quentin Landolt','quentin@tutu.ch','$2y$10$/BXt/4jNrvzRKtKNWrUhNupYMV5PMEPz361jMPMb1OTVRM4pCklcu','zUCPl6PLElMpt1LKamjoSLbocmdcsTGPrvJCd5kWwWoZ757R3VjqEuGCu8o4','2017-05-15 12:33:03','2017-05-15 12:33:03','/ressources/profilephotos/default.png',3);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

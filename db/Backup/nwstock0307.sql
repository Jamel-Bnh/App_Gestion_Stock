-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: app_stock
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nw_ctg`
--

DROP TABLE IF EXISTS `nw_ctg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_ctg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(50) NOT NULL,
  `admin_ctg` varchar(15) DEFAULT NULL,
  `descp` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_ctg`
--

LOCK TABLES `nw_ctg` WRITE;
/*!40000 ALTER TABLE `nw_ctg` DISABLE KEYS */;
INSERT INTO `nw_ctg` VALUES (34,'DMLG',NULL,'Division maintenance logiciel'),(35,'DTEL',NULL,'division telecom'),(36,'DTLC',NULL,'division teleconduite');
/*!40000 ALTER TABLE `nw_ctg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_location`
--

DROP TABLE IF EXISTS `nw_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_mag` varchar(50) NOT NULL,
  `type_emp` varchar(25) NOT NULL,
  `emp` varchar(50) NOT NULL,
  `desp` text NOT NULL,
  `sts` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_location`
--

LOCK TABLES `nw_location` WRITE;
/*!40000 ALTER TABLE `nw_location` DISABLE KEYS */;
INSERT INTO `nw_location` VALUES (7,'EXT1','Armoire','A1E1','armoire a1 magasin externe','OK'),(8,'EXT1','Armoire','A1E2','armoire a1 magasin externe','OK'),(9,'EXT1','Armoire','A1E3','armoire a1 magasin externe','OK'),(10,'EXT1','Armoire','A1E4','armoire a1 magasin externe','OK'),(11,'EXT1','Armoire','A1E5','armoire a1 magasin externe','OK'),(12,'EXT1','Armoire','A1E6','armoire a1 magasin externe','OK'),(13,'EXT2','Armoire','AX1E1','armoire ax1','OK'),(14,'EXT2','Armoire','AX1E2','armoire ax1','OK'),(15,'EXT2','Armoire','AX1E3','armoire ax1','OK'),(16,'EXT2','Armoire','AX1E4','armoire ax1','OK'),(17,'EXT2','Armoire','AX1E5','armoire ax1','OK');
/*!40000 ALTER TABLE `nw_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_magasin`
--

DROP TABLE IF EXISTS `nw_magasin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_magasin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magasin` varchar(50) NOT NULL,
  `location` varchar(40) NOT NULL,
  `descp` text NOT NULL,
  `sts` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_magasin`
--

LOCK TABLES `nw_magasin` WRITE;
/*!40000 ALTER TABLE `nw_magasin` DISABLE KEYS */;
INSERT INTO `nw_magasin` VALUES (4,'EXT1','DPSGZ','magasin externe direction pilotage systeme gza','OK'),(5,'salle serveur','DMPS','département maintenance systeme de pilotage','OK'),(6,'EXT2','DPSG','magasin externe 2 direction pilotage systeme gaz','OK');
/*!40000 ALTER TABLE `nw_magasin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_stock`
--

DROP TABLE IF EXISTS `users_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_stock` (
  `matricule` varchar(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `role` varchar(5) NOT NULL,
  `division` varchar(11) NOT NULL,
  `mdp` varchar(70) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(30) NOT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_stock`
--

LOCK TABLES `users_stock` WRITE;
/*!40000 ALTER TABLE `users_stock` DISABLE KEYS */;
INSERT INTO `users_stock` VALUES ('71136','Bejaoui Hamed','UXXX','DTEL','$2y$10$nTA.AtiQMAdlp0eObOd1e.XzWG3eB9sk/tobFMWj5zEoD/6pY4vHi','',''),('71145','Ben Abdallah Karim','UMXX','DTLC','$2y$10$zkPc/n/dERjbaiSzytv3ludy8JVEqiv.qoZnzQHe5bfNQevqlbCa.','',''),('71148','Laghmani Bacem','UMAX','DTLC','$2y$10$p8SlZBO1WVzVhnDrWEPqnOgKjJvyY4sBtCqcfEfrQXHF74//zcYgu','',''),('71149','Chaieb Farid ','UMAS','DMLG','$2y$10$bmKTjQF8/b2NrtGzUGWZWO9pG4VvrY4u6VviKJWKmvRsEzdqH2Oa2','','');
/*!40000 ALTER TABLE `users_stock` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-03 19:54:34

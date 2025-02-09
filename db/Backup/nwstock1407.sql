-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: app_stock
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `bon_in`
--

DROP TABLE IF EXISTS `bon_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bon_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bon` varchar(50) NOT NULL,
  `user_in` varchar(15) NOT NULL,
  `nb_prd` int(11) NOT NULL,
  `all_prd` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`all_prd`)),
  `all_qnt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`all_qnt`)),
  `all_nmsr` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`all_nmsr`)),
  `date_bon` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_bon` (`id_bon`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bon_in`
--

LOCK TABLES `bon_in` WRITE;
/*!40000 ALTER TABLE `bon_in` DISABLE KEYS */;
INSERT INTO `bon_in` VALUES (8,'IN6844673200','71149',2,'{\"1\":\"PR8052683608\",\"2\":\"PR4481195330\"}','{\"1\":\"1\",\"2\":\"1\"}','{\"1\":\"zfz4ze4f5z\",\"2\":\"fzfz654f65zf\"}','2022-07-14');
/*!40000 ALTER TABLE `bon_in` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_ctg`
--

LOCK TABLES `nw_ctg` WRITE;
/*!40000 ALTER TABLE `nw_ctg` DISABLE KEYS */;
INSERT INTO `nw_ctg` VALUES (40,'DMLG',NULL,'maintenance logiciel'),(41,'DTEL',NULL,'telecom'),(42,'DTLC',NULL,'teleconduite');
/*!40000 ALTER TABLE `nw_ctg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_division`
--

DROP TABLE IF EXISTS `nw_division`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_division` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `division` varchar(50) NOT NULL,
  `admindvs` varchar(15) DEFAULT NULL,
  `descdvs` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_division`
--

LOCK TABLES `nw_division` WRITE;
/*!40000 ALTER TABLE `nw_division` DISABLE KEYS */;
INSERT INTO `nw_division` VALUES (17,'DMLG','71149','division maintence logiciel'),(18,'DTLC','62418','division teleconduite');
/*!40000 ALTER TABLE `nw_division` ENABLE KEYS */;
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
-- Table structure for table `nw_nmsr`
--

DROP TABLE IF EXISTS `nw_nmsr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_nmsr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` varchar(50) NOT NULL,
  `nmsr` varchar(60) NOT NULL,
  `dispo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pr` (`id_pr`),
  CONSTRAINT `nw_nmsr_ibfk_1` FOREIGN KEY (`id_pr`) REFERENCES `nw_produits` (`id_pr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_nmsr`
--

LOCK TABLES `nw_nmsr` WRITE;
/*!40000 ALTER TABLE `nw_nmsr` DISABLE KEYS */;
INSERT INTO `nw_nmsr` VALUES (22,'PR8052683608','REER542ERE66',1),(23,'PR4481195330','RGE2156654ERGE',1),(26,'PR8052683608','zfz4ze4f5z',1),(27,'PR4481195330','fzfz654f65zf',1);
/*!40000 ALTER TABLE `nw_nmsr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_produits`
--

DROP TABLE IF EXISTS `nw_produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` varchar(50) NOT NULL,
  `prd` varchar(60) NOT NULL,
  `ctg` varchar(50) NOT NULL,
  `fbrq` varchar(50) NOT NULL,
  `frnss` varchar(50) NOT NULL,
  `mag` varchar(30) NOT NULL,
  `emp` varchar(35) NOT NULL,
  `prix_pr` float NOT NULL,
  `user_pr` varchar(15) NOT NULL,
  `date_pr` date NOT NULL,
  `desc_pr` text NOT NULL,
  `img_pr` text NOT NULL,
  `doc_pr` text NOT NULL,
  `chnsr` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_pr` (`id_pr`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_produits`
--

LOCK TABLES `nw_produits` WRITE;
/*!40000 ALTER TABLE `nw_produits` DISABLE KEYS */;
INSERT INTO `nw_produits` VALUES (23,'PR8052683608','Disque Dur SSD','DMLG','ADATA','mytek','EXT1','A1E1',109,'71149','2022-07-14','disque dur ','assets/img/263418test imgs (3).jpg','assets/doc/592535pdf-exemple.pdf','oui'),(24,'PR4481195330','Ecran 22 pouces','DMLG','Acer','tunisianet','EXT1','A1E2',560,'71149','2022-07-14','ecran acer 22 pouce','assets/img/5803ecran.jpg','assets/doc/392974pdf-exemple.pdf','oui'),(25,'PR7834509563','cable réseau bleu 3m','DTEL','tunisie cable','mytek','EXT2','AX1E1',3,'71149','2022-07-14','cable réseau 3 m bleu','assets/img/923440cable-reseau-3m.jpg','assets/doc/914117pdf-exemple.pdf','non'),(26,'PR4201587742','RTU560','DTLC','ABB','ABB','EXT1','A1E2',15000,'71149','2022-07-14','rtu 560','assets/img/65007test imgs (2).jpg','assets/doc/142519pdf-exemple.pdf','oui'),(27,'PR5410405411','rtu870','DTLC','brodersson','abb','EXT1','A1E3',12000,'71149','2022-07-14','rtu 870','assets/img/33404064471-7040163.jpg','assets/doc/771564pdf-exemple.pdf','oui'),(28,'PR0022939289','rtu32','DTLC','brodersson','ABB','EXT1','A1E4',14000,'71149','2022-07-14','rtu 32','assets/img/962070rtu32_large.jpg','assets/doc/321012pdf-exemple.pdf','oui'),(29,'PR2533457500','switch 4 port','DTEL','dlink','mytek','EXT2','AX1E2',240,'71149','2022-07-14','switch 4 port ','assets/img/40405545461_beqic3lllwhl2lqd.jpg','assets/doc/109153pdf-exemple.pdf','oui');
/*!40000 ALTER TABLE `nw_produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_quantite`
--

DROP TABLE IF EXISTS `nw_quantite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_quantite` (
  `id_pr` varchar(50) NOT NULL,
  `qnt` int(11) NOT NULL,
  PRIMARY KEY (`id_pr`),
  CONSTRAINT `nw_quantite_ibfk_1` FOREIGN KEY (`id_pr`) REFERENCES `nw_produits` (`id_pr`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_quantite`
--

LOCK TABLES `nw_quantite` WRITE;
/*!40000 ALTER TABLE `nw_quantite` DISABLE KEYS */;
INSERT INTO `nw_quantite` VALUES ('PR0022939289',0),('PR2533457500',0),('PR4201587742',0),('PR4481195330',2),('PR5410405411',0),('PR7834509563',15),('PR8052683608',4);
/*!40000 ALTER TABLE `nw_quantite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_role`
--

DROP TABLE IF EXISTS `nw_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(35) NOT NULL,
  `desc_r` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_role`
--

LOCK TABLES `nw_role` WRITE;
/*!40000 ALTER TABLE `nw_role` DISABLE KEYS */;
INSERT INTO `nw_role` VALUES (1,'UXXX','user'),(2,'UMXX','user magasiner');
/*!40000 ALTER TABLE `nw_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_in`
--

DROP TABLE IF EXISTS `tmp_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` varchar(50) NOT NULL,
  `prd` varchar(70) NOT NULL,
  `qnt_pr` int(11) NOT NULL,
  `nmsr_pr` varchar(50) NOT NULL,
  `user_in` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp_in`
--

LOCK TABLES `tmp_in` WRITE;
/*!40000 ALTER TABLE `tmp_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_in` ENABLE KEYS */;
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
  `user_email` varchar(50) DEFAULT NULL,
  `user_phone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_stock`
--

LOCK TABLES `users_stock` WRITE;
/*!40000 ALTER TABLE `users_stock` DISABLE KEYS */;
INSERT INTO `users_stock` VALUES ('62418','Laadhari Hatem','UMXX','DTLC','$2y$10$Lzbnc/P83aE2kfwbhgRWY.wXL93lMbB52zYFcuqdBpFKyRtUCStT6','N/A','N/A'),('71136','Bejaoui Hamed','UXXX','DTEL','$2y$10$nTA.AtiQMAdlp0eObOd1e.XzWG3eB9sk/tobFMWj5zEoD/6pY4vHi','',''),('71145','Ben Abdallah Karim','UMXX','DTLC','$2y$10$zkPc/n/dERjbaiSzytv3ludy8JVEqiv.qoZnzQHe5bfNQevqlbCa.','',''),('71148','Laghmani Bacem','UMAX','DTLC','$2y$10$p8SlZBO1WVzVhnDrWEPqnOgKjJvyY4sBtCqcfEfrQXHF74//zcYgu','',''),('71149','Chaieb Farid ','UMAS','DMLG','$2y$10$bmKTjQF8/b2NrtGzUGWZWO9pG4VvrY4u6VviKJWKmvRsEzdqH2Oa2','','');
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

-- Dump completed on 2022-07-14 14:09:08

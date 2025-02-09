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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bon_in`
--

LOCK TABLES `bon_in` WRITE;
/*!40000 ALTER TABLE `bon_in` DISABLE KEYS */;
INSERT INTO `bon_in` VALUES (11,'IN8793090682','71149',14,'{\"1\":\"PR8052683608\",\"2\":\"PR8052683608\",\"3\":\"PR8052683608\",\"4\":\"PR4481195330\",\"5\":\"PR4481195330\",\"6\":\"PR7834509563\",\"7\":\"PR4201587742\",\"8\":\"PR4201587742\",\"9\":\"PR5410405411\",\"10\":\"PR5410405411\",\"11\":\"PR2533457500\",\"12\":\"PR2533457500\",\"13\":\"PR1773251104\",\"14\":\"PR0022939289\"}','{\"1\":\"1\",\"2\":\"1\",\"3\":\"1\",\"4\":\"1\",\"5\":\"1\",\"6\":\"18\",\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\",\"11\":\"1\",\"12\":\"1\",\"13\":\"5\",\"14\":\"1\"}','{\"1\":\"DSQ0001\",\"2\":\"DSQ0002\",\"3\":\"DSQ003\",\"4\":\"ECR0001\",\"5\":\"ECR0002\",\"6\":\"N/A\",\"7\":\"RT5600000\",\"8\":\"RT5611111\",\"9\":\"RT7878888\",\"10\":\"RT88895\",\"11\":\"SW0000001\",\"12\":\"SW000002\",\"13\":\"N/A\",\"14\":\"RT322222222\"}','2022-07-16'),(12,'IN6939296882','71149',1,'{\"1\":\"PR0022939289\"}','{\"1\":\"1\"}','{\"1\":\"RT322222222\"}','2022-07-17');
/*!40000 ALTER TABLE `bon_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bon_out`
--

DROP TABLE IF EXISTS `bon_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bon_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_out` varchar(60) NOT NULL,
  `user_out` varchar(15) NOT NULL,
  `prd_out` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`prd_out`)),
  `qnt_out` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`qnt_out`)),
  `nmsr_out` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`nmsr_out`)),
  `nb_out` int(11) NOT NULL,
  `ctg_out` varchar(20) NOT NULL,
  `date_out` date NOT NULL,
  `sts_out` varchar(25) NOT NULL,
  `desc_out` text DEFAULT NULL,
  `actby` varchar(15) NOT NULL,
  `act_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_out` (`id_out`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bon_out`
--

LOCK TABLES `bon_out` WRITE;
/*!40000 ALTER TABLE `bon_out` DISABLE KEYS */;
INSERT INTO `bon_out` VALUES (11,'DE2479813543','71149','{\"1\":\"PR8052683608\",\"2\":\"PR4481195330\"}','{\"1\":\"1\",\"2\":\"1\"}','{\"1\":\"DSQ0002\",\"2\":\"ECR0001\"}',2,'DMLG','2022-07-17','accepted','','62418','2022-07-17'),(12,'DE7059105882','71148','{\"1\":\"PR8052683608\",\"2\":\"PR4481195330\"}','{\"1\":\"1\",\"2\":\"1\"}','{\"1\":\"DSQ003\",\"2\":\"ECR0002\"}',2,'DMLG','2022-07-17','refused','','71145','0000-00-00'),(13,'DE3461936273','71148','{\"1\":\"PR7834509563\",\"2\":\"PR2533457500\"}','{\"1\":\"4\",\"2\":\"1\"}','{\"1\":\"N/A\",\"2\":\"SW0000001\"}',2,'DTEL','2022-07-17','refused','','71145','2022-07-17'),(14,'DE7752655673','71145','{\"1\":\"PR4201587742\"}','{\"1\":\"1\"}','{\"1\":\"RT5611111\"}',1,'DTLC','2022-07-17','accepted','','71136','2022-07-17');
/*!40000 ALTER TABLE `bon_out` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_nmsr`
--

LOCK TABLES `nw_nmsr` WRITE;
/*!40000 ALTER TABLE `nw_nmsr` DISABLE KEYS */;
INSERT INTO `nw_nmsr` VALUES (35,'PR8052683608','DSQ0001',0),(36,'PR8052683608','DSQ0002',0),(37,'PR8052683608','DSQ003',1),(38,'PR4481195330','ECR0001',0),(39,'PR4481195330','ECR0002',1),(40,'PR4201587742','RT5600000',0),(41,'PR4201587742','RT5611111',0),(42,'PR5410405411','RT7878888',0),(43,'PR5410405411','RT88895',1),(44,'PR2533457500','SW0000001',1),(45,'PR2533457500','SW000002',1),(46,'PR0022939289','RT322222222',1);
/*!40000 ALTER TABLE `nw_nmsr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nw_panier`
--

DROP TABLE IF EXISTS `nw_panier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nw_panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_in` varchar(15) NOT NULL,
  `id_dem` varchar(50) NOT NULL,
  `qnt_dem` int(11) NOT NULL,
  `nmsr_dem` varchar(60) NOT NULL,
  `ctg` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_panier`
--

LOCK TABLES `nw_panier` WRITE;
/*!40000 ALTER TABLE `nw_panier` DISABLE KEYS */;
/*!40000 ALTER TABLE `nw_panier` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nw_produits`
--

LOCK TABLES `nw_produits` WRITE;
/*!40000 ALTER TABLE `nw_produits` DISABLE KEYS */;
INSERT INTO `nw_produits` VALUES (23,'PR8052683608','Disque Dur SSD','DMLG','ADATA','mytek','EXT1','A1E1',109,'71149','2022-07-14','disque dur ','assets/img/263418test imgs (3).jpg','assets/doc/592535pdf-exemple.pdf','oui'),(24,'PR4481195330','Ecran 22 pouces','DMLG','Acer','tunisianet','EXT1','A1E2',560,'71149','2022-07-14','ecran acer 22 pouce','assets/img/5803ecran.jpg','assets/doc/392974pdf-exemple.pdf','oui'),(25,'PR7834509563','cable réseau bleu 3m','DTEL','tunisie cable','mytek','EXT2','AX1E1',3,'71149','2022-07-14','cable réseau 3 m bleu','assets/img/923440cable-reseau-3m.jpg','assets/doc/914117pdf-exemple.pdf','non'),(26,'PR4201587742','RTU560','DTLC','ABB','ABB','EXT1','A1E2',15000,'71149','2022-07-14','rtu 560','assets/img/65007test imgs (2).jpg','assets/doc/142519pdf-exemple.pdf','oui'),(27,'PR5410405411','rtu870','DTLC','brodersson','abb','EXT1','A1E3',12000,'71149','2022-07-14','rtu 870','assets/img/33404064471-7040163.jpg','assets/doc/771564pdf-exemple.pdf','oui'),(28,'PR0022939289','rtu32','DTLC','brodersson','ABB','EXT1','A1E4',14000,'71149','2022-07-14','rtu 32','assets/img/962070rtu32_large.jpg','assets/doc/321012pdf-exemple.pdf','oui'),(29,'PR2533457500','switch 4 port','DTEL','dlink','mytek','EXT2','AX1E2',240,'71149','2022-07-14','switch 4 port ','assets/img/40405545461_beqic3lllwhl2lqd.jpg','assets/doc/109153pdf-exemple.pdf','oui'),(31,'PR1773251104','souris hp ','DMLG','HP','mytek','EXT1','A1E3',15,'71149','2022-07-16','souris ','assets/img/109883souris-optique-hp-usb-simple.jpg','assets/doc/741084pdf-exemple.pdf','non');
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
INSERT INTO `nw_quantite` VALUES ('PR0022939289',1),('PR1773251104',5),('PR2533457500',2),('PR4201587742',0),('PR4481195330',1),('PR5410405411',1),('PR7834509563',10),('PR8052683608',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
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

-- Dump completed on 2022-07-17 18:01:14

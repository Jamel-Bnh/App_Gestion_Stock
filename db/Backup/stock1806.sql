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
-- Table structure for table `fr_ctg`
--

DROP TABLE IF EXISTS `fr_ctg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_ctg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ctg` varchar(15) DEFAULT NULL,
  `name_ctg` varchar(30) NOT NULL,
  `desc_ctg` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ctg` (`id_ctg`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_ctg`
--

LOCK TABLES `fr_ctg` WRITE;
/*!40000 ALTER TABLE `fr_ctg` DISABLE KEYS */;
INSERT INTO `fr_ctg` VALUES (7,'','Informatique','Tout les article informatiques'),(8,'Electrique','Electrique','teleconduite'),(9,'Réseau','Réseau','Telecom');
/*!40000 ALTER TABLE `fr_ctg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_magasin`
--

DROP TABLE IF EXISTS `fr_magasin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_magasin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nwmag` varchar(30) NOT NULL,
  `lcmag` varchar(30) NOT NULL,
  `descmag` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_magasin`
--

LOCK TABLES `fr_magasin` WRITE;
/*!40000 ALTER TABLE `fr_magasin` DISABLE KEYS */;
INSERT INTO `fr_magasin` VALUES (7,'EXT1','DPSG','magasin externe ');
/*!40000 ALTER TABLE `fr_magasin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_nmsr`
--

DROP TABLE IF EXISTS `fr_nmsr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_nmsr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pr` varchar(25) NOT NULL,
  `nmsr` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_nmsr`
--

LOCK TABLES `fr_nmsr` WRITE;
/*!40000 ALTER TABLE `fr_nmsr` DISABLE KEYS */;
INSERT INTO `fr_nmsr` VALUES (87,'ACT3','x'),(92,'ACT1','DSQ0001'),(93,'ACT2','SQQ0001'),(94,'ACT4','TRRR1111'),(95,'ACT5','RT320001');
/*!40000 ALTER TABLE `fr_nmsr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_panier`
--

DROP TABLE IF EXISTS `fr_panier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pa_user` varchar(15) NOT NULL,
  `pa_id_pr` varchar(15) NOT NULL,
  `artc_dem` varchar(50) NOT NULL,
  `pa_qnt` int(11) NOT NULL,
  `qnt_dispo` int(11) NOT NULL,
  `pa_stckg` varchar(50) NOT NULL,
  `pa_nmsr` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_panier`
--

LOCK TABLES `fr_panier` WRITE;
/*!40000 ALTER TABLE `fr_panier` DISABLE KEYS */;
/*!40000 ALTER TABLE `fr_panier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_produits`
--

DROP TABLE IF EXISTS `fr_produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_idx` int(11) NOT NULL,
  `id_pr` varchar(20) NOT NULL,
  `name_pr` varchar(45) NOT NULL,
  `ctg_pr` varchar(35) NOT NULL,
  `ref_pr` varchar(25) NOT NULL,
  `fbrq_pr` varchar(50) NOT NULL,
  `prix_pr` int(11) NOT NULL,
  `min_pr` int(11) NOT NULL,
  `stck_pr` varchar(80) NOT NULL,
  `frns_pr` varchar(45) NOT NULL,
  `img_pr` text NOT NULL,
  `doc_pr` text NOT NULL,
  `desc_pr` text NOT NULL,
  `long_pr` float NOT NULL,
  `lrg_pr` float NOT NULL,
  `ht_pr` float NOT NULL,
  `vlm_pr` float NOT NULL,
  `qnt_pr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_pr d` (`id_pr`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_produits`
--

LOCK TABLES `fr_produits` WRITE;
/*!40000 ALTER TABLE `fr_produits` DISABLE KEYS */;
INSERT INTO `fr_produits` VALUES (1,0,'ACT1','Disque Dur SSD 240GO','Informatique','undefined','ADATA',110,5,'EXT1 ARM1 E1','Mytek','assets/img/471368test imgs (3).jpg','assets/doc/86697ni_031-22_drh.pdf','',0,0,0,0,1),(2,0,'ACT2','Ecran 22 pouces','Informatique','undefined','acer',580,2,'EXT1 ARM1 E2','mytek','assets/img/118500ecran.jpg','assets/doc/923542ni_031-22_drh.pdf','',0,0,0,0,1),(3,0,'ACT3','cable réseau 3m','Réseau','undefined','',3,10,'EXT1 ARM1 E3','tunisinet','assets/img/919970cable-reseau-3m.jpg','assets/doc/642976li_017-22.pdf','',0,0,0,0,6),(4,0,'ACT4','RTU870','Electrique','undefined','brodersson',15000,5,'EXT1 ARM2 E1','ABB','assets/img/470786rtu32_large.jpg','assets/doc/45822ni_030-22_drh.pdf','',0,0,0,0,1),(5,0,'ACT5','RTU 32','Electrique','undefined','Brodersson',1500,5,'EXT1 ARM1 E3','ABB','assets/img/46097564471-7040163.jpg','assets/doc/','',0,0,0,0,1);
/*!40000 ALTER TABLE `fr_produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_req_in`
--

DROP TABLE IF EXISTS `fr_req_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_req_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_req_in` varchar(25) NOT NULL,
  `id_pr_in` varchar(20) NOT NULL,
  `name_pr_in` varchar(50) NOT NULL,
  `qnt_in` int(11) NOT NULL,
  `nmrsr` varchar(50) NOT NULL,
  `stckg_pr_in` varchar(70) NOT NULL,
  `desc_pr_in` text NOT NULL,
  `cmt_pr_in` text NOT NULL,
  `date_in` date NOT NULL,
  `user_in` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_req_in` (`id_req_in`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_req_in`
--

LOCK TABLES `fr_req_in` WRITE;
/*!40000 ALTER TABLE `fr_req_in` DISABLE KEYS */;
INSERT INTO `fr_req_in` VALUES (44,'BON_1','ACT1','Disque Dur SSD 240GO',1,'DSQ0001','EXT1 ARM1 E1','','','2022-06-18','71149'),(45,'BON_45','ACT1','Disque Dur SSD 240GO',1,'DSQ0002','EXT1 ARM1 E1','','','2022-06-18','71149'),(46,'BON_46','ACT2','Ecran 22 pouces',1,'SQQ0001','EXT1 ARM1 E2','','','2022-06-18','71149'),(47,'BON_47','ACT3','cable réseau 3m',8,'x','EXT1 ARM1 E3','','','2022-06-18','71149'),(48,'BON_48','ACT4','RTU870',1,'TRRR1111','EXT1 ARM2 E1','','','2022-06-18','71149'),(49,'BON_49','ACT4','RTU870',1,'RTTT000001','EXT1 ARM2 E1','','','2022-06-18','71149'),(50,'BON_50','ACT5','RTU 32',1,'RT320001','EXT1 ARM1 E3','','','2022-06-18','71149'),(51,'BON_51','ACT5','RTU 32',1,'RTT3200002','EXT1 ARM1 E3','','','2022-06-18','71149');
/*!40000 ALTER TABLE `fr_req_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_request`
--

DROP TABLE IF EXISTS `fr_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `req_user` varchar(15) NOT NULL,
  `req_id_pr` varchar(25) NOT NULL,
  `req_name_pr` varchar(50) NOT NULL,
  `req_qnt_dem` int(11) NOT NULL,
  `req_qnt_disp` int(11) NOT NULL,
  `req_stckg` varchar(70) NOT NULL,
  `req_nb` int(11) NOT NULL,
  `nmsr` varchar(50) NOT NULL,
  `req_sts` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_request`
--

LOCK TABLES `fr_request` WRITE;
/*!40000 ALTER TABLE `fr_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `fr_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_stockage`
--

DROP TABLE IF EXISTS `fr_stockage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_stockage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magp` varchar(30) NOT NULL,
  `arm_mag` varchar(30) NOT NULL,
  `et_mag` varchar(30) NOT NULL,
  `etq_mag` varchar(30) NOT NULL,
  `desc_mag` text NOT NULL,
  `vlm_et` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_stockage`
--

LOCK TABLES `fr_stockage` WRITE;
/*!40000 ALTER TABLE `fr_stockage` DISABLE KEYS */;
INSERT INTO `fr_stockage` VALUES (16,'EXT1','Armoire','E1','ARM1','armoire 1 dans magsin externe 1',0),(17,'EXT1','Armoire','E2','ARM1','armoire 1 dans magsin externe 1',0),(18,'EXT1','Armoire','E3','ARM1','armoire 1 dans magsin externe 1',0),(19,'EXT1','Armoire','E4','ARM1','armoire 1 dans magsin externe 1',0),(20,'EXT1','Armoire','E5','ARM1','armoire 1 dans magsin externe 1',0),(21,'EXT1','Armoire','E1','ARM2','armoire 2 dans magasin externe 1',0),(22,'EXT1','Armoire','E2','ARM2','armoire 2 dans magasin externe 1',0),(23,'EXT1','Armoire','E3','ARM2','armoire 2 dans magasin externe 1',0),(24,'EXT1','Armoire','E4','ARM2','armoire 2 dans magasin externe 1',0),(25,'EXT1','Armoire','E5','ARM2','armoire 2 dans magasin externe 1',0);
/*!40000 ALTER TABLE `fr_stockage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fr_wtreq`
--

DROP TABLE IF EXISTS `fr_wtreq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fr_wtreq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_req` varchar(70) NOT NULL,
  `user_req` varchar(15) NOT NULL,
  `nb_item` int(11) NOT NULL,
  `all_pr` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`all_pr`)),
  `all_qnt` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`all_qnt`)),
  `all_nmsr` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`all_nmsr`)),
  `date_dem` date NOT NULL,
  `sts` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_req` (`id_req`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fr_wtreq`
--

LOCK TABLES `fr_wtreq` WRITE;
/*!40000 ALTER TABLE `fr_wtreq` DISABLE KEYS */;
INSERT INTO `fr_wtreq` VALUES (9,'DEM1','71149',5,'{\"0\":\"\",\"act1\":\"ACT1\",\"act2\":\"ACT2\",\"act3\":\"ACT3\",\"act4\":\"ACT4\",\"act5\":\"ACT5\"}','{\"0\":\"\",\"qnt1\":\"1\",\"qnt2\":\"1\",\"qnt3\":\"3\",\"qnt4\":\"1\",\"qnt5\":\"1\"}','{\"0\":\"\",\"nmsr1\":\"DSQ0001\",\"nmsr2\":\"SQQ0001\",\"nmsr3\":\"x\",\"nmsr4\":\"TRRR1111\",\"nmsr5\":\"RT320001\"}','2022-06-18','rfs'),(10,'DEM10','71149',4,'{\"0\":\"\",\"act1\":\"ACT1\",\"act2\":\"ACT3\",\"act3\":\"ACT4\",\"act4\":\"ACT5\"}','{\"0\":\"\",\"qnt1\":\"1\",\"qnt2\":\"2\",\"qnt3\":\"1\",\"qnt4\":\"1\"}','{\"0\":\"\",\"nmsr1\":\"DSQ0002\",\"nmsr2\":\"x\",\"nmsr3\":\"RTTT000001\",\"nmsr4\":\"RTT3200002\"}','2022-06-18','OK');
/*!40000 ALTER TABLE `fr_wtreq` ENABLE KEYS */;
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
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_stock`
--

LOCK TABLES `users_stock` WRITE;
/*!40000 ALTER TABLE `users_stock` DISABLE KEYS */;
INSERT INTO `users_stock` VALUES ('71136','Bejaoui Hamed','UXXX','DTEL','$2y$10$nTA.AtiQMAdlp0eObOd1e.XzWG3eB9sk/tobFMWj5zEoD/6pY4vHi'),('71145','Ben Abdallah Karim','UMXX','DTLC','$2y$10$zkPc/n/dERjbaiSzytv3ludy8JVEqiv.qoZnzQHe5bfNQevqlbCa.'),('71148','Laghmani Bacem','UMAX','DTLC','$2y$10$p8SlZBO1WVzVhnDrWEPqnOgKjJvyY4sBtCqcfEfrQXHF74//zcYgu'),('71149','Chaieb Farid ','UMAS','DMLG','$2y$10$bmKTjQF8/b2NrtGzUGWZWO9pG4VvrY4u6VviKJWKmvRsEzdqH2Oa2');
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

-- Dump completed on 2022-06-18 14:14:47

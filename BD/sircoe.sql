CREATE DATABASE  IF NOT EXISTS `sircoe` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sircoe`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: sircoe
-- ------------------------------------------------------
-- Server version	5.6.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dependencias`
--

DROP TABLE IF EXISTS `dependencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dependencias` (
  `id_depen` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_depen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dependencias`
--

LOCK TABLES `dependencias` WRITE;
/*!40000 ALTER TABLE `dependencias` DISABLE KEYS */;
INSERT INTO `dependencias` VALUES (1,'Servicios G'),(2,'Cordinadores L');
/*!40000 ALTER TABLE `dependencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `cedula` int(20) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `codigo` int(20) DEFAULT NULL,
  `estado` enum('ad','af') NOT NULL,
  `dependencias_id_depen` int(11) NOT NULL,
  PRIMARY KEY (`cedula`),
  UNIQUE KEY `cedula_UNIQUE` (`cedula`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_empleados_dependencias_idx` (`dependencias_id_depen`),
  CONSTRAINT `fk_empleados_dependencias` FOREIGN KEY (`dependencias_id_depen`) REFERENCES `dependencias` (`id_depen`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (12969788,'Edgar ','Santacruz Burbano',1,'af',1),(12989880,'Harold Gonzalo ','Santacruz Ortega',2,'af',2),(12993081,'Rafael Martin','Moncayo Salazar',3,'af',2),(13071237,'Hugo Nelson','Espinosa Burbano',4,'af',2),(59831596,'Marizol ','Savedra Rodriges',5,'af',1),(87070865,'Victor Alfonzo','Jurado Fuelmayor',6,'af',1),(98309820,'Raul Lolo','Aucu Medina',7,'af',1),(1085273962,'Jesus Alexander ','Benavides Alvarez',8,'af',1),(1085279394,'Wilson Enrrique','Delgado Achicanoy',9,'af',1),(1085302857,'Maria Alejandra','Narvaez Cuero',10,'af',1);
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas`
--

DROP TABLE IF EXISTS `entradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradas` (
  `identradas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `empleados_cedula` int(11) NOT NULL,
  PRIMARY KEY (`identradas`),
  KEY `fk_entradas_empleados1_idx` (`empleados_cedula`),
  CONSTRAINT `fk_entradas_empleados1` FOREIGN KEY (`empleados_cedula`) REFERENCES `empleados` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas`
--

LOCK TABLES `entradas` WRITE;
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
INSERT INTO `entradas` VALUES (1,'2016-08-16','08:00:00',12969788),(2,'2016-08-16','08:02:00',12989880),(3,'2016-08-16','07:01:00',12993081),(4,'2016-08-16','07:00:00',13071237),(5,'2016-08-16','07:05:00',59831596),(6,'2016-08-16','08:00:00',87070865),(7,'2016-08-16','07:00:00',98309820),(8,'2016-08-16','07:03:00',1085273962),(9,'2016-08-16','07:05:00',1085279394),(10,'2016-08-16','08:10:00',1085302857),(11,'2016-08-17','07:05:00',13071237),(12,'2016-08-17','07:01:00',59831596),(13,'2016-08-17','08:06:00',87070865),(14,'2016-08-17','07:03:00',98309820),(15,'2016-08-17','07:00:00',1085273962),(16,'2016-08-17','07:02:00',1085279394),(17,'2016-08-17','08:00:00',1085302857),(18,'2016-08-17','08:00:00',12969788),(19,'2016-08-17','08:00:00',12989880),(20,'2016-08-17','07:05:00',12993081),(21,'2016-08-18','08:00:00',1085302857),(22,'2016-08-18','07:02:00',1085279394),(23,'2016-08-18','07:00:00',1085273962),(24,'2016-08-18','07:00:00',98309820),(25,'2016-08-18','08:00:00',87070865),(26,'2016-08-18','07:05:00',59831596),(27,'2016-08-18','07:00:00',13071237),(28,'2016-08-18','07:01:00',12993081),(29,'2016-08-18','07:02:00',12989880),(30,'2016-08-18','08:00:00',12969788),(31,'2016-08-19','07:00:00',13071237),(32,'2016-08-19','07:00:00',59831596),(33,'2016-08-19','08:04:00',87070865),(34,'2016-08-19','07:00:00',98309820),(35,'2016-08-19','07:02:00',1085273962),(36,'2016-08-19','07:00:00',1085279394),(37,'2016-08-19','08:01:00',1085302857),(38,'2016-08-19','08:00:00',12969788),(39,'2016-08-19','08:00:00',12989880),(40,'2016-08-19','07:00:00',12993081),(41,'2016-08-22','08:07:00',12969788),(42,'2016-08-22','08:00:00',12989880),(43,'2016-08-22','07:03:00',12993081),(44,'2016-08-22','07:10:00',13071237),(45,'2016-08-22','07:00:00',59831596),(46,'2016-08-22','08:00:00',87070865),(47,'2016-08-22','07:00:00',98309820),(48,'2016-08-22','07:02:00',1085273962),(49,'2016-08-22','07:03:00',1085279394),(50,'2016-08-22','08:02:00',1085302857),(51,'2016-08-08','08:00:00',12969788),(52,'2016-08-08','08:03:00',12989880),(53,'2016-08-08','07:10:00',12993081),(54,'2016-08-08','07:00:00',13071237),(55,'2016-08-08','07:10:00',59831596),(56,'2016-08-08','08:00:00',87070865),(57,'2016-08-08','07:00:00',98309820),(58,'2016-08-08','07:03:00',1085273962),(59,'2016-08-08','07:10:00',1085279394),(60,'2016-08-08','08:00:00',1085302857),(61,'2016-08-09','07:05:00',13071237),(62,'2016-08-09','07:00:00',59831596),(63,'2016-08-09','08:10:00',87070865),(64,'2016-08-09','07:05:00',98309820),(65,'2016-08-09','07:03:00',1085273962),(66,'2016-08-09','07:05:00',1085279394),(67,'2016-08-09','08:04:00',1085302857),(68,'2016-08-09','08:05:00',12969788),(69,'2016-08-09','08:05:00',12989880),(70,'2016-08-09','07:10:00',12993081),(71,'2016-08-10','08:00:00',1085302857),(72,'2016-08-10','07:10:00',1085279394),(73,'2016-08-10','07:00:00',1085273962),(74,'2016-08-10','07:00:00',98309820),(75,'2016-08-10','08:05:00',87070865),(76,'2016-08-10','07:05:00',59831596),(77,'2016-08-10','07:00:00',13071237),(78,'2016-08-10','07:05:00',12993081),(79,'2016-08-10','08:02:00',12989880),(80,'2016-08-10','08:03:00',12969788),(81,'2016-08-11','07:05:00',13071237),(82,'2016-08-11','07:00:00',59831596),(83,'2016-08-11','08:05:00',87070865),(84,'2016-08-11','07:00:00',98309820),(85,'2016-08-11','07:02:00',1085273962),(86,'2016-08-11','07:00:00',1085279394),(87,'2016-08-11','08:01:00',1085302857),(88,'2016-08-11','08:03:00',12969788),(89,'2016-08-11','08:00:00',12989880),(90,'2016-08-11','07:00:00',12993081),(91,'2016-08-12','08:10:00',12969788),(92,'2016-08-12','08:00:00',12989880),(93,'2016-08-12','07:10:00',12993081),(94,'2016-08-12','07:10:00',13071237),(95,'2016-08-12','07:00:00',59831596),(96,'2016-08-12','08:00:00',87070865),(97,'2016-08-12','07:00:00',98309820),(98,'2016-08-12','07:10:00',1085273962),(99,'2016-08-12','07:03:00',1085279394),(100,'2016-08-12','08:02:00',1085302857);
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rol` enum('admin','consul') NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'test_user','test@example.com','admin','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salidas`
--

DROP TABLE IF EXISTS `salidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salidas` (
  `idsalidas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `empleados_cedula` int(11) NOT NULL,
  PRIMARY KEY (`idsalidas`),
  KEY `fk_salidas_empleados1_idx` (`empleados_cedula`),
  CONSTRAINT `fk_salidas_empleados1` FOREIGN KEY (`empleados_cedula`) REFERENCES `empleados` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salidas`
--

LOCK TABLES `salidas` WRITE;
/*!40000 ALTER TABLE `salidas` DISABLE KEYS */;
INSERT INTO `salidas` VALUES (1,'2016-08-16','12:00:00',12969788),(2,'2016-08-16','12:00:00',12989880),(3,'2016-08-16','15:50:00',12993081),(4,'2016-08-16','04:00:00',13071237),(5,'2016-08-16','12:00:00',59831596),(6,'2016-08-16','12:00:00',87070865),(7,'2016-08-16','11:00:00',98309820),(8,'2016-08-16','11:00:00',1085273962),(9,'2016-08-16','12:00:00',1085279394),(10,'2016-08-16','12:00:00',1085302857),(11,'2016-08-17','03:55:00',13071237),(12,'2016-08-17','12:00:00',59831596),(13,'2016-08-17','11:58:00',87070865),(14,'2016-08-17','11:00:00',98309820),(15,'2016-08-17','11:00:00',1085273962),(16,'2016-08-17','12:00:00',1085279394),(17,'2016-08-17','12:00:00',1085302857),(18,'2016-08-17','11:55:00',12969788),(19,'2016-08-17','12:00:00',12989880),(20,'2016-08-17','04:00:00',12993081),(21,'2016-08-18','12:00:00',1085302857),(22,'2016-08-18','12:00:00',1085279394),(23,'2016-08-18','11:02:00',1085273962),(24,'2016-08-18','11:00:00',98309820),(25,'2016-08-18','12:00:00',87070865),(26,'2016-08-18','11:50:00',59831596),(27,'2016-08-18','03:54:00',13071237),(28,'2016-08-18','04:00:00',12993081),(29,'2016-08-18','11:54:00',12989880),(30,'2016-08-18','12:01:00',12969788),(31,'2016-08-19','04:00:00',13071237),(32,'2016-08-19','12:00:00',59831596),(33,'2016-08-19','12:00:00',87070865),(34,'2016-08-19','11:00:00',98309820),(35,'2016-08-19','11:00:00',1085273962),(36,'2016-08-19','12:00:00',1085279394),(37,'2016-08-19','12:00:00',1085302857),(38,'2016-08-19','12:00:00',12969788),(39,'2016-08-19','12:00:00',12989880),(40,'2016-08-19','03:56:00',12993081),(41,'2016-08-22','12:00:00',12969788),(42,'2016-08-22','12:03:00',12989880),(43,'2016-08-22','04:00:00',12993081),(44,'2016-08-22','03:30:00',13071237),(45,'2016-08-22','11:56:00',59831596),(46,'2016-08-22','11:58:00',87070865),(47,'2016-08-22','11:00:00',98309820),(48,'2016-08-22','10:57:00',1085273962),(49,'2016-08-22','12:00:00',1085279394),(50,'2016-08-22','12:05:00',1085302857),(51,'2016-08-08','12:00:00',12969788),(52,'2016-08-08','12:05:00',12989880),(53,'2016-08-08','15:50:00',12993081),(54,'2016-08-08','04:00:00',13071237),(55,'2016-08-08','12:00:00',59831596),(56,'2016-08-08','12:00:00',87070865),(57,'2016-08-08','11:00:00',98309820),(58,'2016-08-08','11:00:00',1085273962),(59,'2016-08-08','12:00:00',1085279394),(60,'2016-08-08','12:00:00',1085302857),(61,'2016-08-09','03:50:00',13071237),(62,'2016-08-09','12:00:00',59831596),(63,'2016-08-09','11:50:00',87070865),(64,'2016-08-09','11:00:00',98309820),(65,'2016-08-09','11:00:00',1085273962),(66,'2016-08-09','12:00:00',1085279394),(67,'2016-08-09','11:50:00',1085302857),(68,'2016-08-09','12:10:00',12969788),(69,'2016-08-09','12:00:00',12989880),(70,'2016-08-09','03:55:00',12993081),(71,'2016-08-10','12:00:00',1085302857),(72,'2016-08-10','11:50:00',1085279394),(73,'2016-08-10','10:50:00',1085273962),(74,'2016-08-10','10:50:00',98309820),(75,'2016-08-10','12:00:00',87070865),(76,'2016-08-10','12:10:00',59831596),(77,'2016-08-10','03:50:00',13071237),(78,'2016-08-10','04:00:00',12993081),(79,'2016-08-10','11:54:00',12989880),(80,'2016-08-10','12:01:00',12969788),(81,'2016-08-11','04:00:00',13071237),(82,'2016-08-11','12:00:00',59831596),(83,'2016-08-11','12:00:00',87070865),(84,'2016-08-11','11:00:00',98309820),(85,'2016-08-11','11:00:00',1085273962),(86,'2016-08-11','12:00:00',1085279394),(87,'2016-08-11','12:00:00',1085302857),(88,'2016-08-11','12:00:00',12969788),(89,'2016-08-11','12:00:00',12989880),(90,'2016-08-11','03:50:00',12993081),(91,'2016-08-12','11:50:00',12969788),(92,'2016-08-12','12:03:00',12989880),(93,'2016-08-12','04:00:00',12993081),(94,'2016-08-12','03:50:00',13071237),(95,'2016-08-12','12:03:00',59831596),(96,'2016-08-12','11:50:00',87070865),(97,'2016-08-12','11:00:00',98309820),(98,'2016-08-12','11:10:00',1085273962),(99,'2016-08-12','12:00:00',1085279394),(100,'2016-08-12','12:05:00',1085302857);
/*!40000 ALTER TABLE `salidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idadmin` int(11) NOT NULL,
  `nombre_ad` varchar(200) NOT NULL,
  `apellidos_ad` varchar(200) NOT NULL,
  `dependencias_id_depen` int(11) NOT NULL,
  `members_id` int(11) NOT NULL,
  PRIMARY KEY (`idadmin`),
  KEY `fk_administradores_dependencias1_idx` (`dependencias_id_depen`),
  KEY `fk_administradores_members1_idx` (`members_id`),
  CONSTRAINT `fk_administradores_dependencias1` FOREIGN KEY (`dependencias_id_depen`) REFERENCES `dependencias` (`id_depen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_administradores_members1` FOREIGN KEY (`members_id`) REFERENCES `members` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Test','User',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-02 15:03:07

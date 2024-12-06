-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: dbfinal
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(45) NOT NULL,
  `ci` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ci_UNIQUE` (`ci`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (45,'WALTER JONATHAN AQUINO MONZON','5534516-6'),(46,'JUAN CARLOS PEREZ MARTINEZ','1234567'),(47,'MARIA RODRIGUEZ GONZALEZ','2345678'),(48,'CARLOS ALBERTO SANCHEZ','3456789'),(49,'ANA MARIA FLORES LOPEZ','4567890'),(50,'PEDRO JOSE MARTINEZ','5678901'),(51,'LAURA BEATRIZ GONZALEZ','6789012'),(52,'ROBERTO CARLOS FERNANDEZ','7890123'),(53,'PATRICIA ELIZABETH TORRES','8901234'),(54,'JOSE MIGUEL RAMIREZ','9012345'),(55,'CARMEN ROSA MENDOZA','0123456'),(56,'LUIS ALBERTO CHAVEZ','1122334');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `año` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `chasis` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (35,'JOHN DEERE','JD6120M','2023','VERDE','JD2023HT456789012'),(36,'MASSEY FERGUSON','MF5710','2023','ROJO','MF2023RT567890123'),(37,'NEW HOLLAND','T6050','2023','AZUL','NH2023BT678901234'),(38,'CASE IH','PUMA 185','2023','ROJO','CI2023PT789012345'),(39,'FENDT','VARIO 828','2023','VERDE','FD2023VT890123456'),(40,'KUBOTA','M7152','2023','NARANJA','KB2023MT901234567'),(41,'CLAAS','ARION 620','2023','VERDE','CL2023AT012345678'),(42,'VALTRA','T234D','2023','ROJO','VL2023DT123456789'),(43,'DEUTZ-FAHR','6165RC','2023','VERDE','DF2023RT234567890'),(44,'SAME','VIRTUS 120','2023','ROJO','SM2023VT345678901'),(45,'JOHN DEERE','JD5090M','2023','VERDE','JD2023LT456789013'),(46,'MASSEY FERGUSON','MF8737','2023','ROJO','MF2023ST567890124'),(47,'NEW HOLLAND','T7HD','2023','AZUL','NH2023HT678901235'),(48,'CASE IH','MAGNUM 380','2023','ROJO','CI2023MT789012346'),(49,'FENDT','VARIO 936','2023','VERDE','FD2023PT890123457'),(50,'KUBOTA','M5111','2023','NARANJA','KB2023LT901234568'),(51,'CLAAS','AXION 870','2023','VERDE','CL2023BT012345679'),(52,'VALTRA','N174D','2023','ROJO','VL2023NT123456780');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-06 14:47:47

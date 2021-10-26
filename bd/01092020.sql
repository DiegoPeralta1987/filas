-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 172.17.0.78    Database: filas
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `asientos`
--

DROP TABLE IF EXISTS `asientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asientos` (
  `idasientos` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(2) DEFAULT NULL,
  PRIMARY KEY (`idasientos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asientos`
--

LOCK TABLES `asientos` WRITE;
/*!40000 ALTER TABLE `asientos` DISABLE KEYS */;
INSERT INTO `asientos` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6);
/*!40000 ALTER TABLE `asientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `asistencia` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idasistencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asistencia`
--

LOCK TABLES `asistencia` WRITE;
/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
INSERT INTO `asistencia` VALUES (0,'No'),(1,'Si');
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estados` (
  `idestados` int(11) NOT NULL,
  `estado` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idestados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva_cabecera`
--

DROP TABLE IF EXISTS `reserva_cabecera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva_cabecera` (
  `idreserva_cabecera` int(11) NOT NULL AUTO_INCREMENT,
  `id_stock` int(2) DEFAULT NULL,
  `ci_titular` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `che` int(2) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idreserva_cabecera`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_cabecera`
--

LOCK TABLES `reserva_cabecera` WRITE;
/*!40000 ALTER TABLE `reserva_cabecera` DISABLE KEYS */;
INSERT INTO `reserva_cabecera` VALUES (1,1,'2441700',NULL,'2020-08-20 15:27:57'),(2,2,'914163',NULL,'2020-08-20 15:32:20'),(3,2,'914163',NULL,'2020-08-20 15:32:20'),(4,2,'1234567489',NULL,'2020-08-20 15:37:10'),(5,2,'1234567489',NULL,'2020-08-20 15:55:39'),(6,1,'914163',NULL,'2020-08-24 09:02:43'),(7,1,'914163',NULL,'2020-08-24 09:05:21'),(8,1,'4304324',NULL,'2020-08-24 09:07:02'),(9,1,'4304324',NULL,'2020-08-24 09:14:13'),(10,1,'4304324',NULL,'2020-08-24 09:14:37'),(11,1,'4304324',NULL,'2020-08-24 09:19:05'),(12,1,'4304324',NULL,'2020-08-24 09:19:47'),(13,1,'4304324',NULL,'2020-08-24 09:22:21'),(14,1,'4304324',NULL,'2020-08-24 09:22:35'),(15,1,'4304324',NULL,'2020-08-24 09:30:47'),(16,1,'4304324',NULL,'2020-08-24 09:30:53'),(17,1,'4304324',NULL,'2020-08-24 09:31:20'),(18,1,'4304324',NULL,'2020-08-24 09:31:23'),(19,1,'4304324',NULL,'2020-08-24 09:35:07'),(20,1,'4304324',NULL,'2020-08-24 09:35:12'),(21,1,'4304324',NULL,'2020-08-24 09:35:17'),(22,1,'4304324',NULL,'2020-08-24 09:35:19'),(23,1,'4304324',NULL,'2020-08-24 09:35:27'),(24,1,'2441700',NULL,'2020-08-24 09:43:03'),(25,1,'2441700',NULL,'2020-08-24 09:44:38'),(26,2,'2172185',NULL,'2020-08-31 11:51:02'),(27,2,'2172185',NULL,'2020-08-31 11:51:06');
/*!40000 ALTER TABLE `reserva_cabecera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva_detalle`
--

DROP TABLE IF EXISTS `reserva_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva_detalle` (
  `idreserva_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `id_reserva_cabecera` int(11) DEFAULT NULL,
  `ci_persona` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `asistencia` int(11) DEFAULT '0',
  `feha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idreserva_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_detalle`
--

LOCK TABLES `reserva_detalle` WRITE;
/*!40000 ALTER TABLE `reserva_detalle` DISABLE KEYS */;
INSERT INTO `reserva_detalle` VALUES (1,2,'244170032','DEIGO','123321','die@gmail.com','sanlo','sada',0,'2020-08-20 19:32:20'),(2,3,'44444','dasda','23424','dd@gmail.com','3242','43234',0,'2020-08-20 19:32:20'),(3,4,'2441700','Dada','23232','die@gmail.com','32332232','2323332',0,'2020-08-20 19:37:10'),(4,4,'sdas','3322223','3222222','dief@gmail.com','2342342','san lo',0,'2020-08-20 19:37:10'),(5,5,'2441700','Dada','23232','die@gmail.com','32332232','2323332',0,'2020-08-20 19:55:39'),(6,5,'sdas','3322223','3222222','dief@gmail.com','2342342','san lo',0,'2020-08-20 19:55:39'),(7,7,'2441700','DEIGO','4454','die@gmail.com','sanlo','sada',0,'2020-08-24 13:05:21'),(8,8,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:07:02'),(9,9,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:14:13'),(10,10,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:14:37'),(11,11,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:19:05'),(12,13,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:22:21'),(13,14,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:22:35'),(14,23,'id_stock','SWE','23423','die@gmail.com','423423','sada',0,'2020-08-24 13:35:27'),(15,24,'2441700','DEIGO','2321','die@gmail.com','1231231','1231',0,'2020-08-24 13:43:03'),(16,25,'id_stock','asdasda','2342343','die@gmail.com','asdasda','adsda',0,'2020-08-24 13:44:38'),(17,26,'','Nelson Colman','0981670023','nrcolman64@gmail.com','Diaz de Leon','Asuncion',0,'2020-08-31 15:51:02'),(18,26,'4329974','Mirta Rodriguez','0986179846','mirtaro.me@gmail.com','Diaz de Leon','Asuncion',0,'2020-08-31 15:51:03'),(19,27,'','Nelson Colman','0981670023','nrcolman64@gmail.com','Diaz de Leon','Asuncion',0,'2020-08-31 15:51:06'),(20,27,'4329974','Mirta Rodriguez','0986179846','mirtaro.me@gmail.com','Diaz de Leon','Asuncion',0,'2020-08-31 15:51:06');
/*!40000 ALTER TABLE `reserva_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `horario` time DEFAULT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'2020-08-16','10:00:00'),(2,'2020-08-16','19:00:00');
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `idstock` int(11) NOT NULL AUTO_INCREMENT,
  `id_asientos` int(2) DEFAULT NULL,
  `cantidad` int(5) DEFAULT NULL,
  `cant_reserva` int(5) DEFAULT NULL,
  `idservicio` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (1,1,998,0,1,1),(2,2,492,8,1,1),(3,1,1000,0,2,1),(4,2,500,0,2,1),(9,3,1000,NULL,NULL,1),(10,4,1500,NULL,1,1),(11,5,300,NULL,1,1),(12,6,200,NULL,1,1);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'filas'
--

--
-- Dumping routines for database 'filas'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-01  9:05:41

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
  `id_asientos` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(2) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`id_asientos`),
  UNIQUE KEY `cantidad_UNIQUE` (`cantidad`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asientos`
--

LOCK TABLES `asientos` WRITE;
/*!40000 ALTER TABLE `asientos` DISABLE KEYS */;
INSERT INTO `asientos` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,5,1),(6,6,1),(7,7,1),(8,8,1),(9,9,1),(10,10,1);
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
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `permiso` varchar(50) NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'home'),(2,'ujieres');
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
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
  `idservicio` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` int(2) DEFAULT '1',
  PRIMARY KEY (`idreserva_cabecera`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_cabecera`
--

LOCK TABLES `reserva_cabecera` WRITE;
/*!40000 ALTER TABLE `reserva_cabecera` DISABLE KEYS */;
INSERT INTO `reserva_cabecera` VALUES (8,2,'914163',2,1,'2020-09-16 11:17:46',1),(9,12,'2441700',6,1,'2020-09-16 16:19:00',1),(10,1,'123123',1,1,'2020-09-17 17:07:11',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva_detalle`
--

LOCK TABLES `reserva_detalle` WRITE;
/*!40000 ALTER TABLE `reserva_detalle` DISABLE KEYS */;
INSERT INTO `reserva_detalle` VALUES (1,1,'2441700','Diego Peralta','0961315560','diego@gmail.com','Mcal Lopez','San Lorenzo',0,'2020-09-10 19:25:20'),(2,1,'914163','Maria Maciel','0961123466','mari@gmail.com','Mcal Lopez','San Lorenzo',0,'2020-09-10 19:25:20'),(3,1,'5547522','Lorena Maciel','098711454','lore@gmail.com','Mcal Lopez','San Lorenzo',0,'2020-09-10 19:25:20'),(4,2,'2441700','Diego Peralta','1223213','die@gmail.com','sanlo','San Lorenzo',0,'2020-09-10 19:27:03'),(5,3,'4488465','Juan Manuel Mereles','0992399996','jmereles@live.com','Olegario Andrade','Asunción ',0,'2020-09-15 14:06:41'),(6,4,'2441700','Diego','092131','diego@gmail.com','coroenl','sanlo',0,'2020-09-15 14:13:05'),(7,5,'2441700','Diego','092131','diego@gmail.com','coroenl','sanlo',0,'2020-09-15 14:19:39'),(8,6,'4488465','Juan Manuel Mereles','0992399996','jmereles@live.com','Olegario Andrade','Asunción ',0,'2020-09-15 19:22:41'),(9,7,'2441700','Diego Peralta','1212','die@gmail.com','das','ads',0,'2020-09-16 12:25:21'),(10,8,'914163','Maria Maciel','096134554','maria@gmail.com','San lorenzo','Sanlo',0,'2020-09-16 15:17:46'),(11,8,'45678','Gaston Peralta','061561','dada@gmail.com','salo','sano',0,'2020-09-16 15:17:46'),(12,9,'2441700','Carlo Peralta','09613151','dd@gmail.com','luque','luque',0,'2020-09-16 20:19:00'),(13,9,'123456','Soriano','0515415','dd@gmail.com','luque','kueyq',0,'2020-09-16 20:19:00'),(14,9,'154512','Soreenk','012154','ddd@gmail.com','luque','luque',0,'2020-09-16 20:19:00'),(15,9,'wqeq22','Doroasn','1230','ddd@gmail.com','luque','luque',0,'2020-09-16 20:19:00'),(16,9,'weqweq','freeee','23123','ddd@gmail.com','luque','luque',0,'2020-09-16 20:19:00'),(17,9,'qweqwe','dadada','123123','ddd@gmail.com','luque','luque',0,'2020-09-16 20:19:00'),(18,10,'123123','DEEEEE','123123','die@gmail.com','SDADSADA','ddddddddddddd',0,'2020-09-17 21:07:11');
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
  `estado` int(1) DEFAULT '1',
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'2020-08-16','10:00:00',1),(2,'2020-08-16','19:00:00',1),(3,'2020-09-07','13:43:00',0),(4,'2020-09-07','13:45:00',0);
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
  `cant_reserva` int(5) DEFAULT '0',
  `idservicio` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`idstock`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (1,1,998,5,1,1),(2,2,480,4,1,1),(3,1,1000,0,2,1),(4,2,500,0,2,1),(9,3,991,3,1,1),(10,4,1500,0,1,1),(11,5,300,0,1,1),(12,6,128,36,1,1),(14,10,1000,0,1,1),(15,1,98,2,3,1);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(20) NOT NULL,
  `num_documento` varchar(20) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cargo` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Usuario','ruc','13456','soriano','02121','cfa@cfa.org.py','admin','admin','7272c36279dc0b2c68f31526f42370483d52f8b5c64db0f75d6c87a51947466f',1),(2,'Ujieres','ruc','123456','soreinao','0214','cfa@cfa.org.py','ujieres','ujieres','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_permiso`
--

DROP TABLE IF EXISTS `usuario_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL,
  PRIMARY KEY (`idusuario_permiso`),
  KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  KEY `fk_usuario_permiso_usuario_idx` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_permiso`
--

LOCK TABLES `usuario_permiso` WRITE;
/*!40000 ALTER TABLE `usuario_permiso` DISABLE KEYS */;
INSERT INTO `usuario_permiso` VALUES (1,1,1),(2,2,2);
/*!40000 ALTER TABLE `usuario_permiso` ENABLE KEYS */;
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

-- Dump completed on 2020-09-21 11:00:37

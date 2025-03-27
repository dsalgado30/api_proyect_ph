-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: proyecto_formativo
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `_prisma_migrations`
--

DROP TABLE IF EXISTS `_prisma_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `_prisma_migrations` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checksum` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finished_at` datetime(3) DEFAULT NULL,
  `migration_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logs` text COLLATE utf8mb4_unicode_ci,
  `rolled_back_at` datetime(3) DEFAULT NULL,
  `started_at` datetime(3) NOT NULL DEFAULT CURRENT_TIMESTAMP(3),
  `applied_steps_count` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_prisma_migrations`
--

LOCK TABLES `_prisma_migrations` WRITE;
/*!40000 ALTER TABLE `_prisma_migrations` DISABLE KEYS */;
INSERT INTO `_prisma_migrations` VALUES ('4ac47195-f629-48e5-8a7d-874f8cb5e567','a0be0ca9c50b620b9460416d544edb78048733cacec9d069bb36f52fccfb490a','2025-03-11 15:54:08.215','20250311155407_',NULL,NULL,'2025-03-11 15:54:07.234',1);
/*!40000 ALTER TABLE `_prisma_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area` (
  `id_area` int NOT NULL AUTO_INCREMENT,
  `nombre_area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_sedes` int DEFAULT NULL,
  PRIMARY KEY (`id_area`),
  KEY `Area_fk_id_sedes_fkey` (`fk_id_sedes`),
  CONSTRAINT `Area_fk_id_sedes_fkey` FOREIGN KEY (`fk_id_sedes`) REFERENCES `sede` (`id_sedes`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area`
--

LOCK TABLES `area` WRITE;
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
INSERT INTO `area` VALUES (1,'Electricidad Industrial',1),(2,'Diseño de Modas',2),(3,'Agroindustria',3),(4,'Gestión Administrativa',4);
/*!40000 ALTER TABLE `area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bodega`
--

DROP TABLE IF EXISTS `bodega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bodega` (
  `id_bodega` int NOT NULL AUTO_INCREMENT,
  `nombre_bodega` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_sede` int DEFAULT NULL,
  PRIMARY KEY (`id_bodega`),
  KEY `Bodega_fk_id_sede_fkey` (`fk_id_sede`),
  CONSTRAINT `Bodega_fk_id_sede_fkey` FOREIGN KEY (`fk_id_sede`) REFERENCES `sede` (`id_sedes`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bodega`
--

LOCK TABLES `bodega` WRITE;
/*!40000 ALTER TABLE `bodega` DISABLE KEYS */;
INSERT INTO `bodega` VALUES (1,'Bodega Principal',1),(2,'Bodega de Herramientas',2);
/*!40000 ALTER TABLE `bodega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centro`
--

DROP TABLE IF EXISTS `centro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `centro` (
  `id_centro` int NOT NULL AUTO_INCREMENT,
  `nombre_centro` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_municipio` int DEFAULT NULL,
  PRIMARY KEY (`id_centro`),
  KEY `Centro_fk_id_municipio_fkey` (`fk_id_municipio`),
  CONSTRAINT `Centro_fk_id_municipio_fkey` FOREIGN KEY (`fk_id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centro`
--

LOCK TABLES `centro` WRITE;
/*!40000 ALTER TABLE `centro` DISABLE KEYS */;
INSERT INTO `centro` VALUES (1,'Centro de Electricidad y Automatización Industrial',1),(2,'Centro de Diseño y Manufactura del Cuero',2),(3,'Centro Agropecuario La Granja',3),(4,'Centro de Comercio y Servicios',4),(5,'Centro de Electricidad y Automatización Industrial',1),(6,'Centro de Diseño y Manufactura del Cuero',2),(7,'Centro Agropecuario La Granja',3),(8,'Centro de Comercio y Servicios',4),(9,'Centro de Electricidad y Automatización Industrial',1),(10,'Centro de Diseño y Manufactura del Cuero',2),(11,'Centro Agropecuario La Granja',3),(12,'Centro de Comercio y Servicios',4);
/*!40000 ALTER TABLE `centro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle`
--

DROP TABLE IF EXISTS `detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movimiento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_elemento` int DEFAULT NULL,
  `asignado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retorno` datetime(3) NOT NULL,
  `fecha` datetime(3) NOT NULL,
  `fk_id_ficha` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Detalle_fk_id_elemento_fkey` (`fk_id_elemento`),
  KEY `Detalle_fk_id_ficha_fkey` (`fk_id_ficha`),
  CONSTRAINT `Detalle_fk_id_elemento_fkey` FOREIGN KEY (`fk_id_elemento`) REFERENCES `elemento` (`id_elemento`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Detalle_fk_id_ficha_fkey` FOREIGN KEY (`fk_id_ficha`) REFERENCES `ficha` (`id_ficha`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle`
--

LOCK TABLES `detalle` WRITE;
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elemento`
--

DROP TABLE IF EXISTS `elemento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `elemento` (
  `id_elemento` int NOT NULL AUTO_INCREMENT,
  `nombre_elemento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double NOT NULL,
  `clasificacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ficha_tecnica` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uso` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_bodega` int DEFAULT NULL,
  PRIMARY KEY (`id_elemento`),
  UNIQUE KEY `Elemento_serial_key` (`serial`),
  KEY `Elemento_fk_id_bodega_fkey` (`fk_id_bodega`),
  CONSTRAINT `Elemento_fk_id_bodega_fkey` FOREIGN KEY (`fk_id_bodega`) REFERENCES `bodega` (`id_bodega`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elemento`
--

LOCK TABLES `elemento` WRITE;
/*!40000 ALTER TABLE `elemento` DISABLE KEYS */;
INSERT INTO `elemento` VALUES (1,'Osciloscopio',5,'Equipo de Laboratorio','FT001','Laboratorio de Electrónica','Disponible','SENA-001',1),(2,'Multímetro Digital',10,'Herramienta','FT002','Electricidad Industrial','Disponible','SENA-002',2);
/*!40000 ALTER TABLE `elemento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ficha`
--

DROP TABLE IF EXISTS `ficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ficha` (
  `id_ficha` int NOT NULL AUTO_INCREMENT,
  `numero_ficha` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_programa` int DEFAULT NULL,
  `fk_id_municipio` int DEFAULT NULL,
  `fk_id_sede` int DEFAULT NULL,
  PRIMARY KEY (`id_ficha`),
  KEY `Ficha_fk_id_programa_fkey` (`fk_id_programa`),
  KEY `Ficha_fk_id_municipio_fkey` (`fk_id_municipio`),
  KEY `Ficha_fk_id_sede_fkey` (`fk_id_sede`),
  CONSTRAINT `Ficha_fk_id_municipio_fkey` FOREIGN KEY (`fk_id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Ficha_fk_id_programa_fkey` FOREIGN KEY (`fk_id_programa`) REFERENCES `programa` (`id_programa`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Ficha_fk_id_sede_fkey` FOREIGN KEY (`fk_id_sede`) REFERENCES `sede` (`id_sedes`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ficha`
--

LOCK TABLES `ficha` WRITE;
/*!40000 ALTER TABLE `ficha` DISABLE KEYS */;
INSERT INTO `ficha` VALUES (1,'2356789',1,1,1),(2,'2384567',2,2,2),(3,'2398765',3,3,3);
/*!40000 ALTER TABLE `ficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento`
--

DROP TABLE IF EXISTS `movimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimiento` (
  `id_movimientos` int NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int DEFAULT NULL,
  `fk_id_elemento` int DEFAULT NULL,
  `fecha` datetime(3) NOT NULL,
  `responsable` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pedir` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suministrar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devolver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_movimientos`),
  KEY `Movimiento_fk_id_usuario_fkey` (`fk_id_usuario`),
  KEY `Movimiento_fk_id_elemento_fkey` (`fk_id_elemento`),
  CONSTRAINT `Movimiento_fk_id_elemento_fkey` FOREIGN KEY (`fk_id_elemento`) REFERENCES `elemento` (`id_elemento`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Movimiento_fk_id_usuario_fkey` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento`
--

LOCK TABLES `movimiento` WRITE;
/*!40000 ALTER TABLE `movimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipio`
--

DROP TABLE IF EXISTS `municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipio` (
  `id_municipio` int NOT NULL AUTO_INCREMENT,
  `nombre_municipio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_municipio`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipio`
--

LOCK TABLES `municipio` WRITE;
/*!40000 ALTER TABLE `municipio` DISABLE KEYS */;
INSERT INTO `municipio` VALUES (1,'San Agustin'),(2,'Suba'),(3,'Pitalito'),(4,'Localida de kenedy'),(5,'Bruselas'),(6,'San Agustin'),(7,'Suba'),(8,'Pitalito'),(9,'Localida de kenedy'),(10,'Bruselas');
/*!40000 ALTER TABLE `municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programa`
--

DROP TABLE IF EXISTS `programa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programa` (
  `id_programa` int NOT NULL AUTO_INCREMENT,
  `nombre_programa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programa`
--

LOCK TABLES `programa` WRITE;
/*!40000 ALTER TABLE `programa` DISABLE KEYS */;
INSERT INTO `programa` VALUES (1,'Técnico en Mantenimiento Electrónico'),(2,'Tecnólogo en Análisis y Desarrollo de Software'),(3,'Técnico en Sistemas'),(4,'Técnico en Producción de Moda');
/*!40000 ALTER TABLE `programa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rol` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `Rol_nombre_rol_key` (`nombre_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Instructor'),(4,'Líder'),(3,'Pasante');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sede`
--

DROP TABLE IF EXISTS `sede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sede` (
  `id_sedes` int NOT NULL AUTO_INCREMENT,
  `nombre_sede` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_centro` int DEFAULT NULL,
  PRIMARY KEY (`id_sedes`),
  KEY `Sede_fk_id_centro_fkey` (`fk_id_centro`),
  CONSTRAINT `Sede_fk_id_centro_fkey` FOREIGN KEY (`fk_id_centro`) REFERENCES `centro` (`id_centro`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sede`
--

LOCK TABLES `sede` WRITE;
/*!40000 ALTER TABLE `sede` DISABLE KEYS */;
INSERT INTO `sede` VALUES (1,'Sede Norte',1),(2,'Sede Sur',1),(3,'Sede Industrial',2),(4,'Sede Tecnológica',3),(5,'Sede Norte',1),(6,'Sede Sur',1),(7,'Sede Industrial',2),(8,'Sede Tecnológica',3);
/*!40000 ALTER TABLE `sede` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuariobodega`
--

DROP TABLE IF EXISTS `usuariobodega`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuariobodega` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int NOT NULL,
  `fk_id_bodega` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `UsuarioBodega_fk_id_usuario_fkey` (`fk_id_usuario`),
  KEY `UsuarioBodega_fk_id_bodega_fkey` (`fk_id_bodega`),
  CONSTRAINT `UsuarioBodega_fk_id_bodega_fkey` FOREIGN KEY (`fk_id_bodega`) REFERENCES `bodega` (`id_bodega`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `UsuarioBodega_fk_id_usuario_fkey` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariobodega`
--

LOCK TABLES `usuariobodega` WRITE;
/*!40000 ALTER TABLE `usuariobodega` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuariobodega` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarioficha`
--

DROP TABLE IF EXISTS `usuarioficha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarioficha` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fk_id_usuario` int NOT NULL,
  `fk_id_ficha` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `UsuarioFicha_fk_id_usuario_fkey` (`fk_id_usuario`),
  KEY `UsuarioFicha_fk_id_ficha_fkey` (`fk_id_ficha`),
  CONSTRAINT `UsuarioFicha_fk_id_ficha_fkey` FOREIGN KEY (`fk_id_ficha`) REFERENCES `ficha` (`id_ficha`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `UsuarioFicha_fk_id_usuario_fkey` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarioficha`
--

LOCK TABLES `usuarioficha` WRITE;
/*!40000 ALTER TABLE `usuarioficha` DISABLE KEYS */;
INSERT INTO `usuarioficha` VALUES (1,7,1),(2,8,2);
/*!40000 ALTER TABLE `usuarioficha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `identificacion` bigint NOT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_id_area` int DEFAULT NULL,
  `fk_id_rol` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `Usuarios_identificacion_key` (`identificacion`),
  UNIQUE KEY `Usuarios_correo_key` (`correo`),
  KEY `Usuarios_fk_id_area_fkey` (`fk_id_area`),
  KEY `Usuarios_fk_id_rol_fkey` (`fk_id_rol`),
  CONSTRAINT `Usuarios_fk_id_area_fkey` FOREIGN KEY (`fk_id_area`) REFERENCES `area` (`id_area`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Usuarios_fk_id_rol_fkey` FOREIGN KEY (`fk_id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (6,1012345678,'Carlos','Ramírez','carlos.ramirez@sena.edu.co',1,2),(7,1023456789,'Andrea','González','andrea.gonzalez@sena.edu.co',2,3),(8,1034567890,'Juan','Pérez','juan.perez@sena.edu.co',3,1),(9,45678,'Carl','Ramz','car@sena.edu.co',1,2);
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

-- Dump completed on 2025-03-27 14:42:59

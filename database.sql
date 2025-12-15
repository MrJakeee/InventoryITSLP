-- MySQL dump 10.13  Distrib 8.0.43, for Win64 (x86_64)
--
-- Host: localhost    Database: universidad
-- ------------------------------------------------------
-- Server version	8.0.43

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
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
                          `id_cargo` int NOT NULL AUTO_INCREMENT,
                          `nombre_cargo` varchar(50) NOT NULL,
                          PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
INSERT INTO `cargos` VALUES (1,'Administrativo'),(2,'Docente'),(3,'Laboratista');
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_articulos`
--

DROP TABLE IF EXISTS `categorias_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias_articulos` (
                                        `id_categoria_articulo` int NOT NULL AUTO_INCREMENT,
                                        `nombre_categoria_articulo` varchar(50) NOT NULL,
                                        `descripcion_categoria_articulo` varchar(100) NOT NULL,
                                        PRIMARY KEY (`id_categoria_articulo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_articulos`
--

LOCK TABLES `categorias_articulos` WRITE;
/*!40000 ALTER TABLE `categorias_articulos` DISABLE KEYS */;
INSERT INTO `categorias_articulos` VALUES (1,'Mobiliario para salones','Mesas, sillas y muebles utilizados en salones.'),(2,'Decoración de salones','Artículos decorativos como cortinas, manteles, centros de mesa y adornos.'),(3,'Iluminación para salones','Lámparas, luces LED, candelabros y equipos de iluminación ambiental.'),(4,'Equipos de computo','Parlantes, micrófonos y sistemas de audio para salones.');
/*!40000 ALTER TABLE `categorias_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edificio`
--

DROP TABLE IF EXISTS `edificio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `edificio` (
                            `id_edificio` int NOT NULL AUTO_INCREMENT,
                            `codigo_edificio` varchar(20) DEFAULT NULL,
                            `nombre_edificio` varchar(50) NOT NULL,
                            `ubicacion_edificio` varchar(50) NOT NULL,
                            `activo_edificio` tinyint(1) NOT NULL,
                            PRIMARY KEY (`id_edificio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edificio`
--

LOCK TABLES `edificio` WRITE;
/*!40000 ALTER TABLE `edificio` DISABLE KEYS */;
INSERT INTO `edificio` VALUES (1,'CC','Centro de Computo','Zona Noroeste',1),(2,'H3','Edificio H3','Zona Norte',1);
/*!40000 ALTER TABLE `edificio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventario` (
                              `no_inventario` int NOT NULL AUTO_INCREMENT,
                              `nombre_articulo` varchar(50) NOT NULL,
                              `descripcion_articulo` varchar(100) NOT NULL,
                              `modelo_articulo` varchar(50) NOT NULL,
                              `serie_articulo` varchar(50) NOT NULL,
                              `id_tipo_articulo` int NOT NULL,
                              `id_marca` int NOT NULL,
                              `id_salon` int NOT NULL,
                              `prestamo` tinyint(1) DEFAULT '0',
                              `status` enum('Bueno','Regular','Malo') NOT NULL,
                              `registro_verificado` tinyint(1) DEFAULT '0',
                              PRIMARY KEY (`no_inventario`),
                              KEY `id_tipo_articulo` (`id_tipo_articulo`),
                              KEY `id_marca` (`id_marca`),
                              KEY `inventario_ibfk_3` (`id_salon`),
                              CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_tipo_articulo`) REFERENCES `tipo_articulos` (`id_tipo_articulo`) ON DELETE CASCADE ON UPDATE CASCADE,
                              CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE,
                              CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`id_salon`) REFERENCES `salones` (`id_salon`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES (1,'Proyector Epson','Proyector de alta definición para presentaciones','Epson X500','SERIE-PRJX500-2025',16,1,4,0,'Bueno',1);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
                          `id_marca` int NOT NULL AUTO_INCREMENT,
                          `nombre_marca` varchar(50) NOT NULL,
                          `pais_origen` varchar(50) NOT NULL,
                          PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Epson','Japón'),(2,'HP','Estados Unidos'),(3,'Samsung','Corea del Sur'),(4,'Logitech','Suiza'),(5,'Lenovo','China'),(6,'LG','Corea del Sur'),(7,'Sony','Japón'),(8,'Dell','Estados Unidos'),(9,'Bosch','Alemania'),(10,'BenQ','Taiwán');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salones`
--

DROP TABLE IF EXISTS `salones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `salones` (
                           `id_salon` int NOT NULL AUTO_INCREMENT,
                           `id_edificio` int NOT NULL,
                           `codigo_salon` varchar(20) NOT NULL,
                           `activo` tinyint(1) NOT NULL,
                           `id_tipo_salon` int NOT NULL,
                           PRIMARY KEY (`id_salon`),
                           KEY `id_tipo_salon` (`id_tipo_salon`),
                           KEY `id_edificio` (`id_edificio`),
                           CONSTRAINT `salones_ibfk_1` FOREIGN KEY (`id_tipo_salon`) REFERENCES `tipo_salones` (`id_tipo_salon`) ON DELETE CASCADE ON UPDATE CASCADE,
                           CONSTRAINT `salones_ibfk_2` FOREIGN KEY (`id_edificio`) REFERENCES `edificio` (`id_edificio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salones`
--

LOCK TABLES `salones` WRITE;
/*!40000 ALTER TABLE `salones` DISABLE KEYS */;
INSERT INTO `salones` VALUES (4,2,'H3-7',1,2),(6,2,'H3-12',1,2);
/*!40000 ALTER TABLE `salones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_articulos`
--

DROP TABLE IF EXISTS `tipo_articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_articulos` (
                                  `id_tipo_articulo` int NOT NULL AUTO_INCREMENT,
                                  `nombre_tipo_articulo` varchar(50) NOT NULL,
                                  `id_categoria_articulo` int NOT NULL,
                                  PRIMARY KEY (`id_tipo_articulo`),
                                  KEY `id_categoria_articulo` (`id_categoria_articulo`),
                                  CONSTRAINT `tipo_articulos_ibfk_1` FOREIGN KEY (`id_categoria_articulo`) REFERENCES `categorias_articulos` (`id_categoria_articulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_articulos`
--

LOCK TABLES `tipo_articulos` WRITE;
/*!40000 ALTER TABLE `tipo_articulos` DISABLE KEYS */;
INSERT INTO `tipo_articulos` VALUES (1,'Sillas plegables',1),(2,'Mesas rectangulares',1),(3,'Podios',1),(4,'Sillas acolchonadas',1),(5,'Mesas redondas',1),(6,'Centros de mesa',2),(7,'Cortinas decorativas',2),(8,'Manteles',2),(9,'Arcos decorativos',2),(10,'Fundas para sillas',2),(11,'Luces LED',3),(12,'Reflectores',3),(13,'Candelabros',3),(14,'Lámparas colgantes',3),(15,'Estroboscópicas',3),(16,'Proyectores',4),(17,'Computadoras',4),(18,'Micrófonos inalámbricos',4),(19,'Bocinas amplificadas',4),(20,'Pantallas LED',4);
/*!40000 ALTER TABLE `tipo_articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_salones`
--

DROP TABLE IF EXISTS `tipo_salones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_salones` (
                                `id_tipo_salon` int NOT NULL AUTO_INCREMENT,
                                `nombre_tipo_salon` varchar(50) NOT NULL,
                                PRIMARY KEY (`id_tipo_salon`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_salones`
--

LOCK TABLES `tipo_salones` WRITE;
/*!40000 ALTER TABLE `tipo_salones` DISABLE KEYS */;
INSERT INTO `tipo_salones` VALUES (1,'Laboratorio'),(2,'Salon');
/*!40000 ALTER TABLE `tipo_salones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
                            `matricula_usuario` int NOT NULL AUTO_INCREMENT,
                            `nombre_usuario` varchar(50) NOT NULL,
                            `pass_usuario` varchar(255) DEFAULT NULL,
                            `id_cargo` int NOT NULL,
                            PRIMARY KEY (`matricula_usuario`),
                            KEY `id_cargo` (`id_cargo`),
                            CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1015 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1001,'Manuel','$2y$10$uSBCZ9VNRjPGlogEyJ7QneREPU3hLvraRqEchE/Z/KhPjARqCHrZW',1),(1006,'Ussiel','$2y$10$UgIeMSg0eVdVMiSUmcRRTeVQtzRhSJ.EDp2KaooKMAv9HTMIsngnm',3),(1012,'Fernanda ','$2y$10$AhISnj5VEuDoZMv5JH.AAeTpDHdPtXX0HuY1NaMO24b.9.3euR7w2',1),(1013,'Alejandra','$2y$10$DkHw5.ETDWjAi9IYkyqeee39Ef0eWNlW0IZmVlgI09Ssh2e5umUQa',3),(1014,'Fernanda Garcia','$2y$10$NDYHanzv9Dl.0wUwdLniq.iitG0gBw/YQsVM1XLAFMhL2TdAlPXhy',2);
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

-- Dump completed on 2025-12-15 12:10:26

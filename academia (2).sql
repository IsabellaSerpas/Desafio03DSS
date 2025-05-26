-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2025 at 11:30 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Table structure for table `asignacion_aspectos`
--

DROP TABLE IF EXISTS `asignacion_aspectos`;
CREATE TABLE IF NOT EXISTS `asignacion_aspectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo_aspecto` int NOT NULL,
  `fecha` date NOT NULL,
  `codigo_estudiante` varchar(12) NOT NULL,
  `codigo_tutor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_aspecto` (`codigo_aspecto`),
  KEY `codigo_estudiante` (`codigo_estudiante`),
  KEY `codigo_tutor` (`codigo_tutor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
CREATE TABLE IF NOT EXISTS `asistencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `codigo_estudiante` varchar(12) NOT NULL,
  `codigo_tutor` varchar(10) NOT NULL,
  `tipo` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_estudiante` (`codigo_estudiante`),
  KEY `codigo_tutor` (`codigo_tutor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aspectos`
--

DROP TABLE IF EXISTS `aspectos`;
CREATE TABLE IF NOT EXISTS `aspectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `tipo` enum('P','L','G','MG') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `codigo` varchar(12) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `dui` (`dui`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`codigo`, `nombres`, `apellidos`, `dui`, `email`, `telefono`, `fecha_nacimiento`, `fotografia`, `estado`) VALUES
('ESTU001', 'San', 'Choi', '12345678-9', 'choi.san@academia.com', '7777-8888', '2005-06-15', NULL, 'activo'),
('ESTU002', 'Vernon', 'Choi', '23456789-0', 'choi.vernon@academia.com', '6666-5555', '2004-03-22', NULL, 'activo'),
('ESTU003', 'HongJoong', 'Kim', '34567890-1', 'kim.hongjoong@academia.com', '5555-4444', '2003-11-10', NULL, 'activo'),
('ESTU004', 'JungKook', 'Jeon', '45678901-2', 'jeon.jungkook@academia.com', '4444-3333', '2005-09-05', NULL, 'activo'),
('ESTU005', 'Christian', 'Yu', '01234567-1', 'christian@academia.com', '7000-0001', '1997-09-01', NULL, 'activo'),
('ESTU006', 'Jisoo', 'Kim', '01234567-2', 'jisoo@academia.com', '7000-0002', '1995-01-03', NULL, 'activo'),
('ESTU007', 'Taehyung', 'Kim', '01234567-3', 'taehyung@academia.com', '7000-0003', '1995-12-30', NULL, 'activo'),
('ESTU008', 'Lisa', 'Manoban', '01234567-4', 'lisa@academia.com', '7000-0004', '1997-03-27', NULL, 'activo'),
('ESTU009', 'Jennie', 'Kim', '01234567-5', 'jennie@academia.com', '7000-0005', '1996-01-16', NULL, 'activo'),
('ESTU010', 'Namjoon', 'Kim', '01234567-6', 'namjoon@academia.com', '7000-0006', '1994-09-12', NULL, 'activo'),
('ESTU011', 'Jimin', 'Park', '01234567-7', 'jimin@academia.com', '7000-0007', '1995-10-13', NULL, 'activo'),
('ESTU012', 'Yoongi', 'Min', '01234567-8', 'yoongi@academia.com', '7000-0008', '1993-03-09', NULL, 'activo'),
('ESTU013', 'Hoseok', 'Jung', '01234567-9', 'hoseok@academia.com', '7000-0009', '1994-02-18', NULL, 'activo'),
('ESTU014', 'Rosé', 'Park', '11234567-0', 'rose@academia.com', '7000-0010', '1997-02-11', NULL, 'activo'),
('ESTU015', 'Irene', 'Bae', '11234567-1', 'irene@academia.com', '7000-0011', '1991-03-29', NULL, 'activo'),
('ESTU016', 'Wendy', 'Shon', '11234567-2', 'wendy@academia.com', '7000-0012', '1994-02-21', NULL, 'activo'),
('ESTU017', 'Joy', 'Park', '11234567-3', 'joy@academia.com', '7000-0013', '1996-09-03', NULL, 'activo'),
('ESTU018', 'Yeri', 'Kim', '11234567-4', 'yeri@academia.com', '7000-0014', '1999-03-05', NULL, 'activo'),
('ESTU019', 'Kai', 'Kim', '11234567-5', 'kai@academia.com', '7000-0015', '1994-01-14', NULL, 'activo'),
('ESTU020', 'Baekhyun', 'Byun', '11234567-6', 'baekhyun@academia.com', '7000-0016', '1992-05-06', NULL, 'activo'),
('ESTU021', 'Suho', 'Kim', '11234567-7', 'suho@academia.com', '7000-0017', '1991-05-22', NULL, 'activo'),
('ESTU022', 'Chanyeol', 'Park', '11234567-8', 'chanyeol@academia.com', '7000-0018', '1992-11-27', NULL, 'activo'),
('ESTU023', 'Kyungsoo', 'Do', '11234567-9', 'kyungsoo@academia.com', '7000-0019', '1993-01-12', NULL, 'activo'),
('ESTU024', 'Sehun', 'Oh', '21234567-0', 'sehun@academia.com', '7000-0020', '1994-04-12', NULL, 'activo'),
('ESTU025', 'Taemin', 'Lee', '21234567-1', 'taemin@academia.com', '7000-0021', '1993-07-18', NULL, 'activo'),
('ESTU026', 'Kibum', 'Kim', '21234567-2', 'kibum@academia.com', '7000-0022', '1991-09-23', NULL, 'activo'),
('ESTU027', 'Minho', 'Choi', '21234567-3', 'minho@academia.com', '7000-0023', '1991-12-09', NULL, 'activo'),
('ESTU028', 'Jaehyng', 'Myung', '21234567-4', 'jaehyung@academia.com', '7000-0024', '1989-12-14', NULL, 'activo'),
('ESTU029', 'Hyunjin', 'Hwang', '21234567-5', 'hyunjin@academia.com', '7000-0025', '2000-03-20', NULL, 'activo'),
('ESTU030', 'Felix', 'Lee', '21234567-6', 'felix@academia.com', '7000-0026', '2000-09-15', NULL, 'activo'),
('ESTU031', 'Christopher Chan', 'Bang', '21234567-7', 'bangchan@academia.com', '7000-0027', '1997-10-03', NULL, 'activo'),
('ESTU032', 'Han', 'Jisung', '21234567-8', 'han@academia.com', '7000-0028', '2000-09-14', NULL, 'activo'),
('ESTU033', 'Minho', 'Lee', '21234567-9', 'leeknow@academia.com', '7000-0029', '1998-10-25', NULL, 'activo'),
('ESTU034', 'Sunmi', 'Lee', '31234567-0', 'sunmi@academia.com', '7000-0030', '1992-05-02', NULL, 'activo'),
('ESTU035', 'Taeyong', 'Lee', '31234567-1', 'taeyong@academia.com', '7000-0031', '1995-07-01', NULL, 'activo'),
('ESTU036', 'Ten', 'Chittaphon', '31234567-2', 'ten@academia.com', '7000-0032', '1996-02-27', NULL, 'activo'),
('ESTU037', 'Haechan', 'Lee', '31234567-3', 'haechan@academia.com', '7000-0033', '2000-06-06', NULL, 'activo'),
('ESTU038', 'Mark', 'Lee', '31234567-4', 'mark@academia.com', '7000-0034', '1999-08-02', NULL, 'activo'),
('ESTU039', 'Karina', 'Yoo', '31234567-5', 'karina@academia.com', '7000-0035', '2000-04-11', NULL, 'activo'),
('ESTU040', 'Winter', 'Kim', '31234567-6', 'winter@academia.com', '7000-0036', '2001-01-01', NULL, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `codigo_tutor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_tutor` (`codigo_tutor`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `codigo_tutor`) VALUES
(16, 'G02L', 'TUTOR005'),
(14, 'G03L', 'TUTOR001'),
(15, 'G01L', 'TUTOR004'),
(17, 'G04L', 'TUTOR003'),
(21, 'G05L', 'TUTOR002'),
(23, 'G01', 'TUTOR002'),
(24, 'prueba', 'TUTOR001');

-- --------------------------------------------------------

--
-- Table structure for table `grupo_estudiantes`
--

DROP TABLE IF EXISTS `grupo_estudiantes`;
CREATE TABLE IF NOT EXISTS `grupo_estudiantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo` int NOT NULL,
  `codigo_estudiante` varchar(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_grupo` (`id_grupo`,`codigo_estudiante`),
  KEY `codigo_estudiante` (`codigo_estudiante`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grupo_estudiantes`
--

INSERT INTO `grupo_estudiantes` (`id`, `id_grupo`, `codigo_estudiante`) VALUES
(1, 1, 'ESTU001'),
(23, 16, 'ESTU005'),
(22, 16, 'ESTU004'),
(4, 2, 'ESTU001'),
(5, 6, 'ESTU001'),
(21, 16, 'ESTU003'),
(7, 11, 'ESTU001'),
(20, 16, 'ESTU002'),
(19, 16, 'ESTU001'),
(18, 14, 'ESTU008'),
(25, 16, 'ESTU007'),
(26, 16, 'ESTU008'),
(27, 16, 'ESTU009'),
(28, 16, 'ESTU010'),
(29, 16, 'ESTU011'),
(30, 16, 'ESTU012'),
(31, 16, 'ESTU013'),
(32, 16, 'ESTU014'),
(35, 16, 'ESTU017'),
(36, 16, 'ESTU018'),
(37, 16, 'ESTU019'),
(38, 16, 'ESTU020');

-- --------------------------------------------------------

--
-- Table structure for table `tutores`
--

DROP TABLE IF EXISTS `tutores`;
CREATE TABLE IF NOT EXISTS `tutores` (
  `codigo` varchar(10) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `estado` enum('contratado','despedido','renuncia') NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `dui` (`dui`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tutores`
--

INSERT INTO `tutores` (`codigo`, `nombres`, `apellidos`, `dui`, `email`, `telefono`, `fecha_nacimiento`, `fecha_contratacion`, `estado`) VALUES
('TUTOR001', 'Carlos', 'Hernández', '01234567-8', 'carlos.hernandez@academia.com', '2222-3333', '1985-08-20', '2025-05-26', 'contratado'),
('TUTOR002', 'Tulio', 'Bodoque', '01234560-9', 'tulio.bodoque@academia.com', '2323-3232', '1975-12-24', '2025-06-25', 'contratado'),
('TUTOR003', 'Somi', 'Jeon', '01234510-8', 'somi.jeon@academia.com', '1212-2121', '2000-03-09', '2025-01-12', 'contratado'),
('TUTOR004', 'Isabella', 'Serpas', '01234210-7', 'isabella.serpas@academia.com', '3434-4343', '2005-08-06', '2025-02-10', 'contratado'),
('TUTOR005', 'Alexa', 'Rodríguez', '01233210-6', 'alexa.rodriguez@academia.com', '3939-9393', '2002-10-12', '2025-03-23', 'contratado');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` enum('administrador','tutor') NOT NULL,
  `codigo_tutor` varchar(10) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `codigo_tutor` (`codigo_tutor`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `rol`, `codigo_tutor`, `usuario`) VALUES
(5, 'tutor_user', '$2y$10$NUXOlWnwBXYSOg8w1WzD5.BB0GmGVbL.S0BnPccBrsDuqX2qdj09C', 'tutor', 'TUTOR001', ''),
(3, 'admin_user', '$2y$10$ODrjYUBcNx2y9JCX1fLCAeHetpB/PNi/4jOFTc4IAgk1bOvzWzypm', 'administrador', NULL, ''),
(6, 'Tulio', '$2y$10$jLGneMOk7AfVhKR4ziOauu000bjWD4UqNKeYgygsFYnZ.gj8hrlZa', 'tutor', 'TUTOR002', ''),
(7, 'Somi', '$2y$10$LmclGzAfzLpClTlMVBmPb.FoE6w/f8KxSB1b8zVUvfky6z1qEJsbu', 'tutor', 'TUTOR003', ''),
(8, 'Isabella', '$2y$10$cr7zxEXUFM.SNM3k4no4Q.ixNUmcJ9ZpcH58EbDd71TzLfviwKK5.', 'tutor', 'TUTOR004', ''),
(9, 'Alexa', '$2y$10$Vtrb3VHk.mgYklqPPjCWdeOsYjUw2XXwyYGVCVjHP24OCBLKtN/8K', 'tutor', 'TUTOR005', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

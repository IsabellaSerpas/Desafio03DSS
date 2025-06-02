-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2025 at 04:40 AM
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
  `codigo_estudiante` varchar(15) NOT NULL,
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
  `codigo_estudiante` varchar(15) NOT NULL,
  `codigo_tutor` varchar(10) NOT NULL,
  `tipo` enum('A','I','J') NOT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aspectos`
--

INSERT INTO `aspectos` (`id`, `descripcion`, `tipo`) VALUES
(1, 'Completa sus actividades con puntualidad', 'P'),
(2, 'Participa activamente en clase', 'P'),
(3, 'Plática en clase', 'L'),
(4, 'No trae materiales', 'L'),
(5, 'Falta de respeto al compañero', 'G'),
(6, 'Robo de pertenencias de compañeros', 'MG'),
(7, 'Vandalismo o daños graves al aula o mobiliario', 'MG');

-- --------------------------------------------------------

--
-- Table structure for table `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `codigo` varchar(15) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`codigo`, `nombres`, `apellidos`, `dui`, `email`, `telefono`, `fecha_nacimiento`, `fotografia`, `estado`) VALUES
('RF202501', 'Daniel Alejandro', 'Ruiz Fernández', '33333333-3', 'daniel.ruiz@email.com', '7333-3333', '2010-09-25', NULL, 'activo'),
('HC2025012', 'Sofía Gabriela', 'Hernández Castro', '44444444-4', 'sofia.hernandez@email.com', '7444-4444', '2011-12-02', NULL, 'activo'),
('AL202503', 'Feliciana Dani', 'Amaya Llopis', '95822412-1', 'feliciana.llopis@email.com', '6051-5506', '2011-06-10', NULL, 'activo'),
('CB202504', 'Jacinto Emilio', 'Calatayud Bonet', '42868828-3', 'jacinto.bonet@email.com', '6285-2679', '2012-11-28', NULL, 'activo'),
('AB202505', 'Telmo Amílcar', 'Andrés Bueno', '83197857-1', 'telmo.bueno@email.com', '7209-7912', '2011-04-30', NULL, 'activo'),
('AF202506', 'Joan Anselma', 'Amor Flor', '14265799-0', 'joan.flor@email.com', '6191-4582', '2013-02-28', NULL, 'activo'),
('RG202507', 'Judith Caridad', 'Rivas Giménez', '41227216-8', 'judith.giménez@email.com', '7232-1434', '2012-04-22', NULL, 'activo'),
('AC202508', 'Dolores Leopoldo', 'Agudo Cuervo', '85329037-3', 'dolores.cuervo@email.com', '7466-9928', '2013-05-14', NULL, 'activo'),
('LC202509', 'Telmo Noé', 'Lobo Cortés', '66306997-3', 'telmo.cortés@email.com', '6919-5557', '2011-04-25', NULL, 'activo'),
('CB202510', 'María Carmen Nicodemo', 'Calatayud Bru', '99810521-0', 'maría.bru@email.com', '6695-1098', '2011-05-19', NULL, 'activo'),
('GS202511', 'Adán Silvestre', 'García Suárez', '71932848-2', 'adán.suárez@email.com', '6230-2396', '2013-08-26', NULL, 'activo'),
('OA202512', 'Gabriela Encarna', 'Ortiz Alarcón', '44919424-0', 'gabriela.alarcón@email.com', '6824-3413', '2012-01-27', NULL, 'activo'),
('EO202513', 'Andrea Abelardo', 'Estévez Otero', '79203709-7', 'andrea.otero@email.com', '6483-6465', '2013-02-01', NULL, 'activo'),
('OF202514', 'Verónica Bartolomé', 'Ortega Fajardo', '82783783-5', 'verónica.fajardo@email.com', '7167-3370', '2011-04-06', NULL, 'activo'),
('RA202515', 'Vicente Antonio', 'Rey Antúnez', '65528748-0', 'vicente.antúnez@email.com', '7685-7801', '2013-06-21', NULL, 'activo'),
('RF202516', 'Candelaria Elías', 'Roig De la Fuente', '16932824-4', 'candelaria.fuente@email.com', '7438-7907', '2013-06-14', NULL, 'activo'),
('CA202517', 'Teodoro Damián', 'Cano Arroyo', '88044869-9', 'teodoro.arroyo@email.com', '6482-6633', '2012-09-25', NULL, 'activo'),
('AA202518', 'Susana Germán', 'Andrés Alcántara', '56423695-6', 'susana.alcántara@email.com', '7227-5683', '2012-09-10', NULL, 'activo'),
('AC202519', 'Elena Omar', 'Amaya Cuéllar', '20370050-6', 'elena.cuéllar@email.com', '6795-3589', '2011-05-01', NULL, 'activo'),
('AP202520', 'Dora Segundo', 'Aparicio Parra', '98518769-5', 'dora.parra@email.com', '6735-1790', '2013-10-01', NULL, 'activo'),
('BP202521', 'Dolores Arturo', 'Benítez Pardo', '84929094-5', 'dolores.pardo@email.com', '6847-8793', '2012-06-17', NULL, 'activo'),
('CC202522', 'Rafael Mateo', 'Collado Cuevas', '29821996-9', 'rafael.cuevas@email.com', '7390-1952', '2011-12-14', NULL, 'activo'),
('EA202523', 'Daniela Abelardo', 'Esteban Acosta', '72852118-6', 'daniela.acosta@email.com', '7174-3613', '2011-04-18', NULL, 'activo'),
('BC202524', 'Alejandro César', 'Benítez Cuesta', '30466739-1', 'alejandro.cuesta@email.com', '6401-9195', '2011-06-20', NULL, 'activo'),
('BE202525', 'Enrique Alba', 'Bravo Expósito', '70999211-7', 'enrique.expósito@email.com', '6955-1689', '2011-06-11', NULL, 'activo'),
('DB202526', 'Domingo Zacarías', 'Del Río Barragán', '61710123-4', 'domingo.barragán@email.com', '6761-6209', '2011-11-10', NULL, 'activo'),
('AF202527', 'Gonzalo Cristino', 'Amaya Franco', '41280281-7', 'gonzalo.franco@email.com', '6453-7412', '2012-06-17', NULL, 'activo'),
('CR202528', 'Álvaro Andrés', 'Campos Ríos', '87694750-6', 'álvaro.ríos@email.com', '6072-4330', '2013-01-25', NULL, 'activo'),
('GV202529', 'Concepción Leandro', 'Gil Villanueva', '32740429-2', 'concepción.villanueva@email.com', '6862-2221', '2013-10-13', NULL, 'activo'),
('AF202530', 'Milagros Pedro', 'Arias Ferrer', '78524349-2', 'milagros.ferrer@email.com', '6453-7775', '2013-01-14', NULL, 'activo'),
('BC202531', 'María Jesús Zacarías', 'Benítez Cano', '29249221-1', 'maría.cano@email.com', '6693-1967', '2013-02-26', NULL, 'activo'),
('HG202532', 'Sofía Andrés', 'Herrera García', '31605517-6', 'sofía.garcía@email.com', '6585-6646', '2012-08-12', NULL, 'activo'),
('FF202533', 'Teodoro Ángela', 'Fajardo Ferrer', '70130493-3', 'teodoro.ferrer@email.com', '7706-9970', '2011-12-04', NULL, 'activo'),
('MF202534', 'Consuelo Ángel', 'Marín Franco', '80069333-7', 'consuelo.franco@email.com', '6366-7762', '2011-07-23', NULL, 'activo'),
('RR202535', 'Luis Mario', 'Rubio Rivas', '22423621-5', 'luis.rivas@email.com', '6145-1796', '2011-11-11', NULL, 'activo'),
('CJ202536', 'Raquel Cruz', 'Carrasco Jurado', '32361576-3', 'raquel.jurado@email.com', '7260-8926', '2012-11-19', NULL, 'activo'),
('DG202537', 'Celia Jesús', 'Del Río Gracia', '78704314-6', 'celia.gracia@email.com', '7232-2011', '2012-06-11', NULL, 'activo'),
('MC202538', 'Jesús Francisco', 'Molina Cabrera', '96189418-3', 'jesús.cabrera@email.com', '7777-9407', '2012-12-09', NULL, 'activo'),
('OD202539', 'Noemí César', 'Ortega Díaz', '26816223-3', 'noemí.díaz@email.com', '6142-8816', '2012-11-24', NULL, 'activo'),
('EV202540', 'Rosario Jesús', 'Esteban Vera', '94621832-2', 'rosario.vera@email.com', '6676-5843', '2012-01-04', NULL, 'activo');

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo_tutor` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `codigo_tutor` (`codigo_tutor`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `codigo_tutor`) VALUES
(2, 'DSS', 'RC04'),
(3, 'DSS02', 'RT01');

-- --------------------------------------------------------

--
-- Table structure for table `grupo_estudiantes`
--

DROP TABLE IF EXISTS `grupo_estudiantes`;
CREATE TABLE IF NOT EXISTS `grupo_estudiantes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grupo_id` int NOT NULL,
  `codigo_estudiante` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `grupo_id` (`grupo_id`),
  KEY `codigo_estudiante` (`codigo_estudiante`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grupo_estudiantes`
--

INSERT INTO `grupo_estudiantes` (`id`, `grupo_id`, `codigo_estudiante`) VALUES
(40, 2, 'AC202508'),
(39, 2, 'RG202507'),
(38, 2, 'AF202506'),
(37, 2, 'AB202505'),
(36, 2, 'CB202504'),
(35, 2, 'AL202503'),
(34, 2, 'HC2025012'),
(33, 2, 'RF202501');

-- --------------------------------------------------------

--
-- Table structure for table `tutores`
--

DROP TABLE IF EXISTS `tutores`;
CREATE TABLE IF NOT EXISTS `tutores` (
  `codigo` varchar(10) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dui` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fecha_contratacion` date NOT NULL,
  `estado` enum('contratado','despedido','renuncia') DEFAULT 'contratado',
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tutores`
--

INSERT INTO `tutores` (`codigo`, `nombres`, `apellidos`, `dui`, `email`, `telefono`, `fecha_nacimiento`, `fecha_contratacion`, `estado`) VALUES
('RT01', 'Carlos Eduardo', 'Ramírez Torres', '34567890-2', 'carlos.ramirez@email.com', '7890-4321', '1982-06-10', '2024-02-10', 'contratado'),
('MG02', 'Elena Sofía', 'Martínez Gómez', '87654321-0', 'elena.martinez@email.com', '7890-8765', '1988-11-30', '2024-03-05', 'contratado'),
('MT03', 'Luis Fernando', 'Mendoza Torres', '54321678-9', 'luis.mendoza@email.com', '7452-2894', '1979-04-15', '2025-02-10', 'contratado'),
('RC04', 'Alejandro Javier', 'Ramírez Castillo', '67890543-2', 'alejandro.ramirez@email.com', '6850-1985', '1981-06-22', '2024-09-15', 'contratado'),
('FG05', 'Diego Esteban', 'Fernández Gómez', '89543267-1', 'diego.fernandez@email.com', '6194-2375', '1976-07-30', '2024-12-01', 'contratado');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` enum('admin','tutor') NOT NULL,
  `codigo_tutor` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `tipo`, `codigo_tutor`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL),
(2, 'RT01', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tutor', 'TUTOR01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

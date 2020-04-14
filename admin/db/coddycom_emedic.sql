-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2018 at 06:31 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coddycom_emedic`
--

-- --------------------------------------------------------

--
-- Table structure for table `alertas`
--

CREATE TABLE `alertas` (
  `id` int(100) NOT NULL,
  `id_paciente` int(100) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `motivo_cancelacion` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `leida` tinyint(100) NOT NULL DEFAULT '0',
  `fecha_cancelada` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `hora_cancelada` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_cita` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `alertas`
--

INSERT INTO `alertas` (`id`, `id_paciente`, `id_medico`, `motivo_cancelacion`, `leida`, `fecha_cancelada`, `hora_cancelada`, `id_cita`) VALUES
(1, 2, 0, '2', 0, '26-06-2018', '15:15', 0),
(2, 1, 0, '2', 0, '26-06-2018', '15:30', 0),
(3, 2, 0, '1', 0, '26-06-2018', '16:45', 0),
(4, 1, 0, '2', 0, '26-06-2018', '16:15', 9),
(5, 1, 3, '1', 1, '26-06-2018', '16:45', 10),
(6, 1, 3, '2', 0, '26-06-2018', '16:00', 11),
(7, 1, 3, '2', 0, '26-06-2018', '15:45', 12);

-- --------------------------------------------------------

--
-- Table structure for table `cat_comunas`
--

CREATE TABLE `cat_comunas` (
  `comuna_id` int(11) NOT NULL,
  `comuna_nombre` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cat_comunas`
--

INSERT INTO `cat_comunas` (`comuna_id`, `comuna_nombre`, `provincia_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 2),
(4, 'Putre', 2),
(5, 'Alto Hospicio', 3),
(6, 'Iquique', 3),
(7, 'Camiña', 4),
(8, 'Colchane', 4),
(9, 'Huara', 4),
(10, 'Pica', 4),
(11, 'Pozo Almonte', 4),
(12, 'Antofagasta', 5),
(13, 'Mejillones', 5),
(14, 'Sierra Gorda', 5),
(15, 'Taltal', 5),
(16, 'Calama', 6),
(17, 'Ollague', 6),
(18, 'San Pedro de Atacama', 6),
(19, 'María Elena', 7),
(20, 'Tocopilla', 7),
(21, 'Chañaral', 8),
(22, 'Diego de Almagro', 8),
(23, 'Caldera', 9),
(24, 'Copiapó', 9),
(25, 'Tierra Amarilla', 9),
(26, 'Alto del Carmen', 10),
(27, 'Freirina', 10),
(28, 'Huasco', 10),
(29, 'Vallenar', 10),
(30, 'Canela', 11),
(31, 'Illapel', 11),
(32, 'Los Vilos', 11),
(33, 'Salamanca', 11),
(34, 'Andacollo', 12),
(35, 'Coquimbo', 12),
(36, 'La Higuera', 12),
(37, 'La Serena', 12),
(38, 'Paihuaco', 12),
(39, 'Vicuña', 12),
(40, 'Combarbalá', 13),
(41, 'Monte Patria', 13),
(42, 'Ovalle', 13),
(43, 'Punitaqui', 13),
(44, 'Río Hurtado', 13),
(45, 'Isla de Pascua', 14),
(46, 'Calle Larga', 15),
(47, 'Los Andes', 15),
(48, 'Rinconada', 15),
(49, 'San Esteban', 15),
(50, 'La Ligua', 16),
(51, 'Papudo', 16),
(52, 'Petorca', 16),
(53, 'Zapallar', 16),
(54, 'Hijuelas', 17),
(55, 'La Calera', 17),
(56, 'La Cruz', 17),
(57, 'Limache', 17),
(58, 'Nogales', 17),
(59, 'Olmué', 17),
(60, 'Quillota', 17),
(61, 'Algarrobo', 18),
(62, 'Cartagena', 18),
(63, 'El Quisco', 18),
(64, 'El Tabo', 18),
(65, 'San Antonio', 18),
(66, 'Santo Domingo', 18),
(67, 'Catemu', 19),
(68, 'Llaillay', 19),
(69, 'Panquehue', 19),
(70, 'Putaendo', 19),
(71, 'San Felipe', 19),
(72, 'Santa María', 19),
(73, 'Casablanca', 20),
(74, 'Concón', 20),
(75, 'Juan Fernández', 20),
(76, 'Puchuncaví', 20),
(77, 'Quilpué', 20),
(78, 'Quintero', 20),
(79, 'Valparaíso', 20),
(80, 'Villa Alemana', 20),
(81, 'Viña del Mar', 20),
(82, 'Colina', 21),
(83, 'Lampa', 21),
(84, 'Tiltil', 21),
(85, 'Pirque', 22),
(86, 'Puente Alto', 22),
(87, 'San José de Maipo', 22),
(88, 'Buin', 23),
(89, 'Calera de Tango', 23),
(90, 'Paine', 23),
(91, 'San Bernardo', 23),
(92, 'Alhué', 24),
(93, 'Curacaví', 24),
(94, 'María Pinto', 24),
(95, 'Melipilla', 24),
(96, 'San Pedro', 24),
(97, 'Cerrillos', 25),
(98, 'Cerro Navia', 25),
(99, 'Conchalí', 25),
(100, 'El Bosque', 25),
(101, 'Estación Central', 25),
(102, 'Huechuraba', 25),
(103, 'Independencia', 25),
(104, 'La Cisterna', 25),
(105, 'La Granja', 25),
(106, 'La Florida', 25),
(107, 'La Pintana', 25),
(108, 'La Reina', 25),
(109, 'Las Condes', 25),
(110, 'Lo Barnechea', 25),
(111, 'Lo Espejo', 25),
(112, 'Lo Prado', 25),
(113, 'Macul', 25),
(114, 'Maipú', 25),
(115, 'Ñuñoa', 25),
(116, 'Pedro Aguirre Cerda', 25),
(117, 'Peñalolén', 25),
(118, 'Providencia', 25),
(119, 'Pudahuel', 25),
(120, 'Quilicura', 25),
(121, 'Quinta Normal', 25),
(122, 'Recoleta', 25),
(123, 'Renca', 25),
(124, 'San Miguel', 25),
(125, 'San Joaquín', 25),
(126, 'San Ramón', 25),
(127, 'Santiago', 25),
(128, 'Vitacura', 25),
(129, 'El Monte', 26),
(130, 'Isla de Maipo', 26),
(131, 'Padre Hurtado', 26),
(132, 'Peñaflor', 26),
(133, 'Talagante', 26),
(134, 'Codegua', 27),
(135, 'Coínco', 27),
(136, 'Coltauco', 27),
(137, 'Doñihue', 27),
(138, 'Graneros', 27),
(139, 'Las Cabras', 27),
(140, 'Machalí', 27),
(141, 'Malloa', 27),
(142, 'Mostazal', 27),
(143, 'Olivar', 27),
(144, 'Peumo', 27),
(145, 'Pichidegua', 27),
(146, 'Quinta de Tilcoco', 27),
(147, 'Rancagua', 27),
(148, 'Rengo', 27),
(149, 'Requínoa', 27),
(150, 'San Vicente de Tagua Tagua', 27),
(151, 'La Estrella', 28),
(152, 'Litueche', 28),
(153, 'Marchihue', 28),
(154, 'Navidad', 28),
(155, 'Peredones', 28),
(156, 'Pichilemu', 28),
(157, 'Chépica', 29),
(158, 'Chimbarongo', 29),
(159, 'Lolol', 29),
(160, 'Nancagua', 29),
(161, 'Palmilla', 29),
(162, 'Peralillo', 29),
(163, 'Placilla', 29),
(164, 'Pumanque', 29),
(165, 'San Fernando', 29),
(166, 'Santa Cruz', 29),
(167, 'Cauquenes', 30),
(168, 'Chanco', 30),
(169, 'Pelluhue', 30),
(170, 'Curicó', 31),
(171, 'Hualañé', 31),
(172, 'Licantén', 31),
(173, 'Molina', 31),
(174, 'Rauco', 31),
(175, 'Romeral', 31),
(176, 'Sagrada Familia', 31),
(177, 'Teno', 31),
(178, 'Vichuquén', 31),
(179, 'Colbún', 32),
(180, 'Linares', 32),
(181, 'Longaví', 32),
(182, 'Parral', 32),
(183, 'Retiro', 32),
(184, 'San Javier', 32),
(185, 'Villa Alegre', 32),
(186, 'Yerbas Buenas', 32),
(187, 'Constitución', 33),
(188, 'Curepto', 33),
(189, 'Empedrado', 33),
(190, 'Maule', 33),
(191, 'Pelarco', 33),
(192, 'Pencahue', 33),
(193, 'Río Claro', 33),
(194, 'San Clemente', 33),
(195, 'San Rafael', 33),
(196, 'Talca', 33),
(197, 'Arauco', 34),
(198, 'Cañete', 34),
(199, 'Contulmo', 34),
(200, 'Curanilahue', 34),
(201, 'Lebu', 34),
(202, 'Los Álamos', 34),
(203, 'Tirúa', 34),
(204, 'Alto Biobío', 35),
(205, 'Antuco', 35),
(206, 'Cabrero', 35),
(207, 'Laja', 35),
(208, 'Los Ángeles', 35),
(209, 'Mulchén', 35),
(210, 'Nacimiento', 35),
(211, 'Negrete', 35),
(212, 'Quilaco', 35),
(213, 'Quilleco', 35),
(214, 'San Rosendo', 35),
(215, 'Santa Bárbara', 35),
(216, 'Tucapel', 35),
(217, 'Yumbel', 35),
(218, 'Chiguayante', 36),
(219, 'Concepción', 36),
(220, 'Coronel', 36),
(221, 'Florida', 36),
(222, 'Hualpén', 36),
(223, 'Hualqui', 36),
(224, 'Lota', 36),
(225, 'Penco', 36),
(226, 'San Pedro de La Paz', 36),
(227, 'Santa Juana', 36),
(228, 'Talcahuano', 36),
(229, 'Tomé', 36),
(230, 'Bulnes', 37),
(231, 'Chillán', 37),
(232, 'Chillán Viejo', 37),
(233, 'Cobquecura', 37),
(234, 'Coelemu', 37),
(235, 'Coihueco', 37),
(236, 'El Carmen', 37),
(237, 'Ninhue', 37),
(238, 'Ñiquen', 37),
(239, 'Pemuco', 37),
(240, 'Pinto', 37),
(241, 'Portezuelo', 37),
(242, 'Quillón', 37),
(243, 'Quirihue', 37),
(244, 'Ránquil', 37),
(245, 'San Carlos', 37),
(246, 'San Fabián', 37),
(247, 'San Ignacio', 37),
(248, 'San Nicolás', 37),
(249, 'Treguaco', 37),
(250, 'Yungay', 37),
(251, 'Carahue', 38),
(252, 'Cholchol', 38),
(253, 'Cunco', 38),
(254, 'Curarrehue', 38),
(255, 'Freire', 38),
(256, 'Galvarino', 38),
(257, 'Gorbea', 38),
(258, 'Lautaro', 38),
(259, 'Loncoche', 38),
(260, 'Melipeuco', 38),
(261, 'Nueva Imperial', 38),
(262, 'Padre Las Casas', 38),
(263, 'Perquenco', 38),
(264, 'Pitrufquén', 38),
(265, 'Pucón', 38),
(266, 'Saavedra', 38),
(267, 'Temuco', 38),
(268, 'Teodoro Schmidt', 38),
(269, 'Toltén', 38),
(270, 'Vilcún', 38),
(271, 'Villarrica', 38),
(272, 'Angol', 39),
(273, 'Collipulli', 39),
(274, 'Curacautín', 39),
(275, 'Ercilla', 39),
(276, 'Lonquimay', 39),
(277, 'Los Sauces', 39),
(278, 'Lumaco', 39),
(279, 'Purén', 39),
(280, 'Renaico', 39),
(281, 'Traiguén', 39),
(282, 'Victoria', 39),
(283, 'Corral', 40),
(284, 'Lanco', 40),
(285, 'Los Lagos', 40),
(286, 'Máfil', 40),
(287, 'Mariquina', 40),
(288, 'Paillaco', 40),
(289, 'Panguipulli', 40),
(290, 'Valdivia', 40),
(291, 'Futrono', 41),
(292, 'La Unión', 41),
(293, 'Lago Ranco', 41),
(294, 'Río Bueno', 41),
(295, 'Ancud', 42),
(296, 'Castro', 42),
(297, 'Chonchi', 42),
(298, 'Curaco de Vélez', 42),
(299, 'Dalcahue', 42),
(300, 'Puqueldón', 42),
(301, 'Queilén', 42),
(302, 'Quemchi', 42),
(303, 'Quellón', 42),
(304, 'Quinchao', 42),
(305, 'Calbuco', 43),
(306, 'Cochamó', 43),
(307, 'Fresia', 43),
(308, 'Frutillar', 43),
(309, 'Llanquihue', 43),
(310, 'Los Muermos', 43),
(311, 'Maullín', 43),
(312, 'Puerto Montt', 43),
(313, 'Puerto Varas', 43),
(314, 'Osorno', 44),
(315, 'Puero Octay', 44),
(316, 'Purranque', 44),
(317, 'Puyehue', 44),
(318, 'Río Negro', 44),
(319, 'San Juan de la Costa', 44),
(320, 'San Pablo', 44),
(321, 'Chaitén', 45),
(322, 'Futaleufú', 45),
(323, 'Hualaihué', 45),
(324, 'Palena', 45),
(325, 'Aisén', 46),
(326, 'Cisnes', 46),
(327, 'Guaitecas', 46),
(328, 'Cochrane', 47),
(329, 'O\'higgins', 47),
(330, 'Tortel', 47),
(331, 'Coihaique', 48),
(332, 'Lago Verde', 48),
(333, 'Chile Chico', 49),
(334, 'Río Ibáñez', 49),
(335, 'Antártica', 50),
(336, 'Cabo de Hornos', 50),
(337, 'Laguna Blanca', 51),
(338, 'Punta Arenas', 51),
(339, 'Río Verde', 51),
(340, 'San Gregorio', 51),
(341, 'Porvenir', 52),
(342, 'Primavera', 52),
(343, 'Timaukel', 52),
(344, 'Natales', 53),
(345, 'Torres del Paine', 53);

-- --------------------------------------------------------

--
-- Table structure for table `cat_medicinas`
--

CREATE TABLE `cat_medicinas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(25) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `nombre_fisticio` varchar(255) DEFAULT NULL,
  `concentracion` varchar(30) DEFAULT NULL,
  `via_admon` varchar(50) DEFAULT NULL,
  `presentacion` varchar(50) DEFAULT NULL,
  `restriccion` int(11) NOT NULL,
  `estado` int(2) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_medicinas`
--

INSERT INTO `cat_medicinas` (`id`, `codigo`, `nombre`, `nombre_fisticio`, `concentracion`, `via_admon`, `presentacion`, `restriccion`, `estado`, `id_clinica`) VALUES
(1, '70710', 'ZIAGEN', 'Abacavir', '200mg', 'Oral', 'Tabletas', 0, 1, 1),
(2, '99326', 'Bencilpenicilina', 'Bencilpenicilina G cristalina', '100mg', 'Oral', 'capsula', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_modulos`
--

CREATE TABLE `cat_modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_modulos`
--

INSERT INTO `cat_modulos` (`id`, `modulo`) VALUES
(1, 'Inicio'),
(2, 'Pacientes'),
(3, 'Citas'),
(4, 'Medicamentos'),
(5, 'Reportes'),
(6, 'Configuracion'),
(8, 'Permisos'),
(9, 'Usuarios'),
(10, 'Prueba');

-- --------------------------------------------------------

--
-- Table structure for table `cat_previsiones`
--

CREATE TABLE `cat_previsiones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_clinica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cat_previsiones`
--

INSERT INTO `cat_previsiones` (`id`, `nombre`, `estado`, `id_clinica`) VALUES
(1, 'Banmedica', 1, 1),
(2, 'Colmena', 1, 1),
(3, 'Colsalud', 1, 1),
(4, 'Cruz del norte', 1, 1),
(5, 'Cruz blanca', 1, 1),
(6, 'Fonasa', 1, 1),
(7, 'Fusad', 1, 1),
(8, 'ING', 1, 1),
(9, 'Isapre de chle', 1, 1),
(10, 'Nueva mas vida', 1, 1),
(11, 'Rio blanco', 1, 1),
(12, 'Vida 3', 1, 1),
(13, 'Isapre Fundacion', 1, 1),
(14, 'Dipreca', 1, 1),
(15, 'Particular', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_provincias`
--

CREATE TABLE `cat_provincias` (
  `provincia_id` int(11) NOT NULL,
  `provincia_nombre` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cat_provincias`
--

INSERT INTO `cat_provincias` (`provincia_id`, `provincia_nombre`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Parinacota', 1),
(3, 'Iquique', 2),
(4, 'El Tamarugal', 2),
(5, 'Antofagasta', 3),
(6, 'El Loa', 3),
(7, 'Tocopilla', 3),
(8, 'Chañaral', 4),
(9, 'Copiapó', 4),
(10, 'Huasco', 4),
(11, 'Choapa', 5),
(12, 'Elqui', 5),
(13, 'Limarí', 5),
(14, 'Isla de Pascua', 6),
(15, 'Los Andes', 6),
(16, 'Petorca', 6),
(17, 'Quillota', 6),
(18, 'San Antonio', 6),
(19, 'San Felipe de Aconcagua', 6),
(20, 'Valparaiso', 6),
(21, 'Chacabuco', 7),
(22, 'Cordillera', 7),
(23, 'Maipo', 7),
(24, 'Melipilla', 7),
(25, 'Santiago', 7),
(26, 'Talagante', 7),
(27, 'Cachapoal', 8),
(28, 'Cardenal Caro', 8),
(29, 'Colchagua', 8),
(30, 'Cauquenes', 9),
(31, 'Curicó', 9),
(32, 'Linares', 9),
(33, 'Talca', 9),
(34, 'Arauco', 10),
(35, 'Bio Bío', 10),
(36, 'Concepción', 10),
(37, 'Ñuble', 10),
(38, 'Cautín', 11),
(39, 'Malleco', 11),
(40, 'Valdivia', 12),
(41, 'Ranco', 12),
(42, 'Chiloé', 13),
(43, 'Llanquihue', 13),
(44, 'Osorno', 13),
(45, 'Palena', 13),
(46, 'Aisén', 14),
(47, 'Capitán Prat', 14),
(48, 'Coihaique', 14),
(49, 'General Carrera', 14),
(50, 'Antártica Chilena', 15),
(51, 'Magallanes', 15),
(52, 'Tierra del Fuego', 15),
(53, 'Última Esperanza', 15);

-- --------------------------------------------------------

--
-- Table structure for table `cat_regiones`
--

CREATE TABLE `cat_regiones` (
  `region_id` int(11) NOT NULL,
  `region_nombre` varchar(64) NOT NULL,
  `region_ordinal` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cat_regiones`
--

INSERT INTO `cat_regiones` (`region_id`, `region_nombre`, `region_ordinal`) VALUES
(1, 'Arica y Parinacota', 'XV'),
(2, 'Tarapacá', 'I'),
(3, 'Antofagasta', 'II'),
(4, 'Atacama', 'III'),
(5, 'Coquimbo', 'IV'),
(6, 'Valparaiso', 'V'),
(7, 'Metropolitana de Santiago', 'RM'),
(8, 'Libertador General Bernardo O\'Higgins', 'VI'),
(9, 'Maule', 'VII'),
(10, 'Biobío', 'VIII'),
(11, 'La Araucanía', 'IX'),
(12, 'Los Ríos', 'XIV'),
(13, 'Los Lagos', 'X'),
(14, 'Aisén del General Carlos Ibáñez del Campo', 'XI'),
(15, 'Magallanes y de la Antártica Chilena', 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `to` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `message` text COLLATE utf8_spanish_ci NOT NULL,
  `sent` datetime DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `from_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `to_name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `from_foto` text COLLATE utf8_spanish_ci NOT NULL,
  `to_foto` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`, `from_name`, `to_name`, `from_foto`, `to_foto`) VALUES
(1, '3', '1', 'Test', '2018-06-26 14:32:03', 1, 'medico', 'admin', 'img/users/icon.png', 'img/users/admin.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `id_medico` int(10) NOT NULL,
  `rut_paciente` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_prestacion` int(11) NOT NULL,
  `fecha` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `hora` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `pagado` int(10) NOT NULL,
  `comentario` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `cancelada` tinyint(10) NOT NULL DEFAULT '0',
  `pendiente` tinyint(10) NOT NULL DEFAULT '0',
  `finalizada` tinyint(11) DEFAULT NULL,
  `espera` tinyint(11) DEFAULT NULL,
  `consulta` tinyint(11) DEFAULT NULL,
  `espera_examen` int(1) NOT NULL,
  `id_clinica` int(11) DEFAULT NULL,
  `tipo` enum('sobrecupo','normal') COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id`, `id_medico`, `rut_paciente`, `id_prestacion`, `fecha`, `hora`, `pagado`, `comentario`, `observacion`, `cancelada`, `pendiente`, `finalizada`, `espera`, `consulta`, `espera_examen`, `id_clinica`, `tipo`) VALUES
(1, 3, '14.234.456-a', 2, '20-07-2018', '13:00', 0, 'dolor de estomago', '', 0, 0, 0, 0, 1, 0, 1, 'normal'),
(2, 3, '14.234.456-a', 2, '20-07-2018', '14:00', 0, 'test', '', 0, 0, 1, 0, 0, 0, 1, 'normal'),
(3, 3, '14.234.456-a', 2, '20-07-2018', '15:15', 0, 'tes 2', 'eerferff', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(4, 3, '14.234.456-a', 2, '20-07-2018', '16:45', 0, 'xsdxsdx', 'Avisó por la mañana', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(5, 3, '35.258.456-b', 2, '20-07-2018', '15:30', 0, 'dolor de muelas', 'erferf', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(6, 3, '14.234.456-a', 2, '20-07-2018', '16:00', 0, 'test', 'sdcsdc', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(7, 3, '35.258.456-b', 2, '20-07-2018', '16:00', 0, 'sdcsdc', 'sdcsdc', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(8, 3, '35.258.456-b', 2, '20-07-2018', '16:00', 0, 'sdcsdc', 'sdcsdc', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(9, 3, '35.258.456-b', 2, '20-07-2018', '16:15', 0, 'sdcsdcsdc', 'sdcsdc', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(10, 3, '35.258.456-b', 2, '20-07-2018', '16:45', 0, 'sdcscsdc', 'sdcsdc', 1, 0, 0, 0, 0, 0, 1, 'normal'),
(11, 3, '35.258.456-b', 2, '20-07-2018', '16:00', 0, 'ascascasc', '', 0, 1, 0, 0, 0, 0, 1, 'normal'),
(12, 3, '14.234.456-a', 2, '20-07-2018', '15:45', 0, 'wdwde', '', 0, 1, 0, 0, 0, 1, 1, 'normal'),
(20, 0, '14.234.456-a', 3, '05-07-2018', '08:30', 1, 'sin', 'sin', 0, 1, 0, 0, 0, 0, 1, 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `citas_archivos`
--

CREATE TABLE `citas_archivos` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `descripcion` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citas_archivos`
--

INSERT INTO `citas_archivos` (`id`, `id_cita`, `nombre`, `documento`, `fecha`, `descripcion`) VALUES
(35, 1, 'sdcsdc', 'havier-garcia.jpg', '2018-06-26 05:00:00', 'sdcsdc');

-- --------------------------------------------------------

--
-- Table structure for table `citas_consultas`
--

CREATE TABLE `citas_consultas` (
  `id` int(11) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `anamnesis` text,
  `examen_fisico` text,
  `diagnostico` text,
  `indicaciones` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citas_consultas`
--

INSERT INTO `citas_consultas` (`id`, `id_cita`, `anamnesis`, `examen_fisico`, `diagnostico`, `indicaciones`) VALUES
(1, 2, 'asxasx', 'saxasx', 'asxasx', 'asxasx'),
(2, 1, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `citas_recetas`
--

CREATE TABLE `citas_recetas` (
  `id` int(11) NOT NULL,
  `id_medicamento` text,
  `id_cita` int(11) DEFAULT NULL,
  `cantidad` text NOT NULL,
  `indicaciones` text,
  `resultados` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citas_recetas`
--

INSERT INTO `citas_recetas` (`id`, `id_medicamento`, `id_cita`, `cantidad`, `indicaciones`, `resultados`) VALUES
(1, '6 | 1 | ', 2, 'TOTAL 1 UNIDAD | TOTAL 1 UNIDAD | ', 'tomar 1 cada 6 horas | sdcsdcsdc | ', ''),
(2, '1 | ', 3, 'TOTAL 1 UNIDAD | ', 'tomar una cada 8 horas | ', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `ip_address` varchar(45) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('a3k8oipjumo4svvrup26fvk9c6d61vqs', '::1', 1515703314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531353730333331313b617574656e74696361646f7c613a343a7b733a373a22757365725f6964223b733a313a2238223b733a383a22757365726e616d65223b733a353a224c55564953223b733a353a226c6f67696e223b623a313b733a383a2269645f677275706f223b733a313a2232223b7d),
('2l7vluhkuh43cdtptjggsf40fdkgl39d', '::1', 1515703356, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531353730333335313b),
('8vr4o27np3eau51h61b5bn9g68ic04b6', '::1', 1515703370, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531353730333336393b617574656e74696361646f7c613a343a7b733a373a22757365725f6964223b733a313a2238223b733a383a22757365726e616d65223b733a353a224c55564953223b733a353a226c6f67696e223b623a313b733a383a2269645f677275706f223b733a313a2232223b7d),
('qifut79u8hn358gad3qdqejo18594p3q', '::1', 1515703372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531353730333337323b),
('fa13a87522ca4b18523426b58aefdcef05beb908', '::1', 1516383730, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531363338333732393b63686174486973746f72797c613a303a7b7d6f70656e43686174426f7865737c613a303a7b7d757365726e616d657c4e3b757365725f69647c4e3b);

-- --------------------------------------------------------

--
-- Table structure for table `clinicas`
--

CREATE TABLE `clinicas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `fax` varchar(26) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `tenant` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `comuna` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `providencia` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinicas`
--

INSERT INTO `clinicas` (`id`, `nombre`, `telefono`, `fax`, `direccion`, `correo`, `tenant`, `region`, `comuna`, `ciudad`, `providencia`) VALUES
(1, 'Clinica 1', '3121832720', '58454', 'chile', 'clinica@gmail.com', 'chol132', 'Tarapaca', 'Ovalle', 'Santiago', 'CHILE');

-- --------------------------------------------------------

--
-- Table structure for table `clinica_paciente`
--

CREATE TABLE `clinica_paciente` (
  `id` int(11) NOT NULL,
  `id_pacientes` int(11) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinica_paciente`
--

INSERT INTO `clinica_paciente` (`id`, `id_pacientes`, `id_clinica`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clinica_users`
--

CREATE TABLE `clinica_users` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clinica_users`
--

INSERT INTO `clinica_users` (`id`, `id_user`, `id_clinica`) VALUES
(8, 3, 1),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `depositos`
--

CREATE TABLE `depositos` (
  `id` int(24) NOT NULL,
  `id_cita` int(11) DEFAULT NULL,
  `deposito` float(20,0) DEFAULT NULL,
  `resto` float(20,0) DEFAULT NULL,
  `tipo` text,
  `no_documento` text NOT NULL,
  `comentario` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tabla de depositos ';

--
-- Dumping data for table `depositos`
--

INSERT INTO `depositos` (`id`, `id_cita`, `deposito`, `resto`, `tipo`, `no_documento`, `comentario`) VALUES
(42, 11, 200, 900, 'Bono', '124234234', 'test 2'),
(41, 11, 300, 1100, 'Efectivo', '', ''),
(40, 11, 200, 1400, 'Cheque', '1231431241', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `doctoresprestaciones`
--

CREATE TABLE `doctoresprestaciones` (
  `id` int(11) NOT NULL,
  `id_medico` int(100) NOT NULL,
  `id_prestacion` int(100) NOT NULL,
  `is_default` tinyint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `doctoresprestaciones`
--

INSERT INTO `doctoresprestaciones` (`id`, `id_medico`, `id_prestacion`, `is_default`) VALUES
(1, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grupo_usuarios`
--

CREATE TABLE `grupo_usuarios` (
  `id` int(11) NOT NULL,
  `nombre_grupo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `f_act` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `grupo_usuarios`
--

INSERT INTO `grupo_usuarios` (`id`, `nombre_grupo`, `activo`, `f_act`) VALUES
(1, 'Doctor@s', 1, '2018-01-09 16:51:48'),
(2, 'Secretari@s', 1, '2018-01-09 16:51:48'),
(3, 'Administrador', 1, '2018-01-09 16:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `descanzo_semana` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora_inicio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora_fin` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `id_medico`, `descanzo_semana`, `hora_inicio`, `hora_fin`) VALUES
(1, 1, 'Ju,', '09:00:00', '16:00:00'),
(2, 8, 'Sa,Do,', '14:00:00', '19:00:00'),
(3, 10, 'Lu,Mi,Vi,', '05:00:00', '18:00:00'),
(4, 3, NULL, '06:00:00', '19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `motivos_cancelacion`
--

CREATE TABLE `motivos_cancelacion` (
  `id` int(100) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `genera_alerta` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `motivos_cancelacion`
--

INSERT INTO `motivos_cancelacion` (`id`, `nombre`, `genera_alerta`) VALUES
(1, 'Emergencia', 0),
(2, 'Cancelacion sin avisar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `rut_otro` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_paterno` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_materno` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `prevision` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `profesion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `comuna` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `region` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'member_1.jpg',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `id_clinica` int(11) DEFAULT NULL,
  `isapre` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `rut_otro`, `nombre`, `apellido_paterno`, `apellido_materno`, `direccion`, `celular`, `telefono`, `email`, `sexo`, `prevision`, `fecha_nacimiento`, `profesion`, `comuna`, `region`, `provincia`, `ciudad`, `foto`, `fecha_creacion`, `fecha_modificacion`, `id_usr_creo`, `id_usr_modifico`, `activo`, `id_clinica`, `isapre`, `token`) VALUES
(1, '35.258.456-b', 'Luis', 'Cobian', 'Cobian', 'Nuevo León #34', '312183755', '1590791', 'lcobianh@gmail.com', 'Masculino', '1', '1991-06-15', 'vdfvdfv', 'Cartagena', 'Valparaiso', 'San Antonio', 'Colima', 'member_1.jpg', '2018-05-03 00:00:00', '2018-06-25 00:00:00', NULL, 2, 0, 1, 'cocos', 'dOUY0i4E'),
(2, '14.234.456-a', 'Pedro', 'Fernández', 'Palominos', 'Circuito Meteroro #1322', '3125938192', '3125938192', 'pfernandezp91@gmail.com', 'Masculino', '3', '1991-07-05', 'Ing. Software', 'Cartagena', 'Valparaiso', 'San Antonio', 'Colima', 'member_1.jpg', '2018-05-04 00:00:00', '2018-05-21 00:00:00', 2, 2, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pagos`
--

CREATE TABLE `pagos` (
  `id` int(100) NOT NULL,
  `id_cita` int(100) NOT NULL,
  `monto` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `resto` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `pagos`
--

INSERT INTO `pagos` (`id`, `id_cita`, `monto`, `resto`, `tipo`, `comentario`) VALUES
(1, 11, '1600', '0', 'Efectivo', '');

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `grupo_usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `is_visualiza` tinyint(4) NOT NULL DEFAULT '0',
  `is_edita` tinyint(4) NOT NULL DEFAULT '0',
  `is_elimina` tinyint(4) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `is_crear` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id`, `modulo`, `grupo_usuario`, `is_visualiza`, `is_edita`, `is_elimina`, `activo`, `is_crear`) VALUES
(220, 'Inicio', '1', 0, 1, 0, 1, 1),
(221, 'Pacientes', '2', 0, 1, 0, 1, 1),
(222, 'Usuarios', '4', 0, 1, 0, 1, 1),
(223, 'Clinicas', '0', 0, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prestaciones`
--

CREATE TABLE `prestaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `costo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `prestaciones`
--

INSERT INTO `prestaciones` (`id`, `nombre`, `costo`) VALUES
(1, 'Consulta Dermatológica', '1500'),
(2, 'Consulta Pediatrica', '1600'),
(3, 'Consulta Dental', '1450'),
(4, 'Consulta Pre-Quirurgica', '1230'),
(5, 'Consulta pre-natal', '1250'),
(6, 'Consulta Testing', '560'),
(10, 'test', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `status_citas`
--

CREATE TABLE `status_citas` (
  `id` int(11) NOT NULL,
  `status` varchar(23) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_citas`
--

INSERT INTO `status_citas` (`id`, `status`) VALUES
(1, 'Pagada'),
(2, 'No pagada');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_paterno` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_materno` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `rut` text COLLATE utf8_spanish_ci NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'icon1.png',
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `activo` int(2) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `usuario`, `rut`, `id_grupo`, `email`, `contrasena`, `foto`, `fecha_creacion`, `fecha_modificacion`, `activo`, `id_clinica`) VALUES
(1, 'Administrador', '', '', 'admin', '00.000.000.a', 3, 'administrador@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin.jpg', '2017-10-03 00:00:00', NULL, 1, 1),
(2, 'Alma Delia', 'Hernández', 'Luna', 'secretaria', '12.517.576.b', 2, 'secre@hotmail.com', '25d55ad283aa400af464c76d713c07ad', 'icon1.png', NULL, NULL, 1, 1),
(3, 'Jose Luis', 'Ramos', 'De la mora', 'medico', '08.740.123.c', 1, 'medico@hotmail.com', '25d55ad283aa400af464c76d713c07ad', 'icon.png', NULL, NULL, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_comunas`
--
ALTER TABLE `cat_comunas`
  ADD PRIMARY KEY (`comuna_id`);

--
-- Indexes for table `cat_medicinas`
--
ALTER TABLE `cat_medicinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_modulos`
--
ALTER TABLE `cat_modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_previsiones`
--
ALTER TABLE `cat_previsiones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_provincias`
--
ALTER TABLE `cat_provincias`
  ADD PRIMARY KEY (`provincia_id`);

--
-- Indexes for table `cat_regiones`
--
ALTER TABLE `cat_regiones`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to` (`to`),
  ADD KEY `from` (`from`);

--
-- Indexes for table `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citas_archivos`
--
ALTER TABLE `citas_archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citas_consultas`
--
ALTER TABLE `citas_consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citas_recetas`
--
ALTER TABLE `citas_recetas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `clinicas`
--
ALTER TABLE `clinicas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinica_paciente`
--
ALTER TABLE `clinica_paciente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clinica_users`
--
ALTER TABLE `clinica_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctoresprestaciones`
--
ALTER TABLE `doctoresprestaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motivos_cancelacion`
--
ALTER TABLE `motivos_cancelacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestaciones`
--
ALTER TABLE `prestaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_citas`
--
ALTER TABLE `status_citas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cat_comunas`
--
ALTER TABLE `cat_comunas`
  MODIFY `comuna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `cat_medicinas`
--
ALTER TABLE `cat_medicinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cat_modulos`
--
ALTER TABLE `cat_modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cat_previsiones`
--
ALTER TABLE `cat_previsiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cat_provincias`
--
ALTER TABLE `cat_provincias`
  MODIFY `provincia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `cat_regiones`
--
ALTER TABLE `cat_regiones`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `citas_archivos`
--
ALTER TABLE `citas_archivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `citas_consultas`
--
ALTER TABLE `citas_consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `citas_recetas`
--
ALTER TABLE `citas_recetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinicas`
--
ALTER TABLE `clinicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clinica_paciente`
--
ALTER TABLE `clinica_paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clinica_users`
--
ALTER TABLE `clinica_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `doctoresprestaciones`
--
ALTER TABLE `doctoresprestaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `grupo_usuarios`
--
ALTER TABLE `grupo_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `motivos_cancelacion`
--
ALTER TABLE `motivos_cancelacion`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `prestaciones`
--
ALTER TABLE `prestaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status_citas`
--
ALTER TABLE `status_citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

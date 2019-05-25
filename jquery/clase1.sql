-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2017 a las 03:27:07
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clase1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `idpais` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `idpais`, `nombre`) VALUES
(1, 1, 'Ciudad1'),
(2, 1, 'Ciudad12'),
(3, 2, 'Ciudad21'),
(4, 2, 'Ciudad22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'AUSTRIA'),
(2, 'BELGICA'),
(3, 'BULGARIA'),
(4, 'CHIPRE'),
(5, 'DINAMARCA'),
(6, 'ESPA?A'),
(7, 'FINLANDIA'),
(8, 'FRANCIA'),
(9, 'GRECIA'),
(10, 'HUNGRIA'),
(11, 'IRLANDA'),
(12, 'ITALIA'),
(13, 'LUXEMBURGO'),
(14, 'MALTA'),
(15, 'PAISES BAJOS'),
(16, 'POLONIA'),
(17, 'PORTUGAL'),
(18, 'REINO UNIDO'),
(19, 'ALEMANIA'),
(20, 'RUMANIA'),
(21, 'SUECIA'),
(22, 'LETONIA'),
(23, 'ESTONIA'),
(24, 'LITUANIA'),
(25, 'REPUBLICA CHECA'),
(26, 'REPUBLICA ESLOVACA'),
(27, 'ESLOVENIA'),
(28, 'OTROS PAISES O TERRITORIOS DE LA UNION EUROPEA'),
(29, 'ALBANIA'),
(30, 'ISLANDIA'),
(31, 'LIECHTENSTEIN'),
(32, 'MONACO'),
(33, 'NORUEGA'),
(34, 'ANDORRA'),
(35, 'SAN MARINO'),
(36, 'SANTA SEDE'),
(37, 'SUIZA'),
(38, 'UCRANIA'),
(39, 'MOLDAVIA'),
(40, 'BELARUS'),
(41, 'GEORGIA'),
(42, 'BOSNIA Y HERZEGOVINA'),
(43, 'CROACIA'),
(44, 'ARMENIA'),
(45, 'RUSIA'),
(46, 'MACEDONIA '),
(47, 'SERBIA'),
(48, 'MONTENEGRO'),
(49, 'GUERNESEY'),
(50, 'SVALBARD Y JAN MAYEN'),
(51, 'ISLAS FEROE'),
(52, 'ISLA DE MAN'),
(53, 'GIBRALTAR'),
(54, 'ISLAS DEL CANAL'),
(55, 'JERSEY'),
(56, 'ISLAS ALAND'),
(57, 'TURQUIA'),
(58, 'OTROS PAISES O TERRITORIOS DEL RESTO DE EUROPA'),
(59, 'BURKINA FASO'),
(60, 'ANGOLA'),
(61, 'ARGELIA'),
(62, 'BENIN'),
(63, 'BOTSWANA'),
(64, 'BURUNDI'),
(65, 'CABO VERDE'),
(66, 'CAMERUN'),
(67, 'COMORES'),
(68, 'CONGO'),
(69, 'COSTA DE MARFIL'),
(70, 'DJIBOUTI'),
(71, 'EGIPTO'),
(72, 'ETIOPIA'),
(73, 'GABON'),
(74, 'GAMBIA'),
(75, 'GHANA'),
(76, 'GUINEA'),
(77, 'GUINEA-BISSAU'),
(78, 'GUINEA ECUATORIAL'),
(79, 'KENIA'),
(80, 'LESOTHO'),
(81, 'LIBERIA'),
(82, 'LIBIA'),
(83, 'MADAGASCAR'),
(84, 'MALAWI'),
(85, 'MALI'),
(86, 'MARRUECOS'),
(87, 'MAURICIO'),
(88, 'MAURITANIA'),
(89, 'MOZAMBIQUE'),
(90, 'NAMIBIA'),
(91, 'NIGER'),
(92, 'NIGERIA'),
(93, 'REPUBLICA CENTROAFRICANA'),
(94, 'SUDAFRICA'),
(95, 'RUANDA'),
(96, 'SANTO TOME Y PRINCIPE'),
(97, 'SENEGAL'),
(98, 'SEYCHELLES'),
(99, 'SIERRA LEONA'),
(100, 'SOMALIA'),
(101, 'SUDAN'),
(102, 'SWAZILANDIA'),
(103, 'TANZANIA'),
(104, 'CHAD'),
(105, 'TOGO'),
(106, 'TUNEZ'),
(107, 'UGANDA'),
(108, 'REP.DEMOCRATICA DEL CONGO'),
(109, 'ZAMBIA'),
(110, 'ZIMBABWE'),
(111, 'ERITREA'),
(112, 'SANTA HELENA'),
(113, 'REUNION'),
(114, 'MAYOTTE'),
(115, 'SAHARA OCCIDENTAL'),
(116, 'OTROS PAISES O TERRITORIOS DE AFRICA'),
(117, 'CANADA'),
(118, 'ESTADOS UNIDOS DE AMERICA'),
(119, 'MEXICO'),
(120, 'SAN PEDRO Y MIQUELON '),
(121, 'GROENLANDIA'),
(122, 'OTROS PAISES  O TERRITORIOS DE AMERICA DEL NORTE'),
(123, 'ANTIGUA Y BARBUDA'),
(124, 'BAHAMAS'),
(125, 'BARBADOS'),
(126, 'BELICE'),
(127, 'COSTA RICA'),
(128, 'CUBA'),
(129, 'DOMINICA'),
(130, 'EL SALVADOR'),
(131, 'GRANADA'),
(132, 'GUATEMALA'),
(133, 'HAITI'),
(134, 'HONDURAS'),
(135, 'JAMAICA'),
(136, 'NICARAGUA'),
(137, 'PANAMA'),
(138, 'SAN VICENTE Y LAS GRANADINAS'),
(139, 'REPUBLICA DOMINICANA'),
(140, 'TRINIDAD Y TOBAGO'),
(141, 'SANTA LUCIA'),
(142, 'SAN CRISTOBAL Y NIEVES'),
(143, 'ISLAS CAIM?N'),
(144, 'ISLAS TURCAS Y CAICOS'),
(145, 'ISLAS V?RGENES DE LOS ESTADOS UNIDOS'),
(146, 'GUADALUPE'),
(147, 'ANTILLAS HOLANDESAS'),
(148, 'SAN MARTIN (PARTE FRANCESA)'),
(149, 'ARUBA'),
(150, 'MONTSERRAT'),
(151, 'ANGUILLA'),
(152, 'SAN BARTOLOME'),
(153, 'MARTINICA'),
(154, 'PUERTO RICO'),
(155, 'BERMUDAS'),
(156, 'ISLAS VIRGENES BRITANICAS'),
(157, 'OTROS PAISES O TERRITORIOS DEL CARIBE Y AMERICA CENTRAL'),
(162, 'CHILE'),
(163, 'ECUADOR'),
(164, 'GUYANA'),
(165, 'PARAGUAY'),
(166, 'PERU'),
(167, 'SURINAM'),
(168, 'URUGUAY'),
(169, 'VENEZUELA'),
(170, 'GUAYANA FRANCESA'),
(171, 'ISLAS MALVINAS'),
(172, 'OTROS PAISES O TERRITORIOS  DE SUDAMERICA'),
(173, 'AFGANISTAN'),
(174, 'ARABIA SAUDI'),
(175, 'BAHREIN'),
(176, 'BANGLADESH'),
(177, 'MYANMAR'),
(178, 'CHINA'),
(179, 'EMIRATOS ARABES UNIDOS'),
(180, 'FILIPINAS'),
(181, 'INDIA'),
(182, 'INDONESIA'),
(183, 'IRAQ'),
(184, 'IRAN'),
(185, 'ISRAEL'),
(186, 'JAPON'),
(187, 'JORDANIA'),
(188, 'CAMBOYA'),
(189, 'KUWAIT'),
(190, 'LAOS'),
(191, 'LIBANO'),
(192, 'MALASIA'),
(193, 'MALDIVAS'),
(194, 'MONGOLIA'),
(195, 'NEPAL'),
(196, 'OMAN'),
(197, 'PAKISTAN'),
(198, 'QATAR'),
(199, 'COREA'),
(200, 'COREA DEL NORTE '),
(201, 'SINGAPUR'),
(202, 'SIRIA'),
(203, 'SRI LANKA'),
(204, 'TAILANDIA'),
(205, 'VIETNAM'),
(206, 'BRUNEI'),
(207, 'ISLAS MARSHALL'),
(208, 'YEMEN'),
(209, 'AZERBAIYAN'),
(210, 'KAZAJSTAN'),
(211, 'KIRGUISTAN'),
(212, 'TADYIKISTAN'),
(213, 'TURKMENISTAN'),
(214, 'UZBEKISTAN'),
(215, 'ISLAS MARIANAS DEL NORTE'),
(216, 'PALESTINA'),
(217, 'HONG KONG'),
(218, 'BHUT?N'),
(219, 'GUAM'),
(220, 'MACAO'),
(221, 'OTROS PAISES O TERRITORIOS DE ASIA'),
(222, 'AUSTRALIA'),
(223, 'FIJI'),
(224, 'NUEVA ZELANDA'),
(225, 'PAPUA NUEVA GUINEA'),
(226, 'ISLAS SALOMON'),
(227, 'SAMOA'),
(228, 'TONGA'),
(229, 'VANUATU'),
(230, 'MICRONESIA'),
(231, 'TUVALU'),
(232, 'ISLAS COOK'),
(233, 'NAURU'),
(234, 'PALAOS'),
(235, 'TIMOR ORIENTAL'),
(236, 'POLINESIA FRANCESA'),
(237, 'ISLA NORFOLK'),
(238, 'KIRIBATI'),
(239, 'NIUE'),
(240, 'ISLAS PITCAIRN'),
(241, 'TOKELAU'),
(242, 'NUEVA CALEDONIA'),
(243, 'WALLIS Y FORTUNA'),
(244, 'SAMOA AMERICANA'),
(245, 'OTROS PAISES O TERRITORIOS DE OCEANIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `pais` int(11) NOT NULL,
  `comentario` text,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `genero`, `pais`, `comentario`, `fecha`) VALUES
(1, 'Mauricio Rodriguez Reyes', 'info@masterweb.la', 'hombre', 68, 'Pruebaaa 2222', '2017-02-28 01:56:03'),
(3, 'Andrea', 'andrea@masterweb.la', 'mujer', 1, 'Segunda pruebaaaa', '2017-02-28 01:01:29'),
(4, 'Fernando', 'fernando@gmail.com', 'hombre', 3, 'fafsdfds', '2017-02-28 23:48:50'),
(6, 'Mauricio Rodriguez', 'info@masterweb.la', 'hombre', 1, 'dfsad', '2017-03-01 00:00:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

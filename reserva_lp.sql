-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2017 a las 17:52:21
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reserva_lp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro`
--

CREATE TABLE `centro` (
  `id_centro` int(11) NOT NULL,
  `ciudad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `centro`
--

INSERT INTO `centro` (`id_centro`, `ciudad`) VALUES
(1, 'Quito'),
(2, 'Ambato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas_disponibles`
--

CREATE TABLE `citas_disponibles` (
  `id_cita` int(11) NOT NULL,
  `id_responsable` int(11) NOT NULL,
  `id_centro` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_horario` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `id_persona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `citas_disponibles`
--

INSERT INTO `citas_disponibles` (`id_cita`, `id_responsable`, `id_centro`, `id_servicio`, `id_horario`, `fecha`, `estado`, `id_persona`) VALUES
(5, 3, 1, 5, 10, '2017-05-29', 'Disponible', NULL),
(6, 1, 1, 2, 4, '2017-05-29', 'Disponible', NULL),
(7, 1, 2, 5, 4, '2017-06-20', 'Disponible', NULL),
(16, 2, 1, 4, 8, '2017-06-14', 'Reservada', 70),
(17, 3, 2, 5, 9, '2017-06-20', 'Reservada', 69),
(19, 1, 2, 1, 11, '2017-06-09', 'Reservada', 69),
(20, 4, 1, 1, 14, '2017-06-28', 'Reservada', 76),
(21, 3, 1, 1, 14, '2017-06-28', 'Reservada', 76),
(22, 1, 2, 4, 12, '2017-06-22', 'Reservada', 69),
(23, 4, 1, 1, 1, '2017-06-20', 'Disponible', NULL),
(24, 4, 1, 2, 3, '2017-06-15', 'Disponible', NULL),
(27, 1, 1, 1, 7, '2017-06-19', 'Disponible', NULL),
(28, 1, 2, 3, 9, '2017-06-15', 'Disponible', NULL),
(29, 1, 2, 1, 12, '2017-06-15', 'Disponible', NULL),
(30, 2, 1, 2, 10, '2017-06-09', 'Disponible', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `hora_inicio`, `hora_fin`) VALUES
(1, '08:00:00', '09:00:00'),
(2, '09:00:00', '10:00:00'),
(3, '10:00:00', '11:00:00'),
(4, '11:00:00', '12:00:00'),
(5, '12:00:00', '13:00:00'),
(6, '13:00:00', '14:00:00'),
(7, '14:00:00', '15:00:00'),
(8, '15:00:00', '16:00:00'),
(9, '16:00:00', '17:00:00'),
(10, '17:00:00', '18:00:00'),
(11, '18:00:00', '19:00:00'),
(12, '19:00:00', '20:00:00'),
(13, '20:00:00', '21:00:00'),
(14, '21:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_persona` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipousuario` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_persona`, `usuario`, `nombre`, `apellidos`, `email`, `password`, `timestamp`, `tipousuario`) VALUES
(64, '123456789', 'Pepe', 'Viyuela', 'pepe@mail.com', 'pepe', '2016-05-20 14:53:31', NULL),
(66, 'admin', 'Administrador', 'Luna Piel', 'lunapiel@gmail.com', 'admin', '2016-05-20 15:40:35', 'AD'),
(69, '1111', 'Santiago', 'Rueda', 'santo@mail.com', '2222', '2017-05-09 11:03:59', NULL),
(70, 'Jorge', 'Jorge', 'Drexler', 'dere@fsrs.com', '1111', '2017-05-09 11:24:48', NULL),
(74, 'cvcv', 'Drecla', 'sdgs', 'dfgs@vgd.com', 'sdgsd', '2017-05-09 11:26:49', NULL),
(75, 'Ursua', 'Ursua ', 'Mendez', 'ursu@mail.com', 'ursu', '2017-05-09 11:31:21', NULL),
(76, 'Mariela', 'Mariela', 'Brito', 'mariebri84@hotmail.com', 'mariela', '2017-05-10 09:09:57', NULL),
(79, 'cbncvnc', 'kjgjh', 'jkhkh', 'fhgf@kjhkj.com', 'skjfh', '2017-05-10 09:19:44', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_horario_servicios`
--

CREATE TABLE `rel_horario_servicios` (
  `id_horario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rel_horario_servicios`
--

INSERT INTO `rel_horario_servicios` (`id_horario`, `id_servicio`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `id_responsable` int(11) NOT NULL,
  `nombre_responsable` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `responsable`
--

INSERT INTO `responsable` (`id_responsable`, `nombre_responsable`) VALUES
(1, 'Miriam Luna'),
(2, 'Belen Moncayo'),
(3, 'Mariela Brito'),
(4, 'Paulina Brito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(120) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre_servicio`) VALUES
(1, 'Primera consulta'),
(2, 'Seguimiento'),
(3, 'Peeling'),
(4, 'Crioterapia'),
(5, 'Laser');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`id_centro`);

--
-- Indices de la tabla `citas_disponibles`
--
ALTER TABLE `citas_disponibles`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `id_responsable` (`id_responsable`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_centro` (`id_centro`) USING BTREE,
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `nif_UNIQUE` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `rel_horario_servicios`
--
ALTER TABLE `rel_horario_servicios`
  ADD KEY `id_horario` (`id_horario`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id_responsable`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `centro`
--
ALTER TABLE `centro`
  MODIFY `id_centro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `citas_disponibles`
--
ALTER TABLE `citas_disponibles`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT de la tabla `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id_responsable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas_disponibles`
--
ALTER TABLE `citas_disponibles`
  ADD CONSTRAINT `citas_disponibles_ibfk_1` FOREIGN KEY (`id_responsable`) REFERENCES `responsable` (`id_responsable`),
  ADD CONSTRAINT `citas_disponibles_ibfk_2` FOREIGN KEY (`id_centro`) REFERENCES `centro` (`id_centro`),
  ADD CONSTRAINT `citas_disponibles_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`),
  ADD CONSTRAINT `citas_disponibles_ibfk_4` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`),
  ADD CONSTRAINT `citas_disponibles_ibfk_5` FOREIGN KEY (`id_persona`) REFERENCES `pacientes` (`id_persona`);

--
-- Filtros para la tabla `rel_horario_servicios`
--
ALTER TABLE `rel_horario_servicios`
  ADD CONSTRAINT `rel_horario_servicios_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`),
  ADD CONSTRAINT `rel_horario_servicios_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2026 a las 03:59:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `easy_stock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL,
  `DNI` double NOT NULL,
  `NOMBRE` varchar(120) NOT NULL,
  `APELLIDO` varchar(120) NOT NULL,
  `DIRECCION` varchar(120) NOT NULL,
  `WHATSAPP` double NOT NULL,
  `EMAIL` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID`, `DNI`, `NOMBRE`, `APELLIDO`, `DIRECCION`, `WHATSAPP`, `EMAIL`) VALUES
(5, 34449871, 'Juan', 'D&iacute;as', 'Santa Clara 2050', 5489262626, 'Dias@hotmail.com'),
(6, 20344498871, 'rroa', 'roa', 'calle falsa 11:12', 543764338752, 'rroa@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `fecha` datetime NOT NULL,
  `accion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `usuario`, `fecha`, `accion`) VALUES
(1, 'rcorrea', '2026-05-05 16:36:40', 'Eliminar Usuario'),
(2, 'rcorrea', '2026-05-05 16:36:41', 'Eliminar Usuario'),
(3, 'rcorrea', '2026-05-07 16:36:43', 'Eliminar Usuario'),
(4, 'rcorrea', '2026-05-08 16:43:12', 'Insertar Usuario'),
(5, 'rcorrea', '2026-05-09 16:43:31', 'Eliminar Usuario'),
(6, 'rcorrea', '2026-05-10 16:43:47', 'Insertar Usuario'),
(7, 'rcorrea', '2026-05-11 16:44:21', 'Actualizar Usuario'),
(8, 'rcorrea', '2026-05-11 16:46:13', 'Insertar Cliente'),
(9, 'rcorrea', '2026-05-11 17:07:46', 'Insertar Cliente'),
(10, 'rcorrea', '2026-05-11 17:08:05', 'Actualizar Cliente'),
(11, 'rcorrea', '2026-05-11 17:08:19', 'Actualizar Cliente'),
(12, 'rcorrea', '2026-05-11 17:08:28', 'Eliminar Cliente'),
(13, 'rcorrea', '2026-05-11 17:13:01', 'Insertar Seguro'),
(14, 'rcorrea', '2026-05-11 17:13:25', 'Insertar Poliza'),
(15, 'rcorrea', '2026-05-11 17:14:27', 'Actualizar Seguro'),
(16, 'rcorrea', '2026-05-11 17:14:36', 'Actualizar Seguro'),
(17, 'rcorrea', '2026-05-11 17:16:10', 'Insertar Seguro'),
(18, 'rcorrea', '2026-05-11 17:16:31', 'Insertar Seguro'),
(19, 'rcorrea', '2026-05-11 17:16:37', 'Eliminar Seguro'),
(20, 'rcorrea', '2026-05-11 17:16:44', 'Actualizar Seguro'),
(21, 'rcorrea', '2026-05-11 17:17:25', 'Insertar Poliza'),
(22, 'rcorrea', '2026-05-11 17:22:49', 'Insertar Seguro'),
(23, 'rcorrea', '2026-05-11 17:22:53', 'Eliminar Seguro'),
(24, 'rcorrea', '2026-05-11 17:23:29', 'Actualizar Pago'),
(25, 'rcorrea', '2026-05-11 17:25:51', 'Actualizar Pago'),
(26, 'rcorrea', '2026-05-11 17:29:46', 'Actualizar Pago'),
(27, 'rcorrea', '2026-05-11 17:29:55', 'Actualizar Pago'),
(28, 'rcorrea', '2026-05-11 17:30:05', 'Baja Poliza'),
(29, 'rcorrea', '2026-05-11 17:31:53', 'Actualizar Cliente'),
(30, 'rcorrea', '2026-05-11 17:32:04', 'Actualizar Cliente'),
(31, 'rcorrea', '2026-05-11 17:32:14', 'Actualizar Cliente'),
(32, 'rcorrea', '2026-05-11 17:32:19', 'Actualizar Cliente'),
(33, 'rcorrea', '2026-05-11 21:22:44', 'Insertar Usuario'),
(34, 'rcorrea', '2026-05-11 21:31:24', 'Actualizar Usuario'),
(35, 'rcorrea', '2026-05-11 21:31:32', 'Actualizar Usuario'),
(36, 'rcorrea', '2026-05-11 21:31:40', 'Actualizar Usuario'),
(37, 'rcorrea', '2026-05-11 21:32:00', 'Actualizar Usuario'),
(38, 'rcorrea', '2026-05-11 21:32:13', 'Actualizar Usuario'),
(39, 'rcorrea', '2026-05-11 21:32:40', 'Actualizar Usuario'),
(40, 'rcorrea', '2026-05-11 21:32:47', 'Actualizar Usuario'),
(41, 'rcorrea', '2026-05-11 21:33:17', 'Actualizar Usuario'),
(42, 'rcorrea', '2026-05-11 21:33:30', 'Actualizar Usuario'),
(43, 'rcorrea', '2026-05-11 21:33:36', 'Actualizar Usuario'),
(44, 'rcorrea', '2026-05-11 21:33:44', 'Actualizar Usuario'),
(45, 'rcorrea', '2026-05-11 21:33:50', 'Actualizar Usuario'),
(46, 'rcorrea', '2026-05-11 21:33:57', 'Actualizar Usuario'),
(47, 'rcorrea', '2026-05-11 21:34:01', 'Actualizar Usuario'),
(48, 'rcorrea', '2026-05-11 21:34:53', 'Actualizar Usuario'),
(49, 'lromero20', '2026-05-11 21:36:04', 'Actualizar Usuario'),
(50, 'lromero20', '2026-05-11 22:00:28', 'Actualizar Cliente'),
(51, 'lromero20', '2026-05-11 22:00:37', 'Actualizar Cliente'),
(52, 'lromero20', '2026-05-11 22:00:55', 'Actualizar Cliente'),
(53, 'lromero20', '2026-05-11 22:01:08', 'Actualizar Cliente'),
(54, 'lromero20', '2026-05-11 22:01:41', 'Insertar Cliente'),
(55, 'lromero20', '2026-05-11 22:06:01', 'Insertar Poliza'),
(56, 'lromero20', '2026-05-11 22:07:26', 'Actualizar Pago'),
(57, 'lromero20', '2026-05-11 22:10:43', 'Baja Poliza'),
(58, 'lromero20', '2026-05-11 22:22:20', 'Insertar Seguro'),
(59, 'lromero20', '2026-05-11 22:23:15', 'Insertar Cliente'),
(60, 'lromero20', '2026-05-11 22:23:28', 'Actualizar Cliente'),
(61, 'lromero20', '2026-05-11 22:23:39', 'Insertar Poliza'),
(62, 'lromero20', '2026-05-11 22:24:40', 'Actualizar Pago'),
(63, 'lromero20', '2026-05-11 22:25:39', 'Actualizar Pago'),
(64, 'lromero20', '2026-05-11 22:26:16', 'Actualizar Cliente'),
(65, 'lromero20', '2026-05-11 22:28:33', 'Actualizar Seguro'),
(66, 'lromero20', '2026-05-11 22:28:36', 'Actualizar Seguro'),
(67, 'lromero20', '2026-05-11 22:38:25', 'Actualizar Pago'),
(68, 'lromero20', '2026-05-11 22:39:05', 'Baja Poliza'),
(69, 'lromero20', '2026-05-11 22:43:38', 'Procesar Pago'),
(70, 'lromero20', '2026-05-11 22:44:36', 'Eliminar Usuario'),
(71, 'lromero20', '2026-05-11 22:44:38', 'Eliminar Usuario'),
(72, 'lromero20', '2026-05-11 22:44:48', 'Baja Poliza'),
(73, 'lromero20', '2026-05-11 22:44:52', 'Baja Poliza'),
(74, 'lromero20', '2026-05-11 22:44:54', 'Baja Poliza'),
(75, 'lromero20', '2026-05-11 22:45:30', 'Eliminar Cliente'),
(76, 'lromero20', '2026-05-11 22:45:33', 'Eliminar Cliente'),
(77, 'lromero20', '2026-05-11 22:46:04', 'Eliminar Seguro'),
(78, 'lromero20', '2026-05-11 22:46:07', 'Eliminar Seguro'),
(79, 'lromero20', '2026-05-11 22:46:09', 'Eliminar Seguro'),
(80, 'lromero20', '2026-05-11 22:46:16', 'Eliminar Cliente'),
(81, 'lromero20', '2026-05-11 22:53:01', 'Insertar Cliente'),
(82, 'lromero20', '2026-05-11 22:54:04', 'Insertar Seguro'),
(83, 'lromero20', '2026-05-11 22:54:18', 'Insertar Poliza'),
(84, 'lromero20', '2026-05-11 22:55:07', 'Actualizar Pago'),
(85, 'lromero20', '2026-05-11 22:55:11', 'Procesar Pago'),
(86, 'lromero20', '2026-05-11 22:55:17', 'Procesar Pago'),
(87, 'lromero20', '2026-05-11 22:55:19', 'Procesar Pago'),
(88, 'lromero20', '2026-05-11 22:55:33', 'Procesar Pago'),
(89, 'lromero20', '2026-05-11 22:55:43', 'Procesar Pago'),
(90, 'lromero20', '2026-05-11 22:56:19', 'Actualizar Pago'),
(91, 'lromero20', '2026-05-11 22:57:02', 'Insertar Cliente'),
(92, 'lromero20', '2026-05-11 22:57:11', 'Insertar Poliza'),
(93, 'lromero20', '2026-05-11 22:57:22', 'Actualizar Pago'),
(94, 'lromero20', '2026-05-11 22:57:57', 'Baja Poliza'),
(95, 'lromero20', '2026-05-11 22:58:00', 'Insertar Poliza'),
(96, 'lromero20', '2026-05-11 22:58:13', 'Actualizar Pago'),
(97, 'lromero20', '2026-05-11 22:58:37', 'Procesar Pago'),
(98, 'lromero20', '2026-05-11 22:58:44', 'Baja Poliza'),
(99, 'lromero20', '2026-05-11 22:58:47', 'Procesar Pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_poliza` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_vencimiento` datetime NOT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `ven` int(11) NOT NULL DEFAULT 0,
  `monto` decimal(10,2) NOT NULL,
  `pagado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_poliza`, `fecha_creacion`, `fecha_vencimiento`, `fecha_pago`, `ven`, `monto`, `pagado`) VALUES
(1, 42, '2026-01-11 22:54:00', '2026-02-10 22:54:00', '2026-05-11 22:55:11', 1, 250000.00, 1),
(2, 42, '2026-02-10 22:54:00', '2026-03-12 22:54:00', '2026-05-11 22:55:17', 1, 250000.00, 1),
(3, 42, '2026-03-12 22:54:00', '2026-04-11 22:54:00', '2026-05-11 22:55:19', 1, 250000.00, 1),
(4, 42, '2026-04-11 22:54:00', '2026-05-11 22:54:00', '2026-05-11 22:55:33', 1, 250000.00, 1),
(5, 42, '2026-05-11 22:54:00', '2026-05-10 22:54:00', '2026-05-11 22:55:43', 1, 250000.00, 0),
(7, 44, '2026-02-11 22:58:00', '2026-03-10 22:58:00', '2026-05-11 22:58:37', 1, 250000.00, 1),
(8, 44, '2026-03-13 22:58:00', '2026-04-12 22:58:00', '2026-05-11 22:58:47', 1, 250000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polizas`
--

CREATE TABLE `polizas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_seguro` int(11) NOT NULL,
  `numero` double NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `baja` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `polizas`
--

INSERT INTO `polizas` (`id`, `id_cliente`, `id_seguro`, `numero`, `fecha_alta`, `fecha_baja`, `baja`) VALUES
(42, 5, 6, 123566, '2026-05-11 22:54:00', NULL, 0),
(43, 6, 6, 123567, '2026-05-11 22:57:00', '2026-05-11 22:57:57', 1),
(44, 6, 6, 123568, '2026-05-11 22:57:00', '2026-05-11 22:58:44', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguros`
--

CREATE TABLE `seguros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguros`
--

INSERT INTO `seguros` (`id`, `nombre`, `descripcion`, `precio`, `dias`) VALUES
(6, 'Seguro Familiar', 'Cobertura Familiar', 250000.00, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(150) NOT NULL,
  `APELLIDO` varchar(150) NOT NULL,
  `USUARIO` varchar(150) NOT NULL,
  `PASS` varchar(150) NOT NULL,
  `TIPO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `NOMBRE`, `APELLIDO`, `USUARIO`, `PASS`, `TIPO`) VALUES
(5, 'rodrigo', 'correa', 'rcorrea', '422962', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_poliza` (`id_poliza`);

--
-- Indices de la tabla `polizas`
--
ALTER TABLE `polizas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguros`
--
ALTER TABLE `seguros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `polizas`
--
ALTER TABLE `polizas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `seguros`
--
ALTER TABLE `seguros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_pagos_poliza` FOREIGN KEY (`id_poliza`) REFERENCES `polizas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

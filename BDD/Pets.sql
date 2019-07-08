-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-07-2019 a las 01:41:10
-- Versión del servidor: 5.7.26-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Pets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190708045421', '2019-07-08 04:54:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_cliente`
--

CREATE TABLE `pago_cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `transaccion_id` int(11) NOT NULL,
  `producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` int(11) NOT NULL,
  `divisa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `pago_cliente`
--
ALTER TABLE `pago_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BFF96AF78DB9694F` (`transaccion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pago_cliente`
--
ALTER TABLE `pago_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `FK_BFF96AF78DB9694F` FOREIGN KEY (`transaccion_id`) REFERENCES `pago_cliente` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

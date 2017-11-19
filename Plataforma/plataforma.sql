-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2017 a las 17:10:21
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plataforma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `n_categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_categoria` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esrb`
--

CREATE TABLE `esrb` (
  `id_esrb` int(11) NOT NULL,
  `n_esrb` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_esrb` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego`
--

CREATE TABLE `juego` (
  `id_juego` int(11) NOT NULL,
  `n_juego` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_juego` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `portada_juego` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_esrb` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juego_categoria`
--

CREATE TABLE `juego_categoria` (
  `id` int(11) NOT NULL,
  `id_juego` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `id_jugador` int(11) NOT NULL,
  `gamertag_jugador` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password_jugador` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_jugador` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido_jugador` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email_jugador` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pais` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `avatar_jugador` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntaje`
--

CREATE TABLE `puntaje` (
  `id_puntaje` int(11) NOT NULL,
  `fecha_puntaje` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `puntaje` int(11) DEFAULT NULL,
  `id_juego` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `esrb`
--
ALTER TABLE `esrb`
  ADD PRIMARY KEY (`id_esrb`);

--
-- Indices de la tabla `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`id_juego`),
  ADD KEY `IXFK_juego_esrb` (`id_esrb`);

--
-- Indices de la tabla `juego_categoria`
--
ALTER TABLE `juego_categoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IXFK_juego_categoria_categoria` (`id_categoria`),
  ADD KEY `IXFK_juego_categoria_juego` (`id_juego`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`id_jugador`);

--
-- Indices de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD PRIMARY KEY (`id_puntaje`),
  ADD KEY `IXFK_puntaje_juego` (`id_juego`),
  ADD KEY `IXFK_puntaje_jugador` (`id_jugador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `esrb`
--
ALTER TABLE `esrb`
  MODIFY `id_esrb` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `juego`
--
ALTER TABLE `juego`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `juego_categoria`
--
ALTER TABLE `juego_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puntaje`
--
ALTER TABLE `puntaje`
  MODIFY `id_puntaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `FK_juego_esrb` FOREIGN KEY (`id_esrb`) REFERENCES `esrb` (`id_esrb`);

--
-- Filtros para la tabla `juego_categoria`
--
ALTER TABLE `juego_categoria`
  ADD CONSTRAINT `FK_juego_categoria_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `FK_juego_categoria_juego` FOREIGN KEY (`id_juego`) REFERENCES `juego` (`id_juego`);

--
-- Filtros para la tabla `puntaje`
--
ALTER TABLE `puntaje`
  ADD CONSTRAINT `FK_puntaje_juego` FOREIGN KEY (`id_juego`) REFERENCES `juego` (`id_juego`),
  ADD CONSTRAINT `FK_puntaje_jugador` FOREIGN KEY (`id_jugador`) REFERENCES `jugador` (`id_jugador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

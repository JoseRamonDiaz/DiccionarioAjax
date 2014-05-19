-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2014 a las 19:22:31
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `diccionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `administrador_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`administrador_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `abreviatura` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espaniol`
--

CREATE TABLE IF NOT EXISTS `espaniol` (
  `espaniol_id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_espaniol` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `num_consultas` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`espaniol_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espaniol_maya`
--

CREATE TABLE IF NOT EXISTS `espaniol_maya` (
  `espaniol_id` int(11) NOT NULL,
  `maya_id` int(11) NOT NULL,
  PRIMARY KEY (`espaniol_id`,`maya_id`),
  KEY `espaniol_id` (`espaniol_id`,`maya_id`),
  KEY `maya_id` (`maya_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maya`
--

CREATE TABLE IF NOT EXISTS `maya` (
  `maya_id` int(11) NOT NULL AUTO_INCREMENT,
  `texto_maya` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_audio` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `num_consultas` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`maya_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `espaniol`
--
ALTER TABLE `espaniol`
  ADD CONSTRAINT `espaniol_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `espaniol_maya`
--
ALTER TABLE `espaniol_maya`
  ADD CONSTRAINT `espaniol_maya_ibfk_1` FOREIGN KEY (`espaniol_id`) REFERENCES `espaniol` (`espaniol_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `espaniol_maya_ibfk_2` FOREIGN KEY (`maya_id`) REFERENCES `maya` (`maya_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `maya`
--
ALTER TABLE `maya`
  ADD CONSTRAINT `maya_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`categoria_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

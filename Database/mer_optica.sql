-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-07-2020 a las 19:26:18
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mer_optica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono`
--

CREATE TABLE IF NOT EXISTS `abono` (
  `id_abono` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `valor` double NOT NULL,
  `venta` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_abono`),
  KEY `fk_ABONO_VENTA1_idx` (`venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `valor_total` double DEFAULT NULL,
  `persona` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `fk_COMPRA_PERSONA1_idx` (`persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `codigo_dane` mediumint(10) NOT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_compra`
--

CREATE TABLE IF NOT EXISTS `detalles_compra` (
  `id_detalles_compra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cantidad` mediumint(20) NOT NULL,
  `precio` double NOT NULL,
  `compra` int(10) UNSIGNED NOT NULL,
  `producto` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_detalles_compra`),
  KEY `fk_DETALLES_COMPRA_COMPRA1_idx` (`compra`),
  KEY `fk_DETALLES_COMPRA_PRODUCTO1_idx` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE IF NOT EXISTS `detalles_venta` (
  `id_detalles_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cantidad` mediumint(30) NOT NULL,
  `precio_unitario` double NOT NULL,
  `precio_total` double NOT NULL,
  `venta` int(10) UNSIGNED NOT NULL,
  `producto` int(10) UNSIGNED DEFAULT NULL,
  `formula` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id_detalles_venta`),
  KEY `fk_DETALLES_VENTA_VENTA1_idx` (`venta`),
  KEY `fk_DETALLES_VENTA_PRODUCTO1_idx` (`producto`),
  KEY `fk_DETALLES_VENTA_FORMULA1_idx` (`formula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formula`
--

CREATE TABLE IF NOT EXISTS `formula` (
  `id_formula` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `od_esfera` varchar(15) NOT NULL,
  `oi_esfera` varchar(15) NOT NULL,
  `od_cilindro` varchar(15) NOT NULL,
  `oi_cilindro` varchar(15) NOT NULL,
  `od_eje` varchar(15) NOT NULL,
  `oi_eje` varchar(15) NOT NULL,
  `od_av` varchar(15) NOT NULL,
  `oi_av` varchar(15) NOT NULL,
  `dp` varchar(15) NOT NULL,
  `color` varchar(15) NOT NULL,
  `numero_montura` mediumint(10) NOT NULL,
  `observaciones` tinytext NOT NULL,
  `bifocal` varchar(15) NOT NULL,
  `material` varchar(15) NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id_formula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `id_marca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `id_municipio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `codigo_dane` mediumint(10) NOT NULL,
  `departamento` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `fk_MUNICIPIO_DEPARTAMENTO1_idx` (`departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id_persona` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `documento` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(10) NOT NULL,
  `direccion` varchar(15) NOT NULL,
  `telefono` decimal(11,0) NOT NULL,
  `municipio` int(10) UNSIGNED NOT NULL,
  `rol` enum('cliente','proveedor',' vendedor') NOT NULL,
  `contraseña` varchar(45) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (`id_persona`),
  KEY `fk_PERSONA_MUNICIPIO1_idx` (`municipio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `descrpcion` tinytext NOT NULL,
  `iva` double NOT NULL,
  `stock` int(11) NOT NULL,
  `marca` int(10) UNSIGNED NOT NULL,
  `categoria` int(10) UNSIGNED NOT NULL,
  `estado` enum('agotado','activo','suspendido') NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_PRODUCTO_MARCA_idx` (`marca`),
  KEY `fk_PRODUCTO_CATEGORIA1_idx` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `id_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `valor_total` double DEFAULT NULL,
  `tipo_de_pago` enum('efectivo','cuotas') NOT NULL,
  `persona` int(10) UNSIGNED NOT NULL,
  `estado` enum('agotado','activo','suspendido') NOT NULL,
  PRIMARY KEY (`id_venta`),
  KEY `fk_VENTA_PERSONA1_idx` (`persona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono`
--
ALTER TABLE `abono`
  ADD CONSTRAINT `fk_ABONO_VENTA1` FOREIGN KEY (`venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_COMPRA_PERSONA1` FOREIGN KEY (`persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalles_compra`
--
ALTER TABLE `detalles_compra`
  ADD CONSTRAINT `fk_DETALLES_COMPRA_COMPRA1` FOREIGN KEY (`compra`) REFERENCES `compra` (`id_compra`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DETALLES_COMPRA_PRODUCTO1` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD CONSTRAINT `fk_DETALLES_VENTA_FORMULA1` FOREIGN KEY (`formula`) REFERENCES `formula` (`id_formula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DETALLES_VENTA_PRODUCTO1` FOREIGN KEY (`producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_DETALLES_VENTA_VENTA1` FOREIGN KEY (`venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_MUNICIPIO_DEPARTAMENTO1` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_PERSONA_MUNICIPIO1` FOREIGN KEY (`municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_PRODUCTO_CATEGORIA1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PRODUCTO_MARCA` FOREIGN KEY (`marca`) REFERENCES `marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_VENTA_PERSONA1` FOREIGN KEY (`persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

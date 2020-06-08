-- MySQL Workbench Synchronization
-- Generated: 2020-06-08 15:43
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: USER

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `MER_optica` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

CREATE TABLE IF NOT EXISTS `MER_optica`.`PRODUCTO` (
  `id_producto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  `descrpcion` TINYTEXT NOT NULL,
  `iva` DOUBLE NOT NULL,
  `stock` INT(11) NOT NULL,
  `marca` INT(11) NOT NULL,
  `categoria` INT(11) NOT NULL,
  `estado` ENUM('agotado','activo','suspendido') NOT NULL,
  PRIMARY KEY (`id_producto`),
  INDEX `fk_PRODUCTO_MARCA_idx` (`marca` ASC),
  INDEX `fk_PRODUCTO_CATEGORIA1_idx` (`categoria` ASC),
  CONSTRAINT `fk_PRODUCTO_MARCA`
    FOREIGN KEY (`marca`)
    REFERENCES `MER_optica`.`MARCA` (`id_marca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRODUCTO_CATEGORIA1`
    FOREIGN KEY (`categoria`)
    REFERENCES `MER_optica`.`CATEGORIA` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`MARCA` (
  `id_marca` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(25) NOT NULL,
  `estado` ENUM('activo','inactivo') NOT NULL,
  PRIMARY KEY (`id_marca`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`CATEGORIA` (
  `id_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  `estado` ENUM('activo','inactivo') NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`COMPRA` (
  `id_compra` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `valor_total` DOUBLE NULL DEFAULT NULL,
  `persona` INT(11) NOT NULL,
  PRIMARY KEY (`id_compra`),
  INDEX `fk_COMPRA_PERSONA1_idx` (`persona` ASC),
  CONSTRAINT `fk_COMPRA_PERSONA1`
    FOREIGN KEY (`persona`)
    REFERENCES `MER_optica`.`PERSONA` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`DETALLES_COMPRA` (
  `id_detalles_compra` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` MEDIUMINT(20) NOT NULL,
  `precio` DOUBLE NOT NULL,
  `compra` INT(11) NOT NULL,
  `producto` INT(11) NOT NULL,
  PRIMARY KEY (`id_detalles_compra`),
  INDEX `fk_DETALLES_COMPRA_COMPRA1_idx` (`compra` ASC),
  INDEX `fk_DETALLES_COMPRA_PRODUCTO1_idx` (`producto` ASC),
  CONSTRAINT `fk_DETALLES_COMPRA_COMPRA1`
    FOREIGN KEY (`compra`)
    REFERENCES `MER_optica`.`COMPRA` (`id_compra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DETALLES_COMPRA_PRODUCTO1`
    FOREIGN KEY (`producto`)
    REFERENCES `MER_optica`.`PRODUCTO` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`ABONO` (
  `id_abono` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME(20) NOT NULL,
  `valor` DOUBLE NOT NULL,
  `venta` INT(11) NOT NULL,
  PRIMARY KEY (`id_abono`),
  INDEX `fk_ABONO_VENTA1_idx` (`venta` ASC),
  CONSTRAINT `fk_ABONO_VENTA1`
    FOREIGN KEY (`venta`)
    REFERENCES `MER_optica`.`VENTA` (`id_venta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`VENTA` (
  `id_venta` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME(20) NOT NULL,
  `valor_total` DOUBLE NULL DEFAULT NULL,
  `tipo_de_pago` ENUM('efectivo','cuotas') NOT NULL,
  `persona` MEDIUMINT(30) NOT NULL,
  `estado` ENUM('agotado','activo','suspendido') NOT NULL,
  PRIMARY KEY (`id_venta`),
  INDEX `fk_VENTA_PERSONA1_idx` (`persona` ASC),
  CONSTRAINT `fk_VENTA_PERSONA1`
    FOREIGN KEY (`persona`)
    REFERENCES `MER_optica`.`PERSONA` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`FORMULA` (
  `id_formula` INT(11) NOT NULL AUTO_INCREMENT,
  `od_esfera` VARCHAR(15) NOT NULL,
  `oi_esfera` VARCHAR(15) NOT NULL,
  `od_cilindro` VARCHAR(15) NOT NULL,
  `oi_cilindro` VARCHAR(15) NOT NULL,
  `od_eje` VARCHAR(15) NOT NULL,
  `oi_eje` VARCHAR(15) NOT NULL,
  `od_av` VARCHAR(15) NOT NULL,
  `oi_av` VARCHAR(15) NOT NULL,
  `dp` VARCHAR(15) NOT NULL,
  `color` VARCHAR(15) NOT NULL,
  `numero_montura` MEDIUMINT(10) NOT NULL,
  `observaciones` TINYTEXT NOT NULL,
  `bifocal` VARCHAR(15) NOT NULL,
  `material` VARCHAR(15) NOT NULL,
  `valor` DOUBLE NOT NULL,
  PRIMARY KEY (`id_formula`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`DETALLES_VENTA` (
  `id_detalles_venta` INT(11) NOT NULL AUTO_INCREMENT,
  `cantidad` MEDIUMINT(30) NOT NULL,
  `precio_unitario` DOUBLE NOT NULL,
  `precio_total` DOUBLE NOT NULL,
  `venta` INT(11) NOT NULL,
  `producto` INT(11) NULL DEFAULT NULL,
  `formula` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalles_venta`),
  INDEX `fk_DETALLES_VENTA_VENTA1_idx` (`venta` ASC),
  INDEX `fk_DETALLES_VENTA_PRODUCTO1_idx` (`producto` ASC),
  INDEX `fk_DETALLES_VENTA_FORMULA1_idx` (`formula` ASC),
  CONSTRAINT `fk_DETALLES_VENTA_VENTA1`
    FOREIGN KEY (`venta`)
    REFERENCES `MER_optica`.`VENTA` (`id_venta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DETALLES_VENTA_PRODUCTO1`
    FOREIGN KEY (`producto`)
    REFERENCES `MER_optica`.`PRODUCTO` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DETALLES_VENTA_FORMULA1`
    FOREIGN KEY (`formula`)
    REFERENCES `MER_optica`.`FORMULA` (`id_formula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`DEPARTAMENTO` (
  `id_departamento` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  `codigo_dane` MEDIUMINT(10) NOT NULL,
  PRIMARY KEY (`id_departamento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`MUNICIPIO` (
  `id_municipio` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(20) NOT NULL,
  `codigo_dane` MEDIUMINT(10) NOT NULL,
  `departamento` INT(11) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  INDEX `fk_MUNICIPIO_DEPARTAMENTO1_idx` (`departamento` ASC),
  CONSTRAINT `fk_MUNICIPIO_DEPARTAMENTO1`
    FOREIGN KEY (`departamento`)
    REFERENCES `MER_optica`.`DEPARTAMENTO` (`id_departamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `MER_optica`.`PERSONA` (
  `id_persona` INT(11) NOT NULL AUTO_INCREMENT,
  `documento` INT(11) NOT NULL,
  `nombre` VARCHAR(20) NOT NULL,
  `apellido` VARCHAR(10) NOT NULL,
  `direccion` VARCHAR(15) NOT NULL,
  `telefono` DECIMAL(11) NOT NULL,
  `municipio` INT(11) NOT NULL,
  `rol` ENUM('cliente', 'proveedor',' vendedor') NOT NULL,
  `contraseña` VARCHAR(45) NOT NULL,
  `estado` ENUM('activo','inactivo') NOT NULL,
  PRIMARY KEY (`id_persona`),
  INDEX `fk_PERSONA_MUNICIPIO1_idx` (`municipio` ASC),
  CONSTRAINT `fk_PERSONA_MUNICIPIO1`
    FOREIGN KEY (`municipio`)
    REFERENCES `MER_optica`.`MUNICIPIO` (`id_municipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

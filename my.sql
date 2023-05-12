-- MySQL Script generated by MySQL Workbench
-- Thu May  4 08:56:19 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pw` DEFAULT CHARACTER SET utf8 ;
USE `pw` ;

-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pw`.`usuarios` (
  `idusuarios` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `senha` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idusuarios`));

-- -----------------------------------------------------
-- Table `mydb`.`documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pw`.`documentos` (
  `iddocumentos` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `usuarios_idusuarios` INT NOT NULL,
  CONSTRAINT `fk_documentos_usuarios1`
  PRIMARY KEY(`iddocumentos`),
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `pw`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`compart_documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pw`.`compart_documentos` (
  `idcompart_documentos` INT NOT NULL AUTO_INCREMENT,
  `permissao` TINYINT NOT NULL,
  `usuarios_idusuarios` INT NOT NULL,
  CONSTRAINT `fk_compart_documentos_usuarios1`
    PRIMARY KEY(`idcompart_documentos`),
    FOREIGN KEY (`usuarios_idusuarios`)
    REFERENCES `pw`.`usuarios` (`idusuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

use pw;
alter table compart_documentos ADD iddocumentos int not null;
alter table compart_documentos ADD CONSTRAINT FK_id_documentos FOREIGN KEY(iddocumentos) REFERENCES documentos (iddocumentos); 


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;




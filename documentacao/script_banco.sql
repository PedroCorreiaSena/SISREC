-- MySQL Script generated by MySQL Workbench
-- 04/04/16 21:46:40
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sisrec
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sisrec
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sisrec` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sisrec` ;

-- -----------------------------------------------------
-- Table `sisrec`.`TB_SEXO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_SEXO` (
  `id_sexo` INT(11) NOT NULL COMMENT '',
  `tp_sexo` VARCHAR(9) NOT NULL COMMENT '',
  PRIMARY KEY (`id_sexo`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_UF`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_UF` (
  `id_uf` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `ds_uf` VARCHAR(2) NOT NULL COMMENT '',
  PRIMARY KEY (`id_uf`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_MUNICIPIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_MUNICIPIO` (
  `id_municipio` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `nm_municipio` VARCHAR(100) NOT NULL COMMENT '',
  `id_uf` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id_municipio`, `id_uf`)  COMMENT '',
  INDEX `fk_TB_MUNICIPIO_TB_UF1_idx` (`id_uf` ASC)  COMMENT '',
  CONSTRAINT `fk_TB_MUNICIPIO_TB_UF1`
    FOREIGN KEY (`id_uf`)
    REFERENCES `sisrec`.`TB_UF` (`id_uf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_ENDERECO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_ENDERECO` (
  `id_endereco` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `cep` VARCHAR(8) NOT NULL COMMENT '',
  `endereco` VARCHAR(100) NOT NULL COMMENT '',
  `casa` VARCHAR(100) NOT NULL COMMENT '',
  `bairro` VARCHAR(100) NOT NULL COMMENT '',
  `complemento` VARCHAR(100) NOT NULL COMMENT '',
  `id_municipio` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id_endereco`)  COMMENT '',
  INDEX `fk_TB_ENDERECO_TB_MUNICIPIO1_idx` (`id_municipio` ASC)  COMMENT '',
  CONSTRAINT `fk_TB_ENDERECO_TB_MUNICIPIO1`
    FOREIGN KEY (`id_municipio`)
    REFERENCES `sisrec`.`TB_MUNICIPIO` (`id_municipio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_TELEFONE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_TELEFONE` (
  `id_telefone` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `ddd_telefone` VARCHAR(9) NOT NULL COMMENT '',
  `num_telefone` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id_telefone`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_PERFIL`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_PERFIL` (
  `id_perfil` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `tp_perfil` VARCHAR(20) NOT NULL COMMENT '',
  `st_perfil` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`id_perfil`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_USUARIO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_USUARIO` (
  `cpf` VARCHAR(11) NOT NULL COMMENT '',
  `nm_usuario` VARCHAR(100) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  `observacao` VARCHAR(4000) NULL COMMENT '',
  `senha` VARCHAR(45) NOT NULL COMMENT '',
  `st_usuario` TINYINT(1) NOT NULL COMMENT '',
  `id_sexo` INT(11) NOT NULL COMMENT '',
  `id_endereco` INT(11) NOT NULL COMMENT '',
  `id_telefone` INT(11) NOT NULL COMMENT '',
  `id_perfil` INT(11) NOT NULL COMMENT '',
  INDEX `fk_TB_USUARIO_TB_SEXO1_idx` (`id_sexo` ASC)  COMMENT '',
  PRIMARY KEY (`cpf`)  COMMENT '',
  INDEX `fk_TB_USUARIO_TB_ENDERECO1_idx` (`id_endereco` ASC)  COMMENT '',
  INDEX `fk_TB_USUARIO_TB_TELEFONE1_idx` (`id_telefone` ASC)  COMMENT '',
  INDEX `fk_TB_USUARIO_TB_PERFIL1_idx` (`id_perfil` ASC)  COMMENT '',
  CONSTRAINT `fk_TB_USUARIO_TB_SEXO1`
    FOREIGN KEY (`id_sexo`)
    REFERENCES `sisrec`.`TB_SEXO` (`id_sexo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_USUARIO_TB_ENDERECO1`
    FOREIGN KEY (`id_endereco`)
    REFERENCES `sisrec`.`TB_ENDERECO` (`id_endereco`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_USUARIO_TB_TELEFONE1`
    FOREIGN KEY (`id_telefone`)
    REFERENCES `sisrec`.`TB_TELEFONE` (`id_telefone`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_USUARIO_TB_PERFIL1`
    FOREIGN KEY (`id_perfil`)
    REFERENCES `sisrec`.`TB_PERFIL` (`id_perfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_TP_MATERIAL`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_TP_MATERIAL` (
  `id_tp_material` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `tp_material` VARCHAR(100) NOT NULL COMMENT '',
  `st_material` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`id_tp_material`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_MATERIAL`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_MATERIAL` (
  `id_material` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `qt_material` INT(5) NOT NULL COMMENT '',
  `dt_inclusao` DATE NOT NULL COMMENT '',
  `vl_material` DECIMAL(18,2) NOT NULL COMMENT '',
  `ds_material` VARCHAR(100) NOT NULL COMMENT '',
  `total_material` DECIMAL(18,2) NOT NULL COMMENT '',
  `cpf` VARCHAR(11) NOT NULL COMMENT '',
  `id_tp_material` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id_material`)  COMMENT '',
  INDEX `fk_TB_MATERIAL_TB_USUARIO1_idx` (`cpf` ASC)  COMMENT '',
  INDEX `fk_TB_MATERIAL_TB_TP_MATERIAL1_idx` (`id_tp_material` ASC)  COMMENT '',
  CONSTRAINT `fk_TB_MATERIAL_TB_USUARIO1`
    FOREIGN KEY (`cpf`)
    REFERENCES `sisrec`.`TB_USUARIO` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_MATERIAL_TB_TP_MATERIAL1`
    FOREIGN KEY (`id_tp_material`)
    REFERENCES `sisrec`.`TB_TP_MATERIAL` (`id_tp_material`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_TIPO_GASTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_TIPO_GASTO` (
  `id_tp_gasto` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `tp_gasto` VARCHAR(100) NOT NULL COMMENT '',
  `st_tp_gasto` TINYINT(1) NOT NULL COMMENT '',
  PRIMARY KEY (`id_tp_gasto`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sisrec`.`TB_GASTO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sisrec`.`TB_GASTO` (
  `id_gastos` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `vl_gasto` DECIMAL(18,2) NOT NULL COMMENT '',
  `num_nota_fiscal` INT(15) NOT NULL COMMENT '',
  `qt_gasto` INT(11) NOT NULL COMMENT '',
  `dt_gasto` DATE NOT NULL COMMENT '',
  `total_compra` DECIMAL(18,2) NOT NULL COMMENT '',
  `dt_pagamento` DATE NOT NULL COMMENT '',
  `st_pagamento` TINYINT(1) NOT NULL COMMENT '',
  `id_tp_gasto` INT(11) NOT NULL COMMENT '',
  `cpf` VARCHAR(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id_gastos`)  COMMENT '',
  INDEX `fk_TB_GASTO_TB_TIPO_GASTO1_idx` (`id_tp_gasto` ASC)  COMMENT '',
  INDEX `fk_TB_GASTO_TB_USUARIO1_idx` (`cpf` ASC)  COMMENT '',
  CONSTRAINT `fk_TB_GASTO_TB_TIPO_GASTO1`
    FOREIGN KEY (`id_tp_gasto`)
    REFERENCES `sisrec`.`TB_TIPO_GASTO` (`id_tp_gasto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TB_GASTO_TB_USUARIO1`
    FOREIGN KEY (`cpf`)
    REFERENCES `sisrec`.`TB_USUARIO` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

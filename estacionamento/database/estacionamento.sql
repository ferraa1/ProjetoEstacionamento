-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `estacionamento` DEFAULT CHARACTER SET utf8 ;
USE `estacionamento` ;

-- -----------------------------------------------------
-- Table `estacionamento`.`vaga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`vaga` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `numero` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `usuario` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `telefone` VARCHAR(45) NULL,
  `ativado` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`funcionario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `usuario` VARCHAR(45) NULL,
  `senha` VARCHAR(45) NULL,
  `admin` TINYINT NULL,
  `ativado` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`preco_hora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`preco_hora` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `preco` DOUBLE NULL,
  `atualizado` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`veiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`operacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`operacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_entrada` DATETIME NULL,
  `data_saida` DATETIME NULL,
  `funcionario_id` INT NOT NULL,
  `vaga_id` INT NOT NULL,
  `preco_hora_id` INT NOT NULL,
  `veiculo_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_operacao_funcionario1_idx` (`funcionario_id` ASC),
  INDEX `fk_operacao_vaga1_idx` (`vaga_id` ASC),
  INDEX `fk_operacao_preco_hora1_idx` (`preco_hora_id` ASC),
  INDEX `fk_operacao_veiculo1_idx` (`veiculo_id` ASC),
  CONSTRAINT `fk_operacao_funcionario1`
    FOREIGN KEY (`funcionario_id`)
    REFERENCES `estacionamento`.`funcionario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_vaga1`
    FOREIGN KEY (`vaga_id`)
    REFERENCES `estacionamento`.`vaga` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_preco_hora1`
    FOREIGN KEY (`preco_hora_id`)
    REFERENCES `estacionamento`.`preco_hora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_operacao_veiculo1`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `estacionamento`.`veiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`cliente_has_veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`cliente_has_veiculo` (
  `cliente_id` INT NOT NULL,
  `veiculo_id` INT NOT NULL,
  PRIMARY KEY (`cliente_id`, `veiculo_id`),
  INDEX `fk_cliente_has_veiculo_veiculo1_idx` (`veiculo_id` ASC),
  INDEX `fk_cliente_has_veiculo_cliente1_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_cliente_has_veiculo_cliente1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `estacionamento`.`cliente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cliente_has_veiculo_veiculo1`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `estacionamento`.`veiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

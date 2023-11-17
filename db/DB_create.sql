-- MySQL Script generated by MySQL Workbench
-- Fri Nov 17 08:20:18 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema exercise-looper
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema exercise-looper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `exercise-looper` DEFAULT CHARACTER SET utf8 ;
USE `exercise-looper` ;

-- -----------------------------------------------------
-- Table `exercise-looper`.`exercises`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercise-looper`.`exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(96) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exercise-looper`.`fieldTypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercise-looper`.`fieldTypes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(46) NOT NULL,
  `maxLength` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idfieldsTypes_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exercise-looper`.`fields`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercise-looper`.`fields` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(512) NOT NULL,
  `exercises_id` INT NOT NULL,
  `fieldTypes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `idtable1_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_fields_exercises_idx` (`exercises_id` ASC) VISIBLE,
  INDEX `fk_fields_fieldTypes1_idx` (`fieldTypes_id` ASC) VISIBLE,
  CONSTRAINT `fk_fields_exercises`
    FOREIGN KEY (`exercises_id`)
    REFERENCES `exercise-looper`.`exercises` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_fields_fieldTypes`
    FOREIGN KEY (`fieldTypes_id`)
    REFERENCES `exercise-looper`.`fieldTypes` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exercise-looper`.`fulfillments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercise-looper`.`fulfillments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `dateTime` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `exercise-looper`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercise-looper`.`answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `value` VARCHAR(255) NOT NULL,
  `fields_id` INT NOT NULL,
  `fulfillments_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_fields1_idx` (`fields_id` ASC) VISIBLE,
  INDEX `fk_answers_fulfillments1_idx` (`fulfillments_id` ASC) VISIBLE,
  CONSTRAINT `fk_answers_fields1`
    FOREIGN KEY (`fields_id`)
    REFERENCES `exercise-looper`.`fields` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_answers_fulfillments1`
    FOREIGN KEY (`fulfillments_id`)
    REFERENCES `exercise-looper`.`fulfillments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

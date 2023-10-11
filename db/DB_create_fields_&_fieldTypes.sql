USE `exercise-looper` ;

-- -----------------------------------------------------
-- Table `exercise-looper`.`fieldTypes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercise-looper`.`fieldTypes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(46) NOT NULL,
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
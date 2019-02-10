-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema laravelCLC
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laravelCLC
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laravelCLC` DEFAULT CHARACTER SET utf8 ;
USE `laravelCLC` ;

-- -----------------------------------------------------
-- Table `laravelCLC`.`USERS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravelCLC`.`USERS` (
  `IDUSERS` INT(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` VARCHAR(100) NOT NULL,
  `PASSWORD` VARCHAR(100) NOT NULL,
  `EMAIL` VARCHAR(100) NOT NULL,
  `FIRSTNAME` VARCHAR(100) NOT NULL,
  `LASTNAME` VARCHAR(100) NOT NULL,
  `STATUS` INT(11) NOT NULL DEFAULT '1',
  `ROLE` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IDUSERS`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravelCLC`.`ADDRESS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravelCLC`.`ADDRESS` (
  `IDADDRESS` INT(11) NOT NULL AUTO_INCREMENT,
  `STREET` VARCHAR(45) NULL DEFAULT NULL,
  `CITY` VARCHAR(45) NULL DEFAULT NULL,
  `STATE` VARCHAR(45) NULL DEFAULT NULL,
  `ZIP` VARCHAR(45) NULL DEFAULT NULL,
  `USERS_IDUSERS` INT(11) NOT NULL,
  PRIMARY KEY (`IDADDRESS`),
  INDEX `fk_ADDRESS_USERS_idx` (`USERS_IDUSERS` ASC) VISIBLE,
  CONSTRAINT `fk_ADDRESS_USERS`
    FOREIGN KEY (`USERS_IDUSERS`)
    REFERENCES `laravelCLC`.`USERS` (`IDUSERS`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `laravelCLC`.`USER_INFO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laravelCLC`.`USER_INFO` (
  `IDUSER_INFO` INT(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` MEDIUMTEXT NULL DEFAULT NULL,
  `PHONE` VARCHAR(45) NULL DEFAULT NULL,
  `AGE` INT(11) NULL DEFAULT NULL,
  `GENDER` VARCHAR(45) NULL DEFAULT NULL,
  `USERS_IDUSERS` INT(11) NOT NULL,
  PRIMARY KEY (`IDUSER_INFO`),
  INDEX `fk_USER_INFO_USERS1_idx` (`USERS_IDUSERS` ASC) VISIBLE,
  CONSTRAINT `fk_USER_INFO_USERS1`
    FOREIGN KEY (`USERS_IDUSERS`)
    REFERENCES `laravelCLC`.`USERS` (`IDUSERS`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

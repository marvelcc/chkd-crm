SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0;

DROP DATABASE IF EXISTS `chkdcrm`;

CREATE DATABASE IF NOT EXISTS `chkdcrm` DEFAULT CHARACTER SET utf8 ;
USE `chkdcrm` ;

-- -----------------------------------------------------
-- Table `chkdcrm`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`address` (
  `address_id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` ENUM('Invoice', 'Shipping', 'Site', 'Mailing') NOT NULL,
  `street` VARCHAR(100) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `state` VARCHAR(30) NOT NULL,
  `zip` VARCHAR(10) NOT NULL,
  `country` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`address_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chkdcrm`.`person`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`person` (
  `person_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `media_type` ENUM('German media', 'Chinese media', 'Foreign media', ' Not media') NOT NULL,
  `magazine_sub` TINYINT NOT NULL,
  `newsletter_sub` TINYINT NOT NULL,
  `birthday` DATE NULL,
  `priority` ENUM('High', 'Medium', 'Low', 'None') NOT NULL,
  `p_remark` TEXT NULL,
  `p_date_added` DATETIME NOT NULL DEFAULT NOW(),
  `p_tel` VARCHAR(20) NULL,
  `fax` VARCHAR(20) NULL,
  `mobile` VARCHAR(20) NOT NULL  ,
  `p_email` VARCHAR(150) NOT NULL  ,
  `wechat` VARCHAR(50) NULL  ,
  PRIMARY KEY (`person_id`))
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `chkdcrm`.`person_address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`person_address` (
  `address_id` INT(11) NOT NULL,
  `person_id` INT(11) NOT NULL,
  PRIMARY KEY (`address_id`, `person_id`),
  CONSTRAINT `address_id`
    FOREIGN KEY (`address_id`)
    REFERENCES `chkdcrm`.`address` (`address_id`)
    ON DELETE NO ACTION,
  CONSTRAINT `person_id`
    FOREIGN KEY (`person_id`)
    REFERENCES `chkdcrm`.`person` (`person_id`)
    ON DELETE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `chkdcrm`.`company`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`company` (
  `company_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name_de` VARCHAR(150) NOT NULL  ,
  `website` VARCHAR(255) NULL  ,
  `c_tel` VARCHAR(20) NOT NULL  ,
  `c_email` VARCHAR(150) NOT NULL  ,
  `service_region` ENUM('EU', 'Western Europe', 'Germany and German-speaking region', 'Others') NOT NULL,
  `employee_count` INT(8) NULL,
  `registration_nr` VARCHAR(15) NULL  ,
  `annual_revenue` VARCHAR(20) NULL,
  `c_remark` TEXT NULL,
  `c_date_added` DATETIME NOT NULL DEFAULT NOW(),
  `member_type` ENUM('Board', 'Counsil', 'Class A', 'Class B', 'Automotive Committee', 'Support', 'Not') NOT NULL,
  `industry` ENUM('Agro', 'Metal', 'Automobile', 'Construction', 'Pharmaceutical', 'Finance', 'Media', 'Electronics', 'Logistic', 'Textile', 'Energy', 'Other') NOT NULL,
  `parent_company` INT(11) NULL,
  PRIMARY KEY (`company_id`),
  CONSTRAINT `parent_company`
    FOREIGN KEY (`parent_company`)
    REFERENCES `chkdcrm`.`company` (`company_id`)
    ON DELETE SET NULL)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `chkdcrm`.`company_address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`company_address` (
  `address_id` INT(11) NOT NULL,
  `company_id` INT(11) NOT NULL,
  PRIMARY KEY (`address_id`, `company_id`),
  CONSTRAINT `company_address_address_id`
    FOREIGN KEY (`address_id`)
    REFERENCES `chkdcrm`.`address` (`address_id`)
    ON DELETE CASCADE,
  CONSTRAINT `company_address_company_id`
    FOREIGN KEY (`company_id`)
    REFERENCES `chkdcrm`.`company` (`company_id`)
    ON DELETE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `chkdcrm`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(150) NOT NULL  ,
  `mobile` VARCHAR(45) NOT NULL  ,
  `username` VARCHAR(50) NOT NULL  ,
  `password` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `chkdcrm`.`role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`role` (
  `role_id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_name` VARCHAR(45) NOT NULL  ,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chkdcrm`.`user_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`user_role` (
  `user_id` INT(11) NOT NULL,
  `role_id` INT(11) NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`),
  CONSTRAINT `fk_user_has_role_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `chkdcrm`.`user` (`user_id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_user_has_role_role1`
    FOREIGN KEY (`role_id`)
    REFERENCES `chkdcrm`.`role` (`role_id`)
    ON DELETE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chkdcrm`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`task` (
  `task_id` INT(11) NOT NULL AUTO_INCREMENT,
  `task_type` ENUM('email', 'call', 'meeting', 'other') NOT NULL,
  `task_desc` TEXT NULL,
  `due` DATETIME NULL,
  PRIMARY KEY (`task_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chkdcrm`.`user_has_task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`user_has_task` (
  `user_id` INT(11) NOT NULL,
  `task_id` INT(11) NOT NULL,
  PRIMARY KEY (`task_id`, `user_id`),
  CONSTRAINT `fk_user_has_task_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `chkdcrm`.`user` (`user_id`)
    ON DELETE NO ACTION,
  CONSTRAINT `fk_user_has_task_task1`
    FOREIGN KEY (`task_id`)
    REFERENCES `chkdcrm`.`task` (`task_id`)
    ON DELETE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `chkdcrm`.`task_target`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`task_target` (
  `task_id` INT(11) NOT NULL,
  `person_id` INT(11) NOT NULL,
  PRIMARY KEY (`task_id`, `person_id`),
  CONSTRAINT `fk_task_has_person_task1`
    FOREIGN KEY (`task_id`)
    REFERENCES `chkdcrm`.`task` (`task_id`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_task_has_person_person1`
    FOREIGN KEY (`person_id`)
    REFERENCES `chkdcrm`.`person` (`person_id`)
    ON DELETE CASCADE)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `chkdcrm`.`job`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chkdcrm`.`job` (
  `job_id` INT(11) NOT NULL AUTO_INCREMENT,
  `person_id` INT(11) NOT NULL,
  `company_id` INT(11) NOT NULL,
  `department` VARCHAR(45) NOT NULL,
  `position` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`job_id`, `company_id`, `person_id`),
  CONSTRAINT `job_person_id`
    FOREIGN KEY (`person_id`)
    REFERENCES `chkdcrm`.`person` (`person_id`)
    ON DELETE CASCADE,
  CONSTRAINT `company_id`
    FOREIGN KEY (`company_id`)
    REFERENCES `chkdcrm`.`company` (`company_id`)
    ON DELETE CASCADE)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
SET SQL_NOTES=@OLD_SQL_NOTES;

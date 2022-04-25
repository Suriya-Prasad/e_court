CREATE DATABASE  IF NOT EXISTS `e_courts` ;
USE `e_courts`;

-- Table structure for table `Employee`;

CREATE TABLE `employee` (
  `employeeID` int(20) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `e_mail` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `service_joining_date` date NOT NULL,
  `native_district` varchar(30) DEFAULT NULL,
  `date_of_birth` date,
  `gender` varchar(10) NOT NULL,
  `differently_abled` varchar(10) NOT NULL,
  `aadhar_number` varchar(12) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `religion` varchar(150) DEFAULT NULL,
  `community` varchar(250) DEFAULT NULL,
  `caste` varchar(250) DEFAULT NULL,
  `permanent_address` varchar(1000) DEFAULT NULL,
  `current_address` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`employeeID`),
  UNIQUE KEY `employee_name_UNIQUE` (`employee_name`)
) AUTO_INCREMENT=1;

-- Table structure for `Posting` ;

DROP TABLE IF EXISTS `postings`;

CREATE TABLE `posting` (
  `employeeID` int(20) NOT NULL,
  `posting` varchar(255) NOT NULL,
  `court` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date DEFAULT NULL,
  CONSTRAINT `fk_employeeID_posting` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for `spouse details` ;

DROP TABLE IF EXISTS `spouse/father_details`;

CREATE TABLE `spouse/father_details`(
  `employeeID` int (20) NOT NULL,
  `spouse/father_name` varchar(255) DEFAULT NULL,
  `spouse/father_occupation` varchar(255) DEFAULT NULL,
  `spouse/father_current_district` varchar(255) DEFAULT NULL,
  CONSTRAINT `fk_employeeID_spouse/father_details` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for `child_details` ;

DROP TABLE IF EXISTS `child_details`;

CREATE TABLE `child_details`(
  `employeeID` int(20) NOT NULL,
  `child_name` varchar(255) DEFAULT NULL,
  `special_child` varchar(255) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  CONSTRAINT `fk_employeeID_child_details` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for `bank_details` ;

DROP TABLE IF EXISTS `bank_details` ;

CREATE TABLE `bank_details` (
  `employeeID` int(20) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `ifsc_number` varchar(30) NOT NULL,
  CONSTRAINT `fk_employeeID_bank_details` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for `additional_info` ;

-- DROP TABLE IF EXISTS `additional_info`;

-- CREATE TABLE `additional_info`(

-- );
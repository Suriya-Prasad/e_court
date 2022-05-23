CREATE DATABASE  IF NOT EXISTS `e_courts` ;
USE `e_courts`;

-- Table structure for table `Employee`;

CREATE TABLE `employee` (
  `employeeID` int(20) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `e_mail` varchar(255) DEFAULT NULL,
  `phone_number` varchar(10) NOT NULL,
  `service_joining_date` date NOT NULL,
  `native_district` varchar(30) DEFAULT NULL,
  `date_of_birth` date,
  `gender` varchar(10) NOT NULL,
  `marital_status` varchar(10) NOT NULL,
  `spouse_father_name` varchar(100) NOT NULL,
  `differently_abled` varchar(10) NOT NULL,
  `aadhar_number` varchar(12) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `religion` varchar(150) DEFAULT NULL,
  `community` varchar(250) DEFAULT NULL,
  `caste` varchar(250) DEFAULT NULL,
  `permanent_address` varchar(1000) DEFAULT NULL,
  `current_address` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`employeeID`)
) AUTO_INCREMENT=1;

INSERT INTO employee VALUES ('1','pass', 'Arun', 'Prasad', 'suriya@mdfc.com', '1122334455', '2018-04-05', 'Tiruppur', '1996-05-04', 'male', 'no', 'Ponnusamy', 'no', 
'111222333444', '1122334455', 'Hindu', 'BC', 'C19', 'Vadugapalayam,Palladam', 'Vadugapalayam,Palladam');
INSERT INTO employee VALUES ('2','pass', 'Arul', 'Prakash', 'arul@mdfc.com', '1209348756', '2010-03-02', 'Madurai', '1976-09-12', 'male', 'yes', 'Narayanan', 'no', 
'000011112222', '0000011111', 'Hindu', 'FC', 'C71', 'Baker street,Udumelpet', 'Baker street,Udumelpet');
INSERT INTO employee VALUES ('3','pass', 'Joseph', 'Winmer', 'joseph@mdfc.com', '9898980099', '2020-12-24', 'Trichy', '1998-01-30', 'male', 'no', 'Wincent', 'no', 
'132435465768', '2143658709', 'Christianity', 'BC', 'C3', 'Gandhi nagar,Avinashi', 'Nallur,Tiruppur');
INSERT INTO employee VALUES ('4','pass', 'Mohammed', 'Tarik', 'mt@mdfc.com', '1089567423', '2010-07-22', 'Tiruppur', '1989-05-04', 'male', 'no', 'Toufic', 'no', 
'908766785656', '3243445612', 'Islam', 'MBC', 'C14', 'Pushpa Theatre,Tiruppur', 'Anna Nagar,Theni');
INSERT INTO employee VALUES ('5','pass', 'Karam', 'Singh', 'kaam@mdfc.com', '1424335567', '2009-10-10', 'Tuticorin', '1990-10-25', 'male', 'no', 'Vijendar', 'no', 
'121322333544', '11255693455', 'Sikkism', 'FC', 'C82', 'Sheriff Colony,Tiruppur', 'Golden Temple,Amritasar');


-- Table structure for `Posting` ;

DROP TABLE IF EXISTS `designation`;

CREATE TABLE `designation` (
  `employeeID` int(20) NOT NULL,
  `posting` varchar(255) NOT NULL,
  `court` varchar(255) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  CONSTRAINT `fk_employeeID_designation` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO designation VALUES ('2','post 2','court two','2010-03-02','2014-09-22');
INSERT INTO designation VALUES ('2','post 2','court three','2014-10-02','2016-06-01');
INSERT INTO designation (`employeeID`,`posting`,`court`,`from_date`) VALUES ('2','post 1','court three','2016-06-04');
INSERT INTO designation (`employeeID`,`posting`,`court`,`from_date`) VALUES ('1','post 2','court one','2018-04-05');
INSERT INTO designation VALUES ('4','post 3','court three','2010-07-22','2017-09-22');
INSERT INTO designation (`employeeID`,`posting`,`court`,`from_date`) VALUES ('4','post 2','court two','2017-09-25');
INSERT INTO designation (`employeeID`,`posting`,`court`,`from_date`) VALUES ('3','post 3','court two','2020-12-24');

-- Table structure for `spouse details` ;

DROP TABLE IF EXISTS `spouse_father_details`;

CREATE TABLE `spouse_father_details`(
  `employeeID` int (20) NOT NULL,
  `spouse_father_name` varchar(255) DEFAULT NULL,
  `spouse_father_occupation` varchar(255) DEFAULT NULL,
  `spouse_father_current_district` varchar(255) DEFAULT NULL,
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

-- Table structure for `disciplinary_proceeding` ;

DROP TABLE IF EXISTS `disciplinary_proceeding`;

CREATE TABLE `disciplinary_proceeding`(
  `employeeID` int(20) NOT NULL,
  `disciplinary_proceeding_court_name` varchar(200) NOT NULL,
  `disciplinary_proceeding_status` varchar(10) NOT NULL,
  `disciplinary_proceeding_details` varchar(500) NOT NULL,
  CONSTRAINT `fk_employeeID_disciplinary_proceeding` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for `leave_entry` ;

DROP TABLE IF EXISTS `leave_entry`;

CREATE TABLE `leave_entry`(
  `employeeID` int(20) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `session` varchar(20) NOT NULL,
  `leave_type` varchar(20) NOT NULL,
  `select_day_type` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  CONSTRAINT `fk_employeeID_leave_entry` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for `postings` ;

DROP TABLE IF EXISTS `postings`;

CREATE TABLE `postings`(
  `postingID` int(4) NOT NULL,
  `postingName` varchar(500) NOT NULL,
  PRIMARY KEY (`postingID`)
);

--Table structure for `courts` ;

DROP TABLE IF EXISTS `courts`;

CREATE TABLE `courts`(
  `courtID` int(4) NOT NULL,
  `courtName` varchar(500) NOT NULL,
  `courtPlace` varchar(500) NOT NULL,
  PRIMARY KEY (`courtID`)
);
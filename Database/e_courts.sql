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
  `posting_authority` varchar(500) NOT NULL,
  PRIMARY KEY (`postingID`)
);

INSERT INTO postings (`postingID`, `postingName`) 
VALUES 
(1,'Cheif Administrative Officer'),
(2,'Sherishtadar (category-1)'),
(3,'Bench Clerk Grade-1'),
(4,'Head Clerk (Cat-2/Senior Sherishtadar (Cat-11)/Protocal Officer/Central Nazir'),
(5,'Head Clerk (Cat-3)/Superintendent/Deputy Nazir/Translator'),
(6,'Executive Assistant'),
(7,'Gr. I Steno Typist'),
(8,'Grade 2 Bench Clerk'),(9,'Head Clerk Criminal Court(Cat-4)'),
(10,'Assistant'),
(11,'Steno-Typist(Gr.3)'),
(12,'Junior Assistant+Junior Superintendent od copyist=(2 posts)'),
(13,'Typist/Copyist'),
(14,'Computer Operator'),
(15,'Examiner/Reader'),
(16,'Senior Bailiff'),
(17,'Junior Bailiff'),
(18,'Driver'),
(19,'Xerox Machine operator'),
(20,'Record Clerk'),
(21,'Office Assistant'),
(22,'Scavenger'),
(23,'Sanitary Worker'),
(24,'Sweeper'),
(25,'Garder'),
(26,'Watchmen'),
(27,'Night Watchman'),
(28,'Masalchi cum Night Watchman'),
(29,'Masalchi');

-- Table structure for `courts` ;

DROP TABLE IF EXISTS `courts`;

CREATE TABLE `courts`(
  `courtID` int(4) NOT NULL,
  `courtName` varchar(500) NOT NULL,
  `courtPlace` varchar(500) NOT NULL,
  PRIMARY KEY (`courtID`)
);

INSERT INTO courts (`courtID`,`courtPlace`,`courtName`) 
values 
(1,'Tiruppur','District Court'),
(2,'Tiruppur','Addl. District Court'),
(3,'Tiruppur', 'Addl. District Court'),
( 4,'Tiruppur','C.J.M. Court'),
(5,'Tiruppur','Mahila Court'),
(6,'Tiruppur' ,'MACOP Court'),
(7,'Tiruppur','Family Court'),
( 8,'Tiruppur',' Principal Sub Court'),
(9,'Tiruppur',' Additional SubCourt'),
(10,'Tiruppur','District Munsif Court'),
(11,'Tiruppur','J.M.Court No.1'),
(12,'Tiruppur','J.M.Court No.2'),
(13,'Tiruppur','J.M.Court No.3'),
(14,'Tiruppur','J.M.Court NO.4'),
(15,'Tiruppur','J.M.Spl.,Court(L.G.)'),
(16,'Tiruppur','J.M.Court.,(FTC)'),
(17,'Tiruppur','Additional Mahila Court'),
(18,'Tiruppur','Additional Dtsrict Munsif court'),
(19,'Udumalpet','Sub Court'),
(20,'Udumalpet','District Munsif Court'),
(21,'Udumalpet','J.M.No.1 Court'),
(22,'Udumalpet','J.M.Court'),
(23,'Dharapuram','3 ADJ Court'),
(24,'Dharapuram','Sub Court'),
(25,'Dharapuram','District Munsif Court'),
(26,'Dharapuram','J.M.Court'),
(27,'Kangayam','Sub Court, Kangeyam'),
(28,'Kangayam','District Munsif Court'),
(29,'Kangayam','J.M.Court'),
(30,'Palladam','Sub Court, Palladam'),
(31,'Palladam','District Munsif Court'),
(32,'Palladam','J.M.Court'),
(33,'Avinashi','Sub Court'),
(34,'Avinashi','District Munsif Court'),
(35,'Avinashi','J.M.Court'),
(36,'Madathukulam','DM-CUM-JM'),
(37,'Uthukuli','DM-CUM-JM');
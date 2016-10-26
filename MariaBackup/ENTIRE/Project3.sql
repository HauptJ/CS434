-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.17-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for Project3
CREATE DATABASE IF NOT EXISTS `Project3` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Project3`;


-- Dumping structure for table Project3.CrimeReport
CREATE TABLE IF NOT EXISTS `CrimeReport` (
  `ReportNumber` int(9) unsigned NOT NULL,
  `DateFiled` date NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ReportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.CrimeReport: ~6 rows (approximately)
/*!40000 ALTER TABLE `CrimeReport` DISABLE KEYS */;
INSERT INTO `CrimeReport` (`ReportNumber`, `DateFiled`, `Description`) VALUES
	(109, '2002-10-19', 'Sue Hollenbeck Area Test Desc9'),
	(130510483, '2013-05-26', 'PLAIN THEFT UNDER $400. MISSING PURSE.'),
	(130608787, '2013-03-10', 'TRAFFIC DR # EXPIRED'),
	(131817514, '2013-10-18', 'TRAFFIC DR # EXPIRED'),
	(131820260, '2013-12-18', 'TRAFFIC DR # EXPIRED'),
	(132007717, '2013-03-20', 'TRAFFIC DR # EXPIRED');
/*!40000 ALTER TABLE `CrimeReport` ENABLE KEYS */;


-- Dumping structure for table Project3.CriminalIncident
CREATE TABLE IF NOT EXISTS `CriminalIncident` (
  `IncidentNumber` int(9) unsigned NOT NULL,
  `TimeOccurred` smallint(4) unsigned NOT NULL,
  `DateOccurred` date NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`IncidentNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.CriminalIncident: ~5 rows (approximately)
/*!40000 ALTER TABLE `CriminalIncident` DISABLE KEYS */;
INSERT INTO `CriminalIncident` (`IncidentNumber`, `TimeOccurred`, `DateOccurred`, `Address`) VALUES
	(130510483, 2000, '2013-05-25', 'WestSepulveda Bouleard'),
	(130608787, 445, '2013-03-10', 'Odin Street'),
	(131817514, 1730, '2013-10-18', '101st Street'),
	(131820260, 745, '2013-12-18', '105th Street'),
	(132007717, 2015, '2013-03-20', 'Oxford');
/*!40000 ALTER TABLE `CriminalIncident` ENABLE KEYS */;


-- Dumping structure for table Project3.DefinedBy
CREATE TABLE IF NOT EXISTS `DefinedBy` (
  `Def_IncidentNumber` int(9) unsigned NOT NULL,
  `Def_CodeDesignation` varchar(12) NOT NULL,
  PRIMARY KEY (`Def_IncidentNumber`),
  KEY `Def_CodeDesignation` (`Def_CodeDesignation`),
  CONSTRAINT `DefinedBy_ibfk_1` FOREIGN KEY (`Def_IncidentNumber`) REFERENCES `CriminalIncident` (`IncidentNumber`),
  CONSTRAINT `DefinedBy_ibfk_2` FOREIGN KEY (`Def_CodeDesignation`) REFERENCES `Statute` (`CodeDesignation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.DefinedBy: ~5 rows (approximately)
/*!40000 ALTER TABLE `DefinedBy` DISABLE KEYS */;
INSERT INTO `DefinedBy` (`Def_IncidentNumber`, `Def_CodeDesignation`) VALUES
	(130608787, 'PEN-187'),
	(132007717, 'PEN-187'),
	(130510483, 'PEN-211'),
	(131817514, 'PEN-404'),
	(131820260, 'PEN-404');
/*!40000 ALTER TABLE `DefinedBy` ENABLE KEYS */;


-- Dumping structure for table Project3.FiledBy
CREATE TABLE IF NOT EXISTS `FiledBy` (
  `File_DateGraduated` date NOT NULL,
  `File_BadgeNumber` smallint(5) unsigned NOT NULL,
  `File_ReportNumber` int(9) unsigned NOT NULL,
  PRIMARY KEY (`File_DateGraduated`,`File_BadgeNumber`,`File_ReportNumber`),
  KEY `File_ReportNumber` (`File_ReportNumber`),
  CONSTRAINT `FiledBy_ibfk_1` FOREIGN KEY (`File_DateGraduated`, `File_BadgeNumber`) REFERENCES `PoliceOfficer` (`DateGraduated`, `BadgeNumber`),
  CONSTRAINT `FiledBy_ibfk_2` FOREIGN KEY (`File_ReportNumber`) REFERENCES `CrimeReport` (`ReportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.FiledBy: ~5 rows (approximately)
/*!40000 ALTER TABLE `FiledBy` DISABLE KEYS */;
INSERT INTO `FiledBy` (`File_DateGraduated`, `File_BadgeNumber`, `File_ReportNumber`) VALUES
	('1977-09-11', 22, 131817514),
	('1977-09-11', 22, 132007717),
	('1983-07-22', 76, 130510483),
	('1992-03-13', 406, 130510483),
	('1999-02-27', 9942, 132007717);
/*!40000 ALTER TABLE `FiledBy` ENABLE KEYS */;


-- Dumping structure for table Project3.MemberOf
CREATE TABLE IF NOT EXISTS `MemberOf` (
  `Mem_DateGraduated` date NOT NULL,
  `Mem_BadgeNumber` smallint(5) unsigned NOT NULL,
  `Mem_PrecinctNumber` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`Mem_DateGraduated`,`Mem_BadgeNumber`),
  KEY `Mem_PrecinctNumber` (`Mem_PrecinctNumber`),
  CONSTRAINT `MemberOf_ibfk_1` FOREIGN KEY (`Mem_DateGraduated`, `Mem_BadgeNumber`) REFERENCES `PoliceOfficer` (`DateGraduated`, `BadgeNumber`),
  CONSTRAINT `MemberOf_ibfk_2` FOREIGN KEY (`Mem_PrecinctNumber`) REFERENCES `PoliceDepartment` (`PrecinctNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.MemberOf: ~5 rows (approximately)
/*!40000 ALTER TABLE `MemberOf` DISABLE KEYS */;
INSERT INTO `MemberOf` (`Mem_DateGraduated`, `Mem_BadgeNumber`, `Mem_PrecinctNumber`) VALUES
	('1977-09-11', 22, 1),
	('1983-07-22', 76, 1),
	('2002-10-18', 12001, 1),
	('1992-03-13', 406, 2),
	('1999-02-27', 9942, 2);
/*!40000 ALTER TABLE `MemberOf` ENABLE KEYS */;


-- Dumping structure for table Project3.PoliceDepartment
CREATE TABLE IF NOT EXISTS `PoliceDepartment` (
  `PrecinctNumber` tinyint(2) unsigned NOT NULL,
  `Jurisdiction` varchar(50) NOT NULL,
  PRIMARY KEY (`PrecinctNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.PoliceDepartment: ~5 rows (approximately)
/*!40000 ALTER TABLE `PoliceDepartment` DISABLE KEYS */;
INSERT INTO `PoliceDepartment` (`PrecinctNumber`, `Jurisdiction`) VALUES
	(1, 'Central Area'),
	(2, 'Rampart Area'),
	(3, 'Southwest Area'),
	(4, 'HollenBeck Area'),
	(5, 'Harbor Area');
/*!40000 ALTER TABLE `PoliceDepartment` ENABLE KEYS */;


-- Dumping structure for table Project3.PoliceOfficer
CREATE TABLE IF NOT EXISTS `PoliceOfficer` (
  `DateGraduated` date NOT NULL,
  `BadgeNumber` smallint(5) unsigned NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  PRIMARY KEY (`DateGraduated`,`BadgeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.PoliceOfficer: ~5 rows (approximately)
/*!40000 ALTER TABLE `PoliceOfficer` DISABLE KEYS */;
INSERT INTO `PoliceOfficer` (`DateGraduated`, `BadgeNumber`, `LastName`, `FirstName`) VALUES
	('1977-09-11', 22, 'Davis', 'Miles'),
	('1983-07-22', 76, 'Cornish', 'Eleanor'),
	('1992-03-13', 406, 'Brown', 'Susan'),
	('1999-02-27', 9942, 'Jijekjesh', 'Ryan'),
	('2002-10-18', 12001, 'Hershey', 'John');
/*!40000 ALTER TABLE `PoliceOfficer` ENABLE KEYS */;


-- Dumping structure for table Project3.ReportedThrough
CREATE TABLE IF NOT EXISTS `ReportedThrough` (
  `Rep_ReportNumber` int(9) unsigned NOT NULL,
  `Rep_IncidentNumber` int(9) unsigned NOT NULL,
  PRIMARY KEY (`Rep_ReportNumber`),
  KEY `Rep_IncidentNumber` (`Rep_IncidentNumber`),
  CONSTRAINT `ReportedThrough_ibfk_1` FOREIGN KEY (`Rep_ReportNumber`) REFERENCES `CrimeReport` (`ReportNumber`),
  CONSTRAINT `ReportedThrough_ibfk_2` FOREIGN KEY (`Rep_IncidentNumber`) REFERENCES `CriminalIncident` (`IncidentNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.ReportedThrough: ~5 rows (approximately)
/*!40000 ALTER TABLE `ReportedThrough` DISABLE KEYS */;
INSERT INTO `ReportedThrough` (`Rep_ReportNumber`, `Rep_IncidentNumber`) VALUES
	(130510483, 130510483),
	(130608787, 130608787),
	(131817514, 131817514),
	(131820260, 131820260),
	(132007717, 132007717);
/*!40000 ALTER TABLE `ReportedThrough` ENABLE KEYS */;


-- Dumping structure for table Project3.StatusUpdate
CREATE TABLE IF NOT EXISTS `StatusUpdate` (
  `Stat_ReportNumber` int(9) unsigned NOT NULL,
  `RevisionNumber` tinyint(3) unsigned NOT NULL,
  `DateRevised` date NOT NULL,
  `Status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`Stat_ReportNumber`,`RevisionNumber`),
  CONSTRAINT `StatusUpdate_ibfk_1` FOREIGN KEY (`Stat_ReportNumber`) REFERENCES `CrimeReport` (`ReportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.StatusUpdate: ~5 rows (approximately)
/*!40000 ALTER TABLE `StatusUpdate` DISABLE KEYS */;
INSERT INTO `StatusUpdate` (`Stat_ReportNumber`, `RevisionNumber`, `DateRevised`, `Status`) VALUES
	(130510483, 1, '2013-05-26', 2),
	(130510483, 2, '2013-07-13', 3),
	(131817514, 1, '2013-10-18', 2),
	(131817514, 2, '2013-10-18', 3),
	(132007717, 1, '2013-03-20', 1);
/*!40000 ALTER TABLE `StatusUpdate` ENABLE KEYS */;


-- Dumping structure for table Project3.Statute
CREATE TABLE IF NOT EXISTS `Statute` (
  `CodeDesignation` varchar(12) NOT NULL,
  `ElementsOfCrime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeDesignation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table Project3.Statute: ~5 rows (approximately)
/*!40000 ALTER TABLE `Statute` DISABLE KEYS */;
INSERT INTO `Statute` (`CodeDesignation`, `ElementsOfCrime`) VALUES
	('PEN-102', 1003813),
	('PEN-187', 6839),
	('PEN-211', 120038),
	('PEN-240', 5164921),
	('PEN-404', 583860);
/*!40000 ALTER TABLE `Statute` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

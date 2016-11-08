-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.0.27-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for Project3
CREATE DATABASE IF NOT EXISTS `Project4` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Project4`;


-- Dumping structure for table Project3.CrimeReport
CREATE TABLE IF NOT EXISTS `CrimeReport` (
  `ReportNumber` int(9) unsigned NOT NULL,
  `DateFiled` date NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`ReportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Project3.CriminalIncident
CREATE TABLE IF NOT EXISTS `CriminalIncident` (
  `IncidentNumber` int(9) unsigned NOT NULL,
  `TimeOccurred` smallint(4) unsigned NOT NULL,
  `DateOccurred` date NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`IncidentNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Project3.DefinedBy
CREATE TABLE IF NOT EXISTS `DefinedBy` (
  `Def_IncidentNumber` int(9) unsigned NOT NULL,
  `Def_CodeDesignation` varchar(12) NOT NULL,
  PRIMARY KEY (`Def_IncidentNumber`),
  KEY `Def_CodeDesignation` (`Def_CodeDesignation`),
  CONSTRAINT `DefinedBy_ibfk_1` FOREIGN KEY (`Def_IncidentNumber`) REFERENCES `CriminalIncident` (`IncidentNumber`),
  CONSTRAINT `DefinedBy_ibfk_2` FOREIGN KEY (`Def_CodeDesignation`) REFERENCES `Statute` (`CodeDesignation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


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

-- Data exporting was unselected.


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

-- Data exporting was unselected.


-- Dumping structure for table Project3.PoliceDepartment
CREATE TABLE IF NOT EXISTS `PoliceDepartment` (
  `PrecinctNumber` tinyint(2) unsigned NOT NULL,
  `Jurisdiction` varchar(50) NOT NULL,
  PRIMARY KEY (`PrecinctNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Project3.PoliceOfficer
CREATE TABLE IF NOT EXISTS `PoliceOfficer` (
  `DateGraduated` date NOT NULL,
  `BadgeNumber` smallint(5) unsigned NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  PRIMARY KEY (`DateGraduated`,`BadgeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Project3.ReportedThrough
CREATE TABLE IF NOT EXISTS `ReportedThrough` (
  `Rep_ReportNumber` int(9) unsigned NOT NULL,
  `Rep_IncidentNumber` int(9) unsigned NOT NULL,
  PRIMARY KEY (`Rep_ReportNumber`),
  KEY `Rep_IncidentNumber` (`Rep_IncidentNumber`),
  CONSTRAINT `ReportedThrough_ibfk_1` FOREIGN KEY (`Rep_ReportNumber`) REFERENCES `CrimeReport` (`ReportNumber`),
  CONSTRAINT `ReportedThrough_ibfk_2` FOREIGN KEY (`Rep_IncidentNumber`) REFERENCES `CriminalIncident` (`IncidentNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Project3.StatusUpdate
CREATE TABLE IF NOT EXISTS `StatusUpdate` (
  `Stat_ReportNumber` int(9) unsigned NOT NULL,
  `RevisionNumber` tinyint(3) unsigned NOT NULL,
  `DateRevised` date NOT NULL,
  `Status` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`Stat_ReportNumber`,`RevisionNumber`),
  CONSTRAINT `StatusUpdate_ibfk_1` FOREIGN KEY (`Stat_ReportNumber`) REFERENCES `CrimeReport` (`ReportNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table Project3.Statute
CREATE TABLE IF NOT EXISTS `Statute` (
  `CodeDesignation` varchar(12) NOT NULL,
  `ElementsOfCrime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CodeDesignation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

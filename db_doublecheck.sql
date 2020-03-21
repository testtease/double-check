-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_doublecheck
CREATE DATABASE IF NOT EXISTS `db_doublecheck` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_doublecheck`;

-- Dumping structure for table db_doublecheck.mst_user
CREATE TABLE IF NOT EXISTS `mst_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table db_doublecheck.mst_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `mst_user` DISABLE KEYS */;
REPLACE INTO `mst_user` (`id`, `username`, `email`, `nik`, `password`, `section`, `level`, `date_created`) VALUES
	(2, 'user', 'user@jai.co.id', '0000038145', 'asdasasd', 'exim', 'SPV', '2020-03-21 12:07:02'),
	(10, 'ARTHUR', 'arthur@jai.co.id', '0000031111', '$2y$10$amUoSFe.2Y1jWTR//VlPl.TNXHH4nAq2p/Ou1hSBJFiPb.wN/U6Ry', 'EXIM', 'SPV', '2020-03-21 14:36:30');
/*!40000 ALTER TABLE `mst_user` ENABLE KEYS */;

-- Dumping structure for table db_doublecheck.scan_in
CREATE TABLE IF NOT EXISTS `scan_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jai_label` varchar(100) NOT NULL,
  `assy_code_label` varchar(100) NOT NULL,
  `ctn_no1` int(11) NOT NULL,
  `ctn_no2` int(11) NOT NULL,
  `jai_qr` varchar(100) NOT NULL,
  `assy_code_qr` varchar(100) NOT NULL,
  `ctn_no_qr` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table db_doublecheck.scan_in: ~6 rows (approximately)
/*!40000 ALTER TABLE `scan_in` DISABLE KEYS */;
REPLACE INTO `scan_in` (`id`, `nik`, `nama`, `jai_label`, `assy_code_label`, `ctn_no1`, `ctn_no2`, `jai_qr`, `assy_code_qr`, `ctn_no_qr`, `status`, `date_created`) VALUES
	(1, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CR39S0000029', 'CR39', 29, 'VALID', '2020-03-17 23:00:22'),
	(2, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CR39S0000029', 'CR39', 29, 'VALID', '2020-03-17 23:00:22'),
	(3, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CTJ9S0002962', 'CTJ9', 2962, 'TIDAK VALID', '2020-03-17 23:00:22'),
	(4, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CTS9S0002399', 'CTS9', 2399, 'TIDAK VALID', '2020-03-17 23:00:22'),
	(5, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CR39S0000029', 'CR39', 29, 'VALID', '2020-03-17 23:00:22'),
	(6, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CTS9S0002399', 'CTS9', 2399, 'TIDAK VALID', '2020-03-17 23:00:22'),
	(7, '0000038145', 'user', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CR39S0000029', 'CR39', 29, 'VALID', '2020-03-19 05:48:07');
/*!40000 ALTER TABLE `scan_in` ENABLE KEYS */;

-- Dumping structure for table db_doublecheck.scan_out
CREATE TABLE IF NOT EXISTS `scan_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jai_label` varchar(100) NOT NULL,
  `assy_code_label` varchar(100) NOT NULL,
  `ctn_no1` int(11) NOT NULL,
  `ctn_no2` int(11) NOT NULL,
  `jai_qr` varchar(100) NOT NULL,
  `assy_code_qr` varchar(100) NOT NULL,
  `ctn_no_qr` int(11) NOT NULL,
  `master_pallet` varchar(50) NOT NULL,
  `assy_code_pallet` varchar(50) NOT NULL,
  `ctn_no1_pallet` int(11) NOT NULL,
  `ctn_no2_pallet` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Dumping data for table db_doublecheck.scan_out: ~2 rows (approximately)
/*!40000 ALTER TABLE `scan_out` DISABLE KEYS */;
REPLACE INTO `scan_out` (`id`, `nik`, `nama`, `jai_label`, `assy_code_label`, `ctn_no1`, `ctn_no2`, `jai_qr`, `assy_code_qr`, `ctn_no_qr`, `master_pallet`, `assy_code_pallet`, `ctn_no1_pallet`, `ctn_no2_pallet`, `status`, `date_created`) VALUES
	(7, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CR39S0000029', 'CR39', 29, 'SIJ0CLO50910037056', 'CLO5', 124, 123, 'TIDAK VALID', '2020-03-18 19:10:01'),
	(8, '', '', 'JAI0000226538', 'CR39', 29, 29, 'SIJ0CR39S0000029', 'CR39', 29, 'SIJ0CLO50910037056', 'CLO5', 104, 123, 'TIDAK VALID', '2020-03-18 19:11:16');
/*!40000 ALTER TABLE `scan_out` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

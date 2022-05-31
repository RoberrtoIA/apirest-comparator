-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for comparator
CREATE DATABASE IF NOT EXISTS `comparator` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `comparator`;

-- Dumping structure for table comparator.cpu
CREATE TABLE IF NOT EXISTS `cpu` (
  `idCPU` int(11) NOT NULL AUTO_INCREMENT,
  `CPUModel` varchar(200) NOT NULL,
  `Score` bigint(20) NOT NULL,
  `Speed` double NOT NULL,
  `idCPUBrand` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `Available` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCPU`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.cpu: ~34 rows (approximately)
/*!40000 ALTER TABLE `cpu` DISABLE KEYS */;
INSERT INTO `cpu` (`idCPU`, `CPUModel`, `Score`, `Speed`, `idCPUBrand`, `updated_at`, `created_at`, `Available`) VALUES
	(1, 'Snapdragon 865', 600051, 2.84, 2, NULL, NULL, 1),
	(2, 'Snapdragon 870', 655403, 3.2, 2, NULL, NULL, 1),
	(3, 'Snapdragon 750g', 330287, 2.2, 2, NULL, NULL, 1),
	(4, 'Snapdragon 720g', 281212, 1.866, 2, NULL, NULL, 1),
	(5, 'Snapdragon 730g', 281897, 2.2, 2, NULL, NULL, 1),
	(6, 'Snapdragon 888', 801911, 3, 2, NULL, NULL, 1),
	(7, 'Helio G80', 66816, 0.98, 3, NULL, NULL, 1),
	(8, 'Helio G90', 338789, 2.05, 3, NULL, NULL, 1),
	(9, 'Helio G90T', 329819, 2.05, 3, NULL, NULL, 1),
	(10, 'Helio G95', 339583, 2.05, 3, NULL, NULL, 1),
	(11, 'Dimensity 1100', 610354, 2.6, 3, NULL, NULL, 1),
	(12, 'Dimensity 700', 294507, 2.2, 3, NULL, NULL, 1),
	(13, 'Dimensity 810', 409591, 2.4, 3, NULL, NULL, 1),
	(14, 'Dimensity 920', 487768, 2.5, 3, NULL, NULL, 1),
	(15, 'Dimensity 900', 418878, 2.4, 3, NULL, NULL, 1),
	(16, 'A13 Bionic', 526466, 2.65, 6, NULL, NULL, 1),
	(17, 'A14 Bionic', 614956, 3, 6, NULL, NULL, 1),
	(18, 'A15 Bionic', 839675, 3.23, 6, NULL, NULL, 1),
	(19, 'A12 Bionic', 407476, 2.3, 6, NULL, NULL, 1),
	(20, 'Kirin 9000', 693605, 3.3, 4, NULL, NULL, 1),
	(21, 'Kirin 710', 167033, 2.2, 4, NULL, NULL, 1),
	(22, 'Kirin 980', 405274, 2.6, 4, NULL, NULL, 1),
	(23, 'Kirin 9000E', 642091, 3.13, 4, NULL, NULL, 1),
	(24, 'Kirin 970', 320098, 2.4, 4, NULL, NULL, 1),
	(25, 'Exynos 2200', 900045, 2.9, 5, NULL, NULL, 1),
	(26, 'Exynos 880', 315788, 2, 5, NULL, NULL, 1),
	(27, 'Exynos 1080', 646617, 2.8, 5, NULL, NULL, 1),
	(28, 'Snapdragon 678', 281472, 2.2, 2, NULL, NULL, 1),
	(29, 'Exynos 2100', 747682, 2.9, 5, NULL, NULL, 1),
	(30, 'Snapdragon 1000', 1000, 1000, 2, '2022-05-30 16:08:43', '2022-05-30 15:43:15', 0),
	(31, 'Snapdragon 732g', 347612, 2.3, 2, '2022-05-30 18:45:21', '2022-05-30 18:43:27', 1),
	(32, 'Snapdragon 732', 347612, 2.3, 2, '2022-05-31 00:14:14', '2022-05-30 20:45:13', 0),
	(33, 'Snapdragon 732T', 347612, 2.3, 2, '2022-05-30 20:59:29', '2022-05-30 20:59:29', 1),
	(34, 'Snapdragon 732g', 845364, 3.1, 2, '2022-05-30 23:26:43', '2022-05-30 21:28:05', 1),
	(35, 'Snapdragon 732U', 347612, 2.3, 2, '2022-05-30 23:24:44', '2022-05-30 23:24:44', 1);
/*!40000 ALTER TABLE `cpu` ENABLE KEYS */;

-- Dumping structure for table comparator.cpubrand
CREATE TABLE IF NOT EXISTS `cpubrand` (
  `idCPUBrand` int(11) NOT NULL AUTO_INCREMENT,
  `CPUBrand` varchar(100) NOT NULL,
  PRIMARY KEY (`idCPUBrand`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.cpubrand: ~5 rows (approximately)
/*!40000 ALTER TABLE `cpubrand` DISABLE KEYS */;
INSERT INTO `cpubrand` (`idCPUBrand`, `CPUBrand`) VALUES
	(2, 'Qualcomm'),
	(3, 'MediaTek'),
	(4, 'HiSilicon'),
	(5, 'Samsung'),
	(6, 'Apple Silicon');
/*!40000 ALTER TABLE `cpubrand` ENABLE KEYS */;

-- Dumping structure for table comparator.glass
CREATE TABLE IF NOT EXISTS `glass` (
  `idGlass` int(11) NOT NULL AUTO_INCREMENT,
  `Glass` varchar(200) NOT NULL,
  `Score` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idGlass`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.glass: ~14 rows (approximately)
/*!40000 ALTER TABLE `glass` DISABLE KEYS */;
INSERT INTO `glass` (`idGlass`, `Glass`, `Score`, `available`, `created_at`, `updated_at`) VALUES
	(1, 'None', 0, 1, NULL, NULL),
	(2, 'Gorilla Glass 1', 1, 1, NULL, NULL),
	(3, 'Gorilla Glass 2', 2, 1, NULL, NULL),
	(4, 'Gorilla Glass 3', 3, 1, NULL, NULL),
	(5, 'Gorilla Glass 4', 4, 1, NULL, NULL),
	(6, 'Gorilla Glass 5', 5, 1, NULL, NULL),
	(7, 'Gorilla Glass 6', 6, 1, NULL, NULL),
	(8, 'Gorilla Glass DX', 7, 1, NULL, NULL),
	(9, 'Gorilla Glass DX+', 8, 1, NULL, NULL),
	(10, 'Gorilla Glass Victus', 9, 1, NULL, NULL),
	(11, 'Example', 20, 0, '2022-05-30 02:21:43', '2022-05-30 03:46:23'),
	(12, 'Ultimate 2', 20, 0, '2022-05-30 14:46:51', '2022-05-31 00:51:58'),
	(13, 'Gorilla The Limit', 50, 1, '2022-05-31 00:20:16', '2022-05-31 00:20:16'),
	(14, 'Gorilla The Limit 2', 100, 1, '2022-05-31 00:24:48', '2022-05-31 00:24:48'),
	(15, 'Gorilla The Limit 3', 150, 0, '2022-05-31 00:25:23', '2022-05-31 00:52:24');
/*!40000 ALTER TABLE `glass` ENABLE KEYS */;

-- Dumping structure for table comparator.model
CREATE TABLE IF NOT EXISTS `model` (
  `idModel` int(11) NOT NULL AUTO_INCREMENT,
  `Serie` varchar(200) NOT NULL,
  `YEAR` varchar(50) NOT NULL DEFAULT '',
  `ScreenSize` double NOT NULL,
  `PixelDensity` bigint(20) NOT NULL,
  `BatteryPower` bigint(20) NOT NULL,
  `RAM` int(11) NOT NULL,
  `ResolutionX` bigint(20) NOT NULL,
  `ResolutionY` bigint(20) NOT NULL,
  `FrontMainCamera` double NOT NULL,
  `BackMainCamera` double NOT NULL,
  `Weight` double NOT NULL,
  `Waterproof` int(11) NOT NULL,
  `RefreshRate` bigint(20) NOT NULL,
  `idOS` int(11) NOT NULL,
  `idModelMaterial` int(11) NOT NULL,
  `idScreenMaterial` int(11) NOT NULL,
  `idGlass` int(11) NOT NULL,
  `idCPU` int(11) NOT NULL,
  `idModelBrand` int(11) NOT NULL,
  `STATUS` varchar(50) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `Available` int(11) DEFAULT NULL,
  PRIMARY KEY (`idModel`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.model: ~7 rows (approximately)
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` (`idModel`, `Serie`, `YEAR`, `ScreenSize`, `PixelDensity`, `BatteryPower`, `RAM`, `ResolutionX`, `ResolutionY`, `FrontMainCamera`, `BackMainCamera`, `Weight`, `Waterproof`, `RefreshRate`, `idOS`, `idModelMaterial`, `idScreenMaterial`, `idGlass`, `idCPU`, `idModelBrand`, `STATUS`, `updated_at`, `created_at`, `Available`) VALUES
	(1, 'Poco F3', '2021', 6.67, 395, 4520, 8, 1080, 2400, 48, 20, 196, 0, 120, 9, 3, 2, 5, 2, 3, 'Active', NULL, NULL, 1),
	(2, 'Redmi Note 10', '2021', 6.43, 409, 5000, 6, 1080, 2400, 48, 8, 178.8, 0, 120, 8, 3, 2, 4, 28, 3, 'Active', NULL, NULL, 1),
	(3, 'Galaxy S21', '2021', 6.21, 421, 4000, 8, 1080, 2400, 64, 10, 171, 1, 120, 8, 2, 2, 10, 29, 1, 'Active', NULL, NULL, 1),
	(4, '6', '2020', 6.5, 405, 4300, 8, 1080, 2400, 16, 64, 191, 0, 90, 7, 3, 1, 6, 9, 9, 'Active', '2022-05-30 17:21:10', '2022-05-30 17:21:10', 1),
	(5, 'Redmi Note 10 Pro', '2021', 6.67, 393, 5020, 8, 1080, 2400, 16, 108, 193, 0, 120, 8, 3, 2, 10, 31, 3, 'Active', '2022-05-30 18:49:31', '2022-05-30 18:34:43', 1),
	(6, '7', '2020', 6.5, 405, 4300, 8, 1080, 2400, 16, 64, 191, 0, 90, 7, 3, 1, 6, 9, 9, 'Active', '2022-05-30 18:57:22', '2022-05-30 18:55:33', 0),
	(7, 'iPhone 13', '2021', 6.1, 460, 3227, 4, 1170, 2532, 12, 12, 173, 1, 60, 19, 2, 2, 10, 18, 2, 'Active', '2022-05-31 02:12:41', '2022-05-31 02:12:41', 1),
	(8, 'Redmi Note 20 Pro', '2021', 6.67, 393, 5020, 8, 1080, 2400, 16, 108, 193, 0, 120, 8, 3, 2, 10, 31, 3, 'Active', '2022-05-31 02:40:09', '2022-05-31 02:33:19', 0);
/*!40000 ALTER TABLE `model` ENABLE KEYS */;

-- Dumping structure for table comparator.modelbrand
CREATE TABLE IF NOT EXISTS `modelbrand` (
  `idModelBrand` int(11) NOT NULL AUTO_INCREMENT,
  `Brand` varchar(200) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `Available` int(11) DEFAULT NULL,
  PRIMARY KEY (`idModelBrand`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.modelbrand: ~9 rows (approximately)
/*!40000 ALTER TABLE `modelbrand` DISABLE KEYS */;
INSERT INTO `modelbrand` (`idModelBrand`, `Brand`, `updated_at`, `created_at`, `Available`) VALUES
	(1, 'Samsung', NULL, NULL, 1),
	(2, 'Apple', NULL, NULL, 1),
	(3, 'Xiaomi', NULL, NULL, 1),
	(4, 'Sony', NULL, NULL, 1),
	(5, 'Huawei', NULL, NULL, 1),
	(6, 'Google', NULL, NULL, 1),
	(7, 'LG', NULL, NULL, 1),
	(8, 'Alcatel', '2022-05-30 14:59:39', '2022-05-30 14:24:39', 0),
	(9, 'Realme', '2022-05-30 17:12:49', '2022-05-30 17:12:49', 1),
	(10, 'Realme 2', '2022-05-31 01:22:47', '2022-05-31 00:56:46', 0),
	(11, 'Realme 11', '2022-05-31 01:20:06', '2022-05-31 01:09:19', 0);
/*!40000 ALTER TABLE `modelbrand` ENABLE KEYS */;

-- Dumping structure for table comparator.modelmaterial
CREATE TABLE IF NOT EXISTS `modelmaterial` (
  `idModelMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `Material` varchar(100) NOT NULL,
  `Score` int(11) NOT NULL,
  PRIMARY KEY (`idModelMaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.modelmaterial: ~3 rows (approximately)
/*!40000 ALTER TABLE `modelmaterial` DISABLE KEYS */;
INSERT INTO `modelmaterial` (`idModelMaterial`, `Material`, `Score`) VALUES
	(1, 'Plastic', 1),
	(2, 'Crystal', 2),
	(3, 'Metal', 3);
/*!40000 ALTER TABLE `modelmaterial` ENABLE KEYS */;

-- Dumping structure for table comparator.os
CREATE TABLE IF NOT EXISTS `os` (
  `idOS` int(11) NOT NULL AUTO_INCREMENT,
  `OS` varchar(100) NOT NULL,
  `OSVersion` varchar(50) NOT NULL DEFAULT '',
  `Score` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `Available` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOS`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.os: ~24 rows (approximately)
/*!40000 ALTER TABLE `os` DISABLE KEYS */;
INSERT INTO `os` (`idOS`, `OS`, `OSVersion`, `Score`, `updated_at`, `created_at`, `Available`) VALUES
	(1, 'Android', '5', 5, NULL, NULL, 1),
	(2, 'Android', '6', 6, NULL, NULL, 1),
	(3, 'Android', '7', 7, NULL, NULL, 1),
	(5, 'Android', '8', 8, NULL, NULL, 1),
	(6, 'Android', '9', 9, NULL, NULL, 1),
	(7, 'Android', '10', 10, NULL, NULL, 1),
	(8, 'Android', '11', 11, NULL, NULL, 1),
	(9, 'Android', '12', 12, NULL, NULL, 1),
	(10, 'Android', '13', 13, NULL, NULL, 1),
	(11, 'iOS', '7', 7, NULL, NULL, 1),
	(12, 'iOS', '8', 8, NULL, NULL, 1),
	(13, 'iOS', '9', 9, NULL, NULL, 1),
	(14, 'iOS', '10', 10, NULL, NULL, 1),
	(15, 'iOS', '11', 11, NULL, NULL, 1),
	(16, 'iOS', '12', 12, NULL, NULL, 1),
	(17, 'iOS', '13', 13, NULL, NULL, 1),
	(18, 'iOS', '14', 14, NULL, NULL, 1),
	(19, 'iOS', '15', 15, NULL, NULL, 1),
	(20, 'Android', '1', 1, '2022-05-30 04:54:21', '2022-05-30 04:32:16', 0),
	(21, 'Android', '14', 14, '2022-05-30 04:56:58', '2022-05-30 04:56:05', 0),
	(22, 'Android', '1', 1, '2022-05-30 14:41:53', '2022-05-30 14:37:38', 0),
	(23, 'Android', '14', 14, '2022-05-31 01:51:51', '2022-05-31 01:37:24', 0),
	(24, 'Android', '14', 14, '2022-05-31 01:51:27', '2022-05-31 01:37:28', 0),
	(25, 'Android', '25', 1, '2022-05-31 01:51:22', '2022-05-31 01:39:31', 0),
	(26, 'Android', '120', 120, '2022-05-31 01:53:39', '2022-05-31 01:52:45', 0);
/*!40000 ALTER TABLE `os` ENABLE KEYS */;

-- Dumping structure for view comparator.processors
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `processors` (
	`CPUBrand` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`CPUModel` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`Speed` DOUBLE NOT NULL,
	`Score` BIGINT(20) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for table comparator.screenmaterial
CREATE TABLE IF NOT EXISTS `screenmaterial` (
  `idScreenMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `Material` varchar(100) NOT NULL,
  `Score` int(11) NOT NULL,
  PRIMARY KEY (`idScreenMaterial`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.screenmaterial: ~2 rows (approximately)
/*!40000 ALTER TABLE `screenmaterial` DISABLE KEYS */;
INSERT INTO `screenmaterial` (`idScreenMaterial`, `Material`, `Score`) VALUES
	(1, 'LCD', 1),
	(2, 'OLED', 2);
/*!40000 ALTER TABLE `screenmaterial` ENABLE KEYS */;

-- Dumping structure for view comparator.smartphones
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `smartphones` (
	`idModel` INT(11) NOT NULL,
	`Smartphone` VARCHAR(401) NOT NULL COLLATE 'latin1_swedish_ci',
	`YEAR` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`ScreenSize` DOUBLE NOT NULL,
	`PixelDensity` BIGINT(20) NOT NULL,
	`BatteryPower` BIGINT(20) NOT NULL,
	`RAM` INT(11) NOT NULL,
	`ResolutionX` BIGINT(20) NOT NULL,
	`ResolutionY` BIGINT(20) NOT NULL,
	`FrontMainCamera` DOUBLE NOT NULL,
	`BackMainCamera` DOUBLE NOT NULL,
	`Weight` DOUBLE NOT NULL,
	`Waterproof` INT(11) NOT NULL,
	`RefreshRate` BIGINT(20) NOT NULL,
	`OS` VARCHAR(151) NOT NULL COLLATE 'latin1_swedish_ci',
	`CPUBrand` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`CPUModel` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`Score` BIGINT(20) NOT NULL,
	`Material` VARCHAR(100) NOT NULL COLLATE 'latin1_swedish_ci',
	`Glass` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci',
	`STATUS` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`Available` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for table comparator.users
CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table comparator.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`idUsers`, `NAME`, `email`, `PASSWORD`, `remember_token`, `created_at`, `updated_at`) VALUES
	(3, 'Toby', 'toby@gmail.com', '$2y$10$JmK/GdXhyGgnMBOdhQ4Tn.r0YI4lgsh/E7B77RL774nt2fOou92Im', '$2y$10$7G/au0VzKKzHNoOYfJzJa.SnNAyM9YIhqjHMVmGbolEnB8KXaxsya', '2022-05-30', '2022-05-30'),
	(4, 'marcela', 'marcela@gmail.com', '$2y$10$kvCut5JSJg/pvsv/Z5sfkOFRVZtCN73ofuNP7CUGPsoSKSCVJN/6u', '$2y$10$xpj1LXQhY0VHQHnpcfwk2utO6uPAwjGZm6c4a29Hcslmau7PoxNbu', '2022-05-30', '2022-05-30'),
	(5, 'bond', 'bond@gmail.com', '$2y$10$wV56jtvduOId/7K0TptG1u6h71ed17mHcQQ85a/BJ2CF1babI900W', '$2y$10$I6UglTvwBni/1q4OT0mYDuqNRLubAb4VMqJuMD2k2oRpMKxNcGP1S', '2022-05-30', '2022-05-30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for view comparator.processors
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `processors`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `processors` AS SELECT cpubrand.CPUBrand, cpu.CPUModel, cpu.Speed, cpu.Score FROM cpubrand
INNER JOIN cpu ON cpubrand.idcpubrand = cpu.idCPUBrand ;

-- Dumping structure for view comparator.smartphones
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `smartphones`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `smartphones` AS SELECT model.idModel, CONCAT(modelbrand.Brand, ' ', model.Serie) AS Smartphone, model.YEAR, model.ScreenSize, model.PixelDensity, model.BatteryPower, model.RAM,
model.ResolutionX, model.ResolutionY, model.FrontMainCamera, model.BackMainCamera, model.Weight,
model.Waterproof, model.RefreshRate, CONCAT(os.OS, ' ', os.OSVersion) AS OS, cpubrand.CPUBrand, cpu.CPUModel, cpu.Score, modelmaterial.Material,
glass.Glass, model.`STATUS`, model.Available FROM model
INNER JOIN os ON model.idOS = os.idOS
INNER JOIN modelmaterial ON model.idModelMaterial = modelmaterial.idModelMaterial
INNER JOIN glass ON model.idGlass = glass.idGlass
INNER JOIN cpu ON model.idCPU = cpu.idCPU
INNER JOIN modelbrand ON model.idModelBrand = modelbrand.idModelBrand
INNER JOIN cpubrand ON cpu.idCPUBrand = cpubrand.idCPUBrand ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

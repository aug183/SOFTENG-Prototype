-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 10:29 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '$2y$10$PIy2D/wlAALzU5IyZflau..zRH2J0inbAe1d45VWJ7yZJWIGCU40.');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `Dates` date NOT NULL,
  `Reason` varchar(50) NOT NULL,
  `Working area` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `Meeting Room 1` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `Meeting Room 2` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `Open Space` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `North Wing` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `South Wing` varchar(20) NOT NULL DEFAULT 'AVAILABLE',
  `Zoom Account` varchar(20) DEFAULT 'AVAILABLE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`Dates`, `Reason`, `Working area`, `Meeting Room 1`, `Meeting Room 2`, `Open Space`, `North Wing`, `South Wing`, `Zoom Account`) VALUES
('2023-06-20', 'Holiday', 'UNAVAILABLE', 'UNAVAILABLE', 'UNAVAILABLE', 'UNAVAILABLE', 'UNAVAILABLE', 'UNAVAILABLE', 'UNAVAILABLE');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `index_offers` int(11) NOT NULL,
  `offer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`index_offers`, `offer_name`) VALUES
(1, 'Working Area'),
(2, 'Meeting Room 1'),
(3, 'Meeting Room 2'),
(4, 'Open Space Near Lavoxa'),
(5, 'North Wing'),
(6, 'South Wing'),
(7, 'Zoom Account');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `Acronym` varchar(16) NOT NULL,
  `Organization Name` varchar(88) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`Acronym`, `Organization Name`) VALUES
('DLSL ACES', 'ASSOCIATION OF COMPUTER ENGINEERING STUDENTS'),
('DLSL ACTS', 'ASSOCIATION OF COMMUNICATION STUDENTS'),
('DLSL ANIMACO', 'ANIME MANGA COLLECTIVE'),
('DLSL BIOS', 'BIOLOGY SOCIETY'),
('DLSL COMELEC', 'DLSL COMELEC'),
('DLSL CSO', 'COUNCIL OF STUDENT ORGANIZATIONS'),
('DLSL DEBSOC', 'DEBATE SOCIETY'),
('DLSL EARTH', 'DLSL EARTH'),
('DLSL EDUCCIRCLE', 'EDUCATORS\' CIRCLE'),
('DLSL FAD', 'FASHION AND ATTITUDE DIPLOMATS'),
('DLSL GCA', 'GOURMET CLUB AVENIR'),
('DLSL HONORSOC', 'DLSL HONOR SOCIETY'),
('DLSL IECEP', 'INSTITUTE OF ELECTRONICS ENGINEERS OF THE PHILIPPINES - DE LA SALLE LIPA STUDENT CHAPTER'),
('DLSL IGNIS', 'IGNIS'),
('DLSL IMEDIA', 'INTERACTIVE ARTISTS OF MULTIMEDIA DESIGN'),
('DLSL INDAK', 'INDAYOG NG DAMDAMIN AT ADHIKAIN NG MGA KABATAAN'),
('DLSL JFINEX', 'JUNIOR FINANCIAL EXECUTIVES'),
('DLSL JIIEE', 'JUNIOR INSTITUTE OF INTEGRATED ELECTRICAL ENGINEERS - DE LA SALLE LIPA CHAPTER'),
('DLSL JMA', 'JUNIOR MARKETING ASSOCIATION'),
('DLSL JPCS', 'JUNIOR PHILIPPINE COMPUTER SOCIETY'),
('DLSL JPIA', 'JUNIOR PHILIPPINE INSTITUTE OF ACCOUNTANTS'),
('DLSL JPIIE', 'JUNIOR PHILIPPINE INSTITUTE OF INDUSTRIAL ENGINEERS'),
('DLSL KENTAWRA', 'DULAANG KENTAWRA'),
('DLSL LAYA', 'LASALLIAN ALLIANCE OF YOUTH ADVOCATES FOR EQUALITY'),
('DLSL LFC', 'LASALLIAN FITNESS COMMUNITY'),
('DLSL LJ', 'LASALLIAN JURISTS'),
('DLSL LLL', 'LES LASALLIAN LUMIERES'),
('DLSL LLN', 'LASALLIAN LEAGUE OF NURSES'),
('DLSL MUSIKALISTA', 'DLSL MUSIKANG LASALISTA'),
('DLSL PFC', 'PEER FACILITATORS\' CIRCLE'),
('DLSL PREMED', 'DLSL PRE-MEDICAL SOCIETY'),
('DLSL PSYCHSOC', 'PSYCHOLOGY SOCIETY'),
('DLSL RCY', 'DE LA SALLE LIPA RED CROSS YOUTH'),
('DLSL SALINDAYAW', 'SALINDAYAW DANCE COMPANY'),
('DLSL SLR', 'SAMAHAN NG LASALYANONG RETRATISTA'),
('DLSL STALLION', 'STALLION DRIVE'),
('DLSL STS', 'STUDENTS? TOURISM SOCIETY'),
('DLSL VOICES', 'DE LA SALLE VOICES'),
('DLSL YES', 'YOUNG ENTREPRENEURS\' SOCIETY'),
('DLSL YFC', 'YOUTH FOR CHRIST');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_code` int(11) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `organization` varchar(50) NOT NULL,
  `services` varchar(50) NOT NULL,
  `date_reserved` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `purpose` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_code`, `last_name`, `first_name`, `date_created`, `email`, `contact`, `organization`, `services`, `date_reserved`, `start_time`, `end_time`, `purpose`) VALUES
(4, 'Amurao', 'Sandra Mae', '2023-05-16 22:48:40', 'sandra_mae_amurao@dlsl.edu.ph', '09000000000', 'DLSL BIOS', 'Meeting Room 1', '2023-05-17', '12:00:00', '14:00:00', 'asd'),
(7, 'Nicol', 'Vincent', '2023-05-17 10:40:51', 'vincent_nino_nicol@dlsl.edu.ph', '09000000000', 'DLSL ACES', 'Meeting Room 1', '2023-05-18', '22:40:00', '10:40:00', 'asd'),
(9, 'Amurao', 'Sandra Mae', '2023-06-20 11:31:47', 'sandra_mae_amurao@dlsl.edu.ph', '09000000000', 'DLSL DEBSOC', 'South Wing', '2023-05-17', '12:00:00', '14:00:00', 'Practice'),
(10, 'Nicol', 'Vincent', '2023-06-20 11:35:22', 'vincent_nino_nicol@dlsl.edu.ph', '09999999999', 'DLSL ANIMACO', 'Working Area', '2023-06-21', '08:00:00', '12:00:00', 'Practice');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD UNIQUE KEY `date` (`Dates`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`index_offers`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`Acronym`),
  ADD UNIQUE KEY `Acronym` (`Acronym`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_code`),
  ADD KEY `reservation_code` (`reservation_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `index_offers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

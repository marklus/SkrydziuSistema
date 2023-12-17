-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 04:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vartvald`
--

-- --------------------------------------------------------

--
-- Table structure for table `bilietai`
--

CREATE TABLE `bilietai` (
  `kaina` varchar(255) NOT NULL,
  `id_bilietas` int(11) NOT NULL,
  `skrydis_id` int(11) DEFAULT NULL,
  `vartai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilietai`
--

INSERT INTO `bilietai` (`kaina`, `id_bilietas`, `skrydis_id`, `vartai`) VALUES
('150', 1, 1, 'B'),
('150', 2, 1, 'B'),
('200', 5, 2, 'C'),
('150', 7, 1, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `darbuotojai`
--

CREATE TABLE `darbuotojai` (
  `vardas` varchar(255) NOT NULL,
  `pavarde` varchar(255) NOT NULL,
  `gimimo_data` date NOT NULL,
  `elektroninis_pastas` varchar(255) NOT NULL,
  `pareigos` varchar(255) NOT NULL,
  `id_darbuotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `darbuotojai`
--

INSERT INTO `darbuotojai` (`vardas`, `pavarde`, `gimimo_data`, `elektroninis_pastas`, `pareigos`, `id_darbuotojas`) VALUES
('Jonas', 'Jonaitis', '2023-12-01', 'zayvon.kenrick@falkcia.com', 'pilotas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lektuvai`
--

CREATE TABLE `lektuvai` (
  `registracijos_numeris` varchar(255) NOT NULL,
  `pagaminimo_data` date NOT NULL,
  `isigijimo_data` date NOT NULL,
  `wifi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




-- --------------------------------------------------------

--
-- Table structure for table `lektuvu_gamintojai`
--

CREATE TABLE `lektuvu_gamintojai` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `id_lektuvu_gamintojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lektuvu_modeliai`
--

CREATE TABLE `lektuvu_modeliai` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `id_lektuvu_modelis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `lektuvu_modeliai`
ADD COLUMN `kelias_iki_3d` VARCHAR(255) DEFAULT NULL;

-- --------------------------------------------------------

--
-- Table structure for table `miestai`
--

CREATE TABLE `miestai` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `id_miestas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oro_uostai`
--

CREATE TABLE `oro_uostai` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `iata_oro_uosto_kodas` varchar(255) DEFAULT NULL,
  `reitingas` double NOT NULL,
  `adresas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pamainos`
--

CREATE TABLE `pamainos` (
  `pradzios_laikas` date NOT NULL,
  `pabaigos_laikas` date NOT NULL,
  `darbuotojo_id` int(255) NOT NULL,
  `statusas` varchar(255) NOT NULL,
  `id_pamaina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skrydziai`
--

CREATE TABLE `skrydziai` (
  `planuojamas_isvykimo_laikas` date NOT NULL,
  `planuojamas_atvykimo_laikas` date NOT NULL,
  `skrydzio_trukme` varchar(255) NOT NULL,
  `isvykimo_vieta` varchar(255) NOT NULL,
  `atvykimo_vieta` varchar(255) NOT NULL,
  `realus_isvykimo_laikas` date NOT NULL,
  `realus_atvykimo_laikas` date NOT NULL,
  `id_skrydis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skrydziai`
--

INSERT INTO `skrydziai` (`planuojamas_isvykimo_laikas`, `planuojamas_atvykimo_laikas`, `skrydzio_trukme`, `isvykimo_vieta`, `atvykimo_vieta`, `realus_isvykimo_laikas`, `realus_atvykimo_laikas`, `id_skrydis`) VALUES
('2023-12-01', '2023-12-01', '2h', 'Vilnius', 'Kaunas', '2023-12-01', '2023-12-01', 1),
('2023-12-02', '2023-12-02', '2h', 'Šiauliai', 'Kaunas', '2023-12-02', '2023-12-02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `skrydziu_imones`
--

CREATE TABLE `skrydziu_imones` (
  `pavadinimas` varchar(255) NOT NULL,
  `id_skrydziu_imone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(100) NOT NULL,
  `userlevel` tinyint(1) UNSIGNED DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
('Administratorius', '16c354b68848cdbd8f54a226a0a55b21', 'a2fe399900de341c39c632244eaf8483', 9, 'demo@ktu.lt', '2018-02-16 16:51:21'),
('rimas', 'c2acd92812ef99acd3dcdbb746b9a434', '689e5b2971577d707becb97405ede951', 5, 'rimas@litnet.lt', '2020-05-02 16:32:38'),
('jonas', '64067822105b320085d18e386f57d89a', '9c5ddd54107734f7d18335a5245c286b', 4, 'rimas@litnet.lt', '2017-05-09 17:10:37'),
('pranas', '16c354b68848cdbd8f54a226a0a55b21', 'aa69001f0ba493bed7dddfd1cdb06591', 4, 'pranas@ltu.ee', '2018-02-16 16:03:41'),
('kazkas', '8dd1fa8efce5ce24e25de13642d50757', '82acd1bd17e35dfa775cb3de263c3322', 9, 'kazkas@gmail.com', '2023-12-17 15:49:08'),
('kazkas1', '8dd1fa8efce5ce24e25de13642d50757', '4ee066023b6404ca11e61ef55de610f2', 4, 'kazkas@gmail.com', '2023-12-16 20:29:04'),
('juozis', '8dd1fa8efce5ce24e25de13642d50757', 'a23af5e0c7330ddb77841d1c0f609cc2', 4, 'juozis@gmail.com', '2023-10-25 17:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `uzsakymai`
--

CREATE TABLE `uzsakymai` (
  `sukurimo_data` date NOT NULL,
  `busena` varchar(255) NOT NULL,
  `id_uzsakymas` int(11) NOT NULL,
  `uzsakovo_name` varchar(255) DEFAULT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `id_bilietas` int(11) DEFAULT NULL,
  `kaina` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzsakymai`
--

INSERT INTO `uzsakymai` (`sukurimo_data`, `busena`, `id_uzsakymas`, `uzsakovo_name`, `pavadinimas`, `id_bilietas`, `kaina`) VALUES
('2023-12-01', 'Apmoketas', 1, 'kazkas', 'Lenkija-Lietuva', 6, NULL),
('2023-12-02', 'Apmokėta', 2, 'kazkas1', 'Vilnius-Parzius', 1, NULL),
('2023-12-04', 'Apmokėta', 5, 'kazkas1', 'Vilnius-Kaunas', 2, NULL),
('2023-12-09', 'Apmokėta', 6, 'jonas', 'Ryga - Varšuva', 2, NULL),
('2023-12-08', 'Aktyvus', 7, 'kazkas', 'gerai', 7, NULL),
('2023-12-07', 'Apmokėta', 8, 'Jonas', 'Klaipėda - Kaunas', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `valstybes`
--

CREATE TABLE `valstybes` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `kodas` varchar(255) DEFAULT NULL,
  `id_valstybe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vietos`
--

CREATE TABLE `vietos` (
  `eile` int(11) NOT NULL,
  `keliones_patogumo_indeksas` varchar(255) NOT NULL,
  `id_vieta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vietos_lektuve`
--

CREATE TABLE `vietos_lektuve` (
  `id_vieta_lektuve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bilietai`
--
ALTER TABLE `bilietai`
  ADD PRIMARY KEY (`id_bilietas`),
  ADD KEY `fk_skrydis_id` (`skrydis_id`);

--
-- Indexes for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  ADD PRIMARY KEY (`id_darbuotojas`);

--
-- Indexes for table `lektuvu_gamintojai`
--
ALTER TABLE `lektuvu_gamintojai`
  ADD PRIMARY KEY (`id_lektuvu_gamintojas`);

--
-- Indexes for table `lektuvu_modeliai`
--
ALTER TABLE `lektuvu_modeliai`
  ADD PRIMARY KEY (`id_lektuvu_modelis`);

--
-- Indexes for table `miestai`
--
ALTER TABLE `miestai`
  ADD PRIMARY KEY (`id_miestas`);

--
-- Indexes for table `pamainos`
--
ALTER TABLE `pamainos`
  ADD PRIMARY KEY (`id_pamaina`),
  ADD KEY `darbuotojo_id` (`darbuotojo_id`);

--
-- Indexes for table `skrydziai`
--
ALTER TABLE `skrydziai`
  ADD PRIMARY KEY (`id_skrydis`);

--
-- Indexes for table `skrydziu_imones`
--
ALTER TABLE `skrydziu_imones`
  ADD PRIMARY KEY (`id_skrydziu_imone`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD PRIMARY KEY (`id_uzsakymas`),
  ADD KEY `fk_uzsakymai_bilietai` (`id_bilietas`);

--
-- Indexes for table `valstybes`
--
ALTER TABLE `valstybes`
  ADD PRIMARY KEY (`id_valstybe`);

--
-- Indexes for table `vietos`
--
ALTER TABLE `vietos`
  ADD PRIMARY KEY (`id_vieta`);

--
-- Indexes for table `vietos_lektuve`
--
ALTER TABLE `vietos_lektuve`
  ADD PRIMARY KEY (`id_vieta_lektuve`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bilietai`
--
ALTER TABLE `bilietai`
  MODIFY `id_bilietas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `darbuotojai`
--
ALTER TABLE `darbuotojai`
  MODIFY `id_darbuotojas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lektuvu_gamintojai`
--
ALTER TABLE `lektuvu_gamintojai`
  MODIFY `id_lektuvu_gamintojas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lektuvu_modeliai`
--
ALTER TABLE `lektuvu_modeliai`
  MODIFY `id_lektuvu_modelis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `miestai`
--
ALTER TABLE `miestai`
  MODIFY `id_miestas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pamainos`
--
ALTER TABLE `pamainos`
  MODIFY `id_pamaina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skrydziai`
--
ALTER TABLE `skrydziai`
  MODIFY `id_skrydis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skrydziu_imones`
--
ALTER TABLE `skrydziu_imones`
  MODIFY `id_skrydziu_imone` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  MODIFY `id_uzsakymas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `valstybes`
--
ALTER TABLE `valstybes`
  MODIFY `id_valstybe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vietos`
--
ALTER TABLE `vietos`
  MODIFY `id_vieta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vietos_lektuve`
--
ALTER TABLE `vietos_lektuve`
  MODIFY `id_vieta_lektuve` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bilietai`
--
ALTER TABLE `bilietai`
  ADD CONSTRAINT `fk_skrydis_id` FOREIGN KEY (`skrydis_id`) REFERENCES `skrydziai` (`id_skrydis`);

--
-- Constraints for table `pamainos`
--
ALTER TABLE `pamainos`
  ADD CONSTRAINT `darbuotojo_id` FOREIGN KEY (`darbuotojo_id`) REFERENCES `darbuotojai` (`id_darbuotojas`);

--
-- Constraints for table `uzsakymai`
--
ALTER TABLE `uzsakymai`
  ADD CONSTRAINT `fk_uzsakymai_bilietai` FOREIGN KEY (`id_bilietas`) REFERENCES `bilietai` (`id_bilietas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--- insert some airplane stuff :))

INSERT INTO lektuvu_gamintojai (pavadinimas, id_lektuvu_gamintojas) 
VALUES ('Boeing', 1);

INSERT INTO lektuvu_modeliai (pavadinimas, id_lektuvu_modelis, kelias_iki_3d) 
VALUES ('Model 737', 1, '3dModels/Airplane1/11803_Airplane_v1_l1.obj');

INSERT INTO lektuvai (registracijos_numeris, pagaminimo_data, isigijimo_data, wifi) 
VALUES ('ABC123', '2022-01-01', '2023-01-01', 1);

INSERT INTO vietos (eile, keliones_patogumo_indeksas, id_vieta) 
VALUES (1, 'A', 1);

INSERT INTO vietos_lektuve (id_vieta_lektuve) 
VALUES (1);

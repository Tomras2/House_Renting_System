-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2020 at 04:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nuoma`
--

-- --------------------------------------------------------

--
-- Table structure for table `administratoriai`
--

CREATE TABLE `administratoriai` (
  `tabelio_numeris` varchar(11) NOT NULL,
  `fk_asmens_kodas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `adresai`
--

CREATE TABLE `adresai` (
  `salis` varchar(100) NOT NULL,
  `miestas` varchar(100) NOT NULL,
  `rajonas` varchar(100) DEFAULT NULL,
  `gatve` varchar(100) NOT NULL,
  `namo_numeris` varchar(100) NOT NULL,
  `id_Adresas` int(11) NOT NULL,
  `fk_Naudotojasasmens_kodas` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adresai`
--

INSERT INTO `adresai` (`salis`, `miestas`, `rajonas`, `gatve`, `namo_numeris`, `id_Adresas`, `fk_Naudotojasasmens_kodas`) VALUES
('Lietuva', 'Kaunas', 'Centras', 'Kęstučio g.', '36', 28, NULL),
('Lietuva', 'Vilnius', 'Antakalnis', 'Naujakurių g.', '20', 29, NULL),
('Lietuva', 'Panevezys', 'Merkiu', 'Obuoliu', '230', 30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ataskaitos`
--

CREATE TABLE `ataskaitos` (
  `ivertinimas` float NOT NULL,
  `aprasymas` text NOT NULL,
  `sukurimo_data` datetime NOT NULL,
  `komentaras` text NOT NULL,
  `id_Ataskaita` int(11) NOT NULL,
  `fk_Patikraid_Patikra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `atsiliepimai`
--

CREATE TABLE `atsiliepimai` (
  `tekstas` text NOT NULL,
  `ivertinimu_skaicius` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `id_Atsiliepimas` int(11) NOT NULL,
  `fk_Bustasid_Bustas` int(11) NOT NULL,
  `fk_Naudotojasasmens_kodas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `atsiliepimu_skundai`
--

CREATE TABLE `atsiliepimu_skundai` (
  `data` datetime NOT NULL,
  `priezastis` varchar(100) NOT NULL,
  `aprasymas` text NOT NULL,
  `id_Atsiliepimo_skundas` int(11) NOT NULL,
  `fk_Naudotojasasmens_kodas` varchar(11) NOT NULL,
  `fk_Atsiliepimasid_Atsiliepimas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `busenos`
--

CREATE TABLE `busenos` (
  `id_Busena` int(11) NOT NULL,
  `name` char(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `busenos`
--

INSERT INTO `busenos` (`id_Busena`, `name`) VALUES
(1, 'patvirtinta'),
(2, 'laukiama patvirtinimo'),
(3, 'atsaukta');

-- --------------------------------------------------------

--
-- Table structure for table `bustai`
--

CREATE TABLE `bustai` (
  `pavadinimas` varchar(100) NOT NULL,
  `plotas` int(11) DEFAULT NULL,
  `kambariu_skaicius` int(11) NOT NULL,
  `lovu_skaicius` int(11) NOT NULL,
  `papildoma_informacija` varchar(255) DEFAULT NULL,
  `nuomavimo_patvirtinimas` tinyint(1) NOT NULL,
  `administracijos_ivertinimas` float DEFAULT NULL,
  `aukstas` int(11) DEFAULT NULL,
  `terasa` tinyint(1) NOT NULL,
  `wifi_prieiga` tinyint(1) NOT NULL,
  `vonia` tinyint(1) NOT NULL,
  `tipas` int(11) NOT NULL,
  `id_Bustas` int(11) NOT NULL,
  `fk_Adresasid_Adresas` int(11) NOT NULL,
  `fk_Naudotojasasmens_kodas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bustai`
--

INSERT INTO `bustai` (`pavadinimas`, `plotas`, `kambariu_skaicius`, `lovu_skaicius`, `papildoma_informacija`, `nuomavimo_patvirtinimas`, `administracijos_ivertinimas`, `aukstas`, `terasa`, `wifi_prieiga`, `vonia`, `tipas`, `id_Bustas`, `fk_Adresasid_Adresas`, `fk_Naudotojasasmens_kodas`) VALUES
('Kaunas1', 100, 5, 4, '...', 0, NULL, 2, 1, 1, 1, 2, 1, 28, '39999999999'),
('Vilnius1', 229, 6, 8, 'Vilniaus mieste Antakalnio mikrorajone išnuomojamas sublokuotas namas. Namas erdvus ir šviesus, jam priklauso 3 arų sklypas.\r\nNAMAS MAŽAI GYVENTAS, ŠVARUS IR TVARKINGAS!!!', 0, NULL, 3, 0, 1, 0, 1, 2, 29, '39999999999'),
('Panevezys', 100, 3, 2, '', 0, NULL, 4, 1, 1, 1, 2, 3, 30, '39999999999');

-- --------------------------------------------------------

--
-- Table structure for table `bustu_tipai`
--

CREATE TABLE `bustu_tipai` (
  `id_Busto_tipas` int(11) NOT NULL,
  `name` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bustu_tipai`
--

INSERT INTO `bustu_tipai` (`id_Busto_tipas`, `name`) VALUES
(1, 'namas'),
(2, 'butas');

-- --------------------------------------------------------

--
-- Table structure for table `naudotojai`
--

CREATE TABLE `naudotojai` (
  `asmens_kodas` varchar(11) NOT NULL,
  `vardas` varchar(100) NOT NULL,
  `pavarde` varchar(100) NOT NULL,
  `telefono_numeris` varchar(100) NOT NULL,
  `elektoninis_pastas` varchar(100) NOT NULL,
  `lytis` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `naudotojai`
--

INSERT INTO `naudotojai` (`asmens_kodas`, `vardas`, `pavarde`, `telefono_numeris`, `elektoninis_pastas`, `lytis`) VALUES
('39999999999', 'Petras', 'Petraitis', '868467465', 'pp@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patikros`
--

CREATE TABLE `patikros` (
  `data` datetime NOT NULL,
  `busena` int(11) NOT NULL,
  `id_Patikra` int(11) NOT NULL,
  `fk_Administratoriustabelio_numeris` varchar(11) NOT NULL,
  `fk_Bustasid_Bustas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rezervacijos`
--

CREATE TABLE `rezervacijos` (
  `pradzia` date NOT NULL,
  `pabaiga` date NOT NULL,
  `moketina_suma` float NOT NULL,
  `apmoketa` tinyint(1) NOT NULL,
  `busena` int(11) NOT NULL,
  `id_Rezervacija` int(11) NOT NULL,
  `fk_Skelbimasid_Skelbimas` int(11) NOT NULL,
  `fk_Naudotojasasmens_kodas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rezervacijos`
--

INSERT INTO `rezervacijos` (`pradzia`, `pabaiga`, `moketina_suma`, `apmoketa`, `busena`, `id_Rezervacija`, `fk_Skelbimasid_Skelbimas`, `fk_Naudotojasasmens_kodas`) VALUES
('2020-12-01', '2020-12-05', 120, 0, 2, 6, 2, '39999999999'),
('2020-12-20', '2020-12-22', 40, 0, 2, 7, 1, '39999999999'),
('2020-12-23', '2020-12-25', 40, 0, 2, 9, 1, '39999999999'),
('2020-12-26', '2020-12-27', 20, 0, 2, 10, 1, '39999999999');

-- --------------------------------------------------------

--
-- Table structure for table `rezervaciju_skundai`
--

CREATE TABLE `rezervaciju_skundai` (
  `data` datetime NOT NULL,
  `priezastis` varchar(100) NOT NULL,
  `aprasymas` text NOT NULL,
  `id_Rezervacijos_skundas` int(11) NOT NULL,
  `fk_Rezervacijaid_Rezervacija` int(11) NOT NULL,
  `fk_Bustasid_Bustas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `skelbimai`
--

CREATE TABLE `skelbimai` (
  `aprasymas` text NOT NULL,
  `kaina` float NOT NULL,
  `dataNuo` date NOT NULL,
  `dataIki` date NOT NULL,
  `antraste` varchar(255) NOT NULL,
  `atvykimo_laikas` time NOT NULL,
  `isvykimo_laikas` time NOT NULL,
  `matomumas` tinyint(1) NOT NULL,
  `id_Skelbimas` int(11) NOT NULL,
  `fk_Naudotojasasmens_kodas` varchar(11) NOT NULL,
  `fk_Bustasid_Bustas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skelbimai`
--

INSERT INTO `skelbimai` (`aprasymas`, `kaina`, `dataNuo`, `dataIki`, `antraste`, `atvykimo_laikas`, `isvykimo_laikas`, `matomumas`, `id_Skelbimas`, `fk_Naudotojasasmens_kodas`, `fk_Bustasid_Bustas`) VALUES
('Namas kaune', 20, '2020-12-20', '2020-12-31', 'Namas kaune', '09:00:00', '06:00:00', 1, 1, '39999999999', 1),
('labai patogu', 30, '2020-12-01', '2020-12-31', 'Geras skelbimas', '18:00:00', '12:00:00', 1, 2, '39999999999', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratoriai`
--
ALTER TABLE `administratoriai`
  ADD PRIMARY KEY (`tabelio_numeris`),
  ADD KEY `fk_asmens_kodas` (`fk_asmens_kodas`);

--
-- Indexes for table `adresai`
--
ALTER TABLE `adresai`
  ADD PRIMARY KEY (`id_Adresas`),
  ADD UNIQUE KEY `fk_Naudotojasasmens_kodas` (`fk_Naudotojasasmens_kodas`);

--
-- Indexes for table `ataskaitos`
--
ALTER TABLE `ataskaitos`
  ADD PRIMARY KEY (`id_Ataskaita`),
  ADD UNIQUE KEY `fk_Patikraid_Patikra` (`fk_Patikraid_Patikra`);

--
-- Indexes for table `atsiliepimai`
--
ALTER TABLE `atsiliepimai`
  ADD PRIMARY KEY (`id_Atsiliepimas`),
  ADD KEY `ivertina` (`fk_Bustasid_Bustas`),
  ADD KEY `palieka2` (`fk_Naudotojasasmens_kodas`);

--
-- Indexes for table `atsiliepimu_skundai`
--
ALTER TABLE `atsiliepimu_skundai`
  ADD PRIMARY KEY (`id_Atsiliepimo_skundas`),
  ADD KEY `palieka` (`fk_Naudotojasasmens_kodas`),
  ADD KEY `skundzia` (`fk_Atsiliepimasid_Atsiliepimas`);

--
-- Indexes for table `busenos`
--
ALTER TABLE `busenos`
  ADD PRIMARY KEY (`id_Busena`);

--
-- Indexes for table `bustai`
--
ALTER TABLE `bustai`
  ADD PRIMARY KEY (`id_Bustas`),
  ADD UNIQUE KEY `fk_Adresasid_Adresas` (`fk_Adresasid_Adresas`),
  ADD KEY `tipas` (`tipas`),
  ADD KEY `fk_Naudotojasasmens_kodas` (`fk_Naudotojasasmens_kodas`);

--
-- Indexes for table `bustu_tipai`
--
ALTER TABLE `bustu_tipai`
  ADD PRIMARY KEY (`id_Busto_tipas`);

--
-- Indexes for table `naudotojai`
--
ALTER TABLE `naudotojai`
  ADD PRIMARY KEY (`asmens_kodas`);

--
-- Indexes for table `patikros`
--
ALTER TABLE `patikros`
  ADD PRIMARY KEY (`id_Patikra`),
  ADD KEY `busena` (`busena`),
  ADD KEY `registruojamas` (`fk_Bustasid_Bustas`),
  ADD KEY `kuriama` (`fk_Administratoriustabelio_numeris`);

--
-- Indexes for table `rezervacijos`
--
ALTER TABLE `rezervacijos`
  ADD PRIMARY KEY (`id_Rezervacija`),
  ADD KEY `busena` (`busena`),
  ADD KEY `skirta` (`fk_Skelbimasid_Skelbimas`),
  ADD KEY `pateikia` (`fk_Naudotojasasmens_kodas`);

--
-- Indexes for table `rezervaciju_skundai`
--
ALTER TABLE `rezervaciju_skundai`
  ADD PRIMARY KEY (`id_Rezervacijos_skundas`),
  ADD KEY `skundzia2` (`fk_Rezervacijaid_Rezervacija`),
  ADD KEY `skundzia3` (`fk_Bustasid_Bustas`);

--
-- Indexes for table `skelbimai`
--
ALTER TABLE `skelbimai`
  ADD PRIMARY KEY (`id_Skelbimas`),
  ADD KEY `kuria` (`fk_Naudotojasasmens_kodas`),
  ADD KEY `itrauktas` (`fk_Bustasid_Bustas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresai`
--
ALTER TABLE `adresai`
  MODIFY `id_Adresas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ataskaitos`
--
ALTER TABLE `ataskaitos`
  MODIFY `id_Ataskaita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atsiliepimai`
--
ALTER TABLE `atsiliepimai`
  MODIFY `id_Atsiliepimas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atsiliepimu_skundai`
--
ALTER TABLE `atsiliepimu_skundai`
  MODIFY `id_Atsiliepimo_skundas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bustai`
--
ALTER TABLE `bustai`
  MODIFY `id_Bustas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patikros`
--
ALTER TABLE `patikros`
  MODIFY `id_Patikra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rezervacijos`
--
ALTER TABLE `rezervacijos`
  MODIFY `id_Rezervacija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rezervaciju_skundai`
--
ALTER TABLE `rezervaciju_skundai`
  MODIFY `id_Rezervacijos_skundas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skelbimai`
--
ALTER TABLE `skelbimai`
  MODIFY `id_Skelbimas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administratoriai`
--
ALTER TABLE `administratoriai`
  ADD CONSTRAINT `administratoriai_ibfk_1` FOREIGN KEY (`fk_asmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`);

--
-- Constraints for table `adresai`
--
ALTER TABLE `adresai`
  ADD CONSTRAINT `itrauktas2` FOREIGN KEY (`fk_Naudotojasasmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`);

--
-- Constraints for table `ataskaitos`
--
ALTER TABLE `ataskaitos`
  ADD CONSTRAINT `ivertina2` FOREIGN KEY (`fk_Patikraid_Patikra`) REFERENCES `patikros` (`id_Patikra`);

--
-- Constraints for table `atsiliepimai`
--
ALTER TABLE `atsiliepimai`
  ADD CONSTRAINT `ivertina` FOREIGN KEY (`fk_Bustasid_Bustas`) REFERENCES `bustai` (`id_Bustas`),
  ADD CONSTRAINT `palieka2` FOREIGN KEY (`fk_Naudotojasasmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`);

--
-- Constraints for table `atsiliepimu_skundai`
--
ALTER TABLE `atsiliepimu_skundai`
  ADD CONSTRAINT `palieka` FOREIGN KEY (`fk_Naudotojasasmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`),
  ADD CONSTRAINT `skundzia` FOREIGN KEY (`fk_Atsiliepimasid_Atsiliepimas`) REFERENCES `atsiliepimai` (`id_Atsiliepimas`);

--
-- Constraints for table `bustai`
--
ALTER TABLE `bustai`
  ADD CONSTRAINT `bustai_ibfk_1` FOREIGN KEY (`tipas`) REFERENCES `bustu_tipai` (`id_Busto_tipas`),
  ADD CONSTRAINT `bustai_ibfk_2` FOREIGN KEY (`fk_Naudotojasasmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`),
  ADD CONSTRAINT `itraukia` FOREIGN KEY (`fk_Adresasid_Adresas`) REFERENCES `adresai` (`id_Adresas`);

--
-- Constraints for table `patikros`
--
ALTER TABLE `patikros`
  ADD CONSTRAINT `kuriama` FOREIGN KEY (`fk_Administratoriustabelio_numeris`) REFERENCES `administratoriai` (`tabelio_numeris`),
  ADD CONSTRAINT `patikros_ibfk_1` FOREIGN KEY (`busena`) REFERENCES `busenos` (`id_Busena`),
  ADD CONSTRAINT `registruojamas` FOREIGN KEY (`fk_Bustasid_Bustas`) REFERENCES `bustai` (`id_Bustas`);

--
-- Constraints for table `rezervacijos`
--
ALTER TABLE `rezervacijos`
  ADD CONSTRAINT `pateikia` FOREIGN KEY (`fk_Naudotojasasmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`),
  ADD CONSTRAINT `rezervacijos_ibfk_1` FOREIGN KEY (`busena`) REFERENCES `busenos` (`id_Busena`),
  ADD CONSTRAINT `skirta` FOREIGN KEY (`fk_Skelbimasid_Skelbimas`) REFERENCES `skelbimai` (`id_Skelbimas`);

--
-- Constraints for table `rezervaciju_skundai`
--
ALTER TABLE `rezervaciju_skundai`
  ADD CONSTRAINT `skundzia2` FOREIGN KEY (`fk_Rezervacijaid_Rezervacija`) REFERENCES `rezervacijos` (`id_Rezervacija`),
  ADD CONSTRAINT `skundzia3` FOREIGN KEY (`fk_Bustasid_Bustas`) REFERENCES `bustai` (`id_Bustas`);

--
-- Constraints for table `skelbimai`
--
ALTER TABLE `skelbimai`
  ADD CONSTRAINT `itrauktas` FOREIGN KEY (`fk_Bustasid_Bustas`) REFERENCES `bustai` (`id_Bustas`),
  ADD CONSTRAINT `kuria` FOREIGN KEY (`fk_Naudotojasasmens_kodas`) REFERENCES `naudotojai` (`asmens_kodas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

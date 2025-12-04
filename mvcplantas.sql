-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 09:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcplantas`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuidados`
--

CREATE TABLE `cuidados` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `planta_id` int(11) DEFAULT NULL,
  `tipo_cuidado` varchar(100) NOT NULL,
  `frequencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuidados`
--

INSERT INTO `cuidados` (`id`, `usuario_id`, `planta_id`, `tipo_cuidado`, `frequencia`) VALUES
(19, 10, 12241, 'Regar', 3),
(20, 11, 12242, 'Adubar', 7),
(21, 12, 12243, 'Trocar de vaso', 30),
(22, 13, 12244, 'Limpar folhas', 5),
(23, 14, 12245, 'Pulverizar água', 2);

-- --------------------------------------------------------

--
-- Table structure for table `plantas`
--

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL,
  `nome_cientifico` varchar(150) NOT NULL,
  `nome_popular` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plantas`
--

INSERT INTO `plantas` (`id`, `nome_cientifico`, `nome_popular`) VALUES
(12241, 'Ficus lyrata', 'Figueira-lira'),
(12242, 'Epipremnum aureum', 'Jiboia'),
(12243, 'Sansevieria trifasciata', 'Espada-de-São-Jorge'),
(12244, 'Monstera deliciosa', 'Costela-de-adão'),
(12245, 'Calathea orbifolia', 'Calathea');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`) VALUES
(10, 'Ana Silva', 'ana.silva@email.com'),
(11, 'Carlos Souza', 'carlos.souza@email.com'),
(12, 'Mariana Oliveira', 'mariana.oliveira@email.com'),
(13, 'João Pereira', 'joao.pereira@email.com'),
(14, 'Larissa Mendes', 'larissa.mendes@email.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cuidados`
--
ALTER TABLE `cuidados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `planta_id` (`planta_id`);

--
-- Indexes for table `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuidados`
--
ALTER TABLE `cuidados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12251;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuidados`
--
ALTER TABLE `cuidados`
  ADD CONSTRAINT `cuidados_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `cuidados_ibfk_2` FOREIGN KEY (`planta_id`) REFERENCES `plantas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

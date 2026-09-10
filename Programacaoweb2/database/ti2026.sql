-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2026 at 02:10 PM
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
-- Database: `ti2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `alunos`
--

CREATE TABLE `alunos` (
  `cod` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `Imagem` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alunos`
--

INSERT INTO `alunos` (`cod`, `nome`, `telefone`, `cidade`, `Imagem`) VALUES
(2, 'Hugo', '234906', 'Tailândia do Para', '6a99798bce45a.jpg'),
(3, 'Gustavo Guanabara', '5489358934589', 'Rio de Janeiro - RJ', '6a9979b72bc06.jpg'),
(4, 'Saber', '2004', 'Fuyuki', '6a997a80622f3.jpg'),
(7, 'Cleiton Rasta', '4453654456745', 'Maceió', '6a997aadbc9e0.jpg'),
(8, 'Iberê tenório', '456487956456', 'São Paulo', '6a997cbc53707.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `cod` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `duracao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`cod`, `nome`, `duracao`) VALUES
(1, 'ADS', 6),
(2, 'Química', 14),
(3, 'Química', 14),
(4, 'Engenharia de Pesca', 3),
(5, 'Teologia', 8),
(6, 'Medicina', 14),
(7, 'Cu de curioso', 12),
(8, 'Física teorica', 14);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `dia`) VALUES
(1, 'Guilherme Ramos', 'guiDoGrau', 'ass', '2026-09-09'),
(2, 'Artoria', 'Saber', '$2y$10$nPpI6JnZCWaMnXhgJMg.8ORjB6rKj0FgINsZr7mXZe7Ck47hG7ume', '2026-09-10'),
(4, 'Iberê tenório', 'Manual do Mundo', '$2y$10$ADADPOZNsfexjPrGr1wZ.OllbWuiN3bt95geX.6qjsszFOu6g8TU6', '2026-09-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

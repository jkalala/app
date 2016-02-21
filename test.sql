-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21-Fev-2016 às 17:48
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `ID` int(11) NOT NULL,
  `num_carta` varchar(15) NOT NULL,
  `BI` varchar(15) NOT NULL,
  `Nome_Condutor` varchar(50) NOT NULL,
  `data_nascimento` date NOT NULL,
  `crime` varchar(50) NOT NULL,
  `pena` varchar(50) NOT NULL,
  `ufc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`ID`, `num_carta`, `BI`, `Nome_Condutor`, `data_nascimento`, `crime`, `pena`, `ufc`) VALUES
(1, '0', '000157894LN035', 'Joaquim Kalala', '2001-09-07', 'Excesso de velocidade', '1.83.03.10', '150'),
(2, 'AO17340', '000157894LN035', 'Peterson Ngoma', '2005-01-17', 'Ultrapassagem a direita', '1.83.03.14', '1350'),
(3, 'AO17341', '000157894LN036', 'Leonardo Turin', '1975-03-18', 'Embriagez', '1.83.03.14', '1983');

-- --------------------------------------------------------

--
-- Estrutura da tabela `infracoes`
--

CREATE TABLE `infracoes` (
  `codigo` varchar(50) NOT NULL,
  `descricao_infracao` varchar(100) NOT NULL,
  `coima` varchar(20) NOT NULL,
  `tipo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `infracoes`
--

INSERT INTO `infracoes` (`codigo`, `descricao_infracao`, `coima`, `tipo`) VALUES
('2.83.043.01', 'Mudança a direita sem se aproximar atencipadamente do limite direito', '60 - 300', '1'),
('2.83.043.02', 'Inversão do sentido de marcha em local de grande intensidade de transito', '120 - 600', '2'),
('2.83.046.03', 'Marcha atrás em local de grande intensidade de transito', '120 - 600 ', 'G'),
('2.83.046.04', 'Estacionamento na passagem de peões impedindo a passagem de peões ', '30 - 150 ', 'G');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro`
--

CREATE TABLE `registro` (
  `ID` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `password1` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `registro`
--

INSERT INTO `registro` (`ID`, `name`, `email`, `username`, `password`, `password1`) VALUES
(1, 'Paula Lopes', 'j.lopes@gmail.com', 'Lopes', 'lopes21', 'lopes21'),
(2, 'Kangomba', 'joaquim.kalala@gmail.com', 'kangomba21', 'kalala', 'kalala'),
(3, 'Martin Luther King Jr', 'm.luther@gmail.com', 'm.junior', '734850855e8feaa05283df720c21f154fc368237', '734850855e8feaa05283df720c21f154fc368237'),
(4, '', '', 'kalala', '2430737b3f12632d49f5f1d79b88fb27adf15214', 'da39a3ee5e6b4b0d3255bfef95601890afd80709'),
(5, 'Bentley Brown', 'brentley@gmail.com', 'b.brown', '8cb2237d0679ca88db6464eac60da96345513964', '8cb2237d0679ca88db6464eac60da96345513964'),
(6, 'Fernado Torres', 'f.torres@yahoo.fr', 'f.torres', '8cb2237d0679ca88db6464eac60da96345513964', '8cb2237d0679ca88db6464eac60da96345513964'),
(7, 'Pedro SebastiÃ£o', 'joaquim.kalala@gmail.com', 'pedro20', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(8, 'Paulo Gomez', 'gomes.paulo@gmail.com', 'g.paulo', '987e324fc327c7cc74841f88ff5a24a3233c7e41', '987e324fc327c7cc74841f88ff5a24a3233c7e41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `hashed_password` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `hashed_password`) VALUES
(1, 'kalala', '2430737b3f12632d49f5f1d79b88fb27adf15214'),
(2, 'peterson', '50f139767ff9e7a2b155604646893e93f3a92aea'),
(8, 'Jonathan', '2d070b0f8acfa49e032a30af6e58d9d7fc61067b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `infracoes`
--
ALTER TABLE `infracoes`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `registro`
--
ALTER TABLE `registro`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

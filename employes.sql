-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 25/06/2026 às 14:23
-- Versão do servidor: 8.0.30
-- Versão do PHP: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `employes`
--

CREATE TABLE `employes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `address_id` bigint UNSIGNED DEFAULT NULL,
  `address_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_complement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `employes`
--

INSERT INTO `employes` (`id`, `name`, `image`, `birth`, `cpf`, `user_id`, `address_id`, `address_number`, `address_complement`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vlaydisson Valóis de Melo', NULL, '1980-07-17', '698.970.422-53', 1, NULL, '100', 'Apto 101', NULL, NULL, NULL),
(2, 'Vladymir Gomes Valóis', NULL, '1990-08-23', '234.567.890-12', 2, NULL, '250', 'Casa', NULL, NULL, NULL),
(3, 'Fernanda Valóis de Melo', NULL, '1978-11-05', '345.678.901-23', 3, NULL, '310', 'Bloco B', NULL, NULL, NULL),
(4, 'Joana Gomes Valóis', NULL, '1995-02-17', '456.789.012-34', 4, NULL, '420', 'Apto 302', NULL, NULL, NULL),
(5, 'Eduardo Santos', NULL, '1982-06-30', '567.890.123-45', NULL, NULL, '550', 'Casa A', NULL, NULL, NULL),
(6, 'Fernanda Lima', NULL, '1988-09-14', '678.901.234-56', NULL, NULL, '612', 'Apto 12', NULL, NULL, NULL),
(7, 'Gabriel Rocha', NULL, '1993-01-22', '789.012.345-67', NULL, NULL, '750', 'Casa fundos', NULL, NULL, NULL),
(8, 'Heloísa Ferreira', NULL, '1980-05-09', '890.123.456-78', NULL, NULL, '890', 'Apto 404', NULL, NULL, NULL),
(9, 'Igor Martins', NULL, '1998-12-04', '901.234.567-89', NULL, NULL, '921', NULL, NULL, NULL, NULL),
(10, 'Juliana Alves', NULL, '1986-07-15', '012.345.678-90', NULL, NULL, '1010', 'Apto 201', NULL, NULL, NULL),
(11, 'Kleber Pereira', NULL, '1975-03-27', '111.222.333-44', NULL, NULL, '1120', 'Casa', NULL, NULL, NULL),
(12, 'Larissa Mendes', NULL, '1992-10-18', '222.333.444-55', NULL, NULL, '1230', 'Bloco C', NULL, NULL, NULL),
(13, 'Marcelo Rocha', NULL, '1983-01-05', '333.444.555-66', NULL, NULL, '1340', 'Apto 11', NULL, NULL, NULL),
(14, 'Natália Dias', NULL, '1996-06-25', '444.555.666-77', NULL, NULL, '1450', 'Casa', NULL, NULL, NULL),
(15, 'Otávio Carvalho', NULL, '1979-04-08', '555.666.777-88', NULL, NULL, '1560', 'Apto 501', NULL, NULL, NULL),
(16, 'Patrícia Correia', NULL, '1989-11-21', '666.777.888-99', NULL, NULL, '1670', 'Casa', NULL, NULL, NULL),
(17, 'Rafael Barbosa', NULL, '1994-02-14', '777.888.999-00', NULL, NULL, '1780', 'Apto 301', NULL, NULL, NULL),
(18, 'Sandra Ribeiro', NULL, '1981-08-02', '888.999.000-11', NULL, NULL, '1890', 'Bloco D', NULL, NULL, NULL),
(19, 'Thiago Gonçalves', NULL, '1991-09-29', '999.000.111-22', NULL, NULL, '2000', 'Apto 22', NULL, NULL, NULL),
(20, 'Vanessa Castro', NULL, '1987-03-11', '000.111.222-33', NULL, NULL, '2110', 'Casa', NULL, NULL, NULL),
(21, 'Wagner Azevedo', NULL, '1977-07-07', '111.222.333-55', NULL, NULL, '2220', 'Apto 601', NULL, NULL, NULL),
(22, 'Xênia Duarte', NULL, '1997-05-16', '222.333.444-66', NULL, NULL, '2330', 'Casa', NULL, NULL, NULL),
(23, 'Yuri Nogueira', NULL, '1984-12-12', '333.444.555-77', NULL, NULL, '2440', 'Apto 702', NULL, NULL, NULL),
(24, 'Amanda Farias', NULL, '1999-10-31', '444.555.666-88', NULL, NULL, '2550', 'Casa fundos', NULL, NULL, NULL),
(25, 'Breno Teixeira', NULL, '1982-01-28', '555.666.777-99', NULL, NULL, '2660', 'Apto 103', NULL, NULL, NULL),
(26, 'Camila Moura', NULL, '1995-07-19', '666.777.888-00', NULL, NULL, '2770', 'Casa', NULL, NULL, NULL),
(27, 'Diego Melo', NULL, '1989-04-04', '777.888.999-11', NULL, NULL, '2880', 'Apto 402', NULL, NULL, NULL),
(28, 'Eliane Ramos', NULL, '1976-09-06', '888.999.000-22', NULL, NULL, '2990', 'Bloco E', NULL, NULL, NULL),
(29, 'Felipe Viana', NULL, '1992-02-22', '999.000.111-33', NULL, NULL, '3005', 'Casa', NULL, NULL, NULL),
(30, 'Gisele Macedo', NULL, '1985-11-13', '000.111.222-44', NULL, NULL, '3110', 'Apto 801', NULL, NULL, NULL),
(31, 'Hugo Leonardo', NULL, '1990-06-08', '111.222.333-66', NULL, NULL, '3220', 'Casa', NULL, NULL, NULL),
(32, 'Isabela Nunes', NULL, '1996-01-02', '222.333.444-77', NULL, NULL, '3330', 'Apto 502', NULL, NULL, NULL),
(33, 'Jonas Almeida', NULL, '1983-10-25', '333.444.555-88', NULL, NULL, '3440', 'Casa', NULL, NULL, NULL),
(34, 'Karina Lima', NULL, '1994-08-17', '444.555.666-99', NULL, NULL, '3550', 'Apto 303', NULL, NULL, NULL),
(35, 'Lucas Eduardo', NULL, '1988-04-30', '555.666.777-00', NULL, NULL, '3660', 'Casa', NULL, NULL, NULL),
(36, 'Mariana Freitas', NULL, '1974-12-05', '666.777.888-11', NULL, NULL, '3770', 'Apto 203', NULL, NULL, NULL),
(37, 'Nelson Albuquerque', NULL, '1993-03-21', '777.888.999-22', NULL, NULL, '3880', 'Casa', NULL, NULL, NULL),
(38, 'Olga Beatriz', NULL, '1980-07-10', '888.999.000-33', NULL, NULL, '3990', 'Apto 602', NULL, NULL, NULL),
(39, 'Paulo Roberto', NULL, '1986-09-15', '999.000.111-44', NULL, NULL, '4100', 'Casa', NULL, NULL, NULL),
(40, 'Queila Soares', NULL, '1995-05-24', '000.111.222-55', NULL, NULL, '4210', 'Apto 901', NULL, NULL, NULL),
(41, 'Roberto Magalhães', NULL, '1978-01-14', '111.222.333-77', NULL, NULL, '4320', 'Casa', NULL, NULL, NULL),
(42, 'Simone Vasconcelos', NULL, '1991-10-09', '222.333.444-88', NULL, NULL, '4430', 'Apto 14', NULL, NULL, NULL),
(43, 'Tales Henrique', NULL, '1997-06-18', '333.444.555-99', NULL, NULL, '4540', 'Casa', NULL, NULL, NULL),
(44, 'Úrsula Karine', NULL, '1984-03-03', '444.555.666-00', NULL, NULL, '4650', 'Apto 204', NULL, NULL, NULL),
(45, 'Vinícius Matos', NULL, '1999-12-28', '555.666.777-11', NULL, NULL, '4760', 'Casa', NULL, NULL, NULL),
(46, 'Yasmin Botelho', NULL, '1981-08-19', '666.777.888-22', NULL, NULL, '4870', 'Apto 701', NULL, NULL, NULL),
(47, 'Zildo Oliveira', NULL, '1973-04-22', '777.888.999-33', NULL, NULL, '4980', 'Casa', NULL, NULL, NULL),
(48, 'Adriana Galvão', NULL, '1992-01-11', '888.999.000-44', NULL, NULL, '5090', 'Apto 102', NULL, NULL, NULL),
(49, 'Bruno Espindola', NULL, '1987-05-05', '999.000.111-55', NULL, NULL, '5100', 'Casa', NULL, NULL, NULL),
(50, 'Carla Moraes', NULL, '1996-09-09', '000.111.222-66', NULL, NULL, '5210', 'Apto 802', NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_cpf_unique` (`cpf`),
  ADD KEY `employees_user_id_foreign` (`user_id`),
  ADD KEY `employees_address_id_foreign` (`address_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `employes`
--
ALTER TABLE `employes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employees_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`),
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

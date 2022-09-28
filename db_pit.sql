-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Set-2022 às 15:18
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_pit`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `peso` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `descricao`, `icon`, `peso`) VALUES
(1, 'Grande', 'https://w7.pngwing.com/pngs/774/935/png-transparent-weight-computer-icons-kilogram-symbol-mass-symbol-miscellaneous-game-logo.png', 300),
(2, 'Tradicional', 'https://w7.pngwing.com/pngs/774/935/png-transparent-weight-computer-icons-kilogram-symbol-mass-symbol-miscellaneous-game-logo.png', 200),
(3, 'Pequeno', 'https://w7.pngwing.com/pngs/774/935/png-transparent-weight-computer-icons-kilogram-symbol-mass-symbol-miscellaneous-game-logo.png', 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id`, `path`, `item_id`) VALUES
(1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJ9zGdQFJu-e2IYC07VS6Oj6CTvMycmFTZ-yN7RbcRKhN0e0xhL3mc4RLF8-aaSszUzW0&usqp=CAU', 1),
(2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyYyWSCRcJjKFer1un67acnbXpHIiYOzSbygDQYsGWGLuht6FG6_8kqYXRl4f0TAbWozk&usqp=CAU', 1),
(3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxexFWZ0i7KYOa07hqnRc1VYASiyKwy5WKqw&usqp=CAU', 2),
(4, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLaZ3crGHTirewWyxG6JnZVRRMfq7YO87tD_TlcT-eeXngshgWbcAHydWuIPKbI2WENM8&usqp=CAU', 2),
(5, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWvomjYnI_IMIja8KpTP2rt9I7-ND-BK5IMnQoyJ57EOWdG5XunVaDmtPNYdBFU0LkN4Y&usqp=CAU', 3),
(6, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIpz18uuqftQHSiLH6l0mb1OdZ016bckdOGJgYV3aWXTXZxNJMP9v0JMoiiqc8mcHMpXM&usqp=CAU', 3),
(7, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9alAfYhmHDxN78cbhcjGeqFcGpst2kYKlLwgSWSIvd-a65Ql29rChvo4lDc6Mlz8pDvI&usqp=CAU', 4),
(8, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQJ9zGdQFJu-e2IYC07VS6Oj6CTvMycmFTZ-yN7RbcRKhN0e0xhL3mc4RLF8-aaSszUzW0&usqp=CAU', 4),
(9, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyynFtJx0YVQ8ruvk7QwjmkTv-kk0W4M5se_LivVFPqQNdZEejAMb9PFD1Yy3dkFM7CSk&usqp=CAU', 5),
(10, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsb_Gv_lAKVvlCKzElE4_xBh0iiqoJjJGNoAdfj9Le2h2uGD93vXiCZn9Nl5a-9ThnMJc&usqp=CAU', 5),
(11, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAT8TCI6lfiBoOOiwC9La3Kl3rXtg7eLmpUGHkgSp7e_sVBZW2HVlzC_eWqnGgFvY4wgg&usqp=CAU', 6),
(12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeFoYkcESJMTWyB566BnwaMeUwfsx8G2OduO-BdMSYOd_9yjQtMbyScvMIqUR9dRoFzHI&usqp=CAU', 6),
(13, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTCs6XTRRCqN0FNmMmkV6eG_TJU_ifSxLbMModUJbZnO1rfXumZ364zNJ2NwEaQWirajA&usqp=CAU', 7),
(14, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQrkedUNmh539cAauGmtNRk6TEkHpeTcRenRYAq2i5kQiDOCYmyssX_sP75L1zn3VihUfs&usqp=CAU', 7),
(15, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQr-bmMR_HsALY62giB--gnM0VNr2eeGw9rXw&usqp=CAU', 8),
(16, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTviF2ebZlYGyNgK3bBwOBna_ck4hSo419FSZ8t1brjfn0ABnth0egetEJIW7FJ_-pxKDM&usqp=CAU', 8),
(17, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7sV_EL-AEK6PPi7hmVgOCCoJx7NlzE7JDCg&usqp=CAU', 9),
(18, 'https://flocosdemeldecor.com.br/7502-home_default/cofre-cupcake-grande.jpg', 9),
(19, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShratgHIG73s3TKJhQ_Xm4aFD5XV2XMpflXczsifxahZOZIcoyhON4GfvYrMj2VT5cr0Q&usqp=CAU', 10),
(20, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSpd_TEfanbtXFKIHyHHCIOxvs5Gp6MyrkCQ1lRaSdKMEJK51Ww2qDMfZUD7fuOOizmQ4Y&usqp=CAU', 10),
(21, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR5wR8KL7Pt9WFfhcjvVIL-dNFlC4-z2_9rJg&usqp=CAU', 11),
(22, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEibkXhRs7O2FkAkjLOtEc_yBVZqBKQ1akAw&usqp=CAU', 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens_home`
--

CREATE TABLE `imagens_home` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `ordenacao` int(11) NOT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `imagens_home`
--

INSERT INTO `imagens_home` (`id`, `url`, `ordenacao`, `pos_x`, `pos_y`) VALUES
(1, 'https://images.pexels.com/photos/853006/pexels-photo-853006.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 0, 1, 1),
(2, 'https://images.pexels.com/photos/1120464/pexels-photo-1120464.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 2, 2, 1),
(3, 'https://images.pexels.com/photos/4109784/pexels-photo-4109784.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 6, 1, 2),
(4, 'https://images.pexels.com/photos/1055272/pexels-photo-1055272.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 4, 1, 1),
(5, 'https://images.pexels.com/photos/1179002/pexels-photo-1179002.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 3, 2, 2),
(6, 'https://images.pexels.com/photos/4109793/pexels-photo-4109793.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 7, 1, 2),
(7, 'https://images.pexels.com/photos/913136/pexels-photo-913136.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 1, 1, 1),
(8, 'https://images.pexels.com/photos/1055270/pexels-photo-1055270.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `perco` double NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id`, `descricao`, `perco`, `tipo`, `categoria_id`) VALUES
(1, 'Ideal para todas as ocasiões', 6, 'Temas', 3),
(2, 'Ideal para todas as ocasiões', 5, 'Decorativo', 3),
(3, 'Ideal para todas as ocasiões', 6.5, 'Personalizado', 3),
(4, 'Ideal para todas as ocasiões', 5, 'Padrão', 3),
(5, 'Ideal para todas as ocasiões', 10, 'Padrão', 2),
(6, 'Ideal para todas as ocasiões', 12, 'Personalizado', 2),
(7, 'Ideal para todas as ocasiões', 12.5, 'Temas', 2),
(8, 'Ideal para todas as ocasiões', 15.5, 'Temas', 1),
(9, 'Ideal para todas as ocasiões', 15, 'Cofre de CupCake', 1),
(10, 'Ideal para todas as ocasiões', 15, 'Frutas', 1),
(11, 'Ideal para todas as ocasiões', 15, 'Festas', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_carinho`
--

CREATE TABLE `itens_carinho` (
  `item_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `dt_alteracao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `itens_carinho`
--

INSERT INTO `itens_carinho` (`item_id`, `usuario_id`, `qtde`, `dt_alteracao`, `id`) VALUES
(1, 17, 5, '2022-09-06 19:29:04', 1),
(5, 17, 5, '2022-09-06 19:29:04', 2),
(8, 17, 5, '2022-09-06 19:29:04', 3),
(9, 17, 5, '2022-09-06 19:29:04', 4),
(3, 17, 5, '2022-09-06 19:29:04', 5),
(2, 17, 5, '2022-09-06 19:29:04', 6),
(6, 17, 5, '2022-09-06 19:29:04', 7),
(11, 17, 5, '2022-09-06 19:29:04', 8),
(10, 17, 5, '2022-09-06 19:29:04', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `token` varchar(150) NOT NULL,
  `ativo` int(11) NOT NULL DEFAULT 0,
  `dt_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `dt_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `codigo_valid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `token`, `ativo`, `dt_criacao`, `dt_alteracao`, `codigo_valid`) VALUES
(17, 'Bruno Capelario Santos', 'brunocapelario@gmail.com', '$2y$10$d1zpza9H/DUnPzpBQmc8C.b30URy04k9A8LhrGASlxvcfGGk9UxiO', 'A92LFK1crBY3w8SGu9Siwty0wiAqm24KEHvzlyb2b6BcQNEq6n3XB13NvrdpYljqeJ5jStUI6AnoAYaAfAGxlNZz8yimxtSTrDTqYncvCpUS0XuFbQibBXZp4jWyuiVMILQ350Ebvjm02JMgUUifZY', 1, '2022-08-31 19:48:06', '2022-09-09 16:53:37', 165733);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagem_item` (`item_id`);

--
-- Índices para tabela `imagens_home`
--
ALTER TABLE `imagens_home`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_cat` (`categoria_id`);

--
-- Índices para tabela `itens_carinho`
--
ALTER TABLE `itens_carinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`usuario_id`),
  ADD KEY `fk_item_id` (`item_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `imagens_home`
--
ALTER TABLE `imagens_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `itens_carinho`
--
ALTER TABLE `itens_carinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `imagens`
--
ALTER TABLE `imagens`
  ADD CONSTRAINT `fk_imagem_item` FOREIGN KEY (`item_id`) REFERENCES `itens` (`id`);

--
-- Limitadores para a tabela `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `fk_item_cat` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `itens_carinho`
--
ALTER TABLE `itens_carinho`
  ADD CONSTRAINT `fk_item_id` FOREIGN KEY (`item_id`) REFERENCES `itens` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

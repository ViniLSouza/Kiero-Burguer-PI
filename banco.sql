-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/12/2023 às 07:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `consumiveis`
--

CREATE TABLE `consumiveis` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `consumiveis`
--

INSERT INTO `consumiveis` (`id`, `foto`, `nome`, `descricao`, `preco`, `tipo`) VALUES
(22, '1701630670_656cd2ced1947_burger_4_resized.png', 'Supreme Blend', 'Um hambúrguer irresistível feito com um blend especial de carne bovina Angus, bacon crocante, queijo gouda derretido, cebola roxa, alface e uma deliciosa maionese de ervas, tudo servido em um pão de brioche artesanal.', 27.00, 'hamburguer'),
(23, '1701630734_656cd30e98896_burger_5_resized.png', 'Firecracker Fusion', 'Para quem adora um toque picante! Este hambúrguer é preparado com o exclusivo blend de carne bovina Angus, queijo pepper jack derretido, jalapeños picados, alface, tomate e um saboroso molho chipotle, servido em um pão de hambúrguer com gergelim.', 25.00, 'hamburguer'),
(24, '1701630795_656cd34b4b2e6_burger_6_resized.png', 'Mediterranean Delight', 'Uma harmonia de sabores! Nosso hambúrguer é feito com um blend de carne bovina Angus, queijo feta, azeitonas pretas, rúcula fresca, tomate seco e um delicioso molho pesto, tudo isso no pão ciabatta tostado.', 28.00, 'hamburguer'),
(29, '1701728736_656e51e06bcf9_burger_3_resized.png', 'Classic Beef Fusion', 'Um hambúrguer clássico com um toque especial! Preparado com o nosso exclusivo blend de carne bovina Angus, queijo cheddar derretido, cebola caramelizada, alface e tomate frescos, servido em um pão de hambúrguer artesanal.', 23.90, 'hamburguer'),
(31, '1701730970_656e5a9a11f90_NicePng_batata-frita-png_3156461.png', 'Batata Mexida', 'Aproveite o prazer inigualável da nossa porção de batata frita com cheddar e bacon, uma explosão de sabores que vai conquistar até os paladares mais exigentes!', 29.90, 'porcao'),
(32, '1701731043_656e5ae30da95_02.png', 'Coca cola', 'Refresque-se com a Inigualável Coca-Cola.', 5.00, 'bebida'),
(33, '1701749206_656ea1d692faf_burger_2_resized.png', 'Smoky Angus Stack', 'Uma explosão de sabor defumado! Nosso hambúrguer é feito com blend de carne bovina Angus, bacon defumado, queijo suíço derretido, cebola crispy, alface, tomate e um toque especial de molho barbecue, tudo no pão de brioche.', 27.00, 'hamburguer'),
(34, '1701749668_656ea3a484b21_kisspng-karaage-fried-chicken-pakora-french-fries-batata-frita-5b29ef4d62c8b8.2050129215294748934046.png', 'Frango Crocante Especial', 'Delicie-se com nosso frango frito crocante, uma combinação perfeita de temperos secretos e uma crosta dourada e crocante que envolve pedaços suculentos de frango. Servido com batatas fritas caseiras e molho barbecue artesanal.', 30.90, 'porcao'),
(35, '1701749783_656ea4170fbfa_tilapia.png', 'Tilápia frita', 'Desfrute de um prato de tilápia fresca e crocante, delicadamente temperada e empanada, ressaltando o sabor natural do peixe. Acompanhada de uma suculenta salada de folhas verdes frescas e rodelas de limão para um toque cítrico refrescante.', 39.90, 'porcao'),
(36, '1701749850_656ea45ae3e09_04.png', 'Fanta uva', 'Deixe-se levar pela intensidade irresistível da Fanta Uva', 5.00, 'bebida'),
(37, '1701749924_656ea4a4d4c14_Latinha_de_Energetico_Monster_Energy_PNG_Transparente_Sem_Fundo.png', 'Monster', 'Desperte Seus Sentidos com Monster: Energia Pura em Cada Gole', 12.00, 'bebida'),
(38, '1701750046_656ea51e0efa1_Latinha_de_Refrigerante_Coca_Cola_Sem_Acucar_PNG_Transparente_Sem_Fundo.png', 'Coca cola Zero', 'Coca-Cola Zero: O Sabor Sem Culpa.', 5.00, 'bebida');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `FKcliente` int(6) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `FKcliente`, `items`, `data_hora`) VALUES
(34, 13, '[22,23,23,32,34,36,37]', '2023-12-05 05:19:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_consumiveis`
--

CREATE TABLE `pedidos_consumiveis` (
  `FK_pedido` int(11) NOT NULL,
  `FK_consumivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos_consumiveis`
--

INSERT INTO `pedidos_consumiveis` (`FK_pedido`, `FK_consumivel`) VALUES
(34, 22),
(34, 23),
(34, 23),
(34, 32),
(34, 34),
(34, 36),
(34, 37);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_login`
--

CREATE TABLE `tbl_login` (
  `ID_Login` int(6) NOT NULL,
  `User_Login` varchar(50) NOT NULL,
  `Nome_Login` varchar(50) NOT NULL,
  `Email_Login` varchar(100) NOT NULL,
  `Senha_Login` varchar(50) NOT NULL,
  `CPF_Login` varchar(12) NOT NULL,
  `CEP_Login` varchar(10) NOT NULL,
  `Logradouro_Login` varchar(50) NOT NULL,
  `Numero_Login` varchar(10) NOT NULL,
  `Complemento_Login` varchar(10) NOT NULL,
  `Bairro_Login` varchar(50) NOT NULL,
  `Cidade_Login` varchar(50) NOT NULL,
  `Estado_Login` varchar(20) NOT NULL,
  `Tipo_Usuario` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbl_login`
--

INSERT INTO `tbl_login` (`ID_Login`, `User_Login`, `Nome_Login`, `Email_Login`, `Senha_Login`, `CPF_Login`, `CEP_Login`, `Logradouro_Login`, `Numero_Login`, `Complemento_Login`, `Bairro_Login`, `Cidade_Login`, `Estado_Login`, `Tipo_Usuario`) VALUES
(11, 'Puff', 'Vinicius Luciano de Souza', 'viniciuslu1@hotmail.com', '12345', '10240164989', '80230080', 'Rua Vinte e Quatro de Maio', '420', 'Apto 101', 'Centro', 'Curitiba', 'PR', 1),
(13, 'Puff0', 'Vinicius Luciano de Souza', 'viniciuslu1@hotmail.com', '12345', '10240164989', '80230080', 'Rua Vinte e Quatro de Maio', '420', 'Apto 101', 'Centro', 'Curitiba', 'PR', 0),
(16, 'Gabriel', 'Gabriel Geve', 'viniciuslu2002@hotmail.com', '12345', '10240164989', '80230080', 'Rua Vinte e Quatro de Maio', '420', 'Apto 101', 'Centro', 'Curitiba', 'PR', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `consumiveis`
--
ALTER TABLE `consumiveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `FKcliente` (`FKcliente`);

--
-- Índices de tabela `pedidos_consumiveis`
--
ALTER TABLE `pedidos_consumiveis`
  ADD KEY `FK_pedido` (`FK_pedido`),
  ADD KEY `FK_consumivel` (`FK_consumivel`);

--
-- Índices de tabela `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`ID_Login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consumiveis`
--
ALTER TABLE `consumiveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `ID_Login` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FKcliente` FOREIGN KEY (`FKcliente`) REFERENCES `tbl_login` (`ID_Login`);

--
-- Restrições para tabelas `pedidos_consumiveis`
--
ALTER TABLE `pedidos_consumiveis`
  ADD CONSTRAINT `FK_consumivel` FOREIGN KEY (`FK_consumivel`) REFERENCES `consumiveis` (`id`),
  ADD CONSTRAINT `FK_pedido` FOREIGN KEY (`FK_pedido`) REFERENCES `pedidos` (`id_pedido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

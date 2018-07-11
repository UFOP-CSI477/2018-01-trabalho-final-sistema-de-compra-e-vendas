-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2018 at 02:58 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.7

CREATE SCHEMA IF NOT EXISTS tpfinal;
USE tpfinal;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `sigla` varchar(2) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id`, `sigla`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'AC', 'Acre', '2018-07-02', NULL),
(2, 'AL', 'Alagoas', '2018-07-02', NULL),
(3, 'AP', 'Amapá', '2018-07-02', NULL),
(4, 'AM', 'Amazonas', '2018-07-02', NULL),
(5, 'BA', 'Bahia', '2018-07-02', NULL),
(6, 'CE', 'Ceará', '2018-07-02', NULL),
(7, 'DF', 'Distrito Federal', '2018-07-02', NULL),
(8, 'ES', 'Espírito Santo', '2018-07-02', NULL),
(9, 'GO', 'Goiás', '2018-07-02', NULL),
(10, 'MA', 'Maranhão', '2018-07-02', NULL),
(11, 'MT', 'Mato Grosso', '2018-07-02', NULL),
(12, 'MS', 'Mato Grosso do Sul', '2018-07-02', NULL),
(13, 'MG', 'Minas Gerais', '2018-07-02', NULL),
(14, 'PA', 'Pará', '2018-07-02', NULL),
(15, 'PB', 'Paraíba', '2018-07-02', NULL),
(16, 'PR', 'Paraná', '2018-07-02', NULL),
(17, 'PE', 'Pernambuco', '2018-07-02', NULL),
(18, 'PI', 'Piauí', '2018-07-02', NULL),
(19, 'RJ', 'Rio de Janeiro', '2018-07-02', NULL),
(20, 'RN', 'Rio Grande do Norte', '2018-07-02', NULL),
(21, 'RS', 'Rio Grande do Sul', '2018-07-02', NULL),
(22, 'RO', 'Rondônia', '2018-07-02', NULL),
(23, 'RR', 'Roraima', '2018-07-02', NULL),
(24, 'SC', 'Santa Catarina', '2018-07-02', NULL),
(25, 'SP', 'São Paulo', '2018-07-02', NULL),
(26, 'SE', 'Sergipe', '2018-07-02', NULL),
(27, 'TO', 'Tocantins', '2018-07-02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `opinioes`
--

CREATE TABLE `opinioes` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `titulo` varchar(64) NOT NULL,
  `texto` text NOT NULL,
  `nota` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `pergunta` text NOT NULL,
  `resposta` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_tipo_produto` int(11) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(11,2) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT '1',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `desconto` int(11) DEFAULT '0',
  `parcelas` int(11) DEFAULT '0',
  `vendidos` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_endereco`
--

CREATE TABLE `tipos_endereco` (
  `id` int(11) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_endereco`
--

INSERT INTO `tipos_endereco` (`id`, `tipo`, `created_at`, `updated_at`) VALUES
(1, 'Avenida', '2018-07-02', NULL),
(2, 'Rua', '2018-07-02', NULL),
(3, 'Praça', '2018-07-02', NULL),
(4, 'Quadra', '2018-07-02', NULL),
(5, 'Estrada', '2018-07-02', NULL),
(6, 'Alameda', '2018-07-02', NULL),
(7, 'Ladeira', '2018-07-02', NULL),
(8, 'Travessa', '2018-07-02', NULL),
(9, 'Rodovia', '2018-07-02', NULL),
(10, 'Outros', '2018-07-02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_produto`
--

CREATE TABLE `tipos_produto` (
  `id` int(11) NOT NULL,
  `tipo` varchar(64) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `categoria` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipos_produto`
--

INSERT INTO `tipos_produto` (`id`, `tipo`, `created_at`, `updated_at`, `categoria`) VALUES
(1, 'Caminhões', '2018-07-05', NULL, '1'),
(2, 'Carros Antigos', '2018-07-05', NULL, '1'),
(3, 'Carros e Caminhonetes', '2018-07-05', NULL, '1'),
(4, 'Consórcios', '2018-07-05', NULL, '1'),
(5, 'Motorhomes', '2018-07-05', NULL, '1'),
(6, 'Motos', '2018-07-05', NULL, '1'),
(7, 'Náutica', '2018-07-05', NULL, '1'),
(8, 'Veículos Pesados', '2018-07-05', NULL, '1'),
(9, 'Ônibus', '2018-07-05', NULL, '1'),
(10, 'Outros Veículos', '2018-07-05', NULL, '1'),
(11, 'Apartamentos', '2018-07-05', NULL, '2'),
(12, 'Casas', '2018-07-05', NULL, '2'),
(13, 'Chácaras', '2018-07-05', NULL, '2'),
(14, 'Fazendas', '2018-07-05', NULL, '2'),
(15, 'Flat - Apart Hotel', '2018-07-05', NULL, '2'),
(16, 'Galpões', '2018-07-05', NULL, '2'),
(17, 'Lojas Comerciais', '2018-07-05', NULL, '2'),
(18, 'Salas Comerciais', '2018-07-05', NULL, '2'),
(19, 'Sítios', '2018-07-05', NULL, '2'),
(20, 'Terrenos', '2018-07-05', NULL, '2'),
(21, 'Outros Imóveis', '2018-07-05', NULL, '2'),
(22, 'Academia e Esportes', '2018-07-05', NULL, '3'),
(23, 'Animais', '2018-07-05', NULL, '3'),
(24, 'Beleza, Estética e Bem Estar', '2018-07-05', NULL, '3'),
(25, 'Educação', '2018-07-05', NULL, '3'),
(26, 'Festas e Eventos', '2018-07-05', NULL, '3'),
(27, 'Gastronomia', '2018-07-05', NULL, '3'),
(28, 'Gráficas e Impressão', '2018-07-05', NULL, '3'),
(29, 'Lar', '2018-07-05', NULL, '3'),
(30, 'Marketing e Internet', '2018-07-05', NULL, '3'),
(31, 'Saúde', '2018-07-05', NULL, '3'),
(32, 'Suporte Técnico', '2018-07-05', NULL, '3'),
(33, 'Vestuário', '2018-07-05', NULL, '3'),
(34, 'Veículos e Transportes', '2018-07-05', NULL, '3'),
(35, 'Viagens e Turismo', '2018-07-05', NULL, '3'),
(36, 'Outros Profissionais', '2018-07-05', NULL, '3'),
(37, 'Outros Serviços', '2018-07-05', NULL, '3'),
(38, 'Ar e Ventilação', '2018-07-05', NULL, '4'),
(39, 'Automotivo', '2018-07-05', NULL, '4'),
(40, 'Bebê', '2018-07-05', NULL, '4'),
(41, 'Brinquedos', '2018-07-05', NULL, '4'),
(42, 'Câmeras e Filmadoras', '2018-07-05', NULL, '4'),
(43, 'Casa e Jardim', '2018-07-05', NULL, '4'),
(44, 'Celulares e Telefones', '2018-07-05', NULL, '4'),
(45, 'Telefonia Fixa', '2018-07-05', NULL, '4'),
(46, 'Utilidades Domésticas', '2018-07-05', NULL, '4'),
(47, 'Garantia', '2018-07-05', NULL, '4'),
(48, 'Linha Industrial', '2018-07-05', NULL, '4'),
(49, 'Pet Shop', '2018-07-05', NULL, '4'),
(50, 'Cama, Mesa e Banho', '2018-07-05', NULL, '4'),
(51, 'Beleza e Saúde', '2018-07-05', NULL, '4'),
(52, 'Áudio', '2018-07-05', NULL, '4'),
(53, 'Eletrodomésticos', '2018-07-05', NULL, '4'),
(54, 'Eletroportáteis', '2018-07-05', NULL, '4'),
(55, 'Esporte e Lazer', '2018-07-05', NULL, '4'),
(56, 'Mercado', '2018-07-05', NULL, '4'),
(57, 'Bebidas e Alimentos', '2018-07-05', NULL, '4'),
(58, 'Papelaria', '2018-07-05', NULL, '4'),
(59, 'Armarinhos', '2018-07-05', NULL, '4'),
(60, 'Natal', '2018-07-05', NULL, '4'),
(61, 'Serviços', '2018-07-05', NULL, '4'),
(62, 'TV e Vídeo', '2018-07-05', NULL, '4'),
(63, 'Ferramentas e Segurança', '2018-07-05', NULL, '4'),
(64, 'Games', '2018-07-05', NULL, '4'),
(65, 'Informática e Acessórios', '2018-07-05', NULL, '4'),
(66, 'Instrumentos Musicais', '2018-07-05', NULL, '4'),
(67, 'Informática', '2018-07-05', NULL, '4'),
(68, 'Livros', '2018-07-05', NULL, '4'),
(69, 'Móveis e Decoração', '2018-07-05', NULL, '4'),
(70, 'Perfumaria', '2018-07-05', NULL, '4'),
(71, 'Relógios', '2018-07-05', NULL, '4'),
(72, 'Suplementos Alimentares', '2018-07-05', NULL, '4'),
(73, 'Tablets', '2018-07-05', NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_tipo_endereco` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `sobrenome` varchar(64) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `nascimento` date NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `nome_rua` varchar(64) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(64) NOT NULL,
  `bairro` varchar(64) NOT NULL,
  `cidade` varchar(64) NOT NULL,
  `ponto_referencia` varchar(64) DEFAULT NULL,
  `telefone1` varchar(64) NOT NULL,
  `telefone2` varchar(64) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `avaliacaoPositiva` int(11) DEFAULT '0',
  `avaliacaoNegativa` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `opinioes`
--
ALTER TABLE `opinioes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_tipo_produto` (`id_tipo_produto`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- Indexes for table `tipos_endereco`
--
ALTER TABLE `tipos_endereco`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tipos_produto`
--
ALTER TABLE `tipos_produto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id_tipo_endereco` (`id_tipo_endereco`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `opinioes`
--
ALTER TABLE `opinioes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tipos_endereco`
--
ALTER TABLE `tipos_endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tipos_produto`
--
ALTER TABLE `tipos_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `opinioes`
--
ALTER TABLE `opinioes`
  ADD CONSTRAINT `opinioes_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `opinioes_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `perguntas`
--
ALTER TABLE `perguntas`
  ADD CONSTRAINT `perguntas_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `perguntas_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_tipo_produto`) REFERENCES `tipos_produto` (`id`),
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_endereco`) REFERENCES `tipos_endereco` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`);

--
-- Constraints for table `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `vendas_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

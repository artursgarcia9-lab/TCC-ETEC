-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/05/2026 às 18:02
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
-- Banco de dados: `bd_tcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `fk_Usuario_id_usuario` int(11) NOT NULL,
  `nivel_acesso` int(11) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `data_evento` date DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `fk_Usuario_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `data_evento`, `descricao`, `fk_Usuario_id_usuario`) VALUES
(1, '2026-05-07', 'Renovar RNM', NULL),
(2, '2026-05-13', 'Renovar RNM', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `dica`
--

CREATE TABLE `dica` (
  `id_dica` int(11) NOT NULL,
  `texto` varchar(250) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `fk_Usuario_id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dica`
--

INSERT INTO `dica` (`id_dica`, `texto`, `data_publicacao`, `fk_Usuario_id_usuario`) VALUES
(1, 'Pessoal, tem um site muito legal: XXXXX', '2026-05-02', NULL),
(2, 'Pessoal, tem um site muito legal: XXXXX', '2026-05-02', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `requisitos` varchar(500) DEFAULT NULL,
  `id_fonte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `documento`
--

INSERT INTO `documento` (`id_documento`, `tipo`, `descricao`, `requisitos`, `id_fonte`) VALUES
(1, 'CPF', 'Cadastro de Pessoa Física para estrangeiros no Brasil.', 'Documento de identificação válido, comprovante de residência e formulário de solicitação.', 1),
(2, 'RNM', 'Registro Nacional Migratório para imigrantes residentes no Brasil.', 'Passaporte, visto ou autorização de residência, comprovante de pagamento e agendamento na Polícia Federal.', 2),
(3, 'Carteira de Trabalho', 'Documento necessário para registro de vínculo empregatício no Brasil.', 'CPF, documento de identificação e cadastro nos canais oficiais do governo.', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fonte_oficial`
--

CREATE TABLE `fonte_oficial` (
  `id_fonte` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `tipoFonte` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fonte_oficial`
--

INSERT INTO `fonte_oficial` (`id_fonte`, `nome`, `url`, `tipoFonte`) VALUES
(1, 'Receita Federal', 'https://www.gov.br/receitafederal', 'Governo Federal'),
(2, 'Polícia Federal', 'https://www.gov.br/pf', 'Governo Federal'),
(3, 'Ministério do Trabalho', 'https://www.gov.br/trabalho-e-emprego', 'Governo Federal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `orgao`
--

CREATE TABLE `orgao` (
  `id_orgao` int(11) NOT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `contato` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `orgao`
--

INSERT INTO `orgao` (`id_orgao`, `nome`, `endereco`, `contato`) VALUES
(1, 'Polícia Federal - Atendimento ao Imigrante', 'Rua Hugo D’Antola, 95 - Lapa, São Paulo - SP', '(11) 3538-5000'),
(2, 'Receita Federal - Atendimento CPF', 'Av. Prestes Maia, 733 - Luz, São Paulo - SP', '(11) 3003-0146'),
(3, 'CRAS - Centro de Referência de Assistência Social', 'Unidade mais próxima conforme município de residência', '156'),
(4, 'Ministério do Trabalho', 'Atendimento digital pelo portal gov.br', '158');

-- --------------------------------------------------------

--
-- Estrutura para tabela `origem`
--

CREATE TABLE `origem` (
  `fk_Documento_id_documento` int(11) DEFAULT NULL,
  `fk_Fonte_Oficial_id_fonte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `origem`
--

INSERT INTO `origem` (`fk_Documento_id_documento`, `fk_Fonte_Oficial_id_fonte`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `status_residencia` varchar(50) DEFAULT NULL,
  `apelido` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `idioma` varchar(30) DEFAULT NULL,
  `pais_origem` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `status_residencia`, `apelido`, `email`, `idioma`, `pais_origem`, `senha`) VALUES
(4, 'Beatriz Maria Gris de Freitas', 'Aprovada', 'Bea', 'beatriz.freitas74@etec.sp.gov.br', 'Português', 'beatriz.freitas74@etec.sp.gov.br', '$2y$10$3qNUVA6oSP/LM/CvYDrwM.geVKNyc0qNcrpRXaoBXrzPv1L98mXbe');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`fk_Usuario_id_usuario`);

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `fk_Usuario_id_usuario` (`fk_Usuario_id_usuario`);

--
-- Índices de tabela `dica`
--
ALTER TABLE `dica`
  ADD PRIMARY KEY (`id_dica`),
  ADD KEY `fk_Usuario_id_usuario` (`fk_Usuario_id_usuario`);

--
-- Índices de tabela `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_fonte` (`id_fonte`);

--
-- Índices de tabela `fonte_oficial`
--
ALTER TABLE `fonte_oficial`
  ADD PRIMARY KEY (`id_fonte`);

--
-- Índices de tabela `orgao`
--
ALTER TABLE `orgao`
  ADD PRIMARY KEY (`id_orgao`);

--
-- Índices de tabela `origem`
--
ALTER TABLE `origem`
  ADD KEY `fk_Documento_id_documento` (`fk_Documento_id_documento`),
  ADD KEY `fk_Fonte_Oficial_id_fonte` (`fk_Fonte_Oficial_id_fonte`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `dica`
--
ALTER TABLE `dica`
  MODIFY `id_dica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fonte_oficial`
--
ALTER TABLE `fonte_oficial`
  MODIFY `id_fonte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `orgao`
--
ALTER TABLE `orgao`
  MODIFY `id_orgao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`fk_Usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`fk_Usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `dica`
--
ALTER TABLE `dica`
  ADD CONSTRAINT `dica_ibfk_1` FOREIGN KEY (`fk_Usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_fonte`) REFERENCES `fonte_oficial` (`id_fonte`);

--
-- Restrições para tabelas `origem`
--
ALTER TABLE `origem`
  ADD CONSTRAINT `origem_ibfk_1` FOREIGN KEY (`fk_Documento_id_documento`) REFERENCES `documento` (`id_documento`) ON DELETE CASCADE,
  ADD CONSTRAINT `origem_ibfk_2` FOREIGN KEY (`fk_Fonte_Oficial_id_fonte`) REFERENCES `fonte_oficial` (`id_fonte`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jun-2024 às 01:56
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medcontrol_db`
CREATE database medcontrol_db;
use medcontrol_db;
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `select_all_pacientes` (IN `_offset` INT, IN `records_per_page` INT)   BEGIN
	SELECT ID, nome_completo, idade, sexo, cidade, estado, CPF, email, telefone
	FROM paciente
	ORDER BY date_ini DESC
	LIMIT _offset, records_per_page;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `doencas`
--

CREATE TABLE `doencas` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `CID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `doencas`
--

INSERT INTO `doencas` (`ID`, `nome`, `CID`) VALUES
(1, 'Hipertensão essencial', 'I10'),
(2, 'Diabetes mellitus', 'E11'),
(3, 'Bronquite N/C como aguda ou crônica', 'J40'),
(4, 'Pneumonia viral, N/C em outra parte', 'J12'),
(5, 'Angina pectoris', 'I20'),
(6, 'doencas respiratória viral N/E', 'B34.9'),
(7, 'doencas cardíaca isquêmica crônica', 'I25'),
(8, 'Outra bactéria N/E como a causa de doencass infecciosas', 'B96.20'),
(9, 'Insuficiência cardíaca', 'I50'),
(10, 'Dengue', 'A90'),
(11, 'Coronavírus', 'B34.2'),
(12, 'Pneumonia N/E', 'J18'),
(13, 'Gastrite e duodenite', 'K29'),
(14, 'Transtornos de ansiedade', 'F41'),
(15, 'doencas do refluxo gastroesofágico', 'K21'),
(16, 'Dispepsia', 'K30'),
(17, 'doencas renal crônica', 'N18'),
(18, 'Insuficiência renal aguda', 'N17'),
(19, 'Hipertensão renovascular', 'I11'),
(20, 'Dislipidemia', 'E78'),
(21, 'Outras doencass pulmonares obstructivas crônicas', 'J44'),
(22, 'Asma', 'J45'),
(23, 'Fibrilação e flutter atrial', 'I48'),
(24, 'Infecções agudas das vias aéreas superiores, N/E', 'J06'),
(25, 'Síndrome do intestino irritável', 'K59'),
(26, 'Hiperplasia prostática benigna', 'N40'),
(27, 'doencas diverticular do intestino', 'K57'),
(28, 'Derrame cerebral não especificado como hemorrágico ou isquêmico', 'I64'),
(29, 'Outros transtornos nasais precisos', 'J34'),
(30, 'Íleo paralítico e obstrução intestinal sem hérnia', 'K56'),
(31, 'Outros transtornos do trato urinário', 'N39'),
(32, 'Enfisema', 'J43'),
(33, 'Gastroenterite e colite não infecciosa', 'K52'),
(34, 'doencas não reumática da válvula aórtica', 'I35'),
(35, 'Cardiomiopatia', 'I42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `CPF` varchar(11) NOT NULL,
  `senha` longtext NOT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `date_ini` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CRM` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`ID`, `email`, `nome`, `idade`, `CPF`, `senha`, `cargo`, `date_ini`, `CRM`) VALUES
(1, 'felipecandido8@hotmail.com', 'felipe', 20, '50252943805', '$2y$10$WyRmJBtHntje4UJbj6I76OQAeRnjajHPwdsI7Yf8MeT6eG/ynNWr6', 'funcionario', '2024-06-13 21:40:49', NULL),
(2, 'felipepcandido8@gmail.com', 'ze mane', 20, '22222222222', '$2y$10$DlQYACHY2LECzvM6Drk7/OObEpVazmoSOr2Y8thVSiQtAQd1d4YkS', 'medico', '2024-06-13 21:46:37', 2222222);

-- --------------------------------------------------------

--
-- Estrutura da tabela `paciente`
--

CREATE TABLE `paciente` (
  `ID` int(11) NOT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `sexo` enum('F','M','Outro') DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `date_ini` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `paciente`
--

INSERT INTO `paciente` (`ID`, `nome_completo`, `idade`, `sexo`, `cidade`, `estado`, `CPF`, `email`, `telefone`, `date_ini`) VALUES
(1, 'pedro neto', 23, 'F', 'leme', 'SP', '11111111111', 'pedro@gmail.com', '19980028922', '2024-06-13 21:43:02'),
(2, 'stephan mendes', 20, 'M', 'leme', 'SP', '23447587305', 'stepan.mendes@hotmail.com', '19989496521', '2024-06-17 21:27:46'),
(3, 'lucas', 20, 'M', 'araras', 'SP', '12312312332', 'ylukspvp@gmail.com', '12131231231', '2024-06-17 21:37:54'),
(4, 'bruno', 12, 'M', 'leme', 'SP', '72662398409', 'bruno@gmail.com', '19982739814', '2024-06-17 22:01:58'),
(5, 'ze mane', 10, 'F', 'leme', 'SP', '50252943809', 'zemane@hotmail.com', '19989596985', '2024-06-18 23:36:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prontuario`
--

CREATE TABLE `prontuario` (
  `ID` int(11) NOT NULL,
  `ID_paciente` int(11) DEFAULT NULL,
  `ID_doenca` int(11) DEFAULT NULL,
  `data_diagnostico` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_diagnostico` enum('Confirmado','Suspeito') DEFAULT NULL,
  `obito` tinyint(1) DEFAULT 0,
  `ID_funcionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `prontuario`
--

INSERT INTO `prontuario` (`ID`, `ID_paciente`, `ID_doenca`, `data_diagnostico`, `status_diagnostico`, `obito`, `ID_funcionario`) VALUES
(4, 1, 11, '2024-06-17 21:21:43', 'Suspeito', 0, 2),
(5, 2, 1, '2024-06-17 21:27:58', 'Suspeito', 1, 2),
(6, 2, 4, '2024-06-17 21:34:50', 'Suspeito', 0, 2),
(7, 3, 17, '2024-06-17 21:38:22', 'Suspeito', 0, 2),
(8, 4, 1, '2024-06-17 22:02:10', 'Suspeito', 0, 2),
(9, 4, 11, '2024-06-17 22:02:18', 'Suspeito', 0, 2),
(10, 3, 11, '2024-06-17 22:02:32', 'Suspeito', 0, 2),
(11, 2, 11, '2024-06-17 22:03:16', 'Confirmado', 0, 2);

--
-- Acionadores `prontuario`
--
DELIMITER $$
CREATE TRIGGER `tr_atualiza` BEFORE DELETE ON `prontuario` FOR EACH ROW BEGIN 
    DECLARE data_inicio DATE;
    SET data_inicio = OLD.data_diagnostico;
    IF DATEDIFF(CURRENT_DATE(), data_inicio) >= 30 THEN
        DELETE FROM prontuario
        WHERE id = OLD.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_detalhes_atendimentos`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_detalhes_atendimentos` (
`id_paciente` int(11)
,`nome_paciente` varchar(255)
,`idade` int(11)
,`sexo` enum('F','M','Outro')
,`cidade` varchar(100)
,`estado` varchar(2)
,`CPF` varchar(11)
,`email` varchar(255)
,`telefone` varchar(11)
,`id_funcioario` int(11)
,`nome_funcionario` varchar(255)
,`cargo` varchar(30)
,`id_doenca` int(11)
,`nome_doenca` varchar(255)
,`CID` varchar(30)
,`id_prontuario` int(11)
,`data_diagnostico` timestamp
,`obito` tinyint(1)
,`status_diagnostico` enum('Confirmado','Suspeito')
);

-- --------------------------------------------------------

--
-- Estrutura para vista `view_detalhes_atendimentos`
--
DROP TABLE IF EXISTS `view_detalhes_atendimentos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_detalhes_atendimentos`  AS SELECT `p`.`ID` AS `id_paciente`, `p`.`nome_completo` AS `nome_paciente`, `p`.`idade` AS `idade`, `p`.`sexo` AS `sexo`, `p`.`cidade` AS `cidade`, `p`.`estado` AS `estado`, `p`.`CPF` AS `CPF`, `p`.`email` AS `email`, `p`.`telefone` AS `telefone`, `f`.`ID` AS `id_funcioario`, `f`.`nome` AS `nome_funcionario`, `f`.`cargo` AS `cargo`, `d`.`ID` AS `id_doenca`, `d`.`nome` AS `nome_doenca`, `d`.`CID` AS `CID`, `pr`.`ID` AS `id_prontuario`, `pr`.`data_diagnostico` AS `data_diagnostico`, `pr`.`obito` AS `obito`, `pr`.`status_diagnostico` AS `status_diagnostico` FROM (((`prontuario` `pr` join `paciente` `p` on(`pr`.`ID_paciente` = `p`.`ID`)) join `funcionario` `f` on(`pr`.`ID_funcionario` = `f`.`ID`)) join `doencas` `d` on(`pr`.`ID_doenca` = `d`.`ID`)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `doencas`
--
ALTER TABLE `doencas`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `CPF` (`CPF`);

--
-- Índices para tabela `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `prontuario`
--
ALTER TABLE `prontuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_doenca` (`ID_doenca`),
  ADD KEY `ID_funcionario` (`ID_funcionario`),
  ADD KEY `ID_paciente` (`ID_paciente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `doencas`
--
ALTER TABLE `doencas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `paciente`
--
ALTER TABLE `paciente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `prontuario`
--
ALTER TABLE `prontuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `prontuario`
--
ALTER TABLE `prontuario`
  ADD CONSTRAINT `prontuario_ibfk_1` FOREIGN KEY (`ID_doenca`) REFERENCES `doencas` (`ID`),
  ADD CONSTRAINT `prontuario_ibfk_2` FOREIGN KEY (`ID_funcionario`) REFERENCES `funcionario` (`ID`),
  ADD CONSTRAINT `prontuario_ibfk_3` FOREIGN KEY (`ID_paciente`) REFERENCES `paciente` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

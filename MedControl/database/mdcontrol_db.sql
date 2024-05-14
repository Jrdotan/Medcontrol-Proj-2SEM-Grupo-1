SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `doencas` (
  `ID` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `CID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `funcionario` (
  `ID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `CPF` varchar(11) NOT NULL,
  `senha` longtext NOT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `date_ini` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sexo` enum('F','M','Outros') DEFAULT NULL,
  `CRM` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `paciente` (
  `ID` int(11) NOT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `sexo` enum('F','M','Outro') DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `prontuario` (
  `ID` int(11) NOT NULL,
  `ID_paciente` int(11) DEFAULT NULL,
  `ID_doenca` int(11) DEFAULT NULL,
  `data_diagnostico` date DEFAULT NULL,
  `status_diagnostico` enum('Confirmado','Suspeito') DEFAULT NULL,
  `obito` tinyint(1) DEFAULT NULL,
  `ID_funcionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `doencas`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `paciente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `prontuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_Paciente` (`ID_paciente`),
  ADD KEY `FK_Funcionario` (`ID_funcionario`),
  ADD KEY `FK_Doenca` (`ID_doenca`);


ALTER TABLE `doencas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `funcionario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `paciente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `prontuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `prontuario`
  ADD CONSTRAINT `FK_Doenca` FOREIGN KEY (`ID_doenca`) REFERENCES `doencas` (`ID`),
  ADD CONSTRAINT `FK_Funcionario` FOREIGN KEY (`ID_funcionario`) REFERENCES `funcionario` (`ID`),
  ADD CONSTRAINT `FK_Paciente` FOREIGN KEY (`ID_paciente`) REFERENCES `paciente` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

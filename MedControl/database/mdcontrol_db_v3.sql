SET time_zone = '-03:00';

--
-- Banco de dados: mdcontrol_db
--
CREATE DATABASE medcontrol_db;
USE medcontrol_db;
-- --------------------------------------------------------

--
-- Estrutura da tabela doencas
--

CREATE TABLE doencas (
  ID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nome varchar(255) DEFAULT NULL,
  CID varchar(30) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estrutura da tabela funcionario
--

CREATE TABLE funcionario (
  ID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  email varchar(255) UNIQUE NOT NULL,
  nome varchar(255) NOT NULL,
  idade int(11) DEFAULT NULL,
  CPF varchar(11) UNIQUE NOT NULL,
  senha longtext NOT NULL,
  cargo varchar(30) DEFAULT NULL,
  date_ini timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  CRM int(7) DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Estrutura da tabela paciente
--

CREATE TABLE paciente (
  ID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nome_completo varchar(255) DEFAULT NULL,
  idade int(11) DEFAULT NULL,
  sexo enum('F','M','Outro') DEFAULT NULL,
  cidade varchar(100) DEFAULT NULL,
  estado varchar(2) DEFAULT NULL,
  CPF varchar(11) UNIQUE DEFAULT NULL,
  email varchar(255) UNIQUE DEFAULT NULL,
  telefone varchar(11) DEFAULT NULL,
  date_ini timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);

-- --------------------------------------------------------

--
-- Estrutura da tabela prontuario
--


CREATE TABLE prontuario (
  ID int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  ID_paciente int(11) DEFAULT NULL,
  ID_doenca int(11) DEFAULT NULL,
  data_diagnostico timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  status_diagnostico enum('Confirmado','Suspeito') DEFAULT NULL,
  obito BOOLEAN DEFAULT FALSE,
  ID_funcionario int(11) DEFAULT NULL,
  FOREIGN KEY (ID_doenca) REFERENCES doencas (ID),
  FOREIGN KEY (ID_funcionario) REFERENCES funcionario (ID),
  FOREIGN KEY (ID_paciente) REFERENCES paciente (ID)
);
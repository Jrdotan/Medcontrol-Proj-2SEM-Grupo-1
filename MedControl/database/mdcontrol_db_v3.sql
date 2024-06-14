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

INSERT INTO doencas (CID, nome) VALUES ('I10', 'Hipertensão essencial');
INSERT INTO doencas (CID, nome) VALUES ('E11', 'Diabetes mellitus');
INSERT INTO doencas (CID, nome) VALUES ('J40', 'Bronquite N/C como aguda ou crônica');
INSERT INTO doencas (CID, nome) VALUES ('J12', 'Pneumonia viral, N/C em outra parte');
INSERT INTO doencas (CID, nome) VALUES ('I20', 'Angina pectoris');
INSERT INTO doencas (CID, nome) VALUES ('B34.9', 'doencas respiratória viral N/E');
INSERT INTO doencas (CID, nome) VALUES ('I25', 'doencas cardíaca isquêmica crônica');
INSERT INTO doencas (CID, nome) VALUES ('B96.20', 'Outra bactéria N/E como a causa de doencass infecciosas');
INSERT INTO doencas (CID, nome) VALUES ('I50', 'Insuficiência cardíaca');
INSERT INTO doencas (CID, nome) VALUES ('A90', 'Dengue');
INSERT INTO doencas (CID, nome) VALUES ('B34.2', 'Coronavírus');
INSERT INTO doencas (CID, nome) VALUES ('J18', 'Pneumonia N/E');
INSERT INTO doencas (CID, nome) VALUES ('K29', 'Gastrite e duodenite');
INSERT INTO doencas (CID, nome) VALUES ('F41', 'Transtornos de ansiedade');
INSERT INTO doencas (CID, nome) VALUES ('K21', 'doencas do refluxo gastroesofágico');
INSERT INTO doencas (CID, nome) VALUES ('K30', 'Dispepsia');
INSERT INTO doencas (CID, nome) VALUES ('N18', 'doencas renal crônica');
INSERT INTO doencas (CID, nome) VALUES ('N17', 'Insuficiência renal aguda');
INSERT INTO doencas (CID, nome) VALUES ('I11', 'Hipertensão renovascular');
INSERT INTO doencas (CID, nome) VALUES ('E78', 'Dislipidemia');
INSERT INTO doencas (CID, nome) VALUES ('J44', 'Outras doencass pulmonares obstructivas crônicas');
INSERT INTO doencas (CID, nome) VALUES ('J45', 'Asma');
INSERT INTO doencas (CID, nome) VALUES ('I48', 'Fibrilação e flutter atrial');
INSERT INTO doencas (CID, nome) VALUES ('J06', 'Infecções agudas das vias aéreas superiores, N/E');
INSERT INTO doencas (CID, nome) VALUES ('K59', 'Síndrome do intestino irritável');
INSERT INTO doencas (CID, nome) VALUES ('N40', 'Hiperplasia prostática benigna');
INSERT INTO doencas (CID, nome) VALUES ('K57', 'doencas diverticular do intestino');
INSERT INTO doencas (CID, nome) VALUES ('I64', 'Derrame cerebral não especificado como hemorrágico ou isquêmico');
INSERT INTO doencas (CID, nome) VALUES ('J34', 'Outros transtornos nasais precisos');
INSERT INTO doencas (CID, nome) VALUES ('K56', 'Íleo paralítico e obstrução intestinal sem hérnia');
INSERT INTO doencas (CID, nome) VALUES ('N39', 'Outros transtornos do trato urinário');
INSERT INTO doencas (CID, nome) VALUES ('J43', 'Enfisema');
INSERT INTO doencas (CID, nome) VALUES ('K52', 'Gastroenterite e colite não infecciosa');
INSERT INTO doencas (CID, nome) VALUES ('I35', 'doencas não reumática da válvula aórtica');
INSERT INTO doencas (CID, nome) VALUES ('I42', 'Cardiomiopatia');

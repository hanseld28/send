-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Jul-2018 às 17:32
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdsendagendaonline`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbagenda`
--

CREATE TABLE `tbagenda` (
  `codAgenda` int(11) NOT NULL,
  `codAluno` int(11) NOT NULL DEFAULT '0',
  `dataCadastroAgenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbagenda`
--

INSERT INTO `tbagenda` (`codAgenda`, `codAluno`, `dataCadastroAgenda`) VALUES
(2, 2, '2018-07-01 03:28:06'),
(3, 3, '2018-07-01 03:36:50'),
(4, 4, '2018-07-01 03:43:59'),
(5, 5, '2018-07-01 03:56:36'),
(6, 6, '2018-07-01 13:28:19'),
(7, 7, '2018-07-01 13:36:38'),
(8, 8, '2018-07-01 13:49:21'),
(9, 9, '2018-07-01 13:58:36'),
(10, 10, '2018-07-01 14:11:55'),
(11, 11, '2018-07-01 14:19:08'),
(12, 12, '2018-07-01 14:25:24'),
(13, 13, '2018-07-01 14:37:21'),
(14, 14, '2018-07-01 14:52:18'),
(15, 15, '2018-07-01 15:02:52'),
(16, 16, '2018-07-01 15:17:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbalternativa`
--

CREATE TABLE `tbalternativa` (
  `codAlternativa` int(11) NOT NULL,
  `descAlternativa` varchar(100) NOT NULL,
  `dataCadastroAlternativa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbalternativa`
--

INSERT INTO `tbalternativa` (`codAlternativa`, `descAlternativa`, `dataCadastroAlternativa`) VALUES
(1, 'Bom', '2018-06-21 23:49:06'),
(2, 'Regular', '2018-06-21 23:49:06'),
(3, 'Ruim', '2018-06-21 23:49:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbalternativacard`
--

CREATE TABLE `tbalternativacard` (
  `codAlternativaCard` int(11) NOT NULL,
  `codAlternativa` int(11) NOT NULL DEFAULT '0',
  `codCard` int(11) NOT NULL DEFAULT '0',
  `dataCadastroAlternativaCard` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `codRotina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbaluno`
--

CREATE TABLE `tbaluno` (
  `codAluno` int(11) NOT NULL,
  `nomeAluno` varchar(100) NOT NULL DEFAULT '',
  `dataNascAluno` date NOT NULL,
  `nacionalidadeAluno` varchar(50) NOT NULL,
  `sexoAluno` varchar(9) NOT NULL,
  `corRacaAluno` varchar(50) NOT NULL,
  `rgAluno` varchar(13) DEFAULT NULL,
  `certidaoNascimentoAluno` varchar(40) NOT NULL,
  `logradouroAluno` varchar(100) NOT NULL,
  `numCasaAluno` varchar(10) NOT NULL,
  `complementoAluno` varchar(80) DEFAULT NULL,
  `cepAluno` varchar(9) NOT NULL,
  `bairroAluno` varchar(80) NOT NULL,
  `cidadeAluno` varchar(70) NOT NULL,
  `codResponsavel` int(11) NOT NULL,
  `fotoAluno` varchar(100) DEFAULT NULL,
  `dataCadastroAluno` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbaluno`
--

INSERT INTO `tbaluno` (`codAluno`, `nomeAluno`, `dataNascAluno`, `nacionalidadeAluno`, `sexoAluno`, `corRacaAluno`, `rgAluno`, `certidaoNascimentoAluno`, `logradouroAluno`, `numCasaAluno`, `complementoAluno`, `cepAluno`, `bairroAluno`, `cidadeAluno`, `codResponsavel`, `fotoAluno`, `dataCadastroAluno`) VALUES
(2, 'João Pereira Junior', '2018-01-01', 'brasileiro', 'Masculino', 'Branco(a)', '23.654.765', '988777 66 66 6789 678 906789 0', 'Rua Padre Sílvio', '21', 'perto da feira', '76913-778', 'Riachuelo', 'Ji-Paraná', 2, '752da465eb4d46627f2669bd9dad8e07.jpg', '2018-07-01 03:28:06'),
(3, 'Joana Pereira Junior', '2018-01-01', 'brasileira', 'Feminino', 'Branco(a)', '23.654.765-9', '887575 65 65 6566 565 656565 65', 'Rua Padre Sílvio', '23', 'perto da feira', '76913-778', 'Riachuelo', 'Ji-Paraná', 2, 'dd83603c686d6a96cf73128a0c6443f0.jpg', '2018-07-01 03:36:50'),
(4, 'Mikaely Silva Santos', '2018-02-02', 'brasileira', 'Feminino', 'Preto(a)', '98.095.432-xx', '998484 87 46 4646 445 454554 45', 'Rua São Sebastião', '234', 'Casa B', '08081-650', 'Cidade de Deus', 'São Paulo', 3, '639e75fd9105559e9cb60efbffe7fcbf.png', '2018-07-01 03:43:59'),
(5, 'Marcos Vincent Lemes', '2017-12-03', 'brasileiro', 'Masculino', 'Preto(a)', '93.485.968-0', '555555 25 87 5215 542 254563 96', 'Rua Horácio de Lima', '44', 'Ao lado do mercado', '12518-489', 'Jardim Esperança', 'Guaratinguetá', 4, '0dbba9feec84a4010bf810467c2619ab.png', '2018-07-01 03:56:35'),
(6, 'José Pereira Mosquino', '2018-03-24', 'brasileiro', 'Masculino', 'Branco(a)', '37.487.476-6', '837376 46 46 4646 464 646454 54', 'Rua São Vítor', '02', 'apartamento bloco C', '11082-130', 'Morro São Bento', 'Santos', 5, 'd378af6a46ee1b866e54907666f46ae8.png', '2018-07-01 13:28:19'),
(7, 'Maria Eduarda Shultz Silva', '2018-04-12', 'brasileira', 'Feminino', 'Branco(a)', '38.474.674-7', '887776 66 65 3547 747 474774 44', 'Rua Guiticoroia', '87', 'Casa B', '08420-490', 'Parque Central', 'São Paulo', 6, 'a1ba558d2410a0f5bdda634b22d67496.jpg', '2018-07-01 13:36:38'),
(8, 'Joaquina Moreira Silva', '2015-01-01', 'brasileira', 'Feminino', 'Preto(a)', '27.373.856-54', '857565 65 66 5856 886 868696 66', 'Rua Tutóia', '65', 'Casa', '04007-901', 'Vila Mariana', 'São Paulo', 7, '3eec5d8ddf7aa23cca04d1ddd32db523.jpg', '2018-07-01 13:49:21'),
(9, 'Pedro Marcel Lins', '2016-05-01', 'brasileiro', 'Masculino', 'Branco(a)', '27.276.365-7', '857575 65 65 6656 565 565665 65', 'Rua Doutor Prudente de Morais', '8', 'Apartamento Bloco A', '08551-230', 'Vila Júlia', 'Poá', 8, '75daec68d2d14afd7ee274bbfd69aa94.png', '2018-07-01 13:58:36'),
(10, 'Henrique Silva Oliveira', '2015-03-09', 'brasileiro', 'Masculino', 'Pardo(a)', '26.386.387-7', '272736 36 36 3534 343 685966 45', 'Rua Mário Milanello', '43', 'Casa', '18702-540', 'Parque Santa Elizabeth IV', 'Avaré', 9, 'b39e55fe63b64651d9e3a26b3d704dc5.png', '2018-07-01 14:11:55'),
(11, 'Paulo Silva Oliveira', '2015-03-02', 'brasileiro', 'Masculino', 'Preto(a)', '12.336.486-x', '388363 66 33 3737 737 373737 33', 'Rua Ilha das Flores', '86', 'casa', '01023-020', 'Centro', 'São Paulo', 9, '1292839db69e4c333a90b9f733754617.png', '2018-07-01 14:19:08'),
(12, 'Sarah Silva Oliveira', '2013-02-01', 'brasileira', 'Feminino', 'Pardo(a)', '23.343.926-4', '273648 84 77 4749 573 524373 33', 'Rua Ilha das Flores', '09', 'Casa', '01023-020', 'Centro', 'São Paulo', 9, '5509dfdb807a6b901cd7f68f5b4c2d44.jpg', '2018-07-01 14:25:24'),
(13, 'Elizabeth Nogueira Nunes', '2013-01-01', 'brasileira', 'sexo', 'Branco(a)', '25.397.562-1', '958575 66 46 4646 646 464644 54', 'Rua Coração de Maria', '53', 'casa', '01448-100', 'Jardim Europa', 'São Paulo', 2, '90176ad9d37aa3d45d6d314e07bee315.jpg', '2018-07-01 14:37:21'),
(14, 'Lucas Gabriel Ferreira Nunez', '2013-04-01', 'brasileiro', 'Masculino', 'Branco(a)', '27.375.376-3', '787878 67 86 5456 321 423456 66', 'Rua 8 de Agosto', '31', 'apartamento 41 bloco C', '09783-488', 'Montanhão', 'São Bernardo do Campo', 10, '704a0fd1d9c1aab5b53e0e672b9b7d8a.jpg', '2018-07-01 14:52:18'),
(15, 'Magnólia Moraes ', '2013-03-01', 'brasileira', 'Feminino', 'Preto(a)', '48.353.917-2', '846653 43 94 7446 749 948444 44', 'Rua Cinco-C', '88', 'casa', '07252-530', 'Jardim Nova Cidade', 'Guarulhos', 9, '436148a47ae3421e5d9183f19557d6f0.png', '2018-07-01 15:02:52'),
(16, 'Icaro Christopher Kataguri', '2013-02-20', 'brasileiro', 'Masculino', 'Amarelo(a)', '23.486.675-8', '833664 53 56 3748 927 524563 33', 'Rua Daniel Peçanha de Moraes', '53', 'casa', '12941-050', 'Vila Santista', 'Atibaia', 11, 'd9e21c49a9c5c986e5e45bba579e5b2a.png', '2018-07-01 15:17:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbatividadeextracurricular`
--

CREATE TABLE `tbatividadeextracurricular` (
  `codAtividadeExtraCurricular` int(11) NOT NULL,
  `descAtividadeExtraCurricular` varchar(100) NOT NULL,
  `dataCadastroAtividadeExtraCurricular` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbatividadeextracurricular`
--

INSERT INTO `tbatividadeextracurricular` (`codAtividadeExtraCurricular`, `descAtividadeExtraCurricular`, `dataCadastroAtividadeExtraCurricular`) VALUES
(1, 'Judô', '2018-06-21 23:15:58'),
(2, 'Ballet', '2018-06-21 23:16:20'),
(3, 'Inglês', '2018-06-21 23:16:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcaracteristicaprontuario`
--

CREATE TABLE `tbcaracteristicaprontuario` (
  `codCaracteristicaProntuario` int(11) NOT NULL,
  `codCaracteristicaSaude` int(11) NOT NULL,
  `codProntuarioAluno` int(11) NOT NULL,
  `dataCadastroCaracteristicaProntuario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcaracteristicasaude`
--

CREATE TABLE `tbcaracteristicasaude` (
  `codCaracteristicaSaude` int(11) NOT NULL,
  `descCaracteristicaSaude` varchar(300) NOT NULL,
  `dataCadastroCaracteristicaSaude` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcard`
--

CREATE TABLE `tbcard` (
  `codCard` int(11) NOT NULL,
  `descCard` varchar(100) NOT NULL DEFAULT '',
  `dataCadastroCard` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcard`
--

INSERT INTO `tbcard` (`codCard`, `descCard`, `dataCadastroCard`) VALUES
(1, 'Alimentação', '2018-06-21 23:16:46'),
(2, 'Aprendizado', '2018-06-21 23:16:58'),
(3, 'Comportamento', '2018-06-21 23:17:30'),
(4, 'Descanso', '2018-06-21 23:17:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcardrotina`
--

CREATE TABLE `tbcardrotina` (
  `codCardRotina` int(11) NOT NULL,
  `codCard` int(11) NOT NULL,
  `codRotina` int(11) NOT NULL,
  `dataCadastroCardRotina` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcargo`
--

CREATE TABLE `tbcargo` (
  `codCargo` int(11) NOT NULL,
  `nomeCargo` varchar(50) NOT NULL,
  `dataCadastroCargo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcargo`
--

INSERT INTO `tbcargo` (`codCargo`, `nomeCargo`, `dataCadastroCargo`) VALUES
(1, 'Professor', '2018-06-21 23:18:07'),
(2, 'Coordenador', '2018-06-21 23:18:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcomunicado`
--

CREATE TABLE `tbcomunicado` (
  `codComunicado` int(11) NOT NULL,
  `assuntoComunicado` varchar(500) DEFAULT NULL,
  `descComunicado` varchar(255) NOT NULL,
  `codTurma` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `dataCadastroComunicado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcomunicadoagenda`
--

CREATE TABLE `tbcomunicadoagenda` (
  `codComunicadoAgenda` int(11) NOT NULL,
  `codAgenda` int(11) NOT NULL,
  `codComunicado` int(11) NOT NULL,
  `dataCadastroComunicadoAgenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcontatoemergenciaaluno`
--

CREATE TABLE `tbcontatoemergenciaaluno` (
  `codContatoEmergenciaAluno` int(11) NOT NULL,
  `nomeContatoEmergenciaAluno` varchar(80) DEFAULT NULL,
  `telefoneContatoEmergencia` varchar(15) DEFAULT NULL,
  `codAluno` int(11) NOT NULL,
  `dataCadastroContatoEmergenciaAluno` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcontatoemergenciaaluno`
--

INSERT INTO `tbcontatoemergenciaaluno` (`codContatoEmergenciaAluno`, `nomeContatoEmergenciaAluno`, `telefoneContatoEmergencia`, `codAluno`, `dataCadastroContatoEmergenciaAluno`) VALUES
(4, 'Julia Moraes - Tia', '(11) 73736-3633', 2, '2018-07-01 03:28:06'),
(5, 'Pedro Farias - Avô', '(11) 33373-7373', 2, '2018-07-01 03:28:06'),
(6, 'Maria do Carmo Mota - Avó', '(11) 83737-3636', 2, '2018-07-01 03:28:06'),
(7, 'Mirella Silva Nogueira - Tia', '(11) 99383-7373', 4, '2018-07-01 03:43:59'),
(8, 'Fernando Moraes Santos - Pai', '(11) 73636-3636', 4, '2018-07-01 03:43:59'),
(9, '', '', 4, '2018-07-01 03:43:59'),
(10, 'Maria Aparecida - Avó', '(11) 76363-3553', 5, '2018-07-01 03:56:36'),
(11, 'Laura Amorim - Avó', '(11) 84747-4766', 6, '2018-07-01 13:28:19'),
(12, 'Marcio Nogueira - Tio', '(11) 74646-4664', 7, '2018-07-01 13:36:38'),
(13, 'José Pereira - Avô', '(11) 85885-7577', 7, '2018-07-01 13:36:38'),
(14, '', '', 7, '2018-07-01 13:36:38'),
(15, 'Paulo Morim nobrez - Pai', '(11) 73636-6363', 8, '2018-07-01 13:49:21'),
(16, 'Marta Silva - Madrasta', '(11) 73636-6363', 9, '2018-07-01 13:58:36'),
(17, 'Roger Castro - Tio', '(11) 72625-2525', 10, '2018-07-01 14:11:55'),
(18, 'Beth Jussara - Mãe', '(11) 36363-6363', 14, '2018-07-01 14:52:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcronograma`
--

CREATE TABLE `tbcronograma` (
  `codCronograma` int(11) NOT NULL,
  `descCronograma` varchar(150) DEFAULT NULL,
  `codTurma` int(11) NOT NULL,
  `dataCadastroCronograma` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbcronograma`
--

INSERT INTO `tbcronograma` (`codCronograma`, `descCronograma`, `codTurma`, `dataCadastroCronograma`) VALUES
(1, NULL, 1, '2018-07-01 02:17:52'),
(2, NULL, 2, '2018-07-01 02:18:11'),
(3, NULL, 3, '2018-07-01 02:18:25'),
(4, NULL, 4, '2018-07-01 02:30:58'),
(5, NULL, 5, '2018-07-01 02:31:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionario`
--

CREATE TABLE `tbfuncionario` (
  `codFuncionario` int(11) NOT NULL,
  `nomeFuncionario` varchar(100) NOT NULL,
  `rgFuncionario` varchar(13) NOT NULL,
  `cpfFuncionario` varchar(14) NOT NULL,
  `logradouroFuncionario` varchar(100) NOT NULL,
  `complementoFuncionario` varchar(20) NOT NULL,
  `numCasaFuncionario` varchar(10) NOT NULL,
  `cepFuncionario` varchar(9) NOT NULL,
  `cidadeFuncionario` varchar(70) NOT NULL,
  `emailFuncionario` varchar(80) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `dataCadastroFuncionario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbfuncionario`
--

INSERT INTO `tbfuncionario` (`codFuncionario`, `nomeFuncionario`, `rgFuncionario`, `cpfFuncionario`, `logradouroFuncionario`, `complementoFuncionario`, `numCasaFuncionario`, `cepFuncionario`, `cidadeFuncionario`, `emailFuncionario`, `codUsuario`, `dataCadastroFuncionario`) VALUES
(1, 'admin', '21.334.434-9', '323.604.598-13', 'Rua Cyrillo da Silva Pinto', 'casa', '12', '08470-590', 'São Paulo', 'polarisenterprise2017@gmail.com', 1, '2018-06-30 21:07:33'),
(2, 'Aline Mendonça', '12.345.754-02', '228.304.140-63', 'Rua Manoel Telles Barreto', 'complemento', '65', '07055-130', 'Guarulhos', 'AlineM@gmail.com', 2, '2018-07-01 02:57:56'),
(3, 'Vanessa Ferraz', '98.765.098-00', '735.104.740-58', 'Acesso Três', 'casa', '24', '90610-033', 'Porto Alegre', 'VanessaF@gmail.com', 3, '2018-07-01 02:59:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionariocargo`
--

CREATE TABLE `tbfuncionariocargo` (
  `codFuncionarioCargo` int(11) NOT NULL,
  `codCargo` int(11) NOT NULL,
  `codFuncionario` int(11) NOT NULL,
  `dataCadastroFuncionarioCargo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbfuncionariocargo`
--

INSERT INTO `tbfuncionariocargo` (`codFuncionarioCargo`, `codCargo`, `codFuncionario`, `dataCadastroFuncionarioCargo`) VALUES
(1, 2, 1, '2018-06-30 21:10:28'),
(2, 1, 2, '2018-07-01 02:57:57'),
(3, 1, 3, '2018-07-01 02:59:51'),
(4, 2, 3, '2018-07-01 02:59:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgrauescolar`
--

CREATE TABLE `tbgrauescolar` (
  `codGrauEscolar` int(11) NOT NULL,
  `descGrauEscolar` varchar(50) NOT NULL,
  `codPeriodo` int(11) NOT NULL,
  `dataCadastroGrauEscolar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbgrauescolar`
--

INSERT INTO `tbgrauescolar` (`codGrauEscolar`, `descGrauEscolar`, `codPeriodo`, `dataCadastroGrauEscolar`) VALUES
(1, 'Berçario', 1, '2018-07-01 01:14:25'),
(2, 'pré I', 2, '2018-07-01 01:14:55'),
(3, 'pré II', 1, '2018-07-01 01:15:29'),
(4, 'pré III', 3, '2018-07-01 01:16:09'),
(5, 'Berçario', 1, '2018-07-01 01:16:26'),
(6, 'Maternal', 4, '2018-07-01 01:18:36'),
(7, 'Mini Maternal', 3, '2018-07-01 01:19:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbhistoricochat`
--

CREATE TABLE `tbhistoricochat` (
  `codHistoricoChat` int(11) NOT NULL,
  `dataObservacaoChat` datetime NOT NULL,
  `observacaoChat` varchar(200) NOT NULL,
  `dataCadastroHistoricoChat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbitenscronograma`
--

CREATE TABLE `tbitenscronograma` (
  `codItensCronograma` int(11) NOT NULL,
  `descItensCronograma` varchar(300) NOT NULL,
  `horarioCronograma` time NOT NULL,
  `dataCadastroItensCronograma` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbitenscronograma`
--

INSERT INTO `tbitenscronograma` (`codItensCronograma`, `descItensCronograma`, `horarioCronograma`, `dataCadastroItensCronograma`) VALUES
(1, 'Café da manhã', '06:30:00', '2018-07-01 01:21:21'),
(2, 'Soninho', '15:00:00', '2018-07-01 01:24:43'),
(3, 'Almoço', '12:00:00', '2018-07-01 01:25:05'),
(4, 'Banho', '14:30:00', '2018-07-01 01:25:33'),
(5, 'Recreação', '10:00:00', '2018-07-01 01:25:51'),
(6, 'Lanche da tarde', '16:00:00', '2018-07-01 02:12:19'),
(7, 'Jantar', '17:30:00', '2018-07-01 02:12:41'),
(8, 'Brincar', '14:00:00', '2018-07-01 02:13:42'),
(9, 'Atividade Extra Curricular', '13:00:00', '2018-07-01 02:15:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbitensporcronograma`
--

CREATE TABLE `tbitensporcronograma` (
  `codItensPorCronograma` int(11) NOT NULL,
  `codCronograma` int(11) NOT NULL,
  `codItensCronograma` int(11) NOT NULL,
  `dataCadastroItensPorCronograma` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbitensporcronograma`
--

INSERT INTO `tbitensporcronograma` (`codItensPorCronograma`, `codCronograma`, `codItensCronograma`, `dataCadastroItensPorCronograma`) VALUES
(1, 1, 3, '2018-07-01 02:38:56'),
(2, 1, 5, '2018-07-01 02:39:18'),
(3, 1, 6, '2018-07-01 02:40:04'),
(4, 2, 1, '2018-07-01 02:43:10'),
(5, 2, 5, '2018-07-01 02:43:35'),
(6, 2, 3, '2018-07-01 02:44:06'),
(7, 3, 1, '2018-07-01 02:44:22'),
(8, 3, 5, '2018-07-01 02:44:34'),
(9, 3, 3, '2018-07-01 02:45:09'),
(10, 3, 9, '2018-07-01 02:45:24'),
(11, 3, 8, '2018-07-01 02:45:37'),
(12, 3, 6, '2018-07-01 02:45:50'),
(13, 3, 7, '2018-07-01 02:46:06'),
(14, 4, 1, '2018-07-01 02:47:06'),
(15, 4, 5, '2018-07-01 02:47:21'),
(16, 4, 4, '2018-07-01 02:47:39'),
(17, 4, 2, '2018-07-01 02:47:50'),
(18, 5, 3, '2018-07-01 02:48:38'),
(20, 5, 9, '2018-07-01 02:49:52'),
(21, 5, 8, '2018-07-01 02:50:05'),
(22, 5, 6, '2018-07-01 02:50:14'),
(23, 5, 2, '2018-07-01 02:50:32'),
(24, 5, 7, '2018-07-01 02:52:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmatricula`
--

CREATE TABLE `tbmatricula` (
  `codMatricula` int(11) NOT NULL,
  `dataMatricula` datetime NOT NULL,
  `numMatricula` varchar(20) NOT NULL,
  `codAluno` int(11) NOT NULL,
  `codTurma` int(11) NOT NULL,
  `dataCadastroMatricula` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbmatricula`
--

INSERT INTO `tbmatricula` (`codMatricula`, `dataMatricula`, `numMatricula`, `codAluno`, `codTurma`, `dataCadastroMatricula`) VALUES
(1, '2018-07-01 00:00:00', '1', 2, 4, '2018-07-01 03:28:06'),
(2, '2018-07-01 00:00:00', '2', 3, 4, '2018-07-01 03:36:51'),
(3, '2018-07-01 00:00:00', '3', 4, 4, '2018-07-01 03:43:59'),
(4, '2018-07-01 00:00:00', '4', 5, 4, '2018-07-01 03:56:36'),
(5, '2018-07-01 00:00:00', '5', 6, 4, '2018-07-01 13:28:19'),
(6, '2018-07-01 00:00:00', '6', 7, 4, '2018-07-01 13:36:38'),
(7, '2018-07-01 00:00:00', '7', 8, 5, '2018-07-01 13:49:21'),
(8, '2018-07-01 00:00:00', '8', 9, 5, '2018-07-01 13:58:36'),
(9, '2018-07-01 00:00:00', '9', 10, 5, '2018-07-01 14:11:55'),
(10, '2018-07-01 00:00:00', '10', 11, 5, '2018-07-01 14:19:08'),
(11, '2018-07-01 00:00:00', '11', 12, 3, '2018-07-01 14:25:24'),
(12, '2018-07-01 00:00:00', '12', 13, 3, '2018-07-01 14:37:21'),
(13, '2018-07-01 00:00:00', '13', 14, 3, '2018-07-01 14:52:18'),
(14, '2018-07-01 00:00:00', '14', 15, 3, '2018-07-01 15:02:52'),
(15, '2018-07-01 00:00:00', '15', 16, 3, '2018-07-01 15:17:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmatriculaatividadeextracurricular`
--

CREATE TABLE `tbmatriculaatividadeextracurricular` (
  `codMatriculaAtividadeExtraCurricular` int(11) NOT NULL,
  `codAtividadeExtraCurricular` int(11) NOT NULL,
  `codMatricula` int(11) NOT NULL,
  `dataCadastroMatriculaAtividadeExtraCurricular` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbmatriculaatividadeextracurricular`
--

INSERT INTO `tbmatriculaatividadeextracurricular` (`codMatriculaAtividadeExtraCurricular`, `codAtividadeExtraCurricular`, `codMatricula`, `dataCadastroMatriculaAtividadeExtraCurricular`) VALUES
(1, 3, 7, '2018-07-01 13:49:21'),
(2, 3, 8, '2018-07-01 13:58:36'),
(3, 3, 9, '2018-07-01 14:11:56'),
(4, 3, 10, '2018-07-01 14:19:08'),
(5, 2, 11, '2018-07-01 14:25:24'),
(6, 3, 11, '2018-07-01 14:25:24'),
(7, 1, 12, '2018-07-01 14:37:21'),
(8, 2, 12, '2018-07-01 14:37:21'),
(9, 3, 12, '2018-07-01 14:37:21'),
(10, 1, 13, '2018-07-01 14:52:18'),
(11, 2, 14, '2018-07-01 15:02:52'),
(12, 1, 15, '2018-07-01 15:17:49'),
(13, 3, 15, '2018-07-01 15:17:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbocorrencia`
--

CREATE TABLE `tbocorrencia` (
  `codOcorrencia` int(11) NOT NULL,
  `descOcorrencia` varchar(1000) NOT NULL,
  `codAgenda` int(11) NOT NULL,
  `dataCadastroOcorrencia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbocorrenciarotina`
--

CREATE TABLE `tbocorrenciarotina` (
  `codOcorrenciaRotina` int(11) NOT NULL,
  `codOcorrencia` int(11) NOT NULL DEFAULT '0',
  `codRotina` int(11) NOT NULL DEFAULT '0',
  `dataCadastroOcorrencia` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbperiodo`
--

CREATE TABLE `tbperiodo` (
  `codPeriodo` int(11) NOT NULL,
  `descPeriodo` varchar(50) NOT NULL,
  `horarioPeriodo` varchar(70) NOT NULL,
  `dataCadastroPeriodo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbperiodo`
--

INSERT INTO `tbperiodo` (`codPeriodo`, `descPeriodo`, `horarioPeriodo`, `dataCadastroPeriodo`) VALUES
(1, 'Manhã', '06:00', '2018-06-21 23:18:55'),
(2, 'Tarde', '12:00', '2018-06-21 23:19:10'),
(3, 'Integral', '06:00', '2018-07-01 01:11:52'),
(4, 'Meio Período', '12:00', '2018-07-01 01:13:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprofessorturma`
--

CREATE TABLE `tbprofessorturma` (
  `codProfessorTurma` int(11) NOT NULL,
  `codTurma` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `dataCadastroFuncionario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbprofessorturma`
--

INSERT INTO `tbprofessorturma` (`codProfessorTurma`, `codTurma`, `codUsuario`, `dataCadastroFuncionario`) VALUES
(1, 4, 2, '2018-07-01 03:38:47'),
(2, 5, 3, '2018-07-01 14:21:47'),
(3, 3, 3, '2018-07-01 14:26:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprontuarioaluno`
--

CREATE TABLE `tbprontuarioaluno` (
  `codProntuarioAluno` int(11) NOT NULL,
  `codAluno` int(11) NOT NULL,
  `tipoSanguineo` varchar(80) DEFAULT NULL,
  `deficiencia` varchar(255) DEFAULT NULL,
  `problemaSaude` varchar(255) DEFAULT NULL,
  `doencaContagiosa` varchar(225) DEFAULT NULL,
  `tratamentoCirurgico` varchar(255) DEFAULT NULL,
  `alergia` varchar(255) DEFAULT NULL,
  `acompanhamentoMedico` varchar(80) DEFAULT NULL,
  `medicacao` varchar(255) DEFAULT NULL,
  `dataCadastroProntuarioAluno` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbprontuarioaluno`
--

INSERT INTO `tbprontuarioaluno` (`codProntuarioAluno`, `codAluno`, `tipoSanguineo`, `deficiencia`, `problemaSaude`, `doencaContagiosa`, `tratamentoCirurgico`, `alergia`, `acompanhamentoMedico`, `medicacao`, `dataCadastroProntuarioAluno`) VALUES
(1, 2, 'A-', ',0', ',0', ',Catapora', '0', '0', NULL, '0', '2018-07-01 03:33:09'),
(2, 3, 'B+', ',0', ',Bronquite', ',0', '0', 'Amoxilina', NULL, '0', '2018-07-01 03:37:49'),
(3, 4, 'O-', ',0', ',Sinusite', ',Sarampo', '0', '0', NULL, '0', '2018-07-01 03:44:36'),
(4, 5, 'AB+', ',Auditiva', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 03:57:01'),
(5, 6, 'A+', ',0', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 13:28:36'),
(6, 7, 'B+', ',Sindrome de Down', ',Dispnéia (falta de ar)', ',0', '0', 'Dipirona', NULL, '0', '2018-07-01 13:38:59'),
(7, 8, 'B+', ',0', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 13:49:41'),
(8, 9, 'AB-', ',0', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 13:58:55'),
(9, 10, 'B-', ',0', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 14:12:12'),
(10, 11, 'B+', ',0', ',0', ',0', '0', 'Miojo', NULL, '0', '2018-07-01 14:20:30'),
(11, 12, 'A-', ',0', ',Bronquite', ',Catapora', '0', '0', NULL, '0', '2018-07-01 14:26:06'),
(12, 13, 'O+', ',0', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 14:37:38'),
(13, 14, 'AB-', ',0', ',0', ',0', '0', '0', NULL, '0', '2018-07-01 14:56:28'),
(14, 15, 'B+', ',0', ',0', ',Caxumba', '0', '0', NULL, '0', '2018-07-01 15:03:27'),
(15, 16, 'AB+', ',0', ',0', ',0', '0', 'Camarão', NULL, '0', '2018-07-01 15:18:19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbresponsavel`
--

CREATE TABLE `tbresponsavel` (
  `codResponsavel` int(11) NOT NULL,
  `nomeResponsavel` varchar(100) NOT NULL,
  `cpfResponsavel` varchar(14) NOT NULL,
  `nacionalidadeResponsavel` varchar(80) NOT NULL,
  `rgResponsavel` varchar(13) NOT NULL,
  `dataNascResponsavel` date NOT NULL,
  `sexoResponsavel` varchar(9) NOT NULL,
  `profissaoResponsavel` varchar(50) DEFAULT NULL,
  `enderecoTrabalho` varchar(150) DEFAULT NULL,
  `telefoneResidencialResponsavel` varchar(15) DEFAULT NULL,
  `telefoneCelularResponsavel` varchar(15) DEFAULT NULL,
  `telefoneTrabalhoResponsavel` varchar(15) DEFAULT NULL,
  `grauParentescoResponsavel` varchar(30) NOT NULL,
  `emailResponsavel` varchar(80) DEFAULT NULL,
  `fotoResponsavel` varchar(100) DEFAULT NULL,
  `codUsuario` int(11) NOT NULL,
  `dataCadastroResponsavel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbresponsavel`
--

INSERT INTO `tbresponsavel` (`codResponsavel`, `nomeResponsavel`, `cpfResponsavel`, `nacionalidadeResponsavel`, `rgResponsavel`, `dataNascResponsavel`, `sexoResponsavel`, `profissaoResponsavel`, `enderecoTrabalho`, `telefoneResidencialResponsavel`, `telefoneCelularResponsavel`, `telefoneTrabalhoResponsavel`, `grauParentescoResponsavel`, `emailResponsavel`, `fotoResponsavel`, `codUsuario`, `dataCadastroResponsavel`) VALUES
(2, 'Dário Brasa Pereira', '894.392.840-80', 'brasileiro', '39.299.459-0', '1989-08-09', 'Masculino', 'pedreiro', 'Cristiano Lobe, 144', '(11) 6544-4333', '(11) 83737-3733', '(11) 5555-5556', 'pai', 'dario.p@gmail.com', 'e92a2ef33d6b9d4c83d0ec215c327ab0.jpg', 5, '2018-07-01 03:27:33'),
(3, 'Marta Silva Santos', '744.726.800-33', 'brasileira', '98.322.484-9', '1998-01-25', 'Feminino', 'Empresária', 'rua:Edson danilo dotto, 45', '(11) 3837-3636', '(11) 73553-4433', '(11) 3837-7363', 'Mãe', 'Marta.Silva@gmail.com', 'fotoPadrao', 6, '2018-07-01 03:43:31'),
(4, 'Jussara Vincent', '639.719.640-28', 'brasileira', '84.494.497-09', '1990-03-07', 'Feminino', 'Enfermeira', 'rua:Olimpia montane, 109', '(11) 7364-5455', '(11) 73645-4533', '(11) 8766-6555', 'Mãe', 'JuCent@gmail.com', 'fotoPadrao', 7, '2018-07-01 03:55:16'),
(5, 'Sandra Mosquino Pereira', '875.740.730-40', 'brasileiro', '98.876.986-7', '1998-02-02', 'Feminino', 'Médica', 'rua Geovanne Morg, 45', '(11) 7454-5544', '(11) 47464-6464', '(11) 6335-3553', 'Tia', 'Sandrinha23@gmail.com', 'fotoPadrao', 8, '2018-07-01 13:27:30'),
(6, 'Rodrigo Ilsen Shultz', '698.486.520-43', 'brasileiro', '47.575.593-x', '1987-07-05', 'Masculino', 'Carpinteiro', 'Rua Guaratingueta, 13', '(11) 7353-5533', '(11) 74464-6646', '(11) 7363-6636', 'pai', 'RoShultz2@gmail.com', 'fotoPadrao', 9, '2018-07-01 13:36:12'),
(7, 'Giovana Moreira Morim', '258.063.240-95', 'brasileira', '74.576.374-x', '1995-10-08', 'Feminino', 'Bombeira', 'Rua Fernando Silva, 232', '(11) 3733-6633', '(11) 73636-3636', '(11) 7363-3355', 'Mãe', 'GiovanaMoreira4@gmail.com', 'fotoPadrao', 10, '2018-07-01 13:48:45'),
(8, 'Mauro Rodrigues Lins', '212.110.120-93', 'brasileiro', '26.375.486-9', '1998-05-09', 'Masculino', 'Contador', 'Rua Cachoeira Morena, 01', '(11) 8377-3737', '(11) 73636-3663', '(11) 8272-7272', 'pai', 'mauro142@gmail.com', 'fotoPadrao', 11, '2018-07-01 13:58:06'),
(9, 'João Silva Oliveira', '679.966.700-05', 'brasileiro', '27.365.387-5', '1990-07-01', 'Masculino', 'Jornalista', 'rua Alvares de Azevedo', '(11) 7235-5333', '(11) 93737-3636', '(11) 7363-3535', 'pai', 'JoSilva@gmail.com', 'fotoPadrao', 12, '2018-07-01 14:11:25'),
(10, 'Julio Gurgel Sonza', '293.710.590-44', 'brasileiro', '09.365.947-6', '1987-12-02', 'Masculino', 'ator', 'rua Fernando Calabrez', '(11) 8373-6746', '(11) 47474-7464', '(11) 8236-3635', 'pai', 'Gurgel3214@hotmail.com', 'fotoPadrao', 13, '2018-07-01 14:51:47'),
(11, 'Paulo Kim Kataguri', '527.563.070-09', 'japones', '93.356.083-1', '1984-04-03', 'Masculino', 'Cozinheiro', 'rua pedreira do sul, 87', '(11) 7363-6363', '(11) 83636-3535', '(11) 7363-5353', 'pai', 'kimPaulo@gmail.com', 'fotoPadrao', 14, '2018-07-01 15:17:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrotina`
--

CREATE TABLE `tbrotina` (
  `codRotina` int(11) NOT NULL,
  `codAgenda` int(11) NOT NULL DEFAULT '0',
  `codTurma` int(11) NOT NULL DEFAULT '0',
  `horarioEnvioRotina` time NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `dataCadastroRotina` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefoneresponsavel`
--

CREATE TABLE `tbtelefoneresponsavel` (
  `codTelefoneResponsavel` int(11) NOT NULL,
  `numTelefoneResponsavel` varchar(15) NOT NULL,
  `codResponsavel` int(11) NOT NULL,
  `dataCadastroTelefoneResponsavel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtipousuario`
--

CREATE TABLE `tbtipousuario` (
  `codTipoUsuario` int(11) NOT NULL,
  `descTipoUsuario` varchar(25) NOT NULL,
  `dataCadastroTipoUsuario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtipousuario`
--

INSERT INTO `tbtipousuario` (`codTipoUsuario`, `descTipoUsuario`, `dataCadastroTipoUsuario`) VALUES
(1, 'Administrador', '2018-03-16 01:44:20'),
(6, 'Responsável', '2018-03-16 13:38:08'),
(12, 'Professor(a)', '2018-03-20 02:31:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbturma`
--

CREATE TABLE `tbturma` (
  `codTurma` int(11) NOT NULL,
  `nomeTurma` varchar(60) NOT NULL,
  `codGrauEscolar` int(11) NOT NULL,
  `dataCadastroTurma` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbturma`
--

INSERT INTO `tbturma` (`codTurma`, `nomeTurma`, `codGrauEscolar`, `dataCadastroTurma`) VALUES
(1, '1A', 2, '2018-07-01 02:17:52'),
(2, '2A', 3, '2018-07-01 02:18:11'),
(3, '3A', 4, '2018-07-01 02:18:25'),
(4, '1BC', 5, '2018-07-01 02:30:57'),
(5, '1MT', 6, '2018-07-01 02:31:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbusuario`
--

CREATE TABLE `tbusuario` (
  `codUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(70) NOT NULL,
  `loginUsuario` varchar(100) NOT NULL,
  `senhaUsuario` varchar(250) NOT NULL,
  `codTipoUsuario` int(11) NOT NULL,
  `dataCadastroUsuario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbusuario`
--

INSERT INTO `tbusuario` (`codUsuario`, `nomeUsuario`, `loginUsuario`, `senhaUsuario`, `codTipoUsuario`, `dataCadastroUsuario`) VALUES
(1, 'admin', '@root', 'YWRtaW4=', 1, '2018-06-30 20:52:16'),
(2, 'Aline Mendonça', 'Aline2t8', 'Nno4YjJHVUI=', 12, '2018-07-01 02:57:56'),
(3, 'Vanessa Ferraz', 'Vanessar6p', 'SkFIVWoyOVU=', 12, '2018-07-01 02:59:51'),
(5, 'Dário Brasa Pereira', 'D?b7XYt', 'SDhxQWQ4NjY=', 6, '2018-07-01 03:27:33'),
(6, 'Marta Silva Santos', 'MartaREzYp', 'dDhwMno4SjI=', 6, '2018-07-01 03:43:31'),
(7, 'Jussara Vincent', 'JussaraYT7q5', 'Nlg4WjJUVVc=', 6, '2018-07-01 03:55:16'),
(8, 'Sandra Mosquino Pereira', 'Sandra7t5XE', 'VTI2MlVtMlQ=', 6, '2018-07-01 13:27:30'),
(9, 'Rodrigo Ilsen Shultz', 'Rodrigo3LYXE', 'OFJBNDhtMkc=', 6, '2018-07-01 13:36:12'),
(10, 'Giovana Moreira Morim', 'Giovanav5tEm', 'NzJRODYyMjQ=', 6, '2018-07-01 13:48:45'),
(11, 'Mauro Rodrigues Lins', 'MauroYV7rY', 'Nm40TjZWODk=', 6, '2018-07-01 13:58:06'),
(12, 'João Silva Oliveira', 'Jo?qEX9W', 'djh0MlpVNDY=', 6, '2018-07-01 14:11:25'),
(13, 'Julio Gurgel Sonza', 'JulioR3HYJ', 'RDhWNlo0RzY=', 6, '2018-07-01 14:51:47'),
(14, 'Paulo Kim Kataguri', 'PauloR6S4b', 'cDdzOVMzTTU=', 6, '2018-07-01 15:17:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbagenda`
--
ALTER TABLE `tbagenda`
  ADD PRIMARY KEY (`codAgenda`),
  ADD KEY `codAluno` (`codAluno`);

--
-- Indexes for table `tbalternativa`
--
ALTER TABLE `tbalternativa`
  ADD PRIMARY KEY (`codAlternativa`);

--
-- Indexes for table `tbalternativacard`
--
ALTER TABLE `tbalternativacard`
  ADD PRIMARY KEY (`codAlternativaCard`),
  ADD KEY `codRotina` (`codRotina`);

--
-- Indexes for table `tbaluno`
--
ALTER TABLE `tbaluno`
  ADD PRIMARY KEY (`codAluno`),
  ADD KEY `codResponsavel` (`codResponsavel`);

--
-- Indexes for table `tbatividadeextracurricular`
--
ALTER TABLE `tbatividadeextracurricular`
  ADD PRIMARY KEY (`codAtividadeExtraCurricular`);

--
-- Indexes for table `tbcaracteristicaprontuario`
--
ALTER TABLE `tbcaracteristicaprontuario`
  ADD PRIMARY KEY (`codCaracteristicaProntuario`),
  ADD KEY `codCaracteristicaSaude` (`codCaracteristicaSaude`,`codProntuarioAluno`);

--
-- Indexes for table `tbcaracteristicasaude`
--
ALTER TABLE `tbcaracteristicasaude`
  ADD PRIMARY KEY (`codCaracteristicaSaude`);

--
-- Indexes for table `tbcard`
--
ALTER TABLE `tbcard`
  ADD PRIMARY KEY (`codCard`);

--
-- Indexes for table `tbcardrotina`
--
ALTER TABLE `tbcardrotina`
  ADD PRIMARY KEY (`codCardRotina`),
  ADD KEY `codCard` (`codCard`,`codRotina`);

--
-- Indexes for table `tbcargo`
--
ALTER TABLE `tbcargo`
  ADD PRIMARY KEY (`codCargo`);

--
-- Indexes for table `tbcomunicado`
--
ALTER TABLE `tbcomunicado`
  ADD PRIMARY KEY (`codComunicado`),
  ADD KEY `codUsuario` (`codUsuario`),
  ADD KEY `codTurma` (`codTurma`);

--
-- Indexes for table `tbcomunicadoagenda`
--
ALTER TABLE `tbcomunicadoagenda`
  ADD PRIMARY KEY (`codComunicadoAgenda`),
  ADD KEY `codAgenda` (`codAgenda`),
  ADD KEY `codComunicado` (`codComunicado`);

--
-- Indexes for table `tbcontatoemergenciaaluno`
--
ALTER TABLE `tbcontatoemergenciaaluno`
  ADD PRIMARY KEY (`codContatoEmergenciaAluno`),
  ADD KEY `codAluno` (`codAluno`);

--
-- Indexes for table `tbcronograma`
--
ALTER TABLE `tbcronograma`
  ADD PRIMARY KEY (`codCronograma`),
  ADD KEY `codTurma` (`codTurma`);

--
-- Indexes for table `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  ADD PRIMARY KEY (`codFuncionario`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indexes for table `tbfuncionariocargo`
--
ALTER TABLE `tbfuncionariocargo`
  ADD PRIMARY KEY (`codFuncionarioCargo`),
  ADD KEY `codFuncionario` (`codFuncionario`),
  ADD KEY `codCargo` (`codCargo`);

--
-- Indexes for table `tbgrauescolar`
--
ALTER TABLE `tbgrauescolar`
  ADD PRIMARY KEY (`codGrauEscolar`),
  ADD KEY `codPeriodo` (`codPeriodo`);

--
-- Indexes for table `tbhistoricochat`
--
ALTER TABLE `tbhistoricochat`
  ADD PRIMARY KEY (`codHistoricoChat`);

--
-- Indexes for table `tbitenscronograma`
--
ALTER TABLE `tbitenscronograma`
  ADD PRIMARY KEY (`codItensCronograma`);

--
-- Indexes for table `tbitensporcronograma`
--
ALTER TABLE `tbitensporcronograma`
  ADD PRIMARY KEY (`codItensPorCronograma`),
  ADD KEY `codCronograma` (`codCronograma`),
  ADD KEY `codItensCronograma` (`codItensCronograma`);

--
-- Indexes for table `tbmatricula`
--
ALTER TABLE `tbmatricula`
  ADD PRIMARY KEY (`codMatricula`),
  ADD KEY `codAluno` (`codAluno`),
  ADD KEY `codTurma` (`codTurma`);

--
-- Indexes for table `tbmatriculaatividadeextracurricular`
--
ALTER TABLE `tbmatriculaatividadeextracurricular`
  ADD PRIMARY KEY (`codMatriculaAtividadeExtraCurricular`),
  ADD KEY `codAtividadeExtraCurricular` (`codAtividadeExtraCurricular`),
  ADD KEY `codMatricula` (`codMatricula`);

--
-- Indexes for table `tbocorrencia`
--
ALTER TABLE `tbocorrencia`
  ADD PRIMARY KEY (`codOcorrencia`),
  ADD KEY `codAgenda` (`codAgenda`);

--
-- Indexes for table `tbocorrenciarotina`
--
ALTER TABLE `tbocorrenciarotina`
  ADD PRIMARY KEY (`codOcorrenciaRotina`);

--
-- Indexes for table `tbperiodo`
--
ALTER TABLE `tbperiodo`
  ADD PRIMARY KEY (`codPeriodo`);

--
-- Indexes for table `tbprofessorturma`
--
ALTER TABLE `tbprofessorturma`
  ADD PRIMARY KEY (`codProfessorTurma`),
  ADD KEY `codTurma` (`codTurma`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indexes for table `tbprontuarioaluno`
--
ALTER TABLE `tbprontuarioaluno`
  ADD PRIMARY KEY (`codProntuarioAluno`),
  ADD KEY `codAluno` (`codAluno`);

--
-- Indexes for table `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  ADD PRIMARY KEY (`codResponsavel`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indexes for table `tbrotina`
--
ALTER TABLE `tbrotina`
  ADD PRIMARY KEY (`codRotina`),
  ADD KEY `codGrauEscolar` (`codTurma`) USING BTREE,
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Indexes for table `tbtelefoneresponsavel`
--
ALTER TABLE `tbtelefoneresponsavel`
  ADD PRIMARY KEY (`codTelefoneResponsavel`),
  ADD KEY `codResponsavel` (`codResponsavel`);

--
-- Indexes for table `tbtipousuario`
--
ALTER TABLE `tbtipousuario`
  ADD PRIMARY KEY (`codTipoUsuario`);

--
-- Indexes for table `tbturma`
--
ALTER TABLE `tbturma`
  ADD PRIMARY KEY (`codTurma`),
  ADD KEY `codGrauEscolar` (`codGrauEscolar`);

--
-- Indexes for table `tbusuario`
--
ALTER TABLE `tbusuario`
  ADD PRIMARY KEY (`codUsuario`),
  ADD KEY `codTipoUsuario` (`codTipoUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbagenda`
--
ALTER TABLE `tbagenda`
  MODIFY `codAgenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbalternativa`
--
ALTER TABLE `tbalternativa`
  MODIFY `codAlternativa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbalternativacard`
--
ALTER TABLE `tbalternativacard`
  MODIFY `codAlternativaCard` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbaluno`
--
ALTER TABLE `tbaluno`
  MODIFY `codAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbatividadeextracurricular`
--
ALTER TABLE `tbatividadeextracurricular`
  MODIFY `codAtividadeExtraCurricular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbcaracteristicaprontuario`
--
ALTER TABLE `tbcaracteristicaprontuario`
  MODIFY `codCaracteristicaProntuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbcaracteristicasaude`
--
ALTER TABLE `tbcaracteristicasaude`
  MODIFY `codCaracteristicaSaude` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbcard`
--
ALTER TABLE `tbcard`
  MODIFY `codCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbcardrotina`
--
ALTER TABLE `tbcardrotina`
  MODIFY `codCardRotina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbcargo`
--
ALTER TABLE `tbcargo`
  MODIFY `codCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbcomunicado`
--
ALTER TABLE `tbcomunicado`
  MODIFY `codComunicado` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbcomunicadoagenda`
--
ALTER TABLE `tbcomunicadoagenda`
  MODIFY `codComunicadoAgenda` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbcontatoemergenciaaluno`
--
ALTER TABLE `tbcontatoemergenciaaluno`
  MODIFY `codContatoEmergenciaAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbcronograma`
--
ALTER TABLE `tbcronograma`
  MODIFY `codCronograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  MODIFY `codFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbfuncionariocargo`
--
ALTER TABLE `tbfuncionariocargo`
  MODIFY `codFuncionarioCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbgrauescolar`
--
ALTER TABLE `tbgrauescolar`
  MODIFY `codGrauEscolar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbhistoricochat`
--
ALTER TABLE `tbhistoricochat`
  MODIFY `codHistoricoChat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbitenscronograma`
--
ALTER TABLE `tbitenscronograma`
  MODIFY `codItensCronograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbitensporcronograma`
--
ALTER TABLE `tbitensporcronograma`
  MODIFY `codItensPorCronograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbmatricula`
--
ALTER TABLE `tbmatricula`
  MODIFY `codMatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbmatriculaatividadeextracurricular`
--
ALTER TABLE `tbmatriculaatividadeextracurricular`
  MODIFY `codMatriculaAtividadeExtraCurricular` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbocorrencia`
--
ALTER TABLE `tbocorrencia`
  MODIFY `codOcorrencia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbocorrenciarotina`
--
ALTER TABLE `tbocorrenciarotina`
  MODIFY `codOcorrenciaRotina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbperiodo`
--
ALTER TABLE `tbperiodo`
  MODIFY `codPeriodo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbprofessorturma`
--
ALTER TABLE `tbprofessorturma`
  MODIFY `codProfessorTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbprontuarioaluno`
--
ALTER TABLE `tbprontuarioaluno`
  MODIFY `codProntuarioAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  MODIFY `codResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbrotina`
--
ALTER TABLE `tbrotina`
  MODIFY `codRotina` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbtelefoneresponsavel`
--
ALTER TABLE `tbtelefoneresponsavel`
  MODIFY `codTelefoneResponsavel` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbtipousuario`
--
ALTER TABLE `tbtipousuario`
  MODIFY `codTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbturma`
--
ALTER TABLE `tbturma`
  MODIFY `codTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbusuario`
--
ALTER TABLE `tbusuario`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
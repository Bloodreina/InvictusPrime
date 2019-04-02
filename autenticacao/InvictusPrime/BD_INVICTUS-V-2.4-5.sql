-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Dez-2018 às 20:11
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_invictus`
--
DROP DATABASE IF EXISTS `bd_invictus`;
CREATE DATABASE IF NOT EXISTS `bd_invictus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_invictus`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_ALTERNATIVA` (`pCodAlternativa` INT)  BEGIN

	DELETE FROM alternativa where COD_ALTERNATIVA = pCodAlternativa;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_PERGUNTA` (IN `pCodPergunta` INT)  NO SQL
    COMMENT 'Dt:30/09/2018 Atr:Larissa Ribeiro Obj:deleta pergunta-alternava'
BEGIN

	DELETE FROM alternativa WHERE COD_PERGUNTA = pCodPergunta;

	DELETE FROM pergunta WHERE COD_PERGUNTA = pCodPergunta;
    
   
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_QUIZ` (IN `pCodQuiz` INT)  BEGIN

	DELETE FROM quiz WHERE COD_QUIZ = pCodQuiz;
    DELETE FROM autor_quiz WHERE COD_QUIZ = pCodQuiz;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_ALTERNATIVA` (IN `pCodPergunta` INT, IN `pEnunciado` VARCHAR(500))  BEGIN 

	INSERT INTO alternativa(COD_PERGUNTA, ENUNCIADO) 
    VALUES (pCodPergunta, pEnunciado); 

	SELECT LAST_INSERT_ID(); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_ALTERNATIVA_CORRETA` (IN `pCodPergunta` INT, IN `pEnunciado` VARCHAR(500))  BEGIN 

	INSERT INTO alternativa(COD_PERGUNTA, ENUNCIADO) 
    VALUES (pCodPergunta, pEnunciado); 

	SELECT LAST_INSERT_ID(); 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_ALTERNATIVA_INCORRETA` (`pCodPergunta` INT, `pAlternativa1` VARCHAR(500), `pAlternativa2` VARCHAR(500), `pAlternativa3` VARCHAR(500))  BEGIN

	INSERT INTO alternativa(COD_PERGUNTA, ENUNCIADO)
    VALUES
    (pCodPergunta, pAlternativa1),
    (pCodPergunta, pAlternativa2),
    (pCodPergunta, pAlternativa3);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_AREAATUACAO_TEMA` (IN `pCodArea` INT, IN `pCodTema` INT)  BEGIN 

	INSERT INTO areaatuacao_tema(COD_AREA, COD_TEMA)
    VALUES
    (pCodArea, pCodTema);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_AREAATUACAO_USUARIO` (IN `pCodUsuario` INT, IN `pCodArea` INT)  BEGIN 

	INSERT INTO areaatuacao_usuario(COD_USUARIO, COD_AREA)
    VALUES
    (pCodUsuario, pCodArea);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_AREA_ATUACAO` (IN `pCodArea` INT, IN `pNomeArea` VARCHAR(50), IN `pDescricao` VARCHAR(300))  BEGIN 

	INSERT INTO area_atuacao(COD_AREA, NOME_AREA, DESCRICAO) 
    VALUES (pCodArea, pNomeArea, pDescricao); 

	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_COMENTARIO` (IN `pCodUsuario` INT, IN `pComentario` VARCHAR(200))  BEGIN
	
    INSERT INTO comentario(COD_USUARIO, COMENTARIO)
    VALUES
    (pCodUsuario, pComentario);
  
  	SELECT * FROM comentario WHERE COD_COMENTARIO = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_DUVIDA` (IN `pCodTema` INT, IN `pCodUsuario` INT, IN `pDuvida` VARCHAR(5000), IN `pTituloDuvida` VARCHAR(200))  BEGIN

	INSERT INTO duvida (COD_TEMA, COD_USUARIO,TITULO_DUVIDA, DUVIDA)
    VALUES
    (pCodTema, pCodUsuario, pTituloDuvida, pDuvida);
    
    SELECT * FROM duvida WHERE COD_DUVIDA = LAST_INSERT_ID(); 
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_DUVIDA_COMENTARIO` (IN `pCodDuvida` INT, IN `pCodComentario` INT)  BEGIN

	INSERT INTO duvida_comentario(COD_DUVIDA, COD_COMENTARIO)
    VALUES 
    (pCodDuvida, pCodComentario);
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_PERGUNTA` (IN `pEnunciado` VARCHAR(500))  BEGIN

	INSERT INTO pergunta (ENUNCIADO)
    VALUES
    (pEnunciado);
    
    SELECT LAST_INSERT_ID(); 
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_PONTUACAO` (IN `pCodUsuario` INT, IN `pCodQuiz` INT, IN `pRespostasCorretas` INT, IN `pRespostasIncorretas` INT, IN `pPontuacao` INT)  SQL SECURITY INVOKER
    COMMENT 'Data:26/09/2018 Autor:Larissa Ribeiro Obj: Procedure de inserção'
BEGIN

	INSERT INTO pontuacao(COD_USUARIO, COD_QUIZ, QNT_RCORRETA, QNT_RINCORRETA, PONTUACAO)
    VALUES
    (pCodUsuario, pCodQuiz, pRespostasCorretas, pRespostasIncorretas, pPontuacao);
    
    SELECT LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_PONTUACAO_GERALF` (`pCodUsuario` INT, `pPontuacaoGeral` INT)  BEGIN

	INSERT INTO pontuacao_geralf (COD_USUARIO, PONTUACAO_GERALF)
    VALUES
    (pCodUsuario, pPontuacaoGeral);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_PONTUACAO_GERALI` (`pCodUsuario` INT, `pPontuacaoGeral` INT)  BEGIN

	INSERT INTO pontuacao_gerali (COD_USUARIO, PONTUACAO_GERALI)
    VALUES
    (pCodUsuario, pPontuacaoGeral);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_PONTUACAO_GERALM` (`pCodUsuario` INT, `pPontuacaoGeral` INT)  BEGIN

	INSERT INTO pontuacao_geralm (COD_USUARIO, PONTUACAO_GERALM)
    VALUES
    (pCodUsuario, pPontuacaoGeral);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_QUIZ` (IN `pNomeQuiz` VARCHAR(50), IN `pDescricao` VARCHAR(200), IN `pQntPergunta` SMALLINT, IN `pDificuldade` VARCHAR(1), IN `pCodUsuario` INT)  BEGIN 

	INSERT INTO quiz(NOME_QUIZ, DESCRICAO , QNT_PERGUNTA, DIFICULDADE)
    VALUES
    (pNomeQuiz, pDescricao, pQntPergunta, pDificuldade);
    
    SELECT LAST_INSERT_ID();
    
   	INSERT INTO autor_quiz(COD_USUARIO, COD_QUIZ)
    VALUES
    (pCodUsuario, LAST_INSERT_ID());
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_QUIZ_PERGUNTA` (IN `pCodQuiz` INT, IN `pCodPergunta` INT)  BEGIN 

	INSERT INTO quiz_pergunta(COD_QUIZ, COD_PERGUNTA)
    VALUES
    (pCodQuiz, pCodPergunta);
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_QUIZ_TEMA` (IN `pCodQuiz` INT, IN `pCodTema` INT)  BEGIN 

	INSERT INTO quiz_tema(COD_QUIZ, COD_TEMA)
    VALUES
    (pCodQuiz, pCodTema);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_RANKING_FACIL` (IN `CodPontuacao` INT)  BEGIN

	INSERT INTO ranking_facil(COD_RANKF, COD_PONTUACAO)
    VALUES
    (CodPontuacao);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_RANKING_INSANO` (IN `pCodPontuacao` INT)  BEGIN 

	INSERT INTO ranking_insano(COD_RANKI, COD_PONTUACAO)
    VALUES
    (pCodPontuacao);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_RANKING_MEDIO` (IN `pCodPontuacao` INT)  BEGIN

	INSERT INTO ranking_medio(COD_RANKM, COD_PONTUACAO)
    VALUES
    (pCodPontuacao);
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_REGISTRA_USUARIO` (IN `pNickName` VARCHAR(50), IN `pEmail` VARCHAR(50), IN `pSenha` VARCHAR(256))  BEGIN 

	INSERT INTO usuario (NICKNAME, EMAIL_USUARIO, SENHA_USUARIO) 
    VALUES 
    (pNickName, pEmail, pSenha); 

	SELECT * FROM usuario WHERE COD_USUARIO = LAST_INSERT_ID();
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_RESPOSTA_CORRETA` (IN `pCodPergunta` INT, IN `pCodAlternativa` INT)  BEGIN

	INSERT INTO resposta_correta(COD_PERGUNTA, COD_ALTERNATIVA)
    VALUES 
    (pCodPergunta, pCodAlternativa);
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_TEMA` (IN `pNomeTema` VARCHAR(50), IN `pDescricao` VARCHAR(200))  BEGIN 

	INSERT INTO tema(NOME_TEMA, DESCRICAO)
    VALUES
    (pNomeTema, pDescricao);
    
    SELECT * FROM tema WHERE COD_TEMA = LAST_INSERT_ID();
   
END$$

CREATE DEFINER=```root```@`localhost` PROCEDURE `SP_UP_AJUDOU_COMENTARIO` (IN `pCod` INT, IN `pAjudou` INT)  BEGIN 

	UPDATE comentario 
    SET AJUDOU = pAjudou
    WHERE COD_COMENTARIO = pCod;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_ALTERNATIVA` (IN `pCodAlternativa` INT, IN `pEnunciado` VARCHAR(500))  NO SQL
    COMMENT ' Dt: 27/09/2018 Atr:Larissa Ribeiro Obj: Alteração de dados'
BEGIN 

	UPDATE 	alternativa
       SET  ENUNCIADO 	 	= pEnunciado
   
     WHERE COD_ALTERNATIVA = pCodAlternativa;
   
END$$

CREATE DEFINER=```root```@`localhost` PROCEDURE `SP_UP_COMENTARIO` (IN `pCod` INT, IN `pCodUsuario` INT, IN `pCometario` VARCHAR(5000))  BEGIN 

	UPDATE COMENTARIO 
    SET	pCodUsuario = COD_USUARIO,
        pComentario = COD_COMENTARIO
     WHERE pCod = COD_COMENTARIO;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_DUVIDA` (IN `pCod` INT, IN `pCodTema` INT, IN `pCodUsuario` INT, IN `pTitulo` VARCHAR(100), IN `pDuvida` VARCHAR(5000), IN `pQntCometario` INT, IN `pSattus` INT)  BEGIN 

	UPDATE duvida 
    SET 
    	pCodTema = COD_TEMA,
        pCodUsuario = COD_DUVIDA,
        pTitulo = TITULO_DUVIDA,
        pduvida = duvida,
        pQntCometario = QNT_COMENTARIO,
        pSattus = STATUS
        WHERE pCod = COD_DUVIDA;
     END$$

CREATE DEFINER=```root```@`localhost` PROCEDURE `SP_UP_N_AJUDOU_COMENTARIO` (IN `pCod` INT, IN `pNAjudou` INT)  BEGIN 

	UPDATE comentario
    SET N_AJUDOU = pNAjudou
    WHERE COD_COMENTARIO = pCod;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_PERGUNTA` (IN `pCod` INT, IN `pEnunciado` VARCHAR(500), IN `pValorPergunta` FLOAT)  BEGIN 

	UPDATE pergunta
       SET  ENUNCIADO 	 	= pEnunciado
       	   ,VALOR_PERGUNTA 	= pValorPergunta
       
     WHERE COD_PERGUNTA = pCod;
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_PONTUACAO` (IN `pRespostasCorretas` INT, IN `pRespostasIncorretas` INT, IN `pPontuacao` INT, IN `pCodQuiz` INT, IN `pCodUsuario` INT)  BEGIN

	UPDATE pontuacao SET
    QNT_RCORRETA = pRespostasCorretas,
    QNT_RINCORRETA = pRespostasIncorretas,
    PONTUACAO = pPontuacao
    WHERE COD_QUIZ = pCodQuiz AND COD_USUARIO = pCodUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_PONTUACAO_GERALF` (`pPontuacao` INT, `pCodUsuario` INT)  BEGIN

	UPDATE pontuacao_geralf 
    SET
    PONTUACAO_GERALF = pPontuacao
    WHERE
    COD_USUARIO = pCodUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_PONTUACAO_GERALI` (`pPontuacao` INT, `pCodUsuario` INT)  BEGIN

	UPDATE pontuacao_gerali
    SET
    PONTUACAO_GERALI = pPontuacao
    WHERE
    COD_USUARIO = pCodUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_PONTUACAO_GERALM` (`pPontuacao` INT, `pCodUsuario` INT)  BEGIN

	UPDATE pontuacao_geralm
    SET
    PONTUACAO_GERALM = pPontuacao
    WHERE
    COD_USUARIO = pCodUsuario;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_QUIZ` (IN `pCodQuiz` INT, IN `pNome` VARCHAR(50), IN `pDescricao` VARCHAR(200), IN `pQtdPergunta` SMALLINT, IN `pDificuldade` VARCHAR(3))  BEGIN 

	UPDATE quiz
       SET NOME_QUIZ 	= pNome
		  ,DESCRICAO 	= pDescricao
          ,QNT_PERGUNTA = pQtdPergunta
          ,DIFICULDADE 	= pDificuldade
          
     WHERE COD_QUIZ = pCodQuiz;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_QUIZ_ACESSOS` (`pCodQuiz` INT, `pAcesso` INT)  BEGIN
	UPDATE quiz SET ACESSOS = pAcesso WHERE COD_QUIZ = pCodQuiz;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_RESPOSTA_CORRETA` (IN `pCodAlternativa` INT, IN `pCodPergunta` INT)  BEGIN 

	UPDATE resposta_correta
       SET COD_ALTERNATIVA = pCodAlternativa

     WHERE COD_PERGUNTA = pCodPergunta;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_SENHA_USUARIO` (IN `pCod` INT, IN `pSenha` VARCHAR(100))  BEGIN 

	UPDATE usuario
       SET SENHA_USUARIO = pSenha
     WHERE COD_USUARIO = pCod;
   
END$$

CREATE DEFINER=`root`@`localhosr` PROCEDURE `SP_UP_STATUS_DUVIDA` (IN `pCod` INT, IN `pStatus` INT)  BEGIN

	UPDATE duvida
    	SET STATUS = pStatus
    where COD_DUVIDA = pCod;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_USUARIO` (IN `pCod` INT, IN `pNick` VARCHAR(50), IN `pEmail` VARCHAR(50), IN `pSenha` VARCHAR(256))  BEGIN 

	UPDATE usuario
       SET NICKNAME 	 	= pNick
       	   ,EMAIL_USUARIO 	= pEmail
           ,SENHA_USUARIO	= pSenha
     WHERE COD_USUARIO = pCod;
   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UP_USUARIO_ADMIN` (IN `pCod` INT, IN `pNick` VARCHAR(50), IN `pEmail` VARCHAR(50), IN `pAutenticacao` VARCHAR(3), IN `pUsuarioAdm` INT)  BEGIN 

	UPDATE usuario
       SET NICKNAME 	 	= pNick
       	   ,EMAIL_USUARIO 	= pEmail
           ,AUTENTICACAO 	= pAutenticacao
           ,USUARIO_ADMIN 	= pUsuarioAdm
     WHERE COD_USUARIO = pCod;
   
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativa`
--

CREATE TABLE `alternativa` (
  `COD_ALTERNATIVA` int(11) NOT NULL,
  `COD_PERGUNTA` int(11) NOT NULL,
  `ENUNCIADO` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alternativa`
--

INSERT INTO `alternativa` (`COD_ALTERNATIVA`, `COD_PERGUNTA`, `ENUNCIADO`) VALUES
(16, 1, 'a11'),
(17, 1, 'a12'),
(18, 1, 'a13'),
(19, 1, 'a14'),
(20, 2, 'a21'),
(21, 2, 'a22'),
(22, 2, 'a23'),
(23, 2, 'a24'),
(24, 3, 'a31'),
(25, 3, 'a32'),
(26, 3, 'a33'),
(27, 3, 'a34'),
(28, 4, 'a41'),
(29, 4, 'a42'),
(30, 4, 'a43'),
(31, 4, 'a44'),
(32, 5, 'a51'),
(33, 5, 'a52'),
(34, 5, 'a53'),
(35, 5, 'a54'),
(36, 6, 'a61'),
(37, 6, 'a62'),
(38, 6, 'a63'),
(39, 6, 'a64'),
(40, 7, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste&quot;&lt;/a&gt;<br>'),
(41, 7, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 2&quot;&lt;/a&gt;<br>'),
(42, 7, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 3&quot;&lt;/a&gt;<br>'),
(43, 7, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 3&quot;&lt;/a&gt;<br>'),
(44, 8, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 12&quot;&lt;/a&gt;<br>'),
(45, 8, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 12&quot;&lt;/a&gt;<br>'),
(46, 8, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 13&quot;&lt;/a&gt;<br>'),
(47, 8, '&lt;a href=\'lololol\'&gt;&quot;Testando o teste 13&quot;&lt;/a&gt;<br>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `areaatuacao_tema`
--

CREATE TABLE `areaatuacao_tema` (
  `COD_AREA` int(11) DEFAULT NULL,
  `COD_TEMA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `areaatuacao_tema`
--

INSERT INTO `areaatuacao_tema` (`COD_AREA`, `COD_TEMA`) VALUES
(2, 1),
(2, 2),
(2, 4),
(4, 7),
(6, 5),
(6, 6),
(8, 1),
(8, 3),
(8, 4),
(9, 1),
(9, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `areaatuacao_usuario`
--

CREATE TABLE `areaatuacao_usuario` (
  `COD_USUARIO` int(11) NOT NULL,
  `COD_AREA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `areaatuacao_usuario`
--

INSERT INTO `areaatuacao_usuario` (`COD_USUARIO`, `COD_AREA`) VALUES
(1, 2),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `area_atuacao`
--

CREATE TABLE `area_atuacao` (
  `COD_AREA` int(11) NOT NULL,
  `NOME_AREA` varchar(50) NOT NULL,
  `DESCRICAO` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `area_atuacao`
--

INSERT INTO `area_atuacao` (`COD_AREA`, `NOME_AREA`, `DESCRICAO`) VALUES
(1, 'Não trabalho em nenhuma área de TI', 'Para quem não atua em nenhuma área de TI.'),
(2, 'Administrador de Banco de Dados', 'O Administrador de banco de dados (DBA - DataBase Administrator) é responsável por manter e gerenciar bancos de dados, ou sistema de banco de dados. Este profissional gerencia, atualiza, monitora o centro das informações de um sistema.'),
(3, 'Analista de redes', 'O analista de redes ou administrador de redes tem a incumbência de gerenciar o rede local, bem como recursos computacionais diretamente relacionados à rede.'),
(4, 'Analista de segurança', 'Responsável pela segurança da rede (equipamento, sistemas operacionais de servidores e clientes e programas utilizados). Também monitora tentativas de invasão e uso indevido dos recursos da rede, além de definir e manter as regras de uso dos recursos computacionais da empresa.'),
(5, 'Analista de sistemas', 'O analista de sistemas ou atualmente mais conhecido como sistematizador de informações, é aquele que tem como finalidade realizar estudos de processos computacionais para encontrar o melhor e mais racional caminho para que a informação virtual possa ser processada. '),
(6, 'Analista de suporte', 'O analista de suporte é um profissional de TI especialista em tecnologias, constantemente atualizado com novidades mercadológicas de Hardware e Software. Cuida da manutenção da estrutura física de computadores, da estrutura de Rede de área local de computadores e de sistemas operacionais. '),
(7, 'Designer', 'O designer gráfico é o profissional habilitado a efetuar atividades relacionadas ao design gráfico. Logo, é aquele profissional que traz ordem estrutural e forma à informação visual impressa. '),
(8, 'Programador Web', 'Um profissional de programação web é responsável pelo desenvolvimento de sites, portais, fóruns e aplicações voltadas para o ambiente da internet. Normalmente estes serviços podem ser acessados por meio de um navegador e ficam hospedados em servidores web.'),
(9, 'Programador Desktop', 'Um programador pode ser alguém que desenvolve ou faz manutenção de software em um grande sistema mainframe ou alguém que desenvolve software primariamente para uso em computadores pessoais.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor_quiz`
--

CREATE TABLE `autor_quiz` (
  `COD_USUARIO` int(11) NOT NULL,
  `COD_QUIZ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `autor_quiz`
--

INSERT INTO `autor_quiz` (`COD_USUARIO`, `COD_QUIZ`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `COD_COMENTARIO` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL,
  `COMENTARIO` varchar(5000) NOT NULL,
  `AJUDOU` int(11) NOT NULL DEFAULT '0',
  `N_AJUDOU` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`COD_COMENTARIO`, `COD_USUARIO`, `COMENTARIO`, `AJUDOU`, `N_AJUDOU`) VALUES
(1, 1, 'function getDataMinima(){\r\n    var dataMinima = new Date();\r\n    dataMinima.setFullYear(dataMinima.getFullYear()-130);\r\n    console.log(\"entrou na função minima, data calculada:\"+dataMinima.toISOString().split(\'T\')[0]);\r\n    \r\n    var dataMaxima = new Date();\r\n    dataMaxima.setFullYear(dataMaxima.getFullYear()-5);\r\n    console.log(\"Entrou na funcao maxima, data calculada:\"+dataMaxima.toISOString().split(\'T\')[0]);\r\n    \r\n    $(\"#campodata\").attr({\r\n         \"min\" : dataMinima.toISOString().split(\'T\')[0]\r\n    });\r\n}', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvida`
--

CREATE TABLE `duvida` (
  `COD_DUVIDA` int(11) NOT NULL,
  `COD_TEMA` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL,
  `TITULO_DUVIDA` varchar(100) NOT NULL,
  `DUVIDA` varchar(5000) NOT NULL,
  `DT_CRIACAO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `QNT_COMENTARIO` int(11) NOT NULL DEFAULT '0',
  `STATUS` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `duvida`
--

INSERT INTO `duvida` (`COD_DUVIDA`, `COD_TEMA`, `COD_USUARIO`, `TITULO_DUVIDA`, `DUVIDA`, `DT_CRIACAO`, `QNT_COMENTARIO`, `STATUS`) VALUES
(1, 1, 2, 'Duvida de teste 1', 'function getDataMinima(){\r\n        var dataMinima = new Date();\r\n        dataMinima.setFullYear(dataMinima.getFullYear()-130);\r\n        var dataForm = dataMinima.getFullYear() + \'-\' + dataMinima.getMonth() + \'-\' + dataMinima.getDate();\r\n        console.log(\"entrou na função minima, data calculada:\"+dataForm);\r\n\r\n        var dataMaxima = new Date();\r\n        dataMaxima.setFullYear(dataMaxima.getFullYear()-5);\r\n        var dataMaximaForm = dataMaxima.getFullYear() + \'-\' + dataMaxima.getMonth() + \'-\' +dataMaxima.getDate();\r\n        console.log(\"Entrou na funcao maxima, data calculada:\"+dataMaximaForm);\r\n\r\n        $(\"#campodata\").attr({\r\n             \"min\" : dataForm\r\n        });\r\n    }', '2018-12-03 17:31:11', 0, 0),
(2, 2, 2, 'Duvida de teste 2', 'function getDataMinima(){\r\n    var dataMinima = new Date();\r\n    dataMinima.setFullYear(dataMinima.getFullYear()-130);\r\n    console.log(\"entrou na função minima, data calculada:\"+dataMinima.toISOString().split(\'T\')[0]);\r\n    \r\n    var dataMaxima = new Date();\r\n    dataMaxima.setFullYear(dataMaxima.getFullYear()-5);\r\n    console.log(\"Entrou na funcao maxima, data calculada:\"+dataMaxima.toISOString().split(\'T\')[0]);\r\n    \r\n    $(\"#campodata\").attr({\r\n         \"min\" : dataMinima.toISOString().split(\'T\')[0]\r\n    });\r\n}', '2018-12-03 17:40:27', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvida_comentario`
--

CREATE TABLE `duvida_comentario` (
  `COD_DUVIDA` int(11) NOT NULL,
  `COD_COMENTARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `duvida_comentario`
--

INSERT INTO `duvida_comentario` (`COD_DUVIDA`, `COD_COMENTARIO`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE `pergunta` (
  `COD_PERGUNTA` int(11) NOT NULL,
  `ENUNCIADO` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pergunta`
--

INSERT INTO `pergunta` (`COD_PERGUNTA`, `ENUNCIADO`) VALUES
(1, 'p1'),
(2, 'p2'),
(3, 'p3'),
(4, 'p4'),
(5, 'p5'),
(6, 'p6'),
(7, 'Pergunta 1<br>'),
(8, 'Pergunta 2<br>');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontuacao`
--

CREATE TABLE `pontuacao` (
  `COD_PONTUACAO` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL,
  `COD_QUIZ` int(11) NOT NULL,
  `QNT_RCORRETA` int(11) NOT NULL,
  `QNT_RINCORRETA` int(11) NOT NULL,
  `PONTUACAO` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `pontuacao`
--

INSERT INTO `pontuacao` (`COD_PONTUACAO`, `COD_USUARIO`, `COD_QUIZ`, `QNT_RCORRETA`, `QNT_RINCORRETA`, `PONTUACAO`) VALUES
(1, 1, 1, 6, 0, 100),
(2, 2, 1, 4, 2, 67),
(4, 1, 2, 2, 0, 100),
(5, 3, 1, 6, 0, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontuacao_geralf`
--

CREATE TABLE `pontuacao_geralf` (
  `COD_PGERALF` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL,
  `PONTUACAO_GERALF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontuacao_gerali`
--

CREATE TABLE `pontuacao_gerali` (
  `COD_PGERALI` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL,
  `PONTUACAO_GERALI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontuacao_geralm`
--

CREATE TABLE `pontuacao_geralm` (
  `COD_PGERALM` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL,
  `PONTUACAO_GERALM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `pontuacao_geralm`
--

INSERT INTO `pontuacao_geralm` (`COD_PGERALM`, `COD_USUARIO`, `PONTUACAO_GERALM`) VALUES
(1, 1, 200),
(2, 2, 67),
(4, 3, 100);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quiz`
--

CREATE TABLE `quiz` (
  `COD_QUIZ` int(11) NOT NULL,
  `NOME_QUIZ` varchar(50) NOT NULL,
  `DESCRICAO` varchar(400) NOT NULL,
  `QNT_PERGUNTA` smallint(6) NOT NULL,
  `DIFICULDADE` varchar(1) NOT NULL,
  `VALOR_QUIZ` float NOT NULL DEFAULT '100',
  `DT_CRIACAO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DT_ATUALIZACAO` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `APROVACAO` int(11) NOT NULL,
  `ACESSOS` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `quiz`
--

INSERT INTO `quiz` (`COD_QUIZ`, `NOME_QUIZ`, `DESCRICAO`, `QNT_PERGUNTA`, `DIFICULDADE`, `VALOR_QUIZ`, `DT_CRIACAO`, `DT_ATUALIZACAO`, `APROVACAO`, `ACESSOS`) VALUES
(1, 'Quiz de teste 12', 'Este é quiz tem por finalidade testar tudo sobre quiz!', 6, 'M', 100, '2018-10-09 14:35:33', '2018-12-03 16:13:32', 2, 2),
(2, 'Testando HTML Entities', 'S&oacute; testando aqui', 2, 'M', 100, '2018-11-16 17:54:07', '2018-12-03 16:13:32', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quiz_pergunta`
--

CREATE TABLE `quiz_pergunta` (
  `COD_QUIZ` int(11) NOT NULL,
  `COD_PERGUNTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `quiz_pergunta`
--

INSERT INTO `quiz_pergunta` (`COD_QUIZ`, `COD_PERGUNTA`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quiz_tema`
--

CREATE TABLE `quiz_tema` (
  `COD_QUIZ` int(11) NOT NULL,
  `COD_TEMA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `quiz_tema`
--

INSERT INTO `quiz_tema` (`COD_QUIZ`, `COD_TEMA`) VALUES
(1, 8),
(2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quiz_usuario`
--

CREATE TABLE `quiz_usuario` (
  `COD_QUIZ` int(11) NOT NULL,
  `COD_USUARIO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta_correta`
--

CREATE TABLE `resposta_correta` (
  `COD_PERGUNTA` int(11) NOT NULL,
  `COD_ALTERNATIVA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `resposta_correta`
--

INSERT INTO `resposta_correta` (`COD_PERGUNTA`, `COD_ALTERNATIVA`) VALUES
(1, 16),
(2, 20),
(3, 24),
(4, 28),
(5, 32),
(6, 36),
(7, 40),
(8, 44);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tema`
--

CREATE TABLE `tema` (
  `COD_TEMA` int(11) NOT NULL,
  `NOME_TEMA` varchar(50) NOT NULL,
  `DESCRICAO` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tema`
--

INSERT INTO `tema` (`COD_TEMA`, `NOME_TEMA`, `DESCRICAO`) VALUES
(1, 'Lógica de Programação', 'O tema abordará assuntos sobre a lógica na informática'),
(2, 'Banco de Dados', 'Bancos de dados ou bases de dados são um conjunto de arquivos relacionados entre si com registros sobre pessoas, lugares ou coisas.'),
(3, 'HTML', 'HTML é um editor de hipertextos, muito utilizado para criação de páginas online e aplicações de web. Em conjunto com o CSS e Javascript, eles formam as pedras principais para a World Wide Web.'),
(4, 'Linguagens de Programação', 'Uma linguagens de programação é um método padronizado para comunicar instruções para um computador. É um conjunto de regras sintáticas e semânticas usadas para definir um programa de computador.'),
(5, 'Gestão de Sistema Operacional', 'A matéria abrange a área de gerenciamento de diversos tipos de sistemas operacionais, como utiliza-los, suas vantagens, desvantagens,comandos entre outros.'),
(6, 'IMC', 'Tem como função levar ao aluno conhecimentos básicos sobre peças, instalação e manutenção de micros. '),
(7, 'Segurança digital', 'Está diretamente relacionada com proteção de um conjunto de informações. São propriedades básicas da segurança da informação: confidencialidade, integridade, disponibilidade e autenticidade.'),
(8, 'Tema para Testes', 'Este tema é só para testes no banco!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `COD_USUARIO` int(11) NOT NULL,
  `NICKNAME` varchar(50) NOT NULL,
  `EMAIL_USUARIO` varchar(50) NOT NULL,
  `SENHA_USUARIO` varchar(256) NOT NULL,
  `FOTO_USUARIO` varchar(256) DEFAULT NULL,
  `AUTENTICACAO` varchar(3) DEFAULT 'Não',
  `USUARIO_ADMIN` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`COD_USUARIO`, `NICKNAME`, `EMAIL_USUARIO`, `SENHA_USUARIO`, `FOTO_USUARIO`, `AUTENTICACAO`, `USUARIO_ADMIN`) VALUES
(1, 'Bloodreina', 'alexbuarque20@gmail.com', 'aed9713f0ebb62fd89ac82473eb9936f2bc869b9', 'fotoUsuario\\315d9fb5a3b1b12272f0b78b2e6385d9c6a6c5cc.jpg', 'SIM', 1),
(2, 'usuarioteste', 'usuario@teste.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', NULL, 'Não', 0),
(3, 'testando', 'testando@testando.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 'Não', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`COD_ALTERNATIVA`),
  ADD KEY `COD_PERGUNTA` (`COD_PERGUNTA`);

--
-- Indexes for table `areaatuacao_tema`
--
ALTER TABLE `areaatuacao_tema`
  ADD KEY `COD_AREA` (`COD_AREA`),
  ADD KEY `COD_TEMA` (`COD_TEMA`);

--
-- Indexes for table `areaatuacao_usuario`
--
ALTER TABLE `areaatuacao_usuario`
  ADD KEY `COD_AREA` (`COD_AREA`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `area_atuacao`
--
ALTER TABLE `area_atuacao`
  ADD PRIMARY KEY (`COD_AREA`);

--
-- Indexes for table `autor_quiz`
--
ALTER TABLE `autor_quiz`
  ADD KEY `COD_USUARIO` (`COD_USUARIO`),
  ADD KEY `COD_QUIZ` (`COD_QUIZ`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`COD_COMENTARIO`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `duvida`
--
ALTER TABLE `duvida`
  ADD PRIMARY KEY (`COD_DUVIDA`),
  ADD KEY `COD_TEMA` (`COD_TEMA`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `duvida_comentario`
--
ALTER TABLE `duvida_comentario`
  ADD KEY `COD_DUVIDA` (`COD_DUVIDA`),
  ADD KEY `COD_COMENTARIO` (`COD_COMENTARIO`);

--
-- Indexes for table `pergunta`
--
ALTER TABLE `pergunta`
  ADD PRIMARY KEY (`COD_PERGUNTA`);

--
-- Indexes for table `pontuacao`
--
ALTER TABLE `pontuacao`
  ADD PRIMARY KEY (`COD_PONTUACAO`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`),
  ADD KEY `COD_QUIZ` (`COD_QUIZ`);

--
-- Indexes for table `pontuacao_geralf`
--
ALTER TABLE `pontuacao_geralf`
  ADD PRIMARY KEY (`COD_PGERALF`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `pontuacao_gerali`
--
ALTER TABLE `pontuacao_gerali`
  ADD PRIMARY KEY (`COD_PGERALI`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `pontuacao_geralm`
--
ALTER TABLE `pontuacao_geralm`
  ADD PRIMARY KEY (`COD_PGERALM`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`COD_QUIZ`);

--
-- Indexes for table `quiz_pergunta`
--
ALTER TABLE `quiz_pergunta`
  ADD KEY `COD_QUIZ` (`COD_QUIZ`),
  ADD KEY `COD_PERGUNTA` (`COD_PERGUNTA`) USING BTREE;

--
-- Indexes for table `quiz_tema`
--
ALTER TABLE `quiz_tema`
  ADD KEY `COD_QUIZ` (`COD_QUIZ`),
  ADD KEY `COD_TEMA` (`COD_TEMA`);

--
-- Indexes for table `quiz_usuario`
--
ALTER TABLE `quiz_usuario`
  ADD KEY `COD_QUIZ` (`COD_QUIZ`),
  ADD KEY `COD_USUARIO` (`COD_USUARIO`);

--
-- Indexes for table `resposta_correta`
--
ALTER TABLE `resposta_correta`
  ADD KEY `COD_PERGUNTA` (`COD_PERGUNTA`),
  ADD KEY `COD_ALTERNATIVA` (`COD_ALTERNATIVA`);

--
-- Indexes for table `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`COD_TEMA`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`COD_USUARIO`),
  ADD UNIQUE KEY `uc_usuario` (`EMAIL_USUARIO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `COD_ALTERNATIVA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `area_atuacao`
--
ALTER TABLE `area_atuacao`
  MODIFY `COD_AREA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `COD_COMENTARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `duvida`
--
ALTER TABLE `duvida`
  MODIFY `COD_DUVIDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pergunta`
--
ALTER TABLE `pergunta`
  MODIFY `COD_PERGUNTA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pontuacao`
--
ALTER TABLE `pontuacao`
  MODIFY `COD_PONTUACAO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pontuacao_geralf`
--
ALTER TABLE `pontuacao_geralf`
  MODIFY `COD_PGERALF` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pontuacao_gerali`
--
ALTER TABLE `pontuacao_gerali`
  MODIFY `COD_PGERALI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pontuacao_geralm`
--
ALTER TABLE `pontuacao_geralm`
  MODIFY `COD_PGERALM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `COD_QUIZ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tema`
--
ALTER TABLE `tema`
  MODIFY `COD_TEMA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `COD_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `alternativa_ibfk_1` FOREIGN KEY (`COD_PERGUNTA`) REFERENCES `pergunta` (`COD_PERGUNTA`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `areaatuacao_tema`
--
ALTER TABLE `areaatuacao_tema`
  ADD CONSTRAINT `areaatuacao_tema_ibfk_1` FOREIGN KEY (`COD_AREA`) REFERENCES `area_atuacao` (`COD_AREA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `areaatuacao_tema_ibfk_2` FOREIGN KEY (`COD_TEMA`) REFERENCES `tema` (`COD_TEMA`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `areaatuacao_usuario`
--
ALTER TABLE `areaatuacao_usuario`
  ADD CONSTRAINT `areaatuacao_usuario_ibfk_1` FOREIGN KEY (`COD_AREA`) REFERENCES `area_atuacao` (`COD_AREA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `areaatuacao_usuario_ibfk_2` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `autor_quiz`
--
ALTER TABLE `autor_quiz`
  ADD CONSTRAINT `autor_quiz_ibfk_1` FOREIGN KEY (`COD_QUIZ`) REFERENCES `quiz` (`COD_QUIZ`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `autor_quiz_ibfk_2` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `duvida`
--
ALTER TABLE `duvida`
  ADD CONSTRAINT `duvida_ibfk_1` FOREIGN KEY (`COD_TEMA`) REFERENCES `tema` (`COD_TEMA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `duvida_ibfk_2` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `duvida_comentario`
--
ALTER TABLE `duvida_comentario`
  ADD CONSTRAINT `duvida_comentario_ibfk_1` FOREIGN KEY (`COD_DUVIDA`) REFERENCES `duvida` (`COD_DUVIDA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `duvida_comentario_ibfk_2` FOREIGN KEY (`COD_COMENTARIO`) REFERENCES `comentario` (`COD_COMENTARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pontuacao`
--
ALTER TABLE `pontuacao`
  ADD CONSTRAINT `pontuacao_ibfk_1` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pontuacao_ibfk_2` FOREIGN KEY (`COD_QUIZ`) REFERENCES `quiz` (`COD_QUIZ`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pontuacao_geralf`
--
ALTER TABLE `pontuacao_geralf`
  ADD CONSTRAINT `pontuacao_geralf_ibfk_1` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pontuacao_gerali`
--
ALTER TABLE `pontuacao_gerali`
  ADD CONSTRAINT `pontuacao_gerali_ibfk_1` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pontuacao_geralm`
--
ALTER TABLE `pontuacao_geralm`
  ADD CONSTRAINT `pontuacao_geralm_ibfk_1` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `quiz_pergunta`
--
ALTER TABLE `quiz_pergunta`
  ADD CONSTRAINT `quiz_pergunta_ibfk_1` FOREIGN KEY (`COD_QUIZ`) REFERENCES `quiz` (`COD_QUIZ`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quiz_pergunta_ibfk_2` FOREIGN KEY (`COD_PERGUNTA`) REFERENCES `pergunta` (`COD_PERGUNTA`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `quiz_tema`
--
ALTER TABLE `quiz_tema`
  ADD CONSTRAINT `quiz_tema_ibfk_1` FOREIGN KEY (`COD_QUIZ`) REFERENCES `quiz` (`COD_QUIZ`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quiz_tema_ibfk_2` FOREIGN KEY (`COD_TEMA`) REFERENCES `tema` (`COD_TEMA`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `quiz_usuario`
--
ALTER TABLE `quiz_usuario`
  ADD CONSTRAINT `quiz_usuario_ibfk_1` FOREIGN KEY (`COD_QUIZ`) REFERENCES `quiz` (`COD_QUIZ`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quiz_usuario_ibfk_2` FOREIGN KEY (`COD_USUARIO`) REFERENCES `usuario` (`COD_USUARIO`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `resposta_correta`
--
ALTER TABLE `resposta_correta`
  ADD CONSTRAINT `resposta_correta_ibfk_1` FOREIGN KEY (`COD_ALTERNATIVA`) REFERENCES `alternativa` (`COD_ALTERNATIVA`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `resposta_correta_ibfk_2` FOREIGN KEY (`COD_PERGUNTA`) REFERENCES `pergunta` (`COD_PERGUNTA`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

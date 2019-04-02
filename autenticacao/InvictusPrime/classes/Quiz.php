<?php 

	class Quiz{
		private $codTema;
		private $codQuiz;
		private $codPergunta;
		private $codAlternativaCorreta;
		private $lastId;

		public function __construct($codTema = ""){
			$this->setCodTema($codTema);
		}
		
		public function getCodTema(){
			return $this->codTema;
		}
		public function setCodTema($valor){
			$this->codTema = $valor;
		}
		public function getCodQuiz(){
			return $this->codQuiz;
		}
		public function setCodQuiz($valor){
			$this->codQuiz = $valor;
		}
		public function getCodPergunta(){
			return $this->codPergunta;
		}
		public function setCodPergunta($valor){
			$this->codPergunta = $valor;
		}
		public function getCodAlternativaCorreta(){
			return $this->codAlternativaCorreta;
		}
		public function setCodAlternativaCorreta($valor){
			$this->codAlternativaCorreta = $valor;
		}
		public function getLastId(){
			return $this->lastId;
		}
		public function setLastId($valor){
			$this->lastId = $valor;
		}

		private function setData($dados){
			$this->setLastId($dados['LAST_INSERT_ID()']);
		}

		public function insertQuiz($nomeQuiz, $descricao, $qtdPergunta, $dificuldade, $codUsuario){
			$sql = new Sql();

			$resultado = $sql->select("CALL SP_INS_QUIZ(:NOMEQUIZ, :DESCRICAO, :QTDPERGUNTA, :DIFICULDADE, :CODUSUARIO)", array(
				":NOMEQUIZ"=>$nomeQuiz,
				":DESCRICAO"=>$descricao,
				":QTDPERGUNTA"=>$qtdPergunta,
				":DIFICULDADE"=>$dificuldade,
				":CODUSUARIO"=>$codUsuario
				));

			if(count($resultado) > 0){
				$this->setData($resultado[0]);
				$this->setCodQuiz($this->getLastId());

				$this->insertQuizTema();

				return $this->getCodQuiz();

			}else{
				echo "Ocorreu um erro ao inserir no banco!";
			}
		}

		public function insertQuizTema(){
			$sql = new Sql();

			$sql->query("CALL SP_INS_QUIZ_TEMA(:CODQUIZ, :CODTEMA)", array(
				":CODQUIZ"=>$this->getCodQuiz(),
				":CODTEMA"=>$this->getCodTema()
				));
		}

		public function insertPergunta($enunciado){
			$sql = new Sql();

			$resultado = $sql->select("CALL SP_INS_PERGUNTA(:ENUNCIADO)", array(
				":ENUNCIADO"=>$enunciado
				));
			if(count($resultado) > 0){
				$this->setData($resultado[0]);
				$this->setCodPergunta($this->getLastId());

				$this->insertQuizPergunta();
			}else{
				echo "Ocorreu um erro ao inserir a pergunta no banco!";
			}
		}

		public function insertQuizPergunta(){
			$sql = new Sql();

			$sql->query("CALL SP_INS_QUIZ_PERGUNTA(:CODQUIZ, :CODPERGUNTA)", array(
				":CODQUIZ"=>$this->getCodQuiz(),
				":CODPERGUNTA"=>$this->getCodPergunta()
				));
		}

		public function insertAlternativaCorreta($enunciado){
			$sql = new Sql();

			$resultado = $sql->select("CALL SP_INS_ALTERNATIVA_CORRETA(:CODPERGUNTA, :ENUNCIADO)", array(
				":CODPERGUNTA"=>$this->getCodPergunta(),
				":ENUNCIADO"=>$enunciado
				));
			if(count($resultado) > 0){
				$this->setData($resultado[0]);
				$this->setCodAlternativaCorreta($this->getLastId());

				$this->insertRespostaCorreta();
			}else{
				echo "Ocorreu um erro ao inserir alternativa correta no banco!";
			}
		}

		public function insertRespostaCorreta(){
			$sql = new Sql();

			$sql->query("CALL SP_INS_RESPOSTA_CORRETA(:CODPERGUNTA, :CODALTERNATIVA)", array(
				":CODPERGUNTA"=>$this->getCodPergunta(),
				":CODALTERNATIVA"=>$this->getCodAlternativaCorreta()
				));
		}

		public function insertAlternativaIncorreta($a1, $a2, $a3){
			$sql = new Sql();

			$sql->query("CALL SP_INS_ALTERNATIVA_INCORRETA(:CODPERGUNTA, :A1, :A2, :A3)", array(
				":CODPERGUNTA"=>$this->getCodPergunta(),
				":A1"=>$a1,
				":A2"=>$a2,
				":A3"=>$a3
				));
		}
		public function buscarTemas(){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM tema ORDER BY COD_TEMA");

			if(isset($resultado)){
				return $resultado;
			}
		}
		public function editaTema($nomeTema, $descricao, $codTema){
			$sql = new Sql();

			$resultado = $sql->query("UPDATE tema SET NOME_TEMA = :NOMETEMA, DESCRICAO = :DESCRICAO WHERE COD_TEMA = :CODTEMA", array(
									 ":NOMETEMA"=>$nomeTema,
									 ":DESCRICAO"=>$descricao,
									 ":CODTEMA"=>$codTema
									));
		}

		public function buscarQuiz($codQuiz){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM quiz WHERE COD_QUIZ = :CODQUIZ", array(
									 ":CODQUIZ"=>$codQuiz
									));
			if(isset($resultado)){
				return $resultado;
			}
		}
		public function buscarQuizzes(){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM quiz INNER JOIN quiz_tema
									  ON quiz.COD_QUIZ= quiz_tema.COD_QUIZ
									  WHERE quiz_tema.COD_TEMA = :CODTEMA", array(
									  ":CODTEMA"=>$this->getCodTema()
									  ));
			if(isset($resultado)){
				return $resultado;
			}
		}
		public function buscarQuizAlfabetico(){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM quiz ORDER BY NOME_QUIZ ASC");

			if(isset($resultado)){
				return $resultado;
			}
		}
		public function buscarQuizRanking(){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM quiz ORDER BY NOME_QUIZ ASC LIMIT 10");

			if(isset($resultado)){
				return $resultado;
			}
		}
		public function buscarAutorQuiz($codQuiz){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM usuario INNER JOIN autor_quiz
									  ON usuario.COD_USUARIO = autor_quiz.COD_USUARIO
									  WHERE autor_quiz.COD_QUIZ = :CODQUIZ", array(
									  ":CODQUIZ"=>$codQuiz	
									  ));
			if(isset($resultado)){
				return $resultado;
			}
		}

		public function buscarPerguntas($codQuiz){
			$sql = new Sql();

			$resultado = $sql->select("SELECT * 
									   FROM pergunta INNER JOIN quiz_pergunta
									   ON pergunta.COD_PERGUNTA = quiz_pergunta.COD_PERGUNTA
									   WHERE quiz_pergunta.COD_QUIZ = :CODQUIZ
									   ORDER BY RAND()", array(
									   ":CODQUIZ"=>$codQuiz
									   ));
			if(count($resultado) > 0){
				return $resultado;
			}
		}
		public function buscarQtdeDificuldadeQuiz($codQuiz){
			$sql = new Sql();

			$resultado = $sql->query("SELECT QNT_PERGUNTA, DIFICULDADE FROM quiz WHERE COD_QUIZ = :CODQUIZ", array(
									 ":CODQUIZ"=>$codQuiz
									 ));
			if(isset($resultado)){
				return $resultado;
			}
		}
		public function verificaRespostaCorreta($codAlternativa){
			$sql = new Sql();

			$resultado = $sql->select("SELECT * FROM resposta_correta
									  WHERE COD_ALTERNATIVA = :CODALTERNATIVA", array(
									  ":CODALTERNATIVA"=>$codAlternativa
									  ));

			if(count($resultado) > 0){
				return true;
			}else{
				return false;
			}
		}
		public function editarPerguntas($codQuiz){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * 
									   FROM pergunta INNER JOIN quiz_pergunta
									   ON pergunta.COD_PERGUNTA = quiz_pergunta.COD_PERGUNTA
									   WHERE quiz_pergunta.COD_QUIZ = :CODQUIZ", array(
									   ":CODQUIZ"=>$codQuiz
									   ));
			if(isset($resultado)){
				return $resultado;
			}
		}
		public function adcTema($nomeTema, $descricaoTema){
			$sql = new Sql();

			$sql->query("CALL SP_INS_TEMA(:NOMETEMA, :DESCRICAO)", array(
						":NOMETEMA"=>$nomeTema,
						":DESCRICAO"=>$descricaoTema
						));
		}

		public function buscarAlternativas($codPergunta){
			$sql = new Sql();

			$resultado = $sql->select("SELECT * FROM alternativa
									   WHERE COD_PERGUNTA = :CODPERGUNTA
									   ORDER BY RAND()", array(
									   ":CODPERGUNTA"=>$codPergunta
									   ));
			if(count($resultado) > 0){
				return $resultado;
			}
		}
		public function editarAlternativas($codPergunta){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM alternativa
									   WHERE COD_PERGUNTA = :CODPERGUNTA", array(
									   ":CODPERGUNTA"=>$codPergunta
									   ));
			if(isset($resultado)){
				return $resultado;
			}
		}

		public function alternativaCorreta($codPergunta, $codAlternativa){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM resposta_correta
									  WHERE COD_PERGUNTA = :CODPERGUNTA AND COD_ALTERNATIVA = :CODALTERNATIVA", array(
									  ":CODPERGUNTA"=>$codPergunta,
									  ":CODALTERNATIVA"=>$codAlternativa
									));
			if(isset($resultado)){
				return $resultado;
			}
		}
		public function alterarRespostaCorreta($codAlternativa, $codPergunta){
			$sql = new Sql();

			$sql->query("CALL SP_UP_RESPOSTA_CORRETA(:CODALTERNATIVA, :CODPERGUNTA)", array(
						":CODALTERNATIVA"=>$codAlternativa,
						":CODPERGUNTA"=>$codPergunta
						));

		}
		public function updateAlternativa($codAlternativa, $enunciado){
			$sql = new Sql();

			$sql->query("CALL SP_UP_ALTERNATIVA(:CODALTERNATIVA, :ENUNCIADO)", array(
						":CODALTERNATIVA"=>$codAlternativa,
						":ENUNCIADO"=>$enunciado
						));
		}
		public function pegarValorQuiz($codQuiz){
			$sql = new Sql();

			$resultado = $sql->query("SELECT QNT_PERGUNTA, VALOR_QUIZ FROM QUIZ WHERE COD_QUIZ = :CODQUIZ", array(
						":CODQUIZ"=>$codQuiz
						));

			$polido = $resultado->fetch(PDO::FETCH_ASSOC);

			return $polido;
		}
		public function updatePergunta($codPergunta, $enunciado){
			$sql = new Sql();

			$sql->query("CALL SP_UP_PERGUNTA(:CODPERGUNTA, :ENUNCIADO)", array(
						":CODPERGUNTA"=>$codPergunta,
						":ENUNCIADO"=>$enunciado
						));
		}
		public function deletePergunta($codPergunta){
			$sql = new Sql();

			$sql->query("CALL SP_DEL_PERGUNTA(:CODPERGUNTA)", array(
						":CODPERGUNTA"=>$codPergunta
						));
		}
		public function deleteAlternativa($codAlternativa){
			$sql = new Sql();

			$sql->query("CALL SP_DEL_ALTERNATIVA(:CODALTERNATIVA)", array(
						":CODALTERNATIVA"=>$codAlternativa
						));
		}

		//Coisas sobre Pontuação!

		public function insertPontuacao($codUsuario, $codQuiz, $qtdRespostaCorreta, $qtdRespostaIncorreta, $pontuacao){
			$sql = new Sql();

			try {
				
				$verificaExistente = $sql->query("SELECT * FROM pontuacao WHERE COD_QUIZ = :CODQUIZ AND COD_USUARIO = :CODUSUARIO", array(
												 ":CODQUIZ"=>$codQuiz,
												 ":CODUSUARIO"=>$codUsuario
												 ));

				$pontuacaoAntiga = $verificaExistente->fetch(PDO::FETCH_ASSOC);

				if(isset($pontuacaoAntiga['PONTUACAO'])){
					if($pontuacao > $pontuacaoAntiga['PONTUACAO']){
						$sql->query("CALL SP_UP_PONTUACAO(:QTDRCORRETA, :QTDRINCORRETA, :PONTUACAO, :CODQUIZ, :CODUSUARIO)", array(
									":QTDRCORRETA"=>$qtdRespostaCorreta,
									":QTDRINCORRETA"=>$qtdRespostaIncorreta,
									":PONTUACAO"=>$pontuacao,
									":CODQUIZ"=>$codQuiz,
									":CODUSUARIO"=>$codUsuario
									));
						$this->insertRankingGeral($codUsuario, $pontuacao, $codQuiz, $pontuacaoAntiga['PONTUACAO']);
					}
				}else{
					$insercao = $sql->select("CALL SP_INS_PONTUACAO(:CODUSUARIO, :CODQUIZ, :QTDRCORRETA, :QTDRINCORRETA, :PONTUACAO)", array(
											":CODUSUARIO"=>$codUsuario,
											":CODQUIZ"=>$codQuiz,
											":QTDRCORRETA"=>$qtdRespostaCorreta,
											":QTDRINCORRETA"=>$qtdRespostaIncorreta,
											":PONTUACAO"=>$pontuacao
											));
					if(count($insercao) > 0){
						$this->setData($insercao[0]);
					}

					$this->insertRankingGeral($codUsuario, $pontuacao, $codQuiz);

				}
			} catch (Exception $e) {
				echo $e;	
			}
		}

		private function insertRankingGeral($codUsuario, $pontuacao, $codQuiz, $pontuacaoQuizFeito = 0){
			$sql = new Sql();

			$buscaDificuldade = $this->buscarQtdeDificuldadeQuiz($codQuiz);
			$dificuldade = $buscaDificuldade->fetch(PDO::FETCH_ASSOC);

				try {
					
					if($dificuldade['DIFICULDADE'] == 'F'){
						$auxDificuldade = "f";
						$verificaRankingExistente = $this->verificaUsuarioExistente($auxDificuldade, $codUsuario, "F");

						if(isset($verificaRankingExistente)){
							$pontuacaoAntiga = $verificaRankingExistente;
							$novaPontuacao = ($pontuacaoAntiga + $pontuacao) - $pontuacaoQuizFeito;

							$sql->query("CALL SP_UP_PONTUACAO_GERALF(:PONTUACAO, :CODUSUARIO)", array(
										":PONTUACAO"=>$novaPontuacao,
										":CODUSUARIO"=>$codUsuario
										));
						}else{
							$sql->query("CALL SP_INS_PONTUACAO_GERALF(:CODUSUARIO, :PONTUACAO)", array(
										":CODUSUARIO"=>$codUsuario,
										":PONTUACAO"=>$pontuacao
										));
						}
					}else if($dificuldade['DIFICULDADE'] == 'M'){
						$auxDificuldade = "m";
						$verificaRankingExistente = $this->verificaUsuarioExistente($auxDificuldade, $codUsuario, "M");

						if(isset($verificaRankingExistente)){
							
							$pontuacaoAntiga = $verificaRankingExistente;
							$novaPontuacao = ($pontuacaoAntiga + $pontuacao) - $pontuacaoQuizFeito;

							$sql->query("CALL SP_UP_PONTUACAO_GERALM(:PONTUACAO, :CODUSUARIO)", array(
										":PONTUACAO"=>$novaPontuacao,
										":CODUSUARIO"=>$codUsuario
										));
						}else{
							$sql->query("CALL SP_INS_PONTUACAO_GERALM(:CODUSUARIO, :PONTUACAO)", array(
										":CODUSUARIO"=>$codUsuario,
										":PONTUACAO"=>$pontuacao
										));
						}
					}else if($dificuldade['DIFICULDADE'] == 'I'){
						$auxDificuldade = "i";
						$verificaRankingExistente = $this->verificaUsuarioExistente($auxDificuldade, $codUsuario, "I");

						if(isset($verificaRankingExistente)){
							$pontuacaoAntiga = $verificaRankingExistente;
							$novaPontuacao = ($pontuacaoAntiga + $pontuacao) - $pontuacaoQuizFeito;

							$sql->query("CALL SP_UP_PONTUACAO_GERALI(:PONTUACAO, :CODUSUARIO)", array(
										":PONTUACAO"=>$novaPontuacao,
										":CODUSUARIO"=>$codUsuario
										));
						}else{
							$sql->query("CALL SP_INS_PONTUACAO_GERALI(:CODUSUARIO, :PONTUACAO)", array(
										":CODUSUARIO"=>$codUsuario,
										":PONTUACAO"=>$pontuacao
										));
						}
					}
				} catch (Exception $e) {
					echo $e;	
				}
		}

		private function verificaUsuarioExistente($dificuldade, $codUsuario, $dificuldade2){
			$sql = new Sql();

			try {
				
				$resultado = $sql->query("SELECT * FROM pontuacao_geral$dificuldade WHERE COD_USUARIO = :CODUSUARIO", array(
										  ":CODUSUARIO"=>$codUsuario
										  ));
				$verificado = $resultado->fetch(PDO::FETCH_ASSOC);


				if(isset($verificado['PONTUACAO_GERAL'.$dificuldade2])){
					return $verificado['PONTUACAO_GERAL'.$dificuldade2];
				}
			} catch (Exception $e) {
				echo $e;	
			}
		}

		public function buscarPontuacaoUsuario($codUsuario, $dificuldade){
			$sql = new Sql();

			try{

				$resultado = $sql->query("SELECT * FROM pontuacao_geral$dificuldade WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codUsuario
										 ));
				if(isset($resultado)){
					$posResultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $posResultado;
				}

			} catch(Exception $e){
				echo $e;
			}
		}
		public function buscarPontuacaoGeralDificuldade($dificuldade){
			$sql = new Sql();

			$d = strtoupper($dificuldade);

			try {
				$resultado = $sql->query("SELECT * FROM pontuacao_geral$dificuldade ORDER BY PONTUACAO_GERAL$d DESC");

				if(isset($resultado)){
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarPontuacaoIndividualGeral($codUsuario){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT *, SUM(PONTUACAO) AS PONTUACAOGERAL FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codUsuario
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
					echo $e;
			}
		}

		public function buscarPontuacaoQuiz($codQuiz){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT * FROM pontuacao WHERE COD_QUIZ = :CODQUIZ ORDER BY PONTUACAO DESC", array(
										 ":CODQUIZ"=>$codQuiz
										));
				if(isset($resultado)){
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}

		/*Querrys para Perfil*/
		public function buscarQtdeQuizFeito($codNick){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT COUNT(*) AS QTDE FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codNick
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarQtdeQuizCriado($codNick){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT COUNT(*) AS QTDE FROM autor_quiz WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codNick
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarAlternativasCorretasUsuario($codNick){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT *, SUM(QNT_RCORRETA) AS QTDE FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codNick
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarAlternativasIncorretasUsuario($codNick){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT *, SUM(QNT_RINCORRETA) AS QTDE FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codNick
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarQuizPorAutor($codNick){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT * FROM quiz INNER JOIN autor_quiz
										  ON autor_quiz.COD_QUIZ = quiz.COD_QUIZ
										  WHERE autor_quiz.COD_USUARIO = :CODUSUARIO", array(
										  ":CODUSUARIO"=>$codNick
										));
				if(isset($resultado)){
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarQtdeAcessos($codQuiz){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT ACESSOS FROM quiz WHERE COD_QUIZ = :CODQUIZ", array(
										 ":CODQUIZ"=>$codQuiz
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarAlternativasCorretasQuiz($codQuiz){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT *, SUM(QNT_RCORRETA) AS QTDE FROM pontuacao WHERE COD_QUIZ = :CODQUIZ", array(
										 ":CODQUIZ"=>$codQuiz
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarAlternativasIncorretasQuiz($codQuiz){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT *, SUM(QNT_RINCORRETA) AS QTDE FROM pontuacao WHERE COD_QUIZ = :CODQUIZ", array(
										 ":CODQUIZ"=>$codQuiz
										));
				if(isset($resultado)){
					$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		
		/* Select quantidade de quizzes pora a pagina sobre */
		public function buscarQtdeQuizzes($codTema){
			$sql = new Sql();

			try {
				$qtdeQuizzes = $sql->query("SELECT COUNT(*) AS QTDE FROM quiz_tema WHERE COD_TEMA = :CODTEMA", array(
				 						   ":CODTEMA"=>$codTema
				 						));
				if(isset($qtdeQuizzes)){
					$qtdeQuizzes = $qtdeQuizzes->fetch(PDO::FETCH_ASSOC);
					return $qtdeQuizzes['QTDE'];
				}
			} catch (Exception $e) {
				echo $e;	
			}
		}
		public function buscarQtdeQuizzesRespondidos($codUsuario){
			$sql = new Sql();

			try {
				$resultado = $sql->query("SELECT COUNT(*) AS QTDE FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
										 ":CODUSUARIO"=>$codUsuario
										));
				if(isset($resultado)){
					return $resultado;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarQtdePerguntasRespondidas($codUsuario){
			$sql = new Sql();
			try {
				$perguntasCorretas = $sql->query("SELECT *, SUM(QNT_RCORRETA) AS SOMA FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
				 								 ":CODUSUARIO"=>$codUsuario
				 								));
				$perguntasIncorretas = $sql->query("SELECT *, SUM(QNT_RINCORRETA) AS SOMA FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
												 ":CODUSUARIO"=>$codUsuario
												));
				if(!isset($perguntasCorretas)){
					exit;
				}
				if(!isset($perguntasIncorretas)){
					exit;
						
				}

				$perguntasCorretas = $perguntasCorretas->fetch(PDO::FETCH_ASSOC);
				$perguntasIncorretas = $perguntasIncorretas->fetch(PDO::FETCH_ASSOC);

				$resultado = $perguntasIncorretas['SOMA'] + $perguntasCorretas['SOMA'];

				return $resultado;
				

			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarQtdePerguntasCorretas($codUsuario){
			$sql = new Sql();

			try {
				$qtdeCorretas = $sql->query("SELECT *, SUM(QNT_RCORRETA) AS SOMA FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
				 								 ":CODUSUARIO"=>$codUsuario
				 								));
				if(isset($qtdeCorretas)){
					$qtdeCorretas = $qtdeCorretas->fetch(PDO::FETCH_ASSOC);
					return $qtdeCorretas;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarQtdePerguntasIncorretas($codUsuario){
			$sql = new Sql();

			try {
				$qtdeIncorretas = $sql->query("SELECT *, SUM(QNT_RINCORRETA) AS SOMA FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
				 								 ":CODUSUARIO"=>$codUsuario
				 								));
				if(isset($qtdeIncorretas)){
					$qtdeIncorretas = $qtdeIncorretas->fetch(PDO::FETCH_ASSOC);
					return $qtdeIncorretas;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}
		public function buscarPontuacaoTotal($codUsuario){
			$sql = new Sql();

			try {
				$pontuacaoTotal = $sql->query("SELECT *, SUM(PONTUACAO) AS SOMA FROM pontuacao WHERE COD_USUARIO = :CODUSUARIO", array(
				 							  ":CODUSUARIO"=>$codUsuario
				 							));
				if(isset($pontuacaoTotal)){
					$pontuacaoTotal = $pontuacaoTotal->fetch(PDO::FETCH_ASSOC);
					return $pontuacaoTotal;
				}
			} catch (Exception $e) {
				echo $e;
			}
		}

		public function addLike($codQuiz){
			$sql = new Sql();

			$buscarAprovacao = $sql->query("SELECT APROVACAO FROM quiz WHERE COD_QUIZ = :CODQUIZ", array(
										   ":CODQUIZ"=>$codQuiz
										  ));
			$buscarAprovacao = $buscarAprovacao->fetch(PDO::FETCH_ASSOC);

			$qtdeLikeAtual = $buscarAprovacao['APROVACAO'] + 1;

			$sql->query("UPDATE quiz SET APROVACAO = :LIKE WHERE COD_QUIZ = :CODQUIZ", array(
						":LIKE"=>$qtdeLikeAtual,
						":CODQUIZ"=>$codQuiz
						));
		}

		public function addAcesso($codQuiz){
			$sql = new Sql();

			$buscarAcessos = $sql->query("SELECT ACESSOS FROM quiz WHERE COD_QUIZ = :CODQUIZ", array(
										 ":CODQUIZ"=>$codQuiz
										 ));
			$buscarAcessos = $buscarAcessos->fetch(PDO::FETCH_ASSOC);

			$qtdeAcesso = $buscarAcessos['ACESSOS'] + 1;

			$sql->query("CALL SP_UP_QUIZ_ACESSOS(:CODQUIZ, :QTDE)", array(
						":CODQUIZ"=>$codQuiz,
						":QTDE"=>$qtdeAcesso
						));
		}
	}

 ?>
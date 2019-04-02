<?php if(!isset($_SESSION)){session_start();} ?>
	<meta charset="utf-8">
	<script src="../jquery/jquery-3.1.1.min.js"></script>
	<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="estiloVerQuiz.css">

		<?php 

			require_once '../config.php';

			

			$codQuiz = $_POST['codquiz'];
			$codPergunta = $_POST['codpergunta'];
			$codUsuario = $_SESSION['cod_usuario'];
			$nomeUsuario = $_SESSION['nome'];
			$pontuacao = 0;

			$quiz = new Quiz();

			$result = $quiz->buscarQuiz($codQuiz);
			$posResult = $result->fetch(PDO::FETCH_ASSOC);
			$nomeQuiz = $posResult['NOME_QUIZ'];
			$qtdPergunta = $posResult['QNT_PERGUNTA'];
			$dificuldadeQuiz = $posResult['DIFICULDADE'];

			$valorPergunta = 100 / $qtdPergunta;
			$qtdPerguntasCorretas = 0;
			$qtdPerguntasIncorretas = 0;

			for($i=1;$i <= $qtdPergunta; $i++){
				if(!isset($_POST['questao'.$i])){
					$qtdPerguntasIncorretas += 1;
					continue;
				}else{
					$alternativaSelecionada = $_POST['questao'.$i];
					$resultado = $quiz->verificaRespostaCorreta($alternativaSelecionada);
					
					if($resultado == true){
						$qtdPerguntasCorretas += 1;
						$pontuacao += $valorPergunta;
					}else{
						$qtdPerguntasIncorretas += 1;
					}	
				}
				
				
			}
			$pontuacaoFinal = number_format($pontuacao, 0);

			$quiz->insertPontuacao($codUsuario, $codQuiz, $qtdPerguntasCorretas, $qtdPerguntasIncorretas, $pontuacao);


			echo "<button id='btClick' class='card-link btn btn-outline-info btn-lg btn-espaco' onclick=\"carregarModal('$nomeUsuario', '$nomeQuiz', '$qtdPergunta', '$qtdPerguntasCorretas', '$qtdPerguntasIncorretas', '$pontuacaoFinal')\">Ver Pontuação</button>";

			echo "
				<button id='like' class='float-right btn btn-md btn-outline-info btn-espaco' onclick=\"addLike('$codQuiz')\"><img src='../img/like.png'></button>
				<span class='float-right text-white fraseLike span-espaco'>Gostou do Quiz? Deixe seu Like!</span>
				";

				
				//<a href='addLike.php?codQuiz=$codQuiz' class='float-right btn btn-outline-primary btn-lg btn-espaco'>Like</a>
		?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="../bootstrap4/js/bootstrap.min.js"></script>
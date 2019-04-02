<?php 
	require_once '../sessions/acesso-usuario-autenticado.php';
	require_once '../config.php';

?>
	<!DOCTYPE html>
	<html>
	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
	</head>
	
<?php

	$codTema = $_POST['codTema'];
	$nomeQuiz = htmlentities($_POST['nomeQuiz'], ENT_QUOTES, "utf-8");
	$descricao = htmlentities($_POST['descricao'], ENT_QUOTES, "utf-8");
	$qtdPerguntas = htmlentities($_POST['qtd_perguntas'], ENT_QUOTES, "utf-8");
	$dificuldade = $_POST['dificuldade'];
	$codUsuario = $_SESSION['cod_usuario'];

	$quiz = new Quiz($codTema);

	/*Insert do Quiz no banco*/
	$retornoCodQuiz = $quiz->insertQuiz($nomeQuiz, $descricao, $qtdPerguntas, $dificuldade, $codUsuario);
	/*==================================================================================================================================*/

	for($i=1; $i < 101; $i++){
		if(isset($_POST['pergunta'.$i])){

			/*Coletando os dados para insert das perguntas e alternativas*/
			$pergunta = htmlentities($_POST['pergunta'.$i], ENT_QUOTES, "utf-8");
			$alternativaCorreta = htmlentities($_POST['alternativaC'.$i], ENT_QUOTES, "utf-8");
			$alternativaIncorreta1 = htmlentities($_POST['alternativaIa'.$i], ENT_QUOTES, "utf-8");
			$alternativaIncorreta2 = htmlentities($_POST['alternativaIb'.$i], ENT_QUOTES, "utf-8");
			$alternativaIncorreta3 = htmlentities($_POST['alternativaIc'.$i], ENT_QUOTES, "utf-8");

		/*================================================================================================================================*/
		$cem = 100;
		$valorPergunta = ($cem / $qtdPerguntas);

		$quiz->insertPergunta($pergunta, $valorPergunta);

		/*================================================================================================================================*/

		$quiz->insertAlternativaCorreta($alternativaCorreta);

		/*================================================================================================================================*/

		$quiz->insertAlternativaIncorreta($alternativaIncorreta1, $alternativaIncorreta2, $alternativaIncorreta3);
		
		/*================================================================================================================================*/
		}else{
			continue;
		}
	}
	
	/*header("refresh:3;url=testeTemas.php");
	echo "Quiz enviado com Sucesso! Você será redirecionado para ver Temas...";
	*/
		

?>
	
	<body>
		<script>
			window.location.href = "verTemas.php";
		</script>
	</body>
</html>
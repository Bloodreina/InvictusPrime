<?php 
	require_once '../sessions/acesso-adm.php';
	require_once '../config.php';
?>
	<!DOCTYPE html>
	<html>
	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
	</head>
	</html>
	
<?php

	$codQuiz = $_POST['codQuizz'];

	$quiz = new Quiz();

	$retorno = $quiz->pegarValorQuiz($codQuiz);
	$valorQuiz = $retorno['VALOR_QUIZ'];
	$qtdPergunta = $retorno['QNT_PERGUNTA'];

	$valorPergunta = ($valorQuiz / $qtdPergunta);

	$enunciadoP = htmlentities($_POST['enunciadoAdc'], ENT_QUOTES, "utf-8");
	$enunciadoAC = htmlentities($_POST['aCorreta'], ENT_QUOTES, "utf-8");
	$enunciadoAI1 = htmlentities($_POST['aIncorreta1'], ENT_QUOTES, "utf-8");
	$enunciadoAI2 = htmlentities($_POST['aIncorreta2'], ENT_QUOTES, "utf-8");
	$enunciadoAI3 = htmlentities($_POST['aIncorreta3'], ENT_QUOTES, "utf-8");

	
	$quiz->setCodQuiz($codQuiz);

	$quiz->insertPergunta($enunciadoP, $valorPergunta);

	$quiz->insertAlternativaCorreta($enunciadoAC);

	$quiz->insertAlternativaIncorreta($enunciadoAI1, $enunciadoAI2, $enunciadoAI3);
	
	echo "<script>setTimeout(function(){self.location='gerenciarPerguntas.php?q=$codQuiz';}, 3000);</script>";

 ?>
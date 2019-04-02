<?php 
	
	require_once '../config.php';

	$codQuiz = $_GET['codQuiz'];

	$quiz = new Quiz();

	$quiz->addLike($codQuiz);


 ?>
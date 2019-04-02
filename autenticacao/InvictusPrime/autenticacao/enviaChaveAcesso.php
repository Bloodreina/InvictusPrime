<?php 

	require_once '../config.php';

	$gerarChave = new Usuario();

	$email = $_POST['email'];

	$email = preg_replace('/[^[:alnum:]_.-@]/', '', $email);

	$chave = $gerarChave->geraChaveAcesso($email);

	if(isset($chave)){
		echo '<a href="novaSenha.php?chave='.$chave.'">novaSenha.php?chave='.$chave.'</a>';
	}else{
		echo 'Usuário não encontrado';
	}

 ?>
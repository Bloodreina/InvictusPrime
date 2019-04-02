<?php 

	require_once "../config.php";

	$nick = $_POST['nick'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$confSenha = $_POST['conf_senha'];
	$areaAtuacao = $_POST['areaAtuacao'];
	
	if($senha === $confSenha){
		$cadastrar = new Usuario($nick, $email, $senha, $areaAtuacao);
		$cadastrar->register();
		header("refresh:0;url=login.php");
		echo "Cadastro efetuado com sucesso! Você será redirecionado para fazer Login...";
	}else{
		echo "<script>setTimeout(function(){history.go(-1);}, 0);</script>";
		echo "As senhas não são iguais!";
	}

 ?>
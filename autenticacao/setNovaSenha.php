<?php 

	require_once '../config.php';

	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$confSenha = $_POST['confSenha'];
	$chave = $_POST['chave'];


	$alterar = new Usuario();

	$resultado = $alterar->checkChave($email, $chave);

	if(isset($resultado)){
		if($senha === $confSenha){
			$alterar->update($resultado, $senha);
		}
	}

	echo "<script>setTimeout(function(){self.location='login.php';}, 3000);</script>";
	echo "Senha Alterada com Sucesso! Você será redirecionado para fazer Login...";

 ?>
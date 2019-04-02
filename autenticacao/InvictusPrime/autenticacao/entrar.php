<?php 
	
	require_once "../config.php";

	session_start();

	$entrar = new Usuario();

	$email = $_POST["email"];
	$senha = $_POST["senha"];

	$email = preg_replace('/[^[:alnum:]_.-@]/', '', $email);
	$senha = addslashes($senha);

	$retorno = $entrar->login($email, $senha);

	if($retorno == false){
		$_SESSION['valida'] = 'NAO';
		echo "<script>setTimeout(function(){self.location='login.php?login=erro';}, 0);</script>";
	}else{
		$_SESSION['valida'] = 'SIM';

		foreach($retorno as $user){
			$_SESSION['cod_usuario'] = $user['COD_USUARIO'];
			$_SESSION['nome'] = $user['NICKNAME'];
			$_SESSION['autenticacao'] = $user['AUTENTICACAO'];
			$_SESSION['acesso'] = $user['USUARIO_ADMIN'];
		}

		echo "<script>setTimeout(function(){self.location='../index.php';}, 0);</script>";
	}


 ?>
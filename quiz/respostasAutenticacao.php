<?php
	if(!isset($_SESSION)){
		session_start();
	}
	require_once '../config.php';

	$sql = new Sql();

	$codUsuario = $_SESSION['cod_usuario'];

	$a1 = $_POST['questao1'];
	$a2 = $_POST['questao2'];
	$a3 = $_POST['questao3'];
	$a4 = $_POST['questao4'];
	$a5 = $_POST['questao5'];
	$a6 = $_POST['txt6'];
	$a7 = $_POST['txt7'];

	$sql->query("INSERT INTO resposta_autenticacao(COD_USUARIO, RESPOSTA1, RESPOSTA2, RESPOSTA3, RESPOSTA4, RESPOSTA5, RESPOSTA6, RESPOSTA7)
				VALUES
				(:CODUSUARIO, :RESPOSTA1, :RESPOSTA2, :RESPOSTA3, :RESPOSTA4, :RESPOSTA5, :RESPOSTA6, :RESPOSTA7)
				", array(
				":CODUSUARIO"=>$codUsuario,
				":RESPOSTA1"=>$a1,
				":RESPOSTA2"=>$a2,
				":RESPOSTA3"=>$a3,
				":RESPOSTA4"=>$a4,
				":RESPOSTA5"=>$a5,
				":RESPOSTA6"=>$a6,
				":RESPOSTA7"=>$a7
				));

	echo "<script>setTimeout(function(){self.location='../perfil.php';}, 0);</script>";

 ?>
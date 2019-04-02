<?php 
	
	if(!isset($_SESSION)){
		session_start();
	}

	require_once '../config.php';

	if(isset($_FILES['fotoUsuario'])){
		$foto = $_FILES['fotoUsuario'];

		if($foto['name'] != ""){
			$usuario = new Usuario();

			$codUsuario = $_SESSION['cod_usuario'];

			$usuario->uploadFotoUsuario($foto, $codUsuario);
		}

		

		echo "Foto Alterada com Sucesso!";
		echo "<script>setTimeout(function(){history.back();}, 0);</script>";
	}

 ?>
<?php 

	if(!isset($_SESSION)){
		session_start();
	}

	if (!isset($_SESSION['valida']) || $_SESSION['valida'] != 'SIM') {
		header('Location: ../autenticacao/login.php?login=erro2');
	}
 ?>
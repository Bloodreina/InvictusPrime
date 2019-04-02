<?php
	if(!isset($_SESSION)){
		session_start();
	}
	require_once 'config1.php';

	if(isset($_POST['nickname'])){
		$nickname = $_POST['nickname'];
		$email = $_POST['email'];
		$senhaAtual = $_POST['senhaAtual'];
		$novaSenha = $_POST['novaSenha'];
		$confirmarSenha = $_POST['repitirSenha'];
		$area = $_POST['area_atuacao'];

		$usuario = new Usuario();
		$usuario->loadById($_SESSION['cod_usuario']);

		$verificaSenha = sha1($senhaAtual);

		if($usuario->getSenha() === $verificaSenha){
			if($novaSenha === $confirmarSenha){
				$usuario->atualizaPerfil($_SESSION['cod_usuario'], $nickname, $email, $novaSenha, $area);
			}
		}else{
			echo "Senha Atual errada!";
			echo "<script>setTimeout(function(){history.back();}, 0);</script>";
		}
	}elseif(isset($_POST['txtNomeQuiz'])){
		$codQuiz = $_POST['txtCodQuiz'];
		$nomeQuiz = htmlentities($_POST['txtNomeQuiz'], ENT_QUOTES, "utf-8");
		$descricao = htmlentities($_POST['txtDescricao'], ENT_QUOTES, "utf-8");
		$qtdPerguntas = $_POST['txtPergunta'];
		$dificuldade = $_POST['dificuldade'];
		if($dificuldade == "F" || $dificuldade == "M" || $dificuldade == "I"){
			$dificuldade;
		}else{
			$dificuldade = $_POST['txtDificuldade'];
		}

		$sql = new Sql();

		$sql->query("CALL SP_UP_QUIZ(:CODQUIZ, :NOMEQUIZ, :DESCRICAO, :QTDPERGUNTA, :DIFICULDADE)", array(
					":CODQUIZ"=>$codQuiz,
					":NOMEQUIZ"=>$nomeQuiz,
					":DESCRICAO"=>$descricao,
					":QTDPERGUNTA"=>$qtdPerguntas,
					":DIFICULDADE"=>$dificuldade
					));
	}
		

	

	echo "Dados alterados com sucesso!";
	echo "<script>setTimeout(function(){history.back();}, 0);</script>";
	
 ?>

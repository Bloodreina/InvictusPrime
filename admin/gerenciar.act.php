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
	$sql = new Sql();

	if(isset($_POST['txtCod'])){
		$codUsuario = $_POST['txtCod'];
		$emailUsuario = $_POST['txtEmail'];
		$nickName = $_POST['txtNick'];
		$autenticacao = $_POST['txtAutenticacao'];
		$acesso = $_POST['txtAcesso'];

		$pasta = "fotoUsuario/";
		$foto = "";
		$nomeCompleto = "";


		/*if(isset($_FILES['foto'])){
			$foto = $_FILES['foto'];

			$novoNome = sha1(time().$foto['size']);

			$largura = 200;
			$altura = 150;

			list($larguraAntiga, $alturaAntiga) = getimagesize($foto);

			$fotoNova = imagecreatetruecolor($largura, $altura);
			$fotoAntiga = imagecreatefromgd($foto);

			imagecopyresampled($fotoNova, $fotoAntiga, 0, 0, 0, 0, $largura, $altura, $larguraAntiga, $alturaAntiga);

			imagejpeg($fotoNova);

			$nomeCompleto = $pasta.$novoNome.".jpg";
			move_uploaded_file($foto['tmp_name'], $nomeCompleto);
		}*/

		$sql->query("CALL SP_UP_USUARIO_ADMIN(:CODUSUARIO, :NICK, :EMAIL, :AUTENTICACAO, :ACESSO)", array(
					":CODUSUARIO"=>$codUsuario,
					":NICK"=>$nickName,
					":EMAIL"=>$emailUsuario,
					":AUTENTICACAO"=>$autenticacao,
					":ACESSO"=>$acesso
					));
		
		echo "<script>setTimeout(function(){history.back();}, 0);</script>";
		echo "Alteração feita com sucesso! Você será redirecionado...";
	}
	if(isset($_POST['txtCodigo'])){
		$codQuiz = $_POST['txtCodigo'];
		$nomeQuiz = htmlentities($_POST['txtNomeQuiz'], ENT_QUOTES, "utf-8");
		$descricao = htmlentities($_POST['txtDescricao'], ENT_QUOTES, "utf-8");
		$qtdPergunta = $_POST['txtPergunta'];
		$dificuldade = $_POST['dificuldade'];

		if($dificuldade == "Mudar Dificuldade"){
			$busca = $sql->query("SELECT DIFICULDADE FROM quiz WHERE COD_QUIZ = :CODQUIZ", array(
								 ":CODQUIZ"=>$codQuiz
								 ));
			$busca = $busca->fetch(PDO::FETCH_ASSOC);
			$dificuldade = $busca['DIFICULDADE'];
		}
		$dificuldade;
		$sql->query("CALL SP_UP_QUIZ(:CODQUIZ, :NOMEQUIZ, :DESCRICAO, :QTDPERGUNTA, :DIFICULDADE)", array(
					":CODQUIZ"=>$codQuiz,
					":NOMEQUIZ"=>$nomeQuiz,
					":DESCRICAO"=>$descricao,
					":QTDPERGUNTA"=>$qtdPergunta,
					":DIFICULDADE"=>$dificuldade
					));
		
		echo "<script>setTimeout(function(){history.back();}, 0);</script>";
		echo "Alteração feita com sucesso! Você será redirecionado...";
	}
	if(isset($_POST['ptxtcodTema'])){
		$codTema = $_POST['ptxtcodTema'];
		$nomeTema = $_POST['txtnometema'];
		$descricaoTema = $_POST['txtdescricaotema'];

		$quiz = new Quiz();
		$quiz->editaTema($nomeTema, $descricaoTema, $codTema);

		echo "<script>setTimeout(function(){history.back();}, 0);</script>";
		echo "Alteração feita com sucesso! Você será redirecionado...";	
	}
	if(isset($_POST['txtAdcNomeTema'])){
		$nomeTema = htmlentities($_POST['txtAdcNomeTema'], ENT_QUOTES, "utf-8");
		$descricaoTema = htmlentities($_POST['txtAdcDescricaoTema'], ENT_QUOTES, "utf-8");

		$quiz = new Quiz();
		$quiz->adcTema($nomeTema, $descricaoTema);

		echo "<script>setTimeout(function(){history.back();}, 0);</script>";
		echo "Tema adicionado com sucesso! Você será redirecionado...";		
	}

	if(isset($_GET['q'])){
		$opcao = $_GET['q'];

		if($opcao == 1){
			$codUsuario = $_POST['eCod'];

			$sql->query("DELETE FROM usuario WHERE COD_USUARIO = :COD", array(
						":COD"=>$codUsuario
						));

			header("refresh:3;url=gerenciar.php");
			echo "Exclusão feita com sucesso! Você será redirecionado...";
		}elseif($opcao == 2){
			$codQuiz = $_POST['eCod'];

			$sql->query("DELETE pergunta
						FROM pergunta
						INNER JOIN quiz_pergunta
						ON pergunta.COD_PERGUNTA = quiz_pergunta.COD_PERGUNTA
						WHERE quiz_pergunta.COD_QUIZ = :CODQUIZ", array(
						":CODQUIZ"=>$codQuiz
						));

			$sql->query("DELETE FROM autor_quiz
						WHERE COD_QUIZ = :CODQ", array(
						":CODQ"=>$codQuiz
						));

			$sql->query("DELETE FROM quiz WHERE COD_QUIZ = :COD", array(
						":COD"=>$codQuiz
						));

			echo "<script>setTimeout(function(){history.back();}, 0);</script>";
			echo "Exclusão feita com sucesso! Você será redirecionado...";
		}elseif($opcao == 3){
			$codTema = $_POST['eCodTema'];

			$sql->query("DELETE FROM tema WHERE COD_TEMA = :COD", array(
						":COD"=>$codTema
						));
			
			header("refresh:3;url=gerenciar.php");
			echo "Exclusão feita com sucesso! Você será redirecionado...";
		}
	}

	

 ?>
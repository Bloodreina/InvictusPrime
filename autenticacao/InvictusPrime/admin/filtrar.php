<?php 
	require_once '../sessions/acesso-adm.php';	
	require_once '../config.php';
?>
	<!DOCTYPE html>
	<html>
	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="estiloGerenciar.css">
		
	</head>
	</html>
	
<?php

	$opcao = $_GET['opcao'];
	$sql = new Sql();

	if($opcao == 1){

		$resultado = $sql->query("SELECT * FROM usuario ORDER BY COD_USUARIO");

		echo "
			<table class='table table-striped table-hover bg-secondary'>
				<thead class='thead-dark text-white'>
					<tr>
						<th>Codigo Usuário</th>
						<th>E-mail</th>
						<th>Nickname</th>
						<th>É autenticado?</th>
						<th>Acesso</th>
						<th>Gerenciar</th>
					</tr>
				</thead>
			";

		while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
			echo "
				<tbody class='bg-light text-secondary'>
					<tr>
						<td>$row[COD_USUARIO]</td>
						<td>$row[EMAIL_USUARIO]</td>
						<td>$row[NICKNAME]</td>
						<td>$row[AUTENTICACAO]</td>
						<td>$row[USUARIO_ADMIN]</td>
						<td><a href='gerenciar.act.php' class='text-info card-link' data-toggle='modal' data-target='#gerenciarModal1' onclick=\"carregarInfo('$row[COD_USUARIO]', '$row[EMAIL_USUARIO]', '$row[NICKNAME]', '$row[AUTENTICACAO]', '$row[USUARIO_ADMIN]', '$row[FOTO_USUARIO]')\">Gerenciar</a>
						</td>
					</tr>
				</tbody>
				";
		}
		echo "</table>";
	}elseif ($opcao == 2) {
		$resultado = $sql->query("SELECT * FROM quiz ORDER BY COD_QUIZ");

		echo "
			<table class='table table-striped table-hover bg-secondary'>
				<thead class='thead-dark text-white'>
					<tr>
						<th>Código Quiz</th>
						<th>Nome do Quiz</th>
						<th>Descrição</th>
						<th>Gerenciar Quiz</th>
						<th>Gerenciar Perguntas</th>
					</tr>
				</thead>
			";
		while($row = $resultado->fetch(PDO::FETCH_ASSOC)){

			$quiz = new Quiz();
			$retorno = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
			$autorQuiz = $retorno->fetch(PDO::FETCH_ASSOC);
			$dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
			$dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));

			echo "
				<tbody class='bg-light text-secondary'>
					<tr>
						<td>$row[COD_QUIZ]</td>
						<td>$row[NOME_QUIZ]</td>
						<td>$row[DESCRICAO]</td>
						<td><a href='gerenciar.act.php' class='card-link text-info' data-toggle='modal' data-target='#gerenciarModal2' onclick=\"carregarInfo1('$row[COD_QUIZ]', '$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[DIFICULDADE]', '$autorQuiz[NICKNAME]')\">Gerenciar</a>
						</td>
						<td><a class='card-link text-info' href='gerenciarPerguntas.php?q=$row[COD_QUIZ]'>Gerenciar Perguntas</a></td>
					</tr>
				</tbody>
				";
		}
		echo "</table>";
	}elseif($opcao == 3){
		$resultado = $sql->query("SELECT * FROM tema ORDER BY COD_TEMA");

		echo "
			<br>
			<center>
				<h6><a href='#' class='card-link' data-toggle='modal' data-target='#gerenciarModal4'>Clique aqui</a> para adicionar um novo Tema.</h6>
			</center> 
			";

		echo "
			<table class='table table-striped table-hover bg-secondary'>
				<thead class='thead-dark text-white'>
						<tr>
							<th>Código Tema</th>
							<th>Nome do Tema</th>
							<th>Descrição</th>
							<th>Gerenciar Tema</th>
						</tr>
					</thead>
		";

		while($row = $resultado->fetch(PDO::FETCH_ASSOC)){

			echo "
				<tbody class='bg-light text-secondary'>
					<tr>
						<td>$row[COD_TEMA]</td>
						<td>$row[NOME_TEMA]</td>
						<td>$row[DESCRICAO]</td>
						<td><a href='#' class='card-link text-info' data-toggle='modal' data-target='#gerenciarModal3' onclick=\"carregarInfo2('$row[COD_TEMA]', '$row[NOME_TEMA]', '$row[DESCRICAO]')\">Gerenciar</a></td>
					</tr>
				</tbody>
			";
		}
		echo "</table>";
	}

 ?>
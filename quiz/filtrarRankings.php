<?php 
	
	
	require_once '../config.php';

	$quiz = new Quiz();

	$busca = $_GET['busca'];
	$modoBusca = $_GET['modo'];

	$f = "f";
	$m = "m";
	$i = "i";
	$g = "g";

	if($modoBusca == 1){
		if(!isset($_SESSION)){
			session_start();
		}

		$codUsuario = $_SESSION['cod_usuario'];
		$nomeUsuario = $_SESSION['nome'];

		if($busca == 'f'){
			$pontuacaoF = $quiz->buscarPontuacaoUsuario($codUsuario, 'f');
			$usuario = new Usuario();

			$usuario->loadById($codUsuario);

			$nickUsuario = $usuario->getNick();
			$codUsuario = $usuario->getCodUsuario();

			$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
			$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

			$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

			$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

			$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

			$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

			echo "
				<h5 class='text-center text-white'>Minha Pontuação</h5>
				<div class='float-right btnDropdown dropdown'>
		 	 			<span class='text-white'>Ordernar Pontuação por: </span>
		 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
		 	 				Clique
		 	 			</button>
		 	 			<div class='dropdown-menu'>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$g')\">Geral</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$f')\">Fácil</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$m')\">Médio</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$i')\">Insano</a>
		 	 			</div>
		 	 		</div>
				<table class='table table-striped table-hover laranjaEasy'>
					<thead class='thead-dark text-white'>
						<tr>
							<th scope='col'>Posição</th>
			 				<th scope='col'>Usuário</th>
			 				<th scope='col'>Pontuação</th>
			 				<th scope='col'>Estatísticas do Usuário</th>
						</tr>
					</thead>
					<tbody>
			 			<tr class='text-white'>
			 				<th scope='row'>1</th>
		 					<td>$nomeUsuario</td>
		 					<td>$pontuacaoF[PONTUACAO_GERALF]</td>
		 					<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
			 			</tr>
			 		</tbody>
				</table>
			";
		}elseif ($busca == 'm') {
			$pontuacaoM = $quiz->buscarPontuacaoUsuario($codUsuario, 'm');
			$usuario = new Usuario();

			$usuario->loadById($codUsuario);

			$nickUsuario = $usuario->getNick();
			$codUsuario = $usuario->getCodUsuario();

			$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
			$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

			$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

			$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

			$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

			$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

			echo "
				<h5 class='text-center text-white'>Minha Pontuação</h5>
				<div class='float-right btnDropdown dropdown'>
		 	 			<span class='text-white'>Ordernar Pontuação por: </span>
		 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
		 	 				Clique
		 	 			</button>
		 	 			<div class='dropdown-menu'>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$g')\">Geral</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$f')\">Fácil</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$m')\">Médio</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$i')\">Insano</a>
		 	 			</div>
		 	 		</div>
				<table class='table table-striped table-hover laranjaEasy'>
					<thead class='thead-dark text-white'>
						<tr>
							<th scope='col'>Posição</th>
			 				<th scope='col'>Usuário</th>
			 				<th scope='col'>Pontuação</th>
			 				<th scope='col'>Estatísticas do Usuário</th>
						</tr>
					</thead>
					<tbody>
			 			<tr class='text-white'>
			 				<th scope='row'>1</th>
		 					<td>$nomeUsuario</td>
		 					<td>$pontuacaoM[PONTUACAO_GERALM]</td>
		 					<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
			 			</tr>
			 		</tbody>
				</table>
			";
		}elseif ($busca == 'i') {
			$pontuacaoI = $quiz->buscarPontuacaoUsuario($codUsuario, 'i');
			$usuario = new Usuario();

			$usuario->loadById($codUsuario);

			$nickUsuario = $usuario->getNick();
			$codUsuario = $usuario->getCodUsuario();

			$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
			$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

			$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

			$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

			$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

			$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

			echo "
				<h5 class='text-center text-white'>Minha Pontuação</h5>
				<div class='float-right btnDropdown dropdown'>
		 	 			<span class='text-white'>Ordernar Pontuação por: </span>
		 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
		 	 				Clique
		 	 			</button>
		 	 			<div class='dropdown-menu'>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$g')\">Geral</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$f')\">Fácil</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$m')\">Médio</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$i')\">Insano</a>
		 	 			</div>
		 	 		</div>
				<table class='table table-striped table-hover laranjaEasy'>
					<thead class='thead-dark text-white'>
						<tr>
							<th scope='col'>Posição</th>
			 				<th scope='col'>Usuário</th>
			 				<th scope='col'>Pontuação</th>
			 				<th scope='col'>Estatísticas do Usuário</th>
						</tr>
					</thead>
					<tbody>
			 			<tr class='text-white'>
			 				<th scope='row'>1</th>	
		 					<td>$nomeUsuario</td>
		 					<td>$pontuacaoI[PONTUACAO_GERALI]</td>
		 					<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
			 			</tr>
			 		</tbody>
				</table>
			";
		}elseif($busca == 'g'){
			$pontuacaoGeral = $quiz->buscarPontuacaoIndividualGeral($codUsuario);
			$usuario = new Usuario();

			$usuario->loadById($codUsuario);

			$nickUsuario = $usuario->getNick();
			$codUsuario = $usuario->getCodUsuario();

			$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
			$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

			$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

			$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

			$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

			$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

				echo "
					<h5 class='text-center text-white'>Minha Pontuação</h5>
					<div class='float-right btnDropdown dropdown'>
			 	 			<span class='text-white'>Ordernar Pontuação por: </span>
			 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
			 	 				Clique
			 	 			</button>
			 	 			<div class='dropdown-menu'>
			 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$g')\">Geral</a>
			 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$f')\">Fácil</a>
			 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$m')\">Médio</a>
			 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingPessoal('$i')\">Insano</a>
			 	 			</div>
			 	 		</div>
					<table class='table table-striped table-hover laranjaEasy'>
						<thead class='thead-dark text-white'>
							<tr>
								<th scope='col'>Posição</th>
				 				<th scope='col'>Usuário</th>
				 				<th scope='col'>Pontuação</th>
				 				<th scope='col'>Estatísticas do Usuário</th>
							</tr>
						</thead>
						<tbody>
				 			<tr class='text-white'>
				 				<th scope='row'>1</th>
			 					<td>$nomeUsuario</td>
			 					<td>$pontuacaoGeral[PONTUACAOGERAL]</td>
			 					<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
				 			</tr>
				 		</tbody>
					</table>
					";
		}
	}elseif ($modoBusca == 2){
		if($busca == 'f'){
			echo "
				<div>
		 	 		<h5 class='text-center text-white'>Ranking Geral por Dificuldade</h5>
		 	 		<div class='float-right btnDropdown dropdown'>
		 	 			<span class='text-white'>Ordernar Ranking por: </span>
		 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
		 	 				Clique
		 	 			</button>
		 	 			<div class='dropdown-menu'>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$f')\">Fácil</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$m')\">Médio</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$i')\">Insano</a>
		 	 			</div>
		 	 		</div>
		 	 	</div>
			 	<table class='table table-striped table-hover laranjaEasy'>
			 		<thead class='thead-dark text-white'>
			 			<tr>
			 				<th scope='col'>Posição</th>
			 				<th scope='col'>Usuário</th>
			 				<th scope='col'>Pontuação</th>
			 				<th scope='col'>Estatísticas do Usuário</th>
			 			</tr>
			 		</thead>
			 		<tbody>
		 			";

	 				$retorno = $quiz->buscarPontuacaoGeralDificuldade("f");
	 				$posicao = 0;

	 				while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
	 					$posicao = $posicao + 1;


	 					$usuario = new Usuario();

	 					$usuario->loadById($row['COD_USUARIO']);

	 					$nickUsuario = $usuario->getNick();
						$codUsuario = $usuario->getCodUsuario();

	 					$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
	 					$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

	 					$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

	 					$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

	 					$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

	 					$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

	 					echo "
	 							<tr class='text-white'>
	 								<th scope='row'>$posicao</th>
	 								<td>$nickUsuario</td>
	 								<td>$row[PONTUACAO_GERALF]</td>
	 								<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
	 							</tr>
	 						";		
		 			}

		 	echo "	
			 		</tbody>
			 	</table>
				";	
		}elseif($busca == 'm'){
			echo "
				<div>
		 	 		<h5 class='text-center text-white'>Ranking Geral por Dificuldade</h5>
		 	 		<div class='float-right btnDropdown dropdown'>
		 	 			<span class='text-white'>Ordernar Ranking por: </span>
		 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
		 	 				Clique
		 	 			</button>
		 	 			<div class='dropdown-menu'>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$f')\">Fácil</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$m')\">Médio</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$i')\">Insano</a>
		 	 			</div>
		 	 		</div>
		 	 	</div>
			 	<table class='table table-striped table-hover laranjaEasy'>
			 		<thead class='thead-dark text-white'>
			 			<tr>
			 				<th scope='col'>Posição</th>
			 				<th scope='col'>Usuário</th>
			 				<th scope='col'>Pontuação</th>
			 				<th scope='col'>Estatísticas do Usuário</th>
			 			</tr>
			 		</thead>
			 		<tbody>
		 			";

	 				$retorno = $quiz->buscarPontuacaoGeralDificuldade("m");
	 				$posicao = 0;

	 				while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
	 					$posicao = $posicao + 1;

	 					$usuario = new Usuario();

	 					$usuario->loadById($row['COD_USUARIO']);

	 					$nickUsuario = $usuario->getNick();
						$codUsuario = $usuario->getCodUsuario();

	 					$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
	 					$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

	 					$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

	 					$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

	 					$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

	 					$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

	 					echo "
	 							<tr class='text-white'>
	 								<th scope='row'>$posicao</th>
	 								<td>$nickUsuario</td>
	 								<td>$row[PONTUACAO_GERALM]</td>
	 								<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
	 							</tr>
	 						";		
		 			}

		 	echo "	
			 		</tbody>
			 	</table>
				";
		}elseif($busca == 'i'){
			echo "
				<div>
		 	 		<h5 class='text-center text-white'>Ranking Geral por Dificuldade</h5>
		 	 		<div class='float-right btnDropdown dropdown'>
		 	 			<span class='text-white'>Ordernar Ranking por: </span>
		 	 			<button class='btn btn-dark dropdown-toggle' data-toggle='dropdown' type='button'>
		 	 				Clique
		 	 			</button>
		 	 			<div class='dropdown-menu'>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$f')\">Fácil</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$m')\">Médio</a>
		 	 				<a href='#' class='dropdown-item' onclick=\"carregarRankingGeral('$i')\">Insano</a>
		 	 			</div>
		 	 		</div>
		 	 	</div>
			 	<table class='table table-striped table-hover laranjaEasy'>
			 		<thead class='thead-dark text-white'>
			 			<tr>
			 				<th scope='col'>Posição</th>
			 				<th scope='col'>Usuário</th>
			 				<th scope='col'>Pontuação</th>
			 				<th scope='col'>Estatísticas do Usuário</th>
			 			</tr>
			 		</thead>
			 		<tbody>
		 			";

	 				$retorno = $quiz->buscarPontuacaoGeralDificuldade("i");
	 				$posicao = 0;

	 				while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
	 					$posicao = $posicao + 1;


	 					$usuario = new Usuario();

	 					$usuario->loadById($row['COD_USUARIO']);

	 					$nickUsuario = $usuario->getNick();
						$codUsuario = $usuario->getCodUsuario();

	 					$qtdeQuizRespondido = $quiz->buscarQtdeQuizzesRespondidos($codUsuario);
	 					$qtdeQuizRespondido = $qtdeQuizRespondido->fetch(PDO::FETCH_ASSOC);

	 					$perguntasRespondidas = $quiz->buscarQtdePerguntasRespondidas($codUsuario);

	 					$qtdeCorretas = $quiz->buscarQtdePerguntasCorretas($codUsuario);

	 					$qtdeIncorretas = $quiz->buscarQtdePerguntasIncorretas($codUsuario);

	 					$pontuacaoTotal = $quiz->buscarPontuacaoTotal($codUsuario);

	 					echo "
	 							<tr class='text-white'>
	 								<th scope='row'>$posicao</th>
	 								<td>$nickUsuario</td>
	 								<td>$row[PONTUACAO_GERALI]</td>
	 								<td><a href='#' class='card-link text-white' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
	 							</tr>
	 						";		
		 			}

		 	echo "	
			 		</tbody>
			 	</table>
				";
		}
	}
	

 ?>
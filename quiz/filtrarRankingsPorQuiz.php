<?php 

	require_once '../config.php';

	$quiz = new Quiz();

	$codQuiz = $_GET['codquiz'];
	$posicao = 0;

	$buscarQuiz = $quiz->buscarQuiz($codQuiz);
	$buscarQuiz = $buscarQuiz->fetch(PDO::FETCH_ASSOC);


	echo "
			<div id='rankingGeral'>
				<h5 class='text-center text-white'>Pontuação do Quiz: $buscarQuiz[NOME_QUIZ]</h5>
		";
		if($buscarQuiz['DIFICULDADE'] == "F"){
			echo "<h6 class='text-center text-white'>Dificuldade do Quiz: Fácil</h6>";
		}else if($buscarQuiz['DIFICULDADE'] == "M"){
			echo "<h6 class='text-center text-white'>Dificuldade do Quiz: Médio</h6>";
		}else if($buscarQuiz['DIFICULDADE'] == "I"){
			echo "<h6 class='text-center text-white'>Dificuldade do Quiz: Insano</h6>";
		}
	echo "
				<table class='table table-striped table-hover'>
					<thead class='thead-dark text-white'>
						<tr>
							<th scope='col'>Posição</th>
							<th scope='col'>Usuário</th>
							<th scope='col'>Pontuação</th>
							<th scope='col'>Estatísticas do Usuário</th>
						</tr>
					</thead>
					<tbody class='bg-light'>
		";
					$pontuacaoQuiz = $quiz->buscarPontuacaoQuiz($codQuiz);

					while($row = $pontuacaoQuiz->fetch(PDO::FETCH_ASSOC)){
						$posicao = $posicao + 1;

						$usuario = new Usuario();
						$usuario->loadById($row['COD_USUARIO']);
						$nickUsuario = $usuario->getNick();

						echo "
								<tr class='text-dark'>
									<th scope='row'>$posicao</th>
									<td>$nickUsuario</td>
									<td>$row[PONTUACAO]</td>
									<td>Visualizar</td>
								</tr>
							";

					}
		echo "
					</tbody>
				</table>
			</div>
		";

 ?>
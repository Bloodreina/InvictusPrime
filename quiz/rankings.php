<?php 

	require_once '../navegacao/navegacaoDentro.php';
	require_once '../config.php';

	$quiz = new Quiz();

 ?>
 <!DOCTYPE html>
 <html>
	 <head>
	 	<title>Invictus Prime - Rankings</title>
	 	<meta charset="utf-8">
	 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	 	<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
	 	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="../jquery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="estiloVerTemas.css">
		<style>
			.qualTemas{
				display: none;
				overflow: hidden;
			}

			#tese3{
				margin-top: -70px;
				margin-bottom: -50px;
				position: fixed;
			}
		</style>

		<script type="text/javascript">
			function carregarRankingPessoal(busca){
				var modo = 1;
				$.ajax({url: 'filtrarRankings.php?busca='+busca+'&modo='+modo,
					success: function(retorno){
						$('#minhaPontuacao').html(retorno);
					}});
			}
			function carregarRankingGeral(busca){
				var modo = 2;
				$.ajax({url: 'filtrarRankings.php?busca='+busca+'&modo='+modo,
				success: function(retorno){
					$('#rankingGeral').html(retorno);
				}});
			}
			function filtrarPorQuiz(codQuiz){
				$.ajax({url: 'filtrarRankingsPorQuiz.php?codquiz='+codQuiz,
					success: function(retorno){
						$('#divRankings').html(retorno);
					}});
			}
			function filtrarQuizzes(codTema){
				$.ajax({url: 'filtrarQuizPorTema.php?codtema='+codTema,
					success: function(retorno){
						$('#divQuizzes').html(retorno);
					}});
			}
			function carregarModal(nomeUsuario, quizzesRespondidos, perguntasRespondidas, acertos = 0, erros = 0, pontuacao){
				$('#nomeUsuario').html(nomeUsuario);
				$('#quizzesRespondidos').html(quizzesRespondidos);
				$('#perguntasRespondidas').html(perguntasRespondidas);
				$('#acertos').html(acertos);
				$('#erros').html(erros);
				$('#pontosTotal').html(pontuacao);
			}
		</script>

	<script>
		var main = function() {
		 var slide = $('.qualTemas');
		 var press = $('.bt1');
		 
		 press.click(function() {
		   slide.toggle('slow');            
		 });
		}

		

		$(document).ready(main);
	</script>

	 </head>
	 <body>
	 	<center>
		 	<div>
		 		<h4 class="text-white">Nesta sessão é possível ver os Rankings dos usuários, ordenados por Quiz e Geral por dificuldade.</h4>
		 		<div class="imgtrophy">
		 			<img src="../img/trophy3.png">
		 		</div>
		 	</div>
		</center>
			<button class="btn corTrophy bt1" type="button" id="tese3"><img src="../img/points.png"></button>
			<div class="qualTemas">
				<h5 class="text-center text-white">Filtrar Rankings</h5>
				<div class="container">

					<div class="row">
						<div class="card caixaFiltrar">
							<button class="btn corTrophy bt1" type="button"><img src="../img/points.png"></button>
							<div class="card-header bg-dark text-white">

								<h6 class="text-center">Ordenar por:</h6>
								<a href="" class="btn btn-outline-warning btn-block">Pontuação</a>
								<button class="btn btn-outline-warning btn-block dropdown-toggle" data-toggle="dropdown" type="button">Quiz por Tema</button>

								<div class="dropdown-menu">
									<?php 

										$buscarTemas = $quiz->buscarTemas();

										echo "<a href='#' class='dropdown-item' onclick='filtrarQuizzes(0)'>Ordem Alfabética</a>";

										while($row = $buscarTemas->fetch(PDO::FETCH_ASSOC)){
											echo "<a href='#' class='dropdown-item' onclick='filtrarQuizzes($row[COD_TEMA])'>$row[NOME_TEMA]</a>";
										}

									 ?>
								</div>
							</div>
							<div class="card-body text-white bg-dark">
								<h6 class="text-center">Ordenar por Quiz</h6>
								<div id="divQuizzes">

									<?php 

									$rankingQuizAsc = $quiz->buscarQuizRanking();

									while ($row = $rankingQuizAsc->fetch(PDO::FETCH_ASSOC)) {
										echo "
											<a href='#' class='float-right card-link btn btn-outline-warning btn-sm textoVer' onclick='filtrarPorQuiz($row[COD_QUIZ])'>Ver</a>
											<span>$row[NOME_QUIZ]</span>
											<hr>
										";
									}

									 ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="divRankings" class="divRanking">
				<div id="minhaPontuacao">
					<?php 

						if(!isset($_SESSION)){
							session_start();
						}

						if(!isset($_SESSION['valida']) || $_SESSION['valida'] != 'SIM'){

						}else{
							$codUsuario = $_SESSION['cod_usuario'];
							$nomeUsuario = $_SESSION['nome'];
							$f = "f";
							$m = "m";
							$i = "i";
							$g = "g";

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

								<h5 class='text-center text-white puxar'>Minha Pontuação</h5>
								<div class='float-right btnDropdown dropdown'>
						 	 			<span class='text-white puxar2'><strong>Ordernar Pontuação por: </strong></span>
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
									<tbody class='bg-light'>
							 			<tr class='text-secondary'>
							 				<th scope='row'>1</th>
						 					<td>$nomeUsuario</td>
						 					<td>$pontuacaoGeral[PONTUACAOGERAL]</td>
						 					<td><a href='#' class='card-link text-secondary' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
							 			</tr>
							 		</tbody>
								</table>
								";
						}

					 ?>
				</div>

		 	<div id='rankingGeral'>
		 	 	<div>
		 	 		<h5 class="text-center text-white">Ranking Geral por Dificuldade</h5>
		 	 		<div class="float-right btnDropdown dropdown">
		 	 			<span class="text-white"><strong>Ordernar Ranking por: </strong></span>
		 	 			<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" type="button">
		 	 				Clique
		 	 			</button>
		 	 			<div class="dropdown-menu">
		 	 				<a href="#" class="dropdown-item" onclick="carregarRankingGeral('f')">Fácil</a>
		 	 				<a href="#" class="dropdown-item" onclick="carregarRankingGeral('m')">Médio</a>
		 	 				<a href="#" class="dropdown-item" onclick="carregarRankingGeral('i')">Insano</a>
		 	 			</div>
		 	 		</div>
		 	 	</div>
			 	<table class="table table-striped table-hover">
			 		<thead class="thead-dark text-white">
			 			<tr>
			 				<th scope="col">Posição</th>
			 				<th scope="col">Usuário</th>
			 				<th scope="col">Pontuação</th>
			 				<th scope="col">Estatísticas do Usuário</th>
			 			</tr>
			 		</thead>
			 		<tbody class="bg-light">
			 			<?php	 			
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
			 							<tr class='text-secondary'>
			 								<th scope='row'>$posicao</th>
			 								<td>$nickUsuario</td>
			 								<td>$row[PONTUACAO_GERALM]</td>
			 								<td><a href='#' class='card-link text-secondary' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarModal('$nickUsuario', '$qtdeQuizRespondido[QTDE]', '$perguntasRespondidas', '$qtdeCorretas[SOMA]', '$qtdeIncorretas[SOMA]', '$pontuacaoTotal[SOMA]')\">Visualizar</a></td>
			 							</tr>
			 						";
			 				}

			 			 ?>
			 		</tbody>
			 	</table>
			 </div>
		</div>

		<?php require_once '../navegacao/footer.php'; ?>

		<!-- Modal Visualizar -->

		<div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header bg-light">
						<h5>Informações de Resposta</h5>
						<button type="button" class="close" data-dismiss="modal">
							<span class="branco">&times;</span>
						</button>
					</div>
					<div class="modal-body bg-secondary text-light">
						<div class="container-fluid ">
							<div class="row">
								<div class="col-6">
									<strong><span>Usuário:</span></strong>
									<p id="nomeUsuario"></p>
									<strong><span>Quizzes Respondidos:</span></strong>
									<p id="quizzesRespondidos"></p>
									<strong><span>Perguntas Respondidas:</span></strong>
									<p id="perguntasRespondidas"></p>
								</div>
								<div class="col-6">
									<strong><span>Acertos:</span></strong>
									<p id="acertos"></p>
									<strong><span>Erros:</span></strong>
									<p id="erros"></p>
									<strong><span>Pontuação Total:</span></strong>
									<p id="pontosTotal"></p>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-light">
						<button class="btn btn-outline-info btn-lg" data-dismiss="modal">Sair</button>
					</div>	
				</div>
			</div>
		</div>

	 	<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="../bootstrap4/js/bootstrap.min.js"></script>
	 </body>
 </html>
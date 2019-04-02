<?php 
	require_once '../sessions/acesso-adm.php';
	require_once '../navegacao/navegacaoDentro.php';
	require_once '../config.php';

 ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Teste Temas</title>
		<script src="../jquery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="estiloMontarQuiz.css">

		

		<meta charset="utf-8">

		<style type="text/css">
			.comboBox{
				width: 500px;
			}
		</style>

	</head>
	<body>

		<center>
			<div class='divPalavras'>
				<h3 class="text-white">Para criar um Quiz primeiro é preciso escolher um tema.</h3>
				<h5 class="text-white">Abaixo estão as opções de Temas, caso queria um tema que ainda não exista na nossa base de dados, pode pode solicitar um novo Tema <a href="#" data-toggle="modal" data-target="#pedirModal">clicando aqui</a>.</h5>	
			</div>
			
		</center>
				<?php
					$sql = new Sql();

					$resultado = $sql->query("SELECT * FROM tema ORDER BY COD_TEMA");

					
						echo "
							<div class='divPrincipal'>
								<div class='container'>
									<div class='row'>
										<div class='card divTemas float-right'>
											<div class='card-header bg-secondary'>
												<h5 class='text-center text-white'>Selecionar Tema para criar um Quiz</h5>
											</div>

											<div class='card-body bg-light'>
							";
												while($rowResultado = $resultado->fetch(PDO::FETCH_ASSOC)){
													echo "
														<div>
															<div class='text-left'><span>$rowResultado[NOME_TEMA]</span></div>
															<div class='text-right criarQuiz'><a href='montarQuiz.php?codTema=$rowResultado[COD_TEMA]' class='card-link text-info'>Criar Quiz</a></div>
															<hr>		
														</div>
														";
												}
						echo "
											</div>
										</div>
									</div>
								</div>
							</div>
							";
											
							

				?>

				 
			</select>
			<div class="divBtVoltar">
				<center>
					<a href="verTemas.php" class="btVoltar btn btn-info">Voltar aos Quizzes</a>
				</center>
			</div>
		

		<!-- Modal Pedir Tema -->
		<div class="modal fade" tabindex="-1" id="pedirModal" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="adicionarTema" action="gerenciar.act.php">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="Title"><span>Adicionar um Novo Tema</span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<div class="container-fluid">
								<div class="row">
									<div class="col-6">
										<strong><p>Nome do Tema:</p></strong>
										<textarea name="txtAdcNomeTema" rows="2" cols="30" class="form-control"></textarea>
									</div>
									<div class="col-6">
										<strong><span>Descrição do Tema:</span></strong>
										<textarea name="txtAdcDescricaoTema" rows="8" cols="30" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer bg-light">
							<input type="button" name="adcTema" class="btn btn-outline-info" value="Adicionar Tema" onclick="confirma('adicionarTema', 3)">
					</form>
							<button type="button" class="btn btn-outline-info" data-dismiss="modal">Sair</button>
						</div>
				</div>
			</div>
		</div>
		

		<?php 

			require_once '../navegacao/footer.php';

		 ?>
		
		<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="../bootstrap4/js/bootstrap.min.js"></script>
	</body>
</html>
<?php
	if(!isset($_SESSION)){
		session_start();
	}
	require_once '../config.php';
	require_once '../navegacao/navegacaoDentro.php';
	$codQuiz;
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Invictus Prime</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="Content-type" content="text/html" />
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

		<!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="estiloVerTemas.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <script src="../jquery/jquery-3.1.1.min.js"></script>


	    <script>
			function carregar_pagina(codTema, opcao){
				$.ajax({url:'filtrar.php?codTema='+codTema+'&opcao='+opcao,
						success: function(retorno){
							$('#conteudo').html(retorno);
						}});
			}
			function carregarInfo(nomeQuiz, descricao, qtdPergunta, valorQuiz, dtCriacao, atualizacao, codQuiz, autorNick){
				$('#nomeQuiz span').html(nomeQuiz);
				$('#pDesc span').html(descricao);
				$('#pQtdPergunta').html(qtdPergunta);
				$('#pValorQuiz').html(valorQuiz);
				$('#pDtCriacao').html(dtCriacao);
				$('#pAtualizacao').html(atualizacao);
				$("input[name='campoInvisivel']").val(codQuiz);
				$('#pAutorQuiz').html(autorNick);
			}
			function getCodQuiz(){
				return valor;
			}
			function semUsuarioLogado(){
				window.location.href = "../autenticacao/login.php?login=erro5";
			}
			function verificaAutenticacao(){
				alert("Para criar um Quiz você precisa ter uma conta autenticada! Vá ao seu perfil para saber mais.")
			}
		</script>
	</head>
	<body>

		<!--<center>
			<a href="#" class="card-link" data-toggle="modal" data-target="#quizModal">
				Quiz
			</a>
		</center>-->

		<div class="container-fluid">
			<div class="row bg-dark heightRow">
				<div class="col-4">
					<div class="text-center desceImg1">
						<img src="../img/quiz.svg">
					</div>
				</div>

				<div class="col-4">
					<div class="text-center descerImg">
						<img src="../img/bem-vindo.png">
						<h4 class="detalhes corLink text-center text-justify">Para começar basta selecionar um Quiz! Divirta-se</h4>
					</div>
				</div>
					
				<div class="col-4">
					<div class="text-center">
						<img src="../img/lampIdeia.png">
						<h5 class="text-center corLink text-justify">Se deseja criar seu próprio Quiz e ajudar a comunidade de T.I no Brasil a se tornar uma das maiores do mundo clique abaixo.</h5>
						<center>
							<?php 

								if(!isset($_SESSION['cod_usuario'])){
									echo "<a href='#' class='btn btn-md btWidth btn-outline-warning' onclick=\"semUsuarioLogado()\">Criar um Quiz</a>";
								}elseif(isset($_SESSION['cod_usuario'])){
									$codUsuarioAtual = $_SESSION['cod_usuario'];

									$verifyAutentication = new Sql();

									$verificar = $verifyAutentication->query("SELECT AUTENTICACAO FROM usuario WHERE COD_USUARIO = :CODUSUARIO", array(
																			 ":CODUSUARIO"=>$codUsuarioAtual
																			 ));

									if(isset($verificar)){
										$verificar = $verificar->fetch(PDO::FETCH_ASSOC);
										if($verificar['AUTENTICACAO'] == "SIM"){

											echo "<a href='criarQuiz.php' class='btn btn-md btWidth btn-outline-warning'>Criar um Quiz</a>";		
										}else{
											echo "<a href='#' class='btn btn-md btWidth btn-outline-warning' onclick=\"verificaAutenticacao()\">Criar um Quiz</a>";
										}
									}
								}


							 ?>
							
						</center>
						
					</div>
				</div>
			</div>
		</div>
		

	<div class="container-fluid divTableQuiz">
		<div class="row">
			<div class="col-12">
				<div class="branco">
					<h3 class="text-center text-white">Explore nossos Quizzes</h3>
				<center>
					<div class="btn-group">
						<button class="btn btn-secondary" type="button" onclick="carregar_pagina(0, 2)">Mais Acessados</button>
						<button class="btn btn-secondary" type="button" onclick="carregar_pagina(0, 3)">Mais Likes</button>
						<button class="btn btn-secondary" type="button" onclick="carregar_pagina(0, 4)">Recentes</button>
						<button class="btn btn-secondary" type="button" onclick="carregar_pagina(0, 5)">Antigos</button>
						<div class="dropdown">
					        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" type="button">
					            Explore pelos Temas
					        </button>
					        <div class="dropdown-menu">
					        	<a href="#" class="dropdown-item" onclick="carregar_pagina(0, 1)">Alfabética</a>
					        	<?php 

					        		$sql = new Sql();

					        		$retorno = $sql->query("SELECT * FROM tema ORDER BY NOME_TEMA");

					        		while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
					        			echo "
												<a href='#' class='dropdown-item' onclick=\"carregar_pagina('$row[COD_TEMA]', '1')\">$row[NOME_TEMA]</a>
					        				";
					        		}

					        	 ?>
					        </div>
					    </div>
					</div>
				</center>
				
				<div id="central">
				 	<div id="conteudo">
				 		<?php 

				 			$sql = new Sql();

				 			$resultado = $sql->query("SELECT * FROM quiz ORDER BY DT_CRIACAO");

				 				echo "<table class='table table-striped table-hover'>
				 						<thead class='bg-dark text-white'>
											<tr>
												<th scope='col'>Nome do Quiz</th>
												<th scope='col'>Descrição</th>
					 						</tr>	
				 						</thead>
				 						<tbody class='bg-light'>
				 					";

				 			while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
				 				$teste = $row['NOME_QUIZ'];

				 				$quiz = new Quiz();
				 				$retorno = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
				 				$autorQuiz = $retorno->fetch(PDO::FETCH_ASSOC);
				 				$dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
				 				$dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));

				 				echo "
				 					
				 					<tr class='text-dark'>
				 						<th scope='row'>
											<a class='card-link' data-toggle=modal data-target=#quizModal href=responderQuiz.php?q=$row[COD_QUIZ] onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
									 			$row[NOME_QUIZ]
									 		</a>
				 						</th>
									 	<td><font class='text-dark'>$row[DESCRICAO]</font></td>
						  			 </tr>
							  		
						 			";
				 			}
				 			echo "</tbody>
				 				</table>";
				 		 ?>
				 	</div>
				</div>
				</div>
				
			</div>
		</div>
	</div>


			<!-- Modal -->
			<div class="modal fade" id="quizModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">

						<div class="modal-header bg-light">
							<h5 class="modal-title text-dark" id="nomeQuiz"><span>Algo</span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<div class="container-fluid corLink">
								<div class="row">
									<div class="col-6">
										<strong><span>Descrição do Quiz:</span></strong>
										<p id="pDesc"><span>Alo</span></p>
										<strong><p>Data de Criação:</p></strong>
										<p id="pDtCriacao">Data</p>
										<strong><p>Última Atualização:</p></strong>
										<p id="pAtualizacao">Sem Data</p>
									</div>
									<div class="col-6">
										<strong><p>Quantidade de Perguntas:</p></strong>
										<p id="pQtdPergunta">Perguntas</p>
										<strong><p>Valor do Quiz:</p></strong>
										<p id="pValorQuiz">Valor</p>
										<strong><p>Autor do Quiz:</p></strong>
										<p id="pAutorQuiz">Autor</p>
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer bg-light">
							<form method="post" action="responderQuiz.php">
								<input type="hidden" name="campoInvisivel" id="txtCod">
								<span class="text-left text-dark">Deseja testar suas habilidades?</span>
								<button class="btn btn-info">Responder Quiz</button>
							</form>
							<button type="button" class="btn btn-info" data-dismiss="modal">Sair</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 

			require_once '../navegacao/footer.php';

		 ?>

		<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="../bootstrap4/js/bootstrap.min.js"></script>
	</body>
</html>
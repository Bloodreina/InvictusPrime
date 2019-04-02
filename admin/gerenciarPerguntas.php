<?php 
	require_once '../sessions/acesso-adm.php';
	require_once '../navegacao/navegacaoDentro.php';
	require_once '../config.php';
	

	$codQuiz = $_GET['q'];
					
	$quiz = new Quiz();

	$resultado = $quiz->editarPerguntas($codQuiz);
	$resultQuiz = $quiz->buscarQuiz($codQuiz);
	$j = $resultQuiz->fetch(PDO::FETCH_ASSOC);
	$indice = 0;
	$indice1 = 0;

	//Fazer select para obter codigo das perguntas e das respostas
	//Depois
	//Fazer while para listar as Perguntas e respostas;
 ?>
 <!DOCTYPE html>
 <html>
	 <head>
	 	<title>Gerenciar Perguntas - Admin</title>
	 	<meta charset="utf-8">
	 	<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="../jquery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="estiloGerenciar.css">

		<?php require_once '../sessions/acesso-adm.php'; ?>

		<script>
			function carregarInfo(titulo, sub1, codigo, enunciado, codPergunta, codQuiz){
				
				$('#titulo span').html(titulo);
				$('#pCod').html(codigo);
				$("textarea[name='enunciado']").val(enunciado);
				$("input[name='codPergunta1']").val(codPergunta);
				$("input[name='codQuiz1']").val(codQuiz);
			}
			function carregarInfo1(titulo, sub1, codigoAlternativa, enunciado, vf, codQuiz, codPergunta){
				if(vf == 1){
					document.getElementById('verdadeiro').checked = true;
					$('#estadoAtual2').html("Correta");
				}else if(vf == 0){
					document.getElementById('falso').checked = true;
					$('#estadoAtual2').html("Incorreta");
				}
				$('#titulo span').html(titulo);
				$('#tittulo1').html(sub1);
				$('#pCodd').html(codigoAlternativa);
				$("textarea[name='enunciado']").val(enunciado);
				$("input[name='codQuiz']").val(codQuiz);
				$("input[name='codAlternativa']").val(codigoAlternativa);
				$("input[name='codPergunta']").val(codPergunta);
			}
			function carregarAdc(codQuiz){
				$("input[name='codQuizz']").val(codQuiz);
			}
			function confirma(id, opcao){
				if(opcao == 1){
					var confirmar = confirm("Tem certeza que deseja alterar o registro?");
					if(confirmar){
						document.getElementById(id).submit();
					}
				}else if(opcao == 3){
					var confirmar = confirm("Tem certeza que deseja adicionar o registro?");
					if(confirmar){
						document.getElementById(id).submit();
					}
				}
			}
			function excluirAlternativa(url){
				
				var confirmar = confirm("Tem certeza que deseja excluir o registro?");
				if(confirmar){
					window.location = url;
				}
				
			}
		</script>

	 </head>
	 <body id="corpo">
		<div id="divPrincipal" class="bg-light">
			<div id="conteudo1">
				<?php 
					echo "
						<center>
							<h3 class='text-secondary'>Gerenciar as perguntas e suas respectivas respostas:</h3>
							<p class='text-secondary'>Aqui você poderá adicionar, alterar ou excluir perguntas e alternativas. Mas tenha cuidado, pois se excluir uma pergunta suas respectivas alternativas serão automaticamente excluidas com ela, e se excluir alternativas de alguma pergunta e não adicionar novamente para que fique com 4 alternativas no total, está pergunta será invalida e não ficará disponivel no seu Quiz para responder!
							</p>
							<p class='text-secondary'>Você está fazendo alterações no quiz: <strong><span class='font-italic'>$j[NOME_QUIZ]</span></strong></p>
							<h6 class='text-secondary'><span>Para adicionar mais uma pergunta </span><span><a href=# class='card-link text-info' data-toggle='modal' data-target='#adcPergunta' onclick=\"carregarAdc('$codQuiz')\">clique aqui</a></span><span>.</span</h6>
						</center>
						";


					
						while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
							echo "<br/>";
							echo "<table class='table table-striped table-hover'>
									<thead class='thead-dark text-white'>";
									$indice = $indice + 1;

										echo "
											<tr>
												<th><strong>Pergunta</strong></th>
												<th><strong>Enunciado</strong></th>
												<th><strong>Alterar</strong></th>
												<th><strong>Excluir</strong></th>
											</tr>
										</thead>
										<tbody class='bg-light text-dark'>
											<tr>
												<td>$indice</td>
												<td>$row[ENUNCIADO]</td>
												<td><a data-toggle=modal data-target=#alterarModal1 onclick=\"carregarInfo('Alterar Pergunta', 'Código Pergunta: ', '$row[COD_PERGUNTA]', '$row[ENUNCIADO]', '$row[COD_PERGUNTA]', '$codQuiz')\" href='#' class='card-link text-info'>Alterar</td>
												<td><a href='#' onclick=\"excluirAlternativa('gerenciarPerguntas.act.php?p=$row[COD_PERGUNTA]&a=1&c=$codQuiz')\" class='card-link text-info'>Excluir</td>
											</tr>
										</tbody>
									</table>
									";
								
							$result = $quiz->editarAlternativas($row['COD_PERGUNTA']);
							echo "<table class='table table-striped table-hover'>
									<thead class='thead-dark text-white'>	
										<tr>
											<th><strong>Alternativas</strong></th>
											<th><strong>Alterar</strong></th>
											<th><strong>Excluir</strong></th>
										</tr>
									</thead>	
								";
							while($linha = $result->fetch(PDO::FETCH_ASSOC)){

								$outro = $quiz->alternativaCorreta($row['COD_PERGUNTA'], $linha['COD_ALTERNATIVA']);
								$l = $outro->fetch(PDO::FETCH_ASSOC);

								if($l == true){
									echo "
									<tbody class='bg-light text-dark'>
										<tr>
											<td>$linha[ENUNCIADO]</td>
											<td><a data-toggle=modal data-target=#alterarModal2 onclick=\"carregarInfo1('Alterar Alternativa', 'Código Alternativa: ', '$linha[COD_ALTERNATIVA]', '$linha[ENUNCIADO]', '1', '$codQuiz', '$row[COD_PERGUNTA]')\" href='#' class='card-link text-info'>Alterar</td>
											<td><a href='#' onclick=\"excluirAlternativa('gerenciarPerguntas.act.php?p=$linha[COD_ALTERNATIVA]&a=2&c=$codQuiz')\" class='card-link text-info'>Excluir</td>
										</tr>
									</tbody>
									";
								}else{
									echo "
									<tbody class='bg-light text-dark'>
										<tr>
											<td>$linha[ENUNCIADO]</td>
											<td><a data-toggle=modal data-target=#alterarModal2 onclick=\"carregarInfo1('Alterar Alternativa', 'Código Alternativa: ', '$linha[COD_ALTERNATIVA]', '$linha[ENUNCIADO]', '0', '$codQuiz', '$row[COD_PERGUNTA]')\" href='#' class='card-link text-info'>Alterar</td>
											<td><a href='#' onclick=\"excluirAlternativa('gerenciarPerguntas.act.php?p=$linha[COD_ALTERNATIVA]&a=2&c=$codQuiz')\" class='card-link text-info'>Excluir</td>
										</tr>
									</tbody>
									";
								}
								
							}
							
							echo "</table>
								<br/><br/>";
						}
						echo "<center>
								<a href='../perfil.php' class='card-link btn btn-info'>Voltar para seu Perfil</a>
							  </center>"
				 ?>
			</div>
		</div>

		<!-- Modal Alterar Pergunta-->
		<div class="modal fade" id="alterarModal1" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="alterarPergunta" action="gerenciarPerguntas.act.php?y=2">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="titulo"><span></span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">

							<strong><p>Enunciado:</p></strong>
							<textarea name="enunciado" rows="3" cols="80" class='form-control'></textarea>

						</div>

						<div class="modal-footer bg-light">
							<input type="hidden" name="codPergunta1">
							<input type="hidden" name="codQuiz1">
							<input type="button" name="alterar" class="btn btn-outline-info" value="Alterar" onclick="confirma('alterarPergunta', 1)">
					</form>
							<button type="button" class="btn btn-outline-info" data-dismiss="modal">Sair</button>
						</div>
					
				</div>
			</div>
		</div>

		<!-- Modal Alterar Alternativa-->
		<div class="modal fade" id="alterarModal2" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="alterarAlternativa" action="gerenciarPerguntas.act.php?y=1" name="form1">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="titulo"><span></span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<div class="container-fluid">
								<div class="row">
									<div class="col-6">
										<strong><span id="tittulo1"></span></strong><span id="pCodd"></span>
									</div>
									<div class="col-6">
										<strong><span>Estado Atual: </span></strong><span id="estadoAtual2"></span><br><br>
										<strong><span>Mudar para:</span></strong><br>
										<label class="radio-inline"><input type="radio" name="opRadio" id="verdadeiro" value="Correta">Correta</label>
										<label class="radio-inline"><input type="radio" name="opRadio" id="falso" value="Incorreta">Incorreta</label>
									</div>
								</div>
							</div>



							<strong><p>Enunciado:</p></strong>
							<textarea name="enunciado" rows="3" cols="80" class='form-control'></textarea>

						</div>

						<div class="modal-footer bg-light">
							<input type="hidden" name="codQuiz">
							<input type="hidden" name="codAlternativa">
							<input type="hidden" name="codPergunta">
							<input type="button" name="alterar" class="btn btn-outline-info" value="Alterar" onclick="confirma('alterarAlternativa', 1)">
					</form>
							<button type="button" class="btn btn-outline-info" data-dismiss="modal">Sair</button>
						</div>
					
				</div>
			</div>
		</div>

		<!-- Modal Adcionar Pergunta/Alternativa-->
		<div class="modal fade" id="adcPergunta" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="adcPerguntaForm" action="adicionarPerguntas.php" name="form1">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="titulo"><span>Adicionar Pergunta</span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<strong><span>Enunciado da Pergunta:</span></strong>
							<br><br>
							<textarea name="enunciadoAdc" rows="2" cols="84" class="form-control"></textarea>
							<br><br>

							<div class="container-fluid">
								<div class="row">
									<div class="col-6">
										<strong><span>Alternativa Correta:</span></strong><br>
										<textarea name="aCorreta" rows="1" cols="30" class="form-control"></textarea><br> 
										<strong><span>Alternativa Incorreta 1:</span></strong><br>
										<textarea name="aIncorreta1" rows="1" cols="30" class="form-control"></textarea><br>
									</div>
									<div class="col-6">
										<strong><span>Alternativa Incorreta 2:</span></strong><br>
										<textarea name="aIncorreta2" rows="1" cols="30" class="form-control"></textarea><br>
										<strong><span>Alternativa Incorreta 3:</span></strong><br>
										<textarea name="aIncorreta3" rows="1" cols="30" class="form-control"></textarea><br>
									</div>
								</div>
							</div>

						</div>

						<div class="modal-footer bg-light">
							<input type="hidden" name="codQuizz">
							<input type="button" name="adcPerguntabt" class="btn btn-outline-info" value="Adicionar Pergunta" onclick="confirma('adcPerguntaForm', 3)">
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
	    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="../bootstrap4/js/bootstrap.min.js"></script>
	 </body>
 </html>
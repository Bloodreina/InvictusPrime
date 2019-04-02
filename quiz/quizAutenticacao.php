<?php 

	require_once '../sessions/validador-acesso.php';	
	require_once '../navegacao/navegacaoDentro.php';
	$index = 0;
	$numero = 0;
 ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Responder Quiz</title>
        <meta charset="utf-8">
		<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="../jquery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="estiloVerQuiz.css">

		<script type="text/javascript">
		
		$(document).ready(function(e) { 
			/*
			$('#form-respostas').submit(function(e){
				e.preventDefault();

				$.ajax({
					url: 'responderQuiz.act.php',
					data: new FormData( this ),
					type: 'POST',
					processData: false,
					contentType: false,
					success: function(retorno){
						document.getElementById('divCorrigir').style.display = "none";
						$('#resp').html(retorno);
						$("input[type=radio]").attr({disabled: true});
						$('#btClick').click();
					},
					error:function(error){
						console.log("erro: "+error);
					}
				});
			});
        	*/
			$('.respInputs').click(function(e) {
				
				retirar = $(this).attr('name');
                $("input[name="+retirar+"]").each(
			    	function() {
						$(this).parent().parent().parent().css('background-color','white');
						$(this).parent().parent().parent().parent().css('background-color','white');
       				}
				);
				$(this).parent().parent().parent().css('background-color','#CBCAD0');
				
				/*
				$(this).parent().parent().parent().css('background-color','orange');
				$('input:not(checked)').css('background-color','white');
						
				
				retirar = $(this).attr('name');
				quem = document.getElementsByName(retirar).length;
				console.log("retirar = "+quem);
				*/
            });



            
	
			
		});
			function desabilitarLike(){
				$('#like').attr('disabled', 'disabled');
			}

			function addLike(codQuiz){
				var cod = codQuiz;
            	/*$.ajax({
            		url: 'addLike.php?quiz'+codQuiz, type: 'GET', success: function(retorno){
            			console.log(retorno);
            		} 
            	});*/
            	$.get("addLike.php", {codQuiz: cod}, function(retorno){
            		console.log(retorno);
            	})

            	this.desabilitarLike();
            }
		
			function carregarModal(nomeUsuario, nomeQuiz, qtdP, qtdPC, qtdPI, pontos){
				$('#nomeUsuario').html(nomeUsuario);
				$('#nomeQuiz').html(nomeQuiz);
				$('#qtdPerguntas').html(qtdP);
				$('#qtdCorretas').html(qtdPC);
				$('#qtdIncorretas').html(qtdPI);
				$('#pontos').html(pontos);

				$('#modal-correcao').modal('show');
			}
			function pintarCorretas(qtdPergunta){
				for (var i = 1; i <= qtdPergunta; i++) {
					$('#correta'+i).parent().parent().parent().css('background-color', '#2FB451');
					$('#correta'+i).parent().parent().parent().parent().css('background-color', '#2FB451');
				}
			}
			
			
			
		</script>
	<style>

	
	</style>
	</head>
	<body>
			<div class="text-center divTitulo"></div>	
		<div id=central class="text-center bg-dark">
			<span id="logoInvictus" class="text-white">Invictus</span><span id="prime" class="text-white">Prime</span>
			<?php
				
				require_once '../config.php';

				$codQuiz = 1;

				$quiz = new Quiz();

				$sql = new Sql();

				$resultado = $sql->select("SELECT * FROM pergunta_autenticacao");
				$qtdPerguntas = 7;

				echo "
					<div class='divQuiz'>
						<h4 class='text-white text-center'>Você está respondendo: <strong>Quiz de Autenticação</strong>.</h4>
					</div>
					<div class='pPerguntas'>
						<p class='text-center text-white text-justify'>Algumas dicas:</p>
						<p class='text-center text-white text-justify'><strong>1</strong>- Leia atentamente a pergunta para entendimento completo.</p>
						<p class='text-center text-white text-justify'><strong>2</strong>- Escolha sua resposta com sabedoria, poís só é possivel uma resposta por pergunta.</p>
						<p class='text-center text-white text-justify'><strong>3</strong>- Ao responder todas as perguntas, clique no botão enviar ao fim do Quiz para ver sua pontuação.</p>
						<h4 class='text-white text-center'>Boa Sorte!</h4>
					</div>
					";

				echo "<form name='formPerguntas' method='post' action='respostasAutenticacao.php' enctype='multipart/form-data' id='form-respostas'>";
						echo "<div class='container span-espaco'>";
							echo "<div class='row'>";
								echo "<div id='cardPrincipal'>";
									echo "<div class='card bg-dark'>";
										foreach($resultado as $row){
											foreach($row as $key => $value){
												if($key == "COD_PERGUNTA"){
													$codPergunta = $value;
													echo "<input type='hidden' name='codpergunta' value='$codPergunta'>";
												}

													if($key == "ENUNCIADO"){
														$index = $index + 1;
														$numero +=1;
															echo "<div class='card-header teste text-white text-left bg-info'>";
																echo "<h5><strong>".$index. "- " .$value."</strong></h5>";
															echo "</div>";

															echo "<div class='card-body'>";
																	if($codPergunta == 6 || $codPergunta == 7){
																		echo "<textarea name='txt$index' class='form-control'></textarea>";
																	}else{
																		$alternativas = $sql->select("SELECT * FROM alternativa_autenticacao WHERE COD_PERGUNTA = :CODPERGUNTA", array(
																									 ":CODPERGUNTA"=>$codPergunta
																									 ));
																		foreach($alternativas as $row){
																			foreach ($row as $key => $value) {
																				if($key == "COD_ALTERNATIVA"){
																					$codAlternativa = $value;
																				}
																				if($key == "ENUNCIADO"){
																					echo "<label class='todoEspaco respInputs'>";
																						echo "<div class='card mb-3 text-black bordas'>";	
																							echo "
																								<div class='radio text-left'>
																									<span>
																										<label class='respInputs'>
																								";
																										echo "
																											<input type='radio' name='questao$index' class='respInputs' value='$codAlternativa'>
																											$value
																											";
																										echo "
																										
																									</label>
																								</span>
																							</div>
																							";
																					echo "</div>";
																				echo "</label>";
																				}
																			}
																		}
																	}
															echo "</div>";

															echo "<div class='card-footer'>
																  </div>";
													}			
											}
										}
									echo "</div>";
								echo "</div>";
							echo "</div>";
								echo "<div id='divCorrigir'><button id='btnCorrigir' class='card-link btn btCorrigir btn-outline-info btn-espaco btn-lg'>Enviar Respostas</buttton></div>";
						echo "</div>";
				echo "</form>"; 
				echo "<div id='resp'></div>"
				
	 		?>
		</div>

		<?php require_once '../navegacao/footer.php'; ?>

		<!-- Modal Correção -->

	 	<div class="modal fade" id="modal-correcao" tabindex="-1" role="dialog">
	 		<div class="modal-dialog modal-lg" role="document">
	 			<div class="modal-content">
	 				<div class="modal-header bg-light">
	 					<h5 class="text-dark">Informações - Resultado</h5>
	 					<button type="button" class="close" data-dismiss="modal">
							<span class="branco">&times;</span>
						</button>
	 				</div>
	 				<div class="modal-body bg-secondary">
	 					<div class="container-fluid">
	 						<div class="row text-light">
	 							<div class="col-6">
	 								<strong><span>Usuário</span></strong>
	 								<p id="nomeUsuario"></p>
	 								<strong><span >Quiz</span></strong>
	 								<p id="nomeQuiz"></p>
	 								<strong><span >Quantidade de Perguntas</span></strong>
	 								<p id="qtdPerguntas"></p>
	 							</div>
	 							<div class="col-6">
	 								<strong><span >Perguntas Corretas</span></strong>
	 								<p id="qtdCorretas"></p>
	 								<strong><span >Perguntas Incorretas</span></strong>
	 								<p id="qtdIncorretas"></p>
	 								<strong><span >Total de Pontos</span></strong>
	 								<p id="pontos"></p>
	 							</div>
	 						</div>
	 					</div>
	 				</div>
	 				<div class="modal-footer bg-light">
	 					<a href="rankings.php" class="btn btn-outline-info btn-md">Ver Rankings</a>
	 					<button class="btn btn-outline-info btn-md" data-dismiss="modal">Conferir Respostas</button>
	 					<a href="verTemas.php" class="btn btn-outline-info btn-md">Voltar para Quizzes</a>
	 				</div>
	 			</div>
	 		</div>
	 	</div>

		<!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="../bootstrap4/js/bootstrap.min.js"></script>
	</body>
</html>


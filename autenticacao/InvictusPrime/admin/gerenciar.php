<?php 
	require_once '../sessions/acesso-adm.php';
	require_once '../navegacao/navegacaoDentro.php';
	require_once '../config.php';

 ?>
 <!DOCTYPE html>
	<html>
	<head>
		<title>Configurar - Admin</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="../jquery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="estiloGerenciar.css">

		<script>
			$(document).ready(function(e) {
				if ($("input[type='radio'][name='opRadio']").is(':checked')) {
					gerenciarItens(1);
				}
			});
			function gerenciarItens(opcao){
				$.ajax({url:'filtrar.php?opcao='+opcao,
						success: function(retorno){
							console.log(opcao);
							$('#conteudo').html(retorno);
						}});
			}
			function carregarInfo(codUsuario, emailUsuario, nickname, autenticacao, acesso, fotoUsuario){
				console.log("aloo");
				$("input[name='txtCod']").val(codUsuario);
				$('#pCodUsuario').html(codUsuario);
				$("input[name='txtEmail']").val(emailUsuario);
				$("input[name='txtNick']").val(nickname);
				$("input[name='txtAutenticacao']").val(autenticacao);
				$("input[name='txtAcesso']").val(acesso);
				$("input[name='eCod']").val(codUsuario);
				img.src = fotoUsuario;
			}
			function carregarInfo1(codQuiz, nomeQuiz, descricao, qtdPergunta, valor, dtC, dtA, dificuldade, autorQuiz){
				$("input[name='txtCodigo']").val(codQuiz);
				$('#pCodQuiz').html(codQuiz);
				$("input[name='eCod']").val(codQuiz);
				$("input[name='txtNomeQuiz']").val(nomeQuiz);
				$("textarea[name='txtDescricao']").val(descricao);
				$("input[name='txtPergunta']").val(qtdPergunta);
				$("#pValor").html(valor);
				$("#pDtC").html(dtC);
				$("#pDtA").html(dtA);
				if(dificuldade == "F"){
					$("#sub4").html("Dificuldade Atual: Fácil");
				}else if(dificuldade == "M"){
					$("#sub4").html("Dificuldade Atual: Médio");
				}else if(dificuldade == "I"){
					$("#sub4").html("Dificuldade Atual: Insano");
				}
				$("input[name='txtDtA']").val(dtC);
				$("input[name='txtDtC']").val(dtA);
				$("#pAutorQuiz").html(autorQuiz);
			}
			function carregarInfo2(codTema, nomeTema, descricao){
				$('#pcodtema').html(codTema);
				$("textarea[name='txtnometema']").val(nomeTema);
				$("textarea[name='txtdescricaotema']").val(descricao);
				$("input[name='ptxtcodTema']").val(codTema);
				$("input[name='eCodTema']").val(codTema);
			}
			function confirma(id, opcao){
				if (opcao == 1) {
					var confirmar = confirm("Tem certeza que deseja alterar o registro?");
					if(confirmar){
						document.getElementById(id).submit()
					}
				}else if(opcao == 2){
					var confirmar = confirm("Tem certeza que deseja excluir o registro?");
					if(confirmar){
						document.getElementById(id).submit()
					}
				}else if(opcao == 3){
					var confirmar = confirm("Tem certeza que deseja adicionar esse tema?");
					if(confirmar){
						document.getElementById(id).submit()
					}
				}
			}
		</script>
	</head>
	<body id="corpo">

		<center>
			<h3 class="branco">Escolha um dos tópicos para gerenciar:</h3>
			<form>
				<label class="radio-inline branco"><input type="radio" name="opRadio" checked onclick="gerenciarItens(1)">Gerenciar Usuários</label>
				<label class="radio-inline branco"><input type="radio" name="opRadio" onclick="gerenciarItens(2)">Gerenciar Quizzes</label>
				<label class="radio-inline branco"><input type="radio" name="opRadio" onclick="gerenciarItens(3)">Gerenciar Temas</label>
			</form>
			<h6 class="branco"><span>Ou se preferir gere um relatório geral dos dados do InvictusPrime </span><span><a href="relatorio.php" class="card-link">Clicando aqui</a></span><span>.</span></h6>
			
		</center>

		<div id="central">
			<div id="conteudo">
			</div>
		</div>

		<!-- Modal Usuarios -->
		<div class="modal fade" id="gerenciarModal1" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="alterarUsuario" action="gerenciar.act.php">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="Titulo"><span>Gerenciar Usuários</span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<div class="container-fluid">
								<div class="row">
									<div class="col-6">
										<strong id="subTitulo1"><span>Código Usuário:</span></strong>
										<input type="hidden" name="txtCod">
										<p id="pCodUsuario"><span></span></p>
										<strong><p id="subTitulo2">E-mail Usuário:</p></strong>
										<input type="text" name="txtEmail" size="35" class="form-control">
										<strong><p id="subTitulo2">Foto Usuário:</p></strong>
										<img src="" class="img-thumbnail"><br>
										<input type="file" name="foto" id="foto">
									</div>
									<div class="col-6">
										<strong><p id="subTitulo3">Nickname Usuário:</p></strong>
										<input type="text" name="txtNick" size="35" class="form-control">
										<strong><p id="subTitulo4">É Autenticado?:</p></strong>
										<input type="text" name="txtAutenticacao" size="35" class="form-control">
										<strong><p id="subTitulo5">Acesso :</p></strong>
										<input type="text" name="txtAcesso" class="form-control">
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer bg-light">
							<input type="button" name="alterar" class="btn btn-outline-info" value="Alterar" onclick="confirma('alterarUsuario', 1)">
					</form>
						<form method="post" id="excluirUsuario" action="gerenciar.act.php?q=1">
							<input type="hidden" name="eCod">
							<input type="button" name="excluir" class="btn btn-outline-info" value="Excluir" onclick="confirma('excluirUsuario', 2)">
						</form>
							<button type="button" class="btn btn-outline-info" data-dismiss="modal">Sair</button>
						</div>
					
				</div>
			</div>
		</div>

		<!-- Modal Quiz -->
		<div class="modal fade" id="gerenciarModal2" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="alterarQuiz" action="gerenciar.act.php">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="Title"><span>Gerenciar Quiz</span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<div class="container-fluid">
								<div class="row">
									<div class="col-6">
										<strong id="sub1"><span>Código Quiz:</span></strong>
										<input type="hidden" name="txtCodigo"  class="form-control">
										<p id="pCodQuiz"><span>Alo</span></p>
										<strong><p id="sub2">Nome do Quiz:</p></strong>
										<input type="text" name="txtNomeQuiz" size="35"  class="form-control">
										<strong><p>Autor do Quiz:</p></strong>
										<p id="pAutorQuiz">Autor</p>
										<strong><p id="sub3">Descrição:</p></strong>
										<textarea name="txtDescricao" rows="5" cols="37"  class="form-control">alo:</textarea>
									</div>
									<div class="col-6">
										<strong><p id="sub4">Dificuldade:</p></strong>
										<select name="dificuldade" class="form-control">
											<option>Mudar Dificuldade</option>
											<option value="F">Fácil</option>
											<option value="M">Médio</option>
											<option value="I">Insano</option>
										</select>
										<strong><p id="sub4">Quantidade de Perguntas:</p></strong>
										<input type="text" name="txtPergunta"  class="form-control">
										<strong><p id="sub5">Valor do Quiz:</p></strong>
										<p id="pValor"><span>Alo</span></p>
										<strong><p id="sub6">Data de Criação:</p></strong>
										<p id="pDtC"><span>Alo</span></p>
										<input type="hidden" name="txtDtC">
										<strong><p id="sub7">Ultima Atualização:</p></strong>
										<p id="pDtA"><span>Alo</span></p>
										<input type="hidden" name="txtDtA">
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer bg-light">
							<input type="button" name="alterar" class="btn btn-outline-info" value="Alterar" onclick="confirma('alterarQuiz', 1)">
					</form>
						<form method="post" id="excluirQuiz" action="gerenciar.act.php?q=2">
							<input type="hidden" name="eCodTema">
							<input type="button" name="excluir" class="btn btn-outline-info" value="Excluir" onclick="confirma('excluirQuiz', 2)">
						</form>
							<button type="button" class="btn btn-outline-info" data-dismiss="modal">Sair</button>
						</div>
					
				</div>
			</div>
		</div>
		
		<!-- Modal Temas -->
		<div class="modal fade" id="gerenciarModal3" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<form method="post" id="alterarTema" action="gerenciar.act.php">
						<div class="modal-header bg-light">
							<h5 class="modal-title" id="Title"><span>Gerenciar Tema</span></h5>
							<button type="button" class="close" data-dismiss="modal">
								<span class="branco">&times;</span>
							</button>
						</div>

						<div class="modal-body bg-secondary">
							<div class="container-fluid">
								<div class="row">
									<div class="col-6">
										<strong><p>Código do Tema:</p></strong>
										<p id="pcodtema"></p>
										<input type="hidden" name="ptxtcodTema">
										<strong><p>Nome do Tema:</p></strong>
										<textarea name="txtnometema" rows="2" cols="30" class="form-control"></textarea>
									</div>
									<div class="col-6">
										<strong><span>Descrição do Tema:</span></strong>
										<textarea name="txtdescricaotema" rows="8" cols="30" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer bg-light">
							<input type="button" name="alterar" class="btn btn-outline-info" value="Alterar" onclick="confirma('alterarTema', 1)">
					</form>
						<form method="post" id="excluirTema" action="gerenciar.act.php?q=3">
							<input type="hidden" name="eCodTema">
							<input type="button" name="excluir" class="btn btn-outline-info" value="Excluir" onclick="confirma('excluirTema', 3)">
						</form>
							<button type="button" class="btn btn-outline-info" data-dismiss="modal">Sair</button>
						</div>
					
				</div>
			</div>
		</div>

		<!-- Modal Adc Tema -->
		<div class="modal fade" id="gerenciarModal4" tabindex="-1" role="dialog">
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
	    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	    <script src="../bootstrap4/js/bootstrap.min.js"></script>
	</body>
 </html>
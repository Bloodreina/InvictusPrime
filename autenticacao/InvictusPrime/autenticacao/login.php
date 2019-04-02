<!DOCTYPE html>
<html>
<head>
	<title>Entrar</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="estiloLogin.css">
</head>
<body>

	<div id="divTitulo">
		<span id="invictus">Invictus</span>
		<span id="prime">Prime</span>
	</div>

	<div id="divPrincipal">

		<div class="container">
			<div class="row">
				<div class="cardLogin">
					<div class="card">
						<div class="card-header text-center bg-secondary">
							<span id="spanEntrar">Entrar</span>
						</div>

						<div class="card-body bg-light">
							<form method="post" action="entrar.php">
								<div class="form-group">
									<input type="email" required="required" name="email" class="form-control" placeholder="E-mail">
								</div>
								<div class="form-group">
								<input type="password" required="required" name="senha" class="form-control" placeholder="Senha">
								</div>
								<div class="form-check">
							    	<input type="checkbox" class="form-check-input" id="lembrarDeMim">
							    	<label class="form-check-label text-dark" for="lembrarDeMim">Lembre-se de mim</label>
								</div>

								<?php  if(isset($_GET['login']) && $_GET['login'] == 'erro'){ ?>
	                   
				                    <div class="text-danger text-center">
				                      Usuário ou senha inválido(s)
				                    </div>

				                  <?php } ?>

				                  <?php  if(isset($_GET['login']) && $_GET['login'] == 'erro2'){ ?>
				                   
				                    <div class="text-danger text-center">
				                      Faça login antes de acessar as páginas protegidas!
				                    </div>

				                <?php } ?>

				                <?php  if(isset($_GET['login']) && $_GET['login'] == 'erro3'){ ?>
				                   
				                    <div class="text-danger text-center">
				                      Você não tem permissão para Acessar essa página!
				                    </div>

				                <?php } ?>

				                <?php  if(isset($_GET['login']) && $_GET['login'] == 'erro4'){ ?>
				                   
				                    <div class="text-danger text-center">
				                      Você precisar ter sua conta autenticada para criar um Quiz!
				                    </div>

				                <?php } ?>

				                <?php  if(isset($_GET['login']) && $_GET['login'] == 'erro5'){ ?>
				                   
				                    <div class="text-danger text-center">
				                      Para executar esta ação você precisa estar logado!
				                    </div>

				                <?php } ?>

								 <button class="btn btn-lg btn-info btn-block text-white" id="btEntrar">Entrar</button>
							</form>
						</div>

						<div class="card-footer bg-secondary">
							<a href="redefinirSenha.php" class="card-link flutuarEsquerda text-light">Esqueci minha senha</a>
							<a href="register.php" class="card-link flutuarDireita text-light">Cadastrar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../bootstrap4/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<title>Redefinir Senha</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="estiloNovaSenha.css">
	</head>
	<body>

		<?php 

			$chave = "";

			if(@$_GET["chave"]){
				$chave = preg_replace('/[^[:alnum:]_.-@]/', '', $_GET["chave"]);
			}

		 ?>

		<div id="divTitulo">
			<span id="invictus">Invictus</span>
			<span id="prime">Prime</span>
		</div>

		<div id="divPrincipal">


		<div class="container">
			<div class="row">
				<div class="cardLogin">
					<div class="card laranjaEasy">
						<div class="card-header text-center">
							<span id="spanEntrar">Redifinir Senha</span>
						</div>

						<div class="card-body">
							<form method="post" action="setNovaSenha.php">
								<input type="hidden" name="chave" value="<?php echo $chave; ?>"/>
								<div class="form-group">
									<input type="text" name="email" class="form-control" placeholder="E-mail">
								</div>
								<div class="form-group">
									<input type="password" name="senha" class="form-control" placeholder="Nova Senha">
								</div>
								<div class="form-group">
									<input type="password" name="confSenha" class="form-control" placeholder="Confirmar Nova Senha">
								</div>

								<button class="btn btn-lg btn-dark btn-block">Enviar</button>
							</form>
						</div>

						<div class="card-footer text-center">
							<a href="login.php" class="card-link text-light">Voltar</a>
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
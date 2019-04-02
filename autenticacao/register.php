<!DOCTYPE html>
<html>
	<head>
		<title>Cadastrar</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="estiloCadastro.css">
	</head>
	<body>

		<div id="divTitulo">
			<span id="invictus">Invictus</span>
			<span id="prime">Prime</span>
		</div>

		<div id="divPrincipal">

			<div class="container">
			 	<div class="row">
			 		<div class="cardRegister">
			 			<div class="card">
			 				<div class="card-header text-center text-light bg-secondary">
			 					<span id="spanCadastrar">Cadastrar</span>
			 				</div>
			 				<div class="card-body bg-light">
			 					<form method="post" action="cadastrar.php">
			 						<div class="form-group">
			 							<input class="form-control" type="text" required="required" name="nick" placeholder="Nickname">
			 						</div>
			 						<div class="form-group">
			 							<input class="form-control" type="email" required="required" name="email" placeholder="E-mail">
			 						</div>
			 						<div class="form-group">
			 							<input class="form-control" type="password" required="required" name="senha" placeholder="Senha">
			 						</div>
			 						<div class="form-group">
			 							<input class="form-control" type="password" required="required" name="conf_senha" placeholder="Confirmar Senha">
			 						</div>
			 						<div class="form-group">
			 							<label for="selectAreaAtuacao" class="branco">Área de Atuação</label>
			 							<select class="form-control" id="selectAreaAtuacao" required="required" name="areaAtuacao">
			 								<option>Selecione sua área de trabalho</option>
			 								<?php

			 									require_once '../config.php';
			 									
			 									$sql = new Sql();
			 									$resultado = $sql->query("SELECT * FROM area_atuacao ORDER BY COD_AREA");

			 									while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
			 								?>

			 									<option value="<?php echo $row['COD_AREA']; ?>">
			 										<?php echo $row['NOME_AREA']; ?>
			 									</option>

			 								<?php 		
			 									}
			 								?>
			 							</select>
			 						</div>

			 						<button class="btn btn-lg btn-info btn-block text-white">Cadastrar</button>
			 					</form>
			 				</div>
			 				<div class="card-footer text-center bg-secondary">
			 					<a href="login.php" class="card-link text-light">Já Possui um conta?</a>
			 				</div>
			 			</div>
			 		</div>
			 	</div>
			</div>

		</div>
	</body>
</html>
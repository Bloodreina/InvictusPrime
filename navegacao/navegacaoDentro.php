<?php 
	if(!isset($_SESSION)){
		session_start();
	}
 ?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript">
			function logoff($boll){
				if($boll == true){
					window.location.href = "autenticacao/logoff.php";
				}else{
					window.location.href = "../autenticacao/logoff.php";
				}
			}
		</script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-light">
			
			<!-- Logo -->
			<a href="../index.php" class="navbar-brand">
				<span id="logoInvictus">Invictus</span><span id="prime">Prime</span>
			</a>

			<!-- Menu Hamburguer -->
	        <button class="navbar-toggler bg-dark" style="border: none;" data-toggle="collapse" data-target="#navegacao">
	            <span><i class="fa fa-bars fa-1x" id="btMenu"></i></span>
	        </button>

	        <!-- Navegacao -->
	        <div class="collapse navbar-collapse" id="navegacao">
	            <ul class="navbar-nav ml-auto">
	                <li class="nav-item">
	                    <a href="../index.php" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>PÁGINA INICIAL</span></button></a>
	                </li>
	                <li class="nav-item">
	                    <a href="../duvida/duvida.php" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>DÚVIDA</span></button></a>
	                </li>
	                <li class="nav-item">
	                    <a href="../quiz/verTemas.php" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>VER QUIZZES</span></button></a>
	                </li>
	                <li class="nav-item">
		                <a href="../quiz/rankings.php" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>RANKINGS</span></button></a>
		            </li>
	                <li class="nav-item">
	                    <a href="../perfil.php" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>MEU PERFIL</span></button></a>
	                </li>
	                <li class="nav-item">
	                    
						<?php 

		                	if(!isset($_SESSION['valida']) || $_SESSION['valida'] != 'SIM'){
		                ?>
		                		<a href="../autenticacao/login.php" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>ENTRAR</span></button></a>
		                <?php
		                	}else{
		                ?>		
		                		<a data-toggle="modal" data-target="#modalLogoff" href="" class="nav-link text-light"><button class="btn btn-sm btn-info" type="button"><span>LOGOFF</span></button></a>
		                <?php
		                	}

		                 ?>

	                </li>
	            </ul>
	        </div>

		</nav>

		<!-- Modal Logoff -->
		<div class="modal fade" id="modalLogoff" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h5>Deseja mesmo fazer o Logoff?</h5>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-6">
									<button class="btn btn-bg btn-dark btn-block" onclick="logoff(false)">Sim</button>
								</div>
								<div class="col-6">
									<button class="btn btn-bg btn-dark btn-block" data-dismiss="modal">Não</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
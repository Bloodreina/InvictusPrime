<?php 

	if(!isset($_SESSION)){
		session_start();
	}
	if (!isset($_SESSION['valida']) || $_SESSION['valida'] != 'SIM') {
		header('Location: ../autenticacao/login.php?login=erro2');
	}else if($_SESSION['autenticacao'] != 'SIM'){
?>
	<!DOCTYPE html>
	<html>
		<head>
			<style type="text/css">
				.modal-backdrop{
					opacity: 1 !important;
				}
			</style>

			<script type='text/javascript'>
				$(document).ready(function(e) {
				    $('#modalNaoAutenticado').modal('show');
				});

				function pedirAutenticacao(){
					window.location.href = "../index.php";
				}
				function sair(){
					window.history.back();		
				}
			</script>
		</head>
		<body>
			<div class='modal fade' data-backdrop="static" id="modalNaoAutenticado" tabindex='-1' role='dialog'>
				<div class='modal-dialog modal-sm modal-backdrop' role='document'>
					<div class='modal-content'>
						<div class='modal-header text-center'>
							<h5>Você não tem a autenticação necessária para criar Quizzes, deseja pedir essa autenticação?</h5>
						</div>
						<div class='modal-body'>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-6'>
										<button class='btn btn-bg btn-dark btn-block' onclick='pedirAutenticacao()'>Sim</button>
									</div>
									<div class='col-6'>
										<button class='btn btn-bg btn-dark btn-block' onclick="sair()">Não</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</body>
	</html>
		

<?php	
	}

 ?>
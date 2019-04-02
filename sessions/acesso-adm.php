<?php 

	if(!isset($_SESSION)){
		session_start();
	}

	if (!isset($_SESSION['valida']) || $_SESSION['valida'] != 'SIM') {
			header('Location: ../autenticacao/login.php?login=erro2');
	}else if($_SESSION['acesso'] != 1){
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
				    $('#modalAdmin').modal('show');
				});
				function sair(){
					window.history.back();		
				}
			</script>
		</head>
		<body>
			<div class='modal fade' data-backdrop="static" id='modalAdmin' tabindex='-1' role='dialog'>
				<div class='modal-dialog modal-sm modal-backdrop' role='document'>
					<div class='modal-content'>
						<div class='modal-header text-center'>
							<h5>Você não tem permissão para acessar essa página!</h5>
						</div>
						<div class='modal-body'>
							<button class="btn btn-dark btn-bg btn-block" onclick="sair()">OK</button>
						</div>
					</div>
				</div>
			</div>
			
		</body>
	</html>

<?php
	}

 ?>
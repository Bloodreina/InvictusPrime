<?php
    if(!isset($_SESSION)){
        session_start();
    }
	require_once '../navegacao/navegacaoDentro.php';
	require_once '../config.php';

 ?>

 	<title>InvictusPrime - Dúvida</title>
 	<link rel="stylesheet" type="text/css" href="estiloDuvida.css">
 	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

 	<!-- TextArea -->
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=mglwogb0a7flz0f4ttu36jjeo454bjd9kfbvjtoj115o42gx"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
	<!-- TextArea -->

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <script>
        function carregar_pagina(opcao, codTema){
            $.ajax({url:'filtrar.php?opcao='+opcao+'&codTema='+codTema,
                    success: function(retorno){
                        $('#conteudo').html(retorno);
            }});
        }
        function nLogado(){
            window.location.href = "../autenticacao/login.php?login=erro5";
        }
            
    </script>

    <div class="container-fluid divHeaderPag">
    	<div class="row bg-dark">
    		<div class="col-4">
    			
    		</div>
    		<div class="col-4 text-center">
    			<img src="../img/newquestion.png" class="imgQuestion">
    			<p class="corLink">Nesta sessão você poderá tirar suas dúvidas com a comunidade ou ajudar alguém que tenha alguma dúvida.</p>
    		</div>
    		<div class="col-4">
    			
    		</div>
    	</div>
    </div>

    <div class="divPerguntas">
    	<div class="container">
    		<div class="row">
    			<div class="card divDuvida">
    				<div class="card-header">
    					<div class="btn-group float-right">
    						<button class="btn btn-secondary" onclick="carregar_pagina(1, 0)">Recentes</button>
    						<button class="btn btn-secondary" onclick="carregar_pagina(2, 0)">Ativas</button>
    						<div class="dropdown">
						        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" type="button">
						            Explore pelos Temas
						        </button>
						        <div class="dropdown-menu">
						        	<?php 

						        		$sql = new Sql();

						        		$retorno = $sql->query("SELECT * FROM tema ORDER BY NOME_TEMA");

						        		while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
						        			echo "
													<a href='#' class='dropdown-item' onclick=\"carregar_pagina('3', '$row[COD_TEMA]')\">$row[NOME_TEMA]</a>
						        				";
						        		}

						        	 ?>
						        </div>
						    </div>
    					</div>
    					<h4>Explore Nossas Perguntas</h4>
                        <?php 

                            if(!isset($_SESSION['cod_usuario'])){
                                echo "
                                    <p>Se tem alguma dúvida e precisa de ajuda, pergunta para a comunidade <a href='#' onclick=\"nLogado()\">clicando aqui.</a></p>
                                    ";
                            }else{
                                echo "
                                    <p>Se tem alguma dúvida e precisa de ajuda, pergunta para a comunidade <a href='#' data-toggle='modal' data-target='#modalDuvida'>clicando aqui.</a></p>
                                    ";
                            }

                         ?>
    					
    				</div>
    				<div class="card-body">
                        <div id="conteudo">
        					<?php 

        						$sql = new Sql();

        						$retorno = $sql->query("SELECT * FROM duvida ORDER BY DT_CRIACAO");

        						while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
        							echo "
        									<a href='visualizarDuvida.php?codPerg=$row[COD_DUVIDA]' class='float-right btn btn-outline-info'>Visualizar</a>
        			    					<span class='posicaoPergunta'><h6>$row[TITULO_DUVIDA]</h6></span>
        			    					<div class='qtdeRespostas text-center'>
        			    						$row[QNT_COMENTARIO]
        			    						Respostas
        			    					</div>
        			    					<hr>
        								";
        						}

        					 ?>
                        </div>
    				</div>
    				<div class="card-footer">
    					
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <!-- Modal Adc Duvida -->

    <div class="modal fade" id="modalDuvida" tabindex="-1" role="dialog">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header bg-light">
    				<h4 class="text-dark">Escreva abaixo sua Dúvida</h4>
    				<button type="button" class="close" data-dismiss="modal">
						<span class="text-dark">&times;</span>
					</button>
    			</div>
    			<div class="modal-body bg-secondary">
    				<h5>Escolha um tema para a sua Dúvida!</h5>
    				<form method="post" action="duvida.act.php?opcao=1">
	    				<div class="form-group">
	    					<select class="form-control" name="duvidaTema">
	    						<option>Selecione um tema</option>

	    						<?php 

	    							$sql = new Sql();

					        		$retorno = $sql->query("SELECT * FROM tema ORDER BY NOME_TEMA");

					        		while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
					        			echo "
												<option value='$row[COD_TEMA]'>$row[NOME_TEMA]</option>
					        				";
					        		}

	    						 ?>

	    					</select>
	    				</div>
                        <h5>Digite o título da sua Dúvida!</h5>
                        <div class="form-group">
                            <input type="text" name="txtTituloDuvida" size="80" class="form-control">
                        </div>
	    				<h5>Agora digite abaixo a sua dúvida e logo alguém irá responder!</h5>
	    				<div>
	    					<textarea name="txtDuvida"></textarea>
	    				</div>
    			</div>
    			<div class="modal-footer bg-light">
    					<button class="btn btn-outline-info">Registrar Dúvida</button>
    				</form>
    				<button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
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
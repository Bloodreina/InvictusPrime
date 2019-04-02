<?php 
    if(!isset($_SESSION)){
        session_start();
    }
	require_once '../navegacao/navegacaoDentro.php';
	require_once '../config.php';

	if(isset($_GET)){
		$codDuvida = $_GET['codPerg'];
	}

    $sql = new Sql();

    $retorno = $sql->query("SELECT * FROM duvida WHERE COD_DUVIDA = :CODDUVIDA", array(
                           ":CODDUVIDA"=>$codDuvida
                           ));
    $retorno = $retorno->fetch(PDO::FETCH_ASSOC);

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

    <script type="text/javascript">
        function desabilitarBts(){
            $('#btResolveu').attr('disabled', 'disabled');
            $('#btAjudou').attr('disabled', 'disabled');
            $('#btNAjudou').attr('disabled', 'disabled');
        }
        function verificaSession(){
            window.location.href = "../autenticacao/login.php?login=erro5";
        }
    </script>

    <div class="container-fluid divHeaderPag">
    	<div class="row bg-dark">
    		<div class="col-4">
    			
    		</div>
    		<div class="col-4 text-center">
    			<img src="../img/question.png" class="imgQuestion">
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
    					<div class="float-right">
    						<div class="caixaStatus text-center">
    							<h5>Status:</h5>
                                <?php 

                                    if($retorno['STATUS'] == 0){
                                        echo "<span>Ativa</span>";
                                    }else{
                                        echo "<span>Resolvida</span>";
                                    }

                                 ?>
    							
    						</div>
    					</div>
    					<?php 

    					echo "
    						<h5>$retorno[TITULO_DUVIDA]</h5>
    						";

    					 ?>
    				</div>
    				<div class="card-body">
    					<?php 

                            echo "
                                <pre class='preDetalhes text-left'><code class='codeCoisas text-left'>$retorno[DUVIDA]</code></pre>
                                ";

                         ?>

    					 <div class="float-right ">
    					 	<a href="#" class="divBtResponder btn btn-outline-info" data-toggle="modal" data-target="#modalDuvida" onclick="verificaSession()">Responder</a>
    					 </div>
                         <?php 

                            $usuario = new Usuario();

                            $usuario->loadById($retorno['COD_USUARIO']);
                            $caminhoFoto = $usuario->getFotoUsuario();
                          ?>
    					 <div class="caixaUsuario">
    					 	<div class="caixaThumb">
                                <?php 

                                    if($caminhoFoto != ""){
                                        $pastaPrincipal = ".." . DIRECTORY_SEPARATOR . "autenticacao" . DIRECTORY_SEPARATOR;
                                        $caminhoFinal = $pastaPrincipal . $caminhoFoto;
                                        echo "<img src='$caminhoFinal' class='imgThumb'>";
                                    }else{
                                        echo "<img src='http://ssl.gstatic.com/accounts/ui/avatar_2x.png' class='imgThumb'>";
                                    }

                                 ?>
    					 		
    					 	</div>
    					 	<span class="nomeUsuario"><?php echo $usuario->getNick(); ?></span>
    					 </div>


    				</div>
    				<div class="card-footer">
    					<h5 class="text-dark">Respostas</h5>
                        <?php 
                            $codDuvida = $retorno['COD_DUVIDA'];
                            $buscaDuvida = $sql->query("SELECT * FROM comentario INNER JOIN duvida_comentario
                                                       ON comentario.COD_COMENTARIO = duvida_comentario.COD_COMENTARIO
                                                       WHERE duvida_comentario.COD_DUVIDA = :CODDUVIDA", array(
                                                       "CODDUVIDA"=>$codDuvida
                                                       ));
                            $usuarioResposta = new Usuario();

                            if(isset($buscaDuvida)){
                                while($row = $buscaDuvida->fetch(PDO::FETCH_ASSOC)){

                                    $usuarioResposta->loadById($row['COD_USUARIO']);
                                    $caminhoFotoUsuResposta = $usuarioResposta->getFotoUsuario();

                                    echo "
                                            <div class='float-right divBtAjudou text-center'>
                                        ";

                                        if(!isset($_SESSION['cod_usuario'])){
                                            $codUsuarioAtual = 0;
                                        }else{
                                            $codUsuarioAtual = $_SESSION['cod_usuario'];
                                        }
                                        if($retorno['COD_USUARIO'] == $codUsuarioAtual){
                                            echo "<a href='feedBack-comentario.php?resolveu=1&codDuvida=$codDuvida&codComentario=$row[COD_COMENTARIO]' id='btResolveu' class='btn btn-info btResolveu'>Resolveu</a>";
                                        }
                                    echo "            
                                                <a href='feedBack-comentario.php?ajudou=1&codDuvida=$codDuvida&codComentario=$row[COD_COMENTARIO]' id='btAjudou' class='btn btn-info btAjudou'>Ajudou</a>
                                                <a href='feedBack-comentario.php?N_ajudou=1&codDuvida=$codDuvida&codComentario=$row[COD_COMENTARIO]' id='btNAajudou' class='btn btn-info btNaoAjudou'>Não Ajudou</a>
                                            <div class='caixaUsuario2'>
                                                <div class='caixaThumb'>
                                        ";
                                                if($caminhoFotoUsuResposta != ""){
                                                    $pastaPrincipal = ".." . DIRECTORY_SEPARATOR . "autenticacao" . DIRECTORY_SEPARATOR;
                                                    $caminhoFinal = $pastaPrincipal . $caminhoFotoUsuResposta;
                                                    echo "<img src='$caminhoFinal' class='imgThumb'>";
                                                }else{
                                                    echo "<img src='http://ssl.gstatic.com/accounts/ui/avatar_2x.png' class='imgThumb'>";
                                                }
                                    echo "
                                                </div>
                                                <span class='nomeUsuario'>".$usuarioResposta->getNick()."</span>
                                            </div>
                                                
                                            </div>

                                            <pre class='preDetalhesRespostas text-left'><code class='codeCoisas text-left'>$row[COMENTARIO]</code></pre>
                                            
                                            <hr>
                                        ";
                                }
                            }
                         ?>

    					
    				</div>

    			</div>
    		</div>
    	</div>
    </div>

     <!-- Modal Responder Duvida -->

    <div class="modal fade" id="modalDuvida" tabindex="-1" role="dialog">
    	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
    			<div class="modal-header bg-light">
    				<h4 class="text-dark">Envie sua resposta!</h4>
    				<button type="button" class="close" data-dismiss="modal">
						<span class="branco">&times;</span>
					</button>
    			</div>
    			<div class="modal-body bg-secondary">
    				<form method="post" action="duvida.act.php?opcao=2">
	    				<input type="hidden" name="txtCodDuvida" value="<?php echo $codDuvida; ?>">
	    				<div>
	    					<textarea name="txtComentario"></textarea>
	    				</div>
    			</div>
    			<div class="modal-footer bg-light">
    					<button class="btn btn-outline-info">Enviar</button>
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
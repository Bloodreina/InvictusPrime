<?php
    require_once 'sessions/validador-acesso2.php';
    require_once 'navegacao/navegacaoIndex.php';
    require_once 'config1.php';

    if(!isset($_SESSION)){
      session_start();
    }

    $quiz = new Quiz();
    $usuario = new Usuario();
    $usuario->loadById($_SESSION['cod_usuario']);
 ?>

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estiloPerfil.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../jquery/jquery-3.1.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <title>InvictusPrime - Meu Perfil</title>
    <meta charset="utf-8">

	<script type="text/javascript">
      $(document).ready(function() {


        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result).attr("width","400");

                }

                reader.readAsDataURL(input.files[0]);
            }
        }


        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });

      function carregarInfo(codQuiz, nomeQuiz, descricao, qtdePerguntas, dificuldade, dataCriacao, ultimaAtt, qtdeAcessos, qtdeLiks, totalAcertos, totalErros){
        $("input[name='txtCodQuiz']").val(codQuiz);
        $("input[name='txtNomeQuiz']").val(nomeQuiz);
        $("textarea[name='txtDescricao']").val(descricao);
        $("input[name='txtPergunta']").val(qtdePerguntas);
        $('#pDificuldade').html(dificuldade);
        $("input[name='txtDificuldade']").val(dificuldade);
        $('#pDataCriacao').html(dataCriacao);
        $('#pUltAtualizacao').html(ultimaAtt);
        $('#pQtdeAcessos').html(qtdeAcessos);
        $('#pQtdeLikes').html(qtdeLiks);
        $('#pQtdePerguntasAcertadas').html(totalAcertos);
        $('#pQtdePerguntasErradas').html(totalErros);
      }
      function carregarNovosDados(nick, email, area){
        console.log(nick, email);
        $("input[name='nickname']").val(nick);
        $("input[name='email']").val(email);
        $('#pArea').html(area);
      }
      function confirma(id){
          var confirmar = confirm("Tem certeza que deseja alterar o registro?");
          if(confirmar){
            document.getElementById(id).submit()
          }
      }

    </script>
    <style>
      .avatar{
        background:#fa0c01;
        color:#fff;
        width:180px;
        height:180px;
        max-width: 180px;
        max-height: 180px;
        line-height:300px;
        vertical-align:middle;
        margin-top:-100px ;
        text-align:center;
        font-size:30px;
        border-radius:50%;
        -moz-border-radius:50%;
        -webkit-border-radius:50%;
      }
  

    </style>

    <!-- CORPO -->


	<div>
		<div class="divPrincipal">
			<div class="container">
				<div class="row divFotoTotal">
					<div class="tamanhoCard">
						
					</div>
					<div class="tamanhoCard1">
             <form method="post" action="autenticacao/alterarFoto.php" enctype="multipart/form-data">
                <center>
                <div class="text-center">
                  <label for=""></label>
                  <?php 

                    $caminhoFoto = $usuario->getFotoUsuario();

                    if($caminhoFoto != ""){
                      $pastaPrincipal = "autenticacao" . DIRECTORY_SEPARATOR;
                      $caminhoFinal = $pastaPrincipal . $caminhoFoto;

                      echo "
                          <label for='lol'>
                          <img src='$caminhoFinal' class='avatar img-circle img-thumbnail profile' style='border-radius: 50% ' alt='avatar'>
                          <input type='file' id='lol' class='file-upload escondebt' name='fotoUsuario'/>
                          </label>
                          ";
                    }else{
                      echo "
                          <img src='http://ssl.gstatic.com/accounts/ui/avatar_2x.png' class='avatar img-circle img-thumbnail profile' style='border-radius: 50% ' alt='avatar'>
                          <input type='file' class='file-upload escondebt' name='fotoUsuario'/>
                          ";
                    }

                   ?>

                </div>
              </center>

              <center>
                
                  <input type="submit" name="bt-enviar" value="Alterar Foto" class="btn btn-info">
                
              </center>

             </form>
              




					</div>
				</div>
			</div>


			<div class="container">
				<div class="row divFotoTotal">
					<div class="card cardInformacoes">
						<div class="envoltaDivInfoUsu">
							<div class="tituloInfoUsu text-white">
								<h5 class="text-center">Informações Gerais</h5>	
							</div>
							<div class="infoGerais text-center">
								<?php 

                  if($usuario->getAutenticacao() == 'SIM'){
                    echo "
                        <span class='paragrafosInfo'><strong>Nickname: </strong></span><span>".$usuario->getNick()."</span><img src='img/CHECK.png'>
                        ";
                  }else{
                    echo "<span class='paragrafosInfo'><strong>Nickname: </strong></span><span>".$usuario->getNick()."</span>";
                  }

                 ?>
								<hr>
								<span class="paragrafosInfo"><strong>Email: </strong></span><span><?php echo $usuario->getEmail(); ?></span>
								<hr>
								<span class="paragrafosInfo"><strong>Área de Atuação: </strong></span><p class="paragrafosInfo"><?php echo $usuario->getAreaAtuacao(); ?></p>
                <?php 

                  echo "
                      <a href='#'' class='btn btn-info' data-toggle='modal' data-target='#modalUsuario' onclick=\"carregarNovosDados('".$usuario->getNick()."', '". $usuario->getEmail() ."', '". $usuario->getAreaAtuacao() ."')\">Alterar Dados</a>
                      ";

                  $buscaAdmin = new Sql();

                  $eadmin = $buscaAdmin->select("SELECT * FROM usuario WHERE COD_USUARIO = :CODUSUARIO AND USUARIO_ADMIN = 1", array(
                                                 ":CODUSUARIO"=>$_SESSION['cod_usuario']
                                                 ));
                  if(count($eadmin) > 0){
                    echo "
                        <a href='admin/gerenciar.php' class='btn btn-info'>Tela Admin</a>
                        ";
                  }
                  

                 ?>
								

							</div>
						</div>
						<div class="envoltaDiv1">
							<div class="tituloInfoUsu text-white">
								<h5 class="text-center">Minha Atividade</h5>
							</div>
							
							<?php 
				                $qtdeQuizFeito = $quiz->buscarQtdeQuizFeito($_SESSION['cod_usuario']);
				                $qtdeQuizCriado = $quiz->buscarQtdeQuizCriado($_SESSION['cod_usuario']);
				                $qtdeAlternativasCorretas = $quiz->buscarAlternativasCorretasUsuario($_SESSION['cod_usuario']);
				                $qtdeAlternativasIncorretas = $quiz->buscarAlternativasIncorretasUsuario($_SESSION['cod_usuario']);
				            ?>
				            

							<div class="infoGerais">
								<span class="paragrafosInfo"><strong>Quizzes Respondidos: </strong></span><span class="espacoAtividade1"><?php echo $qtdeQuizFeito['QTDE']; ?></span>
								<hr>
								<span class="paragrafosInfo"><strong>Quizzes Criados: </strong></span><span class="espacoAtividade2"><?php echo $qtdeQuizCriado['QTDE']; ?></span>
								<hr>
								<span class="paragrafosInfo"><strong>Respostas Corretas: </strong></span><span class="espacoAtividade3"><?php echo $qtdeAlternativasCorretas['QTDE']; ?></span>
								<hr>
								<span class="paragrafosInfo"><strong>Respostas Incorretas: </strong></span><span class="espacoAtividade4"><?php echo $qtdeAlternativasIncorretas['QTDE']; ?></span>
							</div>
						</div>
						<div class="envoltaDiv3">
							<?php 

                $buscarSeTemQuiz = new Sql();

                $retorno = $buscarSeTemQuiz->select("SELECT * FROM autor_quiz WHERE COD_USUARIO = :CODUSUARIO", array(
                                                    ":CODUSUARIO"=>$_SESSION['cod_usuario']
                                                    ));
                $verificaSeTemQuiz = $buscarSeTemQuiz->select("SELECT * FROM usuario WHERE COD_USUARIO = :CODUSUARIO AND AUTENTICACAO = 'SIM'", array(
                                                              ":CODUSUARIO"=>$_SESSION['cod_usuario']
                                                              ));

                if(count($verificaSeTemQuiz) > 0){
                  if(count($retorno) > 0){
                    echo "
                      <h5 class='text-center'>Meus Quizzes</h5>
                        <div class='infoGerais'>
                          <div class='tableCoisas'>
                            <table class='table table-striped table-hover'>
                              <thead class='thead-dark tableCoisas'>
                                <tr>
                                  <th>Meus Quizzes</th>
                                  <th>Qtde. Perguntas</th>
                                  <th></th>
                                  <th>Visualizar Estátisticas</th>
                                  <th>Gerenciar Pergunta</th>
                                </tr>
                              </thead>
                              <tbody>
                        ";
                                  $meusQuizzes = $quiz->buscarQuizPorAutor($_SESSION['cod_usuario']);

                                  $usuario = new Usuario();
                                  $usuario->loadById($_SESSION['cod_usuario']);

                                  while($row = $meusQuizzes->fetch(PDO::FETCH_ASSOC)){
                                      $qtdeAcessos = $quiz->buscarQtdeAcessos($row['COD_QUIZ']);
                                      $totalAcertos = $quiz->buscarAlternativasCorretasQuiz($row['COD_QUIZ']);
                                      $totalErros = $quiz->buscarAlternativasIncorretasQuiz($row['COD_QUIZ']);
                                      $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
                                      $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));
                    echo "                  
                                        <tr class='text-dark'>
                                          <td>$row[NOME_QUIZ]</td>
                                          <td>$row[QNT_PERGUNTA]</td>
                                          <td></td>
                                          <td><a href='#' class='card-link' data-toggle='modal' data-target='#modalVisualizar' onclick=\"carregarInfo('$row[COD_QUIZ]', '$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[DIFICULDADE]', '$dt_criacao', '$dt_atualizacao', '$qtdeAcessos[ACESSOS]', '$row[APROVACAO]', '$totalAcertos[QTDE]', '$totalErros[QTDE]')\">Visualizar</a></td>
                                          <td><a href='quiz/gerenciarPerguntas.php?q=$row[COD_QUIZ]' class='card-link'>Gerenciar</a></td>
                                        </tr>
                          ";
                                  }

                    echo "
                              </tbody>
                            </table>
                          </div>
                        </div>
                        ";
                  }else{
                    echo "
                      <div class='divQuerAutenticar'>
                        <center>
                          <img  src='img/lampIdeia.png'>
                          <h5>Ixi! Parece que você ainda não criou nenhum quiz!</h5>
                          <h6>Para criar um quiz Click no botão abaixo!</h6>
                          <a href='quiz/criarQuiz.php' class='btn btn-info'>Criar Quiz</a>
                        </center>
                      </div>
                        ";
                  }
                  
                }else{
                  echo "
                    <div class='divQuerAutenticar'>
                    <center>
                      <img src='img/nautenticado.png'>
                      <h5>Para Criar um quiz você precisa passar por uma avaliação para se tornar autenticado e verificado para criar Quizzes em nosso site.</h5>
                      <h6>Para fazer este Quiz clique no botão abaixo!</h6>
                      
                        <a href='#' class='btn btn-outline-info float-center'>Responder Quiz de Autenticação</a>
                      </center>
                    </div>
                      ";
                }

               ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal Altrar Usuário -->
	<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form method="post" id="alterarDados" action="perfil.act.php">
            <div class="modal-header bg-light">
              <h5 class="modal-title" id="exampleModalCenterTitle">Meus dados</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body bg-secondary">
              <div class="container-fluid">
                <div class="row text-light">
                  <div class="col-6">
                     
                        <strong><p>NickName:</p></strong>
                        <input type="text" class="form-control" name="nickname" size="35">

                        <strong><p>Email:</p></strong>
                        <input type="email" class="form-control" name="email" size="35">

                        <strong><p>Senha Atual:</p></strong>
                        <input type="password" class="form-control" name="senhaAtual" size="35">

                        <strong><p>Senha Nova:</p></strong>
                        <input type="password" class="form-control" name="novaSenha" size="35">

                        <strong> <p>Repita a nova senha:</p></strong>
                        <input type="password" class="form-control" name="repitirSenha" size="35">
                  </div>
                  <div class="col-6">

                    <strong><p>Atualmente sua area de atuação é:</p></strong>
                    <p id="pArea"></p>
                    <strong><p>Se deseja mudar sua area de atuação, selecione uma opção abaixo:</p></strong>

                    <div class="form-group">
                      <select class="form-control" id="areaAtuacao" name="area_atuacao">
                        <option>Selecione sua area de Atuação</option>
                        <?php 
                          $sql = new Sql();
                          $resultado = $sql->query("SELECT * FROM area_atuacao ORDER BY COD_AREA");
                          while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                            echo "
                              <option value='$row[COD_AREA]'>$row[NOME_AREA]</option>
                            ";
                          }
                         ?>
                      </select>
                    </div>

                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer bg-light">
              <input type="button" name="alterar" class="btn btn-outline-info" value="Alterar" onclick="confirma('alterarDados')">
            </form>
              <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>
      </div>
    </div>

	 <!-- Modal Quiz -->
    <div class="modal fade" id="modalVisualizar" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form method="post" id="alterarQuiz" action="perfil.act.php">
            <div class="modal-header bg-light">
              <h5>Informações do Quiz</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span class="branco">&times;</span>
              </button>
            </div>

            <div class="modal-body bg-secondary">
              <div class="container-fluid">
                <div class="row text-light">
                    <div class="col-6">
                      <strong><span>Nome do Quiz:</span></strong>
                      <input type="hidden" name="txtCodQuiz">
                      <input type="text" class="form-control" name="txtNomeQuiz" size="30">
                      <strong><p>Descrição do Quiz:</p></strong>
                      <textarea name="txtDescricao" class="form-control" rows="5" cols="30"></textarea>
                      <strong><p>Qtde. de Perguntas:</p></strong>
                      <input type="text" class="form-control" name="txtPergunta">
                      <strong><p>Data de Criação:</p></strong>
                      <p id="pDataCriacao"></p>
                      <strong><span>Ultima Atualização:</span></strong>
                      <p id="pUltAtualizacao"></p>
                    </div>
                    <div class="col-6">
                      <strong><p>Dificuldade do Quiz:</p></strong>
                      <p id="pDificuldade"></p>
                      <input type="hidden" name="txtDificuldade">
                      <strong><p>Para mudar a dificuldade selecione abaixo:</p></strong>
                      <select name="dificuldade" class="form-control">
                        <option>Mudar Dificuldade</option>
                        <option value="F">Fácil</option>
                        <option value="M">Médio</option>
                        <option value="I">Insano</option>
                      </select>
                      <strong><p>Qtde. de Acessos:</p></strong>
                      <p id="pQtdeAcessos"></p>
                      <strong><span>Qtde de Likes:</span></strong>
                      <p id="pQtdeLikes"></p>
                      <strong><span>Total de Perguntas Acertadas:</span></strong>
                      <p id="pQtdePerguntasAcertadas"></p>
                      <strong><span>Total de Perguntas Erradas:</span></strong>
                      <p id="pQtdePerguntasErradas"></p>
                    </div>
                </div>
              </div>
            </div>
            
          <div class="modal-footer bg-light">
            <button type="button" class="btn btn-info" onclick="confirma('alterarQuiz')">Fazer alterações no Quiz</button>
            </form> 
            <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- FIM CORPO -->

	<?php require_once 'navegacao/footer.php'; ?>

	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="../bootstrap4/js/bootstrap.min.js"></script>
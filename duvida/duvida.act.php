<?php

	if(!isset($_SESSION)){
		session_start();
	}

	require_once '../config.php';

	$opcao = $_GET['opcao'];

	$sql = new Sql();

	if($opcao == 1){
		if(isset($_POST)){
			$tituloDuvida = $_POST['txtTituloDuvida'];
			$duvida = $_POST['txtDuvida'];
			$codTema = $_POST['duvidaTema'];
			$codUsuario = $_SESSION['cod_usuario'];

			$idDuvida = $sql->query("CALL SP_INS_DUVIDA(:CODTEMA, :CODUSUARIO, :DUVIDA, :TITULODUVIDA)", array(
						":CODTEMA"=>$codTema,
						":CODUSUARIO"=>$codUsuario,
						":DUVIDA"=>$duvida,
						":TITULODUVIDA"=>$tituloDuvida
						));
			echo "<script>setTimeout(function(){self.location='duvida.php';}, 0);</script>";
		}
	}elseif($opcao == 2){
		if(isset($_POST)){
			$codUsuario = $_SESSION['cod_usuario'];
			$codDuvida = $_POST['txtCodDuvida'];
			$comentario = $_POST['txtComentario'];

			$idComentario = $sql->query("CALL SP_INS_COMENTARIO(:CODUSUARIO, :COMENTARIO)", array(
										":CODUSUARIO"=>$codUsuario,
										":COMENTARIO"=>$comentario
										));
			$idComentario = $idComentario->fetch(PDO::FETCH_ASSOC);

			if(isset($idComentario)){
				$qtdeComentario = $sql->query("SELECT QNT_COMENTARIO FROM duvida WHERE COD_DUVIDA = :CODDUVIDA", array(
											  ":CODDUVIDA"=>$codDuvida
											  ));
				if(isset($qtdeComentario)){
					$qtdeComentario = $qtdeComentario->fetch(PDO::FETCH_ASSOC);
					$novaQtde = $qtdeComentario['QNT_COMENTARIO'] + 1;
					$sql->query("UPDATE duvida SET QNT_COMENTARIO = :QNTCOMENTARIO WHERE COD_DUVIDA = :CODDUVIDA", array(
								":QNTCOMENTARIO"=>$novaQtde,
								":CODDUVIDA"=>$codDuvida
								));
				}
				

			}

			$sql->query("CALL SP_INS_DUVIDA_COMENTARIO(:CODDUVIDA, :CODCOMENTARIO)", array(
						":CODDUVIDA"=>$codDuvida,
						":CODCOMENTARIO"=>$idComentario['LAST_INSERT_ID()']
						));

			echo "<script>history.back(-1)</script>";
		}
	}
 ?>
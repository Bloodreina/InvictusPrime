<?php 

	require_once '../config.php';

	$sql = new Sql();
	$codDuvida = $_GET['codDuvida'];
	$codComentario = $_GET['codComentario'];
	if(isset($_GET['resolveu'])){
		$sql->query("CALL SP_UP_STATUS_DUVIDA(:CODDUVIDA, :STATUS)",array(
					":CODDUVIDA"=>$codDuvida,
					":STATUS"=>1
					));
		echo "<script>setTimeout(function(){history.go(-1);}, 0);</script>";
	}
	if(isset($_GET['ajudou'])){
		$qtdeAjuda = $sql->query("SELECT AJUDOU FROM comentario WHERE COD_COMENTARIO = :CODCOMENTARIO", array(
								 ":CODCOMENTARIO"=>$codComentario
								 ));
		$qtdeAjuda = $qtdeAjuda->fetch(PDO::FETCH_ASSOC);
		$ajuda = $qtdeAjuda['AJUDOU'] + 1;

		$sql->query("CALL SP_UP_AJUDOU_COMENTARIO(:CODCOMENTARIO, :AJUDA)", array(
					":CODCOMENTARIO"=>$codComentario,
					":AJUDA"=>$ajuda
					));
		echo "<script>setTimeout(function(){history.go(-1);}, 0);</script>";
	}
	if(isset($_GET['N_ajudou'])){
		$qtdeNAjuda = $sql->query("SELECT N_AJUDOU FROM comentario WHERE COD_COMENTARIO = :CODCOMENTARIO", array(
								 ":CODCOMENTARIO"=>$codComentario
								 ));
		$qtdeNAjuda = $qtdeNAjuda->fetch(PDO::FETCH_ASSOC);
		$ajuda = $qtdeNAjuda['N_AJUDOU'] + 1;

		$sql->query("CALL SP_UP_N_AJUDOU_COMENTARIO(:CODCOMENTARIO, :AJUDA)", array(
					":CODCOMENTARIO"=>$codComentario,
					":AJUDA"=>$ajuda
					));
		echo "<script>setTimeout(function(){history.go(-1);}, 0);</script>";
	}
 ?>
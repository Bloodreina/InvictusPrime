<?php 

	require_once '../config.php';

	$opcao = $_GET['opcao'];
	$codTema = $_GET['codTema'];

	if($opcao == 1){
		$sql = new Sql();

		$retorno = $sql->query("SELECT * FROM duvida ORDER BY DT_CRIACAO DESC");

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
	}elseif($opcao == 2){
		$sql = new Sql();

		$retorno = $sql->query("SELECT * FROM duvida WHERE STATUS = 0 ORDER BY DT_CRIACAO DESC");

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
	}elseif($opcao == 3){
		$sql = new Sql();

		$retorno = $sql->query("SELECT * FROM duvida WHERE COD_TEMA = :CODTEMA ORDER BY DT_CRIACAO DESC", array(
							   ":CODTEMA"=>$codTema
							   ));

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
	}

 ?>
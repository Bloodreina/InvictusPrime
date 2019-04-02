<?php 
	require_once '../sessions/acesso-adm.php';
	require_once '../mpdf/vendor/autoload.php';
	require_once '../config.php';
	$mpdf = new \Mpdf\Mpdf();

	$css = file_get_contents('relatorio.css');

	$data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
	$dataName = "InvictusPrime-" . $data->format('d-m-Y-H-m-s').".pdf";
	$d = $data->format('d-m-Y H:i:s');


	$html .= "
				<h2 id='tituloPrincipal'><span>Relatório InvictusPrime</span></h2>
				<p id='data'><span>Data e Hora da Emissão:</span></p>
				<p id='dt'>$d</p>
				<hr>

				<p>Este Relatório apresenta os dados dos Usuários e dos Quizzes cadastrados no sistema!</p>
				
				<h3>Sobre os Usuários:</h3>
				<table id=tabela>
					<tr>
						<td>Qtd. Usuários Cadastrados |</td>
						<td>Qtd. Usuários autenticados |</td>
						<td>Qtd. Usuários não autenticados</td>
					</tr>
			";

			$sql = new Sql();
			$qtdUsuariosCadastrados = $sql->query("SELECT COUNT(*) AS QTD_USUARIOS FROM usuario");
			$qtdUsuariosAutenticados = $sql->query("SELECT COUNT(*) AS QTDE FROM usuario WHERE AUTENTICACAO = 'sim'");
			$qtdUsuariosNAutenticados = $sql->query("SELECT COUNT(*) AS QTDE FROM usuario WHERE AUTENTICACAO = 'nao'");

			$t = $qtdUsuariosCadastrados->fetch(PDO::FETCH_ASSOC);
			$r = $qtdUsuariosAutenticados->fetch(PDO::FETCH_ASSOC);
			$e = $qtdUsuariosNAutenticados->fetch(PDO::FETCH_ASSOC);

			$html .= "
						<tr>
							<td class=textoAlinhado>$t[QTD_USUARIOS]</td>
							<td class=textoAlinhado>$r[QTDE]</td>
							<td class=textoAlinhado>$e[QTDE]</td>
						</tr>
					";

			$html .= "</table>
					<hr>
					";

			$html .= "
						<h3>Sobre os Quizzes:</h3>
						<table id=tabela>
							<tr>
								<td>Qtd. de Temas |</td>
								<td>Qtd. de Quizzes |</td>
								<td>Qtd. de Perguntas |</td>
								<td>Qtd. de Alternativas</td>
							</tr>
					";

			$qtdTemas = $sql->query("SELECT COUNT(*) AS QTDE FROM tema");
			$qtdQuizzes = $sql->query("SELECT COUNT(*) AS QTDE FROM quiz");
			$qtdPerguntas = $sql->query("SELECT COUNT(*) AS QTDE FROM pergunta");
			$qdtAlternativas = $sql->query("SELECT COUNT(*) AS QTDE FROM alternativa");

			$o = $qtdTemas->fetch(PDO::FETCH_ASSOC);
			$y = $qtdQuizzes->fetch(PDO::FETCH_ASSOC);
			$u = $qtdPerguntas->fetch(PDO::FETCH_ASSOC);
			$i = $qdtAlternativas->fetch(PDO::FETCH_ASSOC);

			$html .="
						<tr>
							<td class=textoAlinhado>$o[QTDE]</td>
							<td class=textoAlinhado>$y[QTDE]</td>
							<td class=textoAlinhado>$u[QTDE]</td>
							<td class=textoAlinhado>$i[QTDE]</td>
						</tr>
					";

			$html .="</table>";

			$html .="
					<h3>Classificação de dificuldade dos Quizzes:</h3>
					<table id=tabela>
						<tr>
							<th>Quiz Facil</th>
							<th>Quiz Médio</th>
							<th>Quiz Insano</th>
						</tr>
					";

			$qtdFacil = $sql->query("SELECT COUNT(*) AS QTDE FROM quiz WHERE DIFICULDADE = 'F'");
			$qtdMedio = $sql->query("SELECT COUNT(*) AS QTDE FROM quiz WHERE DIFICULDADE = 'M'");
			$qtdInsano = $sql->query("SELECT COUNT(*) AS QTDE FROM quiz WHERE DIFICULDADE = 'I'");

			$p = $qtdFacil->fetch(PDO::FETCH_ASSOC);
			$l = $qtdMedio->fetch(PDO::FETCH_ASSOC);
			$j = $qtdInsano->fetch(PDO::FETCH_ASSOC);

			$html .="
						<tr>
							<td class=textoAlinhado>$p[QTDE]</td>
							<td class=textoAlinhado>$l[QTDE]</td>
							<td class=textoAlinhado>$j[QTDE]</td>
						</tr>
					";

			$html .="</table>";

			$html .="
					<h3>Quizzes mais acessados por Temas:</h3>
					<table id=tabela>
						<tr>
							<th>Tema</td>
							<th>Nome do Quiz</th>
							<th>Quant. Acessos</th>
						</tr>
					";

			$temas = $sql->query("SELECT * FROM tema");
			while($row = $temas->fetch(PDO::FETCH_ASSOC)){
				$codTema = $row['COD_TEMA'];
				$html .="
						<tr>
							<td>$row[NOME_TEMA]</td>
						";

				$quizAcessado = $sql->query("SELECT NOME_QUIZ, MAX(ACESSOS) AS ACESSO FROM quiz INNER JOIN quiz_tema
											ON quiz_tema.COD_QUIZ = quiz.COD_QUIZ
											WHERE quiz_tema.COD_TEMA = :CODTEMA", array(
											":CODTEMA"=>$codTema
											));
				$quizAcessado = $quizAcessado->fetch(PDO::FETCH_ASSOC);

				$html .="
						<td>$quizAcessado[NOME_QUIZ]</td>
						<td>$quizAcessado[ACESSO]</td>
						";

				$html .="
						</tr>
						";
			}					

			$html .= "</table>";

			$footer .="
						<hr>
						<table id=tabelaFooter>
							<tr>
								<td align=left><span>Visite nosso o site para maiores informações: </span><a href='../index.php'><span>www.invictusprime.com.br</span></a></td>
								<td>Todos os Direitos Reservados</td>
								<td align=right>Página: 1</td>
							</tr>
						</table>
					";




	$mpdf->WriteHTML($css, 1);
	$mpdf->WriteHTML($html);
	$mpdf->SetHTMLFooter($footer);
	$mpdf->Output($dataName, "I");
 ?>
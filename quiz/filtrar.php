<?php 

    require_once '../config.php';

    $codTema = $_GET['codTema'];
    $opcao = $_GET['opcao'];

    echo "<table class='table table-striped table-hover'>
            <thead class='bg-dark text-white'>
                <tr>
                <th scope='col'>Nome do Quiz</th>
                <th scope='col'>Descrição</th>
                </tr>   
            </thead>
        ";

    if($opcao == 1){
        if($codTema != 0){
            $quiz = new Quiz($codTema);

            $busca = $quiz->buscarQuizzes();
            
            echo "";

            while($row = $busca->fetch(PDO::FETCH_ASSOC)){
                $quiz = new Quiz();
                $retorno = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
                $autorQuiz = $retorno->fetch(PDO::FETCH_ASSOC);
                $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
                $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));

                echo "
                    <tbody class='bg-light'>
                        <tr class='text-dark'>
                            <th scope='row'>
                                <a class='card-link' data-toggle=modal data-target=#quizModal href=responderQuiz.php?q=$row[COD_QUIZ] onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
                                        $row[NOME_QUIZ]
                                </a>
                            </th>   
                            <td>$row[DESCRICAO]</td>
                        </tr>
                     ";

                echo "</tbody>";
            }
            echo "</table>";
        }else{
            $sql = new Sql();

                $resultado = $sql->query("SELECT * FROM quiz ORDER BY NOME_QUIZ");

                echo "";

                while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                    $quiz = new Quiz();
                    $retorno = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
                    $autorQuiz = $retorno->fetch(PDO::FETCH_ASSOC);
                    $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
                    $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));

                    echo "
                            <tbody class='bg-light'>
                                <tr class='text-dark'>
                                    <th scope='row'>
                                        <a class='card-link' data-toggle=modal data-target=#quizModal href=responderQuiz.php?q=$row[COD_QUIZ] onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
                                            $row[NOME_QUIZ]
                                        </a>
                                    </th>
                                    <td><font class='text-dark'>$row[DESCRICAO]</font></td>
                                 </tr>
                            
                        ";
                }
                
                echo "</tbody>";
        }
    }elseif($opcao == 2){
        $sql = new Sql();

        $retorno = $sql->query("SELECT * FROM quiz ORDER BY ACESSOS DESC");

        echo "";

        while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
            $quiz = new Quiz();
            $buscarAutor = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
            $autorQuiz = $buscarAutor->fetch(PDO::FETCH_ASSOC);
            $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
            $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));

            echo "
                <tbody class='bg-light'>
                    <tr class='text-dark'>
                        <th scope='row'>
                            <a class='card-link' data-toggle='modal' data-target='#quizModal' href='responderQuiz.php?q=$row[COD_QUIZ]' onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
                                $row[NOME_QUIZ]
                            </a>
                        </th>
                        <td><font class='text-dark'>$row[DESCRICAO]</font></td>
                     </tr>
                ";
        }
        echo "</tbody>";
    }elseif($opcao == 3){
        $sql = new Sql();

        $retorno = $sql->query("SELECT * FROM quiz ORDER BY APROVACAO DESC");

        echo "";

        while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
            $quiz = new Quiz();
            $buscarAutor = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
            $autorQuiz = $buscarAutor->fetch(PDO::FETCH_ASSOC);
            $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
            $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));
            
            echo "
                <tbody class='bg-light'>
                    <tr class='text-dark'>
                        <th scope='row'>
                            <a class='card-link' data-toggle='modal' data-target='#quizModal' href='responderQuiz.php?q=$row[COD_QUIZ]' onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
                                $row[NOME_QUIZ]
                            </a>
                        </th>
                        <td><font class='text-dark'>$row[DESCRICAO]</font></td>
                     </tr>
                ";                      
        }

        echo "</tbody>";

    }elseif($opcao == 4){
        $sql = new Sql();

        $retorno = $sql->query("SELECT * FROM quiz ORDER BY DT_CRIACAO DESC");

        echo "";

        while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
            $quiz = new Quiz();
            $buscarAutor = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
            $autorQuiz = $buscarAutor->fetch(PDO::FETCH_ASSOC);
            $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
            $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));
            
            echo "
                <tbody class='bg-light'>
                    <tr class='text-dark'>
                        <th scope='row'>
                            <a class='card-link' data-toggle='modal' data-target='#quizModal' href='responderQuiz.php?q=$row[COD_QUIZ]' onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
                                $row[NOME_QUIZ]
                            </a>
                        </th>
                        <td><font class='text-dark'>$row[DESCRICAO]</font></td>
                     </tr>
                ";                      
        }

        echo "</tbody>";
        
    }elseif($opcao == 5){
        $sql = new Sql();

        $retorno = $sql->query("SELECT * FROM quiz ORDER BY DT_CRIACAO ASC");

        echo "";

        while($row = $retorno->fetch(PDO::FETCH_ASSOC)){
            $quiz = new Quiz();
            $buscarAutor = $quiz->buscarAutorQuiz($row['COD_QUIZ']);
            $autorQuiz = $buscarAutor->fetch(PDO::FETCH_ASSOC);
            $dt_criacao = date("d/m/Y H:i:s", strtotime($row['DT_CRIACAO']));
            $dt_atualizacao = date("d/m/Y H:i:s", strtotime($row['DT_ATUALIZACAO']));
            
            echo "
                <tbody class='bg-light'>
                    <tr class='text-dark'>
                        <th scope='row'>
                            <a class='card-link' data-toggle='modal' data-target='#quizModal' href='responderQuiz.php?q=$row[COD_QUIZ]' onclick=\"carregarInfo('$row[NOME_QUIZ]', '$row[DESCRICAO]', '$row[QNT_PERGUNTA]', '$row[VALOR_QUIZ]', '$dt_criacao', '$dt_atualizacao', '$row[COD_QUIZ]', '$autorQuiz[NICKNAME]')\">
                                $row[NOME_QUIZ]
                            </a>
                        </th>
                        <td><font class='text-dark'>$row[DESCRICAO]</font></td>
                     </tr>
                ";                      
        }

        echo "</tbody>";
        
    }

    echo "</table>";
        
 ?>
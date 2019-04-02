<?php 

    require_once '../config.php';

    $codTema = $_GET['codtema'];

    $quiz = new Quiz($codTema);

    if($codTema == 0){
        $quizOrdenado = $quiz->buscarQuizAlfabetico();
        
        while($row = $quizOrdenado->fetch(PDO::FETCH_ASSOC)){
            echo "
                    <span>$row[NOME_QUIZ]</span><a href='#' class='card-link btn btn-outline-warning btn-sm textoVer' onclick='filtrarPorQuiz($row[COD_QUIZ])'>Ver</a>
                    <hr>
                ";
        }
    }else{
        

        $quizzes = $quiz->buscarQuizzes();

        while($row = $quizzes->fetch(PDO::FETCH_ASSOC)){
            echo "
                    <span>$row[NOME_QUIZ]</span><a href='#' class='card-link btn btn-outline-warning btn-sm textoVer' onclick='filtrarPorQuiz($row[COD_QUIZ])'>Ver</a>
                    <hr>
                ";
        }
    }
 ?>
<?php 
  require_once '../sessions/acesso-adm.php';
  require_once '../config.php';
?>
  <!DOCTYPE html>
  <html>
  <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
  </head>
  </html>
  
<?php
  $quiz = new Quiz();
  if(isset($_GET['y'])){

    $opcao = $_GET['y'];

    if($opcao == 1){

      $codQuiz = $_POST['codQuiz'];
      $codPergunta = $_POST['codPergunta'];
      $codAlternativa = $_POST['codAlternativa'];
      $enunciado = htmlentities($_POST['enunciado'], ENT_QUOTES, "utf-8");
      $radio = $_POST['opRadio'];

      if($radio == "Correta"){
        $quiz->alterarRespostaCorreta($codAlternativa, $codPergunta);
      }

      $quiz->updateAlternativa($codAlternativa, $enunciado);

      echo "<script>setTimeout(function(){self.location='gerenciarPerguntas.php?q=$codQuiz';}, 0);</script>";

    }elseif($opcao == 2){
      $codQuiz = $_POST['codQuiz1'];
      $codPergunta = $_POST['codPergunta1'];
      $enunciado = htmlentities($_POST['enunciado'], ENT_QUOTES, "utf-8");

      $quiz->updatePergunta($codPergunta, $enunciado);

      echo "<script>setTimeout(function(){self.location='gerenciarPerguntas.php?q=$codQuiz';}, 0);</script>";
    }
  }elseif(isset($_GET['p'])){
    $codQuiz = $_GET['c'];
    if($_GET['a'] == 1){
      $codPergunta = $_GET['p'];
      $quiz->deletePergunta($codPergunta);
    }elseif($_GET['a'] == 2){
      $codAlternativa = $_GET['p'];
      $quiz->deleteAlternativa($codAlternativa);
    }

    echo "<script>setTimeout(function(){self.location='gerenciarPerguntas.php?q=$codQuiz';}, 0);</script>";

  }
  

 ?>
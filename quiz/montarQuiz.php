<?php require_once '../sessions/acesso-usuario-autenticado.php';
      require_once '../navegacao/navegacaoDentro.php';
?>

<title>InvictusPrime - Montar Quiz</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="MontarQuizstyle.css">



<script type="text/javascript">
    // URLs images
var facil = "https://i.imgur.com/SMfANHq.png";
var medio = "https://i.imgur.com/LAYNaet.png";
var insano = "https://i.imgur.com/GC3ieQY.png";
var teste = "https://i.imgur.com/hwxhf1K.png";


$( document ).ready(function() {

    set_sex_img();
    

    set_who_message();


    $("#input_sex").change(function() {

        set_sex_img();
        set_who_message();
    });


    $("#first_name").keyup(function() {

        set_who_message();
        
        if(validation_name($("#first_name").val()).code == 0) {
            $("#first_name").attr("class", "form-control is-invalid");
            $("#first_name_feedback").html(validation_name($("#first_name").val()).message);
        } else {
            $("#first_name").attr("class", "form-control");
        }
    });


    $("#last_name").keyup(function() {
        // Set the "who" message
        set_who_message();
        
        if(validation_name($("#last_name").val()).code == 0) {
            $("#last_name").attr("class", "form-control is-invalid");
            $("#last_name_feedback").html(validation_name($("#last_name").val()).message);
        } else {
            $("#last_name").attr("class", "form-control");
        }
    });
});


function set_sex_img() {
    var sex = $("#input_sex").val();
    
    

    if (sex == "F") {
        // male
        $("#img_sex").attr("src", facil);
    } 


    if (sex == "M") {
        // male
        $("#img_sex").attr("src", medio);
    }

     if (sex == "I") {
        // male
        $("#img_sex").attr("src", insano);
    }

    if (sex == "S") {
        // male
        $("#img_sex").attr("src", teste);
    }

}


function set_who_message() {
   
}


function validation_name (val) {
    
}
</script>


<?php 

            require_once '../config.php';

            $sql = new Sql();

            $tema = $_GET['codTema'];
            $nomeTema = $sql->query("SELECT * FROM tema WHERE COD_TEMA = :CODTEMA", array(
                ":CODTEMA"=>$tema
                ));
            $rowNomeTema = $nomeTema->fetch(PDO::FETCH_ASSOC);

         ?>

<div class="container" style="margin-top: 1em;">
    <center>
        <font class="font-weight-bold text-white" style="font-size: 20px;">Você está prestes a criar um quiz com o tema: <?php echo $rowNomeTema['NOME_TEMA'] ?></font><br>
    </center>
    <form method="post" action="cadastroQuizzes.php">

        <div class="card person-card bg-light">
            <div class="card-body">
                <input type="hidden" name="codTema" value="<?php echo $rowNomeTema['COD_TEMA'] ?>">
                
                <img id="img_sex" class="person-img"
                    src="https://i.imgur.com/hwxhf1K.png">
                
                
                <div class="row">
                    <div class="form-group col-md">
                        <select id="input_sex" name="dificuldade" class="form-control">
                            <option value="S">Selecionar Dificuldade</option>
                            <option value="F">Fácil</option>
                            <option value="M">Médio</option>
                            <option value="I">Insano</option>
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <input id="first_name" type="text" class="form-control" name="nomeQuiz" placeholder="Nome do Quiz">
                        <div id="first_name_feedback" class="invalid-feedback">
                            
                        </div>
                    </div>
                    <div class="form-group col-md">
                        <input id="last_name" type="text" class="form-control" name="descricao" placeholder="Descrição">
                        <div id="last_name_feedback" class="invalid-feedback">
                            
                        </div>
                    </div>

                    <div class="form-group col-md">
                        <input id="first_name" type="text" class="form-control" name="qtd_perguntas" placeholder="Quantidade de Perguntas">
                    <div id="first_name_feedback" class="invalid-feedback">
                            
                        </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body bg-secondary">
                
                <div id="divEsconde"></div>
                
                <div id="formulario" class="text-white">
                    <div class="form-group">
                    <label>Pergunta 1:</label>
                        <input class="colocaText inputPerguntas" type="text" name="pergunta1" placeholder="Pergunta1">
                        <input type="text" class="colocaText" name="alternativaC1" placeholder="Alternativa Correta">
                        <input type="text" class="colocaText" name="alternativaIa1" placeholder="Alternativa Incorreta">
                        <input type="text" class="colocaText" name="alternativaIb1" placeholder="Alternativa Incorreta">
                        <input type="text" class="colocaText" name="alternativaIc1" placeholder="Alternativa Incorreta">
                        
                    <button type="button" class="btn btn-info" id="addcampo">+</button>
                    </div>
                </div>
            

                    </div>
                </div>
            </div>
                
           
        </div>

        <div class="card-footer bg-light text-center">
            <button type="submit" class="btn btn-outline-info btn-lg" name="btEnviar" value="Criar Quiz">Criar Quiz</button>
        </div>
        
        </form>
</div>
 


    <script>
        var cont = 1;
        var perg = 1;
        var alterna = 1;        
        
        $("#addcampo" ).click(function() {
            
            cont++;
            perg++;
            alterna++;
            
        $("#formulario" ).append( '<div class="form-group text-white" id="campo'+ cont +'"> <label>Pergunta '+ perg +' :</label><input class="colocaText inputPerguntas" type="text" name="pergunta'+ perg +'" placeholder="Pergunta'+ perg +'"> <input type="text" class="colocaText" required="required" name="alternativaC'+ alterna +'" placeholder="Alternativa Correta"> <input type="text" class="colocaText" name="alternativaIa'+ alterna +'" placeholder="Alternativa Incorreta"> <input type="text" class="colocaText" name="alternativaIb'+ alterna +'" placeholder="Alternativa Incorreta"> <input type="text" class="colocaText" name="alternativaIc'+ alterna +'" placeholder="Alternativa Incorreta"> <button id="'+ cont +'" class="btapagar btn btn-info"> - </button></div>');
        });
            
            
        $( "form" ).on( "click", ".btapagar", function() {
                var button_id = $( this ).attr( "id" );
            $( '#campo'+ button_id +'' ).remove( );
            console.log("alo");
            cont--;
            perg--;
            alterna--;
        });

    </script>

    </form>
</div>

<?php 

    require_once '../navegacao/footer.php';

 ?>
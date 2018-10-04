<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once "../admin/controler/conexao.php";
include_once "../admin/controler/controlTipoAvaliacao.php";
include_once "../admin/model/tipo_avaliacao.php";

$tipos = new tipoAvaliacao();
$control = new controlerTipoAvaliacao(conecta());

$tipos = $control->selectAtivo();

?>

<!DOCTYPE html>
<html>
<head>
    <style>

        .ativo{
            color:yellow;
        }    

        .conteudo{
            text-align:center;
            margin-top:50px;
        }    

    </style>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

    <div class="container conteudo">

    <h3 class="font">Por favor, gostaríamos da sua avaliação sobre os seguintes tópicos:</h3>

    <?php $linha = 1; foreach($tipos as $tipo):?>

    <label id="tipo<?=$linha?>" data-id="<?=$tipo->getCod_tipo_avaliacao()?>"><?=$tipo->getNome()?>:</label><br>
    <i data-linha="<?=$linha?>" data-nota="1" id="star1<?=$tipo->getCod_tipo_avaliacao()?>" class="rating far fa-5x fa-star"></i>
    <i data-linha="<?=$linha?>" data-nota="2" id="star2<?=$tipo->getCod_tipo_avaliacao()?>" class="rating far fa-5x fa-star"></i>
    <i data-linha="<?=$linha?>" data-nota="3" id="star3<?=$tipo->getCod_tipo_avaliacao()?>" class="rating far fa-5x fa-star"></i>
    <i data-linha="<?=$linha?>" data-nota="4" id="star4<?=$tipo->getCod_tipo_avaliacao()?>" class="rating far fa-5x fa-star"></i>
    <i data-linha="<?=$linha?>" data-nota="5" id="star5<?=$tipo->getCod_tipo_avaliacao()?>" class="rating far fa-5x fa-star"></i><br>
    <input class="nota<?=$linha?>" type="number" name="nota" hidden id="res<?=$tipo->getCod_tipo_avaliacao()?>" value="0"><br>

    <?php $linha++; endforeach; ?>

    <input type="number" id="linhas" hidden value="<?=$linha?>">
    <button id="enviarAvaliacao">Enviar Avaliação</button>
    
    </div>
</body>

<script>
    $(".rating").on("click", function(){
        var nota = $(this).data("nota");
        var linha = $(this).data("linha");
        var id = $("#tipo"+linha).data("id");
        // alert("nota: "+nota+"id: "+id);
        var max = 5;
        var min = 0;
        $("#res"+id).val(nota);
        if($("#star"+nota+id).hasClass("ativo")){
            while(max > nota){
                $("#star"+max+id).removeClass("rating fas fa-5x fa-star ativo");
                $("#star"+max+id).addClass("rating far fa-5x fa-star");
                max--;
            }
        }else{
            while(min <= nota){
                $("#star"+min+id).addClass("rating fas fa-5x fa-star ativo");
                min++;
            }
        }
    });

    $("#enviarAvaliacao").on("click", function(){
        var linhas = $("#linhas").val();
        var tipos = new Array();
        var notas = new Array();
        var i = 1;

        while(i <= linhas){
            tipos.push($("#tipo"+i).data("id"));
            notas.push($(".nota"+i).val());

            i++;
        }

        $.ajax({
            type: 'POST',

            url: 'ajax/enviaAvaliacao.php',

            data: {tipos: tipos, notas: notas},

            success:function(res){
                if(res == 1){
                    swal("Avaliação enviada!", "Obrigado pela colaboração!!", "success").then((value) => {window.location="/home/avaliacao.php"});
                }else if(res == -1){
                    swal("Falha ao enviar!", "Houve algum erro no envio da avaliação!!", "error");
                }
            }
        })
    });
</script>
</html>
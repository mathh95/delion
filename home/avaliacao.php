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
    </style>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

    <h3>Por favor, gostaríamos da sua avaliação sobre os seguintes tópicos:</h3>

    <?php foreach($tipos as $tipo):?>

    <label><?=$tipo->getNome()?>:</label><br>
    <input class="ran" data-id="<?=$tipo->getCod_tipo_avaliacao()?>" type="range" id="nota<?=$tipo->getCod_tipo_avaliacao()?>" name="nota" value="0" max="5"><br>
    <i id="star1<?=$tipo->getCod_tipo_avaliacao()?>" class="far fa-star"></i>
    <i id="star2<?=$tipo->getCod_tipo_avaliacao()?>" class="far fa-star"></i>
    <i id="star3<?=$tipo->getCod_tipo_avaliacao()?>" class="far fa-star"></i>
    <i id="star4<?=$tipo->getCod_tipo_avaliacao()?>" class="far fa-star"></i>
    <i id="star5<?=$tipo->getCod_tipo_avaliacao()?>" class="far fa-star"></i><br>
    <input type="number" id="res<?=$tipo->getCod_tipo_avaliacao()?>" value="0"><br>

    <?php endforeach; ?>
    
</body>

<script>
    $(".ran").on("input", function(){
        var id = $(this).data("id");
        var nota = $(this).val();
        $("#res"+id).val(nota);
        if($("#star"+nota+id).hasClass("ativo")){

            $("#star"+nota+id).removeClass("fas fa-star ativo");
            $("#star"+nota+id).addClass("far fa-star");

        }else{
            $("#star"+nota+id).addClass("fas fa-star ativo");
        }
    });
</script>
</html>
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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

    <h3>Por favor, gostaríamos da sua avaliação sobre os seguintes tópicos:</h3>

    <?php foreach($tipos as $tipo):?>

    <input type="range" id="nota" name="nota" value="0" max="5"><br>
    <input type="number" id="res" value="0"><br>

    <?php endforeach; ?>
    
</body>

<script>
    $("#nota").on("input", function(){
        var nota = $("#nota").val();
        $("#res").val(nota);
    });
</script>
</html>
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

    <input type="range" id="nota" name="nota" value="50"><br>
    <input type="number" id="res" value="0">
    
</body>

<script>
    $("#nota").on("input", function(){
        var nota = $("#nota").val();
        $("#res").val(nota);
    });
</script>
</html>
<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlTipoAvaliacao.php";
    include_once MODELPATH."/tipo_avaliacao.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();    

    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
</head>
<body>
    
    <?php include_once "./header.php" ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/media-avaliacao-tabela.php";?>
            </div>
        </div>
    </div>
    <?php include VIEWPATH."/rodape.php" ?>
    <script src="../../js/alert.js"></script>

    <script type="text/javascript">

        $("#buscaMediaData").on("click", function(){
            var data = $("#data").val();
            var acao = 1;
            // alert(data);
            $.ajax({
                type: 'POST',

                url: '../../ajax/buscaMediaData.php',

                data: {data:data, acao:acao},

                success:function(res){
                    $("#mediaData").html(res);
                }
            })
        });

        $("#buscaMediaMes").on("click", function(){
            var mes = $("#mes").val();
            var acao = 2;
            // alert(mes);
            $.ajax({
                type: 'POST',

                url: '../../ajax/buscaMediaData.php',

                data: {mes:mes, acao:acao},

                success:function(res){
                    $("#mediaData").html(res);
                }
            })
        });

    </script>
    
</body>
</html>
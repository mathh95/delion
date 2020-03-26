<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlBanner.php";

    include_once MODELPATH."/banner.php";

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

                <?php include "../../ajax/miniBanner-tabela.php";?>

            </div>

        </div>

    </div>

    <?php include VIEWPATH."/rodape.html" ?>

    <script src="../../js/alert.js"></script>

    <script type="text/javascript">

        function removeBanner(banner,foto){

            msgConfirmacao('Confirmação','Deseja Realmente remover o mini banner?',

                function(linha){

                    var url ='../../ajax/excluir-banner.php?banner='+banner+'&foto='+foto;

                    $.get(url, function(dataReturn) {

                        if (dataReturn > 0) {

                            msgGenerico("Excluir!","Banner excluído com sucesso!",1,function(){});

                            $("#status"+banner).remove();

                        }else{

                            msgGenerico("Erro!","Não foi possível excluir o banner!",2,function(){});

                        }

                    });  

                },

                function(){}

            );

        }

    </script>

</body>

</html>
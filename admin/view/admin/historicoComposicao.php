<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH. "/controlIngrediente.php";
    include_once MODELPATH. "/ingrediente.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

    $controle_ingrediente=new controlerIngrediente($_SG['link']);
    $ingredientes = $controle_ingrediente->selectAll();


?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>


    <body>

        <?php include_once "./header.php" ?>

        <div class="container-fluid">


            <div class="col-md-12">

                <h3>Histórico de Preço de Custo</h3>

                <div class="row">
                </div>

            </div>
        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>


        <script>
            

        </script>

    </body>

</html>
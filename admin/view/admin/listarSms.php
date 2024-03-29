<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
include_once CONTROLLERPATH . "/controlUsuario.php";
include_once MODELPATH . "/usuario.php";
include_once CONTROLLERPATH . "/seguranca.php";


$_SESSION['permissaoPagina'] = 0;

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

//usado para coloração customizada da página selecionada na navbar
$arquivo_pai = basename(__FILE__, '.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include VIEWPATH . "/cabecalho.html" ?>
</head>

<body>

    <?php include_once "./header.php" ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include "../../ajax/sms_mensagem-tabela.php"; ?>
            </div>
        </div>
    </div>

    <div class="col-md-12">

        <div class="pull-left">

        <?php

            $permissao =  json_decode($usuarioPermissao->getPermissao());

            if (in_array('enviar_sms', $permissao)){ ?>
                
                <a href="default.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

            <?php } ?>

            </div>
        </div>

    <?php include VIEWPATH . "/rodape.php" ?>


    <script src="../../js/alert.js"></script>

    <script type="text/javascript">
    </script>
</body>
</html>
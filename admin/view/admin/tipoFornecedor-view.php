<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlTipoFornecedor.php";

    include_once MODELPATH."/tipo_fornecedor.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerTipoFornecedor($_SG['link']);

    $tipo_fornecedor = $controle->selectId($_GET['cod']);     //alterar o modo

    //usado para coloração customizada da página seleciona na navbar
    $arquivo_pai = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <!--[if lt IE 8]>

        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

        <![endif]-->

        <!-- Add your site or application content here -->

        <?php include_once "./header.php" ?>


        <div class="container-fluid">

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alterarTipoFornecedor.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Tipo de Fornecedor</h3>

                            <br>

                            <small>Tipo de Fornecedor: </small>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input class="form-control" placeholder="Tipo de fornecedor" name="tipoFornecedor" required autofocus id ="tipoFornecedor" type="text" value="<?= $tipo_fornecedor->getNome();?>">
                                <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $tipo_fornecedor->getPkId();?>">
                            </div>

                            <br>

                            <small>Informar se o item está ativo:</small>
                                <div class="checkbox">
                                    <label>
                                        <?php if($tipo_fornecedor->getFlag_ativo() == 1){?>
                                            <input type="checkbox" id="ativo" name="flag_ativo" value="1" checked>Ativo
                                        <?php }else{ ?>
                                            <input type="checkbox" id="ativo" name="flag_ativo" value="1">Ativo
                                        <?php } ?>

                                    </label>
                                </div>
                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('gerenciar_fornecedor', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

        <script>
            var ativo =   <?=$formaPgt->getFlag_ativo();?>

            $( document ).ready(function() {

                if (ativo == 1) {

                    $('#ativo').attr('checked', true);

                }

            });
        </script>

    </body>

</html>
<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlIngrediente.php";

    include_once MODELPATH."/ingrediente.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerIngrediente($_SG['link']);

    $item_composicao = $controle->select($_GET['cod'],2);     //alterar o modo

    //usado para coloração customizada da página selecionada na navbar
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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraIngrediente.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                        <h3>Dados do Item de Composição</h3>

                        <br>

                        <h5>Nome do Item de Composição: </h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                            <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?= $item_composicao->getNome();?>">
                            <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $item_composicao->getPkId();?>">

                        </div>

                        <br>

                        <h5>Unidade de medida utilizada no ingrediente:</h5>
                        <select name="medidaItem" id="medidaItem" class="form-control" readonly>
                            <option selected value="<?= $item_composicao->getUnidade(); ?>"><?= $item_composicao->getUnidade(); ?></option>
                        </select>

                        <br>

                        <h5>Valor (por unidade):</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input required class="form-control" placeholder="Valor da unidade" id="valor" name="valor" value="<?= $item_composicao->getValor(); ?>" type="number" step="0.01" min="0.01" max="9999">
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

                    <a href="ingredientesLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

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
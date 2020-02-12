<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlItemComposicao.php";

    include_once MODELPATH."/item_composicao.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerItemComposicao($_SG['link']);

    $item_composicao = $controle->selectId($_GET['cod']);     //alterar o modo

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

                        <h3>Dados do Item de Composição</h3>

                        <br>

                        <h5>Nome do Item de Composição: </h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                            <input class="form-control" placeholder="Ex: Pão" name="itemComposicao" required autofocus id ="itemComposicao" type="text" value="<?$item_composicao->getNome();?>">
                            <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $item_composicao->getPkId();?>">

                        </div>

                        <br>

                        <h5>Unidade de medida utilizada no ingrediente:</h5>
                        <select name="medidaItem" id="medidaItem" class="form-control">
                            <option value="quilograma">Quilos</option>
                            <option value="grama">Gramas</option>
                            <option value="unidades">Unidades</option>
                        </select>

                        <br>

                        <h5>Quantidade do produto(em medidas): </h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                            <input class="form-control" placeholder="Ex: 100 (gramas) ou 2 (kg)" name="qtdComposicao" required autofocus id ="qtdComposicao" type="number" value="<?$item_composicao->getQtd();?>">
                        </div>

                        <br>

                        <br>
                        <h5>Valor (por unidade):</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <input required class="form-control" placeholder="Valor da unidade" id="valor" name="valor" value="<?$item_composicao->getValor();?>" type="number" step="0.01" min="1" max="9999">
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
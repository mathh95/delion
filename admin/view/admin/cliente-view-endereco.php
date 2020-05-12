<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once HOMEPATH."home/controler/controlCliente.php";
    include_once HOMEPATH."home/controler/controlEndereco.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();
    $controle = new controlEndereco($_SG['link']);
    $controleUsuario = new controlerUsuario($_SG['link']);
    $controleCliente = new controlCliente($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $endereco = $controle->selectById($_GET['codEnd']);
    $cliente = $controleCliente->select($_GET['codCliente'],2);

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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alterarEndereco.php">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <h3>Endereço do Cliente</h3>
                            <br>
                            <small> Cep: </small>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>
                                <input class="form-control" placeholder="CEP" name="cep" autofocus id ="cep" type="text" value="<?= $endereco->cep;?>">
                                <input class="form-control" name="cod_endereco" id ="cod_endereco" type="hidden" value="<?= $endereco->getPkId();?>">
                                <input class="form-control" name="cod_cliente" id ="cod_cliente" type="hidden" value="<?= $cliente->getPkId();?>">

                            </div>

                            <br>

                            <small> Rua: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Rua" name="rua" autofocus id="rua" type="text" value="<?=$endereco->logradouro; ?>">

                            </div>

                            <br>

                            <small> Número: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Rua" name="numero" autofocus id="numero" type="number" value="<?=$endereco->getNumero(); ?>">

                            </div>

                            <br>

                            <small>Bairro:</small>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Bairro" name="bairro" autofocus id="bairro" type="text" value="<?=$endereco->bairro; ?>">

                            </div>

                            <br>

                            <small>Cidade:</small>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Cidade" name="cidade" autofocus id="cidade" type="text" value="<?=$endereco->cidade; ?>">

                            </div>
                            
                            <br>

                            <small>Complemento:</small>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Complemento" name="complemento" autofocus id="complemento" type="text" value="<?=$endereco->getComplemento(); ?>">

                            </div>

                            <br>
                            
                            <small>Referência:</small>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Referência" name="referencia" autofocus id="referencia" type="text" value="<?=$endereco->getReferencia(); ?>">

                            </div>

                            <br>


                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('adicional', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp; Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <a href="clienteLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

        <script>
            var ativo =   <?=$adicional->getFlag_ativo();?>

            $( document ).ready(function() {

                if (ativo == 1) {

                    $('#ativo').attr('checked', true);

                }

            })
        </script>

    </body>

</html>
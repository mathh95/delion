<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlCategoria.php";

    include_once MODELPATH."/categoria.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerCategoria($_SG['link']);

    $categoria = $controle->select($_GET['cod'], 2);

    //usado para coloração customizada da página seleciona na navbar
    $father_filename = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <?php include_once "./header.php" ?>


        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraCategoria.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Categoria</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $categoria->getNome(); ?>"/>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="hidden" value="<?=  $categoria->getCod_categoria(); ?>"/>

                            </div>

                            <br>

                            <small>Icone: <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg).)</span></small>

                            <br>

                            <img src="../../<?=  $categoria->getIcone(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <br>

                            <small style="color:red">Selecione uma imagem caso queira substituir a imagem já existente.</small>

                            <input type="file" name="arquivo">

                            <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="hidden" value="../<?=  $categoria->getIconeAbsoluto(); ?>"/>

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('categoria', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="bannerLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

                    </div>

                </div>

            </form>

        </div>

        <footer>

            <div class="col-md-12">

                <div class="row">

                    <img src="../../img/Kionux_1.jpg" class="img-responsive" alt="" />

                </div>

            </div>

        </footer>

        <?php include VIEWPATH."/rodape.html" ?>

    </body>

</html>
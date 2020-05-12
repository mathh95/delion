<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlImagem.php";

    include_once MODELPATH."/imagem.php";

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


        <?php

            $controle=new controlerImagem($_SG['link']);

            $imagem = $controle->select($_GET['cod'], 2);

            $paginas=json_decode($imagem->getPagina());

            $p="[";

            foreach ($paginas as $pagina) {

                $p.='"'.$pagina.'",';

            }

            $p.="]";

        ?>

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraImagem.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados da imagem</h3>

                            <br>

                            <small>Nome: (Apenas para referência.)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $imagem->getNome(); ?>"/>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="text" value="<?=  $imagem->getPkId(); ?>"/>

                                <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="text" value="../<?=  $imagem->getFotoAbsoluto(); ?>"/>

                            </div>

                            <br>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $imagem->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small>Foto:<br/> 

                               <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). ) </span>

                            </small>
                            <input type="file" name="arquivo" id ="arquivo" required="">

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('imagem', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="imagemLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>


    </body>

</html>
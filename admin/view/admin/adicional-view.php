<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlAdicional.php";

    include_once MODELPATH."/adicional.php";

    include_once CONTROLLERPATH . "/controlCategoria.php";

    include_once MODELPATH . "/categoria.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerAdicional($_SG['link']);

    $controleCategoria = new controlerCategoria($_SG['link']);
    $categorias = $controleCategoria->selectAll();

    $adicional = $controle->selectId($_GET['cod']);

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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraAdicional.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do adicional</h3>

                            <br>

                            <small>* Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?= $adicional->getNome();?>">

                                <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $adicional->getPkId();?>">

                            </div>

                            <br>

                            <small>* Preço: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Preço" name="preco" required autofocus id="preco" type="number" step="0.01" min="0.01" max="99" value="<?=$adicional->getPreco(); ?>">

                            </div>

                            <br>

                            <small>Categoria *: </small>

                            <select class="form-control" name="categoria" id="categoria" required>

                                <option value="">Selecionar Categoria</option>

                                <?php

                                foreach ($categorias as $categoria) {
                                    echo "<option value='" . $categoria->getPkId() . "' id='" . $categoria->getPkId() . "'>" . $categoria->getNome() . "</option>";
                                }
                                ?>

                            </select>
                            
                            <br>


                            <small>Informar se o item está ativo:</small>
                                <div class="checkbox">

                                    <label>

                                    <input type="checkbox" id="ativo" <?= ($adicional->getFlag_ativo() == 1) ? "checked" : "" ?> name="flag_ativo" value="1">Ativo

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

                    if (in_array('adicional', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp; Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <a href="adicionalLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        
        <script>

            $( document ).ready(function() {
                var ativo =   <?=$adicional->getFlag_ativo();?>
                var categoria = '<?= $adicional->getCategoria() ?>';


                //Arruma o checkbox do adicional ativo
                if (ativo == 1) {
                    $('#ativo').attr('checked', true);
                }

                //Deixa a categoria correta selecionada
                if (categoria) $('#' + categoria).attr('selected', true);

            });



        </script>

    </body>

</html>
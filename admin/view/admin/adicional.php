<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlAdicional.php";

    include_once MODELPATH."/adicional.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businesAdicional.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do item do Adicional</h3>

                            <br>

                            <small>* Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text">

                            </div>

                            <br>
                            
                            <small>* Preço : </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-dollar-sign"></i></span>

                                <input class="form-control" placeholder="Preço" name="preco" required autofocus id="preco" type="number" step="0.01">

                            </div>

                            <br>


                            <small>Informar se o item está ativo:</small>

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="ativo" name="flag_ativo" value="1">Ativo

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

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

        <script>

            tinymce.init({selector: 'textarea', plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime media nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

                ],

                toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });

        </script>

    </body>

</html>
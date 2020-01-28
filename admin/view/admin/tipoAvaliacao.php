<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlEmpresa.php";

    include_once MODELPATH."/empresa.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

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

        <form class="form-horizontal" id="form-cadastro-cliente" method="post" action="../../controler/businesTipoAvaliacao.php">

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-5">

                        <h3>Tipo de avaliação:</h3>

                        <small>Nome:</small>

                        <br>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

                            <input class="form-control" placeholder="Nome" name="nome" value="" required autofocus type="text">

                        </div>

                        <br>

                        <small>Ativo:</small>

                        <br>

                        <div class="input-group">

                            <input name="flag" value="ativo" type="checkbox">

                        </div>

                        <br>

                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="col-md-5" style="padding-left: 0px;">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('avaliacao', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                    </div>

                </div>

            </div>

        </form>

        </div>

        

        <?php include VIEWPATH."/rodape.html" ?>

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

        <script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>

        <script type="text/javascript">

        $("#fone").on("blur", function() {

            var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );



            if( last.length == 3 ) {

                var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );

                var lastfour = move + last;

                var first = $(this).val().substr( 0, 9 );



                $(this).val( first + '-' + lastfour );

            }

        });

        </script>

    </body>

</html>
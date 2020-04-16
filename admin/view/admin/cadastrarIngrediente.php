<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";


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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businesIngrediente.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Cadastrar Ingrediente</h3>

                            <br>

                            <h5>Nome do Ingrediente:* </h5>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-edit"></i></span>
                                <input class="form-control" placeholder="Ex: Pão" name="itemComposicao" required autofocus id ="itemComposicao" type="text">
                            </div>

                            <br>

                            <h5>Unidade ou Medida utilizada no ingrediente:*</h5>
                            <select name="medidaItem" id="medidaItem" class="form-control" required>
                                <option value="Unidade(s)" selected>Unidade</option>
                                <option value="Quilograma(s)">Quilograma</option>
                                <option value="Grama(s)">Grama</option>
                                <option value="Litro(s)">Litro</option>
                                <option value="Mililitro(s)">Mililitro</option>
                            </select>

                            <br>

                            <h5>Valor:*</h5>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                <input required class="form-control" placeholder="10,00" id="valor" name="valor" value="" type="number" step="0.01" min="0.01" max="9999">
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

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                    <a href="ingredientesLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair sem Cadastrar</a>

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

    </body>

</html>
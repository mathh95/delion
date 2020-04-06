<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlTipoAvaliacao.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/tipo_avaliacao.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerTipoAvaliacao($_SG['link']);

    $tipo = $controle->selectSemCategoria($_GET['cod'], 2);

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

           <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraTipoAvaliacao.php">

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-5">

                        <h3>Dados do item do cardápio</h3>

                        <br>

                        <small>Nome: </small>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                            <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?= $tipo->getNome();?>">

                            <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $tipo->getCod_tipo_avaliacao();?>">

                        </div>

                        <br>

                        <?php 
                            if($tipo->getFlag_ativo() == 1){ ?>

                            <small>Informar se o item está ativo:</small>
                        
                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="ativo" name="flag_ativo" value="<?=(($tipo->getFlag_ativo() == 1) ? "1" : "0")?>" checked>Ativo

                                </label>

                            </div>

                        <?php }else{?>

                            <small>Informar se o item está ativo:</small>
                        
                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="ativo" name="flag_ativo" value="<?=(($tipo->getFlag_ativo() == 1) ? "1" : "0")?>">Ativo

                                </label>

                            </div>
                        <?php } ?>
                        
                    </div>

                </div>

            </div>

            <div class="col-md-5">

                <div class="pull-left">

                <?php

                $permissao =  json_decode($usuarioPermissao->getPermissao());

                if (in_array('avaliacao', $permissao)){ ?>

                    <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

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

        <!-- <script>

            tinymce.init({selector: 'textarea', plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime media nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

                ],

                toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });

            var categoria =   <?php//echo $cardapio->getCategoria()?>;

            $( document ).ready(function() {

                $('#' + categoria).attr('selected', true);

            })

            var ativo =   <?php//echo $cardapio->getFlag_ativo()?>;

            $( document ).ready(function() {

                if (ativo == 1) {

                    $('#ativo').attr('checked', true);

                }

            })
            
        </script> -->

    </body>

</html>

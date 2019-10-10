<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

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

            <h3>Novo Raio de Entrega</h3>
                
            <p>*Informe Taxa e Tempo de acordo com o Alcance</p>

        <div class="col-lg-9">
            <form class="form-horizontal" method="POST" action="../../controler/businessNovoRaio.php">
                <div class="table-responsive">
                    <table class="table table-striped table-highlight">
                    <thead>
                        <th class="col-lg-2">Alcance (km)</th>
                        <th class="col-lg-2">Taxa (R$)</th>
                        <th class="col-lg-2">Tempo (Minutos)</th>
                        <th class="col-lg-2">Min. p/ Frete Grátis (R$)</th>
                        <th class="col-lg-1" style="text-align:center;">Ativo</th>
                    </thead>
                    
                    <tbody>
                        
                        
                    <tr>                         
                        <td>    
                        <div class="input-group">
                            
                            <span class="input-group-addon"><i class="fas fa-road"></i></span>
                            <input class="form-control" name="raio_km" min="1"  type="number" placeholder="Ex.: 3">
                        </div>
                        </td>
                        
                        <td>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                            <input class="form-control taxa_entrega" name="taxa_entrega" type="number" min="0" step="any" placeholder="Ex.: 5,00">

                            </div>
                        </td>

                        <td>    
                            <div class="input-group">
                                
                                <span class="input-group-addon"><i class="far fa-clock"></i></span>
                                <input class="form-control" placeholder="Ex.: 30"  min="1" name="tempo"  type="number" min="1" placeholder="" >
                            </div>
                        </td>
                        
                        <td>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                            <input class="form-control" placeholder="Ex.: 50,00" name="min_frete_gratis" type="number" min="0" step="any" placeholder="">

                            </div>
                        </td>

                        <td style="text-align:center; vertical-align: middle;">
                        <div>
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="flag_ativo"
                                value="1"
                            >
                            </div>
                        </td>

                    </tr>
                        
                    </tbody>
                    </table>
                </div>


                <div>

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('info_entrega', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>
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
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

        <?php include_once "./header.php" ?>

        <div class="container-fluid">

            <h3>Nova Faixa de Horário</h3>
                
        <div class="col-lg-7">
            <form class="form-horizontal" method="POST" action="../../controler/businessNovaFaixaHorario.php">
                <div class="table-responsive">
                    <table class="table table-striped table-highlight">
                    <thead>
                        <th class="col-lg-5">Nome de Identificação</th>
                        <th class="col-lg-1">Horário Inicial</th>
                        <th class="col-lg-1">Horário Final</th>
                    </thead>
                    
                    <tbody>
                        <tr>                         
                            <td>    
                            <div class="input-group">
                                
                                <span class="input-group-addon"><i class="fas fa-font"></i></span>
                                <input class="form-control" name="nome" type="text">
                            </div>
                            </td>
                            
                            <td>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-clock"></i></span> 
                                <input class="form-control" name="inicio"  type="time" >
                                </div>
                            </td>

                            <td>    
                                <div class="input-group">
                                    
                                    <span class="input-group-addon"><i class="far fa-clock"></i></span>
                                    <input class="form-control" name="final"  type="time" >
                                </div>
                            </td>

                        </tr>
                        
                    </tbody>
                    </table>
                </div>

                <div>

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('cardapio', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                        <button type="button" class="btn btn-kionux" onclick="window.location='gerenciarFaixaHorarios.php'"><i class="fa fa-undo"></i> Voltar</button>

                    <?php } ?>

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
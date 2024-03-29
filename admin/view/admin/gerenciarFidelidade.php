<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlEmpresa.php";
    include_once CONTROLLERPATH."/controlFidelidade.php";
    include_once MODELPATH."/empresa.php";
    include_once MODELPATH."/fidelidade.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle = new controlerEmpresa($_SG['link']);
    $empresa = $controle->selectAll();

    $controle = new controlerFidelidade($_SG['link']);
    $fidelidade = $controle->selectByFkEmpresa($empresa->getPkId());
    
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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraFidelidade.php">

                <div class="col-md-12">

                    <h3>Gerenciar Programa de Fidelidade</h3>
                    <div class="row">

                        <input class="form-control" style="display: none;" placeholder="" name="cod_fidelidade" value="<?=$fidelidade->getPkId();?>"  type="hidden">
                        
                        
                        <div class="col-md-6">
                            <h5>Taxa de conversão de compra para Pontos:</h5>

                            <div class="col-md-3 input-group">
                                <span class="input-group-addon">R$ 1 <i class="fas fa-equals"></i></i></span>
                                <input required class="form-control" placeholder="1" id="taxa_conversao_pts" name="taxa_conversao_pts" value="<?=$fidelidade->getTaxaConversaoPts()?>" type="number" step="0.1">
                            </div>
                        </div>
                    </div>

                <br>

                </div> 

                <br>


                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('gerenciar_fidelidade', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="listarFidelidade.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

    </body>

    <script>

    </script>


</html>
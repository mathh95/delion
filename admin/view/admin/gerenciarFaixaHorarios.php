<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlEmpresa.php";
    include_once CONTROLLERPATH."/controlFaixaHorario.php";
    include_once MODELPATH."/empresa.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle = new controlerEmpresa($_SG['link']);
    $empresa = $controle->selectAll();

    $controleFaixaHorario = new controlerFaixaHorario($_SG['link']);
    $faixas_horario = $controleFaixaHorario->selectAll();    

    
    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

    $permissao =  json_decode($usuarioPermissao->getPermissao());
    if (!in_array('cardapio', $permissao)){
        header("Location: /admin");      
    }

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>
        <?php include VIEWPATH."/cabecalho.html" ?>
    </head>

    <body>
        <?php include_once "./header.php" ?>

        <div class="container-fluid">
            <div class="col-md-12">

                <h3>Gerenciar Faixas de Horários</h3>

                <i class="fas fa-info-circle"></i>
                    &nbsp;Faixas de Horários para disponibilidade dos Produtos.
                
                    <button type="button" class="btn btn-success" id="addFaho" onclick="window.location='novaFaixaHorario.php'">Nova Faixa de Horário</button>

                </div>
                <hr style="margin-bottom:10px;">
            </div>  

            <div class="col-md-12">
                <div class="row">
                

                    <form class="form-horizontal" method="POST" action="../../controler/alteraFaixaHorario.php">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-highlight">
                                <thead>
                                    <th class="col-lg-1">#ID</th>
                                    <th class="col-lg-5">Nome Identificador</th>
                                    <th class="col-lg-3">Horário Início </th>
                                    <th class="col-lg-3">Horário Final</th>
                                </thead>

                                <tbody>

                                    <?php foreach ($faixas_horario as $key => $faho) { ?>

                                        <tr>
                                            <input style="display: none;" name="faho_pk_id[]" value="<?= $faho->getPkId(); ?>" type="text">


                                            <td style="vertical-align: middle;font-weight:bold;">
                                                <span style="float:left;">
                                                        <?= $faho->getPkId(); ?>
                                                </span>
                                            </td>

                                            <td>
                                                <div class="input-group">

                                                    <input class="form-control" name="faho_nome[]" value="<?= $faho->getNome(); ?>" type="text">

                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">

                                                    <input class="form-control" name="faho_inicio[]" value="<?= $faho->getInicio(); ?>" type="time">

                                                </div>
                                            </td>

                                            <td>
                                                <div class="input-group">

                                                    <input class="form-control" name="faho_final[]" value="<?= $faho->getFinal(); ?>" type="time">

                                                </div>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                </tbody>
                            </table>

                        </div>

                        <div class="col-lg-4">
                            <!-- Button Salvar -->
                            <?php
                                $permissao =  json_decode($usuarioPermissao->getPermissao());

                                if (in_array('cardapio', $permissao)) { ?>

                                    <div><button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button></div>

                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php include VIEWPATH."/rodape.php" ?>

    </body>

    <script>

        // $.ajax(function({
            
        // }));
    </script>


</html>
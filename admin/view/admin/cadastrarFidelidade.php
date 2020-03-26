<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlEmpresa.php";
    include_once CONTROLLERPATH."/controlFidelidade.php";
    include_once CONTROLLERPATH."/controlProduto.php";
    include_once MODELPATH."/produto.php";


    $_SESSION['permissaoPagina'] = 0;
    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle = new controlerEmpresa($_SG['link']);
    $empresa = $controle->selectAll();

    $controle = new controlerFidelidade($_SG['link']);
    $fidelidade = $controle->selectByFkEmpresa($empresa->getPkId());

    $controler_produto = new controlerProduto($_SG['link']);
    $produtos = $controler_produto->selectAll();

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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/businessProdutoFidelidade.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-6">
                            <h3>Adicionar Produto ao Programa de Fidelidade</h3>

                            <input class="form-control" style="display: none;" placeholder="" name="fk_fidelidade" value="<?=$fidelidade->getPkId();?>"  type="hidden">
                            
                            <div class="col-md-12">
                                <small>Produto *: </small>
                                <select class="form-control" name="pk_id" id="pk_id" required>

                                    <option value="">Selecionar Produto</option>

                                    <?php
                                        foreach ($produtos as $produto) {
                                            echo "<option value='".$produto->getPkId()."'>".$produto->getNome()."</option>";
                                        }
                                    ?>
                                </select>
                                
                                <br>
                                
                            </div>


                            <div class="col-md-4">
                                <small>Pontos Necessários para Resgate*: </small>
                                <select class="form-control" name="pontos_resgate" id="pontos_resgate" required>

                                    <option value="30">30 Pts</option>
                                    <option value="50">50 Pts</option>
                                    <option value="80">80 Pts</option>
                                    <option value="90">90 Pts</option>
                                    <option value="120">120 Pts</option>
                                    <option value="200">200 Pts</option>
                                    <option value="220">220 Pts</option>
                                    <option value="250">250 Pts</option>

                                </select>
                            </div> 

                            
                        </div>

                    </div>
                    
                    <br>
                    <br>

                    <div class="col-md-3">

                        <div class="pull-left">

                        <?php

                        $permissao =  json_decode($usuarioPermissao->getPermissao());

                        if (in_array('gerenciar_fidelidade', $permissao)){ ?>

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

    </body>

</html>


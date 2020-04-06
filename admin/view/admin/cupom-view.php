<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlCupom.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

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


        <?php
        $controleUsuario = new controlerUsuario($_SG['link']);

        $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

        $controle = new controlCupom($_SG['link']);

        $cupom = $controle->selectByPk($_GET['cod_cupom']);

        $vencimento_data = date('d/m/Y', strtotime($cupom->getVencimento_data()));

        $vencimento_hora = date('H:i', strtotime($cupom->getVencimento_hora()));

        ?>

        <div class="container-fluid">
            <!-- Alterar aqui, criar uma classe businesCupom -->
            <form class="form-horizontal" id="form-cadastro-cupom" method="POST" action="../../controler/alteraCupom.php">
            <!-- <form class="form-horizontal"> -->
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Cupom</h3>

                            <small>Código do Cupom:</small>

                            <div id="test">
                                    <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $cupom->getPkId();?>">
                                    <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código do Cupom" value="<?=$cupom->getCodigo();?>" readonly/>
                                    
                                    <br>

                                    <!-- <button type="button" class="btn btn-kionux" id="run">Gerar Cupom</button> -->
                            </div>

                            <br>

                            <small>Valor de Desconto:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                                <input class="form-control" placeholder="Valor do desconto"  step="0.01" min="1" max="99" id="valor" name="valor"  type="number" step="0.01" min="1" max="99" value="<?=$cupom->getValor();?>">

                            </div>     

                            <br>

                            <small>Valor Minimo:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                                <input class="form-control" placeholder="Valor minimo para uso do Cupom"  step="0.01" min="1" max="99" id="valorMinimo" name="valorMinimo"  type="number" step="0.01" min="1" max="99" value="<?=$cupom->getValor_minimo();?>">

                            </div>     

                            <br>


                            <small>Quantidade de Usos do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input class="form-control" placeholder="Número de cupons" id="qtdcupom" name="qtdcupom" value="<?=$cupom->getQtde_inicial();?>" type="number" readonly>

                            </div> 

                            <br>

                            <small>Data de Vencimento do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input class="form-control" placeholder="" id="vencimento_data" name="vencimento_data" value="<?=$cupom->getVencimento_data();?>" type="date">

                            </div> 

                            <br>

                            <small>Hora de Vencimento do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input class="form-control" placeholder="" id="vencimento_hora" name="vencimento_hora" value="<?=$cupom->getVencimento_hora();?>" type="time">

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

                        if (in_array('cupom', $permissao)){ ?>

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o" onclick="confereSenha();"></i> Salvar</button>

                        <?php } ?>

                        </div>

                        <div class="pull-right">

                            <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        

        <?php include VIEWPATH."/rodape.php" ?>

        <script>

            function confereSenha() {

                if($("#senha1").val().length>5){

                    $("#alteraSenha").submit();

                }else{

                    alertComum('Erro!','Senhas devem conter no mínimo 6 caracteres!',2);

                }

            }
            

        </script>

    </body>

</html>
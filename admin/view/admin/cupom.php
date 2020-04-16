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
            <!-- Alterar aqui, criar uma classe businesCupom -->
            <form class="form-horizontal" id="form-cadastro-cupom" method="POST" action="../../controler/businesCupom.php">
            <!-- <form class="form-horizontal"> -->
                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Cupom</h3>

                            <small>*Código do Cupom:</small>

                            <div id="test">
                                    <input required id="codigo" class="form-control" type="text" name="codigo" placeholder="Código do Cupom" readonly/>
                                    
                                    <br>

                                    <button type="button" class="btn btn-kionux" id="gera_cod">Gerar Cupom</button>
                            </div>

                            <br>

                            <small>*Valor de Desconto:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                                <input required class="form-control" placeholder="Valor do desconto" id="valor" name="valor" value="" type="number" step="0,01" min="1" max="99">

                            </div>     

                            <br>

                            <small>*Valor Minimo:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                                <input required  class="form-control" placeholder="Valor minimo para uso do Cupom" id="valorMinimo" name="valorMinimo" value="12.00" type="number" step="0.01" min="1" max="99">

                            </div>     

                            <br>

                            <small>*Quantidade de Usos do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input required class="form-control" placeholder="Número de cupons" id="qtdcupom" name="qtdcupom" value="1" type="number">

                            </div> 

                            <br>

                            <small>*Data de Vencimento do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input required class="form-control" placeholder="" name="vencimento_data" value="<?=date('Y-m-d')?>" type="date">

                            </div> 

                            <br>

                            <small>*Hora de Vencimento do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input required class="form-control" placeholder="" name="vencimento_hora" value="00:00" type="time">

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

                            <a href="cupomLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair sem Cadastrar</a>

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
            
            function uniqId() {
                    var ts=String(new Date().getTime()), i = 0, out = '';
                        for(i=0;i<ts.length;i+=4) {        
                        out+=Number(ts.substr(i, 2)).toString(36);    
                    }
                    out = out.toUpperCase();
                return ('D'+out);
            }

            $(function () {
                    $('#gera_cod').on('click', function () {
                        var text = $('#codigo');
                        text.val(uniqId());    
                });
            });

        </script>

    </body>

</html>
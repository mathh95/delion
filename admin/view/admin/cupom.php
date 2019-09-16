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
    $father_filename = basename(__FILE__, '.php');

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

                            <small>Código do Cupom:</small>

                            <div id="test">
                                    <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código do Cupom" readonly/>
                                    
                                    <br>

                                    <button type="button" class="btn btn-kionux" id="run">Gerar Cupom</button>
                            </div>

                            <br>

                            <small>Valor de Desconto:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>

                                <input class="form-control" placeholder="Valor do desconto" id="valor" name="valor" value="" type="number" step="0.01" min="1" max="99">

                            </div>     

                            <br>

                            <small>Quantidade de Usos do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input class="form-control" placeholder="Número de cupons" id="qtdcupom" name="qtdcupom" value="" type="number">

                            </div> 

                            <br>

                            <small>Vencimento do Cupom</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-hourglass"></i></span>

                                <input class="form-control" placeholder="" name="vencimento" value="" type="date">

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

                        if (in_array('pedidoWpp', $permissao)){ ?>

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

        <footer>

            <div class="col-md-12">

                <div class="row">

                    <img src="../../img/Kionux_1.jpg" class="img-responsive" alt="" />

                </div>

            </div>

        </footer>

        <?php include VIEWPATH."/rodape.html" ?>

        <script>

            function confereSenha() {

                if($("#senha1").val().length>5){

                    $("#alteraSenha").submit();

                }else{

                    alertComum('Erro!','Senhas devem conter no mínimo 6 caracteres!',2);

                }

            }
            
            function uniqid() {
                    var ts=String(new Date().getTime()), i = 0, out = '';
                    for(i=0;i<ts.length;i+=2) {        
                    out+=Number(ts.substr(i, 2)).toString(36);    
                    }
                return ('d'+out);
            }

            $(function () {
                    $('#run').on('click', function () {
                        var text = $('#codigo');
                        text.val(uniqid());    
                });
            });

        </script>

    </body>

</html>
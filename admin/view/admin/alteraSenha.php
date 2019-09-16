<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlEmpresa.php";

    include_once MODELPATH."/empresa.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    //usado para coloração customizada da página seleciona na navbar
    $father_filename = basename(__FILE__, '.php');

?>

<!doctype html>

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

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Configurações</h1>

                </div>

            </div>

            <h3 class="col-sm-offset-4 col-md-4"> Alterar Senha </h3>

            <form action="../../controler/alteraSenha.php" class='col-md-12 col-md-offset-0 form-horizontal'  method="post" enctype="multipart/form-data" id="alteraSenha">

                <div class="panel-body">

                    <div class="form-group">

                        <label class="col-md-5 control-label">Senha Atual</label>

                        <div class="col-md-3">

                            <input type="password" class="form-control" id="atual" name="atual" placeholder="Senha Atual" maxlength="50" required/>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-5 control-label">Nova Senha</label>

                        <div class="col-md-3">

                            <input type="password" class="form-control" id="senha1" name="senha1" maxlength="50" placeholder="Nova Senha" min="4" required/>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-5 control-label">Confirmar nova senha</label>

                        <div class="col-md-3">

                            <input type="password" class="form-control" id="senha2" name="senha2" maxlength="50" placeholder="Confirmar nova senha" min="4" required/>

                        </div>

                    </div>

                </div>

                <div class="form-group" >

                    <button type="button" onclick="confereSenha();" class="btn btn-success col-sm-offset-4 col-md-3" style="left: 40px;">Alterar</button>

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

        <script src="../../js/alert.js" ></script>

        <script type="text/javascript">

            function validar(campo) {

                //se não desejar números é só remover da regex abaixo

                //var regex = '[^a-zA-Z0-9]+';

                if(campo.match(regex)) {//encontrou então não passa na validação

                    return false;

                }else {//não encontrou caracteres especiais

                    return true;

               }

            }

            function confereSenha() {

                if($("#senha1").val()==$("#senha2").val()){

                    //if(validar($("#senha1").val())){

                        if($("#senha1").val().length>5){

                            $("#alteraSenha").submit();

                        }else{

                            alertComum('Erro!','Senhas devem conter no mínimo 6 caracteres!',2);

                        }

                    //}else{

                    //    alertComum('Erro!','Senhas devem conter apenas letras e números!',2);

                    //}

                }else{

                    alertComum('Erro!','Senhas não conferem',2);

                }

            }

        </script>

    </body>

</html>
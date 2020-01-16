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

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

        <?php include_once "./header.php" ?>


        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/businesEvento.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Evento</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text">

                            </div>

                            <br>

                            <small>Informar se o evento é antigo:</small>

                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="antigo" name="flag_antigo" value="1" onclick="showDate();">Antigo

                                </label>

                            </div>

                            <br>

                            <div id="checkboxDate">

                                <small>Data: </small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-link"></i></span>

                                    <input class="form-control" placeholder="dd/mm/aaaa" name="data" id ="data" type="date" max="<?= date('Y-m-d');?>"  min="<?= date('Y-m-d', strtotime('-3 years'))?>" >

                                </div>

                            </div>

                            <br>
                                   
                            <small style="display: grid">Foto:
                                
                                <span style="color:red">Proporção sugerida 635[largura] x 391[altura]</span>
                                
                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg).)</span></small>

                                <input type="file" name="arquivo" id ="arquivo" required="">

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('evento', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

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

        <script>

             $( document ).ready(function() {

                $('#antigo').attr('checked', true);

            })

            function showDate(){

                if ($("#antigo").prop("checked")) {

                    $("#checkboxDate").show();

                }else{

                    $("#checkboxDate").hide();

                }

            }

        </script>

    </body>

</html>
<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/controlEvento.php";

    include_once MODELPATH."/evento.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerEvento($_SG['link']);

    $evento = $controle->select($_GET['cod'], 2);

    //usado para coloração customizada da página selecionada na navbar
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

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraEvento.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Evento</h3>

                            <br>

                            <small>Nome: </small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil-alt"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $evento->getNome(); ?>">

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="hidden" value="<?=  $evento->getCod_evento(); ?>"/>

                                <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="hidden" value="../<?=  $evento->getFotoAbsoluto(); ?>"/>

                            </div>

                            <br>

                            <small>Informar se o evento é antigo:</small>

                            <div class="checkbox" >

                                <label>

                                    <input type="checkbox" id="antigo" name="flag_antigo" value="1" onclick="showDate();">Antigo

                                </label>

                            </div>

                            <br>

                            <div id="checkboxDate">

                                <small>Data: </small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>

                                    <input class="form-control" placeholder="dd/mm/aaaa" name="data" id ="data" type="date" max="<?= date('Y-m-d');?>"  min="<?= date('Y-m-d', strtotime('-3 years'))?>"  value="<?=  $evento->getData(); ?>">

                                </div>

                            </div>

                            <br>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $evento->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small><span style="color:red">(Utilizar uma imagem no tamanho 404[largura] x 424[altura] se evento for Antigo. Tamanho 1005[largura] x 620[altura] se evento for Novo. Formato (.png) ou (.jpg).)</span></small>

                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('evento', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="EventoLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

                    </div>

                </div>

            </form>

        </div>
        

        <?php include VIEWPATH."/rodape.html" ?>

        <script>

            var antigo =   <?=$evento->getFlag_antigo()?>;

            $( document ).ready(function() {

                console.log(antigo);

                if (antigo == 1) {

                    $('#antigo').attr('checked', true);

                    $("#checkboxDate").show();

                }else{

                    $("#checkboxDate").hide();

                }

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
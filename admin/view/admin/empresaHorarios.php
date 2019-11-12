<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlEmpresa.php";

    include_once MODELPATH."/empresa.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);


    $controle=new controlerEmpresa($_SG['link']);

    $empresa = $controle->selectAll();

    //usado para coloração customizada da página seleciona na navbar
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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraEmpresaHorarios.php">

                <div class="col-md-12">

                    <div class="row">

                        </div>

                        <div class="col-md-5">

                            <h3>Gerenciar Funcionamento</h3>

                            <!-- <h4>Disponibilidade de acordo com os Dias/Horários cadastrados abaixo:</h4> -->
                            
                            <input class="form-control" style="display: none;" placeholder="" name="cod_empresa" value="<?=  $empresa->getCod_empresa(); ?>"  type="text">


                            <h5><i class="fas fa-store-alt"></i>
                            Aberto
                            <input type="checkbox" name="aberto" <?= ($empresa->getAberto() == 1 ? "checked" : "")?> value="1">
                            </h5>
                            
                            <h5><i class="fas fa-truck"></i>
                            Entregando
                            <input type="checkbox" name="entregando" <?= ($empresa->getEntregando() == 1 ? "checked" : "")?> value="1">
                            </h5>
                            
                            
                            <!-- <br>
                            
                            

                            <br> -->
                            <br>

                            <h4>Texto contido no Header/Topo do site</h4>
                            <h5>*Deixe em branco para omitir o texto</h5>

                            <div class="col-md-6">
                                <small>Dias da Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>

                                    <input class="form-control" placeholder="" name="dias_semana" value="<?= $empresa->getDiasSemana(); ?>"  type="text">

                                </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <small>Horário para dias de Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-clock"></i></span>

                                    <input class="form-control" placeholder="" name="horario_semana" value="<?=  $empresa->getHorarioSemana(); ?>"  type="text">

                                </div>
                            </div>

                            <br>
                            
                            <div class="col-md-6">

                                <small>Fim de Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>

                                    <input class="form-control" placeholder="" name="dias_fim_semana" value="<?=  $empresa->getDiasFimSemana(); ?>"  type="text">

                                </div>
                            </div>

                            <div class="col-md-6">

                                <small>Horário parar o Fim de Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-clock"></i></span>

                                    <input class="form-control" placeholder="" name="horario_fim_semana" value="<?=  $empresa->getHorarioFimSemana(); ?>"  type="text">

                                </div>
                            </div>
                        </div>

                    </div>
            
                </div> 
                <br>


                <div class="col-md-5">

                    <div class="pull-right">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('empresa', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

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

    </body>

</html>
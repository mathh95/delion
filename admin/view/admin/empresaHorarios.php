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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraEmpresaHorarios.php">

                <div class="col-md-12">

                    <div class="row">


                        <div class="col-md-12">

                            <h3>Gerenciar Funcionamento</h3>

                            <!-- <h4>Disponibilidade de acordo com os Dias/Horários cadastrados abaixo:</h4> -->
                            
                            <input class="form-control" style="display: none;" placeholder="" name="cod_empresa" value="<?=  $empresa->getPkId(); ?>"  type="text">

                            <h5>Aberto/Entregando nos dias/horários informados abaixo.</h5>
                            <h6>*Caso precise desabilitar o Funcionamento <u>independente</u> das informações inseridas, basta desmarcar os campos (Aberto/Entregando).</h6>


                            <h5><i class="fas fa-store-alt"></i>
                            Aberto
                            <input type="checkbox" name="aberto" <?= ($empresa->getAberto() == 1 ? "checked" : "")?> value="1">
                            </h5>
                            
                            <h5><i class="fas fa-truck"></i>
                            Entregando
                            <input type="checkbox" name="entregando" <?= ($empresa->getEntregando() == 1 ? "checked" : "")?> value="1">
                            </h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <small>Funcionanento:</small>

                            <?php
                                $horarios_inicio = json_decode($empresa->getArrHorariosInicio());
                                $horarios_final = json_decode($empresa->getArrHorariosFinal());
                            ?>

                            <div class="checkbox">
                                
                                <!-- Domingo  -->
                                <label style="display:block;">
                                    <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="diaDom" name="dias[]" value="1"/>Dom &nbsp;
                                    </div>
                                    
                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[0] ?>"/>
                                        &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[0] ?>"/>
                                </label>

                                <!-- Segunda -->
                                <label style="display:block;">
                                    <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="segunda" name="dias[]" value="2"/>Seg &nbsp;
                                    </div>

                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[1] ?>"/>
                                        &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[1] ?>"/>
                                </label>
                                <!-- Terça -->
                                <label style="display:block;">
                                    <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="terca" name="dias[]" value="3"/>Ter &nbsp;
                                    </div>

                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[2] ?>"/>
                                    &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[2] ?>"/>                             
                                </label>
                                <!-- Quarta -->
                                <label style="display:block;">
                                <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="quarta" name="dias[]" value="4"/>Qua &nbsp;
                                    </div>

                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[3] ?>"/>
                                    &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[3] ?>"/>
                                </label>
                                <!-- Quinta -->
                                <label style="display:block;">
                                    <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="quinta" name="dias[]" value="5"/>Qui &nbsp;
                                    </div>
                                    
                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[4] ?>"/>
                                    &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[4] ?>"/>
                                </label>
                                <!-- Sexta -->
                                <label style="display:block;">
                                    <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="sexta" name="dias[]" value="6"/>Sex &nbsp;
                                    </div>

                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[5] ?>"/>
                                    &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[5] ?>"/>
                                </label>
                                <!-- Sábado -->
                                <label style="display:block;">
                                    <div style="display:inline-block;width:70px;">
                                    <input type="checkbox" id="sabado" name="dias[]" value="7"/>Sáb  &nbsp; 
                                    </div>
                                    
                                    Início&nbsp;<input type="time" name="horarios_inicio[]" value="<?= $horarios_inicio[6] ?>"/>
                                    &nbsp;                             
                                    Fim&nbsp;<input type="time" name="horarios_final[]" value="<?= $horarios_final[6] ?>"/>
                                </label>
                            
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-5">

                            <br>

                            <h4>Texto contido no Header/Topo do site</h4>
                            <h5>*Deixe em branco para omitir o texto</h5>

                                
                            <div class="col-md-6">
                                <small>Dias da Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>

                                    <input class="form-control" placeholder="" name="dias_semana" value="<?= $empresa->getTxtDiasSemana(); ?>"  type="text">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <small>Horário para dias de Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-clock"></i></span>

                                    <input class="form-control" placeholder="" name="horario_semana" value="<?=  $empresa->getTxtHorarioSemana(); ?>"  type="text">

                                </div>
                            </div>

                            <br>
                            
                            <div class="col-md-6">

                                <small>Fim de Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar-alt"></i></span>

                                    <input class="form-control" placeholder="" name="dias_fim_semana" value="<?=  $empresa->getTxtDiasFimSemana(); ?>"  type="text">

                                </div>
                            </div>

                            <div class="col-md-6">

                                <small>Horário parar o Fim de Semana:</small>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-clock"></i></span>

                                    <input class="form-control" placeholder="" name="horario_fim_semana" value="<?=  $empresa->getTxtHorarioFimSemana(); ?>"  type="text">

                                </div>
                            </div>
                        </div>
                    </div>
            
                </div> 

                <br>

                <div class="col-md-5">
                    <br>
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

        

        <?php include VIEWPATH."/rodape.php" ?>

    </body>

    <script>

        $(document).ready(function() {

            var dias = '<?= $empresa->getArrDiasSemana(); ?>';
            dias = JSON.parse(dias);
            
            //dia -> 1 == domingo...7 == sábado
            for(let dia of dias){
                // console.log(dia);
                $(":checkbox[value="+dia+"]").prop("checked", "true");
            }
            
        });

    </script>


</html>
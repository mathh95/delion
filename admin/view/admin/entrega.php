<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

include_once CONTROLLERPATH . "/controlUsuario.php";

include_once MODELPATH . "/usuario.php";

include_once CONTROLLERPATH . "/seguranca.php";

include_once CONTROLLERPATH . "/controlEntrega.php";

include_once MODELPATH . "/entrega.php";

$_SESSION['permissaoPagina'] = 0;

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);

$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle = new controlEntrega($_SG['link']);

$entregas = $controle->selectAll();

//usado para coloração customizada da página selecionada na navbar
$arquivo_pai = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

<head>

    <?php include VIEWPATH . "/cabecalho.html" ?>

</head>

<body>

    <!--[if lt IE 8]>

        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

        <![endif]-->

    <!-- Add your site or application content here -->

    <?php include_once "./header.php" ?>

    <div class="container-fluid">

    <div class="col-lg-12">
        <h3>Informações de Entrega</h3>
        <i class="fas fa-info-circle"></i>
            &nbsp;Informe Taxa e Tempo de acordo com o Alcance | <b>Taxa Grátis</b> a partir do valor informado.
            
        <hr style="margin-bottom:10px;">
    </div>

    <div class="row">
        <div class="col-lg-7">
            <form class="form-horizontal" method="POST" action="../../controler/alteraEntrega.php">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-highlight">
                        <thead>
                            <th class="col-lg-1">Alcance</th>
                            <th class="col-lg-2">Taxa (R$)</th>
                            <th class="col-lg-1">Tempo (Minutos)</th>
                            <th class="col-lg-2">Valor Mínimo (R$)</th>
                            <th class="col-lg-2" title="Taxa grátis a partir de...">Taxa Grátis (R$)</th>
                            <th class="col-lg-2" style="text-align:center;">Ativo | Excluir</th>
                        </thead>

                        <tbody>

                            <?php foreach ($entregas as $key => $entrega) { ?>

                                <tr>
                                    <input style="display: none;" name="cod_entrega[]" value="<?= $entrega->getPkId(); ?>" type="text">

                                    <input style="display: none;" name="raio_km[]" value="<?= $entrega->getRaio_km(); ?>" type="number">

                                    <td style="vertical-align: middle;font-weight:bold;">
                                        <span style="float:left;">
                                            <!-- <i class="fas fa-road"></i> -->
                                            &nbsp;Até&nbsp;<?= $entrega->getRaio_km(); ?>&nbsp;KM
                                        </span>
                                    </td>

                                    <td>
                                        <div class="input-group">
                                            <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span> -->

                                            <input class="form-control taxa_entrega" name="taxa_entrega[]" value="<?= $entrega->getTaxa_entrega(); ?>" type="number" min="0" step="any">

                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-group">

                                            <div class="form-inline">
                                                <input class="form-control" placeholder="" min="1" name="tempo[]" type="number" min="1" value="<?= $entrega->getTempo(); ?>">

                                            </div>
                                            <!-- <span class="input-group-addon">Minutos</span> -->
                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-group">
                                            <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span> -->

                                            <input class="form-control" placeholder="Ex.: 100,00" name="valor_minimo[]" value="<?= $entrega->getValor_minimo(); ?>" type="number" min="0" step="any">

                                        </div>
                                    </td>

                                    <td>
                                        <div class="input-group">
                                            <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span> -->

                                            <input class="form-control" placeholder="Ex.: 100,00" name="min_taxa_gratis[]" value="<?= $entrega->getMin_taxa_gratis(); ?>" type="number" min="0" step="any">

                                        </div>
                                    </td>

                                    <td style="text-align:center; vertical-align: middle;">
                                        
                                        <input class="form-check-input" type="checkbox" name="flag_ativo[]" value="<?=$entrega->getPkId()?>" <?php echo ($entrega->getFlag_ativo() ? "checked" : ""); ?>>

                                        <button style="margin-left:20px;" type="button" class="btn btn-kionux" onclick="excluirRaio(<?= $entrega->getPkId(); ?>)"><i class="fa fa-remove"></i>&nbsp;Excluir</button>
                                    </td>

                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                
                <div class="col-lg-5">
                    <!-- Button Salvar -->
                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('info_entrega', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

                    <?php } ?>

                    <a href="default.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Sair</a>
                </div>

            </form>


        </div>

        <!-- Raio com o mapa style="float:right; width:500px; height:500px;" -->
        <div class="col-lg-5">
            <div class="panel-body col-lg-12" id="map" style="border-radius:20px; height:500px;"> </div>
        </div>

    </div>

    </div>

    <script>

        var radius = {};
        //Delion Café
        radius.km0 = {
            center: {
                lat: -25.54086,
                lng: -54.581167
            },
            km: 0.01
        };

        //raios cadastrados
        <?php foreach ($entregas as $key => $entrega) { 
          if($entrega->getFlag_ativo()){
        ?>
            
            radius.km<?=$entrega->getRaio_km(); ?> = {
                center: {
                    lat: -25.54086,
                    lng: -54.581167
                },
                km: <?= $entrega->getRaio_km(); ?>
            };

        <?php 
            }
        } ?>

        console.log(radius);

        function initMap() {
            // Create the map
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                // disableDefaultUI: true,
                center: {
                    lat: -25.53086,
                    lng: -54.545167
                },
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: true,
                streetViewControl: false,
                rotateControl: true,
                fullscreenControl: true,
            });

            // Circulo para cada Raio
            // Scale depende da magnitude do Raio
            for (var rad in radius) {
                // Add circulo para o Raio
                var radCircle = new google.maps.Circle({
                    strokeColor: '#EE6938',
                    strokeOpakm: 0.6,
                    strokeWeight: 2,
                    fillColor: '#EE6938',
                    fillOpacity: 0.15,
                    map: map,
                    center: radius[rad].center,
                    radius: radius[rad].km * 1000
                });
            }
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrg0iCBCR-W5NNqL6IirOTXZ9XcrIH3N0&callback=initMap">
    </script>



    <?php include VIEWPATH . "/rodape.php" ?>

</body>

<script src="../../js/alert.js"></script>
<script type="text/javascript">
    function excluirRaio(cod_entrega) {

        msgConfirmacao('Confirmação', 'Deseja realmente Excluir esse Raio de Entrega?',
            function() {
                var url = '../../ajax/excluir-raio.php?cod_entrega=' + cod_entrega;
                $.get(url, function(dataReturn) {
                    if (dataReturn == 1) {
                        msgRedireciona("Sucesso!", "Raio excluido com sucesso!", 1, "../../view/admin/entrega.php");
                    } else {
                        msgGenerico("Erro!", dataReturn, 2, function() {});
                    }
                });
            },
            function() {}
        );
    }
</script>

</html>
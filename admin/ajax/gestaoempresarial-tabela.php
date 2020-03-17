<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH."/controlComposicao.php";
include_once CONTROLLERPATH."/controlProduto.php";

include_once MODELPATH."/usuario.php";

protegePagina();

$controle = new controlerComposicao($_SG['link']);
$controle_produto = new controlerProduto($_SG['link']);
$controleUsuario = new controlerUsuario($_SG['link']);

$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);


$composicoes = $controle->selectAll();
	

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('gerenciar_composicao', $permissao)){
    echo "<div class='container'>
            <h2>Performance da Empresa</h2>

            <ul class='nav nav-tabs'>
                <li class='active'><a data-toggle='tab' href='#home'>Número de pedidos</a></li>
                <li><a data-toggle='tab' href='#menu1'>Lucros</a></li>
                <li><a data-toggle='tab' href='#menu2'>Preço de Venda</a></li>
            </ul>

            <div class='tab-content'>
                <div id='home' class='tab-pane fade in active'>
                    <h3>Número de pedidos</h3>
                    <div id='grafico1' style='width:1100px;height:500px;'></div>
                </div>
                <div id='menu1' class='tab-pane fade'>
                    <h3>Lucros</h3>
                    <div id='grafico2' style='width:1100px;height:500px;'></div>
                </div>
                <div id='menu2' class='tab-pane fade'>
                    <h3>Preço de Venda</h3>
                    <div id='grafico3' style='width:1100px;height:500px;'></div>
                </div>

            </div>
        </div>
        ";
}

?>

<script>

    GRAFICO1 = document.getElementById('grafico1');
    Plotly.newPlot( GRAFICO1, [{
    x: [1, 2, 3, 4, 5],
    y: [1, 2, 4, 8, 16] }], {
    margin: { t: 0 } } );


    GRAFICO2 = document.getElementById('grafico2');
    Plotly.newPlot( GRAFICO2, [{
    x: [1, 2, 3, 4, 5],
    y: [1, 2, 7, 9, 15] }], {
    margin: { t: 0 } } );

    GRAFICO3 = document.getElementById('grafico3');
    Plotly.newPlot( GRAFICO3, [{
    x: [1, 2, 3, 4, 5],
    y: [1, 4, 8, 1, 10] }], {
    margin: { t: 0 } } );



</script>



<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once HOMEPATH."home/controler/controlCarrinho.php";
    include_once MODELPATH."/pedido.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();
    $controleUsuario = new controlerUsuario($_SG['link']);
    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);
    $control_carrinho = new controlerCarrinho($_SG['link']);

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');
    // var_dump(1);
    // exit;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include VIEWPATH."/cabecalho.html" ?>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    
    <?php include_once "./header.php" ?>

    <div class="container-fluid">

        <?php
            $nome = '';

            $menor =0;

            $maior = 999999;

            $pedidos_data = $control_carrinho->selectAllPedido($nome, $menor, $maior);
            $data_pedidos = array();

            foreach($pedidos_data as $pedido_data){
                    $data_pedido = $pedido_data->getData()->format('d/m/Y');
                    if(!isset($data_pedidos[$data_pedido])){
                        $data_pedidos[$data_pedido] = 1;
                    }else{
                        $data_pedidos[$data_pedido] += 1;
                    }
            }

            //construção arrays p/ os eixos x/y Data e n° pedidos
            $x_data = array();
            $y_num_pedidos = array();
            foreach($data_pedidos as $key => $dp){
                array_push($x_data, $key);
                array_push($y_num_pedidos, $dp);
            }

        ?>

        <div class="row">
            <div class="col-lg-12" id="tabela-cliente">
                <!-- Plotar os gráficos aqui -->
                        <div class='container'>
                        <h2>Performance da Empresa</h2>
                        <ul class='nav nav-tabs'>
                            <li class='active'><a data-toggle='tab' href='#home'>Número de pedidos</a></li>
                            <li><a data-toggle='tab' href='#menu1'>Lucros</a></li>
                            <li><a data-toggle='tab' href='#menu2'>Preço de Venda</a></li>
                        </ul>
                        <div class='tab-content'>
                            <div id='home' class='tab-pane fade in active'>
                                <h3>Número de pedidos</h3>
                                <div id='num_pedidos' style='width:1100px;height:500px;'></div>
                            </div>
                            <div id='menu1' class='tab-pane fade'>
                                <h3>Lucros</h3>
                                <div id='lucros' style='width:1100px;height:500px;'></div>
                            </div>
                            <div id='menu2' class='tab-pane fade'>
                                <h3>Preço de Venda</h3>
                                <div id='preco_venda' style='width:1100px;height:500px;'></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <script src="../../js/alert.js"></script>
    <script type="text/javascript">

            var x_data = <?= json_encode($x_data)?>;
            var y_num_pedidos = <?= json_encode($y_num_pedidos)?>;

            grafico_num_pedi = document.getElementById('num_pedidos');
            Plotly.newPlot( grafico_num_pedi, [{
            x: x_data,
            y: y_num_pedidos }], {
            margin: { t: 0 } } );


            // GRAFICO2 = document.getElementById('lucros');
            // Plotly.newPlot( GRAFICO2, [{
            // x: [1, 2, 3, 4, 5],
            // y: [1, 2, 7, 9, 15] }], {
            // margin: { t: 0 } } );

            // GRAFICO3 = document.getElementById('preco_venda');
            // Plotly.newPlot( GRAFICO3, [{
            // x: [1, 2, 3, 4, 5],
            // y: [1, 4, 8, 1, 10] }], {
            // margin: { t: 0 } } );

    </script>


</body>

<?php include VIEWPATH."/rodape.html" ?>

</html>
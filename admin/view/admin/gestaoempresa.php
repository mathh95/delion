<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlUsuario.php";
    include_once MODELPATH."/usuario.php";
    include_once HOMEPATH."home/controler/controlCarrinho.php";
    include_once MODELPATH."/pedido.php";
    include_once CONTROLLERPATH."/controlComposicao.php";
    $_SESSION['permissaoPagina']=0;
    protegePagina();

    $controle = new controlerComposicao($_SG['link']);
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

            //Construção gráfico de Pedido por Dias
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
            
            //Contrução do Gráfico de Faturamento Liquido
            $array_pedidos = $control_carrinho->selectAllPedido($nome, $menor, $maior);
            $array_vendas_diaria = array();

            foreach($array_pedidos as $array_pedido){
                $valor_pedidos_dia = number_format($array_pedido->getTotal(),2);
                $data_pedido = $array_pedido->getData()->format('d/m/Y');

                if(!isset($array_vendas_diaria[$data_pedido])){
                    $array_vendas_diaria[$data_pedido] = $valor_pedidos_dia;
                }else{
                    $array_vendas_diaria[$data_pedido] += $valor_pedidos_dia;
                }
            }

            // var_dump($array_vendas_diaria);
            // exit;

            $x_data_venda = array();
            $y_total_dia = array();
            foreach($array_vendas_diaria as $key => $avd){
                array_push($x_data_venda, $key);
                array_push($y_total_dia, $avd);
            }

        //Construção do Gráfico de Faturamento Bruto
        //Conta para o lucro Preço de custo - Valor Total 



    ?>

        <div class="row">
            <div class="col-lg-12" id="tabela-cliente">
                <!-- Plotar os gráficos aqui -->
                        <div class='container'>
                        <h2>Performance da Empresa</h2>
                        <ul class='nav nav-tabs'>
                            <li class='active'><a data-toggle='tab' href='#home'>Número de pedidos</a></li>
                            <li><a data-toggle='tab' href='#bruto'>Faturamento Bruto</a></li>
                            <!-- <li><a data-toggle='tab' href='#liquido'>Faturamento Líquido</a></li> -->
                        </ul>
                        <div class='tab-content'>
                            <div id='home' class='tab-pane fade in active'>
                                <h3>Número de Pedidos por Dia</h3>
                                <div id='num_pedidos' style='width:1100px;height:500px;'></div>
                            </div>
                            <div id='bruto' class='tab-pane fade'>
                                <h3>Faturamento Bruto por Dia</h3>
                                <div id='faturamento_bruto' style='width:1100px;height:500px;'></div>
                            </div>
                            <!-- <div id='liquido' class='tab-pane fade'>
                                <h3>Faturamento Líquido por Dia</h3>
                                <div id='faturamento_liquido' style='width:1100px;height:500px;'></div>
                            </div> -->
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <script src="../../js/alert.js"></script>
    <script type="text/javascript">

            //Responsive
            var config = {  reponsive: true };

            //Variaveis p/ numero de pedidos por dia
            var x_data = <?= json_encode($x_data)?>;
            var y_num_pedidos = <?= json_encode($y_num_pedidos)?>;

            //Variaveis p/ faturamento liquido por dia
            var x_data_venda = <?= json_encode($x_data_venda)?>;
            var y_total_dia = <?= json_encode($y_total_dia)?>;

            //Variaveis p/ faturamento bruto por dia

            //
            grafico_num_pedi = document.getElementById('num_pedidos');
            Plotly.newPlot( grafico_num_pedi, [{
            x: x_data,
            y: y_num_pedidos }], {
            margin: { t: 0 } }, config );

            //
            grafico_faturamento_bruto = document.getElementById('faturamento_bruto');
            Plotly.newPlot( grafico_faturamento_bruto, [{
            x: x_data_venda,
            y: y_total_dia }], {
            margin: { t: 0 } }, config );

            //
            // grafico_faturamento_bruto = document.getElementById('faturamento_liquido');
            // Plotly.newPlot( grafico_faturamento_bruto, [{
            // x: [1, 2, 3, 4, 5],
            // y: [1, 4, 8, 1, 10] }], {
            // margin: { t: 0 } }, config );


    </script>


</body>

<?php include VIEWPATH."/rodape.html" ?>

</html>
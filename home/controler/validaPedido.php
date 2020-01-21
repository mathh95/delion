<?php
session_start();

include_once "../../admin/controler/conexao.php";
include_once "./controlEmpresa.php";

$html = "<head>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>  

            <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
             <style>
                .swal-overlay {
                    background-color: black;
                }
               
                @media only screen and (max-width: 767px) {
                    .swal-modal{
                        width: 90% !important;
                    }
                }
             </style>
         </head>
         <body>";

$checkcarrinho =-1;
$checkopcao =-1;
$checkbalcao=-1;
$checkpedido=-1;
$checkdelivery=-1;
$checkcliente=-1;

/**
 *  VERIFICA SE TEM O CARRINHO FOI ATIVADO
 */
if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $checkcarrinho=1;
}else{
    $checkcarrinho=-1;
}

/**
 * VERIFICA SE O CLIENTE SELECIONOU A OPÇÃO DELIVERY/BALCÃO
 */
if(isset($_SESSION['delivery'])){
    $checkopcao = 1;
}else {
    $checkopcao = -1;
}

/**
 * VERIFICA SE O CLIENTE POSSUI ALGUM PEDIDO QUE NÃO POSSA SER DELIVERY
 */
if (isset($_SESSION['delivery_indisponivel'])) {
    $checkbalcao = 1;
}else{
    $checkbalcao = -1;
}

/**
 * VERIFICA SE A FORMA DE PAGAMENTO FOI ESCOLHIDA
 */


/**
 * VERIFICA SE FOI UTILIZADO ALGUM CUPOM
 **/
// if(isset($_SESSION['codigocupom']) && !empty($_SESSION['codigocupom'])){
//     $checkcupom =1;
// }else {
//     $checkocupom=-1;
// }


/**
 * VERIFICA SE CASO
 * - PEDIDO FOR DELIVERY, NÃO POSSUI PEDIDOS
 * - PEDIDO FOR BALCÃO
 */
if (($_SESSION['delivery'] < 0) || ($_SESSION['delivery_indisponivel'] == 0) && ($_SESSION['delivery'] > 0)){
    $checkpedido=1;

    if (($_SESSION['delivery'] > 0) || ($_SESSION['is_delivery_home'] == 1)) {
        $checkdelivery=1;
    }else{
        $checkdelivery=-1;
    }
}else{
    $checkpedido=-1;
}

/**
 * VERIFICA SE O CLIENTE ESTÁ LOGADO
 */
if(isset($_SESSION['cod_cliente']) && !empty($_SESSION['cod_cliente'])){
    $checkcliente=1;
}else {
    $checkcliente=-1;
}

/**
 * VERIFICA SE O CLIENTE ESTÁ COM CADASTRO ATIVO
 */

/**
 * Seta Finalizar Pedido para Endereco
 */
$_SESSION['finalizar_pedido'] = 1;

$html.= "<script type='text/javascript' src='../js/jquery-3.4.1.min.js'></script>";


//Verifica se o estabelecimento está aberto
include_once "./FuncionamentoEmpresa.php";
$funcionamentoEmpresa = new FuncionamentoEmpresa();

$controleEmpresa = new controlerEmpresa(conecta());
$empresa = $controleEmpresa->select(1,2);

if(!$funcionamentoEmpresa->aberto()){
    
    $html.= "<script>swal('Estamos Fechados! :/', 'Aguarde :)...os nossos Fornos estão Aquecendo', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";
    echo $html;

}else if(isset($_SESSION['item_indisponivel']) && $_SESSION['item_indisponivel']){

    $html.= "<script>swal('Item indisponível! :/', 'Algum item do carrinho não está disponível no momento :/', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";
    echo $html;

}else{

if($checkcarrinho > 0){
    if($checkopcao > 0){
        if($checkbalcao > 0){
            if($checkpedido > 0){
                //is delivery?
                if($checkdelivery > 0){
                    if($checkcliente > 0){

                        //Verifica se o estabelecimento está entregando
                        if(!$empresa->getEntregando()){

                            $html.= "<script>swal('Infelizmente não estamos Entregando! :/', 'Você pode retirar na nossa loja :)', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";

                            echo $html;
                        }else{

                            //endereço inserido?
                            if(
                                ($_SESSION['is_delivery_home'] == 1
                                && isset($_SESSION['endereco']['postal_code']))
                                ||
                                ($_SESSION['delivery'] == 1
                                && isset($_SESSION['cod_endereco']))
                            ){
                                
                                // valor mínimo para delivery não atingido
                                if($_SESSION['valor_entrega_valido'] < 1){
                                    $html.= "<script>swal('Valor Mínimo não Atingido para Delivery :/', 'Valor Mínimo: R$ ".$_SESSION['valor_entrega_minimo']."', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";
                                    echo $html;
                                    
                                }else{

                                    //Endereço cadastrado selecionado
                                    if(isset($_SESSION['cod_endereco']) && !empty($_SESSION['cod_endereco'])){
                                        $rua = $_SESSION['rua_entrega'];
                                        $numero = $_SESSION['numero_entrega'];
                                        $cod_endereco = $_SESSION['cod_endereco'];
                                    }else{
                                        //Endereço homepage
                                        $rua = $_SESSION['endereco']['route'];
                                        $numero = $_SESSION['endereco']['street_number'];
                                        $cod_endereco = "";
                                    }


                                    $html.= "
                                    <script>

                                    function enviaPedido(){
                                        $.ajax({
                                            type: 'POST',
                                            url: '../ajax/enviarEmailPedido.php',
                                            data: {endereco: '".$cod_endereco."'},
                                            success: function (res) {
                                                //console.log(res);
                                                
                                                var content_enviado = document.createElement('div');
                                                content_enviado.innerHTML = 'Tempo estimado de entrega: <b>".$_SESSION['delivery_time']." mins </b> <br> Total: <b>R$ ".number_format($_SESSION['valor_total'], 2)."</b>';
                                                
                                                swal({
                                                    title: 'Pedido realizado com sucesso!',
                                                    content: content_enviado,
                                                    icon: 'success'}
                                                    ).then((value) => {
                                                    window.location = '/home/listarPedidos.php';
                                                });
                                            },
                                            error: function(err){
                                                console.log(err);
                                            }
                                        });
                                    }

                                    var content_enviar = document.createElement('div');
                                    content_enviar.innerHTML = 'Entrega em: <b>".$rua.", ".$numero."</b> <br> Total: <b>R$ ".number_format($_SESSION['valor_total'], 2)."</b>';


                                    swal({
                                        title: 'Confirmar Pedido',
                                        content: content_enviar,
                                        icon: 'success',
                                        buttons: ['Cancelar', true],
                                    })
                                    .then((enviar) => {
                                        if (enviar) {
                                            
                                            enviaPedido();

                                        } else {
                                            window.location = '/home/carrinho.php';
                                        }
                                    });
                                    
                                    </script></body>";

                                    echo $html;
                                }
                            }else{
                                // 'termina pedido vai pra area de endereço';
                                $html.= "<script>swal('Selecione um endereço!', 'Estamos te mandando para tela endereços, escolha um endereço...', 'info').then((value) => {window.location='/home/endereco.php'});</script></body>";
                                echo $html;
                            }
                        }

                    }else {
                        // 'pede pra logar e redireciona pra endereço e depois para pedido';
                        $html.= "<script>swal('É preciso estar logado para efetuar um pedido!', 'Estamos te mandando para tela de login, após disso, mandaremos para a tela de endereço.', 'error').then((value) => {window.location='/home/login.php'});</script></body>";
                        echo $html;
                    }
                }else {
                    if ($checkcliente > 0){
                        /*  'termina pedido e envia email'; */
                        $html.= "
                        <script>

                            var content = document.createElement('div');
                            content.innerHTML = 'Retirar em: <b>".$empresa->getEndereco()."</b> <br> Total: <b>R$ ".number_format($_SESSION['valor_total'], 2)."</b>';

                            swal({
                                title: 'Confirmar Pedido',
                                content: content,
                                icon: 'success',
                                buttons: ['Cancelar', true],
                            })
                            .then((enviar) => {
                                if (enviar) {
                                    window.location = '../ajax/enviarEmailPedido.php';
                                }else{
                                    window.location= '../carrinho.php';
                                }
                            });
                        </script></body>
                        ";
                        echo $html;
                    }else {
                        /* 'pede pra logar e termina pedido'; */
                        $html.= "<script>swal('É preciso estar logado para efetuar um pedido!', 'Estamos te mandando para tela de login...', 'error').then((value) => {window.location='/home/login.php'});</script></body>";
                        echo $html;
                    }
                }
            }else{
                $html.= "<script>swal('Não foi possível realizar o pedido!!', 'Esse pedido contem itens que não podem ser entregues, retire-os do carrinho ou marque o pedido para retirar no balcão!', 'error').then((value) => {window.location='/home/carrinho.php'});</script></body>";
                echo $html;
            }
        }
    }else{
        $html.= "<script>swal('Erro!!', 'Pedido para Entrega ou Retirada?!', 'error').then((value) => {window.location='/home/carrinho.php'});</script></body>";
        echo $html;
    }
}else{
    $html.= "<script>swal('Acesso negado!!', 'É preciso ter itens no carrinho!', 'error').then((value) => {window.location='/home/cardapio.php'});</script></body>";
    echo $html;
}

}

?>
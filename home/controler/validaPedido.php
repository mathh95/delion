<?php
session_start();

$html = "<head>
            <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
             <style>
             .swal-overlay {
                 background-color: black;
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
if(isset($_SESSION['delivery']) && !empty($_SESSION['delivery'])){
    $checkopcao =1;
}else {
    $checkopcao=-1;
}

/**
 * VERIFICA SE O CLIENTE POSSUI ALGUM PEDIDO QUE NÃO POSSA SER DELIVERY
 */
if (isset($_SESSION['pedidoBalcao'])) {
    $checkbalcao=1;
}else{
    $checkbalcao=-1;
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
if (($_SESSION['delivery'] < 0) || ($_SESSION['pedidoBalcao'] == 0) && ($_SESSION['delivery'] > 0)){
    $checkpedido=1;

    if (($_SESSION['delivery'] > 0) || ($_SESSION['is_delivery'] == 1)) {
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
 * Seta Finalizar Pedido para Endereco
 */
$_SESSION['finalizar_pedido'] = 1;


$html.= "<script type='text/javascript' src='../js/jquery-3.4.1.min.js'></script>";

if($checkcarrinho > 0){
    if($checkopcao > 0){
        if($checkbalcao>0){
            if($checkpedido > 0){
                //is delivery?
                if($checkdelivery > 0){
                    if($checkcliente > 0){
                        //endereço inserido na homepage?
                        if(($_SESSION['is_delivery']) && ($_SESSION['delivery_price'] > 0)){
                            
                            $route = $_SESSION['endereco']['route'];
                            $street_number = $_SESSION['endereco']['street_number'];

                            $html.= "
                            <script>

                            function enviaPedido(){
                                $.ajax({
                                    type: 'GET',
                                    url: '../ajax/enviarEmailPedido.php',
                                    data: {},
                                    success: function (res) {
                                        console.log(res);

                                        swal('Pedido realizado com sucesso!', 'Tempo estimado de entrega: ".$_SESSION['delivery_time']." mins  | Total: R$ ".number_format($_SESSION['totalCorrigido'], 2)."', 'success').then((value) => {
                                            window.location = '/home/cardapio.php';
                                        });
                                    },
                                    error: function(err){
                                        console.log(err);
                                    }
                                });
                            }

                            swal({
                                title: 'Confirmar Pedido',
                                text: 'Entrega em: ".$route.", ".$street_number." | Total: R$ ".number_format($_SESSION['totalCorrigido'], 2)."',
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

                        }else{
                            // 'termina pedido vai pra area de endereço';
                            $html.= "<script>swal('Selecione um endereço!', 'Estamos te mandando para tela endereços, escolha um endereço...', 'info').then((value) => {window.location='/home/endereco.php'});</script></body>";
                            echo $html;
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
                            swal({
                                title: 'Confirmar Pedido',
                                text: 'Retirar em: Rua Jorge Sanwais, 1137 | Total: R$ ".number_format($_SESSION['totalCorrigido'], 2)."',
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
        $html.= "<script>swal('Erro!!', 'É preciso selecionar um tipo de pedido!', 'error').then((value) => {window.location='/home/carrinho.php'});</script></body>";
        echo $html;
    }
}else{
    $html.= "<script>swal('Acesso negado!!', 'É preciso ter itens no carrinho!', 'error').then((value) => {window.location='/home/cardapio.php'});</script></body>";
    echo $html;
}

?>
<?php
session_start();


include_once "../../admin/controler/conexao.php";
include_once "./controlEmpresa.php";
require_once "../controler/controlProduto.php";


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
 *  VERIFICA SE TEM ITEM NO CARRINHO
 */
if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $checkcarrinho=1;

} else if(
    isset($_SESSION['carrinho_resgate'])
    && !empty($_SESSION['carrinho_resgate'])
){
    
    // VERIFICA SE Resgate de pontos é Suficiente para efetuar resgate sem Compra
    $itens_id_resgate = array_keys($_SESSION['carrinho_resgate']);

    $cardapio = new controlerProduto(conecta());
    $itens_resgate = $cardapio->buscarVariosId($itens_id_resgate);

    $pts_utilizados = 0;
    foreach ($itens_resgate as $key => $item) {
        $qtd_aux = $_SESSION['carrinho_resgate'][$item['pro_pk_id']]['qtd'];
        $pts_utilizados += $qtd_aux * $item['pro_pts_resgate_fidelidade'];
    }

    //PARAMETRIZE Value !
    if($pts_utilizados >= 120){
        $check_resgate=1;
    }else{
        $check_resgate=-1;
    }

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
// if(isset($_SESSION['codigo_cupom']) && !empty($_SESSION['codigo_cupom'])){
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

$html.= "<script type='text/javascript' src='../js/jquery-3.4.1.min.js'></script>";

//Verifica se o estabelecimento está aberto
include_once "./FuncionamentoEmpresa.php";
$funcionamentoEmpresa = new FuncionamentoEmpresa();

$controleEmpresa = new controlerEmpresa(conecta());
$empresa = $controleEmpresa->select(1,2);

if(!$funcionamentoEmpresa->aberto()){
    
    $html.= "<script>swal('Estamos Fechados 😮', 'Aquecendo os Fornos 👩‍🍳🔥', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";
    echo $html;

}else if(isset($_SESSION['item_indisponivel']) && $_SESSION['item_indisponivel']){

    $html.= "<script>swal('Item indisponível! 😕', 'Algum item do carrinho não está disponível no momento ', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";
    echo $html;

}else{


if($checkcarrinho > 0 || $check_resgate > 0){
    if($checkopcao > 0){
        if($checkbalcao > 0){
            if($checkpedido > 0){
                //is delivery?
                if($checkdelivery > 0){
                    if($checkcliente > 0){

                        //Verifica se o estabelecimento está entregando
                        if(!$empresa->getEntregando()){

                            $html.= "<script>swal('Infelizmente não estamos Entregando! 😕', 'Você pode retirar na nossa loja 😄', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";

                            echo $html;
                        }else{
                            //endereço inserido?
                            if(
                                ($_SESSION['is_delivery_home'] == 1
                                || $_SESSION['delivery'] == 1 )
                                &&
                                (isset($_SESSION['endereco']['postal_code'])
                                || isset($_SESSION['cod_endereco']))
                            ){
                                
                                // valor mínimo para delivery não atingido
                                if($_SESSION['valor_entrega_valido'] < 1){
                                    $html.= "<script>swal('Valor Mínimo não Atingido para Delivery 😕', 'Valor Mínimo: R$ ".$_SESSION['valor_entrega_minimo']."', 'warning').then((value) => {window.location='/home/carrinho.php'});</script></body>";
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

                                    var content_enviar = document.createElement('div');
                                    content_enviar.innerHTML = 'Entrega em: <b>".$rua.", ".$numero."</b> <br> Total: <b>R$ ".number_format($_SESSION['valor_total'], 2)."</b>';


                                    swal({
                                        text: 'Confirmar Pedido',
                                        icon: 'success',
                                        content: content_enviar,
                                        buttons: {
                                            cancel: {
                                                text: 'Voltar',
                                                visible: true,
                                                value: false,
                                            },
                                            confirm: {
                                                text: 'Pedir',
                                                value: true,
                                                closeModal: false
                                            }
                                        }
                                    })
                                    .then(pedir => {
                                        
                                        if(pedir){

                                            return fetch('../ajax/enviarEmailPedido.php',
                                                {
                                                method: 'POST',
                                                headers: {'Content-Type':'application/x-www-form-urlencoded'},
                                                body: 'endereco=".$cod_endereco."'
                                            });

                                        }else{
                                            window.location = '/home/carrinho.php';
                                        }

                                    })
                                    .then(res => {
                                        // console.log(res.text());
                                        if(!res) throw res;

                                        var content_enviado = document.createElement('div');

                                        content_enviado.innerHTML = 'Tempo estimado de entrega: <b>".$_SESSION['delivery_time']." mins </b> <br> Total: <b>R$ ".number_format($_SESSION['valor_total'], 2)."</b>';
                                                
                                        swal({
                                            title: 'Pedido realizado com sucesso! 😄',
                                            content: content_enviado,
                                            icon: 'success'}
                                            ).then((value) => {
                                            window.location = '/home/listarPedidos.php';
                                        });
                                    })
                                    .catch(err => {
                                        if (err) {
                                            console.log(err);
                                            swal('Eita!', 'Tivemos um problema aqui...😕, tente novamente.', 'error').then((value) => {
                                            window.location = '/home/carrinho.php'});
            
                                        } else {
                                            // swal.stopLoading();
                                            // swal.close();
                                            swal('Eita!', 'Tivemos um problema aqui...😕, tente novamente.', 'error').then((value) => {
                                                window.location = '/home/carrinho.php'});
                                        }
                                    });
                                    
                                    </script></body>";

                                    echo $html;
                                }
                            }else{
                                // 'termina pedido vai pra area de endereço';
                                $html.= "
                                <script type='text/javascript'>
                                setTimeout(function () {
                                    swal('Selecione um endereço!', 'Estamos te direcionando para tela endereços...', 'info')
                                    .then((value) => {});
                                }, 200); window.location='/home/endereco.php?is_selecao_end=true'
                                </script>
                                </body>";
                                echo $html;
                            }
                        }

                    }else {
                        // 'pede pra logar e redireciona pra endereço e depois para pedido';
                        $html.= "
                        <script type='text/javascript'>
                        setTimeout(function () {
                            swal('É preciso estar logado para efetuar um pedido!', 'Estamos te mandando para tela de login, após disso, mandaremos para a tela de endereço.', 'error')
                            .then((value) => {});
                         }, 200); window.location='/home/login.php'
                        </script></body>";
                        echo $html;
                    }

                
                //Balcão
                }else {
                    if ($checkcliente > 0){
                        /*  'termina pedido e envia email'; */
                        $html.= "
                        <script>

                        var content = document.createElement('div');
                        content.innerHTML = 'Retirar em: <b>".$empresa->getEndereco()."</b> <br> Total: <b>R$ ".number_format($_SESSION['valor_total'], 2)."</b>';

                        swal({
                            text: 'Confirmar Pedido',
                            icon: 'success',
                            content: content,
                            buttons: {
                                cancel: {
                                    text: 'Voltar',
                                    visible: true,
                                    value: false,
                                },
                                confirm: {
                                    text: 'Pedir',
                                    value: true,
                                    closeModal: false
                                }
                            }
                        })
                        .then(enviar => {

                            if (enviar) {
                                return fetch('../ajax/enviarEmailPedido.php');
                            }else{
                                window.location= '../carrinho.php';
                            }  
                        })
                        .then(result => {
                            // console.log(result);
                            return result.text();
                        })
                        .then(res => {
                            $('body').html(res);
                        })
                        .catch(err => {
                            if (err) {

                                swal('Eita!', 'Tivemos um problema aqui...😕, tente novamente.', 'error').then((value) => {
                                    window.location = '/home/carrinho.php'});

                            } else {
                                swal.stopLoading();
                                swal.close();
                            }
                        });


                        </script></body>
                        ";

                        echo $html;
                    }else {
                        /* 'pede pra logar e termina pedido'; */
                        $html.= "<script type='text/javascript'>
                        setTimeout(function () {
                            swal('É preciso estar logado para efetuar um pedido!', 'Estamos te mandando para tela de login...', 'error')
                            .then((value) => {});
                         }, 200); window.location='/home/login.php'
                        </script></body>";
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

}else if(isset($check_resgate) && $check_resgate < 0){
    $html.= "<script>swal('Resgate Insuficiente! 😕', 'Apenas Resgate!?...é preciso ser maior do que 120 pontos', 'info').then((value) => {window.location='/home/cardapio.php'});</script></body>";
    echo $html;
}else{
    $html.= "<script>swal('Acesso negado!!', 'É preciso ter itens no carrinho!', 'error').then((value) => {window.location='/home/cardapio.php'});</script></body>";
    echo $html;
}

}

?>
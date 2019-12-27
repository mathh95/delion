<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

//session_start();
include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlProduto.php";

include_once "../lib/alert.php";

require_once "../controler/controlCarrinho.php";
require_once "../controler/controlEndereco.php";
require_once "../../phpmailer/src/PHPMailer.php";
require_once '../../phpmailer/src/Exception.php';
require_once '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;


$pedido = new controlerCarrinho(conecta());
$cardapio = new controlerProduto(conecta());
$mail = new PHPMailer();
$itens = $_SESSION['carrinho'];

if ($itens > 0) {
    $itens = $cardapio->buscarVariosId($itens);
}

//endereco cadastrado
if (isset($_GET['endereco']) and !empty($_GET['endereco'])) {
    $cod_endereco = $_GET['endereco'];
 
//endereco cadastrado
}else if (isset($_SESSION['cod_endereco']) and !empty($_SESSION['cod_endereco'])){
    
    $cod_endereco = $_SESSION['cod_endereco'];

//endereco homepage
}else if(($_SESSION['is_delivery_home']) && ($_SESSION['delivery_price'] > 0)){
    
    include_once "../controler/businesEndereco.php";

    if($_SESSION['cod_endereco'] != -1){
        $cod_endereco = $_SESSION['cod_endereco'];
    }else{
        echo "Error Endereco Insert";
        echo $cod_endereco;
    }
}else{
    $cod_endereco = null;
}

//balcao
if ($cod_endereco == null) {
    $html = "<head>
            <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
             <style>
             .swal-overlay {
                 background-color: black;
               }
             </style>
         </head>
         <body>";
    try {
        //Server Settings
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.compubras.com.br';
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth  =  true;
        $mail->Username = 'sitefacil@compubras.com.br';
        $mail->Password = 'http#2017';
        $mail->Port = 587;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom(MAIL_SENDER, $_SESSION['nome']);
        $mail->addAddress(MAIL_RECEIVER, 'Delion Café');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Pedido Delion Café!';
        $mail->Body = "<h1>Lista de produtos</h1>
                    <table width='100%' border='1px'>
                        <thead>
                            <tr>
                                <th width='15%' height='20%'>Item</th>
                                <th width='15%'>Data</th>
                                <th width='15%'>Cliente</th>
                                <th width='15%'>Produto</th>
                                <th width='15%'>Quantidade</th>
                                <th width='15%'>Unidade</th>
                                <th width='15%'>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>";
        foreach ($_SESSION['carrinho'] as $key => $value) {
            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['pro_preco'];
            $mail->Body .= "<tr>
                        <td height='15%'>" . $_SESSION['carrinho'][$key] . "</td>
                        <td height='15%'>" . date("r") . "</td>
                        <td height='15%'>" . $_SESSION['nome'] . "</td>
                        <td height='15%'>" . $itens[$key]['pro_nome'] . "</td>
                        <td height='15%'>" . $_SESSION['qtd'][$key] . "</td> 
                        <td height='15%'>R$ " . number_format($itens[$key]['pro_preco'], 2) . "</td>
                        <td height='15%'>R$ " . number_format($subtotal, 2) . "</td>
                </tr>";
        }
        $mail->Body .= "</tbody>
            </table>
            <p>Subtotal: R$ " . number_format($_SESSION['totalCarrinho'], 2) . "</p>
            <p>Taxa de Entrega: R$ " . number_format($_SESSION['delivery_price'], 2) . "</p>
            <p>Desconto do Cupom: R$ " . number_format($_SESSION['valorcupom'], 2) . "</p>
            <p><b>Total: R$ " . number_format($_SESSION['totalCorrigido'], 2) . "</b></p>";
        $mail->AltBody = '';
        $mail->send();

        $_SESSION['flag_combo'] = "";
        $_SESSION['cod_endereco'] = "";
        $_SESSION['delivery'] = "";
        $_SESSION['valorcupom'] = 0.00;
    } catch (Exception $e) {
        echo $mail->ErrorInfo;
    }

    $produtos = $itens;
    $pedido->setPedido(null, null, $produtos);

    $html .= "<script>swal('Pedido efetuado com sucesso!!', 'Obrigado :)', 'success').then((value) => {window.location='/home/listarPedidos.php'});</script></body>";
    echo $html;

//delivery   
} else {

    $controlEndereco = new controlEndereco(conecta());
    $endereco = $controlEndereco->select($cod_endereco, 1)[0];

    try {
        //Server Settings
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.compubras.com.br';
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth  =  true;
        $mail->Username = 'sitefacil@compubras.com.br';
        $mail->Password = 'http#2017';
        $mail->Port = 587;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        //Recipients
        $mail->setFrom(MAIL_SENDER, $_SESSION['nome']);
        $mail->addAddress(MAIL_RECEIVER, 'Delion Café');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Pedido Delion Café!';
        $mail->Body = "<h1>Lista de produtos</h1>
                        <table width='100%' border='1px'>
                            <thead>
                                <tr>
                                    <th width='10%' height='20%'>Item</th>
                                    <th width='10%'>Data</th>
                                    <th width='10%'>Cliente</th>
                                    <th width='10%'>Rua</th>
                                    <th width='10%'>Produto</th>
                                    <th width='10%'>Quantidade</th>
                                    <th width='10%'>Unidade</th>
                                    <th width='10%'>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>";
        foreach ($_SESSION['carrinho'] as $key => $value) {
            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['pro_preco'];
            $mail->Body .= "<tr>
                            <td height='10%'>" . $_SESSION['carrinho'][$key] . "</td>
                            <td height='10%'>" . date("r") . "</td>
                            <td height='10%'>" . $_SESSION['nome'] . "</td>
                            <td height='10%'>" . $endereco->getRua() . "<br>" . $endereco->getNumero() . "</td>
                            <td height='10%'>" . $itens[$key]['pro_nome'] . "</td>
                            <td height='10%'>" . $_SESSION['qtd'][$key] . "</td> 
                            <td height='10%'>R$ " . number_format($itens[$key]['pro_preco'], 2) . "</td>
                            <td height='10%'>R$ " . number_format($subtotal, 2) . "</td>
                    </tr>";
        }
        $mail->Body .= "</tbody>
                </table>
                <p>Subtotal: R$ " . number_format($_SESSION['totalCarrinho'], 2) . "</p>
                <p>Taxa de Entrega: R$ " . number_format($_SESSION['delivery_price'], 2) . "</p>
                <p>Desconto do Cupom: R$ " . number_format($_SESSION['valorcupom'], 2) . "</p>
                <p><b>Total: R$ " . number_format($_SESSION['totalCorrigido'], 2) . "</b></p>";
        $mail->AltBody = '';
        $mail->send();

        $_SESSION['flag_combo'] = "";
        $_SESSION['cod_endereco'] = "";
        $_SESSION['delivery'] = "";
        $_SESSION['valorcupom'] = 0.00;
    } catch (Exception $e) {
        echo $mail->ErrorInfo;
    }

    $fk_origem_pedido = 1;
    $produtos = $itens;
    $pedido->setPedido($cod_endereco, $fk_origem_pedido, $produtos);

    $html .= "<script>swal('Pedido efetuado com sucesso!!', 'Obrigado :)', 'success').then((value) => {window.location='/home/listarPedidos.php'});</script></body>";
    echo $html;

}
unset($_SESSION['delivery']);
unset($_SESSION['pedidoBalcao']);
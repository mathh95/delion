<?php
//session_start();
include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

require_once "../controler/controlCarrinho.php";
require_once "../controler/controlEndereco.php";
require_once "../../phpmailer/src/PHPMailer.php";
require_once '../../phpmailer/src/Exception.php';
require_once '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;


$pedido = new controlerCarrinho(conecta());
$cardapio = new controlerCardapio(conecta());
$mail = new PHPMailer();
$itens = $_SESSION['carrinho'];

if ($itens > 0) {
    $itens = $cardapio->buscarVariosId($itens);
}

if (isset($_GET['endereco']) and !empty($_GET['endereco'])) {
    $cod_endereco = $_GET['endereco'];
    
}else if(($_SESSION['is_delivery']) && ($_SESSION['delivery_price'] > 0)){//endereco homepage
    
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
        $mail->setFrom('teste@gmail.com', $_SESSION['nome']);
        $mail->addAddress('isshak@corp.kionux.com.br', 'Delion Café');

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
            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['preco'];
            $mail->Body .= "<tr>
                        <td height='15%'>" . $_SESSION['carrinho'][$key] . "</td>
                        <td height='15%'>" . date("r") . "</td>
                        <td height='15%'>" . $_SESSION['nome'] . "</td>
                        <td height='15%'>" . $itens[$key]['nome'] . "</td>
                        <td height='15%'>" . $_SESSION['qtd'][$key] . "</td> 
                        <td height='15%'>R$ " . number_format($itens[$key]['preco'], 2) . "</td>
                        <td height='15%'>R$ " . number_format($subtotal, 2) . "</td>
                </tr>";
        }
        $mail->Body .= "</tbody>
            </table>
            <p>Valor total do pedido: " . number_format($_SESSION['totalCarrinho'], 2) . "</p>";
        $mail->AltBody = '';
        $mail->send();

        $_SESSION['flag_combo'] = "";
        $_SESSION['cod_endereco'] = "";
        $_SESSION['delivery'] = "";
        $_SESSION['valorcupom'] = 0.00;
    } catch (Exception $e) {
        echo $mail->ErrorInfo;
    }

    $pedido->setPedido(null);

    $html .= "<script>swal('Pedido efetuado com sucesso!!', 'Obrigado :)', 'success').then((value) => {window.location='/home'});</script></body>";
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
        $mail->setFrom('teste@gmail.com', $_SESSION['nome']);
        $mail->addAddress('isshak@corp.kionux.com.br', 'Delion Café');

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
            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['preco'];
            $mail->Body .= "<tr>
                            <td height='10%'>" . $_SESSION['carrinho'][$key] . "</td>
                            <td height='10%'>" . date("r") . "</td>
                            <td height='10%'>" . $_SESSION['nome'] . "</td>
                            <td height='10%'>" . $endereco->getRua() . "<br>" . $endereco->getNumero() . "</td>
                            <td height='10%'>" . $itens[$key]['nome'] . "</td>
                            <td height='10%'>" . $_SESSION['qtd'][$key] . "</td> 
                            <td height='10%'>R$ " . number_format($itens[$key]['preco'], 2) . "</td>
                            <td height='10%'>R$ " . number_format($subtotal, 2) . "</td>
                    </tr>";
        }
        $mail->Body .= "</tbody>
                </table>
                <p>Valor total do pedido: " . number_format($_SESSION['totalCarrinho'], 2) . "</p>";
        $mail->AltBody = '';
        $mail->send();

        $_SESSION['flag_combo'] = "";
        $_SESSION['cod_endereco'] = "";
        $_SESSION['delivery'] = "";
        $_SESSION['valorcupom'] = 0.00;
    } catch (Exception $e) {
        echo $mail->ErrorInfo;
    }

    $pedido->setPedido($cod_endereco);
}
unset($_SESSION['delivery']);
unset($_SESSION['pedidoBalcao']);

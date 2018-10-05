<?php
session_start();
include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

require_once "../controler/controlCarrinho.php";
require_once "../../phpmailer/src/PHPMailer.php";
require_once '../../phpmailer/src/Exception.php';
require_once '../../phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
    
$html = "<head>
            <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
            // <style>
            // .swal-overlay {
            //     background-color: black;
            //   }
            // </style>
         </head>
         <body>";
$pedido = new controlerCarrinho(conecta());
$cardapio = new controlerCardapio(conecta());
$mail = new PHPMailer();
if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $itens = $_SESSION['carrinho'];

    if($itens > 0){
        $itens = $cardapio->buscarVariosId($itens);
    }
    if(isset($_SESSION['delivery']) && !empty($_SESSION['delivery'])){
        if (isset($_SESSION['pedidoBalcao'])) {
            if (($_SESSION['delivery'] > 0) && ($_SESSION['pedidoBalcao'] == 0) || ($_SESSION['delivery'] < 0)){  
                if(isset($_SESSION['cod_cliente']) && !empty($_SESSION['cod_cliente'])){
                    try{
                        //Server Settings
                        $mail->CharSet = 'UTF-8';
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.compubras.com.br';
                        $mail->SMTPSecure = 'tls';
                        $mail ->SMTPAuth  =  true; 
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
                        $mail->addAddress('delion_cafe@kionux.com.br', 'Delion Café');
                
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
                        foreach($_SESSION['carrinho'] as $key => $value){
                            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['preco'];
                            $mail->Body.= "<tr>
                                                <td height='15%'>".$_SESSION['carrinho'][$key]."</td>
                                                <td height='15%'>".date("r")."</td>
                                                <td height='15%'>".$_SESSION['nome']."</td>
                                                <td height='15%'>".$itens[$key]['nome']."</td>
                                                <td height='15%'>".$_SESSION['qtd'][$key]."</td> 
                                                <td height='15%'>R$ ".number_format($itens[$key]['preco'], 2)."</td>
                                                <td height='15%'>R$ ".number_format($subtotal, 2)."</td>
                                        </tr>";
                        }
                        $mail->Body.="</tbody>
                                    </table>
                                    <p>Valor total do pedido: ".number_format($_SESSION['totalCarrinho'], 2)."</p>";
                        $mail->AltBody = 'Nem sei oque é isso kkkkkk';
                        $mail->send();
                    }catch(Exception $e){
                        echo $mail->ErrorInfo;
                    }
                
                    $pedido->setPedido();
                
                    $html.= "<script>swal('Pedido efetuado com sucesso!!', 'Obrigado :)', 'success').then((value) => {window.location='/home'});</script></body>";
                    echo $html;
                }else{
                    $html.= "<script>swal('É preciso estar logado para efetuar um pedido!', 'Estamos te mandando para tela de login...', 'error').then((value) => {window.location='/home/login.php'});</script></body>";
                    echo $html;
                }
            }else{
                $html.= "<script>swal('Não foi possível realizar o pedido!!', 'Esse pedido contem itens que não podem ser entregues, retire-os do carrinho ou marque o pedido para retirar no balcão!', 'error').then((value) => {window.location='/home/carrinho.php'});</script></body>";
                echo $html;
            }
        }else{
            $html.= "<script>swal('Acesso negado!!', 'É preciso ter itens no carrinho!', 'error').then((value) => {window.location='/home/cardapio.php'});</script></body>";
            echo $html;
        }
    }else {
        $html.= "<script>swal('Erro!!', 'É preciso selecionar um tipo de pedido!', 'error').then((value) => {window.location='/home/carrinho.php'});</script></body>";
    echo $html;
    }
}else {
    $html.= "<script>swal('Acesso negado!!', 'É preciso ter itens no carrinho!', 'error').then((value) => {window.location='/home/cardapio.php'});</script></body>";
    echo $html;
}

?>
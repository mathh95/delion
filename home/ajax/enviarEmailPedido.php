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
            <style>
            .swal-overlay {
                background-color: black;
              }
            </style>
         </head>
         <body>";
  

$pedido = new controlerCarrinho(conecta());
$cardapio = new controlerCardapio(conecta());
$mail = new PHPMailer();

if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])){
    $itens = $_SESSION['carrinho'];
}
if($itens > 0){
    $itens = $cardapio->buscarVariosId($itens);
}

if(isset($_SESSION['cod_cliente']) && !empty($_SESSION['cod_cliente'])){

    try{
        //Server Settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = '192.168.1.42';
        $mail->SMTPAuth = false;
        $mail->Username = 'vitor';
        $mail->Password = 'vitor';
        // $mail->SMTPSecure = 'tls';
        $mail->Port = 1025;

        //Recipients
        $mail->setFrom('vitormatheussb@gmail.com', 'Vitor');
        $mail->addAddress('vitormatheussb@gmail.com', 'Vitor');
        $mail->addReplyTo('vitormatheussb@gmail.com');

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Pedido Delion Café!';
        $mail->Body = "<h1>Lista de produtos</h1>
                            <table width='100%' border='1px'>
                                <thead>
                                    <tr>
                                        <th width='20%' height='20%'>Item</th>
                                        <th width='20%'>Data</th>
                                        <th width='20%'>Cliente</th>
                                        <th width='20%'>Produto</th>
                                        <th width='20%'>Quantidade</th>
                                        <th width='20%'>Unidade</th>
                                        <th width='20%'>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>";
        foreach($_SESSION['carrinho'] as $key => $value){
            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['preco'];
            $mail->Body.= "<tr>
                                <td height='20%'>".$_SESSION['carrinho'][$key]."</td>
                                <td height='20%'>".date("r")."</td>
                                <td height='20%'>".$_SESSION['nome']."</td>
                                <td height='20%'>".$itens[$key]['nome']."</td>
                                <td height='20%'>".$_SESSION['qtd'][$key]."</td> 
                                <td height='20%'>R$ ".$itens[$key]['preco']."</td>
                                <td height='20%'>R$ ".$subtotal."</td>
                           </tr>";
        }
        $mail->Body.="</tbody>
                       </table>
                       <p>Valor total do pedido: ".$_SESSION['totalCarrinho']."</p>";
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
    
    



?>
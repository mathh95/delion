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
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = '192.168.1.14';
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
        $mail->Body = '<h1>Lista de produtos</h1>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Nome</th>
                                        <th>Quantidade</th>
                                        <th>Unidade</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>';
        foreach($_SESSION['carrinho'] as $key => $value){
            $subtotal = $_SESSION['qtd'][$key] * $itens[$key]['preco'];
            $mail->Body.= "<tr>
                                <td>".$_SESSION['carrinho'][$key]."</td>
                                <td>".$itens[$key]['nome']."</td>
                                <td>".$_SESSION['qtd'][$key]."</td> 
                                <td>R$ ".$itens[$key]['preco']."</td>
                                <td>R$ ".$subtotal."</td>
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

    echo "<script>window.location='/';alert('Pedido enviado com sucesso!');</script>";
}else{
    echo "<script>window.location='/home/login.php';alert('É preciso estar logado para efetuar um pedido!');</script>";
}
    
    



?>
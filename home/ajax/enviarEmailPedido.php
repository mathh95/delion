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
$mail = new PHPMailer();
    
    try{
        //Server Settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = '192.168.1.18';
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
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>';
        foreach($_SESSION['carrinho'] as $key => $value){
            $mail->Body.= "<tr>
                                <td>".$_SESSION['carrinho'][$key]."</td>
                                <td>".$_SESSION['qtd'][$key]."</td> 
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



?>
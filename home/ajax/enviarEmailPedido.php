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
        $mail->Subject = 'blablbalbalbalba';
        $mail->Body = 'Essa é uma mensagem de teste';
        $mail->AltBody = 'Nem sei oque é isso kkkkkk';

        $mail->send();
    }catch(Exception $e){
        echo $mail->ErrorInfo;
    }

    $pedido->setPedido();



?>
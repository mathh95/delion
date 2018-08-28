<?php
session_start();
include_once "../../admin/controler/conexao.php";

require_once "../controler/controlCarrinho.php";

require_once "../controler/controlCardapio.php";

include_once "../lib/alert.php";

require_once "../controler/controlCarrinho.php";
// require_once "../../phpmailer/src/PHPMailer.php";
// require_once '../../phpmailer/src/Exception.php';
// require_once '../../phpmailer/src/SMTP.php';

// use PHPMailer\PHPMailer\PHPMailer;
    

  

    // $mail = new PHPMailer();
    $pedido = new controlerCarrinho(conecta());
    
    $pedido->setPedido();



?>
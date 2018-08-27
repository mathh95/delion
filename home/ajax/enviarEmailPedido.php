<?php
require_once "../controler/controlCarrinho.php";
require_once '/phpmailer/src/PHPMailer.php';
require_once '/phpmailer/src/Exception.php';
require_once '/phpmailer/src/SMTP.php';

$mailer = new PHPMailer();
$pedido = new controlerCarrinho(conecta());

$pedido->setPedido();

?>
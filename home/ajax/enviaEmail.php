<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
include_once HELPERPATH."/mask.php";

require_once "../../phpmailer/src/PHPMailer.php";
require_once '../../phpmailer/src/Exception.php';
require_once '../../phpmailer/src/SMTP.php';

include_once "../lib/alert.php";

use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();



//Server Settings
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = MAIL_HOST;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth  =  true;
$mail->Username = MAIL_SERVER;
$mail->Password = MAIL_SERVER_PASS;
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$from = addslashes(htmlspecialchars($_POST['email']));
$nome = addslashes(htmlspecialchars($_POST['nome']));
$assunto = addslashes(htmlspecialchars($_POST['assunto']));

$data = filter_input_array(INPUT_POST);

//Recipients
$mail->setFrom($from, $nome);
$mail->addAddress(MAIL_SERVER, "Delion Café");

try{

	$mail->isHTML(true);
	$mail->Subject = $assunto;

	$html = 
    "<head>
        <script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
        <style>
            .swal-overlay {
                background-color: black;
            }
        </style>
    </head><body></body>";

	$msg = '<div>';

	if (isset($data['nome']) && !empty($data['nome'])) {
		$msg.='<p><b>Nome:</b> '.$data['nome'].'</p>';
	}
	if (isset($data['telefone']) && !empty($data['telefone'])) {
		$msg.='<p><b>Telefone:</b> '.$data['telefone'].'</p>';
	}
	if (isset($data['email']) && !empty($data['email'])) {
		$msg.='<p><b>E-mail:</b> '.$data['email'].'</p>';
	}
	if (isset($data['sobre']) && !empty($data['sobre'])) {
		$msg.='<p><b>Assunto do contato:</b> '.$data['sobre'].'</p>';
	}
	if (isset($data['horaInicio']) && !empty($data['horaInicio'])) {
		$msg.='<p><b>Hora de início:</b> '.$data['horaInicio'].'h</p>';
	}
	if (isset($data['horaFim']) && !empty($data['horaFim'])) {
		$msg.='<p><b>Hora de término:</b> '.$data['horaFim'].'h</p>';
	}
	if (isset($data['descricao']) && !empty($data['descricao'])) {
		$msg.='<p><b>Descrição:</b> '.$data['descricao'].'</p>';
	}
	if (isset($data['convidados']) && !empty($data['convidados'])) {
		$msg.='<p><b>Convidados:</b> '.$data['convidados'].'</p>';
	}
	
	$msg.='</div>';


	$mail->Body = $msg;
	$mail->send();

	$html .= "<script>swal('Email enviado!!', 'Entraremos em contato 🤝', 'success').then((value) => {window.location='/home/cardapio.php'});</script>";

} catch (Exception $e) {
	$html .= "<script>swal('Tivemos um problema aqui...😕', 'tente novamente.', 'warning').then((value) => {window.history.back()});</script>;</script>";

	// echo $mail->ErrorInfo;
}

echo $html;

?>
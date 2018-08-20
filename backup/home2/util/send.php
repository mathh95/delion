<?php
/**
 * Created by PhpStorm.
 * User: Tadashi
 * Date: 17/06/14
 * Time: 11:11
 */


require "Mail.php";

$para = 'Delion Cafe <contato@delioncafe.com.br>';
$host = "apolo.compubras.com.br";
$user = "sitefacil@compubras.com.br";
$senha = "http";

$data = date('d/m/Y');
$hora = date("H:i");

$html = <<<HTML
    <html>
        <head><meta charset="utf-8"></head>
        <body>
            <div style="width: 590px; background-color: #EEEEEE;    border: 1px solid #CCCCCC;    color: #555555; font-family: arial;">
                <p style="text-align: center; margin-left: 10px"><strong>Contato || Delion Cafe</strong></p>
                <p style=" margin-left: 10px"><strong>Data:</strong> $data $hora</p>
                <p style=" margin-left: 10px"><strong>Nome:</strong> $_POST[nome]</p>
                <p style=" margin-left: 10px"><strong>E-mail:</strong> $_POST[email]</p>
                <p style=" margin-left: 10px"><strong>Mensagem:</strong> $_POST[mensagem]</p>
            </div>
        </body>
    </html>
HTML;


$headers = array(
    'From' => $para,
    'To' => $para,
    'Reply-To' => $_POST['nome'] . " <{$_POST[email]}>",
    'Content-Type' => 'text/html; charset=UTF-8',
    'Subject' => $_POST['assunto']
);


$smtp = Mail::factory('smtp',
    array(
        'host' => $host,
        'auth' => 'PLAIN',
        'username' => $user,
        'password' => $senha
    ));

$mail = $smtp->send($para, $headers, $html);

if (PEAR::isError($mail)) {
	/*
	echo "<html><body>";
	echo("<p>" . $mail->getMessage() . "</p><br>");
	echo "ret: [";print_r($mail);echo "]<br><br>\n";
	echo "</body></html>";
	*/
	header("Location: ../contato.php?status=0&msg=Houve uma falha na comunicação!");
} else {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $html = <<<HTML
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                table td {

                }
            </style>
        </head>
        <body>
        <div style="width: 590px; background-color: #EEEEEE;    border: 1px solid #CCCCCC;    color: #555555; font-family: arial;">

            <p style="text-align: center; margin-left: 10px"><strong>Contato || Delion Cafe</strong></p>

            <p style=" margin-left: 10px">Muito obrigado pelo seu contato, em breve entraremos em contato!</p>

            <p style=" margin-left: 10px">Por favor, não responda a este e-mail.</p>

            <p style=" margin-left: 10px">Obrigado por escolher a Delion Cafe.</p>
        </div>
        </body>
        </html>
HTML;
        $headers = array(
            'From' => $para,
            'To' => $_POST['nome'] . " <{$_POST[email]}>",
            'Content-Type' => 'text/html; charset=UTF-8',
            'Subject' => $_POST['assunto']
        );

        $mail = $smtp->send($_POST['nome'] . " <{$_POST[email]}>", $headers, $html);
    }

    header("Location: ../contato.php?status=1&msg=Seu contato foi enviado com sucesso, aguarde o nosso retorno!");
}
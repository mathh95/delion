<?php
/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

	header("Content-type: text/html; charset=utf-8");
	define('SMTP_SERVIDOR', 'smtp.compubras.com.br');
	define('SMTP_USUARIO', 'sitefacil@compubras.com.br');
	define('SMTP_SENHA', 'http#2017');
	define('SMTP_PORT', '587');
	
	include_once "../admin/controler/conexao.php";
	include_once "../lib/alert.php";



	$from = addslashes(htmlspecialchars($_POST['email'])); // Seu e-mail

	$assunto = addslashes(htmlspecialchars($_POST['assunto']));
	$email = 'mundo@mundodasaguas.com.br';
	$dados_post= filter_input_array(INPUT_POST);
	$msg='<div>';
	if (isset($dados_post['nome']) && !empty($dados_post['nome'])) {
		$msg.='<p>Nome: '.$dados_post['nome'].'</p>';
	}
	if (isset($dados_post['telefone']) && !empty($dados_post['telefone'])) {
		$msg.='<p>Telefone: '.$dados_post['telefone'].'</p>';
	}
	if (isset($dados_post['email']) && !empty($dados_post['email'])) {
		$msg.='<p>E-mail: '.$dados_post['email'].'</p>';
	}
	if (isset($dados_post['sobre']) && !empty($dados_post['sobre'])) {
		$msg.='<p>Assunto do contato: '.$dados_post['sobre'].'</p>';
	}
	if (isset($dados_post['horaInicio']) && !empty($dados_post['horaInicio'])) {
		$msg.='<p>Hora de início: '.$dados_post['horaInicio'].'</p>';
	}
	if (isset($dados_post['horaFim']) && !empty($dados_post['horaFim'])) {
		$msg.='<p>Hora de término: '.$dados_post['horaFim'].'</p>';
	}
	if (isset($dados_post['descricao']) && !empty($dados_post['descricao'])) {
		$msg.='<p>Descrição: '.$dados_post['descricao'].'</p>';
	}
	if (isset($dados_post['convidados']) && !empty($dados_post['convidados'])) {
		$msg.='<p>Convidados: '.$dados_post['convidados'].'</p>';
	}
	
	$msg.='</div>';
	echo "<pre>";
	echo $msg;
	echo "</pre>";

	require "Mail.php";
	
    $headers = [
        'From' => $from,
        'To' => $email,
        'Reply-To' => $from,
        'Subject' => $assunto,
        'Content-Type' => 'text/html; charset=UTF-8'
    ];

    $smtp = \Mail::factory('smtp', array(
                'host' => SMTP_SERVIDOR,
                'auth' => true,
                'port' => SMTP_PORT,
                'username' => SMTP_USUARIO,
                'password' => SMTP_SENHA
    ));

    $mail = $smtp->send($email, $headers, $msg);

    if (PEAR::isError($mail)) {
        msgRedireciona("ERRO!", "<p>" . $mail->getMessage() . "</p>", 2, "javascript:window.history.go(-1)");
    }else{
    	if ((strpos($assunto , "COMPRAS ARGENTINA"))) {
			$email = 'mundo@mundodasaguas.com.br';
    		msgRedireciona("Sucesso!", "E-mail enviado com sucesso.", 1, "../compras-info.php?nome=ARGENTINA");
		}elseif ((strpos($assunto , "COMPRAS PARAGUAI"))) {
			$email = 'mundo@mundodasaguas.com.br';
    		msgRedireciona("Sucesso!", "E-mail enviado com sucesso.", 1, "../compras-info.php?nome=PARAGUAI");
		}elseif ((strpos($assunto , "ORÇAMENTO"))) {
			$email = 'mundo@mundodasaguas.com.br';
    		msgRedireciona("Sucesso!", "E-mail enviado com sucesso.", 1, "../pacotes.php");
		}elseif ((strpos($assunto , "RECEPTIVO"))) {
			$email = 'mundo@mundodasaguas.com.br';
    		msgRedireciona("Sucesso!", "E-mail enviado com sucesso.", 1, "../receptivos.php");
		}else{
			$email = 'mundo@mundodasaguas.com.br';
    		msgRedireciona("Sucesso!", "E-mail enviado com sucesso.", 1, "../index.php");
		}
    }
?>
<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlUsuario.php";
	include_once "../model/usuario.php";
	include_once "../lib/alert.php";

	include_once MODELPATH."/sms_mensagem.php";
	include_once CONTROLLERPATH."/controlSmsMensagem.php";

	include_once HOMEPATH."home/utils/InfoBip.php";
	include_once HELPERPATH."/mask.php";

	$mask = new Mask;

	if (in_array('enviar_sms', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$msg = addslashes(htmlspecialchars($_POST['msg']));
		$descricao = addslashes(htmlspecialchars($_POST['descricao']));

		$arr_telefones_cli = $_POST['telefone_cli'];
		$arr_cod_cli = $_POST['cod_cli'];
		
		if(isset($_POST['key_cli'])){
			$arr_key_cli = $_POST['key_cli'];
			$qtd_clientes = count($arr_key_cli);
		}else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		
		$control_sms = new controlerSmsMensagem($_SG['link']);
		//salva SMS que será enviado

		$sms_mensagem = new smsMensagem;
		
		$msg_cleaned = $mask->sanitizeString($msg);
		$sms_mensagem->construct($msg_cleaned, $descricao);
		$cod_sms_mensagem = $control_sms->insert($sms_mensagem);
		
		$enviados = 0;

		$info_bip = new InfoBip();
		foreach ($arr_key_cli as $key){
			
			$telefone_int = $mask->rmMaskPhone($arr_telefones_cli[$key]);

			$res_envio = $info_bip->enviaMsgSMS($telefone_int, $msg_cleaned);
			
			// var_dump($res_envio);

			if($res_envio){

				$control_sms->insertSmsCli($cod_sms_mensagem, $arr_cod_cli[$key]);
				$enviados++;
				
			}
		}
		
		if($enviados == $qtd_clientes){
			//sms s enviados set to 1
			msgRedireciona('SMS enviado!', 'Todas Mensagens enviadas!', 1, '../view/admin/enviarSms.php');
		}else if($enviados){

		}else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);			
		}
	}else{
		expulsaVisitante();
	}
?>
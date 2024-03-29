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

	include_once HOMEPATH."home/utils/IaGente.php";
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
		
		$ia_gente = new IaGente();
		$arr_telefones_int = array();
		foreach ($arr_key_cli as $key){
			
			$telefone_int = $mask->rmMaskPhone($arr_telefones_cli[$key]);

			array_push($arr_telefones_int, $telefone_int);
		}
		
		$telefones_int = implode(',', $arr_telefones_int);

		$res_envio = $ia_gente->enviaSMSLote($telefones_int, $msg_cleaned);
		
		if($res_envio == "OK"){

			$control_sms->insertSmsCli($cod_sms_mensagem, $arr_cod_cli[$key]);

			msgRedireciona('SMS enviado!', 'Todas Mensagens enviadas!', 1, '../view/admin/enviarSms.php');
			
		}else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);			
		}
	}else{
		expulsaVisitante();
	}
?>
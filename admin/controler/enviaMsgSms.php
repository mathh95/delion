<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlUsuario.php";
	include_once "../model/usuario.php";
	include_once "../lib/alert.php";

	include_once HOMEPATH."home/utils/InfoBip.php";


	if (in_array('enviar_sms', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$msg = $_POST['msg'];

		$arr_telefones_cli = $_POST['telefone_cli'];
		$arr_cod_cli = $_POST['cod_cli'];
		
		if(isset($_POST['key_cli'])){
			$arr_key_cli = $_POST['key_cli'];
		}else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		$qtd_clientes = count($arr_key_cli);

		//insert table sms, new sms (cod, msg) n-n clientes<->sms
		//nope...types of user....aniversariantes, fiéis...
		
		$info_bip = new InfoBip();
		foreach ($arr_key_cli as $key){
			
			$res_envio = $info_bip->enviaMsgSMS($arr_telefones_cli[$key], $msg);
			
			// var_dump($res_envio);

			// if($res_envio){
			// 	$enviados++;
			// }
		}
		
		if($enviados >= $qtd_clientes){
			//sms s enviados set to 1
			msgRedireciona('SMS enviado!','Mensagens enviadas!',1,'../view/admin/enviarSms.php');
		}else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);			
		}
	}else{
		expulsaVisitante();
	}
?>
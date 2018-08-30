<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once HOMEPATH."/home/controler/controlcliente.php";
	include_once MODELPATH."/cliente.php";
	protegePagina();
	if (in_array('cliente', json_decode($_SESSION['permissao']))) {
		$cod_cliente = $_GET['cliente'];
		$controle=new controlCliente($_SG['link']);
		$result=$controle->delete($cod_cliente);
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>
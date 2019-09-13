<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlFormaPgt.php";
	include_once MODELPATH."/formaPgt.php";
	protegePagina();
	if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
		$cod_formaPgt = $_GET['cod'];
		$controle=new controlerFormaPgt($_SG['link']);
		$result=$controle->delete($cod_formaPgt);
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>
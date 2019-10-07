<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once HOMEPATH."admin/controler/controlEntrega.php";
	include_once MODELPATH."/entrega.php";
	protegePagina();
	
	if (in_array('info_entrega', json_decode($_SESSION['permissao']))) {
		
		$cod_entrega = $_GET['cod_entrega'];
		$controle = new controlEntrega($_SG['link']);
		$result=$controle->delete($cod_entrega);
		
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>
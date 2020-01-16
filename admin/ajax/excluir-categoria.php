<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlCategoria.php";
	include_once MODELPATH."/categoria.php";

	protegePagina();

	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		$cod_categoria = $_GET['categoria'];
		$controle = new controlerCategoria($_SG['link']);

		$icone = $_GET['icone'];
		if($icone != "../") unlink($icone);

		$result = $controle->delete($cod_categoria);
		echo $result;

	}else{
		expulsaVisitante();
	}	
?>
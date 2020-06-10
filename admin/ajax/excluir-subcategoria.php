<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlSubCat.php";
	include_once MODELPATH."/subcat.php";

	protegePagina();

	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		$cod_subcategoria = $_GET['categoria'];
		$controle = new controlerSubCat($_SG['link']);

		$icone = $_GET['icone'];
		if($icone != "../") unlink($icone);

		$result = $controle->delete($cod_subcategoria);
		echo $result;

	}else{
		expulsaVisitante();
	}	
?>
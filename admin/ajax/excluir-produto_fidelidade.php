<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";

	protegePagina();

	if (in_array('gerenciar_fidelidade', json_decode($_SESSION['permissao']))) {
		
		$cod_produto = $_GET['cod_produto_fidelidade'];

		$controle = new controlerProduto($_SG['link']);
		$result = $controle->deleteFidelidade($cod_produto);

		echo $result;

	}else{
		expulsaVisitante();
	}
?>
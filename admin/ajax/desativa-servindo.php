<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		// $opcao = $_GET['op'];
		$cod_produto = $_GET['produto'];
		$controle=new controlerProduto($_SG['link']);
		$result=$controle->desativaServindo($cod_produto);
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>

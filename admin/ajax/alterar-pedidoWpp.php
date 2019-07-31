<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once HOMEPATH."/admin/controler/controlCarrinhoWpp.php";
	include_once MODELPATH."/pedido-wpp.php";
	protegePagina();
	if (in_array('pedidoWpp', json_decode($_SESSION['permissao']))) {
        $cod_pedido = $_GET['pedido'];
        $status= $_GET['status'];
		$controle=new controlerCarrinho($_SG['link']);
		$result=$controle->alterarStatusPedido($cod_pedido_wpp,$status);
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>
<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once HOMEPATH."/home/controler/controlCarrinho.php";
	include_once MODELPATH."/pedido.php";
	protegePagina();
	if (in_array('pedido', json_decode($_SESSION['permissao']))) {
        $cod_pedido = $_GET['pedido'];
		$status= $_GET['status'];
		$cliente = $_GET['cliente'];
		$valor_desconto = $_GET['total'];
		$controle=new controlerCarrinho($_SG['link']);
		$result=$controle->alteraStatusPedidoRetirada($cod_pedido,$status,$cliente,$valor_desconto);
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>
<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";

	protegePagina();
	
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		
		$pro_pk_id = $_GET['cod_cardapio'];
		$controle=new controlerProduto($_SG['link']);
		
		$foto = $_GET['foto'];
		if($foto != "../") unlink($foto);

		$result = $controle->delete($pro_pk_id);
		echo $result;
		
	}else{
		expulsaVisitante();
	}
?>
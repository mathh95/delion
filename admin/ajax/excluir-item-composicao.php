<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlItemComposicao.php";
	include_once MODELPATH."/item_composicao.php";
	protegePagina();
	if (in_array('gerenciar_composicao', json_decode($_SESSION['permissao']))) {
		$cod_item_composicao = $_GET['cod'];
		$controle=new controlerItemComposicao($_SG['link']);
		$result=$controle->delete($cod_item_composicao);
		
		if($result == 1){
            header("Location: /admin/view/admin/itemComposicaoLista.php");
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
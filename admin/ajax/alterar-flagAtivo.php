<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		$cod_cardapio = $_GET['cod'];
		$controle=new controlerProduto($_SG['link']);
		$result=$controle->ativaItemCardapio($cod_cardapio);
		
		if($result == 1){
            header("Location: /admin/view/admin/gerenciarCardapio.php");
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
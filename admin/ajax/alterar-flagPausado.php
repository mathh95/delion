<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlCardapio.php";
	include_once MODELPATH."/cardapio.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		$cod_cardapio = $_GET['cod'];
		$controle=new controlerCardapio($_SG['link']);
		$result=$controle->desativaItemCardapio($cod_cardapio);
		
		if($result == 1){
            header("Location: /admin/view/admin/gerenciarCardapio.php");    //mudar aqui
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
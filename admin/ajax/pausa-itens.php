<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlCardapio.php";
	include_once MODELPATH."/cardapio.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		$nomeDesc = $_GET['nome'];
		$controle=new controlerCardapio($_SG['link']);
		$result=$controle->pausaProducao($nomeDesc);
		
		if($result == 1){
            header("Location: /admin/view/admin/gerenciarCardapio.php");    //mudar aqui
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
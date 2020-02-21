<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlIngrediente.php";
	include_once MODELPATH."/ingrediente.php";
	protegePagina();
	if (in_array('gerenciar_composicao', json_decode($_SESSION['permissao']))) {
		$cod_ingrediente = $_GET['cod'];
		$controle=new controlerIngrediente($_SG['link']);
		$result=$controle->delete($cod_ingrediente);
		
		if($result == 1){
            header("Location: /admin/view/admin/ingredientesLista.php");
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlAdicional.php";
	include_once MODELPATH."/adicional.php";
	protegePagina();
	if (in_array('adicional', json_decode($_SESSION['permissao']))) {
		$cod_adicional = $_GET['cod'];
		$controle = new controlerAdicional($_SG['link']);
		$result = $controle->delete($cod_adicional);
		
        if($result == 1){
            header("Location: /admin/view/admin/adicionalLista.php");
        }else{
            
        }
	}else{
		expulsaVisitante();
	}
?>
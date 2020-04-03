<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
    include_once CONTROLLERPATH."/controlerGerenciaSite.php";
    include_once MODELPATH."/gerencia_site.php";
	protegePagina();
	if (in_array('gerenciar_site', json_decode($_SESSION['permissao']))) {
		$cod_config= $_GET['cod'];
		$controle=new controlerGerenciarSite($_SG['link']);
		$result=$controle->desativaOneConfig($cod_config);
		
		if($result == 1){
            header("Location: /admin/view/admin/gerenciarSiteLista.php");

        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
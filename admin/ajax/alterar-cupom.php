<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once HOMEPATH."/admin/controler/controlCupom.php";
	include_once MODELPATH."/cupom.php";
	protegePagina();
	if (in_array('cupom', json_decode($_SESSION['permissao']))) {
        $cod_cupom = $_GET['codigo'];
        $status= $_GET['status'];
        // echo "<pre>";
        // print_r($_GET);
        // echo "</pre>";
		$controle=new controlCupom($_SG['link']);
		$result=$controle->updateStatusCancel($cod_cupom,$status);
		echo "$result";
	}else{
		expulsaVisitante();
	}
?>
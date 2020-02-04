<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlTipoFornecedor.php";
	include_once MODELPATH."/tipo_fornecedor.php";
	protegePagina();
	if (in_array('gerenciar_fornecedor', json_decode($_SESSION['permissao']))) {
		$cod_tipo_fornecedor = $_GET['cod'];
		$controle=new controlerTipoFornecedor($_SG['link']);
		$result=$controle->ativaTipoFornecedor($cod_tipo_fornecedor);
		
		if($result == 1){
            header("Location: /admin/view/admin/tipoFornecedorLista.php");
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
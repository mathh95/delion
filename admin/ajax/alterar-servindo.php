<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		$opcao = $_GET['op'];
		$cod_cardapio = $_GET['cod'];
		$controle=new controlerProduto($_SG['link']);

		if($opcao == "ativar"){
			$result=$controle->ativaServindo($cod_cardapio);
		}else{
			$result=$controle->desativaServindo($cod_cardapio);
		}
		
		if($result == 1){
			header("Location: /admin/view/admin/gerenciarCardapio.php");    //mudar aqui
			
        }else{
		
		}
	}else{
		expulsaVisitante();
	}
?>
<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		$nomeDesc = $_GET['nome'];
		$controle=new controlerProduto($_SG['link']);
		$result=$controle->pausaProducao($nomeDesc);

		if($result == 1){
			// var_dump($result);
			msgRedireciona('Pausados!','Itens pausados com sucesso!',1,'/admin/view/admin/gerenciarCardapio.php');
            // header("Location: /admin/view/admin/gerenciarCardapio.php");    //mudar aqui
        }else{
			
		}
	}else{
		expulsaVisitante();
	}
?>
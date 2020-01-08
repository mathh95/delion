<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlProduto.php";
	include_once MODELPATH."/produto.php";
	protegePagina();
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		$cod_cardapio = $_GET['cardapio'];
		$controle=new controlerProduto($_SG['link']);
		$foto = $_GET['foto'];
		unlink($foto);
		$result=$controle->delete($cod_cardapio);
		echo "$result";
		/*if($result>-1){
			if ($_SESSION['usuarioNivel']== 0) {
		    	msgRedireciona('Cadastro Realizado!','Aplicação cadastrado com sucesso!',1,HOMEPATH.'/view/admin/aplicacoes.php');
			}else{
		    	msgRedireciona('Cadastro Realizado!','Aplicação cadastrado com sucesso!',1,HOMEPATH.'/view/user/aplicacoes.php');
		    }	}else{
			$app->show();
		}*/
	}else{
		expulsaVisitante();
	}
?>
<?php 
	include_once ROOTPATH."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlCategoria.php";
	include_once MODELPATH."/categoria.php";
	protegePagina();
	if (in_array('categoria', json_decode($_SESSION['permissao']))) {
		$cod_categoria = $_GET['categoria'];
		$controle=new controlerCategoria($_SG['link']);
		$icone = $_GET['icone'];
		unlink($icone);
		$result=$controle->delete($cod_categoria);
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
<?php 
	include_once ROOTPATH."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlUsuario.php";
	include_once MODELPATH."/usuario.php";
	protegePagina();
		if (in_array('usuario', json_decode($_SESSION['permissao']))) {
		$cod_usuario = $_GET['usuario'];
		$controle=new controlerUsuario($_SG['link']);
		$result=$controle->delete($cod_usuario);
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
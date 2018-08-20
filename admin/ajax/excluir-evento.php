<?php 
	include_once ROOTPATH."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlEvento.php";
	include_once MODELPATH."/evento.php";
	protegePagina();
	if (in_array('evento', json_decode($_SESSION['permissao']))) {
		$cod_evento = $_GET['evento'];
		$controle=new controlerEvento($_SG['link']);
		$foto = $_GET['foto'];
		unlink($foto);
		$result=$controle->delete($cod_evento);
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
<?php 
	include_once ROOTPATH."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlBanner.php";
	include_once MODELPATH."/banner.php";
	protegePagina();
	if (in_array('banner', json_decode($_SESSION['permissao']))) {
		$cod_banner = $_GET['banner'];
		$controle=new controlerBanner($_SG['link']);
		$foto = $_GET['foto'];
		unlink($foto);
		$result=$controle->delete($cod_banner);
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
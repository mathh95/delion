<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlTipoAvaliacao.php";
	include_once MODELPATH."/tipo_avaliacao.php";
	protegePagina();
	if (in_array('avaliacao', json_decode($_SESSION['permissao']))) {
        $cod = $_GET['cod'];
		$controle=new controlerTipoAvaliacao($_SG['link']);
		$result=$controle->delete($cod);
		echo $result;
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
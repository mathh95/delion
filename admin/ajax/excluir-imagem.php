<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once CONTROLLERPATH."/seguranca.php";
	include_once CONTROLLERPATH."/controlImagem.php";
	include_once MODELPATH."/imagem.php";
	protegePagina();
	if (in_array('imagem', json_decode($_SESSION['permissao']))) {
		$cod_imagem = $_GET['imagem'];
		$controle=new controlerImagem($_SG['link']);
		$foto = $_GET['foto'];
		unlink($foto);
		$result=$controle->delete($cod_imagem);
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
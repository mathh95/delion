<?php
	include_once "seguranca.php";
	protegePagina();

	//mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlAdicional.php";
	include_once "../model/adicional.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('adicional', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$cod_adicional= addslashes(htmlspecialchars($_POST['cod']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
			$flag_ativo = 1;
		}else{
			$flag_ativo = 0;
		}
        
		$adicional = new adicional();
		$adicional->construct($nome, $preco, $desconto, $flag_ativo);

		$adicional->setPkId($cod_adicional);
		$controle = new controlerAdicional($_SG['link']);
		if($controle->update($adicional) > -1){
			msgRedireciona('Alteração Realizada!','Item adicional alterado com sucesso!',1,'../view/admin/adicionalLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar item adicional!',2);
			// $adicional->show();
		}
	}else{
		expulsaVisitante();
	}
?>
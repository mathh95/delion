<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlerGerenciaSite.php";
	include_once "../lib/alert.php";
	include_once "upload.php";


	if (in_array('gerenciar_site', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$nome= addslashes(htmlspecialchars($_POST['nome']));

        $cor_primaria= addslashes(htmlspecialchars($_POST['cor_primaria']));

		$cor_secundaria= addslashes(htmlspecialchars($_POST['cor_secundaria']));
		
		$flag_ativo = 0;

		if (!empty($_FILES['arquivo']['name'])) {
	   		$foto = upload("arquivo");
		}else{
			$foto = "";
		}

		$config= new gerencia_site();
		$config->construct($nome, $foto, $flag_ativo, $cor_primaria, $cor_secundaria);
		$controle=new controlerGerenciarSite($_SG['link']);
		
		if($controle->insert($config)> -1){
			msgRedireciona('Cadastro Realizado!','Configuração cadastrada com sucesso!',1,'../view/admin/gerenciarSite.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar configuração!',2);
			$config->show();
		}
	}else{
		expulsaVisitante();
	}
?>
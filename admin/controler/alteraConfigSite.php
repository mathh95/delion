<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	// date_default_timezone_set('America/Sao_Paulo');

    include_once CONTROLLERPATH."/controlerGerenciaSite.php";
    include_once MODELPATH."/gerencia_site.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	if (in_array('gerenciar_site', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$cod_config = addslashes(htmlspecialchars($_POST['cod']));
		$nome = addslashes(htmlspecialchars($_POST['nome']));
		$cor_primaria = addslashes(htmlspecialchars($_POST['cor_primaria']));
		$cor_secundaria = addslashes(htmlspecialchars($_POST['cor_secundaria']));
        $status = 0;

		if (!empty($_FILES['arquivo']['name'])) {

			$anexo = ADMINPATH."/".addslashes(htmlspecialchars($_POST['imagem']));

			if(file_exists($anexo)) unlink($anexo);

			$foto = upload("arquivo");
		}else{
			$foto = addslashes(htmlspecialchars($_POST['imagem']));
		}

        $config = new gerencia_site();
        $config->setPkId($cod_config);
        $config->setNome($nome);
        $config->setFoto($foto);
        $config->setFlag_ativo($status);
        $config->setCorPrimaria($cor_primaria);
        $config->setCorSecundaria($cor_secundaria);
		$controle = new controlerGerenciarSite($_SG['link']);

		$result = $controle->update($config);

		if($result > -1 ){
			msgRedireciona('Alteração Realizada!','Configuração do Site Alterada com sucesso!',1,'../view/admin/gerenciarSiteLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar a Configuração do Site!',2);
			$config->show();
		}
	}else{
		expulsaVisitante();
	}
?>
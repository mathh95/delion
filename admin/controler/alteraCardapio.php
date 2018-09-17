<?php
	include_once "seguranca.php";
	protegePagina();

	mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlCardapio.php";
	include_once "../model/cardapio.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$cod_cardapio= addslashes(htmlspecialchars($_POST['cod']));
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$descricao= addslashes(htmlspecialchars($_POST['descricao']));

		if (!empty($_FILES['arquivo']['name'])) {
			   $anexo = addslashes(htmlspecialchars($_POST['imagem']));
			   echo '<pre>';
			   print_r($anexo);
			   echo '</pre>';
			   //exit;
	   		unlink($anexo);
	   		$foto = upload("arquivo");
		}else{
			$foto = addslashes(htmlspecialchars($_POST['imagem']));
		}
		$categoria= addslashes(htmlspecialchars($_POST['categoria']));
		$flag_ativo = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;
		$prioridade = (isset($_POST['prioridade'])||!empty($_POST['prioridade'])) && $_POST['prioridade'] == 1 ? 1 : 0  ;
		$cardapio= new cardapio();
		$cardapio->construct($nome, $preco, $descricao, $foto, $categoria, $flag_ativo, $prioridade);

		$cardapio->setCod_cardapio($cod_cardapio);
		$controle=new controlerCardapio($_SG['link']);
		if($controle->update($cardapio)> -1){
			msgRedireciona('Alteração Realizada!','Item do cardápio alterado com sucesso!',1,'../view/admin/cardapioLista.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar item do cardápio!',2);
			$cardapio->show();
		}
	}else{
		expulsaVisitante();
	}
?>
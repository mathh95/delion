<?php
	include_once "seguranca.php";
	protegePagina();

	mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlCardapio.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	/*$dados_post= filter_input_array(INPUT_POST);
	echo "<pre>";
	print_r($dados_post);
	echo "</pre>";
	die();*/
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$descricao= addslashes(htmlspecialchars($_POST['descricao']));
		if (!empty($_FILES['arquivo']['name'])) {
	   		$foto = upload("arquivo");
		}else{
			$foto = "";
		}
		$categoria= addslashes(htmlspecialchars($_POST['categoria']));

		$flag_ativo = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;

		$cardapio= new cardapio();
		$cardapio->construct($nome, $descricao, $foto, $categoria, $flag_ativo);
		/*echo "<pre>";
		var_dump($cardapio);
		echo "</pre>";
		die();*/
		$controle=new controlerCardapio($_SG['link']);
		if($controle->insert($cardapio)> -1){
			msgRedireciona('Cadastro Realizado!','Item do cardápio cadastrado com sucesso!',1,'../view/admin/cardapio.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar item do cardápio!',2);
			$cardapio->show();
		}
	}else{
		expulsaVisitante();
	}
?>
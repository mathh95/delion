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
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		$descricao= addslashes(htmlspecialchars($_POST['descricao']));
		if (!empty($_FILES['arquivo']['name'])) {
	   		$foto = upload("arquivo");
		}else{
			$foto = "";
		}
		$categoria= addslashes(htmlspecialchars($_POST['categoria']));

		$flag_ativo = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;
		$prioridade = (isset($_POST['prioridade'])||!empty($_POST['prioridade'])) && $_POST['prioridade'] == 1 ? 1 : 0 ;
		$delivery = (isset($_POST['delivery'])||!empty($_POST['delivery'])) && $_POST['delivery'] == 1 ? 1 : 0 ;
		$cardapio= new cardapio();
		$cardapio->construct($nome, $preco, $desconto, $descricao, $foto, $categoria, $flag_ativo, $prioridade,$delivery);
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
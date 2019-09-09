<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlAdicional.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	/*$dados_post= filter_input_array(INPUT_POST);
	echo "<pre>";
	print_r($dados_post);
	echo "</pre>";
	die();*/
	if (in_array('adicional', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}
		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
			$flag_ativo = 1;
		}else{
			$flag_ativo = 2;
		}
	
		$adicional= new adicional();
		$adicional->construct($nome, $preco, $desconto, $flag_ativo);
		/*echo "<pre>";
		var_dump($cardapio);
		echo "</pre>";
		die();*/
		$controle=new controlerAdicional($_SG['link']);
		if($controle->insert($adicional)> -1){
			msgRedireciona('Cadastro Realizado!','Item adicional cadastrado com sucesso!',1,'../view/admin/adicional.php');
		}else{
			alertJSVoltarPagina('Erro!','Erro ao cadastrar item adicional!',2);
			$adicional->show();
		}
	}else{
		expulsaVisitante();
	}
?>
<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlAdicional.php";	//adicional da área administrativa admin/controler/controlAdicional **CUIDADO** 
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
		if(isset($_POST['flag_ativo']) && !empty($_POST['flag_ativo'])){
			$flag_ativo = 1;
		}else{
			$flag_ativo = 2;
		}
		$categoria= addslashes(htmlspecialchars($_POST['categoria']));

		$adicional= new adicional();

		$adicional->construct($nome, $preco, $flag_ativo, $categoria);

		$controle=new controlerAdicional($_SG['link']);

		$verificador = $controle->verificaIgual($nome);
		$nomeComp = $verificador->getNome();
		$nomeCadastro = $nome;

		$nomeComp = trim(strtolower($nomeComp));
		$nomeCadastro = trim(strtolower($nomeCadastro));

		$verificacaoNome = strcmp($nomeComp, $nomeCadastro);

		if($verificacaoNome != 0){
			if($controle->insert($adicional)> -1){
				// $adicional->show();
				// exit;
				msgRedireciona('Cadastro Realizado!','Item adicional cadastrado com sucesso!',1,'../view/admin/adicional.php');
			}else{
				alertJSVoltarPagina('Erro!','Erro ao cadastrar item adicional!',2);
				// $adicional->show();
			}
		}else{
			alertJSVoltarPagina('Erro!','Adicional já cadastrado!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
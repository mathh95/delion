<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	// date_default_timezone_set('America/Sao_Paulo');

	include_once "controlProduto.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$nome= addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		if($desconto == "") $desconto = null;

		$descricao= addslashes(htmlspecialchars($_POST['descricao']));

		if (!empty($_FILES['arquivo']['name'])) {
			$foto = upload("arquivo");
		}else{
			$foto = "";
		}

		$fk_categoria= addslashes(htmlspecialchars($_POST['categoria']));

		if(isset($_POST['adicional'])){
			$arr_adicional = $_POST['adicional'];
			$arr_adicional = json_encode($arr_adicional);
		}else{
			$arr_adicional = NULL;
		}

		if(isset($_POST['dias'])){
			$arr_dias = $_POST['dias'];
			$arr_dias_semana = json_encode($arr_dias);
		}else{
			$arr_dias_semana = NULL;
		}
		
		$fk_faixa_horario = addslashes(htmlspecialchars($_POST['faixa_horario']));
		if($fk_faixa_horario == "") $fk_faixa_horario = null;

		$flag_ativo = (isset($_POST['flag_ativo'])||!empty($_POST['flag_ativo'])) && $_POST['flag_ativo'] == 1 ? 1 : 0 ;

		$flag_servindo = (isset($_POST['servindo'])||!empty($_POST['servindo'])) && $_POST['servindo'] == 1 ? 1 : 0 ;

		$prioridade = (isset($_POST['prioridade'])||!empty($_POST['prioridade'])) && $_POST['prioridade'] == 1 ? 1 : 0 ;

		$delivery = (isset($_POST['delivery'])||!empty($_POST['delivery'])) && $_POST['delivery'] == 1 ? 1 : 0 ;

		$flag_deletado = 0;

		$produto = new produto();
		$produto->constructFkFaixa($nome, $preco, $desconto, $descricao, $foto, $fk_categoria, $flag_deletado ,$flag_ativo, $flag_servindo, $prioridade, $delivery, $arr_adicional, $arr_dias_semana, $fk_faixa_horario);

				
		$controle = new controlerProduto($_SG['link']);
		
		$verificador = $controle->verificaIgual($nome);
		$nomeComp = $verificador->getNome();
		$nomeCadastro = $nome;

		$nomeComp = trim(strtolower($nomeComp));
		$nomeCadastro = trim(strtolower($nomeCadastro));


		$verificacaoNome = strcmp($nomeComp, $nomeCadastro);

		// var_dump($verificacaoNome);
		// exit;

		if($verificacaoNome != 0){
			$cod_produto = $controle->insert($produto);

			if( $cod_produto > -1){
				$controle->insertHistoricoProduto($cod_produto,$produto);
				msgRedireciona('Cadastro Realizado!','Produto cadastrado com sucesso!',1,'../view/admin/produto.php');

			}else{
				alertJSVoltarPagina('Erro!', 'Erro ao inserir Produto',2);
				$produto->show();
			}
		}else{
			alertJSVoltarPagina('Erro!','Produto já cadastrado!',2);
		}
	}else{
		expulsaVisitante();
	}
?>
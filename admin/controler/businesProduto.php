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

		$adicional = array();
		for ($i=1; $i <= $_POST['quantidadeAdicionais']; $i++){
			if(isset($_POST[$i."adicional"]) && !empty($_POST[$i."adicional"])){
				array_push($adicional, addslashes(htmlspecialchars($_POST[$i."adicional"])));
			}
		}

		$adicional = json_encode($adicional);

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

		$produto = new produto();
		$produto->constructFkFaixa($nome, $preco, $desconto, $descricao, $foto, $fk_categoria, $flag_ativo, $flag_servindo, $prioridade, $delivery, $adicional, $arr_dias_semana, $fk_faixa_horario);

				
		$controle = new controlerProduto($_SG['link']);
		
		$result = $controle->insert($produto);
		if( $result == 1){

			msgRedireciona('Cadastro Realizado!','Produto cadastrado com sucesso!',1,'../view/admin/produto.php');

		}else{
			alertJSVoltarPagina('Erro!', 'Erro ao inserir Produto',2);
			$produto->show();
		}
	}else{
		expulsaVisitante();
	}
?>
<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	date_default_timezone_set('America/Sao_Paulo');

	include_once "controlProduto.php";
	include_once "../model/produto.php";
	include_once "../lib/alert.php";
	include_once "upload.php";

	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$pk_id = addslashes(htmlspecialchars($_POST['cod']));
		$nome = addslashes(htmlspecialchars($_POST['nome']));
		$preco = addslashes(htmlspecialchars($_POST['preco']));
		$desconto = addslashes(htmlspecialchars($_POST['desconto']));
		$codPag = addslashes(htmlspecialchars($_POST['codPag']));

		// var_dump($codPag);
		// exit;
		if($desconto == "") $desconto = null;

		$descricao = addslashes(htmlspecialchars($_POST['descricao']));

		if (!empty($_FILES['arquivo']['name'])) {

			$anexo = ADMINPATH."/".addslashes(htmlspecialchars($_POST['imagem']));

			if(file_exists($anexo)) unlink($anexo);

			$foto = upload("arquivo");
		}else{
			$foto = addslashes(htmlspecialchars($_POST['imagem']));
		}

		$fk_categoria = addslashes(htmlspecialchars($_POST['categoria']));

		if(isset($_POST['adicional'])){
			$arr_adicionais = $_POST['adicional'];
			$arr_adicionais = json_encode($arr_adicionais);
		}else{
			$arr_adicionais = NULL;
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

		$prioridade = (isset($_POST['prioridade'])||!empty($_POST['prioridade'])) && $_POST['prioridade'] == 1 ? 1 : 0 ;

		$delivery = (isset($_POST['delivery'])||!empty($_POST['delivery'])) && $_POST['delivery'] == 1 ? 1 : 0 ;

		$flag_servindo = (isset($_POST['servindo'])||!empty($_POST['servindo'])) && $_POST['servindo'] == 1 ? 1 : 0 ;

		$flag_deletado = 0;
		
		$produto = new produto();
		
		$produto->constructFaixas($nome, $preco, $desconto, $descricao, $foto, $fk_categoria, $flag_deletado, $flag_ativo, $flag_servindo, $prioridade, $delivery, $arr_adicional, $arr_dias_semana);

		$produto->setPkId($pk_id);
		$controle = new controlerProduto($_SG['link']);

		$result = $controle->update($produto);

		if($result > -1 ){
			$controle->insertHistoricoProduto($pk_id,$produto);
			if($codPag == "cardapioTabela"){
				msgRedireciona('Alteração Realizada!','Produto alterado com sucesso!',1,'../view/admin/cardapioLista.php');
			}else{
				msgRedireciona('Alteração Realizada!','Produto alterado com sucesso!',1,'../view/admin/gerenciarCardapio.php');
			}
		}else{
			alertJSVoltarPagina('Erro!','Erro ao alterar Produto!',2);
			$produto->show();
		}
	}else{
		expulsaVisitante();
	}
?>
<?php
	include_once "seguranca.php";
	protegePagina();

	// mysql_set_charset('utf8');
	// date_default_timezone_set('America/Sao_Paulo');

	include_once "controlProduto.php";
	include_once "controlCategoria.php";
	include_once "../model/produto.php";
	include_once "../lib/alert.php";
	include_once "upload.php";
	
	if (in_array('cardapio', json_decode($_SESSION['permissao']))) {
		if (!isset($_POST)||empty($_POST)){
			echo 'Nada foi postado.';
		}

		$controle_categoria = new controlerCategoria($_SG['link']);
		$controle_cardapio = new controlerProduto($_SG['link']);

		$erro = 0;

		if(isset($_POST['categorias'])){
			$categorias = $_POST['categorias'];
			
			foreach($categorias as $key_cat => $cod_categoria){
				if($controle_categoria->updatePos($cod_categoria, $key_cat) == -1) $erro++;
			}
		}
			
		if(isset($_POST['itens'])){
			$itens = $_POST['itens'];
			
			foreach($itens as $key_item => $cod_item){
				if($controle_cardapio->updatePos($cod_item, $key_item) == -1) $erro++;
			}
		}
		
		if($erro == 0){
			echo "sucesso";
		}else{
			echo "-1";
		}
	}else{
		expulsaVisitante();
	}
?>
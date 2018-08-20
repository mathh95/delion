<?php
  include("../biblioteca/online.php");
    
  	
	$_GET["cod_produto"] = (int)$_GET["cod_produto"];
	if (isset($_GET["flag_mostrar_preco"])) {
		$_GET["flag_mostrar_preco"] = (int)$_GET["flag_mostrar_preco"];
	}
	if (isset($_GET["flag_ativo"])) {
		$_GET["flag_ativo"] = (int)$_GET["flag_ativo"];
	}
	if (isset($_GET["flag_destaque"])) {
		$_GET["flag_destaque"] = (int)$_GET["flag_destaque"];
	}
	if (isset($_GET["flag_oferta"])) {
		$_GET["flag_oferta"] = (int)$_GET["flag_oferta"];
	}
	if (isset($_GET["flag_lancamento"])) {
		$_GET["flag_lancamento"] = (int)$_GET["flag_lancamento"];
	}
	
	$sql = "select * from produto where cod_produto = " . $_GET["cod_produto"];
	
	$res = $db->sql($sql);
	
	if ( mysql_num_rows($res) == 0 ) {
	
		$sql = "insert into produto set";
		$sql .= " cod_produto = " . $_GET["cod_produto"];
		if (isset($_GET["flag_mostrar_preco"])) {
			$sql .= " ,flag_mostrar_preco = " . $_GET["flag_mostrar_preco"];
		}
		if ( isset($_GET["flag_ativo"])) {
			$sql .= " ,flag_ativo = " . $_GET["flag_ativo"];
		}
		if ( isset($_GET["flag_destaque"])) {
			$sql .= " ,flag_destaque = " . $_GET["flag_destaque"];
		}
		if ( isset($_GET["flag_oferta"])) {
			$sql .= " ,flag_oferta = " . $_GET["flag_oferta"];
		}
		if ( isset($_GET["flag_lancamento"])) {
			$sql .= " ,flag_lancamento = " . $_GET["flag_lancamento"];
		}
		
		$db->sql($sql);
		
	
	} else {
		
		$sql = "update produto set";
		if (isset($_GET["flag_mostrar_preco"])) {
			$sql .= " flag_mostrar_preco = " . $_GET["flag_mostrar_preco"];
		}
		if ( isset($_GET["flag_ativo"])) {
			$sql .= " flag_ativo = " . $_GET["flag_ativo"];
		}
		
		if ( isset($_GET["flag_destaque"])) {
			$sql .= " flag_destaque = " . $_GET["flag_destaque"];
		}
		if ( isset($_GET["flag_oferta"])) {
			$sql .= " flag_oferta = " . $_GET["flag_oferta"];
		}
		if ( isset($_GET["flag_lancamento"])) {
			$sql .= " flag_lancamento = " . $_GET["flag_lancamento"];
		}
		
		$sql .= " where cod_produto = " . $_GET["cod_produto"];
		$db->sql($sql);
		
	}		
 
?>
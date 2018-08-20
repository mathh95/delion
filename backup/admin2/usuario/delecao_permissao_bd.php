<?php
  include("../biblioteca/online.php");
  if ( !$_SESSION['logado']) {
   header("Location:  /netbilling2.com.br/home/include/index.php?msg=3" );
   exit;
  }
 
  
  
  
  	$db->sql("select P.*, U.nome as usuario, F.nome as funcionalidade from permissao P inner join usuario U on (P.cod_usuario = U.cod_usuario) inner join funcionalidade F on (F.cod_funcionalidade = P.cod_funcionalidade) where P.cod_permissao = '$_GET[cod_permissao]' ");
	
	//pega os dados do usuario
	$valor = $db->fetch_array();
					
	//cria o objeto para manipulação dos campos do formulário
	$form = new form_db($db, $_GET, "permissao", $_SESSION, "log_usuario");
	
	$form->deleta("cod_permissao", "A permissão: $valor[funcionalidade] foi delatado para o Usuário: $valor[usuario]"); 
	
	//Redireciona para pagina de cadastro de fotos
	header("Location:  alteracao.php?codigo=$_GET[cod_usuario]&msg=msg_2&secao=$s4");		
		
 
 
?>
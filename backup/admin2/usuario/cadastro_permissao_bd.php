<?php
  include("../biblioteca/online.php");
  if ( !$_SESSION['logado']) {
   header("Location:  /netbilling2.com.br/home/include/index.php?msg=3" );
   exit;
  }

  
			$chaves = array_keys($_GET["permissao"]);

			
			$db->sql("delete from permissao where cod_usuario = $_GET[cod_usuario] ");
			
			//percorre os campos para inserir no padrao do usuário
			for ($i = 0;$i< count($chaves);$i++){
				
				$db->sql("insert into permissao (cod_usuario,cod_tela) values ('". $_GET["cod_usuario"] ."','". $_GET["permissao"][$chaves[$i]] ."') ");
				
			}
			
			//Redireciona para pagina de cadastro de fotos
			header("Location:  alteracao.php?codigo=$_GET[cod_usuario]&msg=msg_1&secao=$s4");
		

?>
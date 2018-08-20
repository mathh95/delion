<?php
  include("../biblioteca/online.php");
  
  if ( !$_SESSION['logado']) {
   header("Location:  /netbilling2.com.br/home/include/index.php?msg=3" );
  exit;
  }
 
  
   if ($_POST["cod_usuario"] == '') {
   
		//verifica se já existe o cliente
		if ($db->sql("select * from usuario where login = '$login'")) {
		
			if ($db->num_rows() == 0) {
				
				//limpa o result
				$db->free_result();
				
				//deixa maiusculo o nome
				$_POST['nome'] = strtoupper($_POST['nome']);
				
				$_POST['senha'] = md5($_POST['senha']);
				
				//cria o objeto para manipulação dos campos do formulário
				$form = new form_db($db, $_POST, "usuario", $t_adm_usuario,  $_SESSION, "log_usuario");
				
				$form->insere(); 
				
				$codigo = $db->id();			
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$codigo&msg=msg_1&secao=$t_adm_usuario");
			
			} else {
				
				//Redireciona para pagina de saida
				header("Location:  alteracao.php?msg=msg_3&secao=$t_adm_usuario");
			
			}
		}
   
   } else {
	
		//verifica se já existe o registro
		if ($db->sql("select * from usuario where nome = '$nome' and cod_usuario <> $_POST[cod_usuario] ")) {
		
			if ($db->num_rows() == 0) {
				
				$db->sql("select * from usuario where cod_usuario = $_POST[cod_usuario]");
				
				$valores = $db->fetch_array();
				
				//limpa o result
				$db->free_result();
				
				//deixa maiusculo o nome
				$_POST['nome'] = strtoupper($_POST['nome']);
				
				if ($valores['senha'] != $_POST['senha']) {
					$_POST['senha'] = md5($_POST['senha']);
				}
							
				//cria o objeto para manipulação dos campos do formulário
				$form = new form_db($db, $_POST, "usuario", $t_adm_usuario, $_SESSION, "log_usuario");
				
				$form->atualiza("cod_usuario"); 
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$_POST[cod_usuario]&msg=msg_4&secao=$t_adm_usuario");
			
			} else {
				
				//Redireciona para pagina de saida
				header("Location:  alteracao.php?codigo=$_POST[cod_usuario]&msg=msg_3&secao=$t_adm_usuario");
			
			}
		}
	}

?>
<?php
  include("../biblioteca/online.php");
  
  if ( !$_SESSION['logado']) {
   header("Location:  /netbilling2.com.br/home/include/index.php?msg=3" );
  exit;
  }
 
  
  
	
	//verifica se já existe o cliente
	if ($db->sql("select * from usuario where nome = '$nome' and cod_usuario <> $_POST[cod_usuario] ")) {
	
		if ($db->num_rows() == 0) {
			
			$valores = $db->fetch_array();
			
			//limpa o result
			$db->free_result();
			
			//deixa maiusculo o nome
			$_POST['nome'] = strtoupper($_POST['nome']);
			
			if ($valores['senha'] != $_POST['senha']) {
				$_POST['senha'] = md5($_POST['senha']);
			}
						
			//cria o objeto para manipulação dos campos do formulário
        	$form = new form_db($db, $_POST, "usuario", $_SESSION, "log_usuario");
			
			$form->atualiza("cod_usuario", "O $s3: $nome foi alterado"); 
			
			//Redireciona para pagina de cadastro de fotos
			header("Location:  meus_dados.php?codigo=$_POST[cod_usuario]&msg=msg_4&secao=$s3");
		
		} else {
			
			//Redireciona para pagina de saida
            header("Location:  meus_dados.php?codigo=$_POST[cod_usuario]&msg=msg_3&secao=$s3");
		
		}
	}

?>
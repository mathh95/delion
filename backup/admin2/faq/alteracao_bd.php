<?php
  include("../biblioteca/online.php");
  
  
   if ($_POST["cod_faq"] == '') {
   
		//verifica se já existe o cliente
		if ($db->sql("select * from faq where pergunta = '$_POST[pergunta]'")) {
		
			if ($db->num_rows() == 0) {
				
				//limpa o result
				$db->free_result();
				
				$_POST['data'] = date('Y-m-d');
				$_POST['hora'] = date('H:i:s');
				
				//cria o objeto para manipulação dos campos do formulário
				$form = new form_db($db, $_POST, "faq", $t_faq,  $_SESSION, "log_usuario");
				
				$form->insere(); 
				
				$codigo = $db->id();			
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$codigo&msg=msg_1&secao=$t_faq");
			
			} else {
				
				//Redireciona para pagina de saida
				header("Location:  alteracao.php?msg=msg_3&secao=$t_faq");
			
			}
		}
   
   } else {
	
		//verifica se já existe o registro
		if ($db->sql("select * from faq where pergunta = '$_POST[pergunta]' and cod_faq <> $_POST[cod_faq] ")) {
		
			if ($db->num_rows() == 0) {
				
				$valores = $db->fetch_array();
				
				//limpa o result
				$db->free_result();
							
				//cria o objeto para manipulação dos campos do formulário
				$form = new form_db($db, $_POST, "faq", $t_faq, $_SESSION, "log_usuario");
				
				$form->atualiza("cod_faq"); 
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$_POST[cod_faq]&msg=msg_4&secao=$t_faq");
			
			} else {
				
				//Redireciona para pagina de saida
				header("Location:  alteracao.php?codigo=$_POST[cod_faq]&msg=msg_3&secao=$t_faq");
			
			}
		}
	}

?>
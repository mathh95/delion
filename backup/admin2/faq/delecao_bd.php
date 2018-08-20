<?php
  include("../biblioteca/online.php");
    
  
					
	//cria o objeto para manipulação dos campos do formulário
	$form = new form_db($db, $_GET, "faq", $t_faq, $_SESSION, "log_usuario");
	
	$form->deleta("cod_faq"); 
	
	//Redireciona para pagina de cadastro de fotos
	header("Location:  consulta.php?msg=msg_2&secao=$s3");		
		
  
 
?>
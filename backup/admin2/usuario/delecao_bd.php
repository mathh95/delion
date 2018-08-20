<?php
  include("../biblioteca/online.php");
    
  
					
	//cria o objeto para manipulação dos campos do formulário
	$form = new form_db($db, $_GET, "usuario", $t_adm_usuario, $_SESSION, "log_usuario");
	
	$form->deleta("cod_usuario"); 
	
	//Redireciona para pagina de cadastro de fotos
	header("Location:  consulta.php?msg=msg_2&secao=$s3");		
		
  
 
?>
<?php
  include("../biblioteca/online.php");
    
  
					
	//cria o objeto para manipula��o dos campos do formul�rio
	$form = new form_db($db, $_GET, "categoria", $t_categoria, $_SESSION, "log_usuario");
	
	$form->deleta("cod_categoria"); 
	
	//Redireciona para pagina de cadastro de fotos
	header("Location:  consulta.php?msg=msg_2&secao=$s3");		
		
  
 
?>
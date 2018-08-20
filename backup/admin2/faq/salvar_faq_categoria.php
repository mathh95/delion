<?
	 include("../biblioteca/online.php");
	 
	 //deixa maiusculo o nome
	 $_POST['nome'] = strtoupper($_POST['nome']);
		
	//verifica se já existe o cliente
	if ($db->sql("select * from faq_categoria where nome = '$_POST[nome]'")) {
	
		if ($db->num_rows() == 0) {
			
			//limpa o result
			$db->free_result();
			
			//deixa maiusculo o nome
			$_POST['nome'] = strtoupper($_POST['nome']);
			
			//cria o objeto para manipulação dos campos do formulário
			$form = new form_db($db, $_POST, "faq_categoria", $t_faq_categoria,  $_SESSION, "log_usuario");
			
			$form->insere(); 
			
			$codigo = $db->id();				
		
		} 
	}
		
		
?>
<option value=""></option>
<?php
  
  					  
  
  //executa query
  $db->sql("SELECT cod_faq_categoria, nome FROM faq_categoria order by nome ");
		
//Verifica ate aonde encontra os dados
  while ($valores = $db->fetch_array()) { 
	  if ($valores['nome'] == $_POST['nome']) {
		echo "<option value=\"$valores[0]\" selected>$valores[1]</option>";
	  } else {
		echo "<option value=\"$valores[0]\">$valores[1]</option>";
	  }
  }								

		  
?>

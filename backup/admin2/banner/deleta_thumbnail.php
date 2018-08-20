<?php	
	session_start();
	
	$caminho_root = ROOTPATH . "/admin/";
  
   //Incluem as variaveis de conex�o
   include($caminho_root. "config.inc.php");
   //include($caminho_root. "biblioteca/lib_foto.php");
   include($caminho_root."biblioteca/conexao_mysql.php");
   //include($caminho_root."biblioteca/paginacao.php");
   include($caminho_root."biblioteca/form_db.php");
   
   $db = new conexao_mysql($db_host,$db_base,$db_user,$db_password);
   $db->sql("delete from temp where sessao = '".session_id()."' and file_id = '".$_GET['id']."'");
	
	echo $_GET['id'];
?>



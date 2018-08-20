<?php
	session_start();
	/*
	// Work-around for setting up a session because Flash Player doesn't send the cookies
	if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	}
	
	*/
    /*
	if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
		echo "There was a problem with the upload";
		exit(0);
	} else {
		echo "Flash requires that we output something or it won't fire the uploadSuccess event";
	}
	*/
	
	
	$aux = ROOTPATH;
	if (strpos($aux, "/", count($aux)) == 0) {
		ROOTPATH .= "/";
	}
	
	$target_path = ROOTPATH . "home/fotos/";

	$target_path = $target_path . trim(basename($_FILES['Filedata']['name'])); 
	//$target_path = $target_path . "teste.mp3"; 
	
	$caminhonovo_grd = "home/fotos/".  trim(basename($_FILES['Filedata']['name']));
	//$caminhonovo_grd = "home/fotos/".  "teste.mp3";
	
	move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path);
	
	
	ob_start();
	echo file_get_contents($_FILES['Filedata']['tmp_name']);
	$conteudo = ob_get_contents();
	ob_end_clean();

	
	$caminho_root = ROOTPATH . "admin/";
  
   //Incluem as variaveis de conex�o
   include($caminho_root. "config.inc.php");
   //include($caminho_root. "biblioteca/lib_foto.php");
   include($caminho_root."biblioteca/conexao_mysql.php");
   //include($caminho_root."biblioteca/paginacao.php");
   include($caminho_root."biblioteca/form_db.php");
   
   
   $db = new conexao_mysql($db_host,$db_base,$db_user,$db_password);
   
   $conteudo = addslashes($conteudo);
	
   $db->sql("insert into temp (sessao,file_id, conteudo,conteudo_gd) values ('$_POST[PHPSESSID]','".$_FILES["Filedata"]["name"]."', '','$conteudo')");
   
   echo "Flash requires that we output something or it won't fire the uploadSuccess event";
?>
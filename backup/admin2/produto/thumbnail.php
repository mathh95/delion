<?
	session_start();
	
	$caminho_root = ROOTPATH . "/admin/";
  
   //Incluem as variaveis de conex�o
   include($caminho_root. "config.inc.php");
   //include($caminho_root. "biblioteca/lib_foto.php");
   include($caminho_root."biblioteca/conexao_mysql.php");
   //include($caminho_root."biblioteca/paginacao.php");
   include($caminho_root."biblioteca/form_db.php");

	// This script accepts an ID and looks in the user's session for stored thumbnail data.
	// It then streams the data to the browser as an image
	
	// Work around the Flash Player Cookie Bug
	//if (isset($_POST["PHPSESSID"])) {
	//	session_id($_POST["PHPSESSID"]);
	//}
	
	
	//print_r($_SESSION);
	//exit(0);
	
	//session_start();
	
	$image_id = isset($_GET["id"]) ? $_GET["id"] : false;
	/*
	if ($image_id === false) {
		header("HTTP/1.1 500 Internal Server Error");
		echo "No ID";
		exit(0);
	}

	if !isset($_COOKIE[$image_id]) {
		header("HTTP/1.1 404 Not found");
		exit(0);
	}
	*/
	
	
	$db = new conexao_mysql($db_host,$db_base,$db_user,$db_password);
	$db->sql("select * from temp where sessao = '".session_id()."' and file_id = '$image_id' limit 0,1");
	$valores = $db->fetch_array();
	header("Content-type: image/jpeg") ;
	header("Content-Length: ".strlen($valores['conteudo']));
	
	echo $valores['conteudo'];
	exit(0);
	
	
	
	
?>
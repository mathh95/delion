<?  
  @header("Content-Type: text/html;  charset=ISO-8859-1",true) ;
  
  //Prepara a secao a ser feita
  @session_start();
  
  
  if ( !$_SESSION['logado']) {
   header("Location:  /admin/index.php?msg=3&pagina=" . $_SERVER['PHP_SELF'] . '?' . str_replace("&","-", $_SERVER['QUERY_STRING'])  );
  exit;
  }
  
  function url_amigavel($string)
  {
	  $table = array(
		  '�'=>'S', '�'=>'s', '�'=>'Dj', 'd'=>'dj', '�'=>'Z',
		  '�'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
		  '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
		  '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E',
		  '�'=>'E', '�'=>'E', '�'=>'I', '�'=>'I', '�'=>'I',
		  '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O',
		  '�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U',
		  '�'=>'U', '�'=>'U', '�'=>'Y', '�'=>'B', '�'=>'Ss',
		  '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
		  '�'=>'a', '�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e',
		  '�'=>'e', '�'=>'e', '�'=>'i', '�'=>'i', '�'=>'i',
		  '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o',
		  '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'u',
		  '�'=>'u', '�'=>'u', '�'=>'y', '�'=>'y', '�'=>'b',
		  '�'=>'y', 'R'=>'R', 'r'=>'r',
	  );
	  // Traduz os caracteres em $string, baseado no vetor $table
	  $string = strtr($string, $table);
	  // converte para min�sculo
	  $string = strtolower($string);
	  // remove caracteres indesej�veis (que n�o est�o no padr�o)
	  $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	  // Remove m�ltiplas ocorr�ncias de h�fens ou espa�os
	  $string = preg_replace("/[\s-]+/", " ", $string);
	  // Transforma espa�os e underscores em h�fens
	  $string = preg_replace("/[\s_]/", "-", $string);
	  // retorna a string
	  return $string;
  } 
  
  function ConverteData($Data)
	{
		if (strstr($Data, "/"))//verifica se tem a barra /
			{
			$d = explode ("/", $Data);//tira a barra
			$rstData = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mes etc...
			return $rstData;
		} elseif(strstr($Data, "-")) {
			$d = explode ("-", $Data);
			$rstData = "$d[2]/$d[1]/$d[0]";
			return $rstData;
		} else {
			return "Data invalida";
		}
	}
	 
  
  //echo ROOTPATH;
  //$caminho_root = ROOTPATH. "netbilling2.com.br/";
  $caminho_root = ROOTPATH . "/admin/";
  
  //Incluem as variaveis de conex�o
   include($caminho_root. "config.inc.php");
   include($caminho_root. "biblioteca/lib_foto.php");
   include($caminho_root."biblioteca/conexao_mysql.php");
   //include($caminho_root."biblioteca/paginacao.php");
   include($caminho_root."biblioteca/form_db.php");
  
  
  
	 //cria a conex�o com o banco
	 $db = new conexao_mysql($db_host,$db_base,$db_user,$db_password);
	
	 $timestamp=time();
	 $timeout=time()-60;
	 
	 if (isset($_GET['secao'])) { 
	 	
		$sql = "SELECT * FROM tela where cod_tela = '" . $_GET['secao'] . "' limit 0,1";	  
		
		$res = $db->sql($sql);
		
		$valor_tela = $db->fetch_array();
	 	
		// Mensagens Padr�o
		$msg_1 = "$valor_tela[nome] cadastrado(a) com sucesso!";
		$msg_2 = "$valor_tela[nome] deletado(a) com sucesso!";
		$msg_3 = "J� existe um $valor_tela[nome] com esse nome!";
		$msg_4 = "Altera��o do(a) $valor_tela[nome] foi efetuado(a) com sucesso!";
		$msg_5 = "O $valor_tela[nome] foi enviado para o cliente!";
		$msg_6 = "O $valor_tela[nome] finalizado com sucesso!";
		$msg_7 = "O $valor_tela[nome] aceito com sucesso!";
		$msg_8 = "O arquivo � grande de mais!";
		$msg_9 = "O $valor_tela[nome] esta em branco!";	 
	 
	 }
	 
	 
	
	 //cadastra a visita do usu�rio na p�gina
	 //$db->sql("INSERT INTO logado (cod_usuario,timestamp) VALUES ('".$_SESSION['cod_usuario']."','$timestamp')");
	
	 //deleta todos os acessos que espiraram de todas as tabelas
	 //$db->sql("DELETE FROM logado WHERE timestamp<$timeout");	
	 			
			
			
			

?>
<?php
 include("../config.inc.php");
 include("../biblioteca/conexao_mysql.php");
 include("../biblioteca/form_db.php");
 
 
 
 
 
 
 //cria a conexão com o banco
  if ($db = new conexao_mysql($db_host,$db_base,$db_user,$db_password)) {
  
 	$_POST['login'] = addslashes(trim($_POST['login'])); 
	$_POST['senha'] = addslashes(trim($_POST['senha']));
  	
  	//verifica se já existe o usuário
	if ($db->sql("select * from usuario where login = '$_POST[login]'")) {
	
		if ($db->num_rows() > 0) {
		
			//limpa o result
			$db->free_result();
			
			$senha = md5($senha);
			
			//verifica se já existe o usuário
			if ($db->sql("select * from usuario where login = '$_POST[login]' and senha = md5('$_POST[senha]')")) {
			
				if ($db->num_rows() > 0) {
				
					$valor = $db->fetch_array();
					
					$primeiro = explode(" ",$valor["nome"]);
					
					//echo "teste";
					//exit;
									
					//Prepara a sessão a ser feita
					session_start();
					//Registra as variaveis da sessão
					//session_register("cod_usuario", "nomeusuario", "emailusuario", "logado", "ip", "tipousuario");
					$_SESSION["cod_usuario"] = $valor["cod_usuario"];
					$_SESSION["nomeusuario"] = $primeiro[0];
					$_SESSION["emailusuario"] = $valor["email"];
					$_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
					$_SESSION["tipousuario"] = $valor["tipo"];
					$_SESSION["logado"] = 1;
					
					
					
					//grava no log que o usuário entrou na consulta
  					$db->sql("insert into log_usuario (cod_usuario, ip,  hora_cad, data_cad, tipo_acao, acao) values (".$valor["cod_usuario"]." , '$ip',  '".date('H:i:s')."' , '".date('Y-m-d')."' ,'Entrar' , 'Entrou do Sistema') ");
					if ($pagina) {
					
						header("Location: $pagina");
					
					} else { 
					
						header("Location: interna.php");
						
					}
				
				} else {
					header("Location: index.php?msg=2&login=$login&pagina=$pagina");
				}			
			
			} 
			
		}else {
		  header("Location: index.php?msg=1&login=$_POST[login]&pagina=$_POST[pagina]");
		 }
	
	}  
  
  } 
  
  //fecha a conexão;
  $db->fechar();
  
  
?>
<?php
  include("../biblioteca/online.php");
 
  
   if ($_POST["cod_produto"] == '') {
   				
				
				$_POST["slug"] = url_amigavel($_POST["slug"]);
				
				$_POST["valor"] = str_replace(",", ".",str_replace(".", "",$_POST["valor"]));			
				
				//cria o objeto para manipulação dos campos do formulário
				$form = new form_db($db, $_POST, "produto", $t_produto,  $_SESSION, "log_usuario");
				
				$form->insere();
				
				$_POST["cod_produto"] = $codigo = $db->id();
				
				
				//*****************************************************************************************
				//Grava as imagens
				//*****************************************************************************************
				
				$res = $db->sql("select * from temp where sessao = '".session_id()."' ");
				while ($valores = mysql_fetch_array($res)) {
				
					//echo $chave . "<br>";
					tratafotos($valores['conteudo_gd'], $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'produto' );
						
					$db->sql("insert into foto (codigo, tabela, foto_gd, foto_md, foto_pq) values ('$_POST[cod_produto]', 'produto', '$caminhonovo_grd', '$caminhonovo_med', '$caminhonovo_peq' )");
				
				}
				$db->sql("delete from temp where sessao = '".session_id()."' ");
	
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$_POST[cod_produto]&msg=msg_1&secao=$t_produto&id=$_REQUEST[id]&cod_super_categoria=$_REQUEST[busca_cod_super_categoria]&cod_categoria=$_REQUEST[busca_cod_categoria]&cod_marca=$_REQUEST[busca_cod_marca]&nome=$_REQUEST[busca_nome]&flag_foto=$_REQUEST[busca_flag_foto]&flag_mostrar_preco=$_REQUEST[busca_flag_mostrar_preco]&flag_ativo=$_REQUEST[busca_flag_ativo]&flag_destaque=$_REQUEST[busca_flag_destaque]&flag_oferta=$_REQUEST[busca_flag_oferta]&flag_lancamento=$_REQUEST[busca_flag_lancamento]");
			
			
   
   } else {
				
		
				$_POST["valor"] = str_replace(",", ".",str_replace(".", "",$_POST["valor"]));			
				
				$_POST["slug"] = url_amigavel($_POST["slug"]);
							
				
				//cria o objeto para manipulação dos campos do formulário
				$form = new form_db($db, $_POST, "produto", $t_produto, $_SESSION, "log_usuario");
				
				$form->atualiza("cod_produto"); 
				
				//*****************************************************************************************
				//Grava as imagens
				//*****************************************************************************************
				
				$res = $db->sql("select * from temp where sessao = '".session_id()."' ");
				while ($valores = mysql_fetch_array($res)) {
				
					//echo $chave . "<br>";
					tratafotos($valores['conteudo_gd'], $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'produto' );
						
					$db->sql("insert into foto (codigo, tabela, foto_gd, foto_md, foto_pq) values ('$_POST[cod_produto]', 'produto', '$caminhonovo_grd', '$caminhonovo_med', '$caminhonovo_peq' )");
				
				}
				
				$db->sql("delete from temp where sessao = '".session_id()."' ");
				
				
				//*****************************************************************************************
				//Grava a ordem
				//*****************************************************************************************
				if ($_POST['ordem']) {
				  
				  $_POST['ordem'] = str_replace('sortable[]=','',$_POST['ordem']);
				  $ordem = explode('&',$_POST['ordem']);
				   
				  
				  for($i = 0; $i<count($ordem);$i++) {
					  $db->sql("update foto set ordem = $i where cod_foto = " .$ordem[$i] );
				  }
				
				}
							
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$_POST[cod_produto]&msg=msg_4&secao=$t_produto&id=$_REQUEST[id]&cod_super_categoria=$_REQUEST[busca_cod_super_categoria]&cod_categoria=$_REQUEST[busca_cod_categoria]&cod_marca=$_REQUEST[busca_cod_marca]&nome=$_REQUEST[busca_nome]&flag_foto=$_REQUEST[busca_flag_foto]&flag_mostrar_preco=$_REQUEST[busca_flag_mostrar_preco]&flag_ativo=$_REQUEST[busca_flag_ativo]&flag_destaque=$_REQUEST[busca_flag_destaque]&flag_oferta=$_REQUEST[busca_flag_oferta]&flag_lancamento=$_REQUEST[busca_flag_lancamento]");
			
			
	}

?>
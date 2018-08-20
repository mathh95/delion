<?php
  include("../biblioteca/online.php");
 
  
   if ($_POST["cod_categoria"] == '') {
   				
		  $_POST["slug"] = url_amigavel($_POST["nome"]);
		  
		  //cria o objeto para manipulação dos campos do formulário
		  $form = new form_db($db, $_POST, "categoria", $t_categoria,  $_SESSION, "log_usuario");
		  
		  $form->insere(); 
		  
		  
		  $_POST["cod_categoria"] = $db->id();
				
   } else {
							
		$_POST["slug"] = url_amigavel($_POST["nome"]);
		
		//cria o objeto para manipulação dos campos do formulário
		$form = new form_db($db, $_POST, "categoria", $t_categoria, $_SESSION, "log_usuario");
		
		$form->atualiza("cod_categoria"); 
				
	}
		
				
				
				
				//*****************************************************************************************
				//Grava as imagens
				//*****************************************************************************************
				
				if ($_FILES["arquivo"]["tmp_name"]) {
				
					//echo $chave . "<br>";
					//tratafotos($valores['conteudo_gd'], $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'destaque' );
					
					$src_path = $_FILES["arquivo"]["tmp_name"];
					
					$marca = 'categoria_banner';
					
					$caminho_root = ROOTPATH . "/admin/";
					include($caminho_root. "config.inc.php");
					
					//$aux = ROOTPATH;
					//if (strpos($aux, "/", count($aux)) == 0) {
						ROOTPATH .= "/";
					//}
					
					//echo strpos($aux, "/", count($aux));
					//exit;
					
					if (!is_dir(ROOTPATH . "home/fotos/".$marca))
					{
						//Cria diretorio
						mkdir (ROOTPATH . "home/fotos/" . $marca, 0777);
					}
					
					//echo ROOTPATH."home/fotos/";
					//exit;
					
					$nomearquivo = uniqid(md5(time()));
					$caminhonovo = "home/fotos/" . $marca . "/" . $nomearquivo;
					$caminhonovo_grd = "home/fotos/" . $marca . "/" . $nomearquivo . "_grd.jpg";
					$caminhonovo_med = "home/fotos/" . $marca . "/" . $nomearquivo . "_med.jpg";
					$caminhonovo_peq = "home/fotos/" . $marca . "/" . $nomearquivo . "_peq.jpg";
					
					
					$caminhonovo = $caminhonovo.".jpg";
					
					//grava a imagem grande
					copy($src_path,ROOTPATH . $caminhonovo);
					/*$handle = fopen(ROOTPATH . $caminhonovo, "w+");
					fwrite($handle,$src_path);
					fclose($handle);*/
					
					//echo $src_path . "<br>";
					//echo ROOTPATH . "/". $caminhonovo;
					
					$metodo = "im";
					$largura_med = $foto_largura_med;
					$altura_peq = $foto_altura_peq;
					$largura_grd = $foto_largura_grd;	
					
					tratafotos( file_get_contents($src_path) , $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'categoria_banner' );
					
					$db->sql("delete from foto where codigo = '$_POST[cod_categoria]' and tabela ='categoria_banner'");
					
					$db->sql("insert into foto (codigo, tabela, foto_gd, foto_md, foto_pq) values ('$_POST[cod_banner]', 'categoria_banner', '$caminhonovo', '$caminhonovo_med', '$caminhonovo_peq' )");
				
				}
				
				if ($_FILES["arquivo_esp"]["tmp_name"]) {
				
					//echo $chave . "<br>";
					//tratafotos($valores['conteudo_gd'], $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'destaque' );
					
					$src_path = $_FILES["arquivo_esp"]["tmp_name"];
					
					$marca = 'categoria_icone';
					
					$caminho_root = ROOTPATH . "/admin/";
					include($caminho_root. "config.inc.php");
					
					//$aux = ROOTPATH;
					//if (strpos($aux, "/", count($aux)) == 0) {
						ROOTPATH .= "/";
					//}
					
					//echo strpos($aux, "/", count($aux));
					//exit;
					
					if (!is_dir(ROOTPATH . "home/fotos/".$marca))
					{
						//Cria diretorio
						mkdir (ROOTPATH . "home/fotos/" . $marca, 0777);
					}
					
					//echo ROOTPATH."home/fotos/";
					//exit;
					
					$nomearquivo = uniqid(md5(time()));
					$caminhonovo = "home/fotos/" . $marca . "/" . $nomearquivo;
					$caminhonovo_grd = "home/fotos/" . $marca . "/" . $nomearquivo . "_grd.jpg";
					$caminhonovo_med = "home/fotos/" . $marca . "/" . $nomearquivo . "_med.jpg";
					$caminhonovo_peq = "home/fotos/" . $marca . "/" . $nomearquivo . "_peq.jpg";
					
					
					$caminhonovo = $caminhonovo.".jpg";
					
					//grava a imagem grande
					copy($src_path,ROOTPATH . $caminhonovo);
					/*$handle = fopen(ROOTPATH . $caminhonovo, "w+");
					fwrite($handle,$src_path);
					fclose($handle);*/
					
					//echo $src_path . "<br>";
					//echo ROOTPATH . "/". $caminhonovo;
					
					$metodo = "im";
					$largura_med = $foto_largura_med;
					$altura_peq = $foto_altura_peq;
					$largura_grd = $foto_largura_grd;	
					
					tratafotos( file_get_contents($src_path) , $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'categoria_icone' );
					
					$db->sql("delete from foto where codigo = '$_POST[cod_categoria]' and tabela ='categoria_icone'");
					
					$db->sql("insert into foto (codigo, tabela, foto_gd, foto_md, foto_pq) values ('$_POST[cod_categoria]', 'categoria_icone', '$caminhonovo', '$caminhonovo_med', '$caminhonovo_peq' )");
				
				}
				
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$_POST[cod_categoria]&msg=msg_4&secao=$t_categoria&id=$_POST[id]");
			
			

?>
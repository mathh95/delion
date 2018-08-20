<?php
  include("../biblioteca/online.php");
 
  
   if ($_POST["cod_banner"] == '') {
   
		//verifica se j� existe o cliente
		if ($db->sql("select * from banner where nome = '$_POST[nome]'")) {
		
			if ($db->num_rows() == 0) {
				
				//limpa o result
				$db->free_result();
				
				$data = explode('/',$_POST['data_inicio']);
				$_POST['data_inicio'] = $data[2] . "-" . $data[1] . "-" .  $data[0];
				
				$data = explode('/',$_POST['data_fim']);
				$_POST['data_fim'] = $data[2] . "-" . $data[1] . "-" .  $data[0];
				
				//cria o objeto para manipula��o dos campos do formul�rio
				$form = new form_db($db, $_POST, "banner", $t_banner,  $_SESSION, "log_usuario");
				
				$form->insere(); 
				
				$codigo = $db->id();
				
				//*****************************************************************************************
				//Grava as imagens
				//*****************************************************************************************
				
				if ($_FILES["arquivo"]["tmp_name"]) {
				
					//echo $chave . "<br>";
					//tratafotos($valores['conteudo_gd'], $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'destaque' );
					
					$src_path = $_FILES["arquivo"]["tmp_name"];
					
					$marca = 'banner';
					
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
					$caminhonovo = "home/fotos/" . $marca . "/" . $nomearquivo . ".jpg";
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
					
					if (!gera_thumb_gd_jpg(ROOTPATH .$caminhonovo,ROOTPATH.$caminhonovo_grd, ROOTPATH.$caminhonovo_med, ROOTPATH.$caminhonovo_peq, $largura_med, $altura_peq, $largura_grd)) {
					  //Vai para uma tela dizendo que nao foi possivel atualizar a foto
					  header("Location: /admin/saida/foto_erro.htm");
					  //exit;
					}
						
					$db->sql("insert into foto (codigo, tabela, foto_gd, foto_md, foto_pq) values ('$codigo', 'banner', '$caminhonovo', '$caminhonovo_med', '$caminhonovo_peq' )");
				
				}
				
				
	
				
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$codigo&msg=msg_1&secao=$t_banner");
			
			} else {
				
				//Redireciona para pagina de saida
				header("Location:  alteracao.php?msg=msg_3&secao=$t_banner");
			
			}
		}
   
   } else {
	
		//verifica se j� existe o registro
		if ($db->sql("select * from banner where nome = '$_POST[nome]' and cod_banner <> $_POST[cod_banner] ")) {
		
			if ($db->num_rows() == 0) {
				
				$valores = $db->fetch_array();
				
				//limpa o result
				$db->free_result();
				
				$data = explode('/',$_POST['data_inicio']);
				$_POST['data_inicio'] = $data[2] . "-" . $data[1] . "-" .  $data[0];
				
				$data = explode('/',$_POST['data_fim']);
				$_POST['data_fim'] = $data[2] . "-" . $data[1] . "-" .  $data[0];
							
				//cria o objeto para manipula��o dos campos do formul�rio
				$form = new form_db($db, $_POST, "banner", $t_banner, $_SESSION, "log_usuario");
				
				$form->atualiza("cod_banner"); 
				
				//*****************************************************************************************
				//Grava as imagens
				//*****************************************************************************************
				
				if ($_FILES["arquivo"]["tmp_name"]) {
				
					//echo $chave . "<br>";
					//tratafotos($valores['conteudo_gd'], $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'destaque' );
					
					$src_path = $_FILES["arquivo"]["tmp_name"];
					
					$marca = 'banner';
					
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
					
					tratafotos( file_get_contents($src_path) , $caminhonovo_grd, $caminhonovo_med, $caminhonovo_peq, 'banner' );
					
					$db->sql("delete from foto where codigo = '$_POST[cod_banner]' and tabela ='banner'");
					
					$db->sql("insert into foto (codigo, tabela, foto_gd, foto_md, foto_pq) values ('$_POST[cod_banner]', 'banner', '$caminhonovo', '$caminhonovo_med', '$caminhonovo_peq' )");
				
				}
				
				
							
				//Redireciona para pagina de cadastro de fotos
				header("Location:  alteracao.php?codigo=$_POST[cod_banner]&msg=msg_4&secao=$t_banner");
			
			} else {
				
				//Redireciona para pagina de saida
				header("Location:  alteracao.php?codigo=$_POST[cod_banner]&msg=msg_3&secao=$t_banner");
			
			}
		}
	}

?>
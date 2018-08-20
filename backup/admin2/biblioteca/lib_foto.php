<?php


function resize_image_gd($src_file, $dest_file, $new_size, $method, $tipo)
{
    //CRIA UMA NOVA IMAGEM
	if (($tipo == "image/jpg") || ($tipo == "image/jpeg") || ($tipo == "image/pjpeg")) {
		$imagem_orig = ImageCreateFromJPEG($src_file);
	} else {
		$imagem_orig = imagecreatefromgif($src_file);
	}
	//LARGURA
	$srcWidth = ImagesX($imagem_orig);
	//ALTURA
	$srcHeight = ImagesY($imagem_orig);
    
	$ratio = max($srcWidth, $srcHeight) / $new_size;
	$ratio = max($ratio, 1.0);
	$destWidth = (int)($srcWidth / $ratio);
	$destHeight = (int)($srcHeight / $ratio);
	
	//CRIA O THUMBNAIL
    $imagem = ImageCreateTrueColor($destWidth, $destHeight);
	
	//COPIA A IMAGEM ORIGINAL PARA DENTRO
	ImageCopyResampled($imagem, $imagem_orig, 0, 0, 0, 0, $destWidth+1, $destHeight+1, $srcWidth, $srcHeight);
	
	//SALVA A IMAGEM
	if (($tipo == "image/jpg") || ($tipo == "image/jpeg") || ($tipo == "image/pjpeg")) {
		ImageJPEG($imagem, $dest_file);
	} else {
		imagegif($imagem, $dest_file);
	}
	
	//LIBERA A MEM�RIA
	ImageDestroy($imagem_orig);
	ImageDestroy($imagem);
	
	return true;
}

function gera_thumb_gd_jpg($src_file, $dest_file_grd, $dest_file_med, $dest_file_peq, $new_width_med, $new_heigth_peq, $new_width_grd, $logo)
{
	
	//CRIA UMA NOVA IMAGEM
	$imagem_orig = ImageCreateFromJPEG($src_file);
	//LARGURA
	$srcWidth = ImagesX($imagem_orig);
	//ALTURA
	$srcHeight = ImagesY($imagem_orig);
	//CRIA A IMAGEM DE LOGO
	$imagem_logo = ImageCreateFromGif($logo);
	//LARGURA Logo
	$srcWidth_logo = ImagesX($imagem_logo);
	//ALTURA Logo
	$srcHeight_logo = ImagesY($imagem_logo);
    
	if ($srcHeight > $srcWidth)
	{
		$new_heigth_med = 300;
		$ratio = $srcHeight / $new_heigth_med;
		$ratio = max($ratio, 1.0);
		$destWidth_med = (int)($srcWidth / $ratio);
		$destHeight_med = (int)($srcHeight / $ratio);
	} 
	else
	{
		if ($srcHeight < $srcWidth) {
		
			$new_width_med = 180;
			$ratio = $srcWidth / $new_width_med;
			$ratio = max($ratio, 1.0);
			$destWidth_med = (int)($srcWidth / $ratio);
			$destHeight_med = (int)($srcHeight / $ratio);
		
		} else {
		
			$ratio = $srcWidth / $new_width_med;
			$ratio = max($ratio, 1.0);
			$destWidth_med = (int)($srcWidth / $ratio);
			$destHeight_med = (int)($srcHeight / $ratio);
		}
	}
	

	if ($srcHeight > $srcWidth)
	 {
	  $new_heigth_peq = 120;
	  $ratio = $srcHeight / $new_heigth_peq;
	  $ratio = max($ratio, 1.0);
	  $destWidth_peq = (int)($srcWidth / $ratio);
	  $destHeight_peq = (int)($srcHeight / $ratio);
    } 
	else
	   {
	    if ($srcHeight < $srcWidth) {
		
			$new_width_peq = 90;
			$ratio = $srcWidth / $new_width_peq;
			$ratio = max($ratio, 1.0);
			$destWidth_peq = (int)($srcWidth / $ratio);
			$destHeight_peq = (int)($srcHeight / $ratio);
		
		} else {
		
			$ratio = $srcHeight / $new_heigth_peq;
			$ratio = max($ratio, 1.0);
			$destWidth_peq = (int)($srcWidth / $ratio);
			$destHeight_peq = (int)($srcHeight / $ratio);
		
		}
	  }
	
	if ($srcHeight > $srcWidth)
	{
		$new_heigth_grd = 600;
		$ratio = $srcHeight / $new_heigth_grd;
		$ratio = max($ratio, 1.0);
		$destWidth_grd = (int)($srcWidth / $ratio);
		$destHeight_grd = (int)($srcHeight / $ratio);
	} 
	else
	{
		if ($srcHeight < $srcWidth) {
		
			$new_width_grd = 540;
			$ratio = $srcWidth / $new_width_grd;
			$ratio = max($ratio, 1.0);
			$destWidth_grd = (int)($srcWidth / $ratio);
			$destHeight_grd = (int)($srcHeight / $ratio);
		
		} else {
		
			$ratio = $srcWidth / $new_width_grd;
			$ratio = max($ratio, 1.0);
			$destWidth_grd = (int)($srcWidth / $ratio);
			$destHeight_grd = (int)($srcHeight / $ratio);
		}
	}
	
	//CRIA O THUMBNAIL
    $imagem_grd = ImageCreateTrueColor($destWidth_grd, $destHeight_grd);
	$imagem_med = ImageCreateTrueColor($destWidth_med, $destHeight_med);
	$imagem_peq = ImageCreateTrueColor($destWidth_peq, $destHeight_peq);
	
	//COPIA A IMAGEM ORIGINAL PARA DENTRO
	ImageCopyResampled($imagem_grd, $imagem_orig, 0, 0, 0, 0, $destWidth_grd+1, $destHeight_grd+1, $srcWidth, $srcHeight);
	ImageCopyMerge($imagem_grd,  $imagem_logo, ((($destWidth_grd+1)/2) - ($srcWidth_logo/2)), ((($destHeight_grd+1)/2) - ($srcHeight_logo/2)), 0, 0, $srcWidth_logo, $srcHeight_logo, 25);
	ImageCopyResampled($imagem_med, $imagem_orig, 0, 0, 0, 0, $destWidth_med+1, $destHeight_med+1, $srcWidth, $srcHeight);
	ImageCopyResampled($imagem_peq, $imagem_orig, 0, 0, 0, 0, $destWidth_peq+1, $destHeight_peq+1, $srcWidth, $srcHeight);
	
	//SALVA A IMAGEM
	ImageJPEG($imagem_grd, $dest_file_grd);
	ImageJPEG($imagem_med, $dest_file_med);
	ImageJPEG($imagem_peq, $dest_file_peq);
	
	//**************************************************************************
	//crop da imagem pequena
	//**************************************************************************
	
	//CRIA UMA NOVA IMAGEM
	$img = ImageCreateFromJPEG($dest_file_peq);
	// assuming that $img holds the image with which you are working
	$img_width  = imagesx($img);
	$img_height = imagesy($img);
	
	// New image size
	$width  = 60;
	$height = 60;
	
	// Starting point of crop
	$tlx = floor($img_width / 2) - floor ($width / 2);
	$tly = floor($img_height / 2) - floor($height / 2);
	
	// Adjust crop size if the image is too small
	if ($tlx < 0)
	{
	  $tlx = 0;
	}
	if ($tly < 0)
	{
	  $tly = 0;
	}
	
	if (($img_width - $tlx) < $width)
	{
	  $width = $img_width - $tlx;
	}
	if (($img_height - $tly) < $height)
	{
	  $height = $img_height - $tly;
	}
	
	$im = imagecreatetruecolor($width, $height);
	imagecopy($im, $img, 0, 0, $tlx, $tly, $width, $height);
	
	ImageJPEG($im, $dest_file_peq);
	
	//LIBERA A MEM�RIA
	ImageDestroy($imagem_orig);
	ImageDestroy($imagem_logo);
	ImageDestroy($imagem_grd);
	ImageDestroy($imagem_med);
	ImageDestroy($imagem_peq);
	
	return true;
}

function gera_thumb_gd_gif($src_file, $dest_file_grd, $dest_file_med, $dest_file_peq, $new_width_med, $new_heigth_peq, $new_width_grd)
{
	
	//CRIA UMA NOVA IMAGEM
	$imagem_orig = imagecreatefromgif($src_file);
	//LARGURA
	$srcWidth = ImagesX($imagem_orig);
	//ALTURA
	$srcHeight = ImagesY($imagem_orig);
    
	if ($srcHeight > $srcWidth)
	{
		$new_heigth_med = 150;
		$ratio = $srcHeight / $new_heigth_med;
		$ratio = max($ratio, 1.0);
		$destWidth_med = (int)($srcWidth / $ratio);
		$destHeight_med = (int)($srcHeight / $ratio);
	} 
	else
	{
		if ($srcHeight < $srcWidth) {
		
			$new_width_med = 205;
			$ratio = $srcWidth / $new_width_med;
			$ratio = max($ratio, 1.0);
			$destWidth_med = (int)($srcWidth / $ratio);
			$destHeight_med = (int)($srcHeight / $ratio);
		
		} else {
			$ratio = $srcWidth / $new_width_med;
			$ratio = max($ratio, 1.0);
			$destWidth_med = (int)($srcWidth / $ratio);
			$destHeight_med = (int)($srcHeight / $ratio);
		
		}
	}
	

	if ($srcHeight > $srcWidth)
	 {
	  $new_heigth_peq = 80;
	  $ratio = $srcHeight / $new_heigth_peq;
	  $ratio = max($ratio, 1.0);
	  $destWidth_peq = (int)($srcWidth / $ratio);
	  $destHeight_peq = (int)($srcHeight / $ratio);
    } 
	else
	   {
	    if ($srcHeight < $srcWidth) {
		
			$new_width_peq = 110;
			$ratio = $srcWidth / $new_width_peq;
			$ratio = max($ratio, 1.0);
			$destWidth_peq = (int)($srcWidth / $ratio);
			$destHeight_peq = (int)($srcHeight / $ratio);
		
		} else {
		
			$ratio = $srcHeight / $new_heigth_peq;
			$ratio = max($ratio, 1.0);
			$destWidth_peq = (int)($srcWidth / $ratio);
			$destHeight_peq = (int)($srcHeight / $ratio);
		
		}
	  }
	
	
	$ratio = $srcWidth / $new_width_grd;
    $ratio = max($ratio, 1.0);
    $destWidth_grd = (int)($srcWidth / $ratio);
    $destHeight_grd = (int)($srcHeight / $ratio);
	
	//CRIA O THUMBNAIL
    $imagem_grd = ImageCreateTrueColor($destWidth_grd, $destHeight_grd);
	$imagem_med = ImageCreateTrueColor($destWidth_med, $destHeight_med);
	$imagem_peq = ImageCreateTrueColor($destWidth_peq, $destHeight_peq);
	
	//COPIA A IMAGEM ORIGINAL PARA DENTRO
	ImageCopyResampled($imagem_grd, $imagem_orig, 0, 0, 0, 0, $destWidth_grd+1, $destHeight_grd+1, $srcWidth, $srcHeight);
	ImageCopyResampled($imagem_med, $imagem_orig, 0, 0, 0, 0, $destWidth_med+1, $destHeight_med+1, $srcWidth, $srcHeight);
	ImageCopyResampled($imagem_peq, $imagem_orig, 0, 0, 0, 0, $destWidth_peq+1, $destHeight_peq+1, $srcWidth, $srcHeight);
	
	//SALVA A IMAGEM
	imagegif($imagem_grd, $dest_file_grd);
	imagegif($imagem_med, $dest_file_med);
	imagegif($imagem_peq, $dest_file_peq);
	
	//LIBERA A MEM�RIA
	ImageDestroy($imagem_orig);
	ImageDestroy($imagem_grd);
	ImageDestroy($imagem_med);
	ImageDestroy($imagem_peq);
	
	return true;
}

//funcao que transforma as fotos
function tratafotos($src_path, &$caminhonovo_grd, &$caminhonovo_med, &$caminhonovo_peq, $marca)
{
	$caminho_root = ROOTPATH . "/admin/";
	include($caminho_root. "config.inc.php");
	
	$aux = ROOTPATH;
	if (strpos($aux, "/", count($aux)) == 0) {
		ROOTPATH .= "/";
	}
	
	if (!is_dir(ROOTPATH . "/home/fotos/".$marca))
	{
		//Cria diretorio
		mkdir (ROOTPATH . "/home/fotos/" . $marca, 0700);
	}
	
	//echo ROOTPATH."home/fotos/";
	//exit;
	
	$nomearquivo = uniqid(md5(time()));
	$caminhonovo = "home/fotos/" . $marca . "/" . $nomearquivo . ".jpg";
	$caminhonovo_grd = "home/fotos/" . $marca . "/" . $nomearquivo . "_grd" . ".jpg" ;
	$caminhonovo_med = "home/fotos/" . $marca . "/" . $nomearquivo . "_med" . ".jpg";
	$caminhonovo_peq = "home/fotos/" . $marca . "/" . $nomearquivo . "_peq" . ".jpg";
	
	//grava a imagem grande
	$handle = fopen(ROOTPATH . "/"  . $caminhonovo, "w+");
	fwrite($handle,$src_path);
	fclose($handle);
	
	//echo $src_path . "<br>";
	//echo ROOTPATH . "/". $caminhonovo;
	
	$logo_marca_dagua = ROOTPATH."/admin/img/logo_marca_dagua.gif";
	
	$metodo = "im";
	$largura_med = $foto_largura_med;
	$altura_peq = $foto_altura_peq;
	$largura_grd = $foto_largura_grd;	
	
	if (!gera_thumb_gd_jpg(ROOTPATH . "/" .$caminhonovo,ROOTPATH . "/".$caminhonovo_grd, ROOTPATH. "/".$caminhonovo_med, ROOTPATH. "/".$caminhonovo_peq, $largura_med, $altura_peq, $largura_grd, $logo_marca_dagua)) {
	  //Vai para uma tela dizendo que nao foi possivel atualizar a foto
	  header("Location: /admin/saida/foto_erro.htm");
	  //exit;
	}
	
	//$caminhonovo_grd = "/" . $caminhonovo_grd;
	//$caminhonovo_med = "/" . $caminhonovo_med;
	//$caminhonovo_peq = "/" . $caminhonovo_peq;

}
/*
function tratafotos($src_path, &$caminhonovo_grd, &$caminhonovo_med, &$caminhonovo_peq, $marca)
{
	$caminho_root = ROOTPATH . "/admin/";
	include($caminho_root. "config.inc.php");
	
	$aux = ROOTPATH;
	if (strpos($aux, "/", count($aux)) == 0) {
		ROOTPATH .= "/";
	}
	
	if (!is_dir(ROOTPATH . "home/fotos/".$marca))
	{
		//Cria diretorio
		mkdir (ROOTPATH . "home/fotos/" . $marca, 0700);
	}
	
	//echo ROOTPATH."home/fotos/";
	//exit;
	
	$nomearquivo = uniqid(md5(time()));
	$caminhonovo = "home/fotos/" . $marca . "/" . $nomearquivo;
	$caminhonovo_grd = "home/fotos/" . $marca . "/" . $nomearquivo . "_grd";
	$caminhonovo_med = "home/fotos/" . $marca . "/" . $nomearquivo . "_med";
	$caminhonovo_peq = "home/fotos/" . $marca . "/" . $nomearquivo . "_peq";
	
	//grava a imagem grande
	$handle = fopen(ROOTPATH . $caminhonovo, "w+");
	fwrite($handle,$src_path);
	fclose($handle);
	
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
	
	//$caminhonovo_grd = "/" . $caminhonovo_grd;
	//$caminhonovo_med = "/" . $caminhonovo_med;
	//$caminhonovo_peq = "/" . $caminhonovo_peq;

}
*/
?>
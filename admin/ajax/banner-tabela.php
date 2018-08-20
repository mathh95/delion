<?php
include_once ROOTPATH."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlBanner.php";
include_once MODELPATH."/banner.php";
protegePagina();

$controle=new controlerBanner($_SG['link']);
$banners = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('banner', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbBanner' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de Banner</h1>
			<tr>
	    		<th width='25%' style='text-align: center;'>Banner</th>
	    		<th width='15%' style='text-align: center;'>Nome</th>
	    		<th width='15%' style='text-align: center;'>Página</th>
	    		<th width='15%' style='text-align: center;'>Link</th>
	            <th width='15%' style='text-align: center;'>Editar</th>
	            <th width='15%' style='text-align: center;'>Apagar</th>
	        </tr>
		<tbody>";
	
		foreach ($banners as &$banner) {
			$mensagem='Banner excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$banner->getCod_Banner()."'>
			 	<td style='text-align: center;' name='banner'><img src='../../".$banner->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$banner->getNome()."</td>
			 	<td style='text-align: center;' name='pagina'>".$banner->getDsPagina()."</td>
			 	<td style='text-align: center;' name='link'>".$banner->getLink()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='banner-view.php?cod=".$banner->getCod_banner()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeBanner(".$banner->getCod_banner().",'../".$banner->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbBanner' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de Banner</h1>
			<tr>
	    		<th width='40%' style='text-align: center;'>Banner</th>
	    		<th width='15%' style='text-align: center;'>Nome</th>
	    		<th width='15%' style='text-align: center;'>Link</th>
	            <th width='15%' style='text-align: center;'>Editar</th>
	        </tr>
		<tbody>";
	
		foreach ($banners as &$banner) {
			echo "<tr name='resutaldo' id='status".$banner->getCod_Banner()."'>
			 	<td style='text-align: center;' name='banner'><img src='../../".$banner->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$banner->getNome()."</td>
			 	<td style='text-align: center;' name='link'>".$banner->getLink()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='banner-view.php?cod=".$banner->getCod_banner()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			</tr>";
		}
	}

echo "</tbody></table>";
?>
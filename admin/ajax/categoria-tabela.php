<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlCategoria.php";
include_once MODELPATH."/categoria.php";
protegePagina();

$controle=new controlerCategoria($_SG['link']);
$categorias = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('categoria', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbCategoria' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de categoria</h1>
			<tr>
	    		<th width='25%' style='text-align: center;'>Nome</th>
	    		<th width='25%' style='text-align: center;'>Icone</th>
	            <th width='25%' style='text-align: center;'>Editar</th>
	            <th width='25%' style='text-align: center;'>Apagar</th>
	        </tr>
		<tbody>";
	
		foreach ($categorias as &$categoria) {
			$mensagem='categoria excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$categoria->getCod_categoria()."'>
			 	<td style='text-align: center;' name='nome'>".$categoria->getNome()."</td>
			 	<td style='text-align: center;' name='icone'><img src='../../".$categoria->getIcone()."' style='max-height: 100px; background-color: #BE392A;' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='categoria-view.php?cod=".$categoria->getCod_categoria()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeCategoria(".$categoria->getCod_categoria().",'../".$categoria->getIconeAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbCategoria' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de categoria</h1>
			<tr>
	    		<th width='33%' style='text-align: center;'>Nome</th>
	    		<th width='33%' style='text-align: center;'>Icone</th>
	            <th width='33%' style='text-align: center;'>Editar</th>
	        </tr>
		<tbody>";
	
		foreach ($categorias as &$categoria) {
			echo "<tr name='resutaldo' id='status".$categoria->getCod_categoria()."'>
			 	<td style='text-align: center;' name='nome'>".$categoria->getNome()."</td>
			 	<td style='text-align: center;' name='icone'><img src='../../".$categoria->getIcone()."' style='max-height: 100px; background-color: #BE392A;' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='categoria-view.php?cod=".$categoria->getCod_categoria()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			</tr>";
		}
	}

echo "</tbody></table>";
?>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlerGerenciaSite.php";
include_once MODELPATH."/gerencia_site.php";
protegePagina();

$controle=new controlerGerenciarSite($_SG['link']);
$configs = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('imagem', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbImagem' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de imagens</h1>
			<tr>
	    		<th width='20%' style='text-align: center;'>Imagem</th>
	    		<th width='20%' style='text-align: center;'>Nome Configuração</th>
	    		<th width='20%' style='text-align: center;'>Cor Primária</th>
	            <th width='20%' style='text-align: center;'>Cor Secundária</th>
                <th width='20%' style='text-align: center;'>Ativar/Desativar</th>
                <th width='20%' style='text-align: center;'>Excluir</th>
	        </tr>
		<tbody>";
	
		foreach ($configs as &$config) {
			$mensagem='Imagem excluída com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$config->getPkId()."'>
			 	<td style='text-align: center;' name='imagem'><img src='../../".$config->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$config->getNome()."</td>
                <td style='text-align: center;' name='corPrimaria'>".$config->getCorPrimaria()."</td>
                <td style='text-align: center;' name='corSecundaria'>".$config->getCorSecundaria()."</td>
                <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='imagem-view.php?cod=".$config->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Ativar</button></a></td>
                <td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeImagem(".$config->getPkId().",'../".$config->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i> Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbImagem' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de imagem</h1>
			<tr>
	    		<th width='25%' style='text-align: center;'>Imagem</th>
	    		<th width='25%' style='text-align: center;'>Nome</th>
	    		<th width='25%' style='text-align: center;'>Link</th>
	            <th width='25%' style='text-align: center;'>Editar</th>
	        </tr>
		<tbody>";
	
		foreach ($configs as &$config) {
			echo "<tr name='resutaldo' id='status".$config->getPkId()."'>
			 	<td style='text-align: center;' name='imagem'><img src='../../".$config->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$config->getNome()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='imagem-view.php?cod=".$imagem->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			</tr>";
		}
	}

echo "</tbody></table>";
?>
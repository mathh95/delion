<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlImagem.php";
include_once MODELPATH."/imagem.php";
protegePagina();

$controle=new controlerImagem($_SG['link']);
$imagens = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('imagem', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbImagem' style='text-align = center;'>
		<thead>
			<h1 >Lista de imagens</h1>
			<tr>
	    		<th width='20%' style='text-align: center;'>Imagem</th>
	    		<th width='20%' style='text-align: center;'>Nome</th>
	    		<th width='20%' style='text-align: center;'>Página</th>
	            <th width='20%' style='text-align: center;'>Editar</th>
	            <th width='20%' style='text-align: center;'>Apagar</th>
	        </tr>
		<tbody>";
	
		foreach ($imagens as &$imagem) {
			$mensagem='Imagem excluída com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$imagem->getPkId()."'>
			 	<td style='text-align: center;' name='imagem'><img src='../../".$imagem->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$imagem->getNome()."</td>
			 	<td style='text-align: center;' name='pagina'>".$imagem->getDsPagina()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='imagem-view.php?cod=".$imagem->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>
			 	<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeImagem(".$imagem->getPkId().",'../".$imagem->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i> Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbImagem' style='text-align = center;'>
		<thead>
			<h1 >Lista de imagem</h1>
			<tr>
	    		<th width='25%' style='text-align: center;'>Imagem</th>
	    		<th width='25%' style='text-align: center;'>Nome</th>
	    		<th width='25%' style='text-align: center;'>Link</th>
	            <th width='25%' style='text-align: center;'>Editar</th>
	        </tr>
		<tbody>";
	
		foreach ($imagens as &$imagem) {
			echo "<tr name='resutaldo' id='status".$imagem->getPkId()."'>
			 	<td style='text-align: center;' name='imagem'><img src='../../".$imagem->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$imagem->getNome()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='imagem-view.php?cod=".$imagem->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			</tr>";
		}
	}

echo "</tbody></table>";
?>
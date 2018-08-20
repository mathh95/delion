<?php
include_once ROOTPATH."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlCardapio.php";
include_once MODELPATH."/cardapio.php";
protegePagina();

$controle=new controlerCardapio($_SG['link']);
$cardapios = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('cardapio', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de cardapio</h1>
			<tr>
	    		<th width='14%' style='text-align: center;'>Item</th>
	    		<th width='14%' style='text-align: center;'>Nome</th>
	    		<th width='14%' style='text-align: center;'>Descrição</th>
	    		<th width='14%' style='text-align: center;'>Categoria</th>
	    		<th width='14%' style='text-align: center;'>Situação</th>
	            <th width='14%' style='text-align: center;'>Editar</th>
	            <th width='14%' style='text-align: center;'>Apagar</th>
	        </tr>
		<tbody>";
	
		foreach ($cardapios as &$cardapio) {
			$mensagem='Cardápio excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$cardapio->getCod_cardapio()."'>
			 	<td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
			 	<td style='text-align: center;' name='descricao'>".substr(html_entity_decode($cardapio->getDescricao()), 0, 200). "</td>
			 	<td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
			 	<td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cardapio-view.php?cod=".$cardapio->getCod_cardapio()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeCardapio(".$cardapio->getCod_cardapio().",'../".$cardapio->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i>Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de cardapio</h1>
			<tr>
	    		<th width='16%' style='text-align: center;'>Item</th>
	    		<th width='16%' style='text-align: center;'>Nome</th>
	    		<th width='16%' style='text-align: center;'>Descrição</th>
	    		<th width='16%' style='text-align: center;'>Categoria</th>
	    		<th width='16%' style='text-align: center;'>Situação</th>
	            <th width='16%' style='text-align: center;'>Editar</th>
	        </tr>
		<tbody>";
	
		foreach ($cardapios as &$cardapio) {
			echo "<tr name='resutaldo' id='status".$cardapio->getCod_cardapio()."'>
			 	<td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
			 	<td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
			 	<td style='text-align: center;' name='descricao'>".$cardapio->getDescricao()."</td>
			 	<td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
			 	<td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='cardapio-view.php?cod=".$cardapio->getCod_cardapio()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			</tr>";
		}
	}

echo "</tbody></table>";
?>
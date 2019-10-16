<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlCardapio.php";
include_once MODELPATH."/cardapio.php";

$_SESSION['permissaoPagina']=0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCardapio($_SG['link']);
if((isset($_POST['nome']) && 
!empty($_POST['nome'])) || 		//Descrição do item
isset($_POST['producao'])){		//Flag_servido

	$nome = $_POST['nome'];
	$flag_servindo = $_POST['producao'];
	$cardapios = $controle->filterProducao($nome, $flag_servindo);	//Filtra pela descrição/flag_servido
}else{
	//order by pos -> categoria/itens
	$cardapios = $controle->selectAllByPos();
}
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('cardapio', $permissao)){ 
	
		echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de cardapio</h1>
			<tr>
	    		<th width='14%' style='text-align: center;'>Item</th>
				<th width='14%' style='text-align: center;'>Nome</th>
				<th width='8%' style='text-align: center;'>Preço</th>
				<th width='8%' style='text-align: center;'>Desconto</th>
	    		<th width='14%' style='text-align: center;'>Descrição</th>
	    		<th width='8%' style='text-align: center;'>Categoria</th>
				<th width='8%' style='text-align: center;'>Situação</th>
				<th width='8%' style='text-align: center;'>Prioridade</th>
				<th width='8%' style='text-align: center;'>Delivery</th>
	            <th width='14%' style='text-align: center;'>Ação</th>
	        </tr>
		<tbody>";
	
		foreach ($cardapios as &$cardapio) {
			$mensagem='Cardápio excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$cardapio->getCod_cardapio()."'>
			 	<td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
				<td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
				<td style='text-align: center;' name='preco'>".$cardapio->getPreco()."</td>
				<td style='text-align: center;' name='desconto'>".$cardapio->getDesconto()."%</td>
			 	<td style='text-align: center;' name='descricao'>".substr(html_entity_decode($cardapio->getDescricao()), 0, 200). "</td>
			 	<td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
				<td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
				<td style='text-align: center;' name='prioridade'>".$cardapio->getDsPrioridade()."</td>
				<td style='text-align: center;' name='delivery'>".$cardapio->getDsDelivery()."</td>";

				if($cardapio->getFlag_servindo() == 1){

					echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-flagPausado.php?cod=".$cardapio->getCod_cardapio()."'><button type='button' class='btn btn-kionux'><i class='fa fa-pause'></i> Pausar Item</button></a></td>";
				
				}else{
					//Ativa o item
					echo "<td style='text-align: center;' name='status'><a href='../../ajax/alterar-flagAtivo.php?cod=".$cardapio->getCod_cardapio()."'><button type='button' class='btn btn-kionux' style='width: 107px'><i class='fa fa-play'></i> Ativar</button></a></td>";
	
				}

			 	// echo "<td style='text-align: center;' name='status'><button type='button' onclick=\"removeCardapio(".$cardapio->getCod_cardapio().",'../".$cardapio->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i> Pausar</button></td>
			echo "</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbCardapio' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de cardapio</h1>
			<tr>
	    		<th width='14%' style='text-align: center;'>Item</th>
				<th width='14%' style='text-align: center;'>Nome</th>
				<th width='14%' style='text-align: center;'>Preço</th>
	    		<th width='14%' style='text-align: center;'>Descrição</th>
	    		<th width='12%' style='text-align: center;'>Categoria</th>
				<th width='12%' style='text-align: center;'>Situação</th>
				<th width='12%' style='text-align: center;'>Prioridade</th>
				<th width='12%' style='text-align: center;'>Delivery</th>
	        </tr>
		<tbody>";
	
		foreach ($cardapios as &$cardapio) {
			echo "<tr name='resutaldo' id='status".$cardapio->getCod_cardapio()."'>
			 	<td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
				<td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
				<td style='text-align: center;' name='preco'>".$cardapio->getPreco()."</td>
			 	<td style='text-align: center;' name='descricao'>".substr(html_entity_decode($cardapio->getDescricao()), 0, 200)."</td>
			 	<td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
				<td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
				<td style='text-align: center;' name='prioridade'>".$cardapio->getDsPrioridade()."</td>
				<td style='text-align: center;' name='delivery'>".$cardapio->getDsDelivery()."</td>
			</tr>";
		}
	}

echo "</tbody></table>";
?>
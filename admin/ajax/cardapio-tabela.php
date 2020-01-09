<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlProduto.php";
include_once MODELPATH."/produto.php";

$_SESSION['permissaoPagina']=0;
protegePagina();
$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerProduto($_SG['link']);
if((isset($_POST['nome']) && 
!empty($_POST['nome'])) || 
isset($_POST['flag']) || 
isset($_POST['delivery']) || 
isset($_POST['producao']) || 
isset($_POST['prioridade']) || 
isset($_POST['categoria'])){

	$nome = $_POST['nome'];
	$flag_ativo= $_POST['flag'];
	$flag_servindo= $_POST['producao'];
	$delivery=$_POST['delivery'];
	$prioridade=$_POST['prioridade'];
	$categoria=$_POST['categoria'];
	$cardapios = $controle->filter($nome, $flag_ativo, $flag_servindo, $delivery, $prioridade, $categoria);
}else{
	$cardapios = $controle->selectAll();
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
				<th width='8%' style='text-align:center;'>Desconto</th>
	    		<th width='14%' style='text-align: center;'>Descrição</th>
	    		<th width='8%' style='text-align: center;'>Categoria</th>
				<th width='8%' style='text-align: center;'>Situação</th>
				<th width='8%' style='text-align: center;'>Prioridade</th>
				<th width='8%' style='text-align:center;'>Delivery</th>
	            <th width='14%' style='text-align: center;'>Editar</th>
	            <th width='14%' style='text-align: center;'>Apagar</th>
	        </tr>
		<tbody>";
	
		foreach ($cardapios as $cardapio) {
			$mensagem='Cardápio excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$cardapio->getPkId()."'>
			 	<td style='text-align: center;' name='cardapio'><img src='../../".$cardapio->getFoto()."' style='max-height: 100px' alt='' class='img-thumbnail'/></td>
				<td style='text-align: center;' name='nome'>".$cardapio->getNome()."</td>
				<td style='text-align: center;' name='preco'>".$cardapio->getPreco()."</td>
				<td style='text-align: center;' name='desconto'>".$cardapio->getDesconto()."%</td>
			 	<td style='text-align: center;' name='descricao'>".substr(html_entity_decode($cardapio->getDescricao()), 0, 200). "</td>
			 	<td style='text-align: center;' name='categoria'>".$cardapio->getCategoria()."</td>
				<td style='text-align: center;' name='flag_ativo'>".$cardapio->getDsAtivo()."</td>
				<td style='text-align: center;' name='prioridade'>".$cardapio->getDsPrioridade()."</td>
				<td style='text-align: center;' name='delivery'>".$cardapio->getDsDelivery()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='produto-view.php?cod=".$cardapio->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i> Editar</button></a></td>
			 	<td style='text-align: center;' name='status'><button type='button' onclick=\"removeCardapio(".$cardapio->getPkId().",'../".$cardapio->getFotoAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i> Desativar</button></td>
			</tr>";
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
			echo "<tr name='resutaldo' id='status".$cardapio->getPkId()."'>
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
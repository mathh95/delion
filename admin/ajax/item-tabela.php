<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCarrinho.php";
include_once MODELPATH."/usuario.php";
protegePagina();
$controle=new controlerCarrinho($_SG['link']);
$cod_pedido=$_GET['cod'];
$itens = $controle->selectItens($cod_pedido);
$permissao =  json_decode($usuarioPermissao->getPermissao());
if(in_array('pedido', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Itens</h1>
		<div class=\"pull-right\">
			<a href=\"pedidoWppLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
    		<th width='33%' style='text-align: center;'>Produto</th>
			<th width='33%' style='text-align: center;'>Quantidade</th>
			<th width='33%' style='text-align: center;'>Valor</th>
        </tr>
	<tbody>";
	foreach ($itens as &$item) {
			echo "
			<tr name='resultado' id='status".$item->getCod_item()."'>
			 	<td style='text-align: center;' name='data'>".$item->getProduto()."</td>
			 	<td style='text-align: center;' name='cliente'>".$item->getQuantidade()."</td>
				<td style='text-align: center;' name='valor'>".$item->preco."</td>
			</tr>";
	}
	echo "</tbody></table>";
}else if (in_array('pedidoWpp', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Itens</h1>
		<div class=\"pull-right\">
			<a href=\"pedidoWppLista.php\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
    		<th width='33%' style='text-align: center;'>Produto</th>
			<th width='33%' style='text-align: center;'>Quantidade</th>
			<th width='33%' style='text-align: center;'>Valor</th>
        </tr>
	<tbody>";
	foreach ($itens as &$item) {
			echo "
			<tr name='resultado' id='status".$item->getCod_item()."'>
			 	<td style='text-align: center;' name='data'>".$item->getProduto()."</td>
			 	<td style='text-align: center;' name='cliente'>".$item->getQuantidade()."</td>
				<td style='text-align: center;' name='valor'>".$item->preco."</td>
			</tr>";
	}
	echo "</tbody></table>";
}else{
	echo "	
	<div class=\"pull-right\">
		<a href=\"pedidoWppLista\" class=\"btn btn-kionux\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
	</div class=\"pull-right\">
	<h1 class\"page-header\" style=\"text-align:center;\">Não possui permissão</h1>";
}
?>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCarrinho.php";
include_once MODELPATH."/usuario.php";
protegePagina();

$controle=new controlerCarrinho($_SG['link']);

$pedidos = $controle->selectAllPedido();
$permissao =  json_decode($usuarioPermissao->getPermissao());	
if(in_array('pedido', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
    		<th width='20%' style='text-align: center;'>Data</th>
			<th width='15%' style='text-align: center;'>Nome do cliente</th>
			<th width='20%' style='text-align: center;'>Telefone do cliente</th>
			<th width='15%' style='text-align: center;'>Valor total</th>
			<th width='15%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Lista de itens</th>
        </tr>
	<tbody>";
	foreach ($pedidos as &$pedido) {
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido()."'>
			 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
			 	<td style='text-align: center;' name='cliente'>".$pedido->getCliente()."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getValor()."</td>
				<td style='text-align: center;' name='status'>
				<li class=\"dropdown\">
				<a href='\#' class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">" .$pedido->getStatus() . "<span class=\"caret\"></span></a>
				<ul class=\"dropdown-menu\">
					<li style='text-align: center;' onclick=\"alterarStatus(".$pedido->getCod_pedido().",2)\">2</li>
					<li style='text-align: center;' onclick=\"alterarStatus(".$pedido->getCod_pedido().",3)\">3</li>
				</ul>
			</li></td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='itemLista.php?cod=".$pedido->getCod_pedido()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Itens</button></a></td>
			</tr>";
	}
} else{
		echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
    		<th width='20%' style='text-align: center;'>Data</th>
			<th width='15%' style='text-align: center;'>Nome do cliente</th>
			<th width='20%' style='text-align: center;'>Telefone do cliente</th>
			<th width='15%' style='text-align: center;'>Valor total</th>
			<th width='15%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Lista de itens</th>
        </tr>
	<tbody>";
	foreach ($pedidos as &$pedido) {
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido()."'>
			 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
			 	<td style='text-align: center;' name='cliente'>".$pedido->getCliente()."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getValor()."</td>
				<td style='text-align: center;' name='status'>".$pedido->getStatus()."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='itemLista.php?cod=".$pedido->getCod_pedido()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Itens</button></a></td>
			</tr>";
	}
}
echo "</tbody></table>";

?>
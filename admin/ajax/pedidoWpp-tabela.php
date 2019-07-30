<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCarrinho.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCarrinho($_SG['link']);

if(isset($_POST['nome']) || isset($_POST['menor']) || isset($_POST['maior']) || isset($_POST['endereco'])){ 
	$nome = $_POST['nome'];
	$menor = $_POST['menor'];
	$maior = $_POST['maior'];
	if (!empty($_POST['endereco'])){
		$endereco = $_POST['endereco'];
		$pedidos = $controle->filterEndereco($nome, $menor, $maior, $endereco);
	}else{
		$pedidos = $controle->selectAllPedido($nome, $menor, $maior);
	}
}else{
	if (!isset($_POST['nome'])){
		$nome ='';
	}
	if (!isset($_POST['menor'])){
		$menor =0;
	}
	if (!isset($_POST['maior'])){
		$maior =999999;
	}
	$pedidos = $controle->selectAllPedido($nome, $menor, $maior);
}

$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($pedidos == -1){
	echo "<h1> SEM RESULTADOS</h1>";
}else{


if(in_array('pedidoWpp', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
    		<th width='8%' style='text-align: center;'>Data</th>
			<th width='10%' style='text-align: center;'>Nome do cliente</th>
			<th width='10%' style='text-align: center;'>Telefone do cliente</th>
			<th width='8%' style='text-align: center;'>Valor total</th>
			<th width='5%' style='text-align: center;'>Status</th>
			<th width='15%' style='text-align: center;'>Rua</th>
			<th width='8%' style='text-align: center;'>Número</th>
            <th width='8%' style='text-align: center;'>CEP</th>
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
				<td style='text-align: center;' name='rua'>".$pedido->rua."</td>
				<td style='text-align: center;' name='numero'>".$pedido->numero."</td>
				<td style='text-align: center;' name='cep'>".$pedido->cep."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='itemLista.php?cod=".$pedido->getCod_pedido()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Itens</button></a></td>
                <td style='text-align: center;' name='imprime'><a style='font-size: 20px;' onclick=\"alterarStatus(".$pedido->getCod_pedido().",2)\"><button class='btn btn-kionux'><i class='fa fa-print'></i>Imprimir</button></a></td>
                <td style='text-align: center;' name='delivery'><a style='font-size: 20px;' onclick=\"alterarStatus(".$pedido->getCod_pedido().",3)\"><button class='btn btn-kionux'><i class='fa fa-truck'></i>Delivery</button></a></td>
            </tr>";
	}
} else{
		echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
    		<th width='25%' style='text-align: center;'>Data</th>
			<th width='15%' style='text-align: center;'>Nome do cliente</th>
			<th width='30%' style='text-align: center;'>Telefone do cliente</th>
			<th width='15%' style='text-align: center;'>Valor total</th>
			<th width='15%' style='text-align: center;'>Status</th>
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
			</tr>";
	}
}
echo "</tbody></table>";
}
?>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."admin/controler/controlCarrinhoWpp.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCarrinhoWpp($_SG['link']);
$controle1 = new controlerCarrinhoWpp($_SG['link']);
$controle2 = new controlerCarrinhoWpp($_SG['link']);
$controle3 = new controlerCarrinhoWpp($_SG['link']);
$controle4 = new controlerCarrinhoWpp($_SG['link']);


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
			<th width='10%' style='text-align: center;'>Código Cupom</th>
			<th width='8%' style='text-align: center;'>Código</th>
			<th width='8%' style='text-align: center;'>Quantidade Inicial</th>
			<th width='10%' style='text-align: center;'>Quantidade Atual</th>
			<th width='10%' style='text-align: center;'>Valor</th>
			<th width='8%' style='text-align: center;'>Vencimento</th>
            <th width='15%' style='text-align: center;'>Status</th>
            <th width='15%' style='text-align: center;'>Editar</th>
            <th width='15%' style='text-align: center;'>Cancelar</th>
        </tr>
	<tbody>";
		foreach ($pedidos as &$pedido) {	//Alterar 
			
				if($pedido->getStatus()==1){
					$array = ($pedido->getCod_pedido_wpp());
				echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
					<td style='text-align: center;' name='cliente'>".$pedido->getCod_pedido_wpp()."</td>
					<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
					<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
					<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
					<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
					<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
                    <td style='text-align: center;' name='rua'>".$pedido->rua."</td>
                    <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoWpp-tabela.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	    <td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$pedido->getCod_pedido_wpp().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
					</tr>";
		}
	}	//Mudar o botao delivery e limitar as opções

			foreach ($pedidos as &$pedido) {
				if($pedido->getStatus()==2){	//Status = 2, então só as opções Itens/Delivery/Detalhes estão disponiveis
				
				$array = ($pedido->getCod_pedido_wpp());
				echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
					<td style='text-align: center;' name='cliente'>".$pedido->getCod_pedido_wpp()."</td>
					<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
					<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
					<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
					<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
					<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
                    <td style='text-align: center;' name='rua'>".$pedido->rua."</td>
                    <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoWpp-tabela.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	    <td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$pedido->getCod_pedido_wpp().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
					</tr>";
		}
	}	//Mudar o botao delivery e limitar as opções

		foreach ($pedidos as &$pedido) {
			if($pedido->getStatus()==3){	//Status = 3, então só as opções Itens/Detalhes estão disponiveis
				$array = ($pedido->getCod_pedido_wpp());
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
				<td style='text-align: center;' name='cliente'>".$pedido->getCod_pedido_wpp()."</td>
				<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
				<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
				<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
				<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
				<td style='text-align: center;' name='rua'>".$pedido->rua."</td>
				<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoWpp-tabela.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	    <td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$pedido->getCod_pedido_wpp().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
				</tr>";
		}
	}	//Mudar o botao delivery e limitar as opções



} else{
		echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
        <th width='10%' style='text-align: center;'>Código Cupom</th>
        <th width='8%' style='text-align: center;'>Código</th>
        <th width='8%' style='text-align: center;'>Quantidade Inicial</th>
        <th width='10%' style='text-align: center;'>Quantidade Atual</th>
        <th width='10%' style='text-align: center;'>Valor</th>
        <th width='8%' style='text-align: center;'>Vencimento</th>
        <th width='15%' style='text-align: center;'>Status</th>
        <th width='15%' style='text-align: center;'>Editar</th>
        <th width='15%' style='text-align: center;'>Cancelar</th>
        </tr>
	<tbody>";
	foreach ($pedidos as &$pedido) {
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
			 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
			 	<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
				<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
				<td style='text-align: center;' name='status'>".$pedido->getStatus()."</td>
			</tr>";
	}
}
			}

	echo "</tbody></table>";
	

?>
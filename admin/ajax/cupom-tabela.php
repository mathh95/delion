<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."admin/controler/controlCupom.php";
include_once MODELPATH."/cupom.php";
include_once CONTROLLERPATH."/controlUsuario.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlCupom($_SG['link']);

$cupons = $controle->selectAll();
echo "<pre>";
print_r($cupons);
echo "</pre>";


$permissao =  json_decode($usuarioPermissao->getPermissao());	
if ($cupons == -1){
	echo "<h1> SEM RESULTADOS</h1>";
}else{



if(in_array('cupomWpp', $permissao)){
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
		foreach ($cupons as &$cupom) {	//Alterar 
			
				if($cupom->getStatus()==1){
					$array = ($cupom->getCod_cupom());
				// echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
				// 	<td style='text-align: center;' name='cliente'>".$pedido->getCod_pedido_wpp()."</td>
				// 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
				// 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
				// 	<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
				// 	<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
				// 	<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
                //     <td style='text-align: center;' name='rua'>".$pedido->rua."</td>
                //     <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoWpp-tabela.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	//     <td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$pedido->getCod_pedido_wpp().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
				// 	</tr>";
		}
	}	//Mudar o botao delivery e limitar as opções

			foreach ($pedidos as &$pedido) {
				if($pedido->getStatus()==2){	//Status = 2, então só as opções Itens/Delivery/Detalhes estão disponiveis
				
				$array = ($pedido->getCod_pedido_wpp());
				// echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
				// 	<td style='text-align: center;' name='cliente'>".$pedido->getCod_pedido_wpp()."</td>
				// 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
				// 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
				// 	<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
				// 	<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
				// 	<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
                //     <td style='text-align: center;' name='rua'>".$pedido->rua."</td>
                //     <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoWpp-tabela.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			 	//     <td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$pedido->getCod_pedido_wpp().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
				// 	</tr>";
		}
	}	//Mudar o botao delivery e limitar as opções

		foreach ($pedidos as &$pedido) {
			if($pedido->getStatus()==3){	//Status = 3, então só as opções Itens/Detalhes estão disponiveis
				$array = ($pedido->getCod_pedido_wpp());
			// echo "<tr name='resultado' id='status".$pedido->getCod_pedido_wpp()."'>
			// 	<td style='text-align: center;' name='cliente'>".$pedido->getCod_pedido_wpp()."</td>
			// 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
			// 	<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
			// 	<td style='text-align: center;' name='cliente'>".$pedido->getCliente_wpp()."</td>
			// 	<td style='text-align: center;' name='telefone'>".$pedido->telefone."</td>
			// 	<td style='text-align: center;' name='valor'>"." R$ ".$pedido->getValor()."</td>
			// 	<td style='text-align: center;' name='rua'>".$pedido->rua."</td>
			// 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoWpp-tabela.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>Editar</button></a></td>
			//  	    <td style='text-align: center;' name='status' ><button type='button' onclick=\"removeCliente(".$pedido->getCod_pedido_wpp().");\" class='btn btn-kionux'><i class='fa fa-remove'></i>Cancelar</button></td>
			// 	</tr>";
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
	foreach ($cupons as &$cupom) {
		
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$cupom->getCod_cupom()."'>
			 	<td style='text-align: center;' name='data'>".$cupom->getCod_cupom()."</td>
			 	<td style='text-align: center;' name='cliente'>".$cupom->getCodigo()."</td>
				<td style='text-align: center;' name='telefone'>".$cupom->getQtde_incial()."</td>
				<td style='text-align: center;' name='telefone'>".$cupom->getQtde_anual()."</td>
				<td style='text-align: center;' name='valor'>"." R$ ".$cupom->getValor()."</td>
				<td style='text-align: center;' name='valor'>".$cupom->getVencimento()."</td>
				<td style='text-align: center;' name='status'>".$cupom->getStatus()."</td>
			</tr>";
	}
}
			}

	echo "</tbody></table>";
	

?>
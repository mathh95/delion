
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlPedidoFornecedor.php";
include_once MODELPATH."/pedidoFornecedor.php";
protegePagina();

$controle=new controlerPedidoFornecedor($_SG['link']);
$pedidoFornecedores = $controle->selectAllByPos();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('gerenciar_forncededor', $permissao)){
	
		echo "<table class='table table-responsive' id='tbPedidoFornecedor' style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de pedidos p/ fornecedor</h1>
			<tr>
	    		<th width='25%' style='text-align: center;'>Tipo</th>
                <th width='25%' style='text-align: center;'>Valor</th>
                <th width='25%' style='text-align: center;'>Forma de Pagamento</th>
                <th width='25%' style='text-align: center;'>Descrição (Opcional)</th>
                <th width='25%' style='text-align: center;'>Data do Pedido</th>
	            <th width='25%' style='text-align: center;'>Editar</th>
	            <th width='25%' style='text-align: center;'>Apagar</th>
	        </tr>
		<tbody>";
	
		foreach ($pedidoFornecedores as &$pedidoFornecedor) {
			$mensagem='fornecedor excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$pedidoFornecedor->getPkId()."'>
				<td style='text-align: center;' name='tipo'>".$pedidoFornecedor->getTipoFornecedor()."</td>
                <td style='text-align: center;' name='valor'>".$pedidoFornecedor->getValor()."</td>
                <td style='text-align: center;' name='formaPgt'>".$pedidoFornecedor->getFormaPgt()."</td>
                <td style='text-align: center;' name='descricao'>".$pedidoFornecedor->getDescricao()."</td>
                <td style='text-align: center;' name='qtddias'>".$pedidoFornecedor->getDataPedido()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoFornecedor-view.php?cod=".$pedidoFornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
			 	<td style='text-align: center;' name='status'  ><button type='button' onclick=\"removeFornecedor(".$pedidoFornecedor->getPkId().",'../".$pedidoFornecedor->getIconeAbsoluto()."');\" class='btn btn-kionux'><i class='fa fa-remove'></i>&nbsp;Excluir</button></td>
			</tr>";
		}
	}else{
		echo "<table class='table table-responsive' id='tbPedidoFornecedor style='text-align = center;'>
		<thead>
			<h1 class=\"page-header\">Lista de pedidos p/ fornecedor</h1>
			<tr>
                <th width='25%' style='text-align: center;'>Tipo</th>
                <th width='25%' style='text-align: center;'>Valor</th>
                <th width='25%' style='text-align: center;'>Forma de Pagamento</th>
                <th width='25%' style='text-align: center;'>Descrição (Opcional)</th>
                <th width='25%' style='text-align: center;'>Data do Pedido</th>
                <th width='25%' style='text-align: center;'>Editar</th>
	        </tr>
		<tbody>";
	
		foreach ($pedidoFornecedores as &$pedidoFornecedor) {
			echo "<tr name='resutaldo' id='status".$pedidoFornecedor->getPkId()."'>
            <td style='text-align: center;' name='tipo'>".$pedidoFornecedor->getTipoFornecedor()."</td>
            <td style='text-align: center;' name='valor'>".$pedidoFornecedor->getValor()."</td>
            <td style='text-align: center;' name='formaPgt'>".$pedidoFornecedor->getFormaPgt()."</td>
            <td style='text-align: center;' name='descricao'>".$pedidoFornecedor->getDescricao()."</td>
            <td style='text-align: center;' name='qtddias'>".$pedidoFornecedor->getDataPedido()."</td>
             <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='fornecedor-view.php?cod=".$pedidoFornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
        </tr>";
		}
	}

echo "</tbody></table>";
?>

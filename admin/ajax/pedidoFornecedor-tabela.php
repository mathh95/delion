
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once CONTROLLERPATH."/controlPedidoFornecedor.php";
include_once MODELPATH."/pedido_fornecedor.php";
include_once CONTROLLERPATH."/controlTipoFornecedor.php";
include_once MODELPATH."/tipo_fornecedor.php";
protegePagina();

$controltipoFornecedor = new controlerTipoFornecedor($_SG['link']);
$tipo_fornecedores = $controltipoFornecedor->selectAll();
$controle=new controlerPedidoFornecedor($_SG['link']);
$pedidoFornecedores = $controle->selectAll();
	$permissao =  json_decode($usuarioPermissao->getPermissao());
	if(in_array('gerenciar_fornecededor', $permissao)){
	
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
	        </tr>
		<tbody>";
	
		foreach ($pedidoFornecedores as &$pedidoFornecedor) {
			$mensagem='fornecedor excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resutaldo' id='status".$pedidoFornecedor->getPkId()."'>

				<td style='text-align: center;' name='tipo'>".$pedidoFornecedor->getFkFornecedor()."</td>

				
                <td style='text-align: center;' name='valor'>".$pedidoFornecedor->getValor()."</td>
                <td style='text-align: center;' name='formaPgt'>".$pedidoFornecedor->getFormaPgt()."</td>
                <td style='text-align: center;' name='descricao'>".$pedidoFornecedor->getDesc()."</td>
                <td style='text-align: center;' name='qtddias'>".$pedidoFornecedor->getDtPedido()."</td>
			 	<td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoFornecedor-view.php?cod=".$pedidoFornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
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
            <td style='text-align: center;' name='tipo'>".$pedidoFornecedor->getFkFornecedor()."</td>
            <td style='text-align: center;' name='valor'>".$pedidoFornecedor->getValor()."</td>
            <td style='text-align: center;' name='formaPgt'>".$pedidoFornecedor->getFormaPgt()."</td>
            <td style='text-align: center;' name='descricao'>".substr(html_entity_decode($pedidoFornecedor->getDesc()), 0, 200)."</td>
            <td style='text-align: center;' name='qtddias'>".date('d/m/Y', strtotime($pedidoFornecedor->getDtPedido()))."</td>
             <td style='text-align: center;' name='editar'><a style='font-size: 20px;' href='pedidoFornecedor-view.php?cod=".$pedidoFornecedor->getPkId()."'><button class='btn btn-kionux'><i class='fa fa-edit'></i>&nbsp;Editar</button></a></td>
        </tr>";
		}
	}

echo "</tbody></table>";
?>

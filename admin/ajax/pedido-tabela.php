<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCarrinho.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH. "/controlFormaPgt.php";
include_once MODELPATH. "/formaPgt.php";
protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$controle=new controlerCarrinho($_SG['link']);
$controle1 = new controlerCarrinho($_SG['link']);
$controlFormaPgt = new controlerFormaPgt($_SG['link']);


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


if(in_array('pedido', $permissao)){
	echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
    		<th width='8%' style='text-align: center;'>Código Pedido</th>
			<th width='10%' style='text-align: center;'>Data</th>
			<th width='10%' style='text-align: center;'>Hora Pedido</th>
			<th width='8%' style='text-align: center;'>Nome Cliente</th>
			<th width='5%' style='text-align: center;'>Valor Total</th>
			<th width='8%' style='text-align: center;'>Origem do Pedido</th>
			<th width='15%' style='text-align: center;'>Local Entrega</th>
        </tr>
	<tbody>";
	//Pedido com status = 1, não foi impresso nem saiu para entrega
	foreach ($pedidos as &$pedido) {

		if($pedido->getStatus()==1){

			$array = ($pedido->getCod_pedido());
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido()."'>
			 	<td style='text-align: center;' name='data'>".$pedido->getCod_pedido()."</td>
			 	<td style='text-align: center;' name='cliente'>".$pedido->getData()->format('d/m/Y')."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->getData()->format('H:i')."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getCliente()."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getValor()."</td>
				<td style='text-align: center;' name='numero'>".$pedido->getOrigem()."</td>";

				if($pedido->rua == NULL){
					echo "<td style='text-align: center;' name='rua'>Balcão</td>";
				}else{
					echo "<td style='text-align: center;' name='rua'>".$pedido->rua." - ".$pedido->numero."</td>";
				}
				
				echo "<div id='buttonbar'>
					<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button class='btn btn-primary' data-toggle='modal' data-target='#modalPedido".$pedido->getCod_pedido()."' data-id='".$pedido->getCod_pedido()."'><i class='fa fa-print'></i> Imprimir</button></a></td>";

				if($pedido->rua == NULL){	
					echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"erroDelivery(".$pedido->getStatus().")\" class='btn btn-danger' disable><i class='fas fa-store'></i> Retirado</button></a></td>";
				}else{
					echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"erroDelivery(".$pedido->getStatus().")\" class='btn btn-danger' disable><i class='fa fa-truck'></i> Delivery</button></a></td>";
				}
				
				echo "<td style='text-align: center;' name='editar'>
								<a style='font-size: 10px;'>
									<div type='button' class='popup btn btn-primary' onmouseover='myFunction(".$array.")' onmouseout='myFunction(".$array.")'>
									<i class='fa fa-edit'></i> Detalhes
										<span class='popuptext' id='myPopup".$array."'>
												<table class=''>
													<tbody>";
													$itens = $controle1->selectItens($pedido->getCod_pedido());
													foreach($itens as $item){
													echo " <tr name='resultado' id='status".$item->getCod_item()."'>	
															<td id='detalhes'>".$item->getQuantidade()."x</td>
															<td id='detalhes'> ".$item->getProduto()."</td>
															<td id='detalhes'>"."R$ ".$item->preco."</td>
														</tr>";
													}
												echo "
												</tbody>
											</table>
										</span>
									</div>
								</a>
							</td>
				</div>
				</tr>";
		}
	}

	//Pedido com status = 2, pedido impresso mas não saiu para entrega
	foreach ($pedidos as &$pedido) {

		if($pedido->getStatus()==2){

			$array = ($pedido->getCod_pedido());
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido()."'>
			 	<td style='text-align: center;' name='data'>".$pedido->getCod_pedido()."</td>
			 	<td style='text-align: center;' name='cliente'>".$pedido->getData()->format('d/m/Y')."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->getData()->format('H:i')."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getCliente()."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getValor()."</td>
				<td style='text-align: center;' name='numero'>".$pedido->getOrigem()."</td>";
				
				if($pedido->rua == NULL){
					echo "<td style='text-align: center;' name='rua'>Balcão</td>";
				}else{
					echo "<td style='text-align: center;' name='rua'>".$pedido->rua." - ".$pedido->numero."</td>";
				}

				echo "<div id='buttonbar'>
					<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button class='btn btn-warning' data-toggle='modal' data-target='#modalPedido".$pedido->getCod_pedido()."' data-id='".$pedido->getCod_pedido()."'><i class='fa fa-print'></i> Imprimir</button></a></td>";

					if($pedido->rua == NULL){	
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"alterarStatusDelivery(".$pedido->getCod_pedido().",3)\" class='btn btn-danger' disable><i class='fas fa-store'></i> Retirado</button></a></td>";
					}else{
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"alterarStatusDelivery(".$pedido->getCod_pedido().",3)\" class='btn btn-danger' disable><i class='fa fa-truck'></i> Delivery</button></a></td>";
					}

					echo "<td style='text-align: center;' name='editar'>
								<a style='font-size: 10px;' ' href='descPage.php?cod=".$pedido->getCod_pedido()."'>
									<div type='button' class='popup btn btn-primary' onmouseover='myFunction(".$array.")' onmouseout='myFunction(".$array.")'>
									<i class='fa fa-edit'></i> Detalhes
										<span class='popuptext' id='myPopup".$array."'>
												<table class=''>
													<tbody>";
													$itens = $controle1->selectItens($pedido->getCod_pedido());
													foreach($itens as $item){
													echo " <tr name='resultado' id='status".$item->getCod_item()."'>	
															<td id='detalhes'>".$item->getQuantidade()."x</td>
															<td id='detalhes'> ".$item->getProduto()."</td>
															<td id='detalhes'>"."R$ ".$item->preco."</td>
														</tr>";
													}
												echo "
												</tbody>
											</table>
										</span>
									</div>
								</a>
							</td>
				</div>
				</tr>";
		}
	}

	//Pedido com status = 3, pedido impresso e saiu para entrega
	foreach ($pedidos as &$pedido) {

		if($pedido->getStatus()==3){

			$array = ($pedido->getCod_pedido());
			$mensagem='Cliente excluído com sucesso!';
			$titulo='Excluir';
			echo "<tr name='resultado' id='status".$pedido->getCod_pedido()."'>
			 	<td style='text-align: center;' name='data'>".$pedido->getCod_pedido()."</td>
			 	<td style='text-align: center;' name='cliente'>".$pedido->getData()->format('d/m/Y')."</td>
				<td style='text-align: center;' name='telefone'>".$pedido->getData()->format('H:i')."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getCliente()."</td>
				<td style='text-align: center;' name='valor'>".$pedido->getValor()."</td>
				<td style='text-align: center;' name='numero'>".$pedido->getOrigem()."</td>";

				if($pedido->rua == NULL){
					echo "<td style='text-align: center;' name='rua'>Balcão</td>";
				}else{
					echo "<td style='text-align: center;' name='rua'>".$pedido->rua." - ".$pedido->numero."</td>";
				}

				echo "<div id='buttonbar'>
					<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button onclick=\"erroDelivery(3,".$pedido->getStatus().")\" class='btn btn-danger' data-toggle='modal' data-target='#modalPedido".$pedido->getCod_pedido()."' data-id='".$pedido->getCod_pedido()."'><i class='fa fa-print'></i> Imprimir</button></a></td>";

					if($pedido->rua == NULL){	
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"erroDelivery(3,".$pedido->getStatus().")\" class='btn btn-danger' disable><i class='fas fa-store'></i> Retirado</button></a></td>";
					}else{
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"erroDelivery(3,".$pedido->getStatus().")\" class='btn btn-danger' disable><i class='fa fa-truck'></i> Delivery</button></a></td>";
					}					
					echo "<td style='text-align: center;' name='editar'>
								<a style='font-size: 10px;' >
									<div type='button' class='popup btn btn-primary' onmouseover='myFunction(".$array.")' onmouseout='myFunction(".$array.") ' href='descPage.php?cod=".$pedido->getCod_pedido()."'>
									<i class='fa fa-edit'></i> Detalhes
										<span class='popuptext' id='myPopup".$array."'>
												<table class=''>
													<tbody>";
													$itens = $controle1->selectItens($pedido->getCod_pedido());
													foreach($itens as $item){
													echo " <tr name='resultado' id='status".$item->getCod_item()."'>	
															<td id='detalhes'>".$item->getQuantidade()."x</td>
															<td id='detalhes'> ".$item->getProduto()."</td>
															<td id='detalhes'>"."R$ ".$item->preco."</td>
														</tr>";
													}
												echo "
												</tbody>
											</table>
										</span>
									</div>
								</a>
							</td>
				</div>
				</tr>";
		}
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

}

foreach ($pedidos as &$pedido) {

	$entrega = date('H:i', strtotime($pedido->getData()->format('H:i')." +30 minutes"));
	$itens = $controle->selectItens($pedido->getCod_pedido());
	$formaPgt = $controlFormaPgt->selectId($pedido->getFormaPgt());
	$formaPgtVerify = $controlFormaPgt->selectId($pedido->getFormaPgt());

	//  var_dump($formaPgt->getCod_formaPgt());

	$formaPgtDin = "Dinheiro";	//quando o cod da forma de pagamento for igual a zero


	if($pedido->getStatus()==1 || $pedido->getStatus()==2){
	$array = ($pedido->getCod_pedido());
	
	echo " <div class=\"modal fade\" id='modalPedido".$pedido->getCod_pedido()."' tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\">

			<div class=\"modal-dialog\" role=\"document\">
			<div class=\"modal-content\">
			<div class\"modal-header\">
				<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
				<br><h4 class=\"modal-title\" id=\"exampleModalLabel\" style=\"text-align:center\">Dados para Impressão</h4>
			</div>
			<div class=\"modal-body\" style=\"text-align:center\" id='divPrin".$array."'>
				<form>";

				echo "<div class=\"form-group\">
						<label for=\"recipient-name\" class=\"control-label\">----------------------------------</label>
						<br><label for=\"recipient-name\" class=\"control-label\">Restaurante: DELION.O </label>
							<br><label for=\"message-text\" class=\"control-label\">"."Data: ".$pedido->getData()->format('d/m/Y')." ".$pedido->getData()->format('H:i')."</label>
							<br><label for=\"message-text\" class=\"control-label\">"."Previsao de Entrega: ".$entrega."</label>
							<br><label for=\"recipient-name\" class=\"control-label\">"." Cliente: ".$pedido->getCliente()."</label>
							<br><label for=\"recipient-name\" class=\"control-label\">"." Telefone: ".$pedido->telefone."</label>
							<br><label for=\"recipient-name\" class=\"control-label\">"." Endereço: ".$pedido->rua.", ".$pedido->numero."</label>";

							if($formaPgt->getCod_formaPgt() == NULL){
							echo "<br><label for=\"recipient-name\" class=\"control-label\">"." Forma Pagamento: ".$formaPgtDin."</label>";
							}else{
								echo "<br><label for=\"recipient-name\" class=\"control-label\">"." Forma Pagamento: ".$formaPgt->getTipoFormaPgt()."</label>";
							}

						echo "</div>
						<div class=\"form-group\">
							<br><br>
						</div>
						<div class=\"form-group\">
							<label for=\"recipient-name\" class=\"control-label\">Itens do pedido:</label><br>
							<label for=\"recipient-name\" class=\"control-label\">Qtd &nbsp&nbsp  Item &nbsp&nbsp&nbsp&nbsp&nbsp  Preço</label><br><br>";
						foreach($itens as &$item){
							
							echo "
								<label for=\"recipient-name\" class=\"control-label\">"." ".$item->getQuantidade()."</label>
								<label for=\"recipient-name\" class=\"control-label\">"." - ".$item->getProduto()."</label>
								<label for=\"recipient-name\" class=\"control-label\">"." -         R$".$item->preco."</label>
								<br>";
							}
						
					echo "</div>
					
						<div class=\"form-group\">
							<label for=\"recipient-name\" class=\"control-label\">----------------------------------</label>
							<br><label for=\"recipient-name\" class=\"control-label\">"."|&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspValor Total: R$ ".$pedido->getValor()."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|</label>
							<br><label for=\"recipient-name\" class=\"control-label\">----------------------------------</label>
						</div>
					</form>
					
				</div>
					<div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fechar</button>
						<button type=\"button\" class=\"btn btn-default\" onclick=\"printDiv('#divPrin".$array."'); alteraStatusPrintModel(".$array.",2);\">Impressão</button>
					</div>
			</div>
		</div>
		</div>";
	}
	}

echo "</tbody></table>";
?>
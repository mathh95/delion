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
		<div class=\"pull-right\">
			<a href=\"pedidoWpp.php\" class=\"btn btn-primary\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
		</div class=\"pull-right\">
		<tr>
			<th width='10%' style='text-align: center;'>Código Pedido</th>
			<th width='8%' style='text-align: center;'>Data</th>
			<th width='8%' style='text-align: center;'>Hora Pedido</th>
			<th width='10%' style='text-align: center;'>Nome do cliente</th>
			<th width='10%' style='text-align: center;'>Telefone do cliente</th>
			<th width='8%' style='text-align: center;'>Valor total</th>
			<th width='15%' style='text-align: center;'>Rua</th>
			<th width='8%' style='text-align: center;'>Número</th>
        </tr>
	<tbody>";
		foreach ($pedidos as &$pedido) {	//Status = 1, então só as opções Itens/Impressão/Detalhes estão disponiveis
			
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
					<td style='text-align: center;' name='numero'>".$pedido->numero."</td>
						<td style='text-align: center;' name='editar'>
							<a style='font-size: 10px;'>
							
								<div type='button' class='popup btn btn-primary' onmouseover='myFunction(".$array.")' onmouseout='myFunction(".$array.")'>
								<i class='fa fa-edit'></i>Itens
									<span class='popuptext' id='myPopup".$array."'>
											<table class=''>
												<tbody>";
												$itens = $controle1->selectItens($pedido->getCod_pedido_wpp());
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
					<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button class='btn btn-primary' data-toggle='modal' data-target='#modalPedido".$pedido->getCod_pedido_wpp()."' data-id='".$pedido->getCod_pedido_wpp()."'><i class='fa fa-print'></i>Imprimir</button></a></td>
					<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"erroDelivery(".$pedido->getStatus().")\" class='btn btn-danger' disable><i class='fa fa-truck'></i>Delivery</button></a></td>
					<td style='text-align: center;' name='detalhes'><a style='font-size: 10px;' ' href='descPage.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-primary'><i class='fa fa-info'></i>Detalhes</button></a></td>
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
					<td style='text-align: center;' name='numero'>".$pedido->numero."</td>
					<td style='text-align: center;' name='editar'>
						<a style='font-size: 10px;'>
					
						<div type='button' class='popup btn btn-primary' onmouseover='myFunction(".$array.")' onmouseout='myFunction(".$array.")'>
						<i class='fa fa-edit'></i>Itens
							<span class='popuptext' id='myPopup".$array."'>
									<table class=''>
										<tbody>";
										$itens = $controle2->selectItens($pedido->getCod_pedido_wpp());
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
					<td style='text-align: center;' name='imprime'><a style='font-size: 10px;' ><button class='btn btn-danger'><i class='fa fa-print' disable></i>Imprimir</button></a></td>
					<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"alterarStatusDelivery(".$pedido->getCod_pedido_wpp().",3)\" class='btn btn-primary'><i class='fa fa-truck'></i>Delivery</button></a></td>
					<td style='text-align: center;' name='detalhes'><a style='font-size: 10px;' ' href='descPage.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-primary'><i class='fa fa-info'></i>Detalhes</button></a></td>
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
				<td style='text-align: center;' name='numero'>".$pedido->numero."</td>
				<td style='text-align: center;' name='editar'>
						<a style='font-size: 10px;'>
						<div type='button' class='popup btn btn-primary' onmouseover='myFunction(".$array.")' onmouseout='myFunction(".$array.")'>
						<i class='fa fa-edit'></i>Itens
							<span class='popuptext' id='myPopup".$array."'>
									<table class=''>
										<tbody>";
										$itens = $controle3->selectItens($pedido->getCod_pedido_wpp());
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
				<td style='text-align: center;' name='imprime'><a style='font-size: 10px;' ><button class='btn btn-danger'><i class='fa fa-print'></i>Imprimir</button></a></td>
				<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick=\"erroDelivery(".$pedido->getStatus().")\" class='btn btn-danger'><i class='fa fa-truck'></i>Delivery</button></a></td>
				<td style='text-align: center;' name='detalhes'><a style='font-size: 10px;' ' href='descPage.php?cod=".$pedido->getCod_pedido_wpp()."'><button class='btn btn-primary'><i class='fa fa-info'></i>Detalhes</button></a></td>
				</tr>";
		}
	}	//Mudar o botao delivery e limitar as opções



} else{
		echo "<table class='table' id='tbUsuarios' style='text-align = center;'>
	<thead>
		<h1 class=\"page-header\">Lista de Pedidos</h1>
		<tr>
			<th width='10%' style='text-align: center;'>Código Pedido</th>
			<th width='25%' style='text-align: center;'>Data</th>
			<th width='8%' style='text-align: center;'>Hora Pedido</th>
			<th width='15%' style='text-align: center;'>Nome do cliente</th>
			<th width='30%' style='text-align: center;'>Telefone do cliente</th>
			<th width='15%' style='text-align: center;'>Valor total</th>
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

			foreach ($pedidos as &$pedido) {

				$entrega = date('H:i', strtotime($pedido->getData()->format('H:i')." +30 minutes"));
				$itens = $controle->selectItens($pedido->getCod_pedido_wpp());
<<<<<<< HEAD

				if($pedido->getStatus()){
				
=======
				if($pedido->getStatus()==1){
				$array = ($pedido->getCod_pedido_wpp());
>>>>>>> b31df5cadb076ed3e947cae398bbe3152c28279a
				echo " <div class=\"modal fade\" id='modalPedido".$pedido->getCod_pedido_wpp()."' tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\">

						<div class=\"modal-dialog\" role=\"document\">
						<div class=\"modal-content\">
						<div class\"modal-header\">
							<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
							<br><h4 class=\"modal-title\" id=\"exampleModalLabel\" style=\"text-align:center\">Dados para Impressão</h4>
						</div>
<<<<<<< HEAD
						<div class=\"modal-body\" style=\"text-align:center\" id='divPrint".$pedido->getCod_pedido_wpp()."'>
							<form>";
							
=======
						<div class=\"modal-body\" style=\"text-align:center\" id='divPrin".$array."'>
							<form>";

>>>>>>> b31df5cadb076ed3e947cae398bbe3152c28279a
							echo "<div class=\"form-group\">
									<label for=\"recipient-name\" class=\"control-label\">----------------------------------</label>
									<br><label for=\"recipient-name\" class=\"control-label\">Restaurante: DELION.O </label>
										<br><label for=\"message-text\" class=\"control-label\">"."Data: ".$pedido->getData()->format('d/m/Y')." ".$pedido->getData()->format('H:i')."</label>
										<br><label for=\"message-text\" class=\"control-label\">"."Previsao de Entrega: ".$entrega."</label>
										<br><label for=\"recipient-name\" class=\"control-label\">"." Cliente: ".$pedido->getCliente_wpp()."</label>
										<br><label for=\"recipient-name\" class=\"control-label\">"." Telefone: ".$pedido->telefone."</label>
										<br><label for=\"recipient-name\" class=\"control-label\">"." Endereço: ".$pedido->rua.", ".$pedido->numero."</label>
										<br><label for=\"recipient-name\" class=\"control-label\">"." Bairro: ".$pedido->bairro."</label>
									</div>
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
<<<<<<< HEAD
                					<button type=\"button\" class=\"btn btn-default\" onclick=\"printDiv('#divPrint');\">Impressão</button>
=======
                					<button type=\"button\" class=\"btn btn-default\" onclick=\"printDiv('#divPrin".$array."'); alteraStatusPrintModel(".$array.",2);\">Impressão</button>
>>>>>>> b31df5cadb076ed3e947cae398bbe3152c28279a
            					</div>
            			</div>
					</div>
					</div>";
				}
				}
			}

	echo "</tbody></table>";
	

?>
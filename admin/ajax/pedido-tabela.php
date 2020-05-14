<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
include_once CONTROLLERPATH."/seguranca.php";
include_once HOMEPATH."home/controler/controlCarrinho.php";
include_once MODELPATH."/usuario.php";
include_once CONTROLLERPATH."/controlUsuario.php";
include_once CONTROLLERPATH. "/controlFormaPgt.php";
include_once MODELPATH. "/forma_pgto.php";
include_once HELPERPATH."/mask.php";

$mask = new Mask;

protegePagina();

$controleUsuario = new controlerUsuario($_SG['link']);
$usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

$control_carrinho = new controlerCarrinho($_SG['link']);
$controlFormaPgt = new controlerFormaPgt($_SG['link']);


if(isset($_POST['nome']) || isset($_POST['menor']) || isset($_POST['maior']) || isset($_POST['endereco'])){

	$nome_cliente = $_POST['nome'];
	$menor = $_POST['menor'];
	$maior = $_POST['maior'];

	if (!empty($_POST['endereco'])){
		$endereco = $_POST['endereco'];
		$pedidos = $control_carrinho->filterEndereco($nome_cliente, $menor, $maior, $endereco);
	}else{
		//Alterar esse query
		$pedidos = $control_carrinho->filter($nome_cliente, $menor, $maior);
	}

	//Paginacao
	$por_pagina = 15;
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$pagina = (int)$_GET['page'];
	}else{
		$pagina = 1;
	}

	$offset = ($pagina - 1) * $por_pagina;
	//Separa os pedidos pelas páginas
	// $pedidos = $control_carrinho->selectPaginadoPedidos($offset,$por_pagina);
	// $total2 = count($pedidosCount);

	if($pedidos != -1){
		$total = count($pedidos);	
		$paginas = ceil($total/$por_pagina);
	}else{
		$paginas = 1;
	}


//Sem Filtro
}else{

	if (!isset($_POST['nome'])) $nome = '';
	if (!isset($_POST['menor'])) $menor = 0;
	if (!isset($_POST['maior'])) $maior = 999999;

	$pedidosCount = $control_carrinho->selectAllPedido($nome, $menor, $maior);
	//numero de pedidos por página
	$por_pagina = 15;

	if(isset($_GET['page']) && !empty($_GET['page'])){
		$pagina = (int)$_GET['page'];
	}else{
		$pagina = 1;
	}

	$offset = ($pagina - 1) * $por_pagina;
	//Separa os pedidos pelas páginas
	$pedidos = $control_carrinho->selectPaginadoPedidos($offset,$por_pagina);

	$total2 = count($pedidosCount);
	$total = count($pedidos);
	$paginas = ceil($total2/$por_pagina);

}



$permissao =  json_decode($usuarioPermissao->getPermissao());	

if ($pedidos == -1){

	echo "<h1> SEM RESULTADOS</h1>";

}else{

	if(in_array('pedido', $permissao)){

		if($pagina > 1){
			echo
			"<nav arial-label='' style='text-align:center!important;' >
				<ul class='pagination'>
					<li>
						<a class='page-link' href='pedidoLista.php?page=".($pagina - 1)."' class='controle'>&laquo; Anterior</a>
					</li>";
		}
		
		if($pagina == 1){
			echo 
			"<nav arial-label='' style='text-align:center!important;'>
				<ul class='pagination'>
					<li class='page-item active'>
						<a class='page-link' href='pedidoLista.php?page=".($pagina)."' style='
						color: #f5f5f5;
						background: #ee6917;
						border-color: #ee6917;' 
						class='controle'>1</a>
					</li>";
		}else{
			echo "
			<li>
				<a class='page-link' href='pedidoLista.php?page=1' class='controle'>1</a>
			</li>";
		}

		for($i = 2; $i < $paginas + 1; $i++) {

			$ativo = ($i == $pagina) ? 'numativo' : '';

			if($i == $pagina){
				echo
				"<li class='page-item active'>	
					<a class='page-link' href='pedidoLista.php?page=".$i."' style='
					color: #f5f5f5;
					background: #ee6917;
					border-color: #ee6917;'
					class='numero ".$ativo."'> ".$i." </a>
				</li>";
			}else{
				echo
				"<li class='page-item'>
					<a class='page-link' href='pedidoLista.php?page=".$i."' class='numero ".$ativo."'> ".$i." </a>
				</li>";
			}
		}
					
		if($pagina < $paginas) {
			echo "
				<li class='page-item'>
					<a class='page-link' href='pedidoLista.php?page=".($pagina + 1)."' class='controle'>Proximo &raquo;</a>
				</li>
			</ul>";
		}

		echo "</ul></nav>";


		echo
		"<div class='table-responsive'>
			<table class='table table-hover' id='tbUsuarios' style='text-align = center;'>
			<thead>
			<th width='5%' style='text-align: center;'>Código Pedido</th>
			<th width='10%' style='text-align: center;'>Data</th>
			<th width='5%' style='text-align: center;'>Hora Pedido</th'>
			<th width='10%' style='text-align: center;'>Nome Cliente</th>
			<th width='7%' style='text-align: center;'>Valor Total</th>
			<th width='20%' style='text-align: center;'>Local Entrega</th>
			<th width='15%' style='text-align: center;' colspan='3'>Operações</th>
		</thead>
		<tbody>";
		

		foreach ($pedidos as $pedido) {
			
				// var_dump($pedido);
				// exit;


			$array = $pedido->getPkId();

			echo 
			"<tr name='resultado' id='status".$pedido->getPkId()."' 							data-cod_pedido='".$pedido->getPkId()."'>

				<td style='text-align: center;' name='cod_pedido'>".$pedido->getPkId()."</td>

				<td style='text-align: center;' name='cliente'>".$pedido->getData()->format('d/m/Y')."</td>

				<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."</td>
				<td style='text-align: center;' name='cliente'>".$pedido->getCliente()."</td>

				<td style='text-align: center;' name='valor'>R$ ".$pedido->getTotal()."</td>";


				if($pedido->rua == NULL){
					echo "<td style='text-align: center;' name='rua'>Balcão</td>";
				}else{
					echo "<td style='text-align: center;' name='rua'>".$pedido->rua.", ".$pedido->numero." - ".$pedido->bairro."</td>";
				}
				
				//Não foi impresso nem saiu para entrega
				if($pedido->getStatus()==1){

					echo 
					"<div id='buttonbar'>
						<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button class='btn btn-primary' data-toggle='modal' data-target='#modalPedido".$pedido->getPkId()."' data-id='".$pedido->getPkId()."'><i class='fa fa-print'></i> Imprimir</button></a></td>";

					if($pedido->rua == NULL){	
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick='erroDelivery(".$pedido->getStatus().")' class='btn btn-danger' disable><i class='fas fa-store'></i> Retirado</button></a></td>";
					}else{
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick='erroDelivery(".$pedido->getStatus().")' class='btn btn-danger' disable><i class='fa fa-truck'></i> Delivery</button></a></td>";
					}


				//Pedido impresso mas não saiu para entrega
				}elseif($pedido->getStatus() == 2){

					echo
					"<div id='buttonbar'>
						<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button class='btn btn-warning' data-toggle='modal' data-target='#modalPedido".$pedido->getPkId()."' data-id='".$pedido->getPkId()."'><i class='fa fa-print'></i> Imprimir</button></a></td>";

					if($pedido->rua == NULL){	
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick='alterarStatusRetirado(".$pedido->getPkId().",3)' class='btn btn-primary' disable><i class='fas fa-store'></i> Retirado</button></a></td>";
					}else{
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick='alterarStatusDelivery(".$pedido->getPkId().",3)' class='btn btn-primary' disable><i class='fa fa-truck'></i> Delivery</button></a></td>";
					}


				//Pedido impresso e saiu para entrega
				}elseif($pedido->getStatus() == 3){

					echo
					"<div id='buttonbar'>
						<td style='text-align: center;' name='imprime'><a style='font-size: 10px;'><button onclick='erroPrint(3,".$pedido->getStatus().")' class='btn btn-danger' data-toggle='modal' data-target='#modalPedido".$pedido->getPkId()."' data-id='".$pedido->getPkId()."'><i class='fa fa-print'></i> Imprimir</button></a></td>";

					if($pedido->rua == NULL){
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick='erroRetirada(3,".$pedido->getStatus().")' class='btn btn-success' disable><i class='fas fa-store'></i> Retirado</button></a></td>";
					}else{
						echo "<td style='text-align: center;' name='delivery'><a style='font-size: 10px;'><button onclick='erroDelivery(3,".$pedido->getStatus().")' class='btn btn-success' disable><i class='fa fa-truck'></i> Delivery</button></a></td>";
					}					

				}
					
				echo 
				"<td style='text-align: center;' name='editar'>
					<a style='font-size: 10px;' ' href='pedido-info.php?cod=".$pedido->getPkId()."'>
						<div type='button' class='popup btn btn-primary' onmouseover='myPopup(".$array.")' onmouseout='myPopup(".$array.")'>
							<i class='fa fa-edit'></i> Detalhes
							<span class='popuptext' id='myPopup".$array."'>
								<table class=''>
									<tbody>";

									$itens = $control_carrinho->selectItens($pedido->getPkId());
									foreach($itens as $item){

										$txt_adc = "";
										$custo_adc = 0;
										if($item->arr_adicionais){
											$adicionais = json_decode($item->arr_adicionais);
											
											if($adicionais != ""){
												foreach($adicionais as $a){
													$txt_adc = "<br> + ".$a[3]."x ".$a[1];
													$custo_adc += $a[3] * $a[2];
												}
											}else{
												$adicionais = NULL;
											}
										}

										$subtotal_item = $item->getPreco() + $custo_adc;
										echo 
										"<tr name='resultado' id='status".$item->getPkId()."'>	
											<td id='detalhes'>".$item->getQuantidade()."x</td>
											<td id='detalhes'> "
												.$item->nome
												." ".$txt_adc.
											"</td>
											<td id='detalhes'>"."R$ ".$subtotal_item."</td>
										</tr>";
									}

									echo
									"</tbody>
								</table>
							</span>
						</div>
					</a>
				</td>
			</div>
		</tr>";

		}

	}
}


if($pedidos == -1) return;
foreach ($pedidos as $pedido) {

	$entrega = date('H:i', strtotime($pedido->getData()->format('H:i')." +30 minutes"));
	$formaPgt = $controlFormaPgt->selectId($pedido->getFkFormaPgt());
	// $formaPgt = $controlFormaPgt->selectAll();
	$itens = $control_carrinho->selectItens($pedido->getPkId());


	// var_dump($pedido->getFkFormaPgt());
	// exit;

	$formaPgtDin = "Dinheiro";	//quando o cod da forma de pagamento for igual a zero

	if($pedido->getStatus() == 1 || $pedido->getStatus() == 2){

		$array = $pedido->getPkId();

		echo
		"<div class='modal fade' style='text-align: center' id='modalPedido".$pedido->getPkId()."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'>

			<div class='modal-dialog' role='document'>
			<div class='modal-content'>
			<div class'modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<br><h4 class='modal-title' id='exampleModalLabel' style='text-align:center'>Dados para Impressão</h4>
			</div>

			<div class='modal-body' style='text-align:center' id='divPrin".$array."'>
				
				<form>
				
				<div class='form-group' style='display: inline-block; text-align: left; max-width: 300px; overflow-wrap: break-word;'>
					<label for='recipient-name' class='control-label'>----------------------------------</label>
					<br><label for='recipient-name' class='control-label'>Restaurante: DELION.O </label>
					<br><label for='message-text' class='control-label'>"."Pedido: #".$pedido->getPkId()."</label>
						<br><label for='message-text' class='control-label'>"."Data: ".$pedido->getData()->format('d/m/Y')." ".$pedido->getData()->format('H:i')."</label>
						<br><label for='message-text' class='control-label'>"."Previsao de Entrega: ".$entrega."</label>
						<br>
						<br><label for='recipient-name' class='control-label'>"." Dados do Cliente </label>
						<br><label for='recipient-name' class='control-label'>"."Nome: <b>".$pedido->getCliente()."</b></label>
						<br><label for='recipient-name' class='control-label'>"."Telefone: ".$mask->addMaskPhone($pedido->telefone)."</label>";
						
						if($pedido->rua == NULL){

							echo "<br><label for='recipient-name' class='control-label'>"." Local Entrega: Balcão</label>";

						}else{

							echo "<br><label for='recipient-name' class='control-label'>"." Endereço: ".$pedido->rua.", ".$pedido->numero."- ".$pedido->bairro."</label>
							<br><label for='recipient-name' class='control-label'>"." Bairro: ".$pedido->bairro."</label>
							<br><label for='recipient-name' class='control-label'>"." Comp: ".$pedido->complemento."</label>
							<br><label for='recipient-name' class='control-label'>"." Cidade: Foz do Iguaçu - PR</label>
							<br><label for='recipient-name' class='control-label'>"." CEP: ".$pedido->cep."</label>";
						}

						if($formaPgt->getPkId() == NULL){
						}else{
							if(strpos($formaPgt->getNome(),"2x")){
								$valorDividido = $pedido->getTotal();
								$valorDividido = $valorDividido / 2;
								$parcela = "2x";
							}
							else if(strpos($formaPgt->getNome(),"3x")){
								$valorDividido = $pedido->getTotal();
								$valorDividido = $valorDividido / 3;
								$parcela = "3x";
							}
							else{
								$valorDividido = $pedido->getTotal();
							}
						}
						
						echo "<br><label for='recipient-name' class='control-label'>"." Observações do Pedido: </label>";
						
						if(!empty($item->getObservacao())){
							echo "<br><label for='recipient-name' class='control-label'>"." Observações do Pedido </label>";
						}
						$itens = $control_carrinho->selectItens($pedido->getPkId());
						foreach($itens as $item){
							if(!empty($item->getObservacao())){
								echo "<br><label for='recipient-name' class='control-label'>"."<b> - ".$item->nome." : ".$item->getObservacao()."</b></label>";
							}
						}

						echo
						"</div>
						<div>
							<br>
						</div>
						<div class='form-group' style='display: inline-block; text-align: left;'>
							<label for='recipient-name' class='control-label'>Itens do pedido:</label><br>
							<label for='recipient-name' class='control-label'>Qtd &nbsp&nbsp  Item &nbsp&nbsp&nbsp&nbsp&nbsp  Preço</label><br>";

						foreach($itens as $item){

							$subtotal_item = $item->getPreco();

							//Incrementa custo de Adicionais
							$txt_adc = "";
							$custo_adc_val = 0;
							if($item->arr_adicionais){
								$adicionais = json_decode($item->arr_adicionais);
							
							if($adicionais != ""){
									foreach($adicionais as $a){
										$txt_adc = "<br> + ".$a[3]."x ".$a[1];
										$custo_adc_val += $a[3] * $a[2];
									}
									
									$subtotal_item += $custo_adc_val;
								}else{
									$adicionais = NULL;
								}
							}	

							$subtotal_item = number_format(
								$subtotal_item,
								2,
								",",
								" "
							);

							$custo_adc_txt = number_format($custo_adc_val, 2, ",", " ");
							
							$preco_item = number_format($item->getPreco(), 2, ",", " ");
		
							if($item->getPreco() == 0){
								$valor = "Resgate Fidelidade";
							}else{
								$valor = "R$ ".$preco_item;
							}

							echo 
								"<label for='recipient-name' class='control-label'>"." ".$item->getQuantidade()."</label>
								<label for='recipient-name' class='control-label'>"." - ".$item->nome."</label>
								<label for='recipient-name' class='control-label'>"." -         ".$valor."</label>";

								if($custo_adc_val){
									echo $txt_adc." - R$ ".$custo_adc_txt; 
								}
								
								echo "<br><hr>";
						}

						echo
						"</div>
						<div>
							<br>
						</div>
					
						<div class='form-group' style='display: inline-block; text-align: left;'>
							<label for='recipient-name' class='control-label'>+--------------------------------------------------------------------+</label>
							<br><label for='recipient-name' class='control-label'>"." Subtotal:        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ &nbsp".$pedido->getSubtotal()."</label>
							<br><label for='recipient-name' class='control-label'>"." Taxa de entrega: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ &nbsp".$pedido->getTaxa_entrega()."</label>
							<br><label for='recipient-name' class='control-label'>"." Desconto Cupom:  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ &nbsp".$pedido->getDesconto()."</label>
							<br><label for='recipient-name' class='control-label'>"."<b> Total:           &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR$ &nbsp".$pedido->getTotal()."</b></label>
							<br><label for='recipient-name' class='control-label'>"."<b> Tipo de Pagamento:           &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$formaPgt->getNome()."  R$".number_format($valorDividido, 2, ",", " ") ."</b></label>";

							echo "<br><label for='recipient-name' class='control-label'>+--------------------------------------------------------------------+</label>
						</div>
					</form>
					
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
					<button type='button' class='btn btn-default' onclick=\"printDiv('#divPrin".$array."'); alteraStatusPrintModel(".$array.",2);\">Impressão</button>
				</div>
			</div>
		</div>
		</div>";
	}

}

echo "</tbody></table>
	</div>";

?>
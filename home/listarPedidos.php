<?php

	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlCarrinho.php";
	
	include_once "controler/segurancaCliente.php";

	protegeCliente();

    $controleCarrinho=new controlerCarrinho(conecta());

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";
?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/pedido/style-xs.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/pedido/style-sm.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/pedido/style-md.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/pedido/style-lg.css" />
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>


	<div class="container itens">
		<?php 
			$pedidos=$controleCarrinho->selectPedido($_SESSION['cod_cliente']);
			if ($pedidos == -1) {
				echo "<h1 class\"page-header\" style=\"text-align:center;\">Não possui pedidos realizados</h1>";
			}else {
				echo 
					"<table class=\"tabela_itens table table-hover table-responsive table-condensed\">
						<thead>
							<h1 class=\"text-center\">Lista de Pedidos</h1>
							<div class=\"pull-right\">
								<a href=\"cliente.php\" class=\"btn btn-default\"><i class=\"fa fa-arrow-left\"></i> Voltar</a>
							</div class=\"pull-right\">
							<tr id=\"cabecalhoTabela\" style='background-color:".$corPrim.";border-bottom-color: ".$corSec.";'>
								<th width='20%' style='text-align: center;'>Data</th>
								<th width='10%' style='text-align: center;'>Hora do Pedido</th>
								<th width='15%' style='text-align: center;'>Valor</th>
								<th width='15%' style='text-align: center;'>Status</th>
								<th width='35%' style='text-align: center;'>Itens do pedido</th>
							</tr>
						</thead>
						<tbody>";
								foreach ($pedidos as &$pedido) {
										echo "<tr name='resultado' id='status".$pedido->getPkId()."'>
											<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
											<td style='text-align: center;' name='data'>".$pedido->getData()->format('H:i')."h</td>
											<td style='text-align: center;' name='valor'>R$ ".$pedido->getTotal()."</td>";
											if($pedido->getStatus() == 1){
												echo "<td style='text-align: center;' name='status'>Enviado</td>";
											}
											else if($pedido->getStatus() == 2){
												$dateHoraPrint = date_create($pedido->getHora_print());
												echo "<td style='text-align: center;' name='status'>".date_format($dateHoraPrint, "H:i")."h - Em preparo</td>";
											}
											else if($pedido->getStatus() == 3 && ($pedido->getHora_delivery() == 0)){//Quando o pedido é retirado no balcão
												$dateHoraRetirada = date_create($pedido->getHora_retirada());
												echo "<td style='text-align: center;' name='status'>".date_format($dateHoraRetirada, "H:i")."h - Retirado</td>";

											}
											else if($pedido->getStatus() == 3){//quando o pedido é enviado para entrega
												$dataHoraDelivery = date_create($pedido->getHora_delivery());
												echo "<td style='text-align: center;' name='status'>".date_format($dataHoraDelivery, "H:i")."h - Saiu para Entrega</td>";
											}
											else if($pedido->getStatus() == 4){//quando o pedido foi cancelado
												echo "<td style='text-align: center;' name='status'> Pedido cancelado pelo Administrador</td>";
											}

											echo "<td style='text-align: center;' name='editar'><a href='pedido.php?cod=".$pedido->getPkId()."'><button class='btn btn-default'>Itens</button></a></td>
										</tr>";  
								}                  
								echo "
						</tbody>
					</table>";
			}
		?>
	</div>

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		$(document).ready(function () {

			$('.banner-superior').slick({

				slidesToShow: 1,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 3000,

				arrows: false,

				speed: 800,

				fade: true,

				dots: true

			});

		});
	</script>

</body>

</html>
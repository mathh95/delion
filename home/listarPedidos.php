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
	include "./whats-config.php";
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
							<tr id=\"cabecalhoTabela\">
								<th width='35%' style='text-align: center;'>Data</th>
								<th width='15%' style='text-align: center;'>Valor</th>
								<th width='15%' style='text-align: center;'>Status</th>
								<th width='35%' style='text-align: center;'>Itens do pedido</th>
							</tr>
						</thead>
						<tbody>";
								foreach ($pedidos as &$pedido) {
										echo "<tr name='resultado' id='status".$pedido->getCod_pedido()."'>
											<td style='text-align: center;' name='data'>".$pedido->getData()->format('d/m/Y')."</td>
											<td style='text-align: center;' name='valor'>".$pedido->getValor()."</td>
											<td style='text-align: center;' name='status'>".$pedido->getStatus()."</td>
											<td style='text-align: center;' name='editar'><a href='pedido.php?cod=".$pedido->getCod_pedido()."'><button class='btn btn-default'>Itens</button></a></td>
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
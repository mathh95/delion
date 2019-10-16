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
	

			<!--TABELA DE ITENS DO PEDIDO -->
	<div class="container itens">
        <table class="tabela_itens table table-hover table-responsive table-condensed">
            <thead>
				<h1 class="text-center">Lista de Itens</h1>
				<div class="pull-right">
					<a href="listarPedidos.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a>
				</div class="pull-right">
                <tr id="cabecalhoTabela">
                    <th width='33%' style='text-align: center;'>Produto</th>
                    <th width='33%' style='text-align: center;'>Quantidade</th>
					<th width='33%' style='text-align: center;'>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $itens=$controleCarrinho->selectItens($_GET['cod']);
                    foreach ($itens as &$item) { 
                            echo "<tr name='resultado' id='status".$item->getCod_item()."'>
                                <td style='text-align: center;' name='produto'>".$item->getProduto()."</td>
								<td style='text-align: center;' name='quantidade'>".$item->getQuantidade()."</td>
                                <td style='text-align: center;' name='valor'>$item->preco</td>
                            </tr>";  
                    }                  
                ?>
            </tbody>
        </table>
	</div>
	<!-- FIM DA TABELA -->
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
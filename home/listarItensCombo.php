<?php

	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlCombo.php";
	
	include_once "controler/segurancaCliente.php";

	protegeCliente();

    $controleCombo=new controlerCombo(conecta());

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
	

			<!--TABELA DE ITENS DO PEDIDO -->
	<div class="container itens">
        <table class="tabela_itens table table-hover table-responsive table-condensed">
            <thead>
                <h1 class="text-center">Lista de Itens do Combo</h1>
                <tr id="cabecalhoTabela">
                    <th width='20%' style='text-align: center;'>Produto</th>
					<th width='20%' style='text-align: center;'>Valor</th>
					<th width='33%' style='text-align: center;'>Adicionais</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $itens=$controleCombo->selectItens($_GET['cod']);
                    foreach ($itens as &$item) { 
                            echo "<tr name='resultado' id='status".$item->getCod_item_Combo()."'>
                                <td style='text-align: center;' name='produto'>".$item->getProduto()."</td>
                                <td style='text-align: center;' name='valor'>$item->preco</td>
								<td style='text-align: center;' name='adicionais'>";
								$adicionais=$item->adicionais;
								if (count($adicionais) > 0){

									foreach ($adicionais as &$adicional) {
										echo $adicional->getNome(). "  ";
									} 
								}else{
									echo "Não possui adicionais.";
								}
							echo
								"</td>
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
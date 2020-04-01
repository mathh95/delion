<?php 
	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
	<title>Delion Café - Delivery Foz do Iguaçu | Sobre</title>
	<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="description" content="Sobre a fundação da Delion Café e o que motivou a criação de um novo conceito de Cafeteria e Restaurante em Foz do Iguaçu.">
	<meta name="keywords" content="Salgados, Sonhos, Doces, Bolos, Buffet, Almoço, Lanches, Bebidas, Sobremesas, Jantar, Eventos, Fidelidade, Marmita, Aniversários, Palestras.">
	<meta name="robots" content="">
	<meta name="revisit-after" content="1 day">
	<meta name="language" content="Portuguese">
	<meta name="generator" content="N/A">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
</head>
<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/sobre/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/sobre/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/sobre/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/sobre/style-lg.css"/>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container historia">

		<div class="texto">

			<?= html_entity_decode($empresa->getDescricao()); ?>

		</div>

		<div class="imagem" id="principal">

		<?php 

			foreach ($imagens as $imagem) {

				$pagina = json_decode($imagem->getPagina());

				if (in_array('sobre', $pagina)) {

					echo "<div><img src='../admin/".$imagem->getFoto()."'></div>";

				}

			}

		?>

		</div>

	</div>



	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		$(document).ready(function(){

      		$('#principal').slick({

        		slidesToShow: 1,

				slidesToScroll: 1,

				autoplay: true,

				autoplaySpeed: 3000,

				arrows: false,

			 	speed: 800,

				fade: true,

				dots: false

      		});

    	});

	</script>

</body>

</html>
<?php 

	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

	include_once "configuracaoCores.php";


	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Delion Café - Delivery Foz do Iguaçu | Contato</title>
	<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="description" content="Já pensou em trabalhar na Delion Café ? Entre em contato conosco!">
	<meta name="keywords" content="Salgados, Sonhos, Doces, Bolos, Buffet, Almoço, Lanches, Bebidas, Sobremesas, Jantar, Eventos, Fidelidade, Marmita, Emprego, Trabalhe Conosco">
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

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/contato/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/contato/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/contato/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/contato/style-lg.css"/>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container contato">

		<div class="solicitacao">

			<form>

				<div>

					<input name="nome" type="text" required placeholder="Nome" style="border: 2px solid <?= $corSec ?>;">

				</div>

				<div>

					<input name="email" type="mail" required placeholder="E-mail" style="border: 2px solid <?= $corSec ?>;">

				</div>

				<div>

					<input name="sobre" type="text" required placeholder="Assunto" style="border: 2px solid <?= $corSec ?>;">

				</div>

				<textarea rows="3" name="observacao" placeholder="Mensagem" maxlength="300" style="border: 2px solid <?= $corSec ?>;"></textarea>

				<input name="assunto" type="hidden" value="Contato">

				<button style="background-color:<?= $corSec ?>;">ENVIAR</button>

			</form>

		</div>

		<div class="imagem">

		<?php

		$i = 0; 

		foreach ($imagens as $imagem) {

			$pagina = json_decode($imagem->getPagina());

			if (in_array('contato', $pagina) && ($i < 2)) {

				echo "<div><img src='../admin/".$imagem->getFoto()."'></div>";

				$i++;

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

    	$(document).ready(function(){

      		$('.imagem-cardapio-evento').slick({

        		slidesToShow: 1,

				slidesToScroll: 1,

				prevArrow:"<img class='a-left control-c prev slick-prev' src='img/seta-esquerda.png'>",

      			nextArrow:"<img class='a-right control-c next slick-next' src='img/seta-direita.png'>"

      		});

    	});

    	$('.timepicker-inicio').wickedpicker({

    		twentyFour: true

    	});

    	$('.timepicker-termino').wickedpicker({

    		twentyFour: true

    	});

	</script>

</body>

</html>
<?php 
session_start();

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "controler/controlBanner.php";
    include_once "controler/controlImagem.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
	include_once MODELPATH."/cliente.php";
	include_once "controler/segurancaCliente.php";
	include_once "./configuracaoCores.php";

	protegeCliente();

	$controleEmpresa = new controlerEmpresa(conecta());
	$empresa = $controleEmpresa->select(1,2);

	$controleImagem = new controlerImagem(conecta());
	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";
?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cliente/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cliente/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cliente/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cliente/style-lg.css"/>

	<script data-ad-client="ca-pub-9260777931961803" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>
	
	<div class="container cliente">

		<div class="area">

			<p><i class="fas fa-crown"></i> Sua Área</p>	

			<div >
				<a href="endereco.php"><button class="botao-esquerda"  type="submit" style="background-color: <?= $corSec?>;">ENDEREÇOS CADASTRADOS</button></a>
			</div>

			<div>
				<a href="listarPedidos.php"><button class="botao-esquerda" type="submit" style="background-color: <?= $corSec?>;">LISTAR PEDIDOS</button></a>
			</div>

			<div>
				<a href="alterarCliente.php"><button class="botao-esquerda" style="background-color: <?= $corSec?>;">ALTERAR DADOS</button></a>
			</div>

			<div>
				<a href="alterarSenha.php"><button class="botao-esquerda" type="submit" style="background-color: <?= $corSec?>;">ALTERAR SENHA</button></a>
			</div>


			<!-- <div>
				<a href="listarCombos.php"><button class="botao-esquerda" type="submit">LISTAR COMBOS</button></a>
			</div> -->


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
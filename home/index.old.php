<?php 

	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlImagem.php";

	include_once "controler/controlBanner.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleBanner=new controlerBanner(conecta());

	$banners = $controleBanner->selectAll();

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/index/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/index/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/index/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/index/style-lg.css"/>
</head>


<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container banner-superior hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

		<?php 

			foreach ($banners as $banner) {

				$pagina = json_decode($banner->getPagina());

				if (in_array('inicialSuperior', $pagina)) {

					echo "<a  href='".$banner->getLink()."' ><img src='../admin/".$banner->getFoto()."'></a>";

				}
			}
		?>

	</div>

	<div class="container cardapio-evento-pedido-cartao">

		<div>
			<div class="imagem-cardapio-evento">

				<?php 

					foreach ($imagens as $imagem) {

						$pagina = json_decode($imagem->getPagina());

						if (in_array('inicialCardapio', $pagina)) {

							echo "<a  href='cardapio.php' ><img src='../admin/".$imagem->getFoto()."'></a>";
						}
					}
				?>

			</div>

			<a href='cardapio.php'>
				<div style="background-color: #C57686;" class="texto">
					<img src="img/cup.png" class="icone"> CONHEÇA O NOSSO CARDÁPIO
				</div>
			</a>
		</div>

		<div>
			<div class="imagem-cardapio-evento">
				<?php 

					foreach ($imagens as $imagem) {

						$pagina = json_decode($imagem->getPagina());

						if (in_array('inicialEvento', $pagina)) {

							echo "<a href='eventos.php'><img src='../admin/".$imagem->getFoto()."'></a>";	 
						}
					}
				?>	
			</div>

			<a href='eventos.php'>
				<div style="background-color: #C57686 !important;" class="texto">
					<img src="img/icone-evento.png" class="icone"> EVENTOS
				</div>
			</a>
		</div>
	</div>

	<div class="container cardapio-evento-pedido-cartao">
		<div>
			<div class="imagem-pedido-cartao">

				<?php 

					foreach ($imagens as $imagem) {

						$pagina = json_decode($imagem->getPagina());

						if (in_array('inicialPedido', $pagina)) {

							echo "<a><img src='../admin/".$imagem->getFoto()."'></a>";

						}
					}
				?>	
			</div>

			<a>
				<div style="background-color: #C57686 !important;" class="texto">
					<img src="img/icone-bolo.png" class="icone"> FAÇA SEU PEDIDO
				</div>
			</a>
		</div>

		<div>
			<div class="imagem-pedido-cartao">
				<?php 

					foreach ($imagens as $imagem) {

						$pagina = json_decode($imagem->getPagina());

						if (in_array('inicialCartaoFidelidade', $pagina)) {

							echo "<a><img src='../admin/".$imagem->getFoto()."'></a>";

						}
					}
				?>	
			</div>

			<a>
				<div style="background-color: #C57686 !important;" class="texto">
					<img src="img/icone-cartao.png" class="icone"> PEÇA O SEU CARTÃO FIDELIDADE
				</div>
			</a>
		</div>
	</div>

	<div class="container banner-inferior hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

		<?php 

			foreach ($banners as $banner) {

				$pagina = json_decode($banner->getPagina());

				if (in_array('inicialInferior', $pagina)) {

					echo "<a  href='".$banner->getLink()."' ><img src='../admin/".$banner->getFoto()."'></a>";

				}
			}
		?>

	</div>
		

	<?php
		include_once "./footer.php";
	?>

	<script>
		$(document).ready(function(){

			//SlideShow Principal Home
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

			//SlideShow Secundários Home
			$('.imagem-cardapio-evento').slick({

				slidesToShow: 1,

				slidesToScroll: 1,

				prevArrow:"<img class='a-left control-c prev slick-prev' src='img/seta-esquerda.png'>",

				nextArrow:"<img class='a-right control-c next slick-next' src='img/seta-direita.png'>"

			});

			//Bem vindo para novo cliente
			var url_string = window.location.href;
			var url = new URL(url_string);
			var bem_vindo = url.searchParams.get("bem_vindo");

			if(bem_vindo){
				swal("Bem vindo!", "Hora de um bom café!?",
				{
					buttons: {
						cardapio: "Ver o Cardapio"
					},
				}).then((value) => {
					switch (value) {
						case "cardapio":
							window.location = "/home/cardapio.php";
							break;
						default:
							return 0;
					}
				});
			}
		});
	</script>

</body>

</html>
<?php 

	session_start();
	// session_destroy();

	

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleBanner=new controlerBanner(conecta());

	$banners = $controleBanner->selectAll();

	$controleImagem=new controlerImagem(conecta());

	$imagens = $controleImagem->selectAll();



	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");

	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");

	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");

	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");



	$local =  ($iphone || $android || $palmpre || $ipod || $berry == true) ? 'https://api.whatsapp.com/send?phone=55'.$empresa->getWhats().'' : 'https://web.whatsapp.com/send?phone=55'.$empresa->getWhats().'';

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

	<meta charset="UTF-8">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126193942-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-126193942-1');
	</script>
	
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window,document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '243490056341138'); 
		fbq('track', 'PageView');
		</script>
		<noscript>
		<img height="1" width="1" 
		src="https://www.facebook.com/tr?id=243490056341138&ev=PageView
		&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
		
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		
	
	<title>Delion Café - Cafeteria - Foz do Iguaçu</title>

	<link rel="shortcut icon" href="img/favicon.png">

	<link rel="stylesheet" href="css/vendors/plugins.css">

	<link rel="stylesheet" href="css/vendors/jquery-ui.min.css">

	<link rel="stylesheet" type="text/css" href="css/vendors/slick.css"/>

	<link rel="stylesheet" type="text/css" href="css/vendors/slick-theme.css"/>

	<link rel="stylesheet" type="text/css" href="css/vendors/fontawesome.min.css" />

	<link rel="stylesheet" type="text/css" href="css/vendors/jssocials.css" />

	<link rel="stylesheet" type="text/css" href="css/vendors/jssocials-theme-minima.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/index/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/index/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/index/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/index/lg/style-lg.css"/>

	<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name = "google-signin-client_id" content="1044402294470-h7gko3p3obgouo9kmtemsekno8n08deu.apps.googleusercontent.com">

	<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>
            
</head>

<body>
	<?php
		include_once "./header.php";
	?>

	<!-- <div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div style="margin-top:110px; margin-left:250px;" class="modal-dialog modal-lg">
			<div style="width:800px; position: relative;" class="modal-content">
				<div style="position:absolute; top:0; right:0;">
				<button onclick="fechar()" class="btn btn-danger">X</button>
				</div>
				<?php 

				foreach ($imagens as $imagem) {

					$pagina = json_decode($imagem->getPagina());

					if (in_array('popUp', $pagina)) {

						echo "
						<img src='../admin/".$imagem->getFoto()."'>";

					}

				}

				?>
			</div>
		</div>
	</div> -->

	<?php
		include_once "./navbar.php"
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

			<a href='cardapio.php'><div style="background-color: #C57686;" class="texto">

				<img src="img/cup.png" class="icone"> CONHEÇA O NOSSO CARDÁPIO

			</div></a>

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

			<a href='eventos.php'><div style="background-color: #C57686 !important;" class="texto">

				<img src="img/icone-evento.png" class="icone"> EVENTOS

			</div></a>

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

			<a><div style="background-color: #C57686 !important;" class="texto">

				<img src="img/icone-bolo.png" class="icone"> FAÇA SEU PEDIDO

			</div></a>

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

			<a><div style="background-color: #C57686 !important;" class="texto">

				<img src="img/icone-cartao.png" class="icone"> PEÇA O SEU CARTÃO FIDELIDADE

			</div></a>

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

	<footer class="container-fluid">

		<div class="container">

			<div class="logo">

				<a href="/"><img src="<?= "../admin/".$empresa->getFoto(); ?>"></a>

				<div>Toda hora é hora de um bom café!</div>

			</div>

			<div class="infos">

				<div class="links">

					<div><a href="index.php">Sobre</a><br></div>

					<div><a href="historia.php">História</a><br></div>

					<div><a href="contato.php">Contato</a><br></div>

					<div><a href="localizacao.php">Localização</a><br></div>

				</div>

				<div class="dados">

					<div><?= $empresa->getEndereco(); ?></div>

					<div><?= $empresa->getBairro(); ?></div>

					<div><?= $empresa->getCidade(); ?> - <?= $empresa->getEstado(); ?></div>

					<div>CEP: <?= $empresa->getCep(); ?></div>

					<div>Fone: <?= $empresa->getFone(); ?></div>

				</div>

				<div class="redes">

					<div>Delion Café</div>

					<div>Nas redes sociais</div>

					<div class="rede-social">

						<a href="<?= !empty($empresa->getFacebook()) ? "https://".$empresa->getFacebook() : "https://www.facebook.com" ?>">

							<img src="img/face.png">

						</a>

						<a href="<?= !empty($empresa->getInstagram()) ? "https://".$empresa->getInstagram() : "https://www.instagram.com" ?>">

							<img src="img/insta.png">

						</a>

					</div>

				</div>

			</div>

		</div>

	</footer>

	<div class="container-fluid rodape">

		<div class="container">

			<div>Todos os direitos reservados a Delion Café</div>

			<div>

				<div>Desenvolvido por Kionux Soluções em Internet <a href="http://www.kionux.com.br"><img src="img/kionuxsite.png" alt=""></a></div>

			</div>

		</div>

	</div>

	<div class="whatsapp">

		<a href="<?= $local ?>">

			<img src="img/whatsappverde.png" alt="">

		</a>

	</div>

	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>

	<script type="text/javascript" src="js/jquery-ui.min.js"></script>

	<script type="text/javascript" src="js/slick.min.js"></script>

	<script type="text/javascript" src="js/jssocials.js"></script>

	<script type="text/javascript" src="js/jssocials.shares.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

	<script>

		$(document).ready(function() {
			var largura = $(window).width();
			if(largura >= 1200){
				$('#myModal').modal('show');
			}

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

		function fechar(){
			$('#myModal').modal('hide');
		}

		$(".navbar-toggle li a").click(function() {
			if ( !$(this).parent().hasClass('dropdown') ) {
				$(".navbar-collapse").collapse('hide');
			}
		});

		function onLoad() {
		gapi.load('auth2', function() {
			gapi.auth2.init();
		});
		}

		function signOut() {
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
				swal("Deslogado!", "Obrigado pela visita!!", "error").then((value) => {window.location="/home/logout.php"});
			});
		}


		function deslogar(){
			swal("Deslogado!", "Obrigado pela visita!!", "error").then((value) => {window.location="/home/logout.php"});
		}

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

		$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

	</script>

</body>

</html>
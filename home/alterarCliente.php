<?php 
session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

    include_once "controler/controlImagem.php";
    
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	include_once MODELPATH."/cliente.php";
	
	include_once "controler/segurancaCliente.php";

	protegeCliente();

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleBanner=new controlerBanner(conecta());

	$miniBanners = $controleBanner->selectAllMini();

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

	<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>

	<title>Delion Café - Cafeteria - Foz do Iguaçu</title>

	<link rel="shortcut icon" href="img/favicon.png">

	<link rel="stylesheet" href="css/vendors/plugins.css">

	<link rel="stylesheet" href="css/vendors/jquery-ui.min.css">

	<link rel="stylesheet" type="text/css" href="css/vendors/slick.css"/>

	<link rel="stylesheet" type="text/css" href="css/vendors/slick-theme.css"/>

	<link rel="stylesheet" type="text/css" href="css/vendors/wickedpicker.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/cliente/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/cliente/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/cliente/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/cliente/lg/style-lg.css"/>

	<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name = "google-signin-client_id" content="1044402294470-h7gko3p3obgouo9kmtemsekno8n08deu.apps.googleusercontent.com">
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php"
	?>

	<div class="container cliente">

		<div class="solicitacao">
			<form action="controler/alterarCliente.php" method="POST">

				<p>Alterar dados da sua conta</p>

                    <input name="cod_cliente" type="hidden" value="<?php echo $_SESSION['cod_cliente'];?>">
    			<div>

					<p>Nome:</p>

        			<input name="nome" type="text" minlength="4" maxlength="30" required placeholder="Nome" value="<?php echo $_SESSION['nome'];?>">

    			</div>
    			<div>

					<p>Login:</p>

        			<input name="login" type="text" minlength="4" maxlength="40" required placeholder="Login" value="<?php echo $_SESSION['login'];?>">

    			</div>
				<div>

					<p>Telefone:</p>

					<input name="telefone" type="text" minlength="8" maxlength="16" required placeholder="(45) 9 9999-9999" value="<?php echo $_SESSION['telefone'];?>">

				</div>

    			<button type="submit">ALTERAR</button>
								
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

	<div class="container imagens">

	<?php

	$j = 0;

	foreach ($miniBanners as $miniBanner) {

		$pagina = json_decode($miniBanner->getPagina());

		if (in_array('contato', $pagina) && ($j < 3) ) {

		echo"

		<div>

			<div class='imagem'>

				<img src='../admin/".$miniBanner->getFoto()."'>

			</div>

		</div>

		";

		$j++;

		}

	}

	?>

	</div>

	<div class="container banner hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

	<?php 

		foreach ($banners as $banner) {

			$pagina = json_decode($miniBanner->getPagina());

			if (in_array('contato', $pagina)) {

				echo "<img src='../admin/".$banner->getFoto()."'>";

				break;

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

	<script type="text/javascript" src="js/wickedpicker.js"></script>

	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script type="text/javascript" src="js/slick.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
	
	<script>

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

    	$('.timepicker-inicio').wickedpicker({

    		twentyFour: true

    	});

    	$('.timepicker-termino').wickedpicker({

    		twentyFour: true

    	});

    	$("input.telefone").mask("(99) 9999-9999?9").focusout(function (event) {  

            var target, phone, element;  

            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  

            phone = target.value.replace(/\D/g, '');

            element = $(target);  

            element.unmask();  

            if(phone.length > 10) {  

                element.mask("(99) 99999-999?9");  

            } else {  

                element.mask("(99) 9999-9999?9");  

            }  

        });

		$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

	</script>

</body>

</html>
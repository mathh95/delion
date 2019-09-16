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

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<title>Delion Café - Cafeteria - Foz do Iguaçu</title>

	<link rel="shortcut icon" href="img/favicon.png">

	<link rel="stylesheet" href="css/vendors/plugins.css">

	<link rel="stylesheet" href="css/vendors/jquery-ui.min.css">

	<link rel="stylesheet" type="text/css" href="css/vendors/slick.css" />

	<link rel="stylesheet" type="text/css" href="css/vendors/slick-theme.css" />

	<link rel="stylesheet" type="text/css" href="css/vendors/fontawesome.min.css" />

	<link rel="stylesheet" type="text/css" href="css/vendors/jssocials.css" />

	<link rel="stylesheet" type="text/css" href="css/vendors/jssocials-theme-minima.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/pedido/xs/style-xs.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/pedido/sm/style-sm.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/pedido/md/style-md.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/pedido/lg/style-lg.css" />

	<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
	    crossorigin="anonymous">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name = "google-signin-client_id" content="1044402294470-h7gko3p3obgouo9kmtemsekno8n08deu.apps.googleusercontent.com">
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

					<div>
						<?= $empresa->getEndereco(); ?>
					</div>

					<div>
						<?= $empresa->getBairro(); ?>
					</div>

					<div>
						<?= $empresa->getCidade(); ?> -
						<?= $empresa->getEstado(); ?>
					</div>

					<div>CEP:
						<?= $empresa->getCep(); ?>
					</div>

					<div>Fone:
						<?= $empresa->getFone(); ?>
					</div>

				</div>

				<div class="redes">

					<div>Delion Café</div>

					<div>Nas redes sociais</div>

					<div class="rede-social">

						<a href="<?= !empty($empresa->getFacebook()) ? " https://".$empresa->getFacebook() : "https://www.facebook.com" ?>">

							<img src="img/face.png">

						</a>

						<a href="<?= !empty($empresa->getInstagram()) ? " https://".$empresa->getInstagram() :
						    "https://www.instagram.com" ?>">

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

		$("#social-buttons1").jsSocials({

			showCount: false,

			showLabel: true,

			shares: [

				{
					share: "facebook",
					label: "Facebook",
					logo: "fa fa-facebook-official"
				},

				{
					share: "twitter",
					label: "Twitter",
					logo: "fa fa-twitter-square"
				},

				{
					share: "pinterest",
					label: "Pin this",
					logo: "fa fa-pinterest"
				}

			]

		});

		$("#social-buttons2").jsSocials({

			showCount: false,

			showLabel: true,

			shares: [

				{
					share: "facebook",
					label: "Facebook",
					logo: "fa fa-facebook-official"
				},

				{
					share: "twitter",
					label: "Twitter",
					logo: "fa fa-twitter-square"
				},

				{
					share: "pinterest",
					label: "Pin this",
					logo: "fa fa-pinterest"
				}

			]

		});

		$("#social-buttons3").jsSocials({

			showCount: false,

			showLabel: true,

			shares: [

				{
					share: "facebook",
					label: "Facebook",
					logo: "fa fa-facebook-official"
				},

				{
					share: "twitter",
					label: "Twitter",
					logo: "fa fa-twitter-square"
				},

				{
					share: "pinterest",
					label: "Pin this",
					logo: "fa fa-pinterest"
				}

			]

		});

		$("#social-buttons4").jsSocials({

			showCount: false,

			showLabel: true,

			shares: [

				{
					share: "facebook",
					label: "Facebook",
					logo: "fa fa-facebook-official"
				},

				{
					share: "twitter",
					label: "Twitter",
					logo: "fa fa-twitter-square"
				},

				{
					share: "pinterest",
					label: "Pin this",
					logo: "fa fa-pinterest"
				}

			]

		});

		$("#social-buttons5").jsSocials({

			showCount: false,

			showLabel: true,

			shares: [

				{
					share: "facebook",
					label: "Facebook",
					logo: "fa fa-facebook-official"
				},

				{
					share: "twitter",
					label: "Twitter",
					logo: "fa fa-twitter-square"
				},

				{
					share: "pinterest",
					label: "Pin this",
					logo: "fa fa-pinterest"
				}

			]

		});
	</script>

</body>

</html>
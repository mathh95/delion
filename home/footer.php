<?php

include_once "controler/controlEmpresa.php";

include_once CONTROLLERPATH."/controlerGerenciaSite.php";
include_once MODELPATH."/gerencia_site.php";
	
$controle = new controlerEmpresa(conecta());
$empresa = $controle->selectAll();

$controle=new controlerGerenciarSite($_SG['link']);
    $config1 = $controle->select(3,2);
	$corSec = $config1->getCorSecundaria();

	$config = $controle->select(3,2);
    $corPrim = $config->getCorPrimaria();

?>

<head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/footer/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/footer/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/footer/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/footer/style-lg.css"/>
</head>


<footer class="footer container-fluid">

		<div class="navbar-social navbar-collapse" style="background-color: <?= $corSec?>">
			<a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
			<a href="https://www.instagram.com"><i class=" fab fa-instagram"></i></a>
		</div>

		<div class="row left">
			<ul>
				<li>
					<p class="bold-text"><b>Navegue</b></p>
				</li>
				<li>
					<a href="sobre.php">Quem Somos</a>
				</li>

				<li>
					<a href="eventos.php">Eventos</a>
				</li>

				<li>
					<a href="programaFidelidade.php">Programa de Fidelidade</a>
				</li>
			</ul>
			
		</div>

		
		<div class="row center">

			<ul>
				<li>
					<p class="bold-text"><b>A Empresa</b></p>
				</li>

				<li>
					<a href="historia.php">História</a>
				</li>

				<li>
					<a href="localizacao.php">Localização</a>
				</li>

				<li>
					<a href="contato.php">Trabalhe Conosco</a>
				</li>
			</ul>
		</div>
		
		<?php
            $controle=new controlerGerenciarSite($_SG['link']);

            // Mudar questão do select mais tarde
            $config = $controle->select(1,2);

            $imagemLink = $config->getFoto();

        ?>


		<div class="row right">
		    <img src=/admin/<?= $imagemLink ?> style="width:93px;height:140px;">
			
			<div class="endereco-footer">
				<p class="bold-text"><b>
					<?= $empresa->getEndereco(); ?><br>
					<?= $empresa->getBairro(); ?> <br>  
                    <?= $empresa->getCidade(); ?> - <?= $empresa->getEstado();?><br>
                    CEP: <?=$empresa->getCep(); ?><br>
                    Fone: <?= $empresa->getFone(); ?>
				</b></p>
			</div>
			
			
			
		</div>

</footer>

<?php
	include_once "./rodapeKionux.php";
?>

<!-- <div class="whatsapp">

    <a href="">

        <img src="img/whatsappverde.png" alt="WhatsApp">

    </a>

</div> -->



<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
<meta name = "google-signin-client_id" content="<?=GOOGLE_SIGNIN_CREDENTIAL?>.apps.googleusercontent.com">


<script type="text/javascript" src="js/maskedinput.js"></script>

<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/slick.min.js"></script>

<script type="text/javascript" src="js/jssocials.js"></script>

<script type="text/javascript" src="js/jssocials.shares.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>

<script>

    // Show carrinho na navbar...
    // $(document).scrollTop(function() {
    //     var y = $(this).scrollTop();
    //     console.log(y);
    //     if (y > -1) {
    //         $('.carrinho').hide();
    //     } else {
    //         $('.carrinho').show();
    //     }
    // });

    $(document).ready(function() {
        var largura = $(window).width();
        if(largura >= 1200){
            $('#myModal').modal('show');
        }

    });

    $(".navbar-toggle li a").click(function() {
        if ( !$(this).parent().hasClass('dropdown') ) {
            $(".navbar-collapse").collapse('hide');
        }
    });

    function fechar(){
        $('#myModal').modal('hide');
    }


    function onLoad() {
        gapi.load('auth2', function() {
            gapi.auth2.init();
        });
    }


    function deslogar(){

		swal({
			title: "Deslogado!",
			text: "Obrigado pela visita 😕...",
			icon: "info",
			timer: 1100,
			buttons: false
		}).then((value) => {
			//Google sign out
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
				// console.log('Google signed out.');
			});

			window.location = "/home/logout.php";
		});
    }

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
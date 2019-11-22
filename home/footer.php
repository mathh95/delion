<?php
include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 
?>

<head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/footer/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/footer/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/footer/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/footer/style-lg.css"/>
</head>


<footer class="footer container-fluid">

		<div class="navbar-social navbar-collapse">
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
					<a href="#">Programa de Fidelidade</a>
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
					<a href="#">Trabalhe Conosco</a>
				</li>
			</ul>
		</div>
		<div class="row right">
		    <img src="/home/img/logo_branca.png" alt="logo delion branca" style="width:93px;height:140px;">
			
			<div class="endereco-footer">
				<p class="bold-text"><b>
					Rua Jorge Sanwais, 1137<br>
					Centro<br>
                    Foz do Iguaçu - Paraná<br>
                    CEP: 85851-150<br>
                    Fone: (45)3027-0059
				</b></p>
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
<!-- <div class="whatsapp">

    <a href="">

        <img src="img/whatsappverde.png" alt="WhatsApp">

    </a>

</div> -->

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name = "google-signin-client_id" content="<?=GOOGLE_SIGNIN_CREDENTIAL?>.apps.googleusercontent.com">
<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>

<script type="text/javascript" src="js/maskedinput.js"></script>

<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/slick.min.js"></script>

<script type="text/javascript" src="js/jssocials.js"></script>

<script type="text/javascript" src="js/jssocials.shares.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

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
        $('[data-toggle="tooltip"]').tooltip();
    });

    $("#social-buttons1").jsSocials({

        showCount: false,

        showLabel: true,

        shares: [

            {share: "facebook", label: "Facebook", logo: "fa fa-facebook-official"},

            {share: "twitter", label: "Twitter", logo: "fa fa-twitter-square"},

            {share: "pinterest", label: "Pin this", logo: "fa fa-pinterest" }

        ]

    });

    $("#social-buttons2").jsSocials({

        showCount: false,

        showLabel: true,

        shares: [

            {share: "facebook", label: "Facebook", logo: "fa fa-facebook-official"},

            {share: "twitter", label: "Twitter", logo: "fa fa-twitter-square"},

            {share: "pinterest", label: "Pin this", logo: "fa fa-pinterest" }

        ]

    });

    $("#social-buttons3").jsSocials({

        showCount: false,

        showLabel: true,

        shares: [

            {share: "facebook", label: "Facebook", logo: "fa fa-facebook-official"},

            {share: "twitter", label: "Twitter", logo: "fa fa-twitter-square"},

            {share: "pinterest", label: "Pin this", logo: "fa fa-pinterest" }

        ]

    });

    $("#social-buttons4").jsSocials({

        showCount: false,

        showLabel: true,

        shares: [

            {share: "facebook", label: "Facebook", logo: "fa fa-facebook-official"},

            {share: "twitter", label: "Twitter", logo: "fa fa-twitter-square"},

            {share: "pinterest", label: "Pin this", logo: "fa fa-pinterest" }

        ]

    });

    $("#social-buttons5").jsSocials({

        showCount: false,

        showLabel: true,

        shares: [

            {share: "facebook", label: "Facebook", logo: "fa fa-facebook-official"},

            {share: "twitter", label: "Twitter", logo: "fa fa-twitter-square"},

            {share: "pinterest", label: "Pin this", logo: "fa fa-pinterest" }

        ]

    });

</script>
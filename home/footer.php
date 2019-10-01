<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/footer/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/footer/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/footer/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/footer/style-lg.css"/>
</head>

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

        <img src="img/whatsappverde.png" alt="WhatsApp">

    </a>

</div>

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name = "google-signin-client_id" content="623570251512-cprdd8eepskvicq7h7lq999e8scsd9ui.apps.googleusercontent.com">
<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>


<script type="text/javascript" src="js/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/slick.min.js"></script>

<script type="text/javascript" src="js/jssocials.js"></script>

<script type="text/javascript" src="js/jssocials.shares.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<script>

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
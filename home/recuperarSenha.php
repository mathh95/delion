<?php 
	session_start();

	if(isset($_SESSION['cod_cliente'])){
		header("Location: /home");
	}

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleBanner=new controlerBanner(conecta());

	$miniBanners = $controleBanner->selectAllMini();

	$banners = $controleBanner->selectAll();

	$controleImagem=new controlerImagem(conecta());

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
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>
	
	<div class="container-fluid cliente-recuperar row">

		<div class="solicitacao">

			<form action="controler/recuperarAcesso.php" method="POST">
			
				<p>Recuperação de Senha</p>

    			<div>

					<p>Login (e-mail)</p>

        			<input class="form-control" name="login" type="email" required placeholder="delion@mail.com">

    			</div>

				<div class="botoes-recuperar">
					<button type="submit">Recuperar Senha</button>

					<button style="float: right;" onclick="window.history.go(-1)" >Voltar</button>					
				</div>
			</form>
			
			
		</div>		

		

	</div>

	</div>

	<!-- <div class="login_google container-fluid row">

		<h1>Você pode logar pelo Google se preferir!</h1>

		

	</div> -->

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script>

		function onSignIn(googleUser) {
			var profile = googleUser.getBasicProfile();
			var idCliente =  profile.getId(); 
			var nomeCliente = profile.getName();
			var emailCliente = profile.getEmail();

			$.ajax({
				type: 'POST',

				url: 'controler/businesCliente.php',

				data: {idGoogle: idCliente, nomeCliente: nomeCliente, emailCliente: emailCliente},

				success:function(resultado){
					swal("Login efetuado com sucesso!", "Bem vindo!", "success").then((value) => {window.location="/home"});
				}
			});
		}


		window.fbAsyncInit = function() {
			FB.init({
			appId      : '859682904420135',
			cookie     : true,
			xfbml      : true,
			version    : 'v3.1'
			});
			
			FB.AppEvents.logPageView();   
			
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));


		function loginFb() {
			FB.api('/me',{fields: 'name, email'}, function(response) {
				var id =  response.id; 
				var nome = response.name;
				var email = response.email;
				$.ajax({
					type: 'POST',
					url: 'controler/businesCliente.php',
					data: {id: id, nome: nome, email: email},
					success:function(resultado){
					if (resultado == -1){
						swal("Não foi possível efetuar login!", "erro!", "error").then((value) => {window.location="/home/login.php"});
					}else{
						swal("Login efetuado com sucesso!", "Bem vindo!", "success").then((value) => {window.location="/home"});
					}
					}
				});
			});
			
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
		
	</script>

</body>

</html>
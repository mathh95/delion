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
	include "./whats-config.php";

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
	
	<div class="container-fluid cliente row">

		<div class="solicitacao">

			<form action="controler/validarAcesso.php" method="POST">
			
				<p>Acesso</p>

    			<div>

					<p>Login</p>

        			<input class="form-control" name="login" type="email" required placeholder="delion@mail.com" autofocus>

    			</div>

    			<div>

					<p>Senha</p>

        			<input class="form-control" name="senha" type="password" required placeholder="******">

				</div>


				<span><a href="./recuperarSenha.php"><b>Esqueci minha senha</b></a><br><br></span>


				<button type="submit">ENTRAR</button>
				
				
				<a href="cadastroCliente.php"><button class="botao-cadastro" type="button">CADASTRAR</button></a>						

			</form>

			<div class="container-fluid tipos_login row">

				<div class="g-signin2 login_google" data-onsuccess="onSignIn" data-width="190"></div>

				<div class="fb-login-button login_facebook" style="margin-right: -30px;" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-onlogin="loginFb()"></div>

			</div>

			
			
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

		$(document).ready(function(){
			var url_string = window.location.href;
			var url = new URL(url_string);
			var recuperacao_enviada = url.searchParams.get("recuperacao_enviada");
			var recuperada = url.searchParams.get("recuperada");
			
			if(recuperacao_enviada=="true"){
				swal("E-mail enviado", "Siga as intruções do e-mail", "success");

				//clean params
				setTimeout(function() {
					window.location.href = url_string.substring(0, url_string.indexOf('?'));
				}, 2000);
			}else if(recuperada=="true"){
				swal("Senha recuperada", "Esquecidinho, não vá esquecer de Aproveitar!", "success");
				//clean params
				setTimeout(function() {
					window.location.href = url_string.substring(0, url_string.indexOf('?'));
				}, 2000);
			}
		});


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
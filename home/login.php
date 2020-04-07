<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	session_start();

	if(isset($_SESSION['cod_cliente'])){
		header("Location: /home");
	}

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "configuracaoCores.php";

	$controleEmpresa = new controlerEmpresa(conecta());
	$empresa = $controleEmpresa->select(1,2);

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
	
	<div class="container-fluid cliente row">

		<div class="solicitacao">

			<form id="loginForm" action="controler/validarAcesso.php" method="POST">
			
				<p>Acesso</p>

    			<div>

					<p>Login (e-mail)</p>

        			<input class="form-control" name="login" type="email" required placeholder="delion@mail.com" autofocus style="border: 2px solid <?= $corSec?>;">

    			</div>

    			<div>

					<p>Senha</p>

        			<input class="form-control" name="senha" type="password" required placeholder="******" style="border: 2px solid <?= $corSec?>;">

				</div>


				<span><a href="./recuperarSenha.php"><b>Esqueci minha senha</b></a><br><br></span>


				<button type="submit" style="background-color: <?= $corSec?>;">ENTRAR</button>
				
				
				<a href="cadastroCliente.php"><button class="botao-cadastro" type="button" style="background-color: <?= $corSec?>;">CADASTRAR</button></a>						

			</form>

			<div class="container-fluid tipos_login row">

				<div class="g-signin2 login_google" data-onsuccess="onSignIn" data-width="190"></div>

				<div class="fb-login-button login_facebook" style="margin-right: -30px;" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" data-onlogin="fbLoginStatus()" data-scope="email"></div>

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

	<!-- reCAPTCHAv3 -->
	<script src="https://www.google.com/recaptcha/api.js?render=<?=GOOGLE_reCAPTCHA?>"></script>

	<script>
		// SUBMIT com reCAPTCHAv3
		$('#loginForm').submit(function(event) {
			event.preventDefault();
	
			grecaptcha.ready(function() {
				grecaptcha.execute('<?=GOOGLE_reCAPTCHA?>', {action: 'login'}).then(function(token) {
					$('#loginForm').prepend('<input type="hidden" name="grecaptcha_token_login" value="' + token + '">');
					
					$('#loginForm').unbind('submit').submit();
				});
			});
		});


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

		//oAuth GOOGLE
		function onSignIn(googleUser) {

			var profile = googleUser.getBasicProfile();
			
			var id_google =  profile.getId();
			var nome = profile.getGivenName();
			var sobrenome = profile.getFamilyName();
			var email = profile.getEmail();

			$.ajax({
				type: 'POST',
				url: 'controler/businesCliente.php',
				data: {
					id_google: id_google,
					nome: nome,
					sobrenome: sobrenome,
					email: email
				},
				success:function(res){
					if (res == -1){
						swal("Não foi possível efetuar login!", "erro!", "error").then((value) => {window.location="/home/login.php"});
					}else{
						swal({
							title: "Bem vindo! 😄",
							text: "Bom proveito...",
							icon: "success",
							timer: 1000,
							buttons: false
						}).then((value) => {window.location="/home/cardapio.php"});
					}
				}
			});
		}


		// Load the Facebook SDK asynchronously
		(function(d, s, id) { 
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/pt_BR/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		//oAuth FACEBOOK
		window.fbAsyncInit = function() {
			FB.init({
				appId      : <?=FACEBOOK_APP_ID?>,
				cookie     : true,
				xfbml      : true,
				version    : 'v5.0'
			});

			FB.AppEvents.logPageView();
		};

		function fbLoginStatus(){
			FB.getLoginStatus(function(response) {
				// console.log(response);
				if (response.status === 'connected') {
					access_token = FB.getAuthResponse()['accessToken'];
					fbInfo();
				} else {
					fbLogin();
				}
			});
		}

		function fbLogin(){

			FB.login(function(response) {

				if (response.authResponse) {
					console.log('Welcome!  Fetching your information.... ');
					access_token =  FB.getAuthResponse()['accessToken'];
					fbInfo();
				} else {
					console.log('User cancelled login or did not fully authorize.');
				}

			}, {
				scope: 'email',
				auth_type: 'rerequest',
				return_scopes: true
			});
		}

		function fbInfo(){
			FB.api(
				"/me",
				"POST",
				{"fields": "id, first_name, last_name, email"},
				function(response) {
				
					// console.log(response);

					var id_facebook =  response.id;
					var nome = response.first_name;
					var sobrenome = response.last_name;
					var email = response.email;

					$.ajax({
						type: 'POST',
						url: 'controler/businesCliente.php',
						data: {
							id_facebook: id_facebook,
							nome: nome,
							sobrenome: sobrenome,
							email: email
						},
						success:function(res){
							// console.log(res);
							if (res == -1){
								swal("Não foi possível efetuar login!", "erro!", "error").then((value) => {window.location="/home/login.php"});
							}else{
								swal({
									title: "Bem vindo!",
									text: "Bom proveito 😄",
									icon: "success",
									timer: 1000,
									buttons: false
								}).then((value) => {window.location="/home/cardapio.php"});
							}
						}
					});
				});
		}


	</script>

</body>

</html>
<?php 
session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlEvento.php";

	$controleEmpresa=new controlerEmpresa(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$controleEvento=new controlerEvento(conecta());

	$antigoEventos = $controleEvento->selectAllAntigo();

	$novoEventos = $controleEvento->selectAllNovo();

	setlocale (LC_TIME, 'ptb');



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

	<script src=https://unpkg.com/sweetalert/dist/sweetalert.min.js></script>

	<meta charset="UTF-8">

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<title>Delion Café - Cafeteria - Foz do Iguaçu</title>

	<link rel="shortcut icon" href="img/favicon.png">

	<link rel="stylesheet" href="css/vendors/plugins.css">

	<link rel="stylesheet" href="css/vendors/jquery-ui.min.css">

	<link rel="stylesheet" type="text/css" href="css/vendors/slick.css"/>

	<link rel="stylesheet" type="text/css" href="css/vendors/slick-theme.css"/>

	<link rel="stylesheet" type="text/css" href="css/vendors/wickedpicker.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/eventos/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/eventos/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/eventos/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/eventos/lg/style-lg.css"/>

	<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<meta name = "google-signin-client_id" content="1044402294470-aoav6sv71tfvv9kemu3qfvt1u5mhenol.apps.googleusercontent.com">
</head>

<body>

	<header class="container-fluid">

		<div class="container">

			<div class="logo">

				<img src="<?= "../admin/".$empresa->getFoto(); ?>">

				<div>Toda hora é hora de um bom café!</div>

			</div>

			<div class="infos">

				<div>Horário de Atendimento</div>

				<div>Segunda a Sábado</div>

				<div>Das 07:00 Hs as 20:00 Hs</div>

				<div class="rede-social">

					<a href="<?= !empty($empresa->getFacebook()) ? "https://".$empresa->getFacebook() : "https://www.facebook.com" ?>">

						<img src="img/face.png">

					</a>

					<a href="<?= !empty($empresa->getInstagram()) ? "https://".$empresa->getInstagram() : "https://www.instagram.com" ?>">

						<img src="img/insta.png">

					</a>

					<a href="<?= !empty($empresa->getPinterest()) ? "https://".$empresa->getPinterest() : "https://www.pinterest.com" ?>">

						<img src="img/pinterest.png">

					</a>

				</div>

			</div>

		</div>

	</header>

	<div id="navegacao">

		<div class="container">

			<div id="navegacao__content">

				<nav class="navbar navbar-default">

			  		<div class="container-fluid">

					<!-- Brand and toggle get grouped for better mobile display -->	

					    <div class="navbar-header">

						    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">

						        <span class="sr-only">Toggle navigation</span>

						        <span class="icon-bar"></span>

						        <span class="icon-bar"></span>

						        <span class="icon-bar"></span>

						        <span class="icon-bar"></span>

						        <span class="icon-bar"></span>

					      	</button>

					    </div>

					<!-- Collect the nav links, forms, and other content for toggling -->	

				    	<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">

					    	<ul class="nav navbar-nav">

					        	<li><a href="index.php"><img src="img/home.png"><span class="sr-only">(current)</span></a></li>

					        	<li><a href="sobre.php">Sobre</a></li>

					        	<li><a href="historia.php">História</a></li>

					        	<li><a href="contato.php">Contato</a></li>

								<li><a href="localizacao.php">Localização</a></li>

								<?php if(isset($_SESSION['cod_cliente'])){
									echo "<li><a href=" .'cliente.php' .">Cliente</a></li>";
								}else{
									echo "<li><a href=" . 'login.php' . ">Login </a></li>";
								} ?>
								
								<li class="active"><a data-toggle="tooltip" title="Carrinho." href="carrinho.php"><i style="color:white;" class="fas fa-shopping-cart fa-lg"></i> <span style="background-color:black;" class="badge" id="spanCarrinho"><?php echo (isset($_SESSION['carrinho']))?count($_SESSION['carrinho']):'0';?></span></a></li>
								
								<?php if(isset($_SESSION['cod_cliente']) && !isset($_SESSION['telefone'])){
									echo "<li><a href='#' onclick='signOut()'>Logout</a></li>";
								}else if(isset($_SESSION['cod_cliente'])){
									echo "<li><a href='#' onclick='deslogar()'>Logout</a></li>";
								}?>
								
					   		</ul>

					   		<form method="GET" action="cardapio.php" class="navbar-form navbar-right hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

					   			 <div class="input-group">

						        	<input type="text" class="form-control" name="search">

					                <span class="input-group-btn">

					                    <button class="btn btn-default" type="submit">Buscar</button>

					                </span>

					   			</div>

					      	</form>

				    	</div><!-- /.navbar-collapse -->

				  	</div><!-- /.container-fluid -->

				</nav>	

			</div>

		</div>

	</div>

	<div class="container solicitar-evento">

		<div class="solicitacao hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

			<div>

				<h2>Solicitação de Evento</h2>

			</div>

			<div>

				<form method="POST" action="ajax/enviaEmail.php" class="form-horizontal form-contato">

					<div>

						<div>

							<input name="nome" type="text" required placeholder="Nome">

						</div>

						<div>

							<input name="telefone" type="text" required placeholder="Fone" class="telefone">

						</div>

					</div>

					<div>

						<div>

							<div>

								<input type="email" required name="email" placeholder="E-mail">

							</div>

							<div>

								<input type="date" min="<?= date('Y-m-d');?>" name="data" class="calendario" value="<?= date('Y-m-d');?>">

							</div>

						</div>

						<div>

							<div>

								<div>Início</div>

								<input type="text" class="timepicker-inicio" name="horaInicio"/>

							</div>

							<div>

								<div>Término</div>

								<input type="text" class="timepicker-termino" name="horaFim"/>

							</div>

						</div>

					</div>

					<div>

						<div>

							<textarea rows="3" name="descricao" placeholder="Descrição" maxlength="300"></textarea>

						</div>

						<div>

							<div>

								<div>Convidados</div>

								<input name="convidados" type="number" required value="0" min="0" max="999">

							</div>

							<img src="img/evento_logo.png" alt="" class="hidden-xs hidden-sm hidden-md visible-lg-* visible-xl-*">

							<button>ENVIAR</button>

						</div>

					</div>

					<input type="hidden" value="Solicitação de evento" name="assunto">

				</form>

			</div>

		</div>

		<div class="imagem">

			<?php 

			foreach ($novoEventos as $novoEvento) {

				echo "<img src='../admin/".$novoEvento->getFoto()."'>";

			}

			?>

		</div>

	</div>

	<div class="container eventos">

	<?php foreach ($antigoEventos as $antigoEvento) { ?>

		<div class="evento">

			<div class="imagem">

				<img src="<?= "../admin/".$antigoEvento->getFoto(); ?>" alt="">

			</div>

			<img src="img/logo_evento_300.fw.png" alt="">

			<div class="info">

				<div class="data"><?= ucfirst(strftime('%b/%Y',strtotime($antigoEvento->getData()))); ?></div>

				<div class="titulo"><?= mb_convert_case($antigoEvento->getNome(), MB_CASE_UPPER, 'UTF-8');?></div>

			</div>

		</div>

	<?php } ?>	

	</div>

	<footer class="container-fluid">

		<div class="container">

			<div class="logo">

				<img src="img/Logo_Branca.png">

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

						<a href="<?= !empty($empresa->getPinterest()) ? "https://".$empresa->getPinterest() : "https://www.pinterest.com" ?>">

							<img src="img/pinterest.png">

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

				<div>Desenvolvido por Kionux Soluções em Internet <img src="img/kionuxsite.png" alt=""></div>

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
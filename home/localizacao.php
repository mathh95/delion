<?php 
	session_start();

	include_once "../admin/controler/conexao.php";

	include_once "controler/controlEmpresa.php";

	include_once "controler/controlBanner.php";

	include_once "controler/controlImagem.php";

	$controleEmpresa = new controlerEmpresa(conecta());
	$empresa = $controleEmpresa->select(1,2);
	
	$controleImagem = new controlerImagem(conecta());
	$imagens = $controleImagem->selectAll();

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
	<title>Delion Café - Delivery Foz do Iguaçu | Localização</title>
	<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="description" content="Localizacao fornecida pelo Google Maps do nosso estabelecimento. Venha nos fazer uma visita!">
	<meta name="keywords" content="Buffet, Almoço, Lanches, Bebidas, Sobremesas, Jantar, Eventos, Aniversários, Palestras">
	<meta name="robots" content="">
	<meta name="revisit-after" content="1 day">
	<meta name="language" content="Portuguese">
	<meta name="generator" content="N/A">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<script data-ad-client="ca-pub-9260777931961803" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/localizacao/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/localizacao/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/localizacao/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/localizacao/style-lg.css"/>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	<div class="container mapa">

		<iframe src="https://maps.google.com/maps?q=delion%20caf%C3%A9%20jorge%20sanwais&t=&z=17&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>

	</div>

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

</body>

</html>				
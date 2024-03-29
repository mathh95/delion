<?php

	session_start();

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "controler/controlCategoria.php";
	include_once "controler/controlImagem.php";

	$controleEmpresa = new controlerEmpresa(conecta());

	$controleCategoria = new controlerCategoria(conecta());

	$empresa = $controleEmpresa->select(1,2);

	$categorias = $controleCategoria->selectAll();

	//Verifica se o usuario possui o cadastro completo
	if(
		isset($_SESSION['cod_cliente']) &&
		(!isset($_SESSION['data_nasc']) ||  
		$_SESSION['data_nasc'] == "")
	){
		header("Location: /home/cadastroFidelidade.php?codPage=carrinho");
	}


	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">


<head>
	<title>Delion Café - Delivery Foz do Iguaçu | Carrinho</title>
	<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="description" content="Espaço gastronômico casual com produtos seletos de confeitaria, salgados tradicionais e cafés especiais.">
	<meta name="keywords" content="Salgados, Sonhos, Doces, Bolos, Buffet, Almoço, Lanches, Bebidas, Sobremesas, Jantar, Marmita">
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

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/carrinho/style-xs.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/carrinho/style-sm.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/carrinho/style-md.css" />

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/carrinho/style-lg.css" />

	<style>
		.swal-overlay {
            background-color: black;
        }
	</style>
</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

	</div>
	<div class="container itens" id="container-itens">

	<!-- Ajax -->

	</div>

		
	<?php
		include_once "./footer.php";
	?>

	<script>
	

	$(document).on("click", ".editar", function() {
		var obs_id = $(this).data('obsid');
		var obs_txt = $('.observ'+obs_id).data('observacao');

		$('#editar'+obs_id).hide();
		$('#salvar'+obs_id).show();
		$('#obs_desc'+obs_id).hide();
		$('#obs_input'+obs_id).show();
		$('#obs_input'+obs_id).val(obs_txt);
	});

	$(document).on("click", ".salvar", function() {
		var obs_id = $(this).data('obsid');
		var obs_editado = $('#obs_input'+obs_id).val();
		

		$('#salvar'+obs_id).hide();
		$('#editar'+obs_id).show();
		$('#obs_input'+obs_id).hide();
		$('#obs_desc'+obs_id).text(obs_editado);
		$('#obs_desc'+obs_id).show();

		$.ajax({

			type: 'GET',
			url: 'ajax/editar-carrinho.php',
			data: {obs_editado : obs_editado, obs_id: obs_id},
				success:function(resultado){

				}
			});
		
	});


	

	// $(document).ready(function(){
	// 	if(('.obs-input').is(":focus")){
	// 		window.setInterval(function(){
	// 		location.reload();
    //     }, 600000);
	// 	}
	// })


		$(document).ready(function () {
			loadItens();
		});

		function loadItens(){
			$.ajax({
				type: 'GET',
				url: 'ajax/buscar-carrinho.php',
				success: function (resultado) {
					$("#container-itens").html(resultado);
					atualizaFormaPgt();
				},
				error: function(err){
					console.log(err);
				}
			});
		}
		
		//Auto Reload carrinho
		// window.setInterval(function(){
		// 	location.reload();
        // }, 60000);//1 minuto

		window.setInterval(function(){
			$(".tabela_itens tbody").load(window.location.origin+"/home/ajax/buscar-carrinho.php"+" .tabela_itens tbody tr");
			$("#container_subtotal").load(window.location.origin+"/home/ajax/buscar-carrinho.php"+" #container_subtotal > *");
			atualizaFormaPgt();
		}, 5000);

		 

		$(document).on("change", "#formaPagamento", function(){

			var pag = $(this).val();

			$.ajax({
				type: 'POST',
				url: 'ajax/pag-carrinho.php',
				data: {pag:pag},
				success: function (resultado) {
					
				}
			});
		});


		function atualizaFormaPgt(){
			let formaPgtSelect = $("#formaPagamento").val();

			$.ajax({
				type: 'GET',
				url: 'ajax/pag-formaPgt.php',
				success: function (resultado) {
					$("#formaPagamento").html(resultado);
					$("#formaPagamento").val(formaPgtSelect);
					if($("#formaPagamento").val() == null){
						$("#formaPagamento").val(1);
					}
				}
			});
		}

	</script>

</body>

</html>
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

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

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
				},
				error: function(err){
					console.log(err);
				}
			});
		}
		
		//Auto Reload carrinho
		window.setInterval(function(){
			location.reload();
        }, 60000);//1 minuto

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

	</script>

</body>

</html>
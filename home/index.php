<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Delion Café</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
	


	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/index/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/index/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/index/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/index/style-lg.css"/>
	

	
</head>

<body>

<div class="container no-padding">
	<div class="imagens-topo">
			<img class="img-responsive imagem-topo" src="/home/img/topo.png" alt="imagem topo principal">
			<img class="img-responsive imagem-logo" src="/home/img/Logo.png" alt="logo delion cafe">
	</div>
</div>
	

    <div class="form-cep-completo">
		<div class="tabs">
			<ul class="nav nav-tabs navbar-collapse" >
				<li class="delivery" >
					<a href="#">Delivery</a>
				</li>
				<li class="retirada">
					<a href="/../../home/cardapio.php">Ir para loja</a>
				</li>
			</ul>
		</div>
		<div class="form-group form-cep-campos">
			<div class="locationField">
				<span class="fas fa-map-marker-alt"></span>
				<input type="text" class="form-control input-cep" id="autocomplete" placeholder="Digite seu endereço ou CEP" type="text">
				</input>
			</div>
				<div class="buttonField">
					<button class="btn btn-light" data-toggle="modal" data-target="#cepModal" id="localizar">
						LOCALIZAR
					</button>
				</div>
		</div>
	</div>
				
			
	<div class="grid-images row container-fluid">
		
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-14  thumb-home">
				<a class="thumbnail" href="sobre.php">
					<img class="img-responsive" src="/home/img/Quem somos.png" alt="quem somos">
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-14 thumb-home">
				<a class="thumbnail" href="eventos.php">
					<img class="img-responsive" src="/home/img/Eventos.png" alt="Eventos">
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-14 thumb-home">
				<a class="thumbnail" href="#">
					<img class="img-responsive" src="/home/img/Aplicativo.png" alt="Whatsapp">
				</a>
			</div>
	</div>

	

	<footer class=" container footer container-fluid">

	<div class="navbar-social navbar-collapse">
			<a href="facebook.com"><i class="fab fa-facebook"></i></a>
			<a href="instagram.com"><i class="fab fa-instagram"></i></a>
		</div>

		<div class="row left">
			<ul>
				<li>
					<p class="bold-text"><b>Navegue</b></p>
				</li>
				<li>
					<a href="#">Quem Somos</a>
				</li>

				<li>
					<a href="#">Eventos</a>
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
					<a href="#">História</a>
				</li>

				<li>
					<a href="#">Localização</a>
				</li>

				<li>
					<a href="#">Trabalhe Conosco</a>
				</li>
			</ul>
		</div>
		<div class="row right">
		<img class="img-responsive" src="/home/img/logo_branca.png" alt="logo delion branca" style="width:93px;height:140px;">
			
			<div class="endereco-footer">
					<p class="bold-text" style="text-decoration:none;"><b>
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
			
	<?php
		// include_once "./whats-config.php";
		// include_once "./footer.php";
	?>


	<!-- Modal -->
	<div class="modal fade" id="cepModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 style="text-align:center;" class="modal-title" id="myModalLabel">Falta pouco para você ter em sua casa nossas delícias!<br>Complete seu cadastro para ter acesso ao nosso site.</h4>
				</div>
				<div class="modal-body">
					<form id="address-form" method="POST" onsubmit="return false;">
						<div class="row">
							<div class="col-sm-3"> 
								<label>UF</label>
								<input type="text" class="form-control" id="administrative_area_level_1" name="administrative_area_level_1" maxlength="2" required/>
							</div>
							<div class="col-sm-9">
								<label>Cidade</label>
								<input type="text" class="form-control" id="administrative_area_level_2" name="administrative_area_level_2" maxlength="100" required/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>CEP</label>
								<input type="text" class="form-control" id="postal_code" name="postal_code" maxlength="9" required/>
							</div>
							<div class="col-sm-8">
								<label>Bairro</label>
								<input type="text" class="form-control" id="sublocality_level_1" name="sublocality_level_1" maxlength="30" required/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label>Endereço</label>
								<input type="text" class="form-control" id="route" name="route" maxlength="30" required/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>Número</label>
								<input type="text" class="form-control" id="street_number" name="street_number" maxlength="10" required/>
							</div>
							<div class="col-sm-8">
								<label>Complemento</label>
								<input type="text" class="form-control" id="complemento" name="complemento" maxlength="30"/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label>Alguma referência para localização?</label>
								<input type="text" class="form-control" id="referencia" name="referencia" maxlength="40"/>
							</div>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Voltar</button>
							
							<button type="submit" class="btn btn-danger" id="entrar">Entrar no site</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<?php
		// include_once "./footer.php";
	?>

</body>
		
		
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

<script src="./js/google-autocomplete.js."></script>
<script src="./js/google-geolocation.js."></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrg0iCBCR-W5NNqL6IirOTXZ9XcrIH3N0&libraries=places&language=pt-BR&region=BR&callback=initAutocomplete"
async defer></script>


<script>

	$("#cepModal").on("shown.bs.modal", function () {
		$("#street_number").focus();
	});

	//redireciona para cardapio
	$(document).on("click","#entrar", function(){
		entrar();
	});

	function entrar(){
		var data = $("#address-form").serializeArray();
		
		//verifica se campos estão preenchidos
		if(data[0].value == "") return;//uf
		if(data[1].value == "") return;//cidade		
		if(data[2].value == "") return;//cep
		if(data[3].value == "") return;//bairro
		if(data[4].value == "") return;//endereço
		if(data[5].value == ""){//numero
			return;
		}else{

			$.post({
				url: "ajax/endereco-index.php",
				data: data,
				success: function(result){
					console.log(result);
					if(result == "valido"){
						//redireciona para cardapio
						window.location = "/home/cardapio.php";
					}else{
						//swal("Ops", result , "error");
						console.log("Ops tente novamente...");
					}
				},
				error: function(err){
					console.log(err);
					//swal("Erro :/", "Entre em contato com o suporte." , "error");
				}
			});
		}
	}

</script>

</html>


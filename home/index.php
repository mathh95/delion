<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Delion Café</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
	

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/index/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/index/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/index/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/index/style-lg.css"/>
	

	
</head>

<body>

<div class="container-fluid no-padding">
	<div class=" imagens-topo">
			<img class="img-responsive imagem-topo" src="/home/img/topo.png" alt="imagem topo principal">
			<img class="img-responsive imagem-logo" src="/home/img/Logo.png" alt="logo delion cafe">
	</div>
</div>
	

    <div class="form-cep-completo">
		<div class="tabs">
			<ul class="nav nav-tabs" >
				<li class="delivery" >
					<a href="#">Delivery</a>
				</li>
				<li class="retirada">
					<a href="/../../home/cardapio.php">Retirada na loja</a>
				</li>
			</ul>
		</div>
		<div class="form-cep-campos">
			<div class="locationField">
				<input type="text" class="form-control input-cep" id="autocomplete" placeholder="Digite seu endereço ou CEP" type="text" size="57">
					<!-- <i class="fas fa-map-marker-alt"></i> -->
					<!-- <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> -->
				</input>
			</div>
				<div class="buttonField">
					<button type="button" class="btn btn-light" onclick="getLocation()">
						LOCALIZAR
					</button>
			</div>
		</div>
	</div>
				
			
	<div class="grid-images row container-fluid">
		
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  thumb-home">
				<a class="thumbnail" href="#">
					<img class="img-responsive" src="/home/img/Quem somos.png" alt="quem somos">
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 thumb-home">
				<a class="thumbnail" href="#">
					<img class="img-responsive" src="/home/img/Eventos.png" alt="Eventos">
				</a>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 thumb-home">
				<a class="thumbnail" href="#">
					<img class="img-responsive" src="/home/img/Aplicativo.png" alt="Whatsapp">
				</a>
			</div>
	</div>

	<div class="navbar-social">
		<a href="facebook.com"><i class="fa fa-facebook"></i></a>
		<a href="instagram.com"><i class="fa fa-instagram"></i></a>
	</div>

	<div class="footer container-fluid">
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
			<img src="/home/img/Logo_site.png" alt="logo delion branca" style="width:230px;height:120px;">
			<div class="endereco-footer">
				<p class="bold-text"><b>Rua Jorge Sanwais, 1137</b></p>
				<p class="bold-text"><b>Centro</b></p>
				<p class="bold-text"><b>Foz do Iguaçu - Paraná</b></p>
				<p class="bold-text"><b>Rua Jorge Sanwais, 1137</b></p>
				<p class="bold-text"><b>CEP: 85851-150</b></p>
			</div>
			
			
			
		</div>

	</div>
			
	<?php
		//include_once "./footer.php";
	?>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 style="text-align:center;" class="modal-title" id="myModalLabel">Falta pouco para você ter em sua casa nossas delícias!<br>Complete seu cadastro para ter acesso ao nosso site.</h4>
				</div>
				<div class="modal-body">
					<form id="address">
						<div class="row">
							<div class="col-sm-3">
								<label>UF</label>
								<input type="text" class="form-control" id="administrative_area_level_1" required/>
							</div>
							<div class="col-sm-9">
								<label>Cidade</label>
								<input type="text" class="form-control" id="administrative_area_level_2" required/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>CEP</label>
								<input type="text" class="form-control" id="postal_code" required/>
							</div>
							<div class="col-sm-8">
								<label>Bairro</label>
								<input type="text" class="form-control" id="sublocality_level_1" required/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label>Endereço</label>
								<input type="text" class="form-control" id="route" required/>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>Número</label>
								<input type="text" class="form-control" id="street_number" required/>
							</div>
							<div class="col-sm-8">
								<label>Complemento</label>
								<input type="text" class="form-control" id="sublocality_level_1" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label>Alguma referência para localização?</label>
								<input type="text" class="form-control" id="complemento" />
							</div>
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
							
							<button type="submit" class="btn btn-primary" id="entrar">Entrar no site</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

</body>
		
		
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

<script src="./js/google-autocomplete.js."></script>
<script src="./js/google-geolocation.js."></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAS7HedlAWWAMuzXlS8boXxNIC5RJFUH-A&libraries=places&callback=initAutocomplete"
async defer></script>


<script>

	$('#myModal').on('shown.bs.modal', function () {
		$('#street_number').focus();
	});

</script>

</html>


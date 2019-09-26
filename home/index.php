<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Delion Café</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>

	<div></div>

    <div style="margin: auto; margin-top:300px; width:50%;">
		
		<div>
			<div id="locationField" style="display:inline-block;">
				<input type="text" class="form-control" id="autocomplete" placeholder="Digite seu endereço ou CEP" type="text" size="45"/>
			</div>
			<div  style="display:inline-block;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					<span>Continuar</span>
				</div>
				<div style="display:inline-block;">
					<button type="button" class="btn btn-success" onclick="getLocation()">
						<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
						Me Localizar
					</button>
				</div>
			</div>
		</div>
				
			
	<div></div>
			
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
				<form>
					<div id="address">
						<div class="row">
							<div class="col-sm-3">
								<label>UF</label>
								<input type="text" class="form-control" id="administrative_area_level_1" />
							</div>
							<div class="col-sm-9">
								<label>Cidade</label>
								<input type="text" class="form-control" id="administrative_area_level_2" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>CEP</label>
								<input type="text" class="form-control" id="postal_code" />
							</div>
							<div class="col-sm-8">
								<label>Bairro</label>
								<input type="text" class="form-control" id="sublocality_level_1" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label>Endereço</label>
								<input type="text" class="form-control" id="route" />
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								<label>Número</label>
								<input type="text" class="form-control" id="street_number" />
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
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
					<button type="button" class="btn btn-primary" id="entrar">Entrar no site</button>
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


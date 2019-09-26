<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Delion Café</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='main.css'>
</head>

<body>

	<div></div>

    <div>
		
		<div>
			<div id="locationField" style="display:inline-block;">
				<input id="autocomplete" placeholder="Digite seu endereço ou CEP" type="text" size="60"/>
			</div>
			<div  style="display:inline-block;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					<span>Continuar</span>
				</div>
				<div style="display:inline-block;">
					<button type="button" class="btn btn-success" onclick="getLocation()">
						<span>Me Localizar</span>
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
					<h4 class="modal-title" id="myModalLabel">Modal title</h4>
				</div>
				<div class="modal-body">
					<div id="address">
						<div>
							<div class="label">UF</div>
							<div class="slimField"><input class="field" id="administrative_area_level_1" /></div>
							
							<div class="label">Cidade</div>
							<div class="wideField" colspan="3"><input class="field" id="administrative_area_level_2" /></div>
							
						</div>
						<div>
							<div class="label">CEP</div>
							<div class="wideField"><input class="field" id="postal_code" /></div>
							
							<div class="label">Bairro</div>
							<div class="wideField"><input class="field" id="sublocality_level_1" /></div>
							
						</div>
						<div>
							<div class="label">Endereço</div>
							<div class="wideField" colspan="6"><input class="field" id="route" /></div>
						</div>
						<div>        
							<div class="slimField">Nº<input class="field" id="street_number" /></div>
							
							<div class="slimField">
								Complemento
								<input class="field" />
							</div>
							
						</div>
						
						<div>
							<div class="label">Seria legal se Ref</div>
							<div class="wideField" colspan="6"><input class="field" /></div>
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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAS7HedlAWWAMuzXlS8boXxNIC5RJFUH-A&libraries=places&callback=initAutocomplete"
async defer></script>


<script>

	$('#myModal').on('shown.bs.modal', function () {
		$('sublocality_level_1').focus();
	});

</script>

</html>


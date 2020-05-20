<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	session_start();

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "controler/controlImagem.php";
	

	//configuração de acesso ao WhatsApp
	//include "./whats-config.php";
	
	// $codPage = $_GET['codPage'];

	//Verifica se usuário já habilidato para o Programa
	if($_SESSION['data_nasc'] != "") header("Location: /home/resgateFidelidade.php");
	//var_dump($_SESSION);


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

	<div class="container cliente">

		<div class="solicitacao">

			<form method="POST" id="cadastro-fidelidade-form" onsubmit="return false;" >
				
				<h4> Complete seu Cadastro! E obtenha vantagens <i class='far fa-gem'></i></h4>

    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>CPF*</p>

        			<input class="form-control cpf" name="cpf" type="text" minlength="11" maxlength="14" required placeholder="999.999.999-99">

				</div>

    			<div class="col-md-12 col-sm-12 col-xs-12">

					<p>Data Nascimento*</p>

					<?php
						$current = date("Y-m-d");
						$min = date('Y-m-d', strtotime($current.'-100 year'));
						$max = date('Y-m-d', strtotime($current.'-12 year'));

						echo '
						<input class="form-control data_nasc" name="data_nasc" type="date" minlength="8" maxlength="10" min="'.$min.'" max="'.$max.'" required>
						';
					?>

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					
					<p>Celular*</p>

					<input class="form-control telefone" name="telefone" type="text" minlength="15" maxlength="15" required placeholder="(45) 9 9999-9999">

				</div>
				
				<div class="col-md-12 col-sm-12 col-xs-12">

					<button type="submit" id="cadastrar">CADASTRAR</button>
					
				</div>

			</form>

		</div>

	</div>

	

	

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script>


	<script>

	//Cadastro Cliente
	$("#cadastrar").on("click", function(){

		var data = $('#cadastro-fidelidade-form').serializeArray();
		
		//verifica se campos estão preenchidos
		if(data[0].value == ""){
			return;
		}else if(data[1].value == ""){
			return;
		}else if(data[2].value == ""){
			return;
		}else{
			verificaCadastro(data);
		}
	});

	//Insere cliente após verificação de dados e SMS
	function verificaCadastro(data){
		$.post({
			url: 'controler/finalizarCadastroCliente.php?verificacaoCadastro=true',
			data: data,
			success: function(resultado){

				if(resultado.includes("verificado")){
				
					getCodigoSms(data);

				}else{
					swal("Erro ao completar o cadastro 😕", resultado , "error");
				}
			},
			error: function(resultado){
				console.log(resultado);
				swal("Erro 😕", "Entre em contato com o suporte." , "error");
			}
		});
	}

	function getCodigoSms(data){
		swal({
			title: 'SMS Enviado!',
			text: 'Insira o código recebido abaixo.',
			content: "input",
			button: 'Prosseguir'
		})
		.then(cod_sms => {
			if (!cod_sms) throw null;
			if (cod_sms.length < 4){
				swal("Código inválido!", "warning");
			}else{
				//adiciona token ao array POST
				data.push({name: "codigo_sms", value: cod_sms});
				inserirCliente(data);
			}
		})
		.catch(err => {
			console.log(err);
			if (err) {
				swal("Erro 😕 código inválido", err , "error");
			} else {
				swal.stopLoading();
				swal.close();
			}
		});
	}

	function inserirCliente(data){
		$.post({
			url: 'controler/finalizarCadastroCliente.php?verificacaoSMS=true',
			data: data,
			success: function(resultado){
				console.log(resultado);
				if(resultado.includes("atualizado")){
					swal({
						title: 'Cadastrado!',
						text: 'Aproveite! 😄.',
						icon: "success",
						timer: 1000
					})
					.then(value => {
						if(getParams(window.location.href)["codPage"] == "carrinho"){
							window.location = "/home/carrinho.php";
						}else{
							window.location = "/home/resgateFidelidade.php";
						}
					});

				}else{
					swal("Erro 😕", resultado , "error");
				}
			},
			error: function(resultado){
				console.log(resultado);
				swal("Erro 😕", "Entre em contato com o suporte." , "error");
			}
		});
	}

	$(document).ready(function(){
		$(".cpf").mask("999.999.999-99");
		$(".telefone").mask("(45) 99999-9999");
	});

	

	/**
	 * Get the URL parameters
	 * source: https://css-tricks.com/snippets/javascript/get-url-variables/
	 * @param  {String} url The URL
	 * @return {Object}     The URL parameters
	 */
		var getParams = function (url) {
			var params = {};
			var parser = document.createElement('a');
			parser.href = url;
			var query = parser.search.substring(1);
			var vars = query.split('&');
			for (var i = 0; i < vars.length; i++) {
				var pair = vars[i].split('=');
				params[pair[0]] = decodeURIComponent(pair[1]);
			}
			return params;
		};
		
		// console.log(getParams(window.location.href)["codPage"]);


	</script>

</body>

</html>
<?php 
	
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

	session_start();

	include_once "../admin/controler/conexao.php";
	include_once "controler/controlEmpresa.php";
	include_once "controler/controlImagem.php";

	//configuração de acesso ao WhatsApp
	//include "./whats-config.php";

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
				
				<p><i class='far fa-gem'></i> Programa Fidelidade</p>
				<h4>Complete o Cadastro e aproveite!</h4>

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
	<script type="text/javascript" src="js/maskedinput.js"></script>

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
			atualizarCliente(data);
		}
	});

	//Insere cliente após verificação de dados e SMS
	function atualizarCliente(data){

		$.post({
			url: 'controler/finalizarCadastroCliente.php',
			data: data,
			success: function(res){
				if(res.includes("atualizado")){
					swal({
						title: 'Cadastrado!',
						text: 'Aproveite! :).',
						icon: "success",
						timer: 1000
					})
					.then(value => {
						window.location = "/home/resgateFidelidade.php";
					});

				}else{
					swal("Erro :/", res , "error");
				}
			},
			error: function(res){
				console.log(res);
				swal("Erro :/", "Entre em contato com o suporte." , "error");
			}
		});
	}

	$(document).ready(function(){
		$(".cpf").mask("999.999.999-99");
		// $(".telefone").mask("(45) 99999-9999)");
	});

	$("input.telefone").mask("(99) ?9 9999-9999").focusout(function (event) {  

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

	</script>

</body>

</html>
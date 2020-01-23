<?php 

	session_start();

	include_once "../admin/controler/conexao.php";

    include_once "controler/controlEmpresa.php";

    $controleEmpresa=new controlerEmpresa(conecta()); 

    $empresa = $controleEmpresa->select(1,2);

	//configuração de acesso ao WhatsApp 
	//include "./whats-config.php";

?>

<!DOCTYPE html>

<html lang="pt-br">

<?php
	include_once "./head.php";
?>

<head>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/endereco/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/endereco/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/endereco/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/endereco/style-lg.css"/>

</head>

<body>

	<?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>

    <div class="container endereco">

        <div class="lista">
            
        </div>                     
            
        <div class="opcoes">

            <div>
                <p>Opções</p>
            </div>	
            <div>
                <button onclick="cadastrarEndereco()">CADASTRAR NOVO ENDEREÇO</button>
            </div> 
	
            <div class="listar">
			
            </div>

        </div>

    </div>

	<?php
		include_once "./footer.php";
	?>

	<script type="text/javascript" src="js/wickedpicker.js"></script>
	<script type="text/javascript" src="js/maskedinput.js"></script>

	<script type="text/javascript" src="js/buscar-endereco.js"></script>
	<script> 
		var flag_selecionar = '<?=isset($_GET['is_selecao_end']) ? $_GET['is_selecao_end'] : 0 ?>';
		loadEnderecos(flag_selecionar);
	</script>

	<script>

		$(".navbar-toggle li a").click(function() {
			if ( !$(this).parent().hasClass('dropdown') ) {
				$(".navbar-collapse").collapse('hide');
			}
		});

	</script>

</body>

</html>
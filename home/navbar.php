<?php

include_once CONTROLLERPATH."/controlerGerenciaSite.php";
include_once MODELPATH."/gerencia_site.php";
?>

<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/navbar/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/navbar/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/navbar/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/navbar/style-lg.css"/>

	<script data-ad-client="ca-pub-9260777931961803" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<?php 
    $controle=new controlerGerenciarSite($_SG['link']);
    $config = $controle->selectConfigValida();
	$status = $config->getFlag_ativo();

		if(empty($status)){
			$corSec = "#C6151F";
		}else{
			$corSec = $config->getCorSecundaria();
		}

?>
<div id="navegacao" style="background: <?= $corSec?>" >

	<div class="container">

		<div id="navegacao__content">

			<nav class="navbar navbar-default" style="background: <?= $corSec?>">

		  		<div class="container-fluid">

				<!-- Brand and toggle get grouped for better mobile display -->	

				    <div class="navbar-header">

						<p>Menu</p>

					    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">

					        <span class="sr-only">Toggle navigation</span>

					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>

				      	</button>

				    </div>

				<!-- Collect the nav links, forms, and other content for toggling -->	

			    	<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">

				    	<ul class="nav navbar-nav">

				        	<!-- <li><a href="index.php"><img src="img/home.png"><span class="sr-only">(current)</span></a></li> -->

				        	<!-- <li><a href="sobre.php">Sobre</a></li> -->

				        	<!-- <li><a href="historia.php">História</a></li> -->
							
				        	<li><a href="cardapio.php"><i class="fas fa-book-open"></i>&nbsp;Cardápio</a></li>

				        	<!-- <li><a href="contato.php">Contato</a></li> -->

							<li><a href="localizacao.php"><i class="fas fa-map-marked-alt"></i>&nbsp;Localização</a></li>


							<?php

							if(isset($_SESSION['cod_cliente'])){
								
								if($_SESSION['data_nasc'] == ""){
									echo "<li><a href='cadastroFidelidade.php'><i class='far fa-gem'></i>&nbsp;Fidelidade</a></li>";
								}else{
									echo "<li><a href='resgateFidelidade.php'><i class='far fa-gem'></i>&nbsp;Fidelidade</a></li>";
								}
								
								echo "<li><a href='cliente.php'><i class='fas fa-user-cog'></i> ".$_SESSION['nome']."</a></li>";


								//<i class="fas fa-bullhorn"></i>

								echo "<li><a href='#' onclick='deslogar()'><i class='fas fa-sign-out-alt'></i>&nbsp;Logout</a></li>";

							}else{
								echo "<li><a href='login.php' ><i class='fas fa-user'></i>&nbsp;Login</a></li>";
							}

							?>

							<li><a  data-toggle="tooltip" title="Carrinho." href="carrinho.php"><i style=" font-size: 17px;"class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
							<span style="background-color: white; color:black;" class="badge" id="spanCarrinho-navbar">
								<?php
									$qtd = (isset($_SESSION['carrinho']))?count($_SESSION['carrinho']): 0;
									$qtd += (isset($_SESSION['carrinho_resgate']))?count($_SESSION['carrinho_resgate']): 0;
									
									echo $qtd;
								?>
							</span></a></li>

				   		</ul>
   		
			    	</div><!-- /.navbar-collapse -->

			  	</div><!-- /.container-fluid -->

			</nav>	

		</div>

	</div>

</div>
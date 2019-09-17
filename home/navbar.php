<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/navbar/xs/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/navbar/sm/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/navbar/md/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/navbar/lg/style-lg.css"/>
</head>

<div id="navegacao">

	<div class="container">

		<div id="navegacao__content">

			<nav class="navbar navbar-default">

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

				        	<li><a href="index.php"><img src="img/home.png"><span class="sr-only">(current)</span></a></li>

				        	<li><a href="sobre.php">Sobre</a></li>

				        	<li><a href="historia.php">História</a></li>

				        	<li><a href="cardapio.php">Cardápio</a></li>

				        	<li><a href="contato.php">Contato</a></li>

							<li><a href="localizacao.php">Localização</a></li>

							<li class="active"><a data-toggle="tooltip" title="Carrinho." href="carrinho.php"><i style="color:white;" class="fas fa-shopping-cart fa-lg"></i> <span style="background-color:white; color:black;" class="badge" id="spanCarrinho"><?php echo (isset($_SESSION['carrinho']))?count($_SESSION['carrinho']):'0';?></span></a></li>

							<li><a href="combo.php">Combo <i style="color:white;" class="fas fa-plus fa-sm"></i> por <i style="color:white;" class="fas fa-minus fa-sm"></i> <span style="background-color:white; color:black;" class="badge" id="spanCombo"><?php echo (isset($_SESSION['combo']))?count($_SESSION['combo']):'0';?></span></a></li>

							<?php
							//signOut oauth
							if(isset($_SESSION['cod_cliente']) && !isset($_SESSION['telefone'])){
								
								echo "<li><a href=" .'cliente.php'."><i class='fas fa-user-cog'></i> ".$_SESSION['nome']."</a></li>";

								echo "<li><a href='#' onclick='signOut()'><i class='fas fa-sign-out-alt'></i>&nbsp;Logout</a></li>";

							}else if(isset($_SESSION['cod_cliente'])){

								echo "<li><a href=" .'cliente.php'."><i class='fas fa-user-cog'></i> ".$_SESSION['nome']."</a></li>";

								echo "<li><a href='#' onclick='deslogar()'><i class='fas fa-sign-out-alt'></i>&nbsp;Logout</a></li>";

							}else{
								echo "<li><a href=" . 'login.php' . "><i class='fas fa-user'></i>&nbsp;Login</a></li>";
							}

							?>

				   		</ul>

				   		<form method="GET" action="cardapio.php" class="navbar-form navbar-right hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

				   			 <div class="input-group">

					        	<input type="text" class="form-control" name="search">

				                <span class="input-group-btn">

				                    <button class="btn btn-default" type="submit">Buscar</button>

				                </span>

				   			</div>

				      	</form>

			    	</div><!-- /.navbar-collapse -->

			  	</div><!-- /.container-fluid -->

			</nav>	

		</div>

	</div>

</div>
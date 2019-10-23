<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/header/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/header/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/header/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/header/style-lg.css"/>
</head>

<header class="container-fluid">

    <div class="container">

        <div class="logo">
        

            <a href="index.php"><img src="/home/img/logo_branca.png"></a>


        </div>
        <form method="GET" action="cardapio.php" class=" navbar-form navbar-center hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

				<div class="input-group">

					<input type="text" class="form-control" name="search">

				        <span class="input-group-btn">

				        <button class="btn btn-default" type="submit">Buscar</button>

				    </span>

				</div>

		</form>

        <div class="infos">

            <div>
                <p class="semana"><i class="far fa-calendar-alt"></i>&nbsp;Segunda a Sexta <br>
                <i class="fas fa-clock"></i>&nbsp;10:00h às 21:00h</p>
                <p class="fim-semana"><i class="far fa-calendar-alt"></i>&nbsp;Aos Sábados <br>
                <i class="fas fa-clock"></i>&nbsp;08:30h  às 19:00h</p>
            </div>
            

        </div>
        <li class="active carrinho">
                    <a data-toggle="tooltip" title="Carrinho." href="carrinho.php">
                        <i style="color:white;" class="fas fa-shopping-cart fa-lg"></i> 
                        <span style="background-color:white; color:black;" class="badge" id="spanCarrinho"><?php echo (isset($_SESSION['carrinho']))?count($_SESSION['carrinho']):'0';?></span>
                    </a>
            </li>
        
            
        

    </div>

</header>
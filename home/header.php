<head>
	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/header/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/header/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/header/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/header/style-lg.css"/>
</head>

<header class="container-fluid">

    <div class="container">

        <div class="logo">
        

            <a href="/"><img src="<?= "../admin/".$empresa->getFoto(); ?>"></a>


        </div>

        <div class="infos">

            <div>
                <p><i class="far fa-calendar-alt"></i>&nbsp;Segunda a Sexta <br>
                <i class="fas fa-clock"></i>&nbsp;10:00h às 21:00h</p>
                <p><i class="far fa-calendar-alt"></i>&nbsp;Aos Sábados <br>
                <i class="fas fa-clock"></i>&nbsp;08:30h  às 19:00h</p>
            </div>

            <!-- <div>Segunda a Sábado</div>

            <div>Das 07:00 Hs as 20:00 Hs</div> -->

            <div class="delivery">

                <div>

                    <img src="img/moto.png">

                    <a href="cardapio.php"><button id="btn-pedir">PEDIR</button></a>

                </div>

            </div>

        </div>

    </div>

</header>
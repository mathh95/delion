<?php
    include_once "./controler/controlEmpresa.php";
    include_once "./configuracaoCores.php";
?>
<head>
    <meta charset="utf-8">

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/header/style-xs.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/header/style-sm.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/header/style-md.css"/>

	<link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/header/style-lg.css"/>
</head>

<header class="container-fluid" style="background-color: <?= $corPrim ?>">

    <div class="container">

        <div class="logo">

            <a href="index.php"><img src="/home/img/Logo.png"></a>

        </div>
        
        <form method="GET" action="cardapio.php" class=" navbar-form navbar-center hidden-xs visible-sm-* visible-md-* visible-lg-* visible-xl-*">

				<!-- <div class="input-group">
                    <span><i class="glyphicon glyphicon-search"></i></span>
                    <input type="text" class="form-control" name="search" placeholder="Pesquise aqui...">
				</div> -->

		</form>

        <div class="infos">
            <?php
                $controleEmpresa=new controlerEmpresa(conecta());
                $empresa = $controleEmpresa->select(1,2);
            ?>
            <div>
                <p class="semana">
                    <?php
                        if(strlen($empresa->getTxtDiasSemana()) > 1)
                            echo '<i class="far fa-calendar-alt"></i>&nbsp;'. $empresa->getTxtDiasSemana().'<br>';
                            
                        if(strlen($empresa->getTxtHorarioSemana()) > 1 )
                            echo '<i class="fas fa-clock"></i>&nbsp;'.$empresa->getTxtHorarioSemana().'</p>';
                            
                        if(strlen($empresa->getTxtDiasFimSemana()) > 1 )
                            echo '<p class="fim-semana"><i class="far fa-calendar-alt"></i>&nbsp;'.$empresa->getTxtDiasFimSemana().'<br>';
                            
                        if(strlen($empresa->getTxtHorarioFimSemana()) > 1 )
                            echo '<i class="fas fa-clock"></i>&nbsp;'. $empresa->getTxtHorarioFimSemana().'</p>';
                        
                    ?>
            </div>
            

        </div>
        <div class="active carrinho">
            <a data-toggle="tooltip" title="Carrinho." href="carrinho.php" style="border-bottom: 4px solid <?= $corSec?>;">
            
                <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
                <!-- <i style="color:white;" class="fas fa-shopping-cart fa-lg"></i>  -->

                <span style="background-color:white; color:black;" class="badge" id="spanCarrinho">
                    <?php
                        $qtd = (isset($_SESSION['carrinho']))?count($_SESSION['carrinho']): 0;
                        $qtd += (isset($_SESSION['carrinho_resgate']))?count($_SESSION['carrinho_resgate']): 0;
                        
                        echo $qtd;
                    ?>
                </span>
            </a>
        </div>     

    </div>

    <?php
        /* Funcionamento */

        date_default_timezone_set('America/Sao_Paulo');

        include_once "controler/FuncionamentoEmpresa.php";
        $funcionamentoEmpresa = new FuncionamentoEmpresa();

        if(!$funcionamentoEmpresa->aberto()){
            echo '<p id="msg-funcionamento"> Estamos Fechados! <i class="far fa-surprise"></i></p>';

        }else if(!$empresa->getEntregando()){
            echo '<p id="msg-funcionamento"> Não estamos Entregando! <i class="far fa-surprise"></i></p>';
        }
        
    ?>
    <?php 
        echo '<script>
            const corPrimaria = "'.$corPrim.'";
            const corSecundaria = "'.$corSec.'";
        </script>';
    ?>
</header>
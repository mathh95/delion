<?php
    session_start();

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/seguranca.php";
    include_once "../admin/controler/conexao.php";
    include_once "controler/controlEmpresa.php";
    include_once "controler/controlBanner.php";
    include_once "controler/controlImagem.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina("cross_call");

    $controleEmpresa=new controlerEmpresa(conecta());
    $empresa = $controleEmpresa->select(1,2);

    $controleBanner=new controlerBanner(conecta());
    $miniBanners = $controleBanner->selectAllMini();
    $banners = $controleBanner->selectAll();

    $controleImagem=new controlerImagem(conecta());
    $imagens = $controleImagem->selectAll();

    //configuração de acesso ao WhatsApp 
    include "./whats-config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Programa de Fidelidade - Delion Café</title>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/fidelidade/style-xs.css"/>

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/fidelidade/style-sm.css"/>

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/fidelidade/style-md.css"/>

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/fidelidade/style-lg.css"/>

</head>
<body>
    <header class="container-fluid">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="/home/img/Logo.png"></a>
            </div>
            <div class="voltar">
                <a href="#">< Voltar</a>
            </div>
        </div>
    </header>


    <div class="container-fluid banner-red">
        <div class="container">
            <div class="col-sm-6 text-center top-banner-red">
                <div class="col-sm-12 container-title-logo">
                    <div class="col-sm-7">
                        <h1>Programa fidelidade</h1>
                    </div>
                    <div class="col-sm-2">
                        <img id="logo" src="/home/img/Logo.png">
                    </div>
                    
                </div>
                <div class="col-sm-12">
                    <p style="font-size:24px;">Aqui suas compras viram pontos, e seus pontos viram brindes deliciosos.</p>
                    <img class="ponto_fidelidade" src="/home/img/fidelidade_pontos.png">
                    <p>A cada R$1,00 em compras você acumula 1 ponto.</p>
                    <button type="button" class="btn btn-success">FAÇA PARTE</button>
                </div>
                

                
            </div>
        </div>
    </div>

    <div class="container-fluid vantagens">
        <div class="container">
            <h2 class="title-center">Vantagens exclusivas para você.</h2>


            <div class="lista-vantagens">

                <div class="item-vantagem">
                    <div class="img-wrapper">
                        <img src="/home/img/aniversario.png" alt="aniversario">
                    </div>
                    <div class="descricao">
                        Surpresa no seu aniversário
                    </div>
                </div>

                <div class="item-vantagem">
                    <div class="img-wrapper">
                        <img src="/home/img/descontos.png" alt="descontos">
                    </div>
                    <div class="descricao">
                        Promoções e cupons de desconto específicos só para você
                    </div>
                </div>

                <div class="item-vantagem">
                    <div class="img-wrapper">
                        <img src="/home/img/50pontos.png" alt="pontos">
                    </div>
                    <div class="descricao">
                        No cadastro ao programa você já sai ganhando
                    </div>
                </div>
            </div>

            <div class="subtitulo-vantagens">
                    Troque seus pontos por prêmios<br>
                    E muito mais.
             </div>
        </div>

    </div>

    <div class="container-fluid banner-red pre-premios">
        <div class="container">
            <div class="img-wrapper col-sm-6">
                <img src="/home/img/img-cardapio.png" alt="cardapio">
            </div>
            <div class=" col-sm-6">
                <h1 class="titulo-premios">
                    CONFIRA OS PRÊMIOS QUE VOCÊ PODE GANHAR
                </h1>
            </div>
        </div>

    </div>

    <div class=" container-fluid programa-pontos">
        <div class="container">
            <div class="titulo-pontos">
                CLIQUE NOS BOTÕES PARA VER
            </div>

            <div class="btn-wrapper btn-toolbar">
                <button class="30pts" type="button" class="btn btn-warning">
                    <span>30</span>
                    pontos
                </button>

                <button class="50pts" type="button" class="btn btn-warning">
                    <span>50</span>
                    pontos
                </button>

                <button class="80pts" type="button" class="btn btn-warning">
                    <span>80</span>
                    pontos
                </button >

                <button class="90pts" type="button" class="btn btn-warning">
                    <span>90</span>
                    pontos
                </button>

                <button class="120pts" type="button" class="btn btn-warning">
                    <span>120</span>
                    pontos
                </button>

                <button class="200pts" type="button" class="btn btn-warning">
                    <span>200</span>
                    pontos
                </button>

                <button class="220pts" type="button" class="btn btn-warning">
                    <span>220</span>
                    pontos
                </button>

                <button class="250pts" type="button" class="btn btn-warning">
                    <span>250</span>
                    pontos
                </button>
            </div>

            <div class="produtos-pontos produto-30pts" style="display: none;">

                <!-- Produtos botao 30 pontos -->
                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE AAA123123</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE AAA123123</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE AAA123123</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE AAA123123</h2>
                </div>

            </div>
            
            <div class="produtos-pontos produto-50pts" style="display: none;">

                 <!-- Produtos botao 50 pontos -->

                 <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 2</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 2</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 2</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 2</h2>
                </div>

            </div>

            <div class="produtos-pontos produto-80pts" style="display: none;">

                 <!-- Produtos botao 80 pontos -->

                 <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 80</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 80</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 80</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 80</h2>
                </div>

            </div>

            <div class="produtos-pontos produto-90pts" style="display: none;">

                <!-- Produtos botao 90 pontos -->

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 90</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 90</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 90</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 90</h2>
                </div>

            </div>

            <div class="produtos-pontos produto-120pts" style="display: none;">

                <!-- Produtos botao 120 pontos -->

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 120</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 120</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 120</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 120</h2>
                </div>

            </div>

            <div class="produtos-pontos produto-200pts" style="display: none;">

                <!-- Produtos botao 200 pontos -->

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 200</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 200</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 200</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 200</h2>
                </div>

            </div>
            
            <div class="produtos-pontos produto-220pts" style="display:none;">
                <!-- Produtos botao 220 pontos -->

                <div class="produto" >
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 220</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 220</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 220</h2>
                </div>

                <div class="produto">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 220</h2>
                </div>

            </div>

            <div class="produtos-pontos produto-250pts" style="display:none;">
                <!-- Produtos botao 250 pontos -->

                <div class="produto ">
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 250</h2>
                </div>

                <div class="produto " >
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 250</h2>
                </div>

                <div class="produto" >
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 250</h2>
                </div>

                <div class="produto " >
                    <img src="/home/img/torta.png" alt="torta">
                    <h2>TORTA TESTE 250</h2>
                </div>

            </div>

        </div>
    </div>

    <div class="container-fluid funcionamento-programa">
        <div class="container">
            <div class="titulo-funcionamento">
                Como funciona
            </div>

            <div class="lista-regras">
                <div class="item">
                    <div class="icone-wrapper">
                        <div class="desc">
                            <div class="titulo-desc">
                                1º Passo:
                            </div>
                                Cadastre-se no<br>
                                Programa<br>
                                fidelidade através<br>
                                do site.
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="icone-wrapper">
                        <div class="desc">
                            <div class="titulo-desc">
                                2º Passo:
                            </div>
                            Faça o seu pedido<br>
                            em nosso site.<br>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="icone-wrapper">
                        <div class="desc">
                            <div class="titulo-desc">
                                3º Passo:
                            </div>
                            A cada R$ 1,00<br>
                            em compas<br>
                            você ganha 1<br>
                            ponto.
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="icone-wrapper">
                        <div class="desc">
                            <div class="titulo-desc">
                                4º Passo:
                            </div>
                            Acumule pontos<br>
                            e resgate pelos<br>
                            brindes<br>
                            disponíveis<br>
                            em nosso<br>
                            catálogo.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<?php
	include_once "./footer.php";
?>

<script>
        $(document).ready(function() {

    
            $('.30pts').click(function() {
                if($('.produto-50pts').is(":hidden") && $('.produto-80pts').is(":hidden") 
                    && $('.produto-90pts').is(":hidden") && $('.produto-120pts').is(":hidden") 
                    && $('.produto-200pts').is(":hidden") && $('.produto-220pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-30pts').slideToggle("slow");
                } 
            });

            $('.50pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-80pts').is(":hidden") 
                    && $('.produto-90pts').is(":hidden") && $('.produto-120pts').is(":hidden") 
                    && $('.produto-200pts').is(":hidden") && $('.produto-220pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-50pts').slideToggle("slow");
                } 
            });

            $('.80pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-50pts').is(":hidden") 
                    && $('.produto-90pts').is(":hidden") && $('.produto-120pts').is(":hidden") 
                    && $('.produto-200pts').is(":hidden") && $('.produto-220pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-80pts').slideToggle("slow");
                } 
            });

            $('.90pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-50pts').is(":hidden") 
                    && $('.produto-80pts').is(":hidden") && $('.produto-120pts').is(":hidden") 
                    && $('.produto-200pts').is(":hidden") && $('.produto-220pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-90pts').slideToggle("slow");
                } 
            });

            $('.120pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-50pts').is(":hidden") 
                    && $('.produto-80pts').is(":hidden") && $('.produto-90pts').is(":hidden") 
                    && $('.produto-200pts').is(":hidden") && $('.produto-220pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-120pts').slideToggle("slow");
                } 
            });

            $('.200pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-50pts').is(":hidden") 
                    && $('.produto-80pts').is(":hidden") && $('.produto-90pts').is(":hidden") 
                    && $('.produto-120pts').is(":hidden") && $('.produto-220pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-200pts').slideToggle("slow");
                } 
            });

            $('.220pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-50pts').is(":hidden") 
                    && $('.produto-80pts').is(":hidden") && $('.produto-90pts').is(":hidden") 
                    && $('.produto-120pts').is(":hidden") && $('.produto-200pts').is(":hidden") 
                    && $('.produto-250pts').is(":hidden") ){
                        $('.produto-220pts').slideToggle("slow");
                } 
            });

            $('.250pts').click(function() {
                if($('.produto-30pts').is(":hidden") && $('.produto-50pts').is(":hidden") 
                    && $('.produto-80pts').is(":hidden") && $('.produto-90pts').is(":hidden") 
                    && $('.produto-120pts').is(":hidden") && $('.produto-200pts').is(":hidden") 
                    && $('.produto-220pts').is(":hidden") ){
                        $('.produto-250pts').slideToggle("slow");
                } 
            });
    });
    </script>
</body>
</html>
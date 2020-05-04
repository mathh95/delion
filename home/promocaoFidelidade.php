<?php
    //session_start();

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    include_once CONTROLLERPATH."/conexao.php";
    include_once "./controler/controlProduto.php";
    include_once MODELPATH."/produto.php";


    $controle_produto = new controlerProduto(conecta());
    
    //configuração de acesso ao WhatsApp 
    // include "./whats-config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delion Café - Delivery Foz do Iguaçu | Programa de Fidelidade</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name="description" content="Participe do nosso programa de fidelidade. Suas compras valem pontos que podem ser trocados por delícias do nosso cardápio!">
	<meta name="keywords" content="Salgados, Doces, Bolos, Lanches, Bebidas, Sobremesas, Fidelidade, Pontos, Prêmios">
	<meta name="robots" content="">
	<meta name="revisit-after" content="1 day">
	<meta name="language" content="Portuguese">
	<meta name="generator" content="N/A">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="format-detection" content="telephone=no">
    


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 767px)" href="css/fidelidade/style-xs.css"/>

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (max-width: 991px)" href="css/fidelidade/style-sm.css"/>

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 992px) and (max-width: 1199px)" href="css/fidelidade/style-md.css"/>

    <link rel="stylesheet" type="text/css" media="only screen and (min-width: 1200px)" href="css/fidelidade/style-lg.css"/>

</head>
<body>

<head>
	<title>Delion Café - Delivery Foz do Iguaçu | Fidelidade</title>
	
</head>
    <?php
		include_once "./header.php";
	?>

	<?php
		include_once "./navbar.php";
	?>


<?php 
    $controle=new controlerGerenciarSite($_SG['link']);
    $config = $controle->selectConfigValida();
    $imagemLink = $config->getFoto();
    
    
       

?>

    <div class="container-fluid banner-red">
        <div class="container">
            <div class="col-sm-6 text-center top-banner-red">
                <div class="col-sm-12 container-title-logo">
                    <div class="col-sm-7">
                        <h1>Programa fidelidade</h1>
                    </div>
                    <div class="logo-wrapper">
                        <img id="logo" src="/home/img/Logo_branca.png">
                    </div>
                    
                </div>
                <div class="col-sm-12 container-footer">
                    <p style="font-size:24px;">Aqui suas compras viram pontos, e seus pontos viram brindes deliciosos.</p>
                    <img class="ponto_fidelidade" src="/home/img/fidelidade_pontos.png">
                    <p>A cada R$1,00 em compras você acumula 1 ponto.</p>
                    <button type="button" class="btn btn-success" onclick="location = '/home/cadastroCliente.php'">FAÇA PARTE</button>
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
                <button type="button" class="30pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-30pts">
                    <span>30</span><br>
                    pontos
                </button>

                <button type="button" class="50pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-50pts">
                    <span>50</span><br>
                    pontos
                </button>

                <button type="button" class="80pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-80pts">
                    <span>80</span><br>
                    pontos
                </button >

                <button type="button" class="90pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-90pts">
                    <span>90</span><br>
                    pontos
                </button>

                <button type="button" class="120pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-120pts">
                    <span>120</span><br>
                    pontos
                </button>

                <button type="button" class="200pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-200pts">
                    <span>200</span><br>
                    pontos
                </button>

                <button type="button" class="220pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-220pts">
                    <span>220</span><br>
                    pontos
                </button>

                <button type="button" class="250pts btn-pts btn btn-warning"
                data-link_class_produtos="produto-250pts">
                    <span>250</span><br>
                    pontos
                </button>
            </div>




            <div class="produtos-pontos produto-30pts" style="display: none;">

                <!-- Produtos botao 30 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(30);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>

            </div>
            
            <div class="produtos-pontos produto-50pts" style="display: none;">

                <!-- Produtos botao 50 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(50);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>


            </div>

            <div class="produtos-pontos produto-80pts" style="display: none;">

                <!-- Produtos botao 80 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(80);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>

            </div>

            <div class="produtos-pontos produto-90pts" style="display: none;">

                <!-- Produtos botao 90 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(90);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>

            </div>

            <div class="produtos-pontos produto-120pts" style="display: none;">

                <!-- Produtos botao 120 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(120);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>

            </div>

            <div class="produtos-pontos produto-200pts" style="display: none;">

                <!-- Produtos botao 200 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(200);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>

            </div>
            
            <div class="produtos-pontos produto-220pts" style="display:none;">
                <!-- Produtos botao 220 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(220);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>


            </div>

            <div class="produtos-pontos produto-250pts" style="display:none;">
                <!-- Produtos botao 250 pontos -->
                <?php
                
                $produtos = $controle_produto->selectAllByPtsResgate(250);

                foreach($produtos as $produto){
                    echo "
                    <div class='produto'>
                        <img src='../admin/{$produto->getFoto()}' alt='{$produto->getNome()}'  onerror='this.src=\"/home/img/default_produto.jpg\"'>
                        <h2>{$produto->getNome()}</h2>
                    </div>
                    ";
                }

                ?>

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
                            em compras<br>
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

            $( ".btn-pts" ).click(function() {
                link_class_produtos = $(this).data("link_class_produtos");
                $( ".produtos-pontos" ).hide();
                $('.'+link_class_produtos).slideToggle();
                
            });
            
    </script>
</body>
</html>
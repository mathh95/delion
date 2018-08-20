<?php
include 'config/config.inc.php';
include 'libs/Connection.class.php';

function __autoload($className)
{
    $st = substr($className, -6, 6);

    if ($st == 'Mapper') {
        if (file_exists("model/{$className}.class.php")) {
            include_once "model/{$className}.class.php";
        }
    } else {
        if (file_exists("libs/{$className}.class.php")) {
            include_once "libs/{$className}.class.php";
        }
    }
}

Session::star_session();

if (($_GET['lang'] == 'es') || ($_GET['lang'] == 'pt-br') || ($_GET['lang'] == 'en')) {
    Session::set('lang', $_GET['lang']);
}

$bd = Connection::get();

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php if ($_GET['produto']) {
        $cod_produto = (int)$_GET['produto'];
        $p = $bd->query(ProdutoMapper::get($cod_produto))->fetch();

        ?>
        <title><?= $p['meta_tag_titulo'] ?></title>
        <meta name="description" content="<?= $p['meta_tag_descricao'] ?>">
    <?php } else { ?>
    <title>Delion Café - Cafeteria Foz do Iguaçu</title>
    <meta name="Description" content=“Delion Café é uma cafeteria gourmet, esta localizada no centro de Foz do Iguaçu" />
    <meta name="Keywords" content=“Cafeteria, Foz do Iguaçu, empanada, quiche, torta holandesa, cafeteria foz do iguaçu, café foz do iguaçu" />
    <meta name="googlebot" content="index, follow" />
    <meta name="robots" content="index, follow" />
    <meta name="Revist-After" content="7 days" />
    <meta name="city" content="Foz do Iguaçu" />
    <meta name="country"  content="BR" />
    <meta name="state" content="PR" />
    <meta name="zip code" content="85851130" />
    <meta name="subject" content=“Delion Café - Cafeteria Foz do Igua&ccedil;u" />
    <meta name ="author" content="Kionux Solu&ccedil;ões em Internet" />
    <meta name="copyright" content=“Delion Café - Cafeteria Foz do Igua&ccedil;u" />
    <meta name="geo.region" content="BR-PR" />
    <meta name="geo.placename" content="Foz do Igua&ccedil;u" />
    <?php } ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/wf-development.css">
    <link rel="stylesheet" href="css/wf-development-mobile.css">
    <link rel="stylesheet" href="fancybox/jquery.fancybox.css" media="screen"/>
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
    <!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


    <nav class=" the-font super-nav">
        <div class="container">
            <div class="logo-mobile">
                <a href="#"><img src="img/logo-mobile.png" alt=""></a>
            </div>
            <div id="btn-toggle">
                <a class="bnt-toggle-a" href="#">
                    <span class="glyphicon glyphicon-align-justify"></span>
                </a>
            </div>
            <ul class="nav-left">
<!--                <li><a href="#">Home</a></li>-->
<!--                <li><a href="#">Cardápio</a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Home <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="bg-sub-menu icon-menu" style="background-image: url(img/home-sm.png);" href="index.php">Início</a></li>
                        <li><a class="bg-sub-menu icon-menu" style="background-image: url(img/about-sm.png);" href="sobre.php">Sobre</a></li>
                        <li><a class="bg-sub-menu icon-menu" style="background-image: url(img/history-sm.png);" href="historia.php">História</a></li>
                    </ul>
                </li>
                
                <?
                
				$categorias = $bd->query(CategoriaMapper::get())->fetchAll();
				
				?>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cardápio <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        
                        <?php if ($categorias) { ?>

        				<?php foreach ($categorias as $categoria) { ?>
                        
                        <li><a class="bg-sub-menu icon-menu" style="background-image: url(/<?= $categoria['logo'] ?>);" href="produtos.php?categoria=<?= $categoria['cod_categoria'] ?>"><?= $categoria['nome'] ?></a></li>
                        
                        <? } ?>
                        
                        <? } ?>
                        
                        
                    </ul>
                </li>
            </ul>
            <div class="logo"><a href="#"><img style="padding: 0 0 0 42px" src="img/logo.png" width="100%" alt=""></a></div>
            <ul class="nav-right">
                <li><a href="promocoes.php">Promoção</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
        </div>
    </nav>

    

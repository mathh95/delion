<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once HOMEPATH."home/controler/controlCliente.php";

    include_once MODELPATH."/usuario.php";

    include_once MODELPATH."/cliente.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <meta name="description" content="">

        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Área Administrativa</title>

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link href="../../vendor/bootstrap3/css/bootstrap.min.css" rel="stylesheet">

        <link href="../../vendor/bootstrap3/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <link rel="stylesheet" href="../../dist/css/normalize.css">

        <link rel="stylesheet" href="../../dist/css/main.css">

        <script src="../../dist/js/vendor/modernizr-2.8.3.min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>

        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

        <![endif]-->

    </head>

    <body>

        <!--[if lt IE 8]>

        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>

        <![endif]-->

        <!-- Add your site or application content here -->

        <header>

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                        <h1>Área Administrativa <?= EMPRESA ?></h1>

                    </div>

                    <div class="col-md-2">

                        <div class="pull-right">

                            <h3>

                            <img src="../../img/person.png" alt="" />

                            <span>Bom dia <?php echo  $_SESSION['usuarioNome'] ?></span>

                            </h3>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-12">

                <div class="row">

                    <nav class="navbar navbar-default">

                        <div class="">

                            <div class="navbar-header">

                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                                <span class="sr-only">Toggle navigation</span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                                <span class="icon-bar"></span>

                                </button>

                            </div>

                        <div id="navbar" class="collapse navbar-collapse pull-left">
                            <ul class="nav navbar-nav">
                                <li class="dropdown ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="usuario.php">Cadastro</a></li>
                                        <li><a href="usuariosLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empresa <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="empresa.php">Alterar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banners <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="banner.php">Cadastro</a></li>
                                        <li><a href="bannerLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Avaliacao <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="tipoAvaliacao.php">Cadastro</a></li>

                                            <li><a href="tipoAvaliacaoLista.php">Listar</a></li>

                                            <li><a href="mediaAvaliacao.php">Médias</a></li>

                                        </ul>

                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Imagens <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="imagem.php">Cadastro</a></li>
                                        <li><a href="imagemLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Evento <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="evento.php">Cadastro</a></li>
                                        <li><a href="eventoLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categoria <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="categoria.php">Cadastro</a></li>
                                        <li><a href="categoriaLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cardápio <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cardapio.php">Cadastro</a></li>
                                        <li><a href="cardapioLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mini banner <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="miniBanner.php">Cadastro</a></li>
                                        <li><a href="miniBannerLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown active ">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cliente <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cliente.php">Cadastro</a></li>
                                        <li><a href="clienteLista.php">Listar</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="pedidoLista.php">Pedido</a>
                                </li>    
                            </ul>
                        </div>

                            <div class="pull-right">

                                <h2><a href="alteraSenha.php"> ALTERAR SENHA |</a>

                                <a href="../../controler/logout.php"> SAIR &nbsp;</a></h2>

                            </div>

                        </div>

                    </nav>

                </div>

            </div>

        </header>

        <?php

            $controle = new controlCliente($_SG['link']);

            $cliente = $controle->select($_GET['cod'], 2);

            $controleUsuario= new controlerUsuario($_SG['link']);

            $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

            $permissaos=json_decode($usuarioPermissao->getPermissao());

            $p="[";

            foreach ($permissaos as $permissao) {

                $p.='"'.$permissao.'",';

            }

            $p.="]";

        ?>

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-cliente" method="post" action="../../controler/alterarCliente.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados Pessoais</h3>

                            <small>Nome:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" value="<?=$cliente->getNome(); ?>" required autofocus type="text">

                                <input type="text" class="form-control"  style="display:none" id="cod" name="cod_cliente" maxlength="50" value="<?=  $cliente->getCod_cliente(); ?>" >

                            </div>

                            <br>

                            <small>Login:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                <input class="form-control" placeholder="Login" name="login" value="<?=$cliente->getLogin(); ?>" required  type="text">

                            </div>

                            <br>

                            <small>Telefone:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>

                                <input class="form-control" placeholder="Telefone" name="telefone" value="<?=$cliente->getTelefone(); ?>" type="number">

                            </div>

                        </div>

                        <div class="col-md-1"></div>

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-5" style="padding-left: 0px;">

                        <div class="pull-left">

                        <?php

                        $permissao =  json_decode($usuarioPermissao->getPermissao());

                        if (in_array('cliente', $permissao)){ ?>

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o""></i> Alterar</button>

                        <?php } ?>

                        </div>

                        <div class="pull-right">

                            <a href="clienteLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <footer>

            <div class="col-md-12">

                <div class="row">

                    <img src="../../img/Kionux_1.jpg" class="img-responsive" alt="" />

                </div>

            </div>

        </footer>

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

        <script>window.jQuery || document.write('<script src="../../dist/js/vendor/jquery-1.12.0.min.js"><\/script>')</script>

        <script src="../../vendor/bootstrap3/js/bootstrap.min.js"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

        <script src="../../vendor/bootstrap3/js/ie10-viewport-bug-workaround.js"></script>

        <script src="../../dist/js/plugins.js"></script>

        <script src="../../dist/js/main.js"></script>

    </body>

</html>
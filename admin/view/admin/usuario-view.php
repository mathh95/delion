<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

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

                                    <li class="dropdown active ">

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

                                    <li class="dropdown">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Adicional <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="adicional.php">Cadastro</a></li>

                                            <li><a href="adicionalLista.php">Listar</a></li>
                                            
                                        </ul>

                                    </li>   

                                    <li class="dropdown">

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mini banner <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="miniBanner.php">Cadastro</a></li>

                                            <li><a href="miniBannerLista.php">Listar</a></li>

                                        </ul>

                                    </li>

                                    <li class="dropdown">

                                        
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cliente <span class="caret"></span></a>
                                        
                                        <ul class="dropdown-menu">
                                            
                                            <li><a href="cliente.php">Cadastro</a></li>
                                           
                                            <li><a href="clienteLista.php">Listar</a></li>
                                       
                                        </ul>
                                    
                                    </li>

                                    <li class="dropdown">
                                        <a href="pedidoLista.php">Pedido</a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="comboLista.php">Combo</a>
                                    </li> 
                                    
                                    <li class="dropdown">
                                        <a href="/home/avaliacao.php">Avaliar</a>
                                    </li>
                                    <li class="dropdown">
                                    <a href="enderecoLista.php">Endereços</a>
                                    </li> 
                                    <li class="dropdown">
                                        <!--/.Mudar aqui -->
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pedidos Whatsapp <span class="caret"></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="pedidoWpp.php">Novo Pedido</a></li>
                                                <li><a href="pedidoWppLista.php">Listar Pedidos</a></li>
                                                <li><a href="clienteListaWpp.php">Listar Clientes Whatsapp</a></li>
                                            </ul>
                                    </li>
                                    <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cupom<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cupom.php">Cadastro</a></li>
                                        <li><a href="cupomLista.php">Listar Cupons</a></li>
                                    </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Formas de Pagamento<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="adicional.php">Cadastro</a></li>
                                            <li><a href="adicionalLista.php">Listar</a></li>
                                        </ul>
                                    </li> 
                                </ul>

                            </div><!--/.nav-collapse -->

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

            $controleUsuario = new controlerUsuario($_SG['link']);

            $usuario = $controleUsuario->select($_GET['cod'], 2);

            $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

            $permissaos=json_decode($usuario->getPermissao());

            $p="[";

            foreach ($permissaos as $permissao) {

                $p.='"'.$permissao.'",';

            }

            $p.="]";

        ?>

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="post" action="../../controler/alteraUsuario.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados Pessoais</h3>

                            <small>Nome:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" value="<?=$usuario->getNome(); ?>" required autofocus type="text">

                                <input type="text" class="form-control"  style="display:none" id="cod" name="cod" maxlength="50" value="<?=  $usuario->getCod_usuario(); ?>" >

                            </div>

                            <br>

                            <small>Login:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                <input class="form-control" placeholder="Usuário" name="login" value="<?=$usuario->getLogin(); ?>" required  type="text">

                            </div>

                            <br>

                            <small>E-mail:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>

                                <input class="form-control" placeholder="E-mail" name="email" value="<?=$usuario->getEmail(); ?>" type="email">

                            </div>

                            <br>

                            <small>Perfil:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>

                                <select class="form-control" name="perfil" required>

                                    <option value='<?=$usuario->getNome(); ?>'>Administrador</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-1"></div>

                        <div class="col-md-5">

                            <h3>Permissões</h3>

                            <div class="checkbox">

                                <ul>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="usuario" name="1permissao" value="usuario">Usuários

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="empresa" name="2permissao" value="empresa">Empresa

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="banner" name="3permissao" value="banner">Banners

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="imagem" name="4permissao" value="imagem">Imagens

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="evento" name="5permissao" value="evento">Evento

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="categoria" name="6permissao" value="categoria">Categoria

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="cardapio" name="7permissao" value="cardapio">Cardápio

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="cliente" name="8permissao" value="cliente">Cliente

                                        </label>

                                    </li>
                                    
                                    <li>

                                        <label>

                                            <input type="checkbox" id="pedido" name="9permissao" value="pedido">Pedido

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="avaliacao" name="10permissao" value="avaliacao">Avaliação

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="combo" name="11permissao" value="combo">Combo

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="adicional" name="12permissao" value="adicional">Adicional

                                        </label>

                                    </li>

                                    <li>
                                        <label>

                                            <input type="checkbox" id="pedidoWpp" name="13permissao" value="pedidoWpp">Pedido Whatsapp

                                        </label>
                                    </li>

                                </ul>

                            </div>

                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-5" style="padding-left: 0px;">

                        <div class="pull-left">

                        <?php

                        $permissao =  json_decode($usuarioPermissao->getPermissao());

                        if (in_array('usuario', $permissao)){ ?>

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o" onclick="confereSenha();"></i> Alterar</button>

                        <?php } ?>

                        </div>

                        <div class="pull-right">

                            <a href="usuariosLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

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

        <script>

            var permissao =   <?=$p?>;

            $( document ).ready(function() {

                for(let value of permissao){

                    $('#' + value).attr('checked', true);

                }

            })

            function confereSenha() {

            //if(validar($("#senha1").val())){

                if($("#senha1").val().length>5){

                    $("#alteraSenha").submit();

                }else{

                    alertComum('Erro!','Senhas devem conter no mínimo 6 caracteres!',2);

                }

            //}else{

            //    alertComum('Erro!','Senhas devem conter apenas letras e números!',2);

            //}

            }

        </script>

    </body>

</html>
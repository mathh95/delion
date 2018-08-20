<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

?>

<!DOCTYPE html>

<html class="no-js" lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

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

                                    <li class="dropdown active">

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

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mini banner <span class="caret"></span></a>

                                        <ul class="dropdown-menu">

                                            <li><a href="miniBanner.php">Cadastro</a></li>

                                            <li><a href="miniBannerLista.php">Listar</a></li>

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

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="post" action="../../controler/businesUsuario.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados Pessoais</h3>

                            <small>Nome:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" value="" required autofocus type="text">

                            </div>

                            <br>

                            <small>Login:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                <input class="form-control" placeholder="Usuário" name="login" value="" required  type="text">

                            </div>

                            <br>

                            <small>Senha:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                                <input class="form-control" placeholder="Senha" name="senha" value="" required  type="password">

                            </div>

                            <br>

                            <small>E-mail:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>

                                <input class="form-control" placeholder="E-mail" name="email" value="" type="email">

                            </div>

                            <br>

                            <small>Perfil:</small>

                            <br>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>

                                <select class="form-control" name="perfil" required>

                                    <option value='0'>Administrador</option>

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

                                            <input type="checkbox" id="Usuários" name="1permissao" value="usuario">Usuários

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="empresa" name="2permissao" value="empresa">Empresa

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="banners" name="3permissao" value="banner">Banners

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

                            <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o" onclick="confereSenha();"></i> Salvar</button>

                        <?php } ?>

                        </div>

                        <div class="pull-right">

                            <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

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

        <?php include VIEWPATH."/rodape.html" ?>

        <script>

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
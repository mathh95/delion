<?php
ROOTPATH
    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlImagem.php";

    include_once MODELPATH."/imagem.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

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

                                    <li class="dropdown">

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

                                    <li class="dropdown active">

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

        <?php

            $controle=new controlerImagem($_SG['link']);

            $imagem = $controle->select($_GET['cod'], 2);

            $paginas=json_decode($imagem->getPagina());

            $p="[";

            foreach ($paginas as $pagina) {

                $p.='"'.$pagina.'",';

            }

            $p.="]";

        ?>

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraImagem.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados da imagem</h3>

                            <br>

                            <small>Nome: (Apenas para referência.)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $imagem->getNome(); ?>"/>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="text" value="<?=  $imagem->getCod_imagem(); ?>"/>

                                <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="text" value="../<?=  $imagem->getFotoAbsoluto(); ?>"/>

                            </div>

                            <br>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $imagem->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small>Foto:<br/> 

                                <span style="color:red">(Tamanho 898[largura] x 505[altura] para imagens da página História e Contato.) </span><br/>

                                <span style="color:red">(Tamanho 1058[largura] x 455[altura] para imagens da página Sobre.) </span><br/>

                                <span style="color:red">(Tamanho 855[largura] x 453[altura] para imagens da página Inicial.) </span><br/>

                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). ) </span>

                            </small>

                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                            <small>Página (Página onde a imagem será utilizada)</small>

                            <div class="checkbox">

                                <ul>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialCardapio" name="1pagina" value="inicialCardapio">Página inicial Cardápio

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialEvento" name="2pagina" value="inicialEvento">Página inicial Eventos

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialPedido" name="3pagina" value="inicialPedido">Página inicial Pedido

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialCartaoFidelidade" name="4pagina" value="inicialCartaoFidelidade">Página inicial Cartão Fidelidade

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="sobre" name="5pagina" value="sobre">Sobre

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="historia" name="6pagina" value="historia">História

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="contato" name="7pagina" value="contato">Contato

                                        </label>

                                    </li>

                                </ul>

                            </div>

                            <br>

                        </div> 

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('imagem', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="imagemLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

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

            var pagina =   <?=$p?>;

            $( document ).ready(function() {

                for(let value of pagina){

                    $('#' + value).attr('checked', true);

                }

            })

        </script>

    </body>

</html>
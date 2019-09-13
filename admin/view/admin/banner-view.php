<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlBanner.php";

    include_once MODELPATH."/banner.php";

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

                                    <li class="dropdown active">

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
                                            <li><a href="formaPgt.php">Cadastro</a></li>
                                            <li><a href="formaPgtLista.php">Listar</a></li>
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

            $controle=new controlerBanner($_SG['link']);

            $banner = $controle->select($_GET['cod'], 2);

            $paginas=json_decode($banner->getPagina());

            $p="[";

            foreach ($paginas as $pagina) {

                $p.='"'.$pagina.'",';

            }

            $p.="]";

        ?>

        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/alteraBanner.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados do Banner</h3>

                            <br>

                            <small>Nome: (Apenas para referência.)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?=  $banner->getNome(); ?>"/>

                                <input class="form-control" name="cod" style="display: none;" id ="cod" type="text" value="<?=  $banner->getCod_banner(); ?>"/>

                                <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="text" value="../<?=  $banner->getFotoAbsoluto(); ?>"/>

                            </div>

                            <br>

                            <small>Link: (endereço caso deseja que ao clicar no banner o usuário vá para uma página especifica.)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-link"></i></span>

                                <input class="form-control" placeholder="ex: http://www.minhapagina.com.br/produtos" name="link" id ="link" type="text" value="<?=  $banner->getLink(); ?>">

                            </div>

                            <br>

                            <small>Foto:</small>

                            <br>

                            <img src="../../<?=  $banner->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <small>Foto:<br/> 

                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). Tamanho 1900[largura] x 690[altura] para o banner da Página inicial superior.)</span><br/>



                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg).Tamanho 1900[largura] x 538[altura] para outros locais de banners.) </span><br/>

                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). ) </span>

                            </small>

                            <input type="file" name="arquivo" id ="arquivo">

                            <br>

                            <small>Página (Página onde o banner será utilizado)</small>

                            <div class="checkbox">

                                <ul>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialSuperior" name="1pagina" value="inicialSuperior">Página inicial superior

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="inicialInferior" name="2pagina" value="inicialInferior">Página inicial inferior

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="sobre" name="3pagina" value="sobre">Sobre

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="historia" name="4pagina" value="historia">História

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="contato" name="5pagina" value="contato">Contato

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="localizacao" name="6pagina" value="localizacao">Localização

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="cardapio" name="7pagina" value="cardapio">Cardápio

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

                    if (in_array('banner', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

                    </div>

                    <div class="pull-right">

                        <a href="bannerLista.php" class="btn btn-kionux"><i class="fa fa-arrow-left"></i> Voltar</a>

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
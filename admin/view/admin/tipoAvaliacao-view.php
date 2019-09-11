<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlTipoAvaliacao.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/tipo_avaliacao.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    $controle=new controlerTipoAvaliacao($_SG['link']);

    $tipo = $controle->selectSemCategoria($_GET['cod'], 2);

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

                                    <li class="dropdown active">

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

                                    </li>     </li>

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

                            <div>

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

        <div class="container-fluid">

           <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraTipoAvaliacao.php">

            <div class="col-md-12">

                <div class="row">

                    <div class="col-md-5">

                        <h3>Dados do item do cardápio</h3>

                        <br>

                        <small>Nome: </small>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                            <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text" value="<?= $tipo->getNome();?>">

                            <input class="form-control" name="cod" id ="cod" type="hidden" value="<?= $tipo->getCod_tipo_avaliacao();?>">

                        </div>

                        <br>

                        <?php 
                            if($tipo->getFlag_ativo() == 1){ ?>

                            <small>Informar se o item está ativo:</small>
                        
                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="ativo" name="flag_ativo" value="<?=(($tipo->getFlag_ativo() == 1) ? "1" : "0")?>" checked>Ativo

                                </label>

                            </div>

                        <?php }else{?>

                            <small>Informar se o item está ativo:</small>
                        
                            <div class="checkbox">

                                <label>

                                    <input type="checkbox" id="ativo" name="flag_ativo" value="<?=(($tipo->getFlag_ativo() == 1) ? "1" : "0")?>">Ativo

                                </label>

                            </div>
                        <?php } ?>
                        
                    </div>

                </div>

            </div>

            <div class="col-md-5">

                <div class="pull-left">

                <?php

                $permissao =  json_decode($usuarioPermissao->getPermissao());

                if (in_array('avaliacao', $permissao)){ ?>

                    <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                <?php } ?>

                </div>

                <div class="pull-right">

                <button type="reset" class="btn btn-kionux"><i class="fa fa-eraser"></i> Limpar Formulário</button>

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

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

        <!-- <script>

            tinymce.init({selector: 'textarea', plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime media nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

                ],

                toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });

            var categoria =   <?php//echo $cardapio->getCategoria()?>;

            $( document ).ready(function() {

                $('#' + categoria).attr('selected', true);

            })

            var ativo =   <?php//echo $cardapio->getFlag_ativo()?>;

            $( document ).ready(function() {

                if (ativo == 1) {

                    $('#ativo').attr('checked', true);

                }

            })
            
        </script> -->

    </body>

</html>

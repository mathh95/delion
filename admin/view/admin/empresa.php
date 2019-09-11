<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlEmpresa.php";

    include_once MODELPATH."/empresa.php";

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

            <?php

                $controle=new controlerEmpresa($_SG['link']);

                $empresa = $controle->selectAll();

            ?>

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

                                    <li class="dropdown active">

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
                                    <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cupom<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="cupom.php">Cadastro</a></li>
                                        <li><a href="pedidoWppLista.php">Listar Cupons</a></li>
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

            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="../../controler/alteraEmpresa.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados da Empresa</h3>

                            <br>

                            <small>Sobre a Empresa: </small>

                            <textarea name="descricao" rows="12"><?=  $empresa->getDescricao(); ?></textarea>

                            <br>

                            <small>História da Empresa: </small>

                            <textarea name="historia" rows="12"><?=  $empresa->getHistoria(); ?></textarea>

                            <br>

                            <small>Foto: <span style="color:red">(Utilizar uma imagem no tamanho 270[largura] x 93[altura]. Formato (.png) ou (.jpg).)</span></small>

                            <br>

                            <img src="../../<?=  $empresa->getFoto(); ?>"  alt='' class='img-thumbnail img-responsive'/>

                            <br>

                            <br>

                            <small style="color:red">Selecione uma imagem caso queira substituir a imagem já existente.</small>

                            <input type="file" name="arquivo">

                            <input class="form-control" name="imagem" style="display: none;" id ="imagem" type="hidden" value="../<?=  $empresa->getFotoAbsoluto(); ?>"/>

                            <br>

                        </div>

                        <div class="col-md-1">

                        </div>

                        <div class="col-md-5">

                            <h3>Dados de contato com a empresa</h3>

                            <br>

                            <small>Endereço:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input class="form-control" placeholder="" name="endereco" value="<?=  $empresa->getEndereco(); ?>"  type="text">

                                <input class="form-control" style="display: none;" placeholder="" name="cod_empresa" value="<?=  $empresa->getCod_empresa(); ?>"  type="text">

                            </div>

                            <br>

                            <small>CEP:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input class="form-control" placeholder="" name="cep" value="<?=  $empresa->getCep(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Bairro:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                                <input class="form-control" placeholder="" name="bairro" value="<?=  $empresa->getBairro(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Cidade:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>

                                <input class="form-control" placeholder="" name="cidade" value="<?=  $empresa->getCidade(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Estado:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-map"></i></span>

                                <input class="form-control" placeholder="" name="estado" value="<?=  $empresa->getEstado(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Telefone:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                <input class="form-control" placeholder="" name="fone" id="fone" value="<?=  $empresa->getFone(); ?>"  type="text">

                            </div>

                            <br>

                            <small>WhatsApp:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span>

                                <input class="form-control" placeholder="" name="whats" id="whats" value="<?=  $empresa->getWhats(); ?>"  type="text">

                            </div>

                            <br>

                            <small>E-mail:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                <input class="form-control" placeholder="" name="email" value="<?=  $empresa->getEmail(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Facebook:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-facebook-official"></i></span>

                                <input class="form-control" placeholder="" name="facebook" value="<?=  $empresa->getFacebook(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Instagram:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>

                                <input class="form-control" placeholder="" name="instagram" value="<?=  $empresa->getInstagram(); ?>"  type="text">

                            </div>

                            <br>

                            <small>Pinterest:</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pinterest-p"></i></span>

                                <input class="form-control" placeholder="" name="pinterest" value="<?=  $empresa->getPinterest(); ?>"  type="text">

                            </div>

                            <br>

                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="pull-left">

                    <?php

                    $permissao =  json_decode($usuarioPermissao->getPermissao());

                    if (in_array('empresa', $permissao)){ ?>

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Alterar</button>

                    <?php } ?>

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

        <script>

            tinymce.init({selector: 'textarea', plugins: [

                'advlist autolink lists link image charmap print preview hr anchor pagebreak',

                'searchreplace wordcount visualblocks visualchars code fullscreen',

                'insertdatetime media nonbreaking save table contextmenu directionality',

                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'

                ],

                toolbar1: 'undo redo | insert | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |  forecolor backcolor '

            });

        </script>

        <script src="http://digitalbush.com/wp-content/uploads/2014/10/jquery.maskedinput.js"></script>

        <script type="text/javascript">

            $("#fone").on("blur", function() {

                var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );



                if( last.length == 3 ) {

                    var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );

                    var lastfour = move + last;

                    var first = $(this).val().substr( 0, 9 );



                    $(this).val( first + '-' + lastfour );

                }

            });

       </script>

    </body>

</html>
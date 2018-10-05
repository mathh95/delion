<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlEmpresa.php";

    include_once MODELPATH."/empresa.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

?>

<!doctype html>

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
                                        <a href="/home/avaliacao.php">Avaliar</a>
                                    </li>

                                </ul>

                            </div><!--/.nav-collapse -->

                            <div>

                            </div>

                            <div class="pull-right">

                                <h2><a href="configuracoes.php"> ALTERAR SENHA |</a>

                                <a href="../../controler/logout.php"> SAIR &nbsp;</a></h2>

                            </div>

                        </div>

                    </nav>

                </div>

            </div>

        </header>

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">Configurações</h1>

                </div>

            </div>

            <h3 class="col-sm-offset-4 col-md-4"> Alterar Senha </h3>

            <form action="../../controler/alteraSenha.php" class='col-md-12 col-md-offset-0 form-horizontal'  method="post" enctype="multipart/form-data" id="alteraSenha">

                <div class="panel-body">

                    <div class="form-group">

                        <label class="col-md-5 control-label">Senha Atual</label>

                        <div class="col-md-3">

                            <input type="password" class="form-control" id="atual" name="atual" placeholder="Senha Atual" maxlength="50" required/>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-sm-5 control-label">Nova Senha</label>

                        <div class="col-md-3">

                            <input type="password" class="form-control" id="senha1" name="senha1" maxlength="50" placeholder="Nova Senha" min="4" required/>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="col-md-5 control-label">Confirmar nova senha</label>

                        <div class="col-md-3">

                            <input type="password" class="form-control" id="senha2" name="senha2" maxlength="50" placeholder="Confirmar nova senha" min="4" required/>

                        </div>

                    </div>

                </div>

                <div class="form-group" >

                    <button type="button" onclick="confereSenha();" class="btn btn-success col-sm-offset-4 col-md-3" style="left: 40px;">Alterar</button>

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

        <script src="../../js/alert.js" ></script>

        <script type="text/javascript">

            function validar(campo) {

                //se não desejar números é só remover da regex abaixo

                //var regex = '[^a-zA-Z0-9]+';

                if(campo.match(regex)) {//encontrou então não passa na validação

                    return false;

                }else {//não encontrou caracteres especiais

                    return true;

               }

            }

            function confereSenha() {

                if($("#senha1").val()==$("#senha2").val()){

                    //if(validar($("#senha1").val())){

                        if($("#senha1").val().length>5){

                            $("#alteraSenha").submit();

                        }else{

                            alertComum('Erro!','Senhas devem conter no mínimo 6 caracteres!',2);

                        }

                    //}else{

                    //    alertComum('Erro!','Senhas devem conter apenas letras e números!',2);

                    //}

                }else{

                    alertComum('Erro!','Senhas não conferem',2);

                }

            }

        </script>

    </body>

</html>
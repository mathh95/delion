<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/seguranca.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

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

        <?php include_once "./header.php" ?>


        <?php

            $controleUsuario = new controlerUsuario($_SG['link']);

            $usuario = $controleUsuario->select($_GET['cod'], 2);

            $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

            $permissoes = $usuario->getPermissao();
            
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

                                    <option value='<?=$usuario->getCod_perfil(); ?>'>Administrador</option>

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

                                            <input type="checkbox" id="usuario" name="permissoes[]" value="usuario">Usuários

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="empresa" name="permissoes[]" value="empresa">Empresa

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="imagem" name="permissoes[]" value="imagem">Imagens

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="evento" name="permissoes[]" value="evento">Evento

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="categoria" name="permissoes[]" value="categoria">Categoria

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="cardapio" name="permissoes[]" value="cardapio">Cardápio

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="cliente" name="permissoes[]" value="cliente">Cliente

                                        </label>

                                    </li>
                                    
                                    <li>

                                        <label>

                                            <input type="checkbox" id="pedido" name="permissoes[]" value="pedido">Pedido

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="avaliacao" name="permissoes[]" value="avaliacao">Avaliação

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="combo" name="permissoes[]" value="combo">Combo

                                        </label>

                                    </li>

                                    <li>

                                        <label>

                                            <input type="checkbox" id="adicional" name="permissoes[]" value="adicional">Adicional

                                        </label>

                                    </li>
 
                                    <!-- <li>
                                        <label>

                                            <input type="checkbox" id="pedidoWpp" name="permissoes[]" value="pedidoWpp">Pedido Whatsapp

                                        </label>
                                    </li> -->

                                    <li>
                                        <label>

                                            <input type="checkbox" id="cupom" name="permissoes[]" value="cupom">Cupom

                                        </label>
                                    </li>
                                    <li>
                                        <label>

                                            <input type="checkbox" id="forma_pgto" name="permissoes[]" value="forma_pgto">Forma de Pagamento

                                        </label>
                                    </li>
                                    
                                    <li>
                                        <label>

                                            <input type="checkbox" id="info_entrega" name="permissoes[]" value="info_entrega">Informações de Entrega

                                        </label>
                                    </li>

                                    <li>
                                        <label>

                                            <input type="checkbox" id="enviar_sms" name="permissoes[]" value="enviar_sms">Enviar SMS

                                        </label>
                                    </li>

                                    <li>
                                        <label>

                                            <input type="checkbox" id="gerenciar_fidelidade" name="permissoes[]" value="gerenciar_fidelidade"> Gerenciar Fidelidade

                                        </label>
                                    </li>

                                    <li>
                                        <label>

                                            <input type="checkbox" id="gerenciar_fornecedor" name="permissoes[]" value="gerenciar_fornecedor"> Gerenciar Fornecedor

                                        </label>
                                    </li>

                                    <li>
                                        <label>

                                            <input type="checkbox" id="gerenciar_composicao" name="permissoes[]" value="gerenciar_composicao"> Gerenciar Composição do Produto

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

        

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

        <script>window.jQuery || document.write('<script src="../../dist/js/vendor/jquery-1.12.0.min.js"><\/script>')</script>

        <script src="../../vendor/bootstrap3/js/bootstrap.min.js"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

        <script src="../../vendor/bootstrap3/js/ie10-viewport-bug-workaround.js"></script>

        <script src="../../dist/js/plugins.js"></script>

        <script src="../../dist/js/main.js"></script>

        <script>

            var permissoes = <?= $permissoes ?>;
            // console.log(permissoes);
            $( document ).ready(function() {

                for(let p of permissoes){
                    $('#' + p).attr('checked', true);
                }

            });

        </script>

    </body>

</html>
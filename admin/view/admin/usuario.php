<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página selecionada na navbar
    $arquivo_pai = basename(__FILE__, '.php');

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

        <?php include_once "./header.php" ?>


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

                                            <input type="checkbox" id="Usuários" name="permissoes[]" value="usuario">Usuários

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

                                            <input type="checkbox" id="permissaoWpp" name="permissoes[]" value="pedidoWpp">Permissão Whatsapp

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

                                            <input type="checkbox" id="gerenciar_composicao" name="permissoes[]" value="gerenciar_composicao"> Gerenciar Composição

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

        

        <?php include VIEWPATH."/rodape.php" ?>

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
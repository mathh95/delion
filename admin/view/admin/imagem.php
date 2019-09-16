<?php

    include_once $_SERVER['DOCUMENT_ROOT']."/config.php";

    include_once CONTROLLERPATH."/controlUsuario.php";

    include_once MODELPATH."/usuario.php";

    include_once CONTROLLERPATH."/seguranca.php";

    $_SESSION['permissaoPagina']=0;

    protegePagina();

    $controleUsuario = new controlerUsuario($_SG['link']);

    $usuarioPermissao = $controleUsuario->select($_SESSION['usuarioID'], 2);

    //usado para coloração customizada da página seleciona na navbar
    $father_filename = basename(__FILE__, '.php');

?>

<!DOCTYPE html>

<html lang="pt-br">

    <head>

        <?php include VIEWPATH."/cabecalho.html" ?>

    </head>

    <body>

    <?php include_once "./header.php" ?>


        <div class="container-fluid">

            <form class="form-horizontal" id="form-cadastro-usuario" method="POST" enctype="multipart/form-data" action="../../controler/businesImagem.php">

                <div class="col-md-12">

                    <div class="row">

                        <div class="col-md-5">

                            <h3>Dados da imagem</h3>

                            <br>

                            <small>Nome: (Apenas para referência)</small>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>

                                <input class="form-control" placeholder="Nome" name="nome" required autofocus id ="nome" type="text">

                            </div>

                            <br>

                            <small>Foto:<br/> 

                                <span style="color:red">(Tamanho 898[largura] x 505[altura] para imagens da página História e Contato.) </span><br/>

                                <span style="color:red">(Tamanho 1058[largura] x 455[altura] para imagens da página Sobre.) </span><br/>

                                <span style="color:red">(Tamanho 855[largura] x 453[altura] para imagens da página Inicial.) </span><br/>

                                <span style="color:red">(Utilizar uma imagem no formato (.png) ou (.jpg). ) </span>

                            </small>

                            <input type="file" name="arquivo" id ="arquivo" required="">

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

                                    <li>

                                        <label>

                                            <input type="checkbox" id="popUp" name="8pagina" value="popUp">Pop Up inicial

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

                        <button type="submit" class="btn btn-kionux"><i class="fa fa-floppy-o"></i> Salvar</button>

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

    </body>

</html>